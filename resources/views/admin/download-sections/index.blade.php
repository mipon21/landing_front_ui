@extends('admin.layout')

@section('title', 'Download Sections')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Download Sections</h2>
    <a href="{{ route('admin.download-sections.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Section
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Heading</th>
                        <th>Badge</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sections as $section)
                        <tr>
                            <td>{{ $section->id }}</td>
                            <td>
                                <span class="badge {{ $section->section_type === 'download' ? 'bg-primary' : 'bg-success' }}">
                                    {{ ucfirst($section->section_type) }}
                                </span>
                            </td>
                            <td>{{ Str::limit($section->heading, 40) }}</td>
                            <td>{{ $section->badge_text ?? '-' }}</td>
                            <td>
                                @if($section->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.download-sections.edit', $section->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.download-sections.destroy', $section->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No sections found. <a href="{{ route('admin.download-sections.create') }}">Add one</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

