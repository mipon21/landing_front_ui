<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $siteDescription }}">
    <title>{{ $siteName }}</title>
    
    @if($siteFavicon)
        @php
            // Ensure the path doesn't have duplicate storage/ prefix
            $faviconPath = str_replace('storage/', '', $siteFavicon);
            $faviconUrl = asset('storage/' . $faviconPath);
            
            // Use file modification time for cache busting
            $faviconFile = storage_path('app/public/' . $faviconPath);
            $faviconTimestamp = file_exists($faviconFile) ? filemtime($faviconFile) : time();
            
            // Determine MIME type based on file extension
            $extension = strtolower(pathinfo($faviconPath, PATHINFO_EXTENSION));
            $mimeTypes = [
                'ico' => 'image/x-icon',
                'png' => 'image/png',
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'gif' => 'image/gif',
            ];
            $mimeType = $mimeTypes[$extension] ?? 'image/x-icon';
        @endphp
        <link rel="icon" type="{{ $mimeType }}" href="{{ $faviconUrl }}?v={{ $faviconTimestamp }}">
        <link rel="shortcut icon" type="{{ $mimeType }}" href="{{ $faviconUrl }}?v={{ $faviconTimestamp }}">
        <link rel="apple-touch-icon" href="{{ $faviconUrl }}?v={{ $faviconTimestamp }}">
    @else
        <link rel="shortcut icon" href="{{ asset('images/favicon.webp') }}" type="image/x-icon">
        <link rel="icon" type="image/webp" href="{{ asset('images/favicon.webp') }}">
    @endif

    <!-- icofont-css-link -->
    <link rel="stylesheet" href="{{ asset('css/icofont.min.css') }}">
    <!-- Owl-Carosal-Style-link -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <!-- Bootstrap-Style-link -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Aos-Style-link -->
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <!-- Coustome-Style-link -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive-Style-link -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <!-- font 1 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <!-- font 2 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="loader"></div>
    </div>

    @include('partials.header')

    <!-- Banner-Section-Start -->
    <section class="banner_section" id="home_sec">
        <!-- hero bg -->
        @if($hero && $hero->background_image)
        <div class="hero_bg">
            <img src="{{ asset('storage/' . $hero->background_image) }}" alt="image">
        </div>
        @else
        <div class="hero_bg">
            <img src="{{ asset('images/hero_bg.webp') }}" alt="image">
        </div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12" data-aos="fade-up" data-aos-duration="1500">
                    <div class="banner_text">
                        <!-- typed text -->
                        <div class="type-wrap">
                            <span id="typed" style="white-space:pre;" class="typed"></span>
                        </div>
                        <!-- h1 -->
                        <h1>
                            @if($hero && $hero->heading)
                                {!! $hero->heading !!}
                            @else
                                Fast & best <span> food delivery </span> services in your town
                            @endif
                        </h1>
                        <!-- p -->
                        <p>
                            @if($hero && $hero->description)
                                {{ $hero->description }}
                            @else
                                We commit to delivering your food to you within 30 minutes. if we would fail, we will give the food free.
                            @endif
                        </p>
                    </div>

                    <!-- users -->
                    <div class="used_app">
                        <ul>
                            @if($hero && $hero->user_avatars && count($hero->user_avatars) > 0)
                                @foreach($hero->user_avatars as $avatar)
                                    <li><img src="{{ asset('images/' . $avatar) }}" alt="image"></li>
                                @endforeach
                            @else
                                <li><img src="{{ asset('images/banavt1.webp') }}" alt="image"></li>
                                <li><img src="{{ asset('images/banavt2.webp') }}" alt="image"></li>
                                <li><img src="{{ asset('images/banavt3.webp') }}" alt="image"></li>
                            @endif
                            @if($hero && $hero->video_url)
                            <li>
                                <a href="#" class="popup-youtube play-button" data-url="{{ $hero->video_url }}" data-toggle="modal" data-target="#myModal">
                                    <img src="{{ asset('images/play.webp') }}" alt="img">
                                </a>
                            </li>
                            @endif
                        </ul>
                        <p>
                            @if($hero && $hero->active_users_text)
                                {{ $hero->active_users_text }}
                            @else
                                25k + Active users
                            @endif
                            <br>
                            <span>
                                <i class="icofont-star"></i>
                                @if($hero && $hero->rating_text)
                                    {{ $hero->rating_text }}
                                @else
                                    4.5 / 5.0 ( 20k + Reviews)
                                @endif
                            </span>
                        </p>
                    </div>

                    <!-- Search Section -->
                    @if($hero && ($hero->show_search_section ?? false))
                    <div class="hero_search_section">
                        <form action="{{ $hero->search_section_button_url ?? '#' }}" method="GET" class="hero_search_form">
                            <div class="search_input_wrapper">
                                <input 
                                    type="text" 
                                    name="location" 
                                    id="hero_location_input"
                                    class="form-control hero_location_input" 
                                    placeholder="{{ $hero->search_section_placeholder ?? 'Enter your location' }}"
                                >
                                <button 
                                    type="button" 
                                    class="locate_me_btn" 
                                    onclick="getUserLocation()"
                                >
                                    <i class="icofont-location-pin"></i>
                                    <span class="locate_me_text">{{ $hero->search_section_locate_button_text ?? 'Locate me' }}</span>
                                </button>
                            </div>
                            <button 
                                type="submit" 
                                class="btn find_food_btn"
                            >
                                {{ $hero->search_section_button_text ?? 'Find Food' }}
                            </button>
                        </form>
                        <script>
                            function getUserLocation() {
                                const locationInput = document.getElementById('hero_location_input');
                                const locateBtn = document.querySelector('.locate_me_btn');
                                const locateText = document.querySelector('.locate_me_text');
                                
                                // Show loading state
                                const originalText = locateText.textContent;
                                locateText.textContent = 'Locating...';
                                locateBtn.style.pointerEvents = 'none';
                                locateBtn.style.opacity = '0.7';
                                
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(
                                        function(position) {
                                            const lat = position.coords.latitude;
                                            const lng = position.coords.longitude;
                                            
                                            // Use reverse geocoding to get address
                                            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
                                                .then(response => response.json())
                                                .then(data => {
                                                    let locationText = '';
                                                    if (data && data.address) {
                                                        // Try to build a readable address
                                                        const addr = data.address;
                                                        if (addr.road || addr.street) {
                                                            locationText = (addr.road || addr.street) + 
                                                                (addr.house_number ? ' ' + addr.house_number : '') +
                                                                (addr.city || addr.town || addr.village ? ', ' + (addr.city || addr.town || addr.village) : '') +
                                                                (addr.state ? ', ' + addr.state : '') +
                                                                (addr.country ? ', ' + addr.country : '');
                                                        } else if (addr.city || addr.town || addr.village) {
                                                            locationText = (addr.city || addr.town || addr.village) +
                                                                (addr.state ? ', ' + addr.state : '') +
                                                                (addr.country ? ', ' + addr.country : '');
                                                        } else {
                                                            locationText = data.display_name || `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                                                        }
                                                    } else {
                                                        locationText = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                                                    }
                                                    
                                                    // Display location in input field
                                                    locationInput.value = locationText;
                                                    
                                                    // Reset button state
                                                    locateText.textContent = originalText;
                                                    locateBtn.style.pointerEvents = 'auto';
                                                    locateBtn.style.opacity = '1';
                                                })
                                                .catch(error => {
                                                    // Fallback to coordinates if geocoding fails
                                                    locationInput.value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                                                    
                                                    // Reset button state
                                                    locateText.textContent = originalText;
                                                    locateBtn.style.pointerEvents = 'auto';
                                                    locateBtn.style.opacity = '1';
                                                });
                                        },
                                        function(error) {
                                            // Reset button state
                                            locateText.textContent = originalText;
                                            locateBtn.style.pointerEvents = 'auto';
                                            locateBtn.style.opacity = '1';
                                            
                                            // Show error message
                                            alert('Unable to get your location. Please enter manually.');
                                        }
                                    );
                                } else {
                                    alert('Geolocation is not supported by this browser.');
                                    locateText.textContent = originalText;
                                    locateBtn.style.pointerEvents = 'auto';
                                    locateBtn.style.opacity = '1';
                                }
                            }
                        </script>
                    </div>
                    @endif

                    <!-- app buttons -->
                    <ul class="app_btn">
                        @if($hero && ($hero->show_google_play ?? true))
                        <li>
                            <a href="{{ $hero && $hero->google_play_url ? $hero->google_play_url : '#' }}">
                                @if($hero && $hero->google_play_image)
                                    <img class="blue_img" src="{{ asset('storage/' . $hero->google_play_image) }}" alt="image">
                                @else
                                    <img class="blue_img" src="{{ asset('images/googleplay.webp') }}" alt="image">
                                @endif
                            </a>
                        </li>
                        @endif
                        @if($hero && ($hero->show_app_store ?? true))
                        <li>
                            <a href="{{ $hero && $hero->app_store_url ? $hero->app_store_url : '#' }}">
                                @if($hero && $hero->app_store_image)
                                    <img class="blue_img" src="{{ asset('storage/' . $hero->app_store_image) }}" alt="image">
                                @else
                                    <img class="blue_img" src="{{ asset('images/appstorebtn.webp') }}" alt="image">
                                @endif
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>

                <!-- banner image start -->
                <div class="col-lg-6 col-md-12">
                    <div class="hero_img">
                        @if($hero && $hero->hero_image)
                            <img src="{{ asset('storage/' . $hero->hero_image) }}" alt="image">
                        @else
                            <img src="{{ asset('images/hero_image.webp') }}" alt="image">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Page Wraper -->
    <div class="page_wrapper">
        <!-- usp start -->
        <section class="row_am usp_section">
            <div class="blure_shape bs_1"></div>
            <div class="blure_shape bs_2"></div>

            <div class="inner_sec" id="counter">
                <div class="container">
                    <div class="row">
                        @forelse($statistics as $stat)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="usp_box">
                                    <div class="usp_icon">
                                        @if($stat->icon)
                                            <img src="{{ asset('storage/' . $stat->icon) }}" alt="image">
                                        @else
                                            <img src="{{ asset('images/usp1.webp') }}" alt="image">
                                        @endif
                                    </div>
                                    <div class="usp_text">
                                        <span class="counter-value" data-count="{{ $stat->value }}">{{ $stat->value }}</span>
                                        <span>{{ $stat->suffix }}</span>
                                        <p>{{ $stat->label }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- Default static statistics if none in database -->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="usp_box">
                                    <div class="usp_icon"><img src="{{ asset('images/usp1.webp') }}" alt="image"></div>
                                    <div class="usp_text">
                                        <span class="counter-value" data-count="5000">5000</span><span>+</span>
                                        <p>Happy Users</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="usp_box">
                                    <div class="usp_icon"><img src="{{ asset('images/usp2.webp') }}" alt="image"></div>
                                    <div class="usp_text">
                                        <span class="counter-value" data-count="1879">1879</span><span>+</span>
                                        <p>Positive Reviews</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- Trusted Section start -->
        <section class="row_am trusted_section">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                    <h4>Trusted by Top Restaurant</h4>
                </div>

                <div class="company_logos">
                    <div id="company_slider" class="owl-carousel owl-theme">
                        @forelse($restaurantLogos as $logo)
                            <div class="item">
                                <div class="logo">
                                    <img src="{{ asset('storage/' . $logo->logo_image) }}" alt="{{ $logo->alt_text ?? 'Restaurant Logo' }}">
                                </div>
                            </div>
                        @empty
                            <!-- Default logos if none in database -->
                            @for($i = 1; $i <= 8; $i++)
                                <div class="item">
                                    <div class="logo">
                                        <img src="{{ asset('images/res' . $i . '.webp') }}" alt="Restaurant Logo">
                                    </div>
                                </div>
                            @endfor
                        @endforelse
                    </div>
                </div>

                <div class="ctr_cta">
                    <div class="btn_block">
                        <a href="{{ $restaurantRegisterButton['url'] }}" class="btn puprple_btn ml-0">{{ $restaurantRegisterButton['text'] }}</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- why us new section start -->
        <section class="row_am why_new_section" id="why_sec">
            <div class="why_new_section_inner">
                <div class="container">
                    <div class="row">
                        <!-- section title -->
                        <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                            @if($whyChooseUsSettings['badge_text'])
                                <span class="title_badge">{{ $whyChooseUsSettings['badge_text'] }}</span>
                            @else
                                <span class="title_badge">why use Appiq</span>
                            @endif
                            <h2>{{ $whyChooseUsSettings['heading'] }}</h2>
                            <p>{{ $whyChooseUsSettings['description'] }}</p>
                        </div>

                        <div class="dtat_box">
                            <div class="col-lg-6 col-md-12">
                                <div class="why_new_left_data">
                                    @forelse($whyChooseUs->take(3) as $feature)
                                        <div class="why_data_block" data-aos="fade-right" data-aos-duration="1500">
                                            <div class="icon">
                                                @if($feature->icon)
                                                    <img src="{{ asset('storage/' . $feature->icon) }}" alt="{{ $feature->title }}">
                                                @else
                                                    <img src="{{ asset('images/whyicon' . (($loop->index % 3) + 1) . '.webp') }}" alt="image">
                                                @endif
                                            </div>
                                            <div class="text">
                                                <h6>{{ $feature->title }}</h6>
                                                <p>{{ $feature->content }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <!-- Default features -->
                                        <div class="why_data_block" data-aos="fade-right" data-aos-duration="1500">
                                            <div class="icon"><img src="{{ asset('images/whyicon1.webp') }}" alt="image"></div>
                                            <div class="text">
                                                <h6>Delivery in 30 min</h6>
                                                <p>Get your favorite meals delivered fresh and fast to your door in just 30 minutes! Enjoy the convenience!</p>
                                            </div>
                                        </div>
                                        <div class="why_data_block" data-aos="fade-right" data-aos-duration="1500">
                                            <div class="icon"><img src="{{ asset('images/whyicon2.webp') }}" alt="image"></div>
                                            <div class="text">
                                                <h6>Quality Food</h6>
                                                <p>Enjoy premium meals from top local restaurants, expertly crafted to satisfy your taste and elevate your dining experience!</p>
                                            </div>
                                        </div>
                                        <div class="why_data_block" data-aos="fade-right" data-aos-duration="1500">
                                            <div class="icon"><img src="{{ asset('images/whyicon3.webp') }}" alt="image"></div>
                                            <div class="text">
                                                <h6>Track Live Map</h6>
                                                <p>Easily track your order in real-time with our live map feature, ultimate convenience and keeping you updated every step of the way!</p>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="why_us_new_img" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                    @if($whyChooseUsFeatureImage)
                                        <img src="{{ asset('storage/' . $whyChooseUsFeatureImage) }}" alt="image">
                                    @else
                                        <img src="{{ asset('images/features_frame.webp') }}" alt="image">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- why us new section end -->

        <!-- Dishes-Section-Start -->
        <section class="row_am dishes_section">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                    <span class="title_badge">yummy dishes!</span>
                    <h2>Access over 1000+ dishes with just a tap</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typese tting indus orem Ipsum has beenthe standard dummy.</p>
                </div>
            </div>

            <div class="dish_slider" data-aos="fade-in" data-aos-duration="1500">
                <div class="owl-carousel owl-theme" id="about_slider">
                    @forelse($dishes as $dish)
                        <div class="item">
                            <div class="dish_slides">
                                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name ?? 'Dish' }}">
                            </div>
                        </div>
                    @empty
                        <!-- Default dishes if none in database -->
                        @for($i = 1; $i <= 10; $i++)
                            <div class="item">
                                <div class="dish_slides">
                                    <img src="{{ asset('images/dish' . $i . '.webp') }}" alt="Dish">
                                </div>
                            </div>
                        @endfor
                    @endforelse
                </div>
            </div>

            <div class="ctr_app_btn_block">
                <p><strong>Free food delivery for first 5 orders!</strong></p>
                <ul class="app_btn">
                    @if($dishesSectionButtons['show_google_play'])
                    <li>
                        <a href="{{ $dishesSectionButtons['google_play_url'] ?? ($hero && $hero->google_play_url ? $hero->google_play_url : '#') }}">
                            <img class="blue_img" src="{{ asset('images/googleplay.webp') }}" alt="image">
                        </a>
                    </li>
                    @endif
                    @if($dishesSectionButtons['show_app_store'])
                    <li>
                        <a href="{{ $dishesSectionButtons['app_store_url'] ?? ($hero && $hero->app_store_url ? $hero->app_store_url : '#') }}">
                            <img class="blue_img" src="{{ asset('images/appstorebtn.webp') }}" alt="image">
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </section>

        <!-- Service Section Start -->
        <section class="row_am service_section" id="feature_sec">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                    <span class="title_badge">Advanced Features</span>
                    <h2>Win-win for restaurants & users</h2>
                    <p>Lorem Ipsum is simply dummy text of the print ing andtyptting industrythe print ing andtyptting industry.</p>
                </div>

                @php
                    $restaurantService = $services->where('type', 'restaurant')->first();
                    $customerService = $services->where('type', 'customer')->first();
                    $deliverymanService = $services->where('type', 'deliveryman')->first();
                @endphp

                <div class="row service_blocks flex-row-reverse">
                    <div class="col-md-6">
                        <div class="service_text right_side" data-aos="fade-up" data-aos-duration="1500">
                            @if($restaurantService)
                                @if($restaurantService->badge_text)
                                    <span class="title_badge">{{ $restaurantService->badge_text }}</span>
                                @else
                                    <span class="title_badge">for restaurant</span>
                                @endif
                                <h3>{{ $restaurantService->heading }}</h3>
                                <p>{{ $restaurantService->description }}</p>
                                @if($restaurantService->features && is_array($restaurantService->features))
                                    <ul class="design_block">
                                        @foreach($restaurantService->features as $feature)
                                            <li data-aos="fade-up" data-aos-duration="1500">
                                                <h6>{{ $feature['title'] ?? '' }}</h6>
                                                <p>{{ $feature['description'] ?? '' }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul class="design_block">
                                        <li data-aos="fade-up" data-aos-duration="1500">
                                            <h6>Handling of orders</h6>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting.</p>
                                        </li>
                                        <li data-aos="fade-up" data-aos-duration="1500">
                                            <h6>Sale system connectivity</h6>
                                            <p>Dummy text of the printing and typesetting industr lorem Ipsum is simply.</p>
                                        </li>
                                    </ul>
                                @endif
                                <div class="btn_block">
                                    <a href="{{ $restaurantService->button_url ?? '#' }}" class="btn puprple_btn ml-0">{{ $restaurantService->button_text ?? 'Register Your Restaurant' }}</a>
                                </div>
                            @else
                                <span class="title_badge">for restaurant</span>
                                <h3>Effortless management of restaurant operations.</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem Ipsum has been the industrys standard dummytext.</p>
                                <ul class="design_block">
                                    <li data-aos="fade-up" data-aos-duration="1500">
                                        <h6>Handling of orders</h6>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting.</p>
                                    </li>
                                    <li data-aos="fade-up" data-aos-duration="1500">
                                        <h6>Sale system connectivity</h6>
                                        <p>Dummy text of the printing and typesetting industr lorem Ipsum is simply.</p>
                                    </li>
                                </ul>
                                <div class="btn_block">
                                    <a href="#" class="btn puprple_btn ml-0">Register Your Restaurant</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner_block dark_bg rotate_right" data-aos="fade-up" data-aos-duration="1500">
                            <div class="img">
                                @if($restaurantService && $restaurantService->image)
                                    <img src="{{ asset('storage/' . $restaurantService->image) }}" alt="image">
                                @else
                                    <img src="{{ asset('images/for_restaurant.webp') }}" alt="image">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row service_blocks no_bottom_padding">
                    <div class="col-md-6">
                        <div class="service_text" data-aos="fade-up" data-aos-duration="1500">
                            @if($customerService)
                                @if($customerService->badge_text)
                                    <span class="title_badge">{{ $customerService->badge_text }}</span>
                                @else
                                    <span class="title_badge">for customer</span>
                                @endif
                                <h3>{{ $customerService->heading }}</h3>
                                <p>{{ $customerService->description }}</p>
                                @if($customerService->features && is_array($customerService->features))
                                    <ul class="design_block">
                                        @foreach($customerService->features as $feature)
                                            <li data-aos="fade-up" data-aos-duration="1500">
                                                <h6>{{ $feature['title'] ?? '' }}</h6>
                                                <p>{{ $feature['description'] ?? '' }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul class="design_block">
                                        <li data-aos="fade-up" data-aos-duration="1500">
                                            <h6>Delivery within 3 min</h6>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting.</p>
                                        </li>
                                        <li data-aos="fade-up" data-aos-duration="1500">
                                            <h6>Live map tracking</h6>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industr.</p>
                                        </li>
                                    </ul>
                                @endif
                                <div class="btn_block">
                                    <a href="{{ $customerService->button_url ?? '#' }}" class="btn puprple_btn ml-0">{{ $customerService->button_text ?? 'Download App' }}</a>
                                </div>
                            @else
                                <span class="title_badge">for customer</span>
                                <h3>Seamless ordering process from app</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem Ipsum has been the industrys standard dummytext.</p>
                                <ul class="design_block">
                                    <li data-aos="fade-up" data-aos-duration="1500">
                                        <h6>Delivery within 3 min</h6>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting.</p>
                                    </li>
                                    <li data-aos="fade-up" data-aos-duration="1500">
                                        <h6>Live map tracking</h6>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industr.</p>
                                    </li>
                                </ul>
                                <div class="btn_block">
                                    <a href="#" class="btn puprple_btn ml-0">Download App</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner_block" data-aos="fade-up" data-aos-duration="1500">
                            <div class="img">
                                @if($customerService && $customerService->image)
                                    <img src="{{ asset('storage/' . $customerService->image) }}" alt="image">
                                @else
                                    <img src="{{ asset('images/for_customer.webp') }}" alt="image">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($deliverymanService)
                <div class="row service_blocks flex-row-reverse no_bottom_padding">
                    <div class="col-md-6">
                        <div class="service_text right_side" data-aos="fade-up" data-aos-duration="1500">
                            @if($deliverymanService->badge_text)
                                <span class="title_badge">{{ $deliverymanService->badge_text }}</span>
                            @else
                                <span class="title_badge">for deliveryman</span>
                            @endif
                            <h3>{{ $deliverymanService->heading }}</h3>
                            <p>{{ $deliverymanService->description }}</p>
                            @if($deliverymanService->features && is_array($deliverymanService->features))
                                <ul class="design_block">
                                    @foreach($deliverymanService->features as $feature)
                                        <li data-aos="fade-up" data-aos-duration="1500">
                                            <h6>{{ $feature['title'] ?? '' }}</h6>
                                            <p>{{ $feature['description'] ?? '' }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <ul class="design_block">
                                    <li data-aos="fade-up" data-aos-duration="1500">
                                        <h6>Earn money on your schedule</h6>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting.</p>
                                    </li>
                                    <li data-aos="fade-up" data-aos-duration="1500">
                                        <h6>Flexible delivery options</h6>
                                        <p>Dummy text of the printing and typesetting industr lorem Ipsum is simply.</p>
                                    </li>
                                </ul>
                            @endif
                            <div class="btn_block">
                                <a href="{{ $deliverymanService->button_url ?? '#' }}" class="btn puprple_btn ml-0">{{ $deliverymanService->button_text ?? 'Join As Deliveryman' }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner_block dark_bg rotate_right" data-aos="fade-up" data-aos-duration="1500">
                            <div class="img">
                                @if($deliverymanService->image)
                                    <img src="{{ asset('storage/' . $deliverymanService->image) }}" alt="image">
                                @else
                                    <img src="{{ asset('images/for_restaurant.webp') }}" alt="image">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>
        <!-- Service Section End -->

        <!-- How it Works Section Start -->
        <section class="advance_feature_section row_am white_text" id="how_sec">
            <div class="af_innner">
                <div class="blure_shape bs_1"></div>
                <div class="blure_shape bs_2"></div>

                <div class="container">
                    <div class="section_title">
                        @if($howItWorksSettings['badge_text'])
                            <span class="title_badge">{{ $howItWorksSettings['badge_text'] }}</span>
                        @else
                            <span class="title_badge">Easy Steps</span>
                        @endif
                        <h2>
                            {{ $howItWorksSettings['heading'] ?: 'How it Works' }}
                        </h2>
                        <p>
                            {{ $howItWorksSettings['description'] ?: 'Lorem Ipsum is simply dummy text of the printing indus orem Ipsum has been the industrys standard dummy text ever since.' }}
                        </p>
                    </div>

                    <div class="af_listing">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="listing_inner">
                                    @forelse($howItWorks->take(3) as $step)
                                        <div class="af_block" data-aos="fade-up" data-aos-duration="1500">
                                            <div class="img">
                                                @if($step->step_image)
                                                    <img src="{{ asset('storage/' . $step->step_image) }}" alt="{{ $step->step_title }}">
                                                @else
                                                    <img src="{{ asset('images/how' . ($step->step_number ?? $loop->index + 1) . '.webp') }}" alt="image">
                                                @endif
                                            </div>
                                            <div class="text">
                                                <h5>{{ $step->step_title }}</h5>
                                                <p>{{ $step->step_description }}</p>
                                            </div>
                                            <div class="process_num">{{ str_pad($step->step_number ?? ($loop->index + 1), 2, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    @empty
                                        <!-- Default steps -->
                                        <div class="af_block" data-aos="fade-up" data-aos-duration="1500">
                                            <div class="img"><img src="{{ asset('images/how1.webp') }}" alt="image"></div>
                                            <div class="text">
                                                <h5>Download App & create a free account</h5>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem Ipsum has.</p>
                                            </div>
                                            <div class="process_num">01</div>
                                        </div>
                                        <div class="af_block" data-aos="fade-up" data-aos-duration="1500">
                                            <div class="img"><img src="{{ asset('images/how2.webp') }}" alt="image"></div>
                                            <div class="text">
                                                <h5>Place orders at your preferred eatery</h5>
                                                <p>Dummy text of the printing and typesetting industry lorem Ipsum has been the industrys.</p>
                                            </div>
                                            <div class="process_num">02</div>
                                        </div>
                                        <div class="af_block" data-aos="fade-up" data-aos-duration="1500">
                                            <div class="img"><img src="{{ asset('images/how3.webp') }}" alt="image"></div>
                                            <div class="text">
                                                <h5>Get it delivered directly to your home, effortlessly</h5>
                                                <p>Printing and typesetting industry lorem Ipsum has been the industrys standard dummy.</p>
                                            </div>
                                            <div class="process_num">03</div>
                                        </div>
                                    @endforelse
                                </div>

                                <div class="ctr_app_btn_block">
                                    @if($howItWorksSettings['promotional_text'])
                                        <p><strong>{{ $howItWorksSettings['promotional_text'] }}</strong></p>
                                    @endif
                                    <ul class="app_btn">
                                        @if($howItWorksSettings['show_google_play'])
                                        <li>
                                            <a href="{{ $howItWorksSettings['google_play_url'] ?? ($hero && $hero->google_play_url ? $hero->google_play_url : '#') }}">
                                                <img class="blue_img" src="{{ asset('images/googleplay.webp') }}" alt="image">
                                            </a>
                                        </li>
                                        @endif
                                        @if($howItWorksSettings['show_app_store'])
                                        <li>
                                            <a href="{{ $howItWorksSettings['app_store_url'] ?? ($hero && $hero->app_store_url ? $hero->app_store_url : '#') }}">
                                                <img class="blue_img" src="{{ asset('images/appstorebtn.webp') }}" alt="image">
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="device">
                @if($howItWorksSettings['bottom_image'])
                    <img src="{{ asset('storage/' . $howItWorksSettings['bottom_image']) }}" alt="image">
                @else
                    <img src="{{ asset('images/device.webp') }}" alt="image">
                @endif
            </div>
        </section>
        <!-- How it Works Section End -->

        <!-- Success stories Section Start -->
        <section class="key_feature_section row_am" id="review_sec">
            <div class="kf_side_element left_side"><img src="{{ asset('images/thumbup.webp') }}" alt="image"></div>
            <div class="kf_side_element right_side"><img src="{{ asset('images/like.webp') }}" alt="image"></div>

            <div class="key_innner">
                <div class="container">
                    <div class="section_title">
                        <span class="title_badge">Testimonials</span>
                        <h2>Our happy clients</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing indus orem Ipsum has been the industrys standard dummy text ever since.</p>
                    </div>

                    <div id="feature_slider" class="owl-carousel owl-theme" data-aos="fade-up" data-aos-duration="1500">
                        @forelse($testimonials as $testimonial)
                            <div class="item">
                                <div class="feature_box">
                                    <div class="img">
                                        <img src="{{ asset('storage/' . $testimonial->customer_image) }}" alt="{{ $testimonial->customer_name }}">
                                    </div>
                                    <div class="txt_blk">
                                        <h6>{{ $testimonial->customer_name }}</h6>
                                        <div class="rating">
                                            @for($i = 0; $i < $testimonial->rating; $i++)
                                                <span><i class="icofont-star"></i></span>
                                            @endfor
                                        </div>
                                        <p>
                                            <span class="story_bold">"{{ $testimonial->quote }}"</span>
                                            @if($testimonial->full_review)
                                                {{ Str::limit($testimonial->full_review, 100) }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="quote_img">
                                        <img src="{{ asset('images/quote.webp') }}" alt="image">
                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- Default testimonials -->
                            <div class="item">
                                <div class="feature_box">
                                    <div class="img">
                                        <img src="{{ asset('images/story1.webp') }}" alt="image">
                                    </div>
                                    <div class="txt_blk">
                                        <h6>Olivia Sam</h6>
                                        <div class="rating">
                                            @for($i = 0; $i < 5; $i++)
                                                <span><i class="icofont-star"></i></span>
                                            @endfor
                                        </div>
                                        <p><span class="story_bold">"Delivery on time every order!"</span> Lorem Ipsum is simply dummy text of the printing the industrys standard dummytextever since.</p>
                                    </div>
                                    <div class="quote_img">
                                        <img src="{{ asset('images/quote.webp') }}" alt="image">
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </section>

        <!-- App-Download-New-Section-Start -->
        @if($downloadSection)
        <section class="row_am download_app_new" id="download_sec">
            <div class="dap_block" data-aos="fade-up" data-aos-duration="1500">
                <div class="blure_shape bs_1"></div>

                <div class="row">
                    <div class="col-lg-3 col-md-12 order-2 order-lg-1">
                        <div class="dap_image left">
                            @if($downloadSection->left_image)
                                <img class="dap_desktop_img" src="{{ asset('storage/' . $downloadSection->left_image) }}" alt="image">
                            @else
                                <img class="dap_desktop_img" src="{{ asset('images/download_food1.webp') }}" alt="image">
                            @endif
                            @if($downloadSection->mobile_image)
                                <img class="dap_mobile_img" src="{{ asset('storage/' . $downloadSection->mobile_image) }}" alt="image">
                            @else
                                <img class="dap_mobile_img" src="{{ asset('images/download_food3.webp') }}" alt="image">
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                        <div class="dap_text">
                            <div class="section_title white_text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                @if($downloadSection->badge_text)
                                    <span class="title_badge">{{ $downloadSection->badge_text }}</span>
                                @else
                                    <span class="title_badge">Download</span>
                                @endif
                                <h2>{{ $downloadSection->heading }}</h2>
                                <p>{{ $downloadSection->description }}</p>
                            </div>
                            <ul class="app_btn" data-aos="fade-up" data-aos-duration="1500">
                                @if(($downloadSection->show_google_play ?? true))
                                <li>
                                    <a href="{{ $downloadSection->google_play_url ?? ($hero && $hero->google_play_url ? $hero->google_play_url : '#') }}">
                                        <img class="blue_img" src="{{ asset('images/googleplay.webp') }}" alt="image">
                                    </a>
                                </li>
                                @endif
                                @if(($downloadSection->show_app_store ?? true))
                                <li>
                                    <a href="{{ $downloadSection->app_store_url ?? ($hero && $hero->app_store_url ? $hero->app_store_url : '#') }}">
                                        <img class="blue_img" src="{{ asset('images/appstorebtn.webp') }}" alt="image">
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12 order-3 order-lg-3 d-none d-lg-block">
                        <div class="dap_image right">
                            @if($downloadSection->right_image)
                                <img src="{{ asset('storage/' . $downloadSection->right_image) }}" alt="image">
                            @else
                                <img src="{{ asset('images/download_food2.webp') }}" alt="image">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @else
        <!-- Default App Download Section -->
        <section class="row_am download_app_new" id="download_sec">
            <div class="dap_block" data-aos="fade-up" data-aos-duration="1500">
                <div class="blure_shape bs_1"></div>
                <div class="row">
                    <div class="col-lg-3 col-md-12 order-2 order-lg-1">
                        <div class="dap_image left">
                            <img class="dap_desktop_img" src="{{ asset('images/download_food1.webp') }}" alt="image">
                            <img class="dap_mobile_img" src="{{ asset('images/download_food3.webp') }}" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                        <div class="dap_text">
                            <div class="section_title white_text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                <span class="title_badge">Download</span>
                                <h2>Download app to enjoy 4500+ foods from 1200+ restaurants</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing indus orem Ipsum has been the industrys.</p>
                            </div>
                            <ul class="app_btn" data-aos="fade-up" data-aos-duration="1500">
                                <li>
                                    <a href="{{ $hero && $hero->google_play_url ? $hero->google_play_url : '#' }}">
                                        <img class="blue_img" src="{{ asset('images/googleplay.webp') }}" alt="image">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $hero && $hero->app_store_url ? $hero->app_store_url : '#' }}">
                                        <img class="blue_img" src="{{ asset('images/appstorebtn.webp') }}" alt="image">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 order-3 order-lg-3 d-none d-lg-block">
                        <div class="dap_image right">
                            <img src="{{ asset('images/download_food2.webp') }}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- App-Download-New-Section-end -->

        <!-- Register Restaurant Section Start -->
        @if($registerSection)
        <section class="row_am register_restaurant" @if($registerSection->background_image) style="background-image: url('{{ asset('storage/' . $registerSection->background_image) }}'); background-size: cover; background-position: center;" @endif>
            <div class="reg_block" data-aos="fade-up" data-aos-duration="1500">
                <div class="row">
                    <div class="col-lg-7 col-md-10 col-sm-12 mx-auto">
                        <div class="dap_text">
                            <div class="section_title white_text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                @if($registerSection->badge_text)
                                    <span class="title_badge">{{ $registerSection->badge_text }}</span>
                                @else
                                    <span class="title_badge">register restaurant</span>
                                @endif
                                <h2>{{ $registerSection->heading }}</h2>
                                <p>{{ $registerSection->description }}</p>
                            </div>
                            <div class="ctr_cta">
                                <div class="btn_block">
                                    <a href="{{ $registerSection->button_url ?? '#' }}" class="btn puprple_btn ml-0">{{ $registerSection->promo_text ?? 'Register Restaurant' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @else
        <!-- Default Register Restaurant Section -->
        <section class="row_am register_restaurant">
            <div class="reg_block" data-aos="fade-up" data-aos-duration="1500">
                <div class="row">
                    <div class="col-lg-7 col-md-10 col-sm-12 mx-auto">
                        <div class="dap_text">
                            <div class="section_title white_text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                <span class="title_badge">register restaurant</span>
                                <h2>Begin gaining more customers today</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and type setting industry lorem Ipsum has been the industrys.</p>
                            </div>
                            <div class="ctr_cta">
                                <div class="btn_block">
                                    <a href="#" class="btn puprple_btn ml-0">Register Restaurant</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- Register Restaurant Section end -->

        <!-- Deliveryman Section Start -->
        @if($deliverymanSection)
        <section class="row_am register_restaurant" @if($deliverymanSection->background_image) style="background-image: url('{{ asset('storage/' . $deliverymanSection->background_image) }}'); background-size: cover; background-position: center;" @endif>
            <div class="reg_block" data-aos="fade-up" data-aos-duration="1500">
                <div class="row">
                    <div class="col-lg-7 col-md-10 col-sm-12 mx-auto">
                        <div class="dap_text">
                            <div class="section_title white_text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                @if($deliverymanSection->badge_text)
                                    <span class="title_badge">{{ $deliverymanSection->badge_text }}</span>
                                @else
                                    <span class="title_badge">Join as Deliveryman</span>
                                @endif
                                <h2>{{ $deliverymanSection->heading }}</h2>
                                <p>{{ $deliverymanSection->description }}</p>
                            </div>
                            <div class="ctr_cta">
                                <div class="btn_block">
                                    <a href="{{ $deliverymanSection->button_url ?? '#' }}" class="btn puprple_btn ml-0">{{ $deliverymanSection->promo_text ?? 'Join As Deliveryman' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- Deliveryman Section end -->

        <!-- Pre-Footer CTA Section -->
        @include('partials.pre-footer-cta')

        <!-- Footer-Section start -->
        <footer>
            <div class="top_footer" id="contact">
                <div class="blure_shape bs_1"></div>
                <div class="blure_shape bs_2"></div>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12">
                            <div class="abt_side">
                                <div class="logo">
                                    @if($footerLogo)
                                        <img src="{{ asset('storage/' . $footerLogo) }}" alt="Logo">
                                    @else
                                        <img src="{{ asset('images/logo_white.webp') }}" alt="image">
                                    @endif
                                </div>
                                <p>{{ $footerDetails }}</p>
                                @if(isset($footerAppStoreButtons))
                                    <ul class="app_btn">
                                        @if($footerAppStoreButtons['show_app_store'])
                                            <li>
                                                <a href="{{ $footerAppStoreButtons['app_store_url'] }}">
                                                    <img src="{{ asset('images/appstorebtn.webp') }}" alt="App Store">
                                                </a>
                                            </li>
                                        @endif
                                        @if($footerAppStoreButtons['show_google_play'])
                                            <li>
                                                <a href="{{ $footerAppStoreButtons['google_play_url'] }}">
                                                    <img src="{{ asset('images/googleplay.webp') }}" alt="Google Play">
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                @else
                                    <ul class="app_btn">
                                        <li><a href="#"><img src="{{ asset('images/appstorebtn.webp') }}" alt="image"></a></li>
                                        <li><a href="#"><img src="{{ asset('images/googleplay.webp') }}" alt="image"></a></li>
                                    </ul>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-6 col-12">
                            <div class="links">
                                <h5>Quick Links</h5>
                                <ul>
                                    @forelse($footerQuickLinks as $link)
                                        <li><a href="{{ $link->url ? $link->url : '#' }}">{{ $link->label }}</a></li>
                                    @empty
                                        <li><a href="{{ route('home') }}">Home</a></li>
                                        <li><a href="{{ route('about') }}">About us</a></li>
                                        <li><a href="{{ route('contact') }}">Contact us</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-6 col-12">
                            <div class="links">
                                <h5>Support</h5>
                                <ul>
                                    @forelse($footerSupportMenus as $menu)
                                        <li><a href="{{ $menu->url ? $menu->url : '#' }}">{{ $menu->label }}</a></li>
                                    @empty
                                        <li><a href="#">FAQs</a></li>
                                        <li><a href="#">Support</a></li>
                                        <li><a href="#">How it works</a></li>
                                        <li><a href="#">Terms & conditions</a></li>
                                        <li><a href="#">Privacy policy</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <h5>Subscribe us</h5>
                            <div class="news_letter">
                                <p>Subscribe our newsleter to receive latest updates regularly from us!</p>
                                <form id="newsletterForm" action="{{ route('newsletter.subscribe') }}" method="POST">
                                    @csrf
                                    <div id="newsletter-message" style="display: none; margin-bottom: 10px; padding: 10px; border-radius: 5px; font-size: 14px;"></div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="newsletter_email" class="form-control" placeholder="Enter your email" required>
                                        <button type="submit" class="btn" aria-label="subscribe" id="newsletterSubmitBtn">
                                            <span id="newsletterBtnText"><i class="icofont-paper-plane"></i></span>
                                            <span id="newsletterBtnLoader" style="display: none;">Submitting...</span>
                                        </button>
                                    </div>
                                    <p class="note">By clicking send link you agree to receive message.</p>
                                </form>
                                <script>
                                    document.getElementById('newsletterForm').addEventListener('submit', function(e) {
                                        e.preventDefault();
                                        
                                        const form = this;
                                        const submitBtn = document.getElementById('newsletterSubmitBtn');
                                        const submitBtnText = document.getElementById('newsletterBtnText');
                                        const submitBtnLoader = document.getElementById('newsletterBtnLoader');
                                        const messageDiv = document.getElementById('newsletter-message');
                                        const formData = new FormData(form);
                                        
                                        // Disable submit button and show loader
                                        submitBtn.disabled = true;
                                        submitBtnText.style.display = 'none';
                                        submitBtnLoader.style.display = 'inline';
                                        
                                        // Hide previous messages
                                        messageDiv.style.display = 'none';
                                        messageDiv.className = '';
                                        messageDiv.textContent = '';
                                        
                                        // Submit via AJAX
                                        fetch(form.action, {
                                            method: 'POST',
                                            body: formData,
                                            headers: {
                                                'X-Requested-With': 'XMLHttpRequest',
                                                'Accept': 'application/json'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            // Show message
                                            messageDiv.style.display = 'block';
                                            messageDiv.textContent = data.message;
                                            
                                            if (data.success) {
                                                // Success message
                                                messageDiv.style.backgroundColor = '#d4edda';
                                                messageDiv.style.color = '#155724';
                                                messageDiv.style.border = '1px solid #c3e6cb';
                                                
                                                // Reset form
                                                form.reset();
                                            } else {
                                                // Error message
                                                messageDiv.style.backgroundColor = '#f8d7da';
                                                messageDiv.style.color = '#721c24';
                                                messageDiv.style.border = '1px solid #f5c6cb';
                                            }
                                        })
                                        .catch(error => {
                                            // Show error message
                                            messageDiv.style.display = 'block';
                                            messageDiv.style.backgroundColor = '#f8d7da';
                                            messageDiv.style.color = '#721c24';
                                            messageDiv.style.border = '1px solid #f5c6cb';
                                            messageDiv.textContent = 'An error occurred. Please try again later.';
                                        })
                                        .finally(() => {
                                            // Re-enable submit button
                                            submitBtn.disabled = false;
                                            submitBtnText.style.display = 'inline';
                                            submitBtnLoader.style.display = 'none';
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bottom_footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <p>{{ isset($footerCopyrightText) ? str_replace('%Y', date('Y'), $footerCopyrightText) : '© Copyrights ' . date('Y') . '. All rights reserved.' }}</p>
                            </div>
                            <div class="col-md-4">
                                <ul class="social_media">
                                    @if(isset($footerSocialLinks) && $footerSocialLinks->count() > 0)
                                        @foreach($footerSocialLinks as $socialLink)
                                            <li>
                                                <a href="{{ $socialLink->url }}" aria-label="{{ $socialLink->label ?? $socialLink->platform . ' page' }}" target="_blank" rel="noopener noreferrer">
                                                    <i class="{{ $socialLink->icon_class }}"></i>
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li><a href="#" aria-label="facebook page"><i class="icofont-facebook"></i></a></li>
                                        <li><a href="#" aria-label="twitter page"><i class="icofont-twitter"></i></a></li>
                                        <li><a href="#" aria-label="instagram page"><i class="icofont-instagram"></i></a></li>
                                        <li><a href="#" aria-label="pinterest page"><i class="icofont-pinterest"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <p class="developer_text">Design & developed by <a href="http://skylon-it.com/" target="blank">Skylon-IT</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <div class="go_top" id="Gotop">
            <span><i class="icofont-arrow-up"></i></span>
        </div>

        <!-- Video Model Start -->
        <div class="modal fade youtube-video" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button id="close-video" type="button" class="button btn btn-default text-right" data-dismiss="modal">
                        <i class="icofont-close-line-circled"></i>
                    </button>
                    <div class="modal-body">
                        <div id="video-container" class="video-container">
                            <iframe id="youtubevideo" width="640" height="360" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery-js-Link -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/typed.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        $("#typed").typed({
            strings: @json($hero && $hero->typed_texts && count($hero->typed_texts) > 0 ? $hero->typed_texts : ["Fastest delivery", "Hygine Food", "5000+ Dishes."]),
            typeSpeed: 100,
            startDelay: 0,
            backSpeed: 60,
            backDelay: 2000,
            loop: true,
            cursorChar: "|",
            contentType: 'html'
        });
    </script>

</body>
</html>

