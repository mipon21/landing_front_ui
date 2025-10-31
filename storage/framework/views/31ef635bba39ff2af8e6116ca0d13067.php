

<?php $__env->startSection('title', 'Add Restaurant Logo'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add Restaurant Logo</h2>
    <a href="<?php echo e(route('admin.restaurant-logos.index')); ?>" class="btn btn-secondary">Back</a>
</div>

<form action="<?php echo e(route('admin.restaurant-logos.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Logo Image <span class="text-danger">*</span></label>
                <input type="file" class="form-control" name="logo_image" accept="image/*" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alt Text</label>
                <input type="text" class="form-control" name="alt_text" value="<?php echo e(old('alt_text')); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" class="form-control" name="sort_order" value="<?php echo e(old('sort_order', 0)); ?>">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" <?php echo e(old('is_active', true) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Add Logo</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/restaurant-logos/create.blade.php ENDPATH**/ ?>