@extends('admin.layout')

@section('title', 'Blog Posts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Blog Posts</h2>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Published</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" style="width: 80px; height: 60px; object-fit: cover;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $post->title }}</strong>
                            @if($post->is_editor_choice)
                                <span class="badge bg-warning">Editor's Choice</span>
                            @endif
                        </td>
                        <td>{{ $post->author }}</td>
                        <td>{{ $post->category ?? 'N/A' }}</td>
                        <td>{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Not set' }}</td>
                        <td>
                            @if($post->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No blog posts found. <a href="{{ route('admin.blog.create') }}">Create one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

