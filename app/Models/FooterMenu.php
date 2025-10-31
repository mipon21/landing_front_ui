<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_type',
        'label',
        'url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Scope: Get menus by type
    public function scopeOfType($query, $type)
    {
        return $query->where('menu_type', $type);
    }

    // Scope: Get active menus
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}