<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_content_id',
        'type',
        'title',
        'badge',
        'summary',
        'details',
        'accent_color',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'details' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'about_content_id' => 'integer',
    ];

    public function aboutContent()
    {
        return $this->belongsTo(AboutContent::class);
    }
}
