<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'typed_texts',
        'heading',
        'description',
        'hero_image',
        'background_image',
        'google_play_url',
        'app_store_url',
        'google_play_image',
        'app_store_image',
        'video_url',
        'active_users_text',
        'rating_text',
        'user_avatars',
        'is_active',
    ];

    protected $casts = [
        'typed_texts' => 'array',
        'user_avatars' => 'array',
        'is_active' => 'boolean',
    ];

    public static function getActive()
    {
        return static::where('is_active', true)->first() ?? new static();
    }
}

