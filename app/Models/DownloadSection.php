<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge_text',
        'heading',
        'description',
        'promo_text',
        'google_play_url',
        'app_store_url',
        'button_text',
        'button_url',
        'left_image',
        'right_image',
        'mobile_image',
        'section_type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeDownload($query)
    {
        return $query->where('section_type', 'download');
    }

    public function scopeRegister($query)
    {
        return $query->where('section_type', 'register');
    }
}

