

<?php $__env->startSection('title', 'Statistics'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Statistics</h2>
    <a href="<?php echo e(route('admin.statistics.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Value</th>
                    <th>Suffix</th>
                    <th>Label</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $statistics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statistic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <?php if($statistic->icon): ?>
                                <img src="<?php echo e(asset('storage/' . $statistic->icon)); ?>" alt="Icon" style="width: 40px; height: 40px; object-fit: cover;">
                            <?php else: ?>
                                <span class="text-muted">No icon</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($statistic->value); ?></td>
                        <td><?php echo e($statistic->suffix); ?></td>
                        <td><?php echo e($statistic->label); ?></td>
                        <td><?php echo e($statistic->sort_order); ?></td>
                        <td>
                            <?php if($statistic->is_active): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.statistics.edit', $statistic)); ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="<?php echo e(route('admin.statistics.destroy', $statistic)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                        <td colspan="7" class="text-center">No statistics found. <a href="<?php echo e(route('admin.statistics.create')); ?>">Create one</a></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/skylonit/tastyso/resources/views/admin/statistics/index.blade.php ENDPATH**/ ?>