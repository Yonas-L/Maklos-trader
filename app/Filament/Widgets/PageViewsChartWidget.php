<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;

class PageViewsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Page Views (Last 7 Days)';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $stats = PageView::getDailyStats(7);

        return [
            'datasets' => [
                [
                    'label' => 'Total Views',
                    'data' => array_column($stats, 'views'),
                    'borderColor' => '#14B8A6', // Teal
                    'backgroundColor' => 'rgba(20, 184, 166, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Unique Visitors',
                    'data' => array_column($stats, 'unique'),
                    'borderColor' => '#8B5CF6', // Purple
                    'backgroundColor' => 'rgba(139, 92, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => array_map(function ($stat) {
                return date('D j', strtotime($stat['date']));
            }, $stats),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false, // Hide legend for minimal look
                ],
            ],
            'scales' => [
                'y' => [
                    'display' => false, // Hide Y axis
                    'beginAtZero' => true,
                ],
                'x' => [
                    'grid' => [
                        'display' => false, // Hide X grid
                    ],
                ],
            ],
            'maintainAspectRatio' => false,
        ];
    }
}
