<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Field;
use App\Models\Booking;
use App\Models\PriceSetting;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingCalendar extends Component
{
    public Field $field;
    public $selectedDate;
    // Bos minta dikunci 2 jam, jadi default langsung set ke 2
    public $duration = 2; 
    public $availableSlots = [];
    public $selectedTime;
    public $totalPrice = 0;

    protected $rules = [
        'selectedDate' => 'required|date|after_or_equal:today',
        'duration' => 'required|integer|in:2', // Hanya boleh angka 2
        'selectedTime' => 'required',
    ];

    public function mount(Field $field)
    {
        $this->field = $field;
        $this->selectedDate = now()->toDateString();
        $this->loadAvailableSlots();
    }

    public function updated($propertyName)
    {
        // Tetap pantau perubahan tanggal
        if (in_array($propertyName, ['selectedDate'])) {
            $this->selectedTime = null;
            $this->loadAvailableSlots();
            $this->calculateTotalPrice();
        }
    }

    public function selectSlot($time)
    {
        $this->selectedTime = $time;
        $this->calculateTotalPrice();
    }

    public function loadAvailableSlots()
    {
        $this->availableSlots = [];
        $date = Carbon::parse($this->selectedDate);
        
        if ($date->isPast() && !$date->isToday()) {
            return;
        }

        $dayType = $date->isWeekend() ? 'weekend' : 'weekday';

        $settings = PriceSetting::where('field_id', $this->field->id)
            ->where('day_type', $dayType)
            ->get();

        $bookings = Booking::where('field_id', $this->field->id)
            ->whereDate('start_time', $this->selectedDate)
            ->whereIn('status', ['confirmed', 'pending_verification'])
            ->get();

        $allBookedSlots = [];
        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->start_time);
            $end = Carbon::parse($booking->end_time);
            while ($start < $end) {
                $allBookedSlots[] = $start->format('H:i');
                $start->addHour();
            }
        }

        foreach ($settings as $setting) {
            $start = Carbon::parse($setting->start_time);
            $end = Carbon::parse($setting->end_time);

            while ($start < $end) {
                $slotTime = $start->format('H:i');
                
                $isPastTime = false;
                if ($date->isToday()) {
                    $slotDateTime = Carbon::parse($this->selectedDate . ' ' . $slotTime);
                    if ($slotDateTime->lt(now()->addMinutes(15))) {
                        $isPastTime = true;
                    }
                }

                // Sistem akan otomatis cek apakah 2 jam ke depan (slot ini + jam berikutnya) tersedia
                if (!$isPastTime && $this->isSlotAvailableForDuration($slotTime, $date, $allBookedSlots)) {
                    $this->availableSlots[] = ['time' => $slotTime];
                }
                $start->addHour();
            }
        }

        $this->availableSlots = array_values(collect($this->availableSlots)->unique('time')->sortBy('time')->toArray());

        if (!empty($this->availableSlots)) {
            if (empty($this->selectedTime) || !collect($this->availableSlots)->contains('time', $this->selectedTime)) {
                $this->selectedTime = $this->availableSlots[0]['time'];
            }
        } else {
            $this->selectedTime = null;
        }
        
        $this->calculateTotalPrice();
    }

    protected function isSlotAvailableForDuration($startTime, $date, $bookedSlots): bool
    {
        $checkTime = Carbon::parse($date->toDateString() . ' ' . $startTime);
        // Loop ini akan berjalan 2x (0 dan 1) untuk memastikan slot jam 1 dan jam ke-2 aman
        for ($i = 0; $i < (int)$this->duration; $i++) {
            $slot = $checkTime->copy()->addHours($i)->format('H:i');
            if (in_array($slot, $bookedSlots)) return false;
            
            $dayType = $date->isWeekend() ? 'weekend' : 'weekday';
            $exists = PriceSetting::where('field_id', $this->field->id)
                ->where('day_type', $dayType)
                ->where('start_time', '<=', $slot . ':00')
                ->where('end_time', '>', $slot . ':00')
                ->exists();
            if (!$exists) return false;
        }
        return true;
    }

    public function calculateTotalPrice()
    {
        if (!$this->selectedTime) {
            $this->totalPrice = 0;
            return;
        }

        $price = $this->calculatePricePerDuration(
            $this->field->id, 
            Carbon::parse($this->selectedDate . ' ' . $this->selectedTime), 
            (int)$this->duration
        );

        $this->totalPrice = $price ?? 0;
    }

    private function calculatePricePerDuration(int $fieldId, Carbon $startDateTime, int $durationHours)
    {
        $total = 0;
        $currentTime = $startDateTime->copy();

        for ($i = 0; $i < $durationHours; $i++) {
            $dayType = $currentTime->isWeekend() ? 'weekend' : 'weekday'; 
            $timeString = $currentTime->format('H:i:s');

            $priceSetting = PriceSetting::where('field_id', $fieldId)
                ->where('day_type', $dayType) 
                ->where('start_time', '<=', $timeString)
                ->where('end_time', '>', $timeString)
                ->first();

            if (!$priceSetting) return null;
            
            $total += $priceSetting->price_per_hour;
            $currentTime->addHour();
        }
        return $total;
    }

    public function createBooking()
    {
        $this->validate();
        if (!Auth::check()) return redirect()->route('login');

        $startTime = Carbon::parse($this->selectedDate . ' ' . $this->selectedTime);
        $endTime = $startTime->copy()->addHours((int)$this->duration);

        if ($startTime->lt(now()->addMinutes(5))) {
            session()->flash('error', 'Waktu sudah terlewat Bos, pilih jadwal lain!');
            $this->loadAvailableSlots();
            return;
        }

        $isBooked = Booking::where('field_id', $this->field->id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)
                      ->where('end_time', '>', $startTime);
            })
            ->whereIn('status', ['confirmed', 'pending_verification'])
            ->exists();

        if ($isBooked) {
            session()->flash('error', 'Slot ini baru saja dipesan orang lain!');
            $this->loadAvailableSlots();
            return;
        }

        $finalPrice = $this->calculatePricePerDuration($this->field->id, $startTime, (int)$this->duration);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'field_id' => $this->field->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_price' => $finalPrice,
            'payment_method' => 'Transfer Bank',
            'status' => 'pending_verification',
        ]);

        return redirect()->route('payment.show', $booking->id);
    }

    public function render()
    {
        return view('livewire.booking-calendar');
    }
}