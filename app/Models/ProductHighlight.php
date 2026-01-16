<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHighlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'title',
        'description',
        'slug',
        'image_path',
        'price',
        'weight',
        'source',
        'benefits',
        'in_stock',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'in_stock' => 'boolean',
        'benefits' => 'array',
    ];
}
