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
    public $duration = 1; // Default durasi 1 jam
    public $availableSlots = [];
    public $selectedTime;
    public $totalPrice = 0;

    protected $listeners = ['selectedDate' => 'loadAvailableSlots'];

    // Aturan validasi
    protected $rules = [
        'selectedDate' => 'required|date|after_or_equal:today',
        'duration' => 'required|integer|min:1',
        'selectedTime' => 'required|date_format:H:i',
    ];

    public function mount(Field $field)
    {
        $this->field = $field;
        $this->selectedDate = now()->toDateString();
        $this->loadAvailableSlots();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'selectedDate') {
            $this->selectedTime = null;
            $this->loadAvailableSlots();
        }

        if ($propertyName === 'duration' || $propertyName === 'selectedTime') {
            $this->calculateTotalPrice();
        }
    }

    public function selectSlot($time)
    {
        $this->selectedTime = $time;
        $this->calculateTotalPrice();
    }

    // =====================================================================
    //  HITUNG TOTAL HARGA (FIXED)
    // =====================================================================
    public function calculateTotalPrice()
    {
        if (!$this->selectedTime || !$this->duration) {
            $this->totalPrice = 0;
            return;
        }

        $duration = (int)$this->duration; // FIX: pastikan integer

        $date = Carbon::parse($this->selectedDate);
        $dayType = $date->isWeekend() ? 'weekend' : 'weekday';

        $startTime = Carbon::parse($this->selectedTime);
        $endTime = $startTime->copy()->addHours($duration);

        $priceSetting = PriceSetting::where('field_id', $this->field->id)
            ->where('day_type', $dayType)
            ->where('start_time', '<=', $startTime->format('H:i:s'))
            ->where('end_time', '>=', $endTime->subMinute()->format('H:i:s')) // FIX: aman
            ->orderBy('price_per_hour', 'desc')
            ->first();

        if ($priceSetting) {
            $this->totalPrice = $priceSetting->price_per_hour * $duration;
        } else {
            $this->totalPrice = 0;
        }
    }

    // =====================================================================
    //  LOAD AVAILABLE SLOTS (STRUKTUR KAMU, TAPI SUDAH DIPERBAIKI)
    // =====================================================================
    public function loadAvailableSlots()
    {
        $this->availableSlots = [];

        $date = Carbon::parse($this->selectedDate);
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

            $currentTime = now()->addHour();

            if ($date->isToday()) {
                if ($start->lessThan($currentTime)) {
                    $start = $currentTime;
                    $start->minute(0)->second(0);

                    if ($start->lessThan(now())) {
                        $start->addHour();
                    }
                }
            }

            while ($start < $end) {
                $slotTime = $start->format('H:i');

                if (!in_array($slotTime, $allBookedSlots)) {
                    $this->availableSlots[] = ['time' => $slotTime];
                }

                $start->addHour();
            }
        }

        usort($this->availableSlots, fn($a, $b) => strcmp($a['time'], $b['time']));
        $this->availableSlots = array_unique($this->availableSlots, SORT_REGULAR);
    }

    // =====================================================================
    //  CREATE BOOKING (FIXED)
    // =====================================================================
    public function createBooking()
    {
        $this->validate();

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $duration = (int)$this->duration;

        $startTime = Carbon::parse($this->selectedDate . ' ' . $this->selectedTime);
        $endTime = $startTime->copy()->addHours($duration);

        $isBooked = Booking::where('field_id', $this->field->id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime);
            })
            ->whereIn('status', ['confirmed', 'pending_verification'])
            ->exists();

        if ($isBooked) {
            session()->flash('error', 'Slot yang Anda pilih baru saja dipesan.');
            $this->loadAvailableSlots();
            return;
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'field_id' => $this->field->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_price' => $this->totalPrice,
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
