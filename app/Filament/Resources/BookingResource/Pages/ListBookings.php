<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Set;
use Illuminate\Support\Carbon;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            
            Actions\Action::make('cetak_laporan')
                ->label('Cetak Laporan')
                ->icon('heroicon-o-printer')
                ->color('info')
                ->modalHeading('Cetak Laporan Pendapatan')
                ->modalSubmitActionLabel('Cetak PDF')
                ->form([
                    // Pilihan Bulan Cepat
                    Select::make('pilihan_bulan')
                        ->label('Pilih Bulan Cepat')
                        ->options([
                            'this_month' => 'Bulan Ini',
                            'last_month' => 'Bulan Lalu',
                            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                            '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
                        ])
                        ->placeholder('Pilih bulan...')
                        ->live()
                        ->afterStateUpdated(function (Set $set, $state) {
                            if (!$state) return;
                            
                            $start = now();
                            $end = now();

                            if ($state === 'this_month') {
                                $start = now()->startOfMonth();
                                $end = now()->endOfMonth();
                            } elseif ($state === 'last_month') {
                                $start = now()->subMonth()->startOfMonth();
                                $end = now()->subMonth()->endOfMonth();
                            } else {
                                // Mengambil tahun sekarang berdasarkan bulan yang dipilih
                                $start = Carbon::create(now()->year, (int)$state, 1)->startOfMonth();
                                $end = (clone $start)->endOfMonth();
                            }

                            $set('dari_tanggal', $start->format('Y-m-d'));
                            $set('sampai_tanggal', $end->format('Y-m-d'));
                        }),

                    Grid::make(2)
                        ->schema([
                            DatePicker::make('dari_tanggal')
                                ->label('Dari Tanggal')
                                ->required()
                                ->native(false),
                            DatePicker::make('sampai_tanggal')
                                ->label('Sampai Tanggal')
                                ->required()
                                ->native(false),
                        ]),
                ])
                ->action(function (array $data) {
                    // Mengirim parameter ke route cetak
                    return redirect()->route('bookings.report.print', [
                        'start' => $data['dari_tanggal'],
                        'end' => $data['sampai_tanggal'],
                    ]);
                }),
        ];
    }
}