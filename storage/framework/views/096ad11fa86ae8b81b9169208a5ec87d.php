

<?php $__env->startSection('title', 'Why Choose Us'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Why Choose Us</h2>
    <a href="<?php echo e(route('admin.why-choose-us.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Feature
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Badge</th>
                        <th>Heading</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($feature->id); ?></td>
                            <td><?php echo e($feature->title); ?></td>
                            <td><?php echo e($feature->badge_text ?? '-'); ?></td>
                            <td><?php echo e(Str::limit($feature->heading, 30)); ?></td>
                            <td><?php echo e($feature->sort_order); ?></td>
                            <td>
                                <?php if($feature->is_active): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('admin.why-choose-us.edit', $feature)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.why-choose-us.destroy', $feature)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">No features found. <a href="<?php echo e(route('admin.why-choose-us.create')); ?>">Add one</a></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/why-choose-us/index.blade.php ENDPATH**/ ?>