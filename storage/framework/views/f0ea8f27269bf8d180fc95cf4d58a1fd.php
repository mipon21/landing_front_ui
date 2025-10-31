

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
                                    <a href="<?php echo e(route('admin.how-it-works.edit', $step->id)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.how-it-works.destroy', $step->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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

<!-- Section Settings Card -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">How It Works Section Settings</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.how-it-works.update-section-settings')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="row">
                <div class="col-md-6">
                    <h6 class="mb-3">Section Settings</h6>
                    <div class="mb-3">
                        <label class="form-label">Badge Text</label>
                        <input type="text" class="form-control" name="badge_text" value="<?php echo e(old('badge_text', $sectionSettings['badge_text'])); ?>" placeholder="e.g., Easy Steps">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Section Heading</label>
                        <input type="text" class="form-control" name="heading" value="<?php echo e(old('heading', $sectionSettings['heading'])); ?>" placeholder="e.g., How it Works">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Section Description</label>
                        <textarea class="form-control" name="description" rows="3"><?php echo e(old('description', $sectionSettings['description'])); ?></textarea>
                    </div>

                    <h6 class="mb-3 mt-4">Promotional Text</h6>
                    <div class="mb-3">
                        <label class="form-label">Promotional Text</label>
                        <input type="text" class="form-control" name="promotional_text" value="<?php echo e(old('promotional_text', $sectionSettings['promotional_text'])); ?>" placeholder="e.g., Get 50% off on your first order ! Grab it now.">
                        <small class="text-muted">This text appears above the app store buttons</small>
                    </div>

                    <h6 class="mb-3 mt-4">App Store Buttons Settings</h6>
                    <div class="mb-3">
                        <label class="form-label">Google Play URL</label>
                        <input type="url" class="form-control" name="google_play_url" value="<?php echo e(old('google_play_url', $sectionSettings['google_play_url'])); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">App Store URL</label>
                        <input type="url" class="form-control" name="app_store_url" value="<?php echo e(old('app_store_url', $sectionSettings['app_store_url'])); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <h6 class="mb-3">Bottom Image</h6>
                    <div class="mb-3">
                        <label class="form-label">Bottom Image</label>
                        <?php if($sectionSettings['bottom_image']): ?>
                            <div class="mb-2">
                                <img src="<?php echo e(asset('storage/' . $sectionSettings['bottom_image'])); ?>" alt="Bottom Image" style="max-height: 200px; width: auto;">
                                <div class="mt-2">
                                    <form action="<?php echo e(route('admin.how-it-works.delete-bottom-image')); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this image?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Delete Image
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="bottom_image" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>

                    <h6 class="mb-3 mt-4">Show/Hide App Store Buttons</h6>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="show_google_play" value="1" id="show_google_play" <?php echo e(old('show_google_play', $sectionSettings['show_google_play']) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="show_google_play">Show Google Play Button</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="show_app_store" value="1" id="show_app_store" <?php echo e(old('show_app_store', $sectionSettings['show_app_store']) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="show_app_store">Show App Store Button</label>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Section Settings</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/how-it-works/index.blade.php ENDPATH**/ ?>