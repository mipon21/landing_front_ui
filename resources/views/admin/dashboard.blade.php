@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard</h2>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Testimonials</h5>
                <h2 class="card-text">{{ $stats['testimonials'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Dishes</h5>
                <h2 class="card-text">{{ $stats['dishes'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Statistics</h5>
                <h2 class="card-text">{{ $stats['statistics'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Restaurant Logos</h5>
                <h2 class="card-text">{{ $stats['restaurant_logos'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-secondary">
            <div class="card-body">
                <h5 class="card-title">Why Choose Us</h5>
                <h2 class="card-text">{{ $stats['why_choose_us'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h5 class="card-title">Services</h5>
                <h2 class="card-text">{{ $stats['services'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white" style="background-color: #6c757d;">
            <div class="card-body">
                <h5 class="card-title">How It Works</h5>
                <h2 class="card-text">{{ $stats['how_it_works'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Quick Links</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <a href="{{ route('admin.hero.edit') }}" class="btn btn-outline-primary w-100">
                    <i class="bi bi-star me-2"></i>Edit Hero Section
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('admin.statistics.index') }}" class="btn btn-outline-success w-100">
                    <i class="bi bi-bar-chart me-2"></i>Manage Statistics
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('admin.how-it-works.index') }}" class="btn btn-outline-info w-100">
                    <i class="bi bi-list-ol me-2"></i>Manage How It Works
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

