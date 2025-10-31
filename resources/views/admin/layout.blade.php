<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Landing CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
        }
        .sidebar a {
            color: #ecf0f1;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #34495e;
            color: #fff;
        }
        .navbar-brand {
            font-weight: bold;
            color: #ecf0f1 !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-3">
                    <h5 class="navbar-brand mb-4">Landing CMS</h5>
                </div>
                <nav class="nav flex-column">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.hero.edit') }}" class="nav-link {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
                        <i class="bi bi-star me-2"></i> Hero Section
                    </a>
                    <a href="{{ route('admin.statistics.index') }}" class="nav-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                        <i class="bi bi-bar-chart me-2"></i> Statistics
                    </a>
                    <a href="{{ route('admin.restaurant-logos.index') }}" class="nav-link {{ request()->routeIs('admin.restaurant-logos.*') ? 'active' : '' }}">
                        <i class="bi bi-building me-2"></i> Restaurant Logos
                    </a>
                    <a href="{{ route('admin.dishes.index') }}" class="nav-link {{ request()->routeIs('admin.dishes.*') ? 'active' : '' }}">
                        <i class="bi bi-cup-hot me-2"></i> Dishes
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                        <i class="bi bi-chat-left-text me-2"></i> Testimonials
                    </a>
                    <a href="{{ route('admin.why-choose-us.index') }}" class="nav-link {{ request()->routeIs('admin.why-choose-us.*') ? 'active' : '' }}">
                        <i class="bi bi-question-circle me-2"></i> Why Choose Us
                    </a>
                    <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i class="bi bi-gear me-2"></i> Services
                    </a>
                    <a href="{{ route('admin.how-it-works.index') }}" class="nav-link {{ request()->routeIs('admin.how-it-works.*') ? 'active' : '' }}">
                        <i class="bi bi-list-ol me-2"></i> How It Works
                    </a>
                    <a href="{{ route('admin.download-sections.index') }}" class="nav-link {{ request()->routeIs('admin.download-sections.*') ? 'active' : '' }}">
                        <i class="bi bi-download me-2"></i> Download Sections
                    </a>
                    <a href="{{ route('admin.about-pages.index') }}" class="nav-link {{ request()->routeIs('admin.about-pages.*') ? 'active' : '' }}">
                        <i class="bi bi-file-text me-2"></i> About Page
                    </a>
                    <a href="{{ route('admin.contact-pages.index') }}" class="nav-link {{ request()->routeIs('admin.contact-pages.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope me-2"></i> Contact Page
                    </a>
                    <a href="{{ route('admin.privacy-policy.index') }}" class="nav-link {{ request()->routeIs('admin.privacy-policy.*') ? 'active' : '' }}">
                        <i class="bi bi-shield-lock me-2"></i> Privacy Policy
                    </a>
                    <a href="{{ route('admin.terms.index') }}" class="nav-link {{ request()->routeIs('admin.terms.*') ? 'active' : '' }}">
                        <i class="bi bi-file-text me-2"></i> Terms & Conditions
                    </a>
                    <hr class="text-light">
                    <h6 class="px-3 py-2 text-light text-uppercase small">Settings</h6>
                    <a href="{{ route('admin.settings.general.index') }}" class="nav-link {{ request()->routeIs('admin.settings.general.*') ? 'active' : '' }}">
                        <i class="bi bi-gear me-2"></i> General
                    </a>
                    <a href="{{ route('admin.settings.header.index') }}" class="nav-link {{ request()->routeIs('admin.settings.header.*') ? 'active' : '' }}">
                        <i class="bi bi-header me-2"></i> Header
                    </a>
                    <a href="{{ route('admin.settings.footer.index') }}" class="nav-link {{ request()->routeIs('admin.settings.footer.*') ? 'active' : '' }}">
                        <i class="bi bi-layout-bottom me-2"></i> Footer
                    </a>
                    <hr class="text-light">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <div class="p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>

