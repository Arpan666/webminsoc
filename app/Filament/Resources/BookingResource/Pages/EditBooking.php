<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBooking extends EditRecord
{
    protected static string $resource = BookingResource::class;

    // Menghilangkan aksi dari header halaman (tempat default tombol delete berada)
    protected function getHeaderActions(): array
    {
        return []; 
    }

    // Menambahkan aksi ke bagian bawah form (tempat tombol Save changes dan Cancel berada)
    protected function getFormActions(): array
    {
        $formActions = parent::getFormActions();

        // Tombol DELETE
        $deleteAction = Actions\DeleteAction::make()
            ->color('danger')
            ->modalHeading('Hapus Pemesanan')
            ->modalSubheading('Apakah Anda yakin ingin menghapus pemesanan ini secara permanen? Tindakan ini tidak dapat dibatalkan.')
            ->label('Delete');

        // Tambahkan tombol Delete ke Form Actions
        $formActions[] = $deleteAction;

        return $formActions;
    }
}