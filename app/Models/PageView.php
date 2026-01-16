<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'path',
        'ip_address',
        'user_agent',
        'referrer',
        'session_id',
        'response_time_ms',
    ];

    /**
     * Scope: Views from today
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope: Views from last 7 days
     */
    public function scopeLastWeek($query)
    {
        return $query->where('created_at', '>=', now()->subDays(7));
    }

    /**
     * Scope: Active sessions (last 5 minutes)
     */
    public function scopeActiveNow($query)
    {
        return $query->where('created_at', '>=', now()->subMinutes(5));
    }

    /**
     * Scope: Unique visitors by session
     */
    public function scopeUniqueVisitors($query)
    {
        return $query->distinct('session_id');
    }

    /**
     * Get daily view counts for the last N days
     */
    public static function getDailyStats(int $days = 7): array
    {
        $stats = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $stats[] = [
                'date' => $date,
                'views' => self::whereDate('created_at', $date)->count(),
                'unique' => self::whereDate('created_at', $date)->distinct('session_id')->count('session_id'),
            ];
        }
        return $stats;
    }

    /**
     * Get average response time
     */
    public static function avgResponseTime(): float
    {
        return (float) self::today()->whereNotNull('response_time_ms')->avg('response_time_ms') ?? 0;
    }

    /**
     * Get slow pages (>1 second)
     */
    public static function getSlowPages(int $limit = 5): \Illuminate\Support\Collection
    {
        return self::where('response_time_ms', '>', 1000)
            ->today()
            ->orderByDesc('response_time_ms')
            ->limit($limit)
            ->get(['path', 'response_time_ms', 'created_at']);
    }
}
