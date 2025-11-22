<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Field;
use App\Models\Booking;
use App\Models\PriceSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingCalendar extends Component
{
    // ... properti yang sudah ada ...
    public Field $field; 
    public $selectedDate;
    public $availableSlots = [];
    public $selectedTime = null; 
    public $duration = 1; // Default 1 jam

    // ... mount method ...
    
    public function loadAvailableSlots()
    {
        $date = Carbon::parse($this->selectedDate);
        $dayType = $date->isWeekday() ? 'weekday' : 'weekend'; // Cek hari kerja/akhir pekan
        
        // 1. Ambil Pengaturan Harga yang Relevan
        $priceSettings = PriceSetting::where('field_id', $this->field->id)
            ->where('day_type', $dayType)
            ->get();

        // 2. Ambil semua booking yang dikonfirmasi/pending untuk tanggal tersebut
        $bookedSlots = Booking::where('field_id', $this->field->id)
            ->whereDate('start_time', $date)
            ->whereIn('status', ['confirmed', 'pending_verification']) // Slot yang sudah dipesan/divalidasi
            ->get(['start_time', 'end_time'])
            ->map(function ($booking) {
                return [
                    'start' => Carbon::parse($booking->start_time),
                    'end' => Carbon::parse($booking->end_time),
                ];
            });

        $slots = [];
        $currentTime = Carbon::parse($this->selectedDate)->setTime(8, 0); // Mulai jam 08:00
        $endTime = Carbon::parse($this->selectedDate)->setTime(23, 0); // Sampai jam 23:00

        while ($currentTime->lt($endTime)) {
            $slotEnd = $currentTime->copy()->addHour();
            $isBooked = false;

            // Cek apakah slot ini bertabrakan dengan booking yang ada
            foreach ($bookedSlots as $booked) {
                if ($currentTime->lessThan($booked['end']) && $slotEnd->greaterThan($booked['start'])) {
                    $isBooked = true;
                    break;
                }
            }

            // Dapatkan harga untuk jam saat ini
            $priceSetting = $priceSettings->first(function ($setting) use ($currentTime) {
                return $currentTime->format('H:i:s') >= $setting->start_time && $currentTime->format('H:i:s') < $setting->end_time;
            });
            
            $price = $priceSetting ? $priceSetting->price_per_hour : 0; // Set harga

            $slots[] = [
                'time' => $currentTime->format('H:i'),
                'is_booked' => $isBooked,
                'price' => $price,
            ];

            $currentTime->addHour();
        }

        $this->availableSlots = $slots;
    }
    
    // ... method selectSlot()
    
    public function calculateTotalPrice($time, $duration)
    {
        // 1. Dapatkan slot yang dipilih dan harganya
        $start = Carbon::parse($this->selectedDate . ' ' . $time);
        $totalPrice = 0;
        
        for ($i = 0; $i < $duration; $i++) {
            $checkTime = $start->copy()->addHours($i);
            $dayType = $checkTime->isWeekday() ? 'weekday' : 'weekend';

            // Dapatkan harga dari PriceSetting
            $priceSetting = PriceSetting::where('field_id', $this->field->id)
                ->where('day_type', $dayType)
                ->where('start_time', '<=', $checkTime->format('H:i:s'))
                ->where('end_time', '>', $checkTime->format('H:i:s'))
                ->first();
                
            $totalPrice += $priceSetting ? $priceSetting->price_per_hour : 0;
        }

        return $totalPrice;
    }
    
    // ... method processCheckout() (gunakan calculateTotalPrice di sini)
}