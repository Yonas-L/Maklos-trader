<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'color_scheme',
        'position',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the CSS classes for this service's color scheme.
     */
    public function getColorClassesAttribute(): array
    {
        $schemes = [
            'blue' => [
                'bg' => 'bg-blue-50',
                'text' => 'text-blue-600',
                'hover_bg' => 'group-hover:bg-blue-600',
                'border' => 'hover:border-blue-200',
                'dot' => 'bg-blue-500',
            ],
            'teal' => [
                'bg' => 'bg-teal-50',
                'text' => 'text-teal-600',
                'hover_bg' => 'group-hover:bg-teal-600',
                'border' => 'hover:border-teal-200',
                'dot' => 'bg-teal-500',
            ],
            'indigo' => [
                'bg' => 'bg-indigo-50',
                'text' => 'text-indigo-600',
                'hover_bg' => 'group-hover:bg-indigo-600',
                'border' => 'hover:border-indigo-200',
                'dot' => 'bg-indigo-500',
            ],
            'cyan' => [
                'bg' => 'bg-cyan-50',
                'text' => 'text-cyan-600',
                'hover_bg' => 'group-hover:bg-cyan-600',
                'border' => 'hover:border-cyan-200',
                'dot' => 'bg-cyan-500',
            ],
        ];

        return $schemes[$this->color_scheme] ?? $schemes['blue'];
    }

    /**
     * Get the position classes for desktop layout.
     */
    public function getPositionClassesAttribute(): string
    {
        $positions = [
            'top-left' => 'lg:top-10 lg:left-10',
            'top-right' => 'lg:top-10 lg:right-10',
            'bottom-left' => 'lg:bottom-10 lg:left-10',
            'bottom-right' => 'lg:bottom-10 lg:right-10',
        ];

        // Normalize string to handle cases where Label might be saved instead of Key
        // e.g., 'Top Right' -> 'top-right'
        $key = \Illuminate\Support\Str::slug($this->position ?? 'top-left');

        return $positions[$key] ?? $positions['top-left'];
    }

    /**
     * Get the dot position classes based on service position.
     */
    public function getDotPositionAttribute(): string
    {
        $dotPositions = [
            'top-left' => 'bottom-8 -right-2',
            'top-right' => 'bottom-8 -left-2',
            'bottom-left' => 'top-8 -right-2',
            'bottom-right' => 'top-8 -left-2',
        ];

        $key = \Illuminate\Support\Str::slug($this->position ?? 'top-left');

        return $dotPositions[$key] ?? 'bottom-8 -right-2';
    }
}
