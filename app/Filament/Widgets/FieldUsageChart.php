<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class FieldUsageChart extends ChartWidget
{
    protected static ?string $heading = 'Lapangan Terlaris';
    protected int | string | array $columnSpan = ['md' => 1];
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $results = Booking::whereIn('status', ['completed', 'confirmed'])
            ->select('field_id', DB::raw('count(*) as total'))
            ->groupBy('field_id')
            ->with('field')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Sewa',
                    'data' => $results->pluck('total')->toArray(),
                    'backgroundColor' => ['#fbbf24', '#34d399', '#60a5fa'],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => $results->map(fn($item) => $item->field->name)->toArray(),
        ];
    }

    protected function getType(): string { return 'doughnut'; }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => ['display' => false],
                'y' => ['display' => false],
            ],
            'plugins' => [
                'legend' => ['position' => 'bottom'],
            ],
        ];
    }
}