

<?php $__env->startSection('title', 'Download Sections'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Download Sections</h2>
    <a href="<?php echo e(route('admin.download-sections.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Section
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
                    <?php $__empty_1 = true; $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($section->id); ?></td>
                            <td>
                                <span class="badge <?php echo e($section->section_type === 'download' ? 'bg-primary' : 'bg-success'); ?>">
                                    <?php echo e(ucfirst($section->section_type)); ?>

                                </span>
                            </td>
                            <td><?php echo e(Str::limit($section->heading, 40)); ?></td>
                            <td><?php echo e($section->badge_text ?? '-'); ?></td>
                            <td>
                                <?php if($section->is_active): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('admin.download-sections.edit', $section)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.download-sections.destroy', $section)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                            <td colspan="6" class="text-center py-4">No sections found. <a href="<?php echo e(route('admin.download-sections.create')); ?>">Add one</a></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/download-sections/index.blade.php ENDPATH**/ ?>