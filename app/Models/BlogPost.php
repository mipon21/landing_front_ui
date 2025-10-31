<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author',
        'published_at',
        'comment_count',
        'category',
        'is_editor_choice',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_editor_choice' => 'boolean',
        'is_published' => 'boolean',
        'comment_count' => 'integer',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeEditorChoice($query)
    {
        return $query->where('is_editor_choice', true);
    }
}

