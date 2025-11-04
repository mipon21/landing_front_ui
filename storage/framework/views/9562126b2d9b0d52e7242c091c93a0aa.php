

<?php $__env->startSection('title', 'Edit Statistic'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Statistic</h2>
    <a href="<?php echo e(route('admin.statistics.index')); ?>" class="btn btn-secondary">Back</a>
</div>

<form action="<?php echo e(route('admin.statistics.update', $statistic)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Icon Image</label>
                <?php if($statistic->icon): ?>
                    <div class="mb-2">
                        <img src="<?php echo e(asset('storage/' . $statistic->icon)); ?>" alt="Icon" class="img-thumbnail" style="max-height: 100px;">
                    </div>
                <?php endif; ?>
                <input type="file" class="form-control" name="icon" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Value <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="value" value="<?php echo e(old('value', $statistic->value)); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Suffix</label>
                <input type="text" class="form-control" name="suffix" value="<?php echo e(old('suffix', $statistic->suffix)); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Label <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="label" value="<?php echo e(old('label', $statistic->label)); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" class="form-control" name="sort_order" value="<?php echo e(old('sort_order', $statistic->sort_order)); ?>">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" <?php echo e(old('is_active', $statistic->is_active) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Statistic</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/skylonit/tastyso/resources/views/admin/statistics/edit.blade.php ENDPATH**/ ?>