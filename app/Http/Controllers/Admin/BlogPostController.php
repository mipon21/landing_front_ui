<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->get();
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'category' => 'nullable|string|max:255',
            'is_editor_choice' => 'boolean',
            'is_published' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        BlogPost::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully!');
    }

    public function edit(BlogPost $blogPost)
    {
        return view('admin.blog.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug,' . $blogPost->id,
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'category' => 'nullable|string|max:255',
            'is_editor_choice' => 'boolean',
            'is_published' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($blogPost->featured_image) {
                Storage::disk('public')->delete($blogPost->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $blogPost->update($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated successfully!');
    }

    public function destroy(BlogPost $blogPost)
    {
        if ($blogPost->featured_image) {
            Storage::disk('public')->delete($blogPost->featured_image);
        }
        $blogPost->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted successfully!');
    }
}

