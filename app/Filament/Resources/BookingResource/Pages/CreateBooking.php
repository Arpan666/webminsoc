<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ambil input pembantu
        $startTime = $data['start_time'] ?? null;
        $timeDisplay = $data['start_time_display'] ?? '00:00';
        $duration = (int) ($data['duration'] ?? 1);

        if ($startTime) {
            // Bersihkan tanggal dan gabungkan dengan jam
            $justDate = date('Y-m-d', strtotime($startTime));
            $start = Carbon::parse($justDate . ' ' . $timeDisplay);
            
            // Set kolom asli database
            $data['start_time'] = $start->format('Y-m-d H:i:s');
            $data['end_time'] = (clone $start)->addHours($duration)->format('Y-m-d H:i:s');
        }

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Buang field yang bukan kolom database agar tidak Error 1054
        $duration = $data['duration'] ?? null;
        unset($data['duration']);
        unset($data['start_time_display']);

        // Paksa simpan menggunakan model
        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}