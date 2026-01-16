<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\Widget;

class LiveVisitorsWidget extends Widget
{
    protected static string $view = 'filament.widgets.live-visitors-widget';

    protected static ?int $sort = 0; // First widget

    protected int|string|array $columnSpan = 'full';

    protected function getPollingInterval(): ?string
    {
        return '10s'; // Update every 10 seconds for near real-time
    }

    public function getVisitorData(): array
    {
        // Active in last 5 minutes
        $activeVisitors = PageView::activeNow()
            ->distinct('session_id')
            ->count('session_id');

        // Get visitor trend (last hour, 10-min intervals)
        $trend = [];
        for ($i = 5; $i >= 0; $i--) {
            $start = now()->subMinutes(($i + 1) * 10);
            $end = now()->subMinutes($i * 10);
            $trend[] = PageView::whereBetween('created_at', [$start, $end])
                ->distinct('session_id')
                ->count('session_id');
        }

        // Performance Metrics
        $avgResponseTime = PageView::today()->avg('response_time_ms') ?? 0;
        $totalRequests = PageView::today()->count();

        $status = 'Good';
        $statusColor = 'success';
        if ($avgResponseTime > 500) {
            $status = 'Moderate';
            $statusColor = 'warning';
        }
        if ($avgResponseTime > 1000) {
            $status = 'Slow';
            $statusColor = 'danger';
        }

        return [
            'active' => $activeVisitors,
            'trend' => $trend,
            'peakToday' => $this->getPeakVisitors(),
            'avgResponseTime' => round($avgResponseTime),
            'totalRequests' => $totalRequests,
            'status' => $status,
            'statusColor' => $statusColor,
        ];
    }

    protected function getPeakVisitors(): int
    {
        // Estimate peak by checking hourly maximums
        $peak = 0;
        for ($h = 0; $h <= now()->hour; $h++) {
            $count = PageView::whereDate('created_at', today())
                ->whereTime('created_at', '>=', sprintf('%02d:00:00', $h))
                ->whereTime('created_at', '<', sprintf('%02d:00:00', $h + 1))
                ->distinct('session_id')
                ->count('session_id');
            $peak = max($peak, $count);
        }
        return $peak;
    }
}
