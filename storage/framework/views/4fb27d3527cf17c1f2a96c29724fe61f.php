

<?php $__env->startSection('title', 'About Page Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>About Page Management</h2>
</div>

<!-- Overview Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Overview Section</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.about-pages.update-overview')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Badge Text</label>
                        <input type="text" class="form-control" name="badge_text" value="<?php echo e(old('badge_text', $overview['badge_text'])); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" class="form-control" name="heading" value="<?php echo e(old('heading', $overview['heading'])); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"><?php echo e(old('description', $overview['description'])); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Features</label>
                        <div id="features-list">
                            <?php $__currentLoopData = $overview['features'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="features[]" value="<?php echo e($feature); ?>">
                                    <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">Remove</button>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="addFeature()">Add Feature</button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" class="form-control" name="button_text" value="<?php echo e(old('button_text', $overview['button_text'])); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="url" class="form-control" name="button_url" value="<?php echo e(old('button_url', $overview['button_url'])); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Video URL</label>
                        <input type="url" class="form-control" name="video_url" value="<?php echo e(old('video_url', $overview['video_url'])); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Section Image</label>
                        <?php if($overview['image']): ?>
                            <div class="mb-2">
                                <img src="<?php echo e(asset('storage/' . $overview['image'])); ?>" alt="Overview" style="max-height: 200px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Overview Section</button>
        </form>
    </div>
</div>

<!-- Statistics Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Statistics Section</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.about-pages.update-statistics')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Badge Text</label>
                <input type="text" class="form-control" name="badge_text" value="<?php echo e(old('badge_text', $statistics['badge_text'])); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" name="heading" value="<?php echo e(old('heading', $statistics['heading'])); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"><?php echo e(old('description', $statistics['description'])); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Statistics (4 items required)</label>
                <?php for($i = 0; $i < 4; $i++): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6>Statistic <?php echo e($i + 1); ?></h6>
                            <div class="mb-2">
                                <label class="form-label">Icon (Image filename)</label>
                                <input type="text" class="form-control" name="stats[<?php echo e($i); ?>][icon]" value="<?php echo e($statistics['stats'][$i]['icon'] ?? ''); ?>" placeholder="e.g., uspa.webp">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Value</label>
                                <input type="text" class="form-control" name="stats[<?php echo e($i); ?>][value]" value="<?php echo e($statistics['stats'][$i]['value'] ?? ''); ?>" placeholder="e.g., 150">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Label</label>
                                <input type="text" class="form-control" name="stats[<?php echo e($i); ?>][label]" value="<?php echo e($statistics['stats'][$i]['label'] ?? ''); ?>" placeholder="e.g., Countries">
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update Statistics Section</button>
        </form>
    </div>
</div>

<!-- About Us Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>About Us Section</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.about-pages.update-about-us')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Badge Text</label>
                <input type="text" class="form-control" name="badge_text" value="<?php echo e(old('badge_text', $aboutUs['badge_text'])); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" name="heading" value="<?php echo e(old('heading', $aboutUs['heading'])); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="4"><?php echo e(old('description', $aboutUs['description'])); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Slider Images</label>
                <input type="file" class="form-control" name="slider_images[]" accept="image/*" multiple>
                <small class="text-muted">Upload multiple images for the slider</small>
            </div>
            <button type="submit" class="btn btn-primary">Update About Us Section</button>
        </form>
    </div>
</div>

<!-- Facts Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Facts Section</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.about-pages.update-facts')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Badge Text</label>
                        <input type="text" class="form-control" name="badge_text" value="<?php echo e(old('badge_text', $facts['badge_text'])); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" class="form-control" name="heading" value="<?php echo e(old('heading', $facts['heading'])); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"><?php echo e(old('description', $facts['description'])); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Features</label>
                        <div id="facts-features-list">
                            <?php $__currentLoopData = $facts['features'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="features[]" value="<?php echo e($feature); ?>">
                                    <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">Remove</button>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="addFactsFeature()">Add Feature</button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" class="form-control" name="button_text" value="<?php echo e(old('button_text', $facts['button_text'])); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="url" class="form-control" name="button_url" value="<?php echo e(old('button_url', $facts['button_url'])); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Section Image</label>
                        <?php if($facts['image']): ?>
                            <div class="mb-2">
                                <img src="<?php echo e(asset('storage/' . $facts['image'])); ?>" alt="Facts" style="max-height: 200px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Facts Section</button>
        </form>
    </div>
</div>

<!-- Text Flow Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Text Flow Section</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.about-pages.update-text-flow')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Text Items</label>
                <div id="text-flow-list">
                    <?php $__currentLoopData = $textFlow ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="items[]" value="<?php echo e($item); ?>">
                            <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">Remove</button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <button type="button" class="btn btn-sm btn-secondary" onclick="addTextFlowItem()">Add Item</button>
            </div>
            <button type="submit" class="btn btn-primary">Update Text Flow Section</button>
        </form>
    </div>
</div>

<!-- CTA Section -->
<div class="card">
    <div class="card-header">
        <h5>CTA Section</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.about-pages.update-cta')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" name="heading" value="<?php echo e(old('heading', $cta['heading'])); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"><?php echo e(old('description', $cta['description'])); ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Call Button Text</label>
                        <input type="text" class="form-control" name="call_text" value="<?php echo e(old('call_text', $cta['call_text'])); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Call Button URL</label>
                        <input type="text" class="form-control" name="call_url" value="<?php echo e(old('call_url', $cta['call_url'])); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Email Button Text</label>
                        <input type="text" class="form-control" name="email_text" value="<?php echo e(old('email_text', $cta['email_text'])); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Button URL</label>
                        <input type="email" class="form-control" name="email_url" value="<?php echo e(old('email_url', $cta['email_url'])); ?>">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update CTA Section</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
let featureCount = <?php echo e(count($overview['features'] ?? [])); ?>;
let factsFeatureCount = <?php echo e(count($facts['features'] ?? [])); ?>;
let textFlowCount = <?php echo e(count($textFlow ?? [])); ?>;

function addFeature() {
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="features[]" placeholder="Feature text">
        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">Remove</button>
    `;
    document.getElementById('features-list').appendChild(div);
}

function addFactsFeature() {
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="features[]" placeholder="Feature text">
        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">Remove</button>
    `;
    document.getElementById('facts-features-list').appendChild(div);
}

function addTextFlowItem() {
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="items[]" placeholder="Text flow item">
        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">Remove</button>
    `;
    document.getElementById('text-flow-list').appendChild(div);
}

</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/skylonit/tastyso/resources/views/admin/about-pages/index.blade.php ENDPATH**/ ?>