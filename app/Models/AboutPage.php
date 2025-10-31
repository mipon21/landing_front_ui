<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_type',
        'badge_text',
        'heading',
        'description',
        'image',
        'video_url',
        'features',
        'statistics',
        'button_text',
        'button_url',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'statistics' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

