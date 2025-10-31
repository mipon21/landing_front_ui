

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard</h2>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Blog Posts</h5>
                <h2 class="card-text"><?php echo e($stats['blog_posts']); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Testimonials</h5>
                <h2 class="card-text"><?php echo e($stats['testimonials']); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Dishes</h5>
                <h2 class="card-text"><?php echo e($stats['dishes']); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Statistics</h5>
                <h2 class="card-text"><?php echo e($stats['statistics']); ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Quick Links</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <a href="<?php echo e(route('admin.hero.edit')); ?>" class="btn btn-outline-primary w-100">
                    <i class="bi bi-star me-2"></i>Edit Hero Section
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="<?php echo e(route('admin.statistics.index')); ?>" class="btn btn-outline-success w-100">
                    <i class="bi bi-bar-chart me-2"></i>Manage Statistics
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="<?php echo e(route('admin.blog.index')); ?>" class="btn btn-outline-info w-100">
                    <i class="bi bi-file-text me-2"></i>Manage Blog Posts
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>