@extends('admin.layout')

@section('title', 'Restaurant Logos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Restaurant Logos</h2>
    <a href="{{ route('admin.restaurant-logos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Alt Text</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logos as $logo)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $logo->logo_image) }}" alt="{{ $logo->alt_text }}" style="width: 100px; height: auto; max-height: 60px; object-fit: contain;">
                        </td>
                        <td>{{ $logo->alt_text ?? 'N/A' }}</td>
                        <td>{{ $logo->sort_order }}</td>
                        <td>
                            @if($logo->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.restaurant-logos.edit', $logo) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.restaurant-logos.destroy', $logo) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                        <td colspan="5" class="text-center">No logos found. <a href="{{ route('admin.restaurant-logos.create') }}">Add one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

