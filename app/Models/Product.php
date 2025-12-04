<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'name',
        'category',
        'excerpt',
        'hero_image',
        'secondary_image',
        'gallery',
        'description',
        'key_points',
        'sourcing',
        'availability',
    ];

    protected $casts = [
        'gallery' => 'array',
        'key_points' => 'array',
        'sourcing' => 'array',
        'availability' => 'array',
    ];
}
