<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'label',
        'url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Relationship: Get parent menu
    public function parent()
    {
        return $this->belongsTo(HeaderMenu::class, 'parent_id');
    }

    // Relationship: Get child menus (submenus)
    public function children()
    {
        return $this->hasMany(HeaderMenu::class, 'parent_id')->orderBy('sort_order');
    }

    // Scope: Get only top-level menus (no parent)
    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    // Scope: Get active menus
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
