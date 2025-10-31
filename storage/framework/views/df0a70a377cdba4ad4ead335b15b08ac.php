<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Order your favorite meals with ease using our Food Delivery mobile app. Browse local restaurants, customize your order, and enjoy fast, reliable delivery straight to your door. Download now for convenient, delicious dining at your fingertips.">
    <title>Food Delivery Mobile App Landing Page HTML Template</title>

    <!-- icofont-css-link -->
    <link rel="stylesheet" href="<?php echo e(asset('css/icofont.min.css')); ?>">
    <!-- Owl-Carosal-Style-link -->
    <link rel="stylesheet" href="<?php echo e(asset('css/owl.carousel.min.css')); ?>">
    <!-- Bootstrap-Style-link -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <!-- Aos-Style-link -->
    <link rel="stylesheet" href="<?php echo e(asset('css/aos.css')); ?>">
    <!-- Coustome-Style-link -->
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <!-- Responsive-Style-link -->
    <link rel="stylesheet" href="<?php echo e(asset('css/responsive.css')); ?>">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.webp')); ?>" type="image/x-icon">
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

    <!-- Header Start -->
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                    <img src="<?php echo e(asset('images/logo.webp')); ?>" alt="Logo">
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
                        <li class="nav-item has_dropdown">
                            <a class="nav-link" href="<?php echo e(route('home')); ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reviews.html">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                        <li class="nav-item">
                            <div class="btn_block">
                                <a class="nav-link dark_btn" href="contact.html">7 Days Free Trial</a>
                                <div class="btn_bottom"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Banner-Section-Start -->
    <section class="banner_section" id="home_sec">
        <!-- hero bg -->
        <?php if($hero && $hero->background_image): ?>
        <div class="hero_bg">
            <img src="<?php echo e(asset('storage/' . $hero->background_image)); ?>" alt="image">
        </div>
        <?php else: ?>
        <div class="hero_bg">
            <img src="<?php echo e(asset('images/hero_bg.webp')); ?>" alt="image">
        </div>
        <?php endif; ?>

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
                            <?php if($hero && $hero->heading): ?>
                                <?php echo $hero->heading; ?>

                            <?php else: ?>
                                Fast & best <span> food delivery </span> services in your town
                            <?php endif; ?>
                        </h1>
                        <!-- p -->
                        <p>
                            <?php if($hero && $hero->description): ?>
                                <?php echo e($hero->description); ?>

                            <?php else: ?>
                                We commit to delivering your food to you within 30 minutes. if we would fail, we will give the food free.
                            <?php endif; ?>
                        </p>
                    </div>

                    <!-- users -->
                    <div class="used_app">
                        <ul>
                            <?php if($hero && $hero->user_avatars && count($hero->user_avatars) > 0): ?>
                                <?php $__currentLoopData = $hero->user_avatars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avatar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><img src="<?php echo e(asset('images/' . $avatar)); ?>" alt="image"></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <li><img src="<?php echo e(asset('images/banavt1.webp')); ?>" alt="image"></li>
                                <li><img src="<?php echo e(asset('images/banavt2.webp')); ?>" alt="image"></li>
                                <li><img src="<?php echo e(asset('images/banavt3.webp')); ?>" alt="image"></li>
                            <?php endif; ?>
                            <?php if($hero && $hero->video_url): ?>
                            <li>
                                <a href="#" class="popup-youtube play-button" data-url="<?php echo e($hero->video_url); ?>" data-toggle="modal" data-target="#myModal">
                                    <img src="<?php echo e(asset('images/play.webp')); ?>" alt="img">
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <p>
                            <?php if($hero && $hero->active_users_text): ?>
                                <?php echo e($hero->active_users_text); ?>

                            <?php else: ?>
                                25k + Active users
                            <?php endif; ?>
                            <br>
                            <span>
                                <i class="icofont-star"></i>
                                <?php if($hero && $hero->rating_text): ?>
                                    <?php echo e($hero->rating_text); ?>

                                <?php else: ?>
                                    4.5 / 5.0 ( 20k + Reviews)
                                <?php endif; ?>
                            </span>
                        </p>
                    </div>

                    <!-- app buttons -->
                    <ul class="app_btn">
                        <li>
                            <a href="<?php echo e($hero && $hero->google_play_url ? $hero->google_play_url : '#'); ?>">
                                <?php if($hero && $hero->google_play_image): ?>
                                    <img class="blue_img" src="<?php echo e(asset('storage/' . $hero->google_play_image)); ?>" alt="image">
                                <?php else: ?>
                                    <img class="blue_img" src="<?php echo e(asset('images/googleplay.webp')); ?>" alt="image">
                                <?php endif; ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e($hero && $hero->app_store_url ? $hero->app_store_url : '#'); ?>">
                                <?php if($hero && $hero->app_store_image): ?>
                                    <img class="blue_img" src="<?php echo e(asset('storage/' . $hero->app_store_image)); ?>" alt="image">
                                <?php else: ?>
                                    <img class="blue_img" src="<?php echo e(asset('images/appstorebtn.webp')); ?>" alt="image">
                                <?php endif; ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- banner image start -->
                <div class="col-lg-6 col-md-12">
                    <div class="hero_img">
                        <?php if($hero && $hero->hero_image): ?>
                            <img src="<?php echo e(asset('storage/' . $hero->hero_image)); ?>" alt="image">
                        <?php else: ?>
                            <img src="<?php echo e(asset('images/hero_image.webp')); ?>" alt="image">
                        <?php endif; ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $statistics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="usp_box">
                                    <div class="usp_icon">
                                        <?php if($stat->icon): ?>
                                            <img src="<?php echo e(asset('storage/' . $stat->icon)); ?>" alt="image">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('images/usp1.webp')); ?>" alt="image">
                                        <?php endif; ?>
                                    </div>
                                    <div class="usp_text">
                                        <span class="counter-value" data-count="<?php echo e($stat->value); ?>"><?php echo e($stat->value); ?></span>
                                        <span><?php echo e($stat->suffix); ?></span>
                                        <p><?php echo e($stat->label); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <!-- Default static statistics if none in database -->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="usp_box">
                                    <div class="usp_icon"><img src="<?php echo e(asset('images/usp1.webp')); ?>" alt="image"></div>
                                    <div class="usp_text">
                                        <span class="counter-value" data-count="5000">5000</span><span>+</span>
                                        <p>Happy Users</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="usp_box">
                                    <div class="usp_icon"><img src="<?php echo e(asset('images/usp2.webp')); ?>" alt="image"></div>
                                    <div class="usp_text">
                                        <span class="counter-value" data-count="1879">1879</span><span>+</span>
                                        <p>Positive Reviews</p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Trusted Section start -->
        <section class="row_am trusted_section">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                    <h4>Trusted by 2.5k+ restaurant</h4>
                </div>

                <div class="company_logos">
                    <div id="company_slider" class="owl-carousel owl-theme">
                        <?php $__empty_1 = true; $__currentLoopData = $restaurantLogos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="item">
                                <div class="logo">
                                    <img src="<?php echo e(asset('storage/' . $logo->logo_image)); ?>" alt="<?php echo e($logo->alt_text ?? 'Restaurant Logo'); ?>">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <!-- Default logos if none in database -->
                            <?php for($i = 1; $i <= 8; $i++): ?>
                                <div class="item">
                                    <div class="logo">
                                        <img src="<?php echo e(asset('images/res' . $i . '.webp')); ?>" alt="Restaurant Logo">
                                    </div>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="ctr_cta">
                    <div class="btn_block">
                        <a href="blog-detail.html" class="btn puprple_btn ml-0">Register Your Restaurant</a>
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
                            <?php if($whyChooseUs && count($whyChooseUs) > 0 && $whyChooseUs[0]->badge_text): ?>
                                <span class="title_badge"><?php echo e($whyChooseUs[0]->badge_text); ?></span>
                            <?php else: ?>
                                <span class="title_badge">why use Appiq</span>
                            <?php endif; ?>
                            <h2>
                                <?php if($whyChooseUs && count($whyChooseUs) > 0 && $whyChooseUs[0]->heading): ?>
                                    <?php echo e($whyChooseUs[0]->heading); ?>

                                <?php else: ?>
                                    Why choose us
                                <?php endif; ?>
                            </h2>
                            <p>
                                <?php if($whyChooseUs && count($whyChooseUs) > 0 && $whyChooseUs[0]->description): ?>
                                    <?php echo e($whyChooseUs[0]->description); ?>

                                <?php else: ?>
                                    Lorem Ipsum is simply dummy text of the printing and typese tting indus orem Ipsum has beenthe standard dummy.
                                <?php endif; ?>
                            </p>
                        </div>

                        <div class="dtat_box">
                            <div class="col-lg-6 col-md-12">
                                <div class="why_new_left_data">
                                    <?php $__empty_1 = true; $__currentLoopData = $whyChooseUs->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="why_data_block" data-aos="fade-right" data-aos-duration="1500">
                                            <div class="icon">
                                                <?php if($feature->icon): ?>
                                                    <img src="<?php echo e(asset('storage/' . $feature->icon)); ?>" alt="<?php echo e($feature->title); ?>">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('images/whyicon' . (($loop->index % 3) + 1) . '.webp')); ?>" alt="image">
                                                <?php endif; ?>
                                            </div>
                                            <div class="text">
                                                <h6><?php echo e($feature->title); ?></h6>
                                                <p><?php echo e($feature->content); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <!-- Default features -->
                                        <div class="why_data_block" data-aos="fade-right" data-aos-duration="1500">
                                            <div class="icon"><img src="<?php echo e(asset('images/whyicon1.webp')); ?>" alt="image"></div>
                                            <div class="text">
                                                <h6>Delivery in 30 min</h6>
                                                <p>Get your favorite meals delivered fresh and fast to your door in just 30 minutes! Enjoy the convenience!</p>
                                            </div>
                                        </div>
                                        <div class="why_data_block" data-aos="fade-right" data-aos-duration="1500">
                                            <div class="icon"><img src="<?php echo e(asset('images/whyicon2.webp')); ?>" alt="image"></div>
                                            <div class="text">
                                                <h6>Quality Food</h6>
                                                <p>Enjoy premium meals from top local restaurants, expertly crafted to satisfy your taste and elevate your dining experience!</p>
                                            </div>
                                        </div>
                                        <div class="why_data_block" data-aos="fade-right" data-aos-duration="1500">
                                            <div class="icon"><img src="<?php echo e(asset('images/whyicon3.webp')); ?>" alt="image"></div>
                                            <div class="text">
                                                <h6>Track Live Map</h6>
                                                <p>Easily track your order in real-time with our live map feature, ultimate convenience and keeping you updated every step of the way!</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="why_us_new_img" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                    <?php if($whyChooseUs && count($whyChooseUs) > 0 && $whyChooseUs[0]->feature_image): ?>
                                        <img src="<?php echo e(asset('storage/' . $whyChooseUs[0]->feature_image)); ?>" alt="image">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('images/features_frame.webp')); ?>" alt="image">
                                    <?php endif; ?>
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
                    <?php $__empty_1 = true; $__currentLoopData = $dishes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dish): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="item">
                            <div class="dish_slides">
                                <img src="<?php echo e(asset('storage/' . $dish->image)); ?>" alt="<?php echo e($dish->name ?? 'Dish'); ?>">
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <!-- Default dishes if none in database -->
                        <?php for($i = 1; $i <= 10; $i++): ?>
                            <div class="item">
                                <div class="dish_slides">
                                    <img src="<?php echo e(asset('images/dish' . $i . '.webp')); ?>" alt="Dish">
                                </div>
                            </div>
                        <?php endfor; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="ctr_app_btn_block">
                <p><strong>Free food delivery for first 5 orders!</strong></p>
                <ul class="app_btn">
                    <li>
                        <a href="<?php echo e($hero && $hero->google_play_url ? $hero->google_play_url : '#'); ?>">
                            <img class="blue_img" src="<?php echo e(asset('images/googleplay.webp')); ?>" alt="image">
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e($hero && $hero->app_store_url ? $hero->app_store_url : '#'); ?>">
                            <img class="blue_img" src="<?php echo e(asset('images/appstorebtn.webp')); ?>" alt="image">
                        </a>
                    </li>
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

                <?php
                    $restaurantService = $services->where('type', 'restaurant')->first();
                    $customerService = $services->where('type', 'customer')->first();
                ?>

                <div class="row service_blocks flex-row-reverse">
                    <div class="col-md-6">
                        <div class="service_text right_side" data-aos="fade-up" data-aos-duration="1500">
                            <?php if($restaurantService): ?>
                                <?php if($restaurantService->badge_text): ?>
                                    <span class="title_badge"><?php echo e($restaurantService->badge_text); ?></span>
                                <?php else: ?>
                                    <span class="title_badge">for restaurant</span>
                                <?php endif; ?>
                                <h3><?php echo e($restaurantService->heading); ?></h3>
                                <p><?php echo e($restaurantService->description); ?></p>
                                <?php if($restaurantService->features && is_array($restaurantService->features)): ?>
                                    <ul class="design_block">
                                        <?php $__currentLoopData = $restaurantService->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li data-aos="fade-up" data-aos-duration="1500">
                                                <h6><?php echo e($feature['title'] ?? ''); ?></h6>
                                                <p><?php echo e($feature['description'] ?? ''); ?></p>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php else: ?>
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
                                <?php endif; ?>
                                <div class="btn_block">
                                    <a href="<?php echo e($restaurantService->button_url ?? '#'); ?>" class="btn puprple_btn ml-0"><?php echo e($restaurantService->button_text ?? 'Register Your Restaurant'); ?></a>
                                </div>
                            <?php else: ?>
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
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner_block dark_bg rotate_right" data-aos="fade-up" data-aos-duration="1500">
                            <div class="img">
                                <?php if($restaurantService && $restaurantService->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $restaurantService->image)); ?>" alt="image">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/for_restaurant.webp')); ?>" alt="image">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row service_blocks no_bottom_padding">
                    <div class="col-md-6">
                        <div class="service_text" data-aos="fade-up" data-aos-duration="1500">
                            <?php if($customerService): ?>
                                <?php if($customerService->badge_text): ?>
                                    <span class="title_badge"><?php echo e($customerService->badge_text); ?></span>
                                <?php else: ?>
                                    <span class="title_badge">for customer</span>
                                <?php endif; ?>
                                <h3><?php echo e($customerService->heading); ?></h3>
                                <p><?php echo e($customerService->description); ?></p>
                                <?php if($customerService->features && is_array($customerService->features)): ?>
                                    <ul class="design_block">
                                        <?php $__currentLoopData = $customerService->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li data-aos="fade-up" data-aos-duration="1500">
                                                <h6><?php echo e($feature['title'] ?? ''); ?></h6>
                                                <p><?php echo e($feature['description'] ?? ''); ?></p>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php else: ?>
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
                                <?php endif; ?>
                                <div class="btn_block">
                                    <a href="<?php echo e($customerService->button_url ?? '#'); ?>" class="btn puprple_btn ml-0"><?php echo e($customerService->button_text ?? 'Download App'); ?></a>
                                </div>
                            <?php else: ?>
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
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner_block" data-aos="fade-up" data-aos-duration="1500">
                            <div class="img">
                                <?php if($customerService && $customerService->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $customerService->image)); ?>" alt="image">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/for_customer.webp')); ?>" alt="image">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <?php if($howItWorks && count($howItWorks) > 0 && $howItWorks[0]->badge_text): ?>
                            <span class="title_badge"><?php echo e($howItWorks[0]->badge_text); ?></span>
                        <?php else: ?>
                            <span class="title_badge">Easy Steps</span>
                        <?php endif; ?>
                        <h2>
                            <?php if($howItWorks && count($howItWorks) > 0 && $howItWorks[0]->heading): ?>
                                <?php echo e($howItWorks[0]->heading); ?>

                            <?php else: ?>
                                How it Works
                            <?php endif; ?>
                        </h2>
                        <p>
                            <?php if($howItWorks && count($howItWorks) > 0 && $howItWorks[0]->description): ?>
                                <?php echo e($howItWorks[0]->description); ?>

                            <?php else: ?>
                                Lorem Ipsum is simply dummy text of the printing indus orem Ipsum has been the industrys standard dummy text ever since.
                            <?php endif; ?>
                        </p>
                    </div>

                    <div class="af_listing">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="listing_inner">
                                    <?php $__empty_1 = true; $__currentLoopData = $howItWorks->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="af_block" data-aos="fade-up" data-aos-duration="1500">
                                            <div class="img">
                                                <?php if($step->step_image): ?>
                                                    <img src="<?php echo e(asset('storage/' . $step->step_image)); ?>" alt="<?php echo e($step->step_title); ?>">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('images/how' . ($step->step_number ?? $loop->index + 1) . '.webp')); ?>" alt="image">
                                                <?php endif; ?>
                                            </div>
                                            <div class="text">
                                                <h5><?php echo e($step->step_title); ?></h5>
                                                <p><?php echo e($step->step_description); ?></p>
                                            </div>
                                            <div class="process_num"><?php echo e(str_pad($step->step_number ?? ($loop->index + 1), 2, '0', STR_PAD_LEFT)); ?></div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <!-- Default steps -->
                                        <div class="af_block" data-aos="fade-up" data-aos-duration="1500">
                                            <div class="img"><img src="<?php echo e(asset('images/how1.webp')); ?>" alt="image"></div>
                                            <div class="text">
                                                <h5>Download App & create a free account</h5>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem Ipsum has.</p>
                                            </div>
                                            <div class="process_num">01</div>
                                        </div>
                                        <div class="af_block" data-aos="fade-up" data-aos-duration="1500">
                                            <div class="img"><img src="<?php echo e(asset('images/how2.webp')); ?>" alt="image"></div>
                                            <div class="text">
                                                <h5>Place orders at your preferred eatery</h5>
                                                <p>Dummy text of the printing and typesetting industry lorem Ipsum has been the industrys.</p>
                                            </div>
                                            <div class="process_num">02</div>
                                        </div>
                                        <div class="af_block" data-aos="fade-up" data-aos-duration="1500">
                                            <div class="img"><img src="<?php echo e(asset('images/how3.webp')); ?>" alt="image"></div>
                                            <div class="text">
                                                <h5>Get it delivered directly to your home, effortlessly</h5>
                                                <p>Printing and typesetting industry lorem Ipsum has been the industrys standard dummy.</p>
                                            </div>
                                            <div class="process_num">03</div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="ctr_app_btn_block">
                                    <p><strong>Get 50% off on your first order ! Grab it now.</strong></p>
                                    <ul class="app_btn">
                                        <li>
                                            <a href="<?php echo e($hero && $hero->google_play_url ? $hero->google_play_url : '#'); ?>">
                                                <img class="blue_img" src="<?php echo e(asset('images/googleplay.webp')); ?>" alt="image">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e($hero && $hero->app_store_url ? $hero->app_store_url : '#'); ?>">
                                                <img class="blue_img" src="<?php echo e(asset('images/appstorebtn.webp')); ?>" alt="image">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="device">
                <img src="<?php echo e(asset('images/device.webp')); ?>" alt="image">
            </div>
        </section>
        <!-- How it Works Section End -->

        <!-- Success stories Section Start -->
        <section class="key_feature_section row_am" id="review_sec">
            <div class="kf_side_element left_side"><img src="<?php echo e(asset('images/thumbup.webp')); ?>" alt="image"></div>
            <div class="kf_side_element right_side"><img src="<?php echo e(asset('images/like.webp')); ?>" alt="image"></div>

            <div class="key_innner">
                <div class="container">
                    <div class="section_title">
                        <span class="title_badge">Testimonials</span>
                        <h2>Our happy clients</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing indus orem Ipsum has been the industrys standard dummy text ever since.</p>
                    </div>

                    <div id="feature_slider" class="owl-carousel owl-theme" data-aos="fade-up" data-aos-duration="1500">
                        <?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="item">
                                <div class="feature_box">
                                    <div class="img">
                                        <img src="<?php echo e(asset('storage/' . $testimonial->customer_image)); ?>" alt="<?php echo e($testimonial->customer_name); ?>">
                                    </div>
                                    <div class="txt_blk">
                                        <h6><?php echo e($testimonial->customer_name); ?></h6>
                                        <div class="rating">
                                            <?php for($i = 0; $i < $testimonial->rating; $i++): ?>
                                                <span><i class="icofont-star"></i></span>
                                            <?php endfor; ?>
                                        </div>
                                        <p>
                                            <span class="story_bold">"<?php echo e($testimonial->quote); ?>"</span>
                                            <?php if($testimonial->full_review): ?>
                                                <?php echo e(Str::limit($testimonial->full_review, 100)); ?>

                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="quote_img">
                                        <img src="<?php echo e(asset('images/quote.webp')); ?>" alt="image">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <!-- Default testimonials -->
                            <div class="item">
                                <div class="feature_box">
                                    <div class="img">
                                        <img src="<?php echo e(asset('images/story1.webp')); ?>" alt="image">
                                    </div>
                                    <div class="txt_blk">
                                        <h6>Olivia Sam</h6>
                                        <div class="rating">
                                            <?php for($i = 0; $i < 5; $i++): ?>
                                                <span><i class="icofont-star"></i></span>
                                            <?php endfor; ?>
                                        </div>
                                        <p><span class="story_bold">"Delivery on time every order!"</span> Lorem Ipsum is simply dummy text of the printing the industrys standard dummytextever since.</p>
                                    </div>
                                    <div class="quote_img">
                                        <img src="<?php echo e(asset('images/quote.webp')); ?>" alt="image">
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="ctr_cta">
                        <div class="btn_block">
                            <a href="blog-detail.html" class="btn puprple_btn ml-0">Read More Success Story</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- App-Download-New-Section-Start -->
        <?php if($downloadSection): ?>
        <section class="row_am download_app_new" id="download_sec">
            <div class="dap_block" data-aos="fade-up" data-aos-duration="1500">
                <div class="blure_shape bs_1"></div>

                <div class="row">
                    <div class="col-lg-3 col-md-12 order-2 order-lg-1">
                        <div class="dap_image left">
                            <?php if($downloadSection->left_image): ?>
                                <img class="dap_desktop_img" src="<?php echo e(asset('storage/' . $downloadSection->left_image)); ?>" alt="image">
                            <?php else: ?>
                                <img class="dap_desktop_img" src="<?php echo e(asset('images/download_food1.webp')); ?>" alt="image">
                            <?php endif; ?>
                            <?php if($downloadSection->mobile_image): ?>
                                <img class="dap_mobile_img" src="<?php echo e(asset('storage/' . $downloadSection->mobile_image)); ?>" alt="image">
                            <?php else: ?>
                                <img class="dap_mobile_img" src="<?php echo e(asset('images/download_food3.webp')); ?>" alt="image">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                        <div class="dap_text">
                            <div class="section_title white_text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                <?php if($downloadSection->badge_text): ?>
                                    <span class="title_badge"><?php echo e($downloadSection->badge_text); ?></span>
                                <?php else: ?>
                                    <span class="title_badge">Download</span>
                                <?php endif; ?>
                                <h2><?php echo e($downloadSection->heading); ?></h2>
                                <p><?php echo e($downloadSection->description); ?></p>
                            </div>
                            <ul class="app_btn" data-aos="fade-up" data-aos-duration="1500">
                                <li>
                                    <a href="<?php echo e($downloadSection->google_play_url ?? ($hero && $hero->google_play_url ? $hero->google_play_url : '#')); ?>">
                                        <img class="blue_img" src="<?php echo e(asset('images/googleplay.webp')); ?>" alt="image">
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e($downloadSection->app_store_url ?? ($hero && $hero->app_store_url ? $hero->app_store_url : '#')); ?>">
                                        <img class="blue_img" src="<?php echo e(asset('images/appstorebtn.webp')); ?>" alt="image">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12 order-3 order-lg-3 d-none d-lg-block">
                        <div class="dap_image right">
                            <?php if($downloadSection->right_image): ?>
                                <img src="<?php echo e(asset('storage/' . $downloadSection->right_image)); ?>" alt="image">
                            <?php else: ?>
                                <img src="<?php echo e(asset('images/download_food2.webp')); ?>" alt="image">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php else: ?>
        <!-- Default App Download Section -->
        <section class="row_am download_app_new" id="download_sec">
            <div class="dap_block" data-aos="fade-up" data-aos-duration="1500">
                <div class="blure_shape bs_1"></div>
                <div class="row">
                    <div class="col-lg-3 col-md-12 order-2 order-lg-1">
                        <div class="dap_image left">
                            <img class="dap_desktop_img" src="<?php echo e(asset('images/download_food1.webp')); ?>" alt="image">
                            <img class="dap_mobile_img" src="<?php echo e(asset('images/download_food3.webp')); ?>" alt="image">
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
                                    <a href="<?php echo e($hero && $hero->google_play_url ? $hero->google_play_url : '#'); ?>">
                                        <img class="blue_img" src="<?php echo e(asset('images/googleplay.webp')); ?>" alt="image">
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e($hero && $hero->app_store_url ? $hero->app_store_url : '#'); ?>">
                                        <img class="blue_img" src="<?php echo e(asset('images/appstorebtn.webp')); ?>" alt="image">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 order-3 order-lg-3 d-none d-lg-block">
                        <div class="dap_image right">
                            <img src="<?php echo e(asset('images/download_food2.webp')); ?>" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <!-- App-Download-New-Section-end -->

        <!-- Register Restaurant Section Start -->
        <?php if($registerSection): ?>
        <section class="row_am register_restaurant">
            <div class="reg_block" data-aos="fade-up" data-aos-duration="1500">
                <div class="row">
                    <div class="col-lg-7 col-md-10 col-sm-12 mx-auto">
                        <div class="dap_text">
                            <div class="section_title white_text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                                <?php if($registerSection->badge_text): ?>
                                    <span class="title_badge"><?php echo e($registerSection->badge_text); ?></span>
                                <?php else: ?>
                                    <span class="title_badge">register restaurant</span>
                                <?php endif; ?>
                                <h2><?php echo e($registerSection->heading); ?></h2>
                                <p><?php echo e($registerSection->description); ?></p>
                            </div>
                            <div class="ctr_cta">
                                <div class="btn_block">
                                    <a href="<?php echo e($registerSection->button_url ?? '#'); ?>" class="btn puprple_btn ml-0"><?php echo e($registerSection->promo_text ?? 'Register Restaurant'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php else: ?>
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
        <?php endif; ?>
        <!-- Register Restaurant Section end -->

        <!-- Blog Section Start -->
        <section class="blog_section row_am">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                    <span class="title_badge">Blog Post</span>
                    <h2>Insights & inspirations</h2>
                </div>

                <div class="blog_listing">
                    <?php $__empty_1 = true; $__currentLoopData = $blogPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="blog_post" data-aos="fade-up" data-aos-duration="1500">
                            <a href="#" class="img">
                                <?php if($post->featured_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $post->featured_image)); ?>" alt="<?php echo e($post->title); ?>">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/blog1.webp')); ?>" alt="<?php echo e($post->title); ?>">
                                <?php endif; ?>
                            </a>
                            <div class="text">
                                <ul class="blog_info">
                                    <li><?php echo e($post->author); ?></li>
                                    <li><?php echo e($post->published_at ? $post->published_at->format('M d, Y') : now()->format('M d, Y')); ?></li>
                                    <li><?php echo e($post->comment_count); ?> Comments</li>
                                </ul>
                                <h5><a href="#"><?php echo e($post->title); ?></a></h5>
                                <div class="tag_more">
                                    <?php if($post->category): ?>
                                        <span class="tag"><?php echo e($post->category); ?></span>
                                    <?php endif; ?>
                                    <a href="#">Read more <i class="icofont-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <!-- Default blog posts -->
                        <div class="blog_post" data-aos="fade-up" data-aos-duration="1500">
                            <a href="#" class="img">
                                <img src="<?php echo e(asset('images/blog1.webp')); ?>" alt="image">
                            </a>
                            <div class="text">
                                <ul class="blog_info">
                                    <li>Admin</li>
                                    <li>Oct 13, 2024</li>
                                    <li>25 Comments</li>
                                </ul>
                                <h5><a href="#">Top Tips for Choosing the Best Food Delivery App for Your Needs.</a></h5>
                                <div class="tag_more">
                                    <span class="tag">Food at home</span>
                                    <a href="#">Read more <i class="icofont-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Footer-Section start -->
        <footer>
            <div class="top_footer" id="contact">
                <div class="blure_shape bs_1"></div>
                <div class="blure_shape bs_2"></div>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12">
                            <div class="abt_side">
                                <div class="logo"><img src="<?php echo e(asset('images/logo_white.webp')); ?>" alt="image"></div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem sum has been the industrys standard dummytext ever since the when an unknown printer took.</p>
                                <ul class="app_btn">
                                    <li>
                                        <a href="<?php echo e($hero && $hero->app_store_url ? $hero->app_store_url : '#'); ?>">
                                            <img src="<?php echo e(asset('images/appstorebtn.webp')); ?>" alt="image">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e($hero && $hero->google_play_url ? $hero->google_play_url : '#'); ?>">
                                            <img src="<?php echo e(asset('images/googleplay.webp')); ?>" alt="image">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-6 col-12">
                            <div class="links">
                                <h5>Quick Links</h5>
                                <ul>
                                    <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                    <li><a href="about.html">About us</a></li>
                                    <li><a href="blog-list.html">Blog</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-6 col-12">
                            <div class="links">
                                <h5>Support</h5>
                                <ul>
                                    <li><a href="#">FAQs</a></li>
                                    <li><a href="#">Support</a></li>
                                    <li><a href="#">How it works</a></li>
                                    <li><a href="#">Terms & conditions</a></li>
                                    <li><a href="#">Privacy policy</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <h5>Subscribe us</h5>
                            <div class="news_letter">
                                <p>Subscribe our newsleter to receive latest updates regularly from us!</p>
                                <form>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Enter your email">
                                        <button class="btn" aria-label="subscribe"><i class="icofont-paper-plane"></i></button>
                                    </div>
                                    <p class="note">By clicking send link you agree to receive message.</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bottom_footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <p>© Copyrights 2024. All rights reserved.</p>
                            </div>
                            <div class="col-md-4">
                                <ul class="social_media">
                                    <li><a href="#" aria-label="facebook page"><i class="icofont-facebook"></i></a></li>
                                    <li><a href="#" aria-label="twitter page"><i class="icofont-twitter"></i></a></li>
                                    <li><a href="#" aria-label="instagram page"><i class="icofont-instagram"></i></a></li>
                                    <li><a href="#" aria-label="pinterest page"><i class="icofont-pinterest"></i></a></li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <p class="developer_text">Design & developed by <a href="#" target="blank">Kalanidhi Themes</a></p>
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
    <script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/aos.js')); ?>"></script>
    <script src="<?php echo e(asset('js/typed.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>

    <script>
        $("#typed").typed({
            strings: <?php echo json_encode($hero && $hero->typed_texts && count($hero->typed_texts) > 0 ? $hero->typed_texts : ["Fastest delivery", "Hygine Food", "5000+ Dishes."]) ?>,
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

<?php /**PATH D:\xampp\htdocs\landing\resources\views/frontend/index.blade.php ENDPATH**/ ?>