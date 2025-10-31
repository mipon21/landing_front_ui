@extends('admin.layout')

@section('title', 'Statistics')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Statistics</h2>
    <a href="{{ route('admin.statistics.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Value</th>
                    <th>Suffix</th>
                    <th>Label</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($statistics as $statistic)
                    <tr>
                        <td>
                            @if($statistic->icon)
                                <img src="{{ asset('storage/' . $statistic->icon) }}" alt="Icon" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <span class="text-muted">No icon</span>
                            @endif
                        </td>
                        <td>{{ $statistic->value }}</td>
                        <td>{{ $statistic->suffix }}</td>
                        <td>{{ $statistic->label }}</td>
                        <td>{{ $statistic->sort_order }}</td>
                        <td>
                            @if($statistic->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.statistics.edit', $statistic) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.statistics.destroy', $statistic) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                        <td colspan="7" class="text-center">No statistics found. <a href="{{ route('admin.statistics.create') }}">Create one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

