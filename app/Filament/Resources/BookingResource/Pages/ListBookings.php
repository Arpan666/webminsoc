<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\DatePicker;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            
            Actions\Action::make('printReport')
                ->label('Cetak Laporan')
                ->color('info')
                ->icon('heroicon-o-printer')
                ->form([
                    DatePicker::make('start_date')
                        ->label('Dari Tanggal')
                        ->required(),
                    DatePicker::make('end_date')
                        ->label('Sampai Tanggal')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $bookings = Booking::with(['user', 'field'])
                        ->where('status', 'confirmed')
                        ->whereBetween('start_time', [
                            $data['start_date'] . ' 00:00:00',
                            $data['end_date'] . ' 23:59:59'
                        ])
                        ->get();

                    $pdf = Pdf::loadView('admin.reports.booking-pdf', [
                        'bookings' => $bookings,
                        'startDate' => $data['start_date'],
                        'endDate' => $data['end_date'],
                    ]);

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, "Laporan_Keuangan_{$data['start_date']}.pdf");
                }),
        ];
    }
}