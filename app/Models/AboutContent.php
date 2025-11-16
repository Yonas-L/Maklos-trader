<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'experience_years',
        'label',
        'headline',
        'description',
        'mission_title',
        'mission_description',
        'vision_title',
        'vision_description',
        'values_title',
        'values_description',
    ];

    protected $casts = [
        'experience_years' => 'integer',
    ];

    public function values()
    {
        return $this->hasMany(AboutValue::class)->orderBy('sort_order');
    }

    public function scopeLatestContent($query)
    {
        return $query->orderByDesc('id');
    }
}
