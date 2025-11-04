

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
                                    <a href="<?php echo e(route('admin.why-choose-us.edit', $feature->id)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.why-choose-us.destroy', $feature->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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

<!-- Section Settings -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Section Settings</h5>
        <small class="text-muted">These settings apply to the entire "Why Choose Us" section. Individual cards only need Title, Content, and Icon.</small>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.why-choose-us.update-section-settings')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Badge Text</label>
                        <input type="text" class="form-control" name="badge_text" value="<?php echo e(old('badge_text', $sectionSettings['badge_text'])); ?>" placeholder="e.g., why use Appiq">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Section Heading <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="heading" value="<?php echo e(old('heading', $sectionSettings['heading'])); ?>" required placeholder="e.g., Why choose us">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Section Description</label>
                <textarea class="form-control" name="description" rows="3"><?php echo e(old('description', $sectionSettings['description'])); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-2"></i>Update Section Settings
            </button>
        </form>
    </div>
</div>

<!-- Feature Image Settings -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Section Feature Image</h5>
        <small class="text-muted">This image is displayed once for the entire "Why Choose Us" section (on the right side). Each feature card only needs an icon.</small>
    </div>
    <div class="card-body">
        <?php if($featureImage): ?>
            <div class="mb-3">
                <label class="form-label">Current Feature Image</label>
                <div class="mb-2">
                    <img src="<?php echo e(asset('storage/' . $featureImage)); ?>" alt="Feature Image" style="max-height: 300px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.why-choose-us.update-feature-image')); ?>" method="POST" enctype="multipart/form-data" class="d-inline">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label"><?php echo e($featureImage ? 'Update' : 'Upload'); ?> Feature Image <span class="text-danger">*</span></label>
                <input type="file" class="form-control" name="feature_image" accept="image/*" required>
                <small class="text-muted">Main feature image for the Why Choose Us section (shown on the right side)</small>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-upload me-2"></i><?php echo e($featureImage ? 'Update' : 'Upload'); ?> Image
            </button>
        </form>

        <?php if($featureImage): ?>
            <form action="<?php echo e(route('admin.why-choose-us.delete-feature-image')); ?>" method="POST" class="d-inline ms-2" onsubmit="return confirm('Are you sure you want to delete the feature image?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash me-2"></i>Delete Image
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/skylonit/tastyso/resources/views/admin/why-choose-us/index.blade.php ENDPATH**/ ?>