<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php
        $pageTitle = 'Contact us : ' . $siteName;
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
                <h1>Contact Us</h1>
                <ul>
                    <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                    <li><span>»</span></li>
                    <li><a href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Page-wrapper-Start -->
    <div class="page_wrapper">
        <!-- Contact Us Section Start -->
        <section class="row_am contact_page_section">
            <div class="container">
                <div class="contact_inner">
                    <div class="row">
                        <!-- left colom -->
                        <div class="col-lg-6">
                            <div class="contact_info">
                                <div class="section_title">
                                    <h3><?php echo e($contactInfo['heading']); ?></h3>
                                    <p><?php echo e($contactInfo['description']); ?></p>
                                </div>
                                <ul class="contact_info_list">
                                    <li>
                                        <div class="img">
                                            <img src="<?php echo e(asset('images/mail_icon.webp')); ?>" alt="image">
                                        </div>
                                        <div class="text">
                                            <span>Email Us</span>
                                            <a href="mailto:<?php echo e($contactInfo['email']); ?>"><?php echo e($contactInfo['email']); ?></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="img">
                                            <img src="<?php echo e(asset('images/call_icon.webp')); ?>" alt="image">
                                        </div>
                                        <div class="text">
                                            <span>Call Us</span>
                                            <a href="tel:<?php echo e(str_replace([' ', '(', ')'], '', $contactInfo['phone'])); ?>"><?php echo e($contactInfo['phone']); ?></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="img">
                                            <img src="<?php echo e(asset('images/location_icon.webp')); ?>" alt="image">
                                        </div>
                                        <div class="text">
                                            <span>Visit Us</span>
                                            <p><?php echo e($contactInfo['address']); ?></p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="ticket_box">
                                    <div class="pattern-rotate">
                                        <img src="<?php echo e(asset('images/pattern-rotate1.webp')); ?>" alt="image">
                                    </div>
                                    <div class="icon"><img src="<?php echo e(asset('images/ticket.webp')); ?>" alt="image"></div>
                                    <div class="section_title">
                                        <h3><?php echo e($ticketBox['heading']); ?></h3>
                                        <p><?php echo e($ticketBox['description']); ?></p>
                                    </div>
                                    <a href="<?php echo e($ticketBox['button_url']); ?>" class="btn puprple_btn"><?php echo e($ticketBox['button_text']); ?></a>
                                </div>
                            </div>
                        </div>
                        <!-- left colom -->

                        <!-- right colom -->
                        <div class="col-lg-6">
                            <div class="contact_form">
                                <div class="section_title">
                                    <h3><?php echo e($contactForm['heading']); ?></h3>
                                    <p><?php echo e($contactForm['description']); ?></p>
                                </div>
                                <form action="<?php echo e(route('contact.submit')); ?>" method="POST" id="contactForm">
                                    <?php echo csrf_field(); ?>
                                    <div id="form-message" style="display: none; margin-bottom: 20px; padding: 15px; border-radius: 5px;"></div>
                                    <div class="form-group">
                                        <input type="text" name="name" id="contact_name" placeholder="Name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="contact_email" placeholder="Email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" id="contact_message" class="form-control" placeholder="Your message" rows="6" required></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn puprple_btn" id="submitBtn">
                                            <span id="submitBtnText">Submit your Message</span>
                                            <span id="submitBtnLoader" style="display: none;">Submitting...</span>
                                        </button>
                                    </div>
                                </form>
                                <script>
                                    document.getElementById('contactForm').addEventListener('submit', function(e) {
                                        e.preventDefault();
                                        
                                        const form = this;
                                        const submitBtn = document.getElementById('submitBtn');
                                        const submitBtnText = document.getElementById('submitBtnText');
                                        const submitBtnLoader = document.getElementById('submitBtnLoader');
                                        const messageDiv = document.getElementById('form-message');
                                        const formData = new FormData(form);
                                        
                                        // Disable submit button and show loader
                                        submitBtn.disabled = true;
                                        submitBtnText.style.display = 'none';
                                        submitBtnLoader.style.display = 'inline';
                                        
                                        // Hide previous messages
                                        messageDiv.style.display = 'none';
                                        messageDiv.className = '';
                                        
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
                                                messageDiv.className = 'alert alert-success';
                                                messageDiv.style.backgroundColor = '#d4edda';
                                                messageDiv.style.color = '#155724';
                                                messageDiv.style.border = '1px solid #c3e6cb';
                                                
                                                // Reset form
                                                form.reset();
                                            } else {
                                                // Error message
                                                messageDiv.className = 'alert alert-danger';
                                                messageDiv.style.backgroundColor = '#f8d7da';
                                                messageDiv.style.color = '#721c24';
                                                messageDiv.style.border = '1px solid #f5c6cb';
                                            }
                                            
                                            // Scroll to message
                                            messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                                        })
                                        .catch(error => {
                                            // Show error message
                                            messageDiv.style.display = 'block';
                                            messageDiv.className = 'alert alert-danger';
                                            messageDiv.style.backgroundColor = '#f8d7da';
                                            messageDiv.style.color = '#721c24';
                                            messageDiv.style.border = '1px solid #f5c6cb';
                                            messageDiv.textContent = 'An error occurred. Please try again later.';
                                            messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
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
                        <!-- right colom -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Us Section End -->

        <!-- Map Section Start -->
        <?php if($map['iframe_url']): ?>
            <section class="row_am map_section">
                <div class="container">
                    <div class="map_inner">
                        <?php
                            // Extract iframe src if full iframe code is provided
                            $mapIframeUrl = $map['iframe_url'];
                            if (preg_match('/src=["\']([^"\']+)["\']/', $mapIframeUrl, $matches)) {
                                $mapIframeUrl = $matches[1];
                            } elseif (strpos($mapIframeUrl, '<iframe') === false) {
                                // It's just a URL, use it directly
                                $mapIframeUrl = $mapIframeUrl;
                            }
                        ?>
                        <?php if(strpos($map['iframe_url'], '<iframe') !== false): ?>
                            <?php echo $map['iframe_url']; ?>

                        <?php else: ?>
                            <iframe src="<?php echo e($mapIframeUrl); ?>" width="100%" height="510" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- Map Section End -->

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

<?php /**PATH /home/skylonit/tastyso/resources/views/frontend/contact.blade.php ENDPATH**/ ?>