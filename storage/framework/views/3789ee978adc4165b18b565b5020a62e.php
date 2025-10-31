

<?php $__env->startSection('title', 'Hero Section'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Hero Section</h2>
</div>

<form action="<?php echo e(route('admin.hero.update')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="card mb-4">
        <div class="card-header">Main Content</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Typed Texts (one per line)</label>
                <textarea class="form-control" name="typed_texts" rows="3"><?php echo e(old('typed_texts', is_array($hero->typed_texts) ? implode("\n", $hero->typed_texts) : '')); ?></textarea>
                <small class="form-text text-muted">Each line will be a separate text in the typing animation</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" name="heading" value="<?php echo e(old('heading', $hero->heading)); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"><?php echo e(old('description', $hero->description)); ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Active Users Text</label>
                    <input type="text" class="form-control" name="active_users_text" value="<?php echo e(old('active_users_text', $hero->active_users_text)); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Rating Text</label>
                    <input type="text" class="form-control" name="rating_text" value="<?php echo e(old('rating_text', $hero->rating_text)); ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Images</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Hero Image</label>
                    <?php if($hero->hero_image): ?>
                        <div class="mb-2">
                            <img src="<?php echo e(asset('storage/' . $hero->hero_image)); ?>" alt="Hero" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" name="hero_image" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Background Image</label>
                    <?php if($hero->background_image): ?>
                        <div class="mb-2">
                            <img src="<?php echo e(asset('storage/' . $hero->background_image)); ?>" alt="Background" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" name="background_image" accept="image/*">
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Search Section</div>
        <div class="card-body">
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="show_search_section" value="1" id="show_search_section" <?php echo e(old('show_search_section', $hero->show_search_section ?? false) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="show_search_section">
                    <strong>Show Search Section on Frontend</strong>
                </label>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Search Input Placeholder</label>
                    <input type="text" class="form-control" name="search_section_placeholder" value="<?php echo e(old('search_section_placeholder', $hero->search_section_placeholder ?? 'Enter your location')); ?>" placeholder="Enter your location">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Locate Me Button Text</label>
                    <input type="text" class="form-control" name="search_section_locate_button_text" value="<?php echo e(old('search_section_locate_button_text', $hero->search_section_locate_button_text ?? 'Locate me')); ?>" placeholder="Locate me">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Search Button Text</label>
                    <input type="text" class="form-control" name="search_section_button_text" value="<?php echo e(old('search_section_button_text', $hero->search_section_button_text ?? 'Find Food')); ?>" placeholder="Find Food">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Search Button URL</label>
                    <input type="text" class="form-control" name="search_section_button_url" value="<?php echo e(old('search_section_button_url', $hero->search_section_button_url)); ?>" placeholder="e.g., /search or https://example.com/search">
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">App Store Links</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="show_google_play" value="1" id="show_google_play" <?php echo e(old('show_google_play', $hero->show_google_play ?? true) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="show_google_play">
                            <strong>Show Google Play Button on Frontend</strong>
                        </label>
                    </div>
                    <label class="form-label">Google Play URL</label>
                    <input type="url" class="form-control" name="google_play_url" value="<?php echo e(old('google_play_url', $hero->google_play_url)); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="show_app_store" value="1" id="show_app_store" <?php echo e(old('show_app_store', $hero->show_app_store ?? true) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="show_app_store">
                            <strong>Show App Store Button on Frontend</strong>
                        </label>
                    </div>
                    <label class="form-label">App Store URL</label>
                    <input type="url" class="form-control" name="app_store_url" value="<?php echo e(old('app_store_url', $hero->app_store_url)); ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Google Play Image</label>
                    <?php if($hero->google_play_image): ?>
                        <div class="mb-2">
                            <img src="<?php echo e(asset('storage/' . $hero->google_play_image)); ?>" alt="Google Play" class="img-thumbnail" style="max-height: 100px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" name="google_play_image" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">App Store Image</label>
                    <?php if($hero->app_store_image): ?>
                        <div class="mb-2">
                            <img src="<?php echo e(asset('storage/' . $hero->app_store_image)); ?>" alt="App Store" class="img-thumbnail" style="max-height: 100px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" name="app_store_image" accept="image/*">
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Settings</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Video URL</label>
                <input type="url" class="form-control" name="video_url" value="<?php echo e(old('video_url', $hero->video_url)); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">User Avatars (one image path per line)</label>
                <textarea class="form-control" name="user_avatars" rows="3"><?php echo e(old('user_avatars', is_array($hero->user_avatars) ? implode("\n", $hero->user_avatars) : '')); ?></textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" <?php echo e(old('is_active', $hero->is_active) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="is_active">Active</label>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Update Hero Section</button>
</form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/hero/edit.blade.php ENDPATH**/ ?>