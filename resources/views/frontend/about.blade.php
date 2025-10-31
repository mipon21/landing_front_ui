<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    @php
        $pageTitle = 'About us : ' . $siteName;
    @endphp
    <title>{{ $pageTitle }}</title>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="loader"></div>
    </div>

    @include('partials.header')

    <!-- BredCrumb-Section -->
    <div class="bred_crumb">
        <div class="container">
            <span class="banner_shape1"><img src="{{ asset('images/banner-shape1.webp') }}" alt="image"></span>
            <span class="banner_shape2"><img src="{{ asset('images/banner-shape2.webp') }}" alt="image"></span>
            <div class="bred_text">
                <h1>About us</h1>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>»</span></li>
                    <li><a href="{{ route('about') }}">About us</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Page-wrapper-Start -->
    <div class="page_wrapper">
        <!-- Overview Section Start -->
        <section class="row_am service_section about_service">
            <div class="container">
                <div class="row service_blocks">
                    <div class="col-md-6">
                        <div class="service_text" data-aos="fade-up" data-aos-duration="1500">
                            @if($overview['badge_text'])
                                <div class="title_badge">
                                    <span>{{ $overview['badge_text'] }}</span>
                                </div>
                            @endif
                            <h2>{{ $overview['heading'] }}</h2>
                            <p>{{ $overview['description'] }}</p>
                            @if(!empty($overview['features']))
                                <ul class="feature_list">
                                    @foreach($overview['features'] as $feature)
                                        <li>
                                            <div class="icon">
                                                <span><i class="icofont-check-circled"></i></span>
                                            </div>
                                            <div class="text">
                                                <p>{{ $feature }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="btn_block">
                                <a href="{{ $overview['button_url'] }}" class="btn puprple_btn ml-0">{{ $overview['button_text'] }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner_block rotate_left" data-aos="fade-up" data-aos-duration="1500">
                            <div class="img video_player">
                                @if($overview['image'])
                                    <img src="{{ asset('storage/' . $overview['image']) }}" alt="">
                                @else
                                    <img src="{{ asset('images/about_service_1.webp') }}" alt="">
                                @endif
                                @if($overview['video_url'])
                                    <a href="#" class="popup-youtube play-button play_icon" data-url="{{ $overview['video_url'] }}" data-toggle="modal" data-target="#myModal" title="CLICK to WATCH VIDEO">
                                        <img src="{{ asset('images/play_white.webp') }}" alt="img">
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Overview Section End -->

        <!-- Statistics Section Start -->
        <section class="why_choose row_am white_text" data-aos="fade-in" data-aos-duration="1500">
            <div class="why_choose_inner">
                <div class="blure_shape bs_1"></div>
                <div class="blure_shape bs_2"></div>
                <div class="container">
                    <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                        @if($statistics['badge_text'])
                            <span class="title_badge">{{ $statistics['badge_text'] }}</span>
                        @endif
                        <h2>{{ $statistics['heading'] }}</h2>
                        <p>{{ $statistics['description'] }}</p>
                    </div>
                    <div class="company_statistics">
                        <ul class="app_statstic" id="counter" data-aos="fade-in" data-aos-duration="1500">
                            @foreach($statistics['stats'] ?? [] as $stat)
                                <li data-aos="fade-up" data-aos-duration="1500">
                                    <div class="text">
                                        <div class="usp_img">
                                            <img src="{{ asset('images/' . ($stat['icon'] ?? 'uspa.webp')) }}" alt="image">
                                        </div>
                                        <p>
                                            <span class="counter-value" data-count="{{ $stat['value'] ?? '0' }}">0</span>
                                            <span>{{ str_contains($stat['value'] ?? '', 'M') ? 'M+' : '+' }}</span>
                                        </p>
                                        <p>{{ $stat['label'] ?? '' }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Statistics Section End -->

        <!-- About Us Section Start -->
        <section class="about_us_section">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                    @if($aboutUs['badge_text'])
                        <span class="title_badge">{{ $aboutUs['badge_text'] }}</span>
                    @endif
                    <h2>{{ $aboutUs['heading'] }}</h2>
                    <p>{{ $aboutUs['description'] }}</p>
                </div>
            </div>
            <div class="about_slider row_am" data-aos="fade-in" data-aos-duration="1500">
                <div class="owl-carousel owl-theme" id="about_slider">
                    @forelse($aboutUs['slider_images'] ?? [] as $image)
                        <div class="item">
                            <div class="abt_slides">
                                <img src="{{ asset('storage/' . $image) }}" alt="image">
                            </div>
                        </div>
                    @empty
                        @for($i = 1; $i <= 10; $i++)
                            <div class="item">
                                <div class="abt_slides">
                                    <img src="{{ asset('images/dish' . $i . '.webp') }}" alt="image">
                                </div>
                            </div>
                        @endfor
                    @endforelse
                </div>
            </div>
        </section>
        <!-- About Us Section End -->

        <!-- Facts Section Start -->
        <section class="row_am service_section about_service">
            <div class="container">
                <div class="row service_blocks flex-row-reverse">
                    <div class="col-md-6">
                        <div class="service_text right_side" data-aos="fade-up" data-aos-duration="1500">
                            @if($facts['badge_text'])
                                <div class="title_badge">
                                    <span>{{ $facts['badge_text'] }}</span>
                                </div>
                            @endif
                            <h2>{{ $facts['heading'] }}</h2>
                            <p>{{ $facts['description'] }}</p>
                            @if(!empty($facts['features']))
                                <ul class="feature_list">
                                    @foreach($facts['features'] as $feature)
                                        <li>
                                            <div class="icon">
                                                <span><i class="icofont-check-circled"></i></span>
                                            </div>
                                            <div class="text">
                                                <p>{{ $feature }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="btn_block">
                                <a href="{{ $facts['button_url'] }}" class="btn puprple_btn ml-0">{{ $facts['button_text'] }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner_block rotate_right" data-aos="fade-up" data-aos-duration="1500">
                            <div class="img">
                                @if($facts['image'])
                                    <img src="{{ asset('storage/' . $facts['image']) }}" alt="">
                                @else
                                    <img src="{{ asset('images/about_service_2.webp') }}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Facts Section End -->

        <!-- Text Flow Section Start -->
        @if(!empty($textFlow))
        <div class="text_list_section tls_aboutpage row_am" data-aos="fade-in" data-aos-duration="1500">
            <div class="container">
                <span class="title_badge down_fix">Why choose our app</span>
            </div>
            <div class="slider_block">
                <div class="owl-carousel owl-theme" id="text_list_flow">
                    @foreach($textFlow as $item)
                        <div class="item">
                            <div class="text_block">
                                <span>{{ $item }}</span>
                                <span class="mark_star">•</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <!-- Text Flow Section End -->

        <!-- Testimonial Section Start -->
        @if($testimonials && $testimonials->count() > 0)
        <section class="testimonial_section" data-aos="fade-in" data-aos-duration="1500">
            <div class="testimonial_inner">
                <div class="testimonial_side_element">
                    <img src="{{ asset('images/thumbup2.webp') }}" alt="image">
                </div>
                <div class="container">
                    <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                        <span class="title_badge">Reviews</span>
                        <h2>Client Testimonials</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing indus orem Ipsum has been the industrys standard dummy text ever since.</p>
                    </div>
                    <div class="testimonial_slides">
                        <div class="owl-carousel owl-theme" id="testimonial_slider">
                            @foreach($testimonials as $testimonial)
                                <div class="item">
                                    <div class="testimonial_box">
                                        <div class="testi_img">
                                            <img class="user_img" src="{{ asset('storage/' . $testimonial->customer_image) }}" alt="{{ $testimonial->customer_name }}">
                                        </div>
                                        <div class="testi_text">
                                            <div class="star">
                                                @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                                                    <span><i class="icofont-star"></i></span>
                                                @endfor
                                            </div>
                                            <p>{{ $testimonial->quote ?? $testimonial->full_review ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem Ipsum has been the standard dummy.' }}</p>
                                            <div class="user_info">
                                                <h6>{{ $testimonial->customer_name }}</h6>
                                                @if($testimonial->location)
                                                    <span>{{ $testimonial->location }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- Testimonial Section End -->

        <!-- Team Section Start -->
        @if(!empty($team['members']))
        <section class="row_am experts_team_section">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                    @if($team['badge_text'])
                        <span class="title_badge">{{ $team['badge_text'] }}</span>
                    @endif
                    <h2>{{ $team['heading'] }}</h2>
                    <p>{{ $team['description'] }}</p>
                </div>
                <div class="row">
                    @foreach($team['members'] as $index => $member)
                        <div class="col-md-4" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div class="experts_box">
                                @if(isset($member['image']) && $member['image'])
                                    <img src="{{ asset('storage/' . $member['image']) }}" alt="{{ $member['name'] ?? 'Team Member' }}">
                                @else
                                    <img src="{{ asset('images/team_0' . (($index % 3) + 1) . '.webp') }}" alt="image">
                                @endif
                                <div class="text">
                                    <h6>{{ $member['name'] ?? '' }}</h6>
                                    <span>{{ $member['position'] ?? '' }}</span>
                                    @if(isset($member['social_links']) && is_array($member['social_links']))
                                        <ul class="social_media">
                                            @foreach($member['social_links'] as $platform => $url)
                                                @if($url)
                                                    <li>
                                                        <a href="{{ $url }}">
                                                            <i class="icofont-{{ $platform }}"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="social_media">
                                            <li><a href="#"><i class="icofont-facebook"></i></a></li>
                                            <li><a href="#"><i class="icofont-twitter"></i></a></li>
                                            <li><a href="#"><i class="icofont-instagram"></i></a></li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
        <!-- Team Section End -->

        <!-- FAQ Section Start -->
        @if(!empty($faq['items']))
        <section class="row_am faq_section" id="faqsec">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                    @if($faq['badge_text'])
                        <span class="title_badge">{{ $faq['badge_text'] }}</span>
                    @endif
                    <h2>{{ $faq['heading'] }}</h2>
                </div>
                <div class="faq_blocks" data-aos="fade-up" data-aos-duration="1500">
                    <div class="accordion" id="accordionExample">
                        <div class="row">
                            <div class="col-md-6">
                                @foreach(array_slice($faq['items'], 0, ceil(count($faq['items']) / 2)) as $index => $item)
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $index }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link btn-block text-left {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-toggle="collapse" data-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                                    {{ $item['question'] ?? '' }}
                                                    <span class="icons">
                                                        <i class="icofont-plus"></i>
                                                        <i class="icofont-minus"></i>
                                                    </span>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse{{ $index }}" class="collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-parent="#accordionExample">
                                            <div class="card-body">
                                                {{ $item['answer'] ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                @foreach(array_slice($faq['items'], ceil(count($faq['items']) / 2)) as $index => $item)
                                    @php $realIndex = $index + ceil(count($faq['items']) / 2); @endphp
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $realIndex }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse{{ $realIndex }}" aria-expanded="false" aria-controls="collapse{{ $realIndex }}">
                                                    {{ $item['question'] ?? '' }}
                                                    <span class="icons">
                                                        <i class="icofont-plus"></i>
                                                        <i class="icofont-minus"></i>
                                                    </span>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse{{ $realIndex }}" class="collapse" aria-labelledby="heading{{ $realIndex }}" data-parent="#accordionExample">
                                            <div class="card-body">
                                                {{ $item['answer'] ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- FAQ Section End -->

        <!-- Pre-Footer CTA Section -->
        @include('partials.pre-footer-cta')

        @include('partials.footer', [
            'footerLogo' => $footerLogo ?? null,
            'footerDetails' => $footerDetails ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem sum has been the industrys standard dummytext ever since the when an unknown printer took.',
            'footerQuickLinks' => $footerQuickLinks ?? collect(),
            'footerSupportMenus' => $footerSupportMenus ?? collect(),
            'footerAppStoreButtons' => $footerAppStoreButtons ?? null,
            'footerSocialLinks' => $footerSocialLinks ?? collect(),
            'footerCopyrightText' => $footerCopyrightText ?? '© Copyrights %Y. All rights reserved.'
        ])
    </div>
    <!-- Page-wrapper-End -->

</body>
</html>

