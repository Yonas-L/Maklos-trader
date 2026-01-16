<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\File;

class ErrorLogWidget extends Widget
{
    protected static string $view = 'filament.widgets.error-log-widget';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 1;

    protected function getPollingInterval(): ?string
    {
        return '30s';
    }

    public function getRecentErrors(): array
    {
        $logFile = storage_path('logs/laravel.log');

        if (!File::exists($logFile)) {
            return [];
        }

        $content = File::get($logFile);
        $lines = explode("\n", $content);

        $errors = [];
        $errorCount = 0;
        $maxErrors = 5;

        // Parse from end of file for recent errors
        for ($i = count($lines) - 1; $i >= 0 && $errorCount < $maxErrors; $i--) {
            $line = $lines[$i];

            // Match Laravel log format
            if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\].*\.(ERROR|CRITICAL|ALERT|EMERGENCY): (.+)/', $line, $matches)) {
                $errors[] = [
                    'time' => $matches[1],
                    'level' => $matches[2],
                    'message' => \Illuminate\Support\Str::limit($matches[3], 80),
                ];
                $errorCount++;
            }
        }

        return $errors;
    }

    public function getErrorStats(): array
    {
        $logFile = storage_path('logs/laravel.log');

        if (!File::exists($logFile)) {
            return ['total' => 0, 'critical' => 0];
        }

        $content = File::get($logFile);
        $today = now()->toDateString();

        // Count today's errors
        preg_match_all('/\[' . preg_quote($today) . '.*\.(ERROR|CRITICAL|ALERT|EMERGENCY):/', $content, $matches);
        $total = count($matches[0]);

        preg_match_all('/\[' . preg_quote($today) . '.*\.(CRITICAL|ALERT|EMERGENCY):/', $content, $criticalMatches);
        $critical = count($criticalMatches[0]);

        return [
            'total' => $total,
            'critical' => $critical,
        ];
    }
}
