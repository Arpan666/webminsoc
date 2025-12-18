<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Carbon;

class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['booking_date']) && isset($data['booking_time'])) {
            $d = Carbon::parse($data['booking_date'])->format('Y-m-d');
            $t = Carbon::parse($data['booking_time'])->format('H:i:s');
            $start = Carbon::parse($d . ' ' . $t);
            
            $data['start_time'] = $start;
            $data['end_time'] = $start->copy()->addHours((int)$data['duration']);
        }
        return $data;
    }
}