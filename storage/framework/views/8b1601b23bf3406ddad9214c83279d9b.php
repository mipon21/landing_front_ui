<!-- Pre-Footer CTA Section Start -->
<section class="cta_section new white_text" id="contact_sec">
    <div class="container">
        <div class="cta_box">
            <div class="element">
                <span class="element1"><img src="<?php echo e(asset('images/element_white_3.webp')); ?>" alt="image"></span>
                <span class="element2"><img src="<?php echo e(asset('images/element_white_4.webp')); ?>" alt="image"></span>
            </div>
            <div class="left">
                <div class="section_title" data-aos="fade-in" data-aos-duration="1500" data-aos-delay="100">
                    <img src="<?php echo e(asset('images/customer-icon.webp')); ?>" class="customer_icon" alt="image">
                    <h3><?php echo e($preFooterCta['heading']); ?></h3>
                    <p><?php echo e($preFooterCta['description']); ?></p>
                </div>
            </div>
            <div class="right">
                <div class="btn_block">
                    <?php if($preFooterCta['show_call_button'] ?? true): ?>
                        <a href="<?php echo e($preFooterCta['call_url']); ?>" class="btn puprple_btn aos-init aos-animate call_btn">
                            <i class="icofont-ui-call"></i> <?php echo e($preFooterCta['call_text']); ?>

                        </a>
                    <?php endif; ?>
                    <?php if($preFooterCta['show_email_button'] ?? true): ?>
                        <a href="<?php echo e($preFooterCta['email_url']); ?>" class="btn aos-init aos-animate email_btn">
                            <i class="icofont-envelope-open"></i> <?php echo e($preFooterCta['email_text']); ?>

                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Pre-Footer CTA Section End -->
<?php /**PATH D:\xampp\htdocs\landing\resources\views/partials/pre-footer-cta.blade.php ENDPATH**/ ?>