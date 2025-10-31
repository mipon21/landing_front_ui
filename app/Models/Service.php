<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'badge_text',
        'heading',
        'description',
        'image',
        'button_text',
        'button_url',
        'features',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRestaurant($query)
    {
        return $query->where('type', 'restaurant');
    }

    public function scopeCustomer($query)
    {
        return $query->where('type', 'customer');
    }
}

