

<?php $__env->startSection('title', 'Dishes'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dishes</h2>
    <a href="<?php echo e(route('admin.dishes.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $dishes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dish): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?php echo e(asset('storage/' . $dish->image)); ?>" class="card-img-top" alt="<?php echo e($dish->name); ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title"><?php echo e($dish->name ?? 'Untitled'); ?></h6>
                            <p class="card-text small text-muted">Order: <?php echo e($dish->sort_order); ?></p>
                            <div class="d-flex gap-2">
                                <a href="<?php echo e(route('admin.dishes.edit', $dish)); ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('admin.dishes.destroy', $dish)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <p>No dishes found. <a href="<?php echo e(route('admin.dishes.create')); ?>">Add one</a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/dishes/index.blade.php ENDPATH**/ ?>