<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;

class IncomeChart extends ChartWidget
{
    protected static ?string $heading = 'Tren Pendapatan (Lunas)';
    protected static string $color = 'success';
    protected int | string | array $columnSpan = ['md' => 1];
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = [];
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $sum = Booking::whereIn('status', ['completed', 'confirmed'])
                ->whereDate('start_time', $date)
                ->sum('total_price');
            $data[] = $sum;
            $labels[] = $date->translatedFormat('d M');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan (Rp)',
                    'data' => $data,
                    'fill' => 'start',
                    'tension' => 0.4,
                    'backgroundColor' => 'rgba(52, 211, 153, 0.1)',
                    'borderColor' => '#34d399',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string { return 'line'; }
}