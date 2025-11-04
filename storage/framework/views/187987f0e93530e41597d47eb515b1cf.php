

<?php $__env->startSection('title', 'Restaurant Logos'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Restaurant Logos</h2>
    <a href="<?php echo e(route('admin.restaurant-logos.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Alt Text</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $logos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <img src="<?php echo e(asset('storage/' . $logo->logo_image)); ?>" alt="<?php echo e($logo->alt_text); ?>" style="width: 100px; height: auto; max-height: 60px; object-fit: contain;">
                        </td>
                        <td><?php echo e($logo->alt_text ?? 'N/A'); ?></td>
                        <td><?php echo e($logo->sort_order); ?></td>
                        <td>
                            <?php if($logo->is_active): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.restaurant-logos.edit', $logo)); ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="<?php echo e(route('admin.restaurant-logos.destroy', $logo)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center">No logos found. <a href="<?php echo e(route('admin.restaurant-logos.create')); ?>">Add one</a></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Register Button Settings -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Register Button Settings</h5>
        <small class="text-muted">Manage the "Register Your Restaurant" button below the restaurant logos section</small>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.restaurant-logos.update-button')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Button Text <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="button_text" value="<?php echo e(old('button_text', $registerButton['text'])); ?>" required placeholder="e.g., Register Your Restaurant">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Button URL <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" name="button_url" value="<?php echo e(old('button_url', $registerButton['url'])); ?>" required placeholder="e.g., https://example.com/register or #">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-2"></i>Update Button
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/skylonit/tastyso/resources/views/admin/restaurant-logos/index.blade.php ENDPATH**/ ?>