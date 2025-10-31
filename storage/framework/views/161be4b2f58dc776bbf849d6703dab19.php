

<?php $__env->startSection('title', 'Services'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Services</h2>
    <a href="<?php echo e(route('admin.services.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Service
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Heading</th>
                        <th>Badge</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($service->id); ?></td>
                            <td>
                                <span class="badge <?php echo e($service->type === 'restaurant' ? 'bg-warning' : 'bg-info'); ?>">
                                    <?php echo e(ucfirst($service->type)); ?>

                                </span>
                            </td>
                            <td><?php echo e(Str::limit($service->heading, 40)); ?></td>
                            <td><?php echo e($service->badge_text ?? '-'); ?></td>
                            <td>
                                <?php if($service->is_active): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('admin.services.edit', $service)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.services.destroy', $service)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                            <td colspan="6" class="text-center py-4">No services found. <a href="<?php echo e(route('admin.services.create')); ?>">Add one</a></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/services/index.blade.php ENDPATH**/ ?>