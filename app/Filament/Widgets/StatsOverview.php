<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    // Agar statistik otomatis update (opsional)
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            // 1. Statistik Pesanan Masuk Hari Ini
            Stat::make('Booking Hari Ini', Booking::whereDate('start_time', today())->count())
                ->description('Total jadwal main hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),

            // 2. Statistik Verifikasi Pembayaran (Paling Penting!)
            Stat::make('Perlu Verifikasi', Booking::where('status', 'pending_verification')->count())
                ->description('Ada member yang sudah upload bukti bayar')
                ->descriptionIcon('heroicon-m-clock')
                ->color(Booking::where('status', 'pending_verification')->exists() ? 'danger' : 'gray'),

            // 3. Omzet Bulan Ini (Lunas)
            Stat::make('Omset Bulan Ini', 'Rp ' . number_format(
                Booking::whereIn('status', ['completed','confirmed'])
                    ->whereMonth('start_time', now()->month)
                    ->sum('total_price'), 
                0, ',', '.'
            ))
                ->description('Total pendapatan yang sudah lunas')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }
}