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

    // Dipanggil saat properti $selectedDate atau $duration berubah
    public function updated($propertyName)
    {
        if ($propertyName === 'selectedDate') {
            $this->selectedTime = null; // Reset pilihan waktu saat tanggal berubah
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
    
    // --- LOGIKA UTAMA HARGA ---
    
    public function calculateTotalPrice()
    {
        if (!$this->selectedTime || !$this->duration) {
            $this->totalPrice = 0;
            return;
        }

        $date = Carbon::parse($this->selectedDate);
        $dayType = $date->isWeekend() ? 'weekend' : 'weekday'; // Tentukan jenis hari
        $startTime = Carbon::parse($this->selectedTime);

        // Cari pengaturan harga yang berlaku
        $priceSetting = PriceSetting::where('field_id', $this->field->id)
            ->where('day_type', $dayType)
            ->where('start_time', '<=', $startTime->format('H:i:s'))
            ->where('end_time', '>=', $startTime->copy()->addHours($this->duration)->subMinute()->format('H:i:s')) // Cek durasi total
            ->orderBy('price_per_hour', 'desc') // Ambil harga tertinggi jika ada tumpang tindih
            ->first();
            
        if ($priceSetting) {
            $this->totalPrice = $priceSetting->price_per_hour * $this->duration;
        } else {
            $this->totalPrice = 0; // Atau berikan harga default jika tidak ada setting
        }
    }
    
    // --- LOGIKA UTAMA SLOT ---

    public function loadAvailableSlots()
    {
        $this->availableSlots = [];
        
        $date = Carbon::parse($this->selectedDate);
        $dayType = $date->isWeekend() ? 'weekend' : 'weekday';

        // 1. Ambil pengaturan harga untuk hari ini
        $settings = PriceSetting::where('field_id', $this->field->id)
                                ->where('day_type', $dayType)
                                ->get();
                                
        // 2. Ambil semua booking yang sudah dikonfirmasi pada tanggal ini
        $bookedSlots = Booking::where('field_id', $this->field->id)
                              ->whereDate('start_time', $this->selectedDate)
                              ->whereIn('status', ['confirmed', 'pending_verification']) // Slot yang masih dipertimbangkan
                              ->get();
                              
        $allBookedSlots = [];
        foreach ($bookedSlots as $booking) {
            $start = Carbon::parse($booking->start_time);
            $end = Carbon::parse($booking->end_time);
            while ($start < $end) {
                $allBookedSlots[] = $start->format('H:i');
                $start->addHour();
            }
        }

        // 3. Iterasi melalui Price Settings untuk menghasilkan slot
        foreach ($settings as $setting) {
            $start = Carbon::parse($setting->start_time);
            $end = Carbon::parse($setting->end_time);
            
            // Batasi slot agar tidak menampilkan masa lalu pada hari ini
            $currentTime = now()->addHour(); // Beri margin 1 jam dari sekarang
            if ($date->isToday()) {
                if ($start->lessThan($currentTime)) {
                    $start = $currentTime;
                    // Bulatkan ke jam berikutnya jika perlu (misal 14:30 jadi 15:00)
                    $start->minute(0)->second(0);
                    if ($start->lessThan(now())) {
                        $start->addHour();
                    }
                }
            }

            while ($start < $end) {
                $slotTime = $start->format('H:i');

                // Cek ketersediaan: Slot ini tidak boleh sudah di-booking
                if (!in_array($slotTime, $allBookedSlots)) {
                    $this->availableSlots[] = ['time' => $slotTime];
                }
                $start->addHour();
            }
        }
        
        // Urutkan slot
        usort($this->availableSlots, fn($a, $b) => strcmp($a['time'], $b['time']));
        $this->availableSlots = array_unique($this->availableSlots, SORT_REGULAR);
    }
    
    // --- LOGIKA CREATE BOOKING ---
    
    public function createBooking()
    {
        // 1. Validasi
        $this->validate();
        
        // 2. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 3. Persiapan data
        $startTime = Carbon::parse($this->selectedDate . ' ' . $this->selectedTime);
        $endTime = $startTime->copy()->addHours($this->duration);
        
        // Double-check: Pastikan slot masih kosong sebelum disimpan
        $isBooked = Booking::where('field_id', $this->field->id)
                           ->where(function ($query) use ($startTime, $endTime) {
                               $query->where('start_time', '<', $endTime)
                                     ->where('end_time', '>', $startTime);
                           })
                           ->whereIn('status', ['confirmed', 'pending_verification'])
                           ->exists();
                           
        if ($isBooked) {
            session()->flash('error', 'Slot yang Anda pilih baru saja dipesan.');
            $this->loadAvailableSlots(); // Refresh slot
            return;
        }

        // 4. Buat Booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'field_id' => $this->field->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_price' => $this->totalPrice,
            'payment_method' => 'Transfer Bank', // Default, bisa diubah
            'status' => 'pending_verification', // Status awal
        ]);

        // 5. Redirect ke Halaman Pembayaran
        return redirect()->route('payment.show', $booking->id);
    }

    public function render()
    {
        return view('livewire.booking-calendar');
    }
}