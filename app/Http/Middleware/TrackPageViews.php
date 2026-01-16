<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViews
{
    /**
     * Paths to exclude from tracking
     */
    protected array $excludedPaths = [
        'adminPanel*',
        'livewire*',
        'storage*',
        '_debugbar*',
        'api/*',
        'sanctum/*',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        $response = $next($request);

        // Skip excluded paths
        foreach ($this->excludedPaths as $pattern) {
            if ($request->is($pattern)) {
                return $response;
            }
        }

        // Skip non-GET requests and AJAX
        if (!$request->isMethod('GET') || $request->ajax()) {
            return $response;
        }

        // Calculate response time
        $responseTime = (int) ((microtime(true) - $startTime) * 1000);

        // Log the page view
        try {
            PageView::create([
                'path' => substr($request->path(), 0, 500),
                'ip_address' => $request->ip(),
                'user_agent' => substr($request->userAgent() ?? '', 0, 500),
                'referrer' => substr($request->header('referer') ?? '', 0, 500),
                'session_id' => session()->getId(),
                'response_time_ms' => $responseTime,
            ]);
        } catch (\Exception $e) {
            // Silently fail - don't break the app for analytics
            \Log::debug('PageView tracking failed: ' . $e->getMessage());
        }

        return $response;
    }
}
