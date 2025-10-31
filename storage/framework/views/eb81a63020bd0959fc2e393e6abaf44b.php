

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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/restaurant-logos/index.blade.php ENDPATH**/ ?>