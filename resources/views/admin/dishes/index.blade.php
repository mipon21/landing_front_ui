@extends('admin.layout')

@section('title', 'Dishes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dishes</h2>
    <a href="{{ route('admin.dishes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            @forelse($dishes as $dish)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $dish->image) }}" class="card-img-top" alt="{{ $dish->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">{{ $dish->name ?? 'Untitled' }}</h6>
                            <p class="card-text small text-muted">Order: {{ $dish->sort_order }}</p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.dishes.destroy', $dish) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p>No dishes found. <a href="{{ route('admin.dishes.create') }}">Add one</a></p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

