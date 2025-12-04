<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Field;
use App\Models\Booking;
use App\Models\PriceSetting;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception; // Import Exception untuk penanganan error

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
    //  PERHITUNGAN TOTAL HARGA (DIPERBAIKI UNTUK MULTI-JAM/MULTI-HARGA)
    // =====================================================================
    public function calculateTotalPrice()
    {
        if (!$this->selectedTime || !$this->duration) {
            $this->totalPrice = 0;
            return;
        }

        try {
            // Panggil fungsi perhitungan akurat
            $this->totalPrice = $this->calculatePricePerDuration(
                $this->field->id, 
                Carbon::parse($this->selectedDate . ' ' . $this->selectedTime), 
                (int)$this->duration
            );
        } catch (Exception $e) {
            // Tampilkan error jika harga tidak ditemukan
            session()->flash('price_error', $e->getMessage());
            $this->totalPrice = 0;
        }
    }

    /**
     * Logika Inti Perhitungan Harga Per Jam yang Akurat
     */
    private function calculatePricePerDuration(int $fieldId, Carbon $startDateTime, int $durationHours): int
    {
        $totalPrice = 0;
        $currentTime = $startDateTime->copy();

        for ($i = 0; $i < $durationHours; $i++) {
            
            $dayType = $currentTime->isWeekend() ? 'weekend' : 'weekday'; 
            $timeString = $currentTime->format('H:i:s');

            // Cari setting harga yang menaungi jam ini
            $priceSetting = PriceSetting::where('field_id', $fieldId)
                ->where('day_type', $dayType) 
                ->where('start_time', '<=', $timeString)
                ->where('end_time', '>', $timeString)
                ->first();

            if (!$priceSetting) {
                // Throw exception jika harga tidak disetting
                $formattedTime = $currentTime->format('H:i');
                throw new Exception("Harga belum diatur untuk Lapangan ini pada {$dayType} jam {$formattedTime}.");
            }
            
            // Menggunakan kolom 'price_per_hour' sesuai database Anda
            $totalPrice += $priceSetting->price_per_hour;

            // Pindah ke jam berikutnya
            $currentTime->addHour();
        }

        return $totalPrice;
    }
    // =====================================================================
    //  AKHIR PERHITUNGAN HARGA
    // =====================================================================

    // =====================================================================
    //  LOAD AVAILABLE SLOTS (STRUKTUR KAMU, TETAPKAN INI)
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

                // Cek ketersediaan untuk durasi yang dipilih
                if ($this->isSlotAvailableForDuration($slotTime, $date, $this->field->id, (int)$this->duration, $allBookedSlots)) {
                     // Cek apakah jam ini memiliki harga
                     try {
                        $this->calculatePricePerDuration($this->field->id, Carbon::parse($this->selectedDate . ' ' . $slotTime), 1);
                        $this->availableSlots[] = ['time' => $slotTime];
                    } catch (Exception $e) {
                        // Abaikan slot jika tidak ada harga
                    }
                }
                
                $start->addHour();
            }
        }

        usort($this->availableSlots, fn($a, $b) => strcmp($a['time'], $b['time']));
        $this->availableSlots = array_unique($this->availableSlots, SORT_REGULAR);
    }
    
    /**
     * Memastikan slot yang dipilih tersedia untuk seluruh durasi
     */
    protected function isSlotAvailableForDuration(string $startTime, Carbon $date, int $fieldId, int $duration, array $bookedSlots): bool
    {
        if ($duration <= 0) return false;

        $checkTime = Carbon::parse($date->toDateString() . ' ' . $startTime);
        
        for ($i = 0; $i < $duration; $i++) {
            $slotToCheck = $checkTime->copy()->addHours($i)->format('H:i');
            
            // Cek apakah slot jam ini sudah dibooking
            if (in_array($slotToCheck, $bookedSlots)) {
                return false;
            }
            
            // **PENTING**: Cek apakah slot jam ini ada pengaturan harganya. 
            // Kalau tidak ada harga, slot tersebut tidak boleh dibooking.
            $dayType = $date->isWeekend() ? 'weekend' : 'weekday'; 
            $priceExists = PriceSetting::where('field_id', $fieldId)
                ->where('day_type', $dayType) 
                ->where('start_time', '<=', $slotToCheck . ':00')
                ->where('end_time', '>', $slotToCheck . ':00')
                ->exists();
                
            if (!$priceExists) {
                return false;
            }
        }

        return true;
    }
    // =====================================================================
    //  AKHIR LOAD AVAILABLE SLOTS
    // =====================================================================


    // =====================================================================
    //  CREATE BOOKING (DIPERBAIKI)
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

        // 1. Re-calculate Total Price sebelum menyimpan (Security Check)
        try {
             $finalPrice = $this->calculatePricePerDuration($this->field->id, $startTime, $duration);
        } catch (Exception $e) {
            session()->flash('error', 'Gagal memproses booking. ' . $e->getMessage());
            return;
        }

        // 2. Re-check Overlapping (Double check karena Livewire)
        $isBooked = Booking::where('field_id', $this->field->id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime);
            })
            ->whereIn('status', ['confirmed', 'pending_verification'])
            ->exists();

        if ($isBooked) {
            session()->flash('error', 'Slot yang Anda pilih baru saja dipesan oleh pengguna lain.');
            $this->loadAvailableSlots();
            return;
        }

        // 3. Simpan Booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'field_id' => $this->field->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_price' => $finalPrice, // Menggunakan harga yang akurat
            'payment_method' => 'Transfer Bank',
            'status' => 'pending_verification',
        ]);

        // 4. Redirect ke halaman pembayaran
        return redirect()->route('payment.show', $booking->id);
    }

    public function render()
    {
        return view('livewire.booking-calendar');
    }
}