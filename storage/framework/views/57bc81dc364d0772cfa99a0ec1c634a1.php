<!-- Header Start -->
<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <?php if($headerLogo): ?>
                    <img src="<?php echo e(asset('storage/' . $headerLogo)); ?>" alt="Logo">
                <?php else: ?>
                    <img src="<?php echo e(asset('images/logo.webp')); ?>" alt="Logo">
                <?php endif; ?>
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
                    <?php $__currentLoopData = $headerMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item <?php echo e($menu->children->count() > 0 ? 'has_dropdown' : ''); ?>">
                            <a class="nav-link" href="<?php echo e($menu->url && $menu->url != '#' ? $menu->url : '#'); ?>">
                                <?php echo e($menu->label); ?>

                            </a>
                            <?php if($menu->children->count() > 0): ?>
                                <span class="drp_btn"><i class="icofont-rounded-down"></i></span>
                                <div class="sub_menu">
                                    <ul>
                                        <?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e($child->url ? $child->url : '#'); ?>"><?php echo e($child->label); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <div class="btn_block">
                            <a class="nav-link dark_btn" href="<?php echo e($headerCta['url']); ?>"><?php echo e($headerCta['text']); ?></a>
                            <div class="btn_bottom"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- Header End -->

<?php /**PATH /home/skylonit/tastyso/resources/views/partials/header.blade.php ENDPATH**/ ?>