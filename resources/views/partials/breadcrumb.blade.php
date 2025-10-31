<!-- BredCrumb-Section -->
<div class="bred_crumb">
    <div class="container">
        <span class="banner_shape1"><img src="{{ asset('images/banner-shape1.webp') }}" alt="image"></span>
        <span class="banner_shape2"><img src="{{ asset('images/banner-shape2.webp') }}" alt="image"></span>
        <div class="bred_text">
            <h1>@yield('page-title', 'Page Title')</h1>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>»</span></li>
                <li>@yield('page-title', 'Page')</li>
            </ul>
        </div>
    </div>
</div>

