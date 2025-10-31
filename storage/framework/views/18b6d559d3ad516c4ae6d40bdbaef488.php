

<?php $__env->startSection('title', 'Create Statistic'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Create Statistic</h2>
    <a href="<?php echo e(route('admin.statistics.index')); ?>" class="btn btn-secondary">Back</a>
</div>

<form action="<?php echo e(route('admin.statistics.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Icon Image</label>
                <input type="file" class="form-control" name="icon" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Value <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="value" value="<?php echo e(old('value')); ?>" required>
                <small class="form-text text-muted">The number to display (e.g., 5000)</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Suffix</label>
                <input type="text" class="form-control" name="suffix" value="<?php echo e(old('suffix', '+')); ?>">
                <small class="form-text text-muted">Text after the value (e.g., +, M+, K+)</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Label <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="label" value="<?php echo e(old('label')); ?>" required>
                <small class="form-text text-muted">Description text (e.g., Happy Users)</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" class="form-control" name="sort_order" value="<?php echo e(old('sort_order', 0)); ?>">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" <?php echo e(old('is_active', true) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Create Statistic</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/statistics/create.blade.php ENDPATH**/ ?>