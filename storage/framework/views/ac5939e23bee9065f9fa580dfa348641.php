

<?php $__env->startSection('title', 'Edit Download Section'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Download Section</h2>
    <a href="<?php echo e(route('admin.download-sections.index')); ?>" class="btn btn-secondary">Back</a>
</div>

<form action="<?php echo e(route('admin.download-sections.update', $downloadSection->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Section Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="section_type" id="section_type" required>
                            <option value="download" <?php echo e(old('section_type', $downloadSection->section_type) === 'download' ? 'selected' : ''); ?>>Download App</option>
                            <option value="register" <?php echo e(old('section_type', $downloadSection->section_type) === 'register' ? 'selected' : ''); ?>>Register Restaurant</option>
                            <option value="deliveryman" <?php echo e(old('section_type', $downloadSection->section_type) === 'deliveryman' ? 'selected' : ''); ?>>Deliveryman</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Badge Text</label>
                        <input type="text" class="form-control" name="badge_text" value="<?php echo e(old('badge_text', $downloadSection->badge_text)); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="heading" value="<?php echo e(old('heading', $downloadSection->heading)); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"><?php echo e(old('description', $downloadSection->description)); ?></textarea>
                    </div>

                    <!-- Register Restaurant / Deliveryman Fields -->
                    <div class="mb-3 register-fields" style="display: <?php echo e(in_array(old('section_type', $downloadSection->section_type), ['register', 'deliveryman']) ? 'block' : 'none'); ?>;">
                        <label class="form-label">Promo Text / Button Text</label>
                        <input type="text" class="form-control" name="promo_text" value="<?php echo e(old('promo_text', $downloadSection->promo_text)); ?>">
                    </div>

                    <div class="mb-3 register-fields" style="display: <?php echo e(in_array(old('section_type', $downloadSection->section_type), ['register', 'deliveryman']) ? 'block' : 'none'); ?>;">
                        <label class="form-label">Button URL</label>
                        <input type="url" class="form-control" name="button_url" value="<?php echo e(old('button_url', $downloadSection->button_url)); ?>">
                    </div>

                    <!-- Download App Fields -->
                    <div class="mb-3 download-fields" style="display: <?php echo e(old('section_type', $downloadSection->section_type) === 'download' ? 'block' : 'none'); ?>;">
                        <label class="form-label">Google Play URL</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="url" class="form-control" name="google_play_url" value="<?php echo e(old('google_play_url', $downloadSection->google_play_url)); ?>">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="show_google_play" value="1" id="show_google_play" <?php echo e(old('show_google_play', $downloadSection->show_google_play ?? true) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="show_google_play">Show</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 download-fields" style="display: <?php echo e(old('section_type', $downloadSection->section_type) === 'download' ? 'block' : 'none'); ?>;">
                        <label class="form-label">App Store URL</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="url" class="form-control" name="app_store_url" value="<?php echo e(old('app_store_url', $downloadSection->app_store_url)); ?>">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="show_app_store" value="1" id="show_app_store" <?php echo e(old('show_app_store', $downloadSection->show_app_store ?? true) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="show_app_store">Show</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Download App Images -->
                    <div class="mb-3 download-fields" style="display: <?php echo e(old('section_type', $downloadSection->section_type) === 'download' ? 'block' : 'none'); ?>;">
                        <label class="form-label">Left Image (Desktop)</label>
                        <?php if($downloadSection->left_image): ?>
                            <div class="mb-2">
                                <img src="<?php echo e(asset('storage/' . $downloadSection->left_image)); ?>" alt="Left" style="max-height: 150px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="left_image" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>

                    <div class="mb-3 download-fields" style="display: <?php echo e(old('section_type', $downloadSection->section_type) === 'download' ? 'block' : 'none'); ?>;">
                        <label class="form-label">Right Image</label>
                        <?php if($downloadSection->right_image): ?>
                            <div class="mb-2">
                                <img src="<?php echo e(asset('storage/' . $downloadSection->right_image)); ?>" alt="Right" style="max-height: 150px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="right_image" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>

                    <div class="mb-3 download-fields" style="display: <?php echo e(old('section_type', $downloadSection->section_type) === 'download' ? 'block' : 'none'); ?>;">
                        <label class="form-label">Mobile Image</label>
                        <?php if($downloadSection->mobile_image): ?>
                            <div class="mb-2">
                                <img src="<?php echo e(asset('storage/' . $downloadSection->mobile_image)); ?>" alt="Mobile" style="max-height: 150px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="mobile_image" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>

                    <!-- Register Restaurant / Deliveryman Background Image -->
                    <div class="mb-3 register-fields" style="display: <?php echo e(in_array(old('section_type', $downloadSection->section_type), ['register', 'deliveryman']) ? 'block' : 'none'); ?>;">
                        <label class="form-label">Background Image</label>
                        <?php if($downloadSection->background_image): ?>
                            <div class="mb-2">
                                <img src="<?php echo e(asset('storage/' . $downloadSection->background_image)); ?>" alt="Background" style="max-height: 150px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="background_image" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" <?php echo e(old('is_active', $downloadSection->is_active) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Section</button>
        </div>
    </div>
</form>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sectionTypeSelect = document.querySelector('select[name="section_type"]');
    const downloadFields = document.querySelectorAll('.download-fields');
    const registerFields = document.querySelectorAll('.register-fields');
    
    function toggleFields() {
        const selectedType = sectionTypeSelect.value;
        
        if (selectedType === 'download') {
            // Show download fields, hide register fields
            downloadFields.forEach(field => field.style.display = 'block');
            registerFields.forEach(field => field.style.display = 'none');
        } else if (selectedType === 'register' || selectedType === 'deliveryman') {
            // Show register/deliveryman fields, hide download fields
            downloadFields.forEach(field => field.style.display = 'none');
            registerFields.forEach(field => field.style.display = 'block');
        }
    }
    
    // Initialize on page load based on current value
    toggleFields();
    
    // Update when selection changes
    sectionTypeSelect.addEventListener('change', toggleFields);
});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/skylonit/tastyso/resources/views/admin/download-sections/edit.blade.php ENDPATH**/ ?>