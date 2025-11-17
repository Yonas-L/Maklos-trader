<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqItem extends Model
{
    protected $fillable = [
        'category',
        'question',
        'answer',
        'sort_order',
        'is_active',
    ];
}
