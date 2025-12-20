<?php

namespace App\Filament\Resources\InboxResource\Pages;

use App\Filament\Resources\InboxResource;
use Filament\Resources\Pages\ListRecords;

class ListInboxes extends ListRecords
{
    protected static string $resource = InboxResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    // Refresh data otomatis setiap 3 detik
    protected function getPollingInterval(): ?string
    {
        return '3s';
    }
}