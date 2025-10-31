

<?php $__env->startSection('title', 'How It Works'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>How It Works</h2>
    <a href="<?php echo e(route('admin.how-it-works.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Step
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Step #</th>
                        <th>Title</th>
                        <th>Badge</th>
                        <th>Heading</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><strong><?php echo e(str_pad($step->step_number, 2, '0', STR_PAD_LEFT)); ?></strong></td>
                            <td><?php echo e($step->step_title); ?></td>
                            <td><?php echo e($step->badge_text ?? '-'); ?></td>
                            <td><?php echo e(Str::limit($step->heading, 30)); ?></td>
                            <td><?php echo e($step->sort_order); ?></td>
                            <td>
                                <?php if($step->is_active): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('admin.how-it-works.edit', $step)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.how-it-works.destroy', $step)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                            <td colspan="7" class="text-center py-4">No steps found. <a href="<?php echo e(route('admin.how-it-works.create')); ?>">Add one</a></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/how-it-works/index.blade.php ENDPATH**/ ?>