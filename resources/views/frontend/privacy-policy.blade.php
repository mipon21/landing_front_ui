<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    @php
        $pageTitle = 'Privacy Policy : ' . $siteName;
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
                <h1>Privacy Policy</h1>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>»</span></li>
                    <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Page-wrapper-Start -->
    <div class="page_wrapper">
        <!-- Privacy Policy Content Section Start -->
        <section class="row_am content_page_section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content_wrapper" data-aos="fade-up" data-aos-duration="1500">
                            <div class="content_text">
                                {!! $content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Privacy Policy Content Section End -->
    </div>
    <!-- Page-wrapper-End -->

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

    <!-- jQuery library -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- AOS JS -->
    <script src="{{ asset('js/aos.js') }}"></script>
    <!-- Typed JS -->
    <script src="{{ asset('js/typed.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>

