<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\FaqItem;
use App\Models\PageView;
use App\Models\ProductHighlight;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected function getPollingInterval(): ?string
    {
        return '60s';
    }

    protected function getStats(): array
    {
        $todayViews = PageView::today()->count();
        $yesterdayViews = PageView::whereDate('created_at', today()->subDay())->count();
        $viewsTrend = $yesterdayViews > 0
            ? round((($todayViews - $yesterdayViews) / $yesterdayViews) * 100, 1)
            : ($todayViews > 0 ? 100 : 0);

        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $totalMessages = ContactMessage::count();

        return [
            Stat::make('Page Views Today', number_format($todayViews))
                ->description($viewsTrend >= 0 ? "+{$viewsTrend}% from yesterday" : "{$viewsTrend}% from yesterday")
                ->descriptionIcon($viewsTrend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($viewsTrend >= 0 ? 'success' : 'danger')
                ->chart(array_column(PageView::getDailyStats(7), 'views')),

            Stat::make('Active Visitors', PageView::activeNow()->distinct('session_id')->count('session_id'))
                ->description('In the last 5 minutes')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Unread Messages', $unreadMessages)
                ->description("of {$totalMessages} total")
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unreadMessages > 0 ? 'warning' : 'success'),
        ];
    }
}
