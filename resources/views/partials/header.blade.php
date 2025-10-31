<!-- Header Start -->
<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('home') }}">
                @if($headerLogo)
                    <img src="{{ asset('storage/' . $headerLogo) }}" alt="Logo">
                @else
                    <img src="{{ asset('images/logo.webp') }}" alt="Logo">
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <span class="toggle-wrap">
                        <span class="toggle-bar"></span>
                    </span>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @foreach($headerMenus as $menu)
                        <li class="nav-item {{ $menu->children->count() > 0 ? 'has_dropdown' : '' }}">
                            <a class="nav-link" href="{{ $menu->url && $menu->url != '#' ? $menu->url : '#' }}">
                                {{ $menu->label }}
                            </a>
                            @if($menu->children->count() > 0)
                                <span class="drp_btn"><i class="icofont-rounded-down"></i></span>
                                <div class="sub_menu">
                                    <ul>
                                        @foreach($menu->children as $child)
                                            <li><a href="{{ $child->url ? $child->url : '#' }}">{{ $child->label }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <div class="btn_block">
                            <a class="nav-link dark_btn" href="{{ $headerCta['url'] }}">{{ $headerCta['text'] }}</a>
                            <div class="btn_bottom"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- Header End -->

