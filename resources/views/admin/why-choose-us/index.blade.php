@extends('admin.layout')

@section('title', 'Why Choose Us')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Why Choose Us</h2>
    <a href="{{ route('admin.why-choose-us.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Feature
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Badge</th>
                        <th>Heading</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($features as $feature)
                        <tr>
                            <td>{{ $feature->id }}</td>
                            <td>{{ $feature->title }}</td>
                            <td>{{ $feature->badge_text ?? '-' }}</td>
                            <td>{{ Str::limit($feature->heading, 30) }}</td>
                            <td>{{ $feature->sort_order }}</td>
                            <td>
                                @if($feature->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.why-choose-us.edit', $feature) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.why-choose-us.destroy', $feature) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                            <td colspan="7" class="text-center py-4">No features found. <a href="{{ route('admin.why-choose-us.create') }}">Add one</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

