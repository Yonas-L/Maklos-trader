<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'button_primary_label',
        'button_primary_url',
        'button_secondary_label',
        'button_secondary_url',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
        'show_social_icons',
        'is_active',
    ];
}
