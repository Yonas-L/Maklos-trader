<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManufacturingStep extends Model
{
    protected $fillable = [
        'step_number',
        'badge',
        'title',
        'description',
        'features',
        'image_path',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];
}
