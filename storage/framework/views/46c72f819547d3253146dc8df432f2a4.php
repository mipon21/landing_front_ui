<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php
        $pageTitle = 'About us : ' . $siteName;
    ?>
    <title><?php echo e($pageTitle); ?></title>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="loader"></div>
    </div>

    <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- BredCrumb-Section -->
    <div class="bred_crumb">
        <div class="container">
            <span class="banner_shape1"><img src="<?php echo e(asset('images/banner-shape1.webp')); ?>" alt="image"></span>
            <span class="banner_shape2"><img src="<?php echo e(asset('images/banner-shape2.webp')); ?>" alt="image"></span>
            <div class="bred_text">
                <h1>About us</h1>
                <ul>
                    <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                    <li><span>»</span></li>
                    <li><a href="<?php echo e(route('about')); ?>">About us</a></li>
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
                            <?php if($overview['badge_text']): ?>
                                <div class="title_badge">
                                    <span><?php echo e($overview['badge_text']); ?></span>
                                </div>
                            <?php endif; ?>
                            <h2><?php echo e($overview['heading']); ?></h2>
                            <p><?php echo e($overview['description']); ?></p>
                            <?php if(!empty($overview['features'])): ?>
                                <ul class="feature_list">
                                    <?php $__currentLoopData = $overview['features']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <div class="icon">
                                                <span><i class="icofont-check-circled"></i></span>
                                            </div>
                                            <div class="text">
                                                <p><?php echo e($feature); ?></p>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                            <div class="btn_block">
                                <a href="<?php echo e($overview['button_url']); ?>" class="btn puprple_btn ml-0"><?php echo e($overview['button_text']); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner_block rotate_left" data-aos="fade-up" data-aos-duration="1500">
                            <div class="img video_player">
                                <?php if($overview['image']): ?>
                                    <img src="<?php echo e(asset('storage/' . $overview['image'])); ?>" alt="">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/about_service_1.webp')); ?>" alt="">
                                <?php endif; ?>
                                <?php if($overview['video_url']): ?>
                                    <a href="#" class="popup-youtube play-button play_icon" data-url="<?php echo e($overview['video_url']); ?>" data-toggle="modal" data-target="#myModal" title="CLICK to WATCH VIDEO">
                                        <img src="<?php echo e(asset('images/play_white.webp')); ?>" alt="img">
                                    </a>
                                <?php endif; ?>
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
                        <?php if($statistics['badge_text']): ?>
                            <span class="title_badge"><?php echo e($statistics['badge_text']); ?></span>
                        <?php endif; ?>
                        <h2><?php echo e($statistics['heading']); ?></h2>
                        <p><?php echo e($statistics['description']); ?></p>
                    </div>
                    <div class="company_statistics">
                        <ul class="app_statstic" id="counter" data-aos="fade-in" data-aos-duration="1500">
                            <?php $__currentLoopData = $statistics['stats'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li data-aos="fade-up" data-aos-duration="1500">
                                    <div class="text">
                                        <div class="usp_img">
                                            <img src="<?php echo e(asset('images/' . ($stat['icon'] ?? 'uspa.webp'))); ?>" alt="image">
                                        </div>
                                        <p>
                                            <span class="counter-value" data-count="<?php echo e($stat['value'] ?? '0'); ?>">0</span>
                                            <span><?php echo e(str_contains($stat['value'] ?? '', 'M') ? 'M+' : '+'); ?></span>
                                        </p>
                                        <p><?php echo e($stat['label'] ?? ''); ?></p>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <?php if($aboutUs['badge_text']): ?>
                        <span class="title_badge"><?php echo e($aboutUs['badge_text']); ?></span>
                    <?php endif; ?>
                    <h2><?php echo e($aboutUs['heading']); ?></h2>
                    <p><?php echo e($aboutUs['description']); ?></p>
                </div>
            </div>
            <div class="about_slider row_am" data-aos="fade-in" data-aos-duration="1500">
                <div class="owl-carousel owl-theme" id="about_slider">
                    <?php $__empty_1 = true; $__currentLoopData = $aboutUs['slider_images'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="item">
                            <div class="abt_slides">
                                <img src="<?php echo e(asset('storage/' . $image)); ?>" alt="image">
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php for($i = 1; $i <= 10; $i++): ?>
                            <div class="item">
                                <div class="abt_slides">
                                    <img src="<?php echo e(asset('images/dish' . $i . '.webp')); ?>" alt="image">
                                </div>
                            </div>
                        <?php endfor; ?>
                    <?php endif; ?>
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
                            <?php if($facts['badge_text']): ?>
                                <div class="title_badge">
                                    <span><?php echo e($facts['badge_text']); ?></span>
                                </div>
                            <?php endif; ?>
                            <h2><?php echo e($facts['heading']); ?></h2>
                            <p><?php echo e($facts['description']); ?></p>
                            <?php if(!empty($facts['features'])): ?>
                                <ul class="feature_list">
                                    <?php $__currentLoopData = $facts['features']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <div class="icon">
                                                <span><i class="icofont-check-circled"></i></span>
                                            </div>
                                            <div class="text">
                                                <p><?php echo e($feature); ?></p>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                            <div class="btn_block">
                                <a href="<?php echo e($facts['button_url']); ?>" class="btn puprple_btn ml-0"><?php echo e($facts['button_text']); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner_block rotate_right" data-aos="fade-up" data-aos-duration="1500">
                            <div class="img">
                                <?php if($facts['image']): ?>
                                    <img src="<?php echo e(asset('storage/' . $facts['image'])); ?>" alt="">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/about_service_2.webp')); ?>" alt="">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Facts Section End -->

        <!-- Text Flow Section Start -->
        <?php if(!empty($textFlow)): ?>
        <div class="text_list_section tls_aboutpage row_am" data-aos="fade-in" data-aos-duration="1500">
            <div class="container">
                <span class="title_badge down_fix">Why choose our app</span>
            </div>
            <div class="slider_block">
                <div class="owl-carousel owl-theme" id="text_list_flow">
                    <?php $__currentLoopData = $textFlow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <div class="text_block">
                                <span><?php echo e($item); ?></span>
                                <span class="mark_star">•</span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- Text Flow Section End -->

        <!-- Testimonial Section Start -->
        <?php if($testimonials && $testimonials->count() > 0): ?>
        <section class="testimonial_section" data-aos="fade-in" data-aos-duration="1500">
            <div class="testimonial_inner">
                <div class="testimonial_side_element">
                    <img src="<?php echo e(asset('images/thumbup2.webp')); ?>" alt="image">
                </div>
                <div class="container">
                    <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                        <span class="title_badge">Reviews</span>
                        <h2>Client Testimonials</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing indus orem Ipsum has been the industrys standard dummy text ever since.</p>
                    </div>
                    <div class="testimonial_slides">
                        <div class="owl-carousel owl-theme" id="testimonial_slider">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <div class="testimonial_box">
                                        <div class="testi_img">
                                            <img class="user_img" src="<?php echo e(asset('storage/' . $testimonial->customer_image)); ?>" alt="<?php echo e($testimonial->customer_name); ?>">
                                        </div>
                                        <div class="testi_text">
                                            <div class="star">
                                                <?php for($i = 0; $i < ($testimonial->rating ?? 5); $i++): ?>
                                                    <span><i class="icofont-star"></i></span>
                                                <?php endfor; ?>
                                            </div>
                                            <p><?php echo e($testimonial->quote ?? $testimonial->full_review ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem Ipsum has been the standard dummy.'); ?></p>
                                            <div class="user_info">
                                                <h6><?php echo e($testimonial->customer_name); ?></h6>
                                                <?php if($testimonial->location): ?>
                                                    <span><?php echo e($testimonial->location); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <!-- Testimonial Section End -->

        <!-- Team Section Start -->
        <?php if(!empty($team['members'])): ?>
        <section class="row_am experts_team_section">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                    <?php if($team['badge_text']): ?>
                        <span class="title_badge"><?php echo e($team['badge_text']); ?></span>
                    <?php endif; ?>
                    <h2><?php echo e($team['heading']); ?></h2>
                    <p><?php echo e($team['description']); ?></p>
                </div>
                <div class="row">
                    <?php $__currentLoopData = $team['members']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="<?php echo e(($index + 1) * 100); ?>">
                            <div class="experts_box">
                                <?php if(isset($member['image']) && $member['image']): ?>
                                    <img src="<?php echo e(asset('storage/' . $member['image'])); ?>" alt="<?php echo e($member['name'] ?? 'Team Member'); ?>">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/team_0' . (($index % 3) + 1) . '.webp')); ?>" alt="image">
                                <?php endif; ?>
                                <div class="text">
                                    <h6><?php echo e($member['name'] ?? ''); ?></h6>
                                    <span><?php echo e($member['position'] ?? ''); ?></span>
                                    <?php if(isset($member['social_links']) && is_array($member['social_links'])): ?>
                                        <ul class="social_media">
                                            <?php $__currentLoopData = $member['social_links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($url): ?>
                                                    <li>
                                                        <a href="<?php echo e($url); ?>">
                                                            <i class="icofont-<?php echo e($platform); ?>"></i>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php else: ?>
                                        <ul class="social_media">
                                            <li><a href="#"><i class="icofont-facebook"></i></a></li>
                                            <li><a href="#"><i class="icofont-twitter"></i></a></li>
                                            <li><a href="#"><i class="icofont-instagram"></i></a></li>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <!-- Team Section End -->

        <!-- FAQ Section Start -->
        <?php if(!empty($faq['items'])): ?>
        <section class="row_am faq_section" id="faqsec">
            <div class="container">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
                    <?php if($faq['badge_text']): ?>
                        <span class="title_badge"><?php echo e($faq['badge_text']); ?></span>
                    <?php endif; ?>
                    <h2><?php echo e($faq['heading']); ?></h2>
                </div>
                <div class="faq_blocks" data-aos="fade-up" data-aos-duration="1500">
                    <div class="accordion" id="accordionExample">
                        <div class="row">
                            <div class="col-md-6">
                                <?php $__currentLoopData = array_slice($faq['items'], 0, ceil(count($faq['items']) / 2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card">
                                        <div class="card-header" id="heading<?php echo e($index); ?>">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link btn-block text-left <?php echo e($index === 0 ? '' : 'collapsed'); ?>" type="button" data-toggle="collapse" data-target="#collapse<?php echo e($index); ?>" aria-expanded="<?php echo e($index === 0 ? 'true' : 'false'); ?>" aria-controls="collapse<?php echo e($index); ?>">
                                                    <?php echo e($item['question'] ?? ''); ?>

                                                    <span class="icons">
                                                        <i class="icofont-plus"></i>
                                                        <i class="icofont-minus"></i>
                                                    </span>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse<?php echo e($index); ?>" class="collapse <?php echo e($index === 0 ? 'show' : ''); ?>" aria-labelledby="heading<?php echo e($index); ?>" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <?php echo e($item['answer'] ?? ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="col-md-6">
                                <?php $__currentLoopData = array_slice($faq['items'], ceil(count($faq['items']) / 2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $realIndex = $index + ceil(count($faq['items']) / 2); ?>
                                    <div class="card">
                                        <div class="card-header" id="heading<?php echo e($realIndex); ?>">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo e($realIndex); ?>" aria-expanded="false" aria-controls="collapse<?php echo e($realIndex); ?>">
                                                    <?php echo e($item['question'] ?? ''); ?>

                                                    <span class="icons">
                                                        <i class="icofont-plus"></i>
                                                        <i class="icofont-minus"></i>
                                                    </span>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse<?php echo e($realIndex); ?>" class="collapse" aria-labelledby="heading<?php echo e($realIndex); ?>" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <?php echo e($item['answer'] ?? ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <!-- FAQ Section End -->

        <!-- Pre-Footer CTA Section -->
        <?php echo $__env->make('partials.pre-footer-cta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('partials.footer', [
            'footerLogo' => $footerLogo ?? null,
            'footerDetails' => $footerDetails ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem sum has been the industrys standard dummytext ever since the when an unknown printer took.',
            'footerQuickLinks' => $footerQuickLinks ?? collect(),
            'footerSupportMenus' => $footerSupportMenus ?? collect(),
            'footerAppStoreButtons' => $footerAppStoreButtons ?? null,
            'footerSocialLinks' => $footerSocialLinks ?? collect(),
            'footerCopyrightText' => $footerCopyrightText ?? '© Copyrights %Y. All rights reserved.'
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- Page-wrapper-End -->

</body>
</html>

<?php /**PATH /home/skylonit/tastyso/resources/views/frontend/about.blade.php ENDPATH**/ ?>