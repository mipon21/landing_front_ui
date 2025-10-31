

<?php $__env->startSection('title', 'Terms & Conditions Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Terms & Conditions Management</h2>
</div>

<!-- Terms & Conditions Content Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Terms & Conditions Content</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.terms.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Content <span class="text-danger">*</span></label>
                <textarea class="form-control" name="content" id="terms_content" rows="20" required><?php echo e(old('content', $content)); ?></textarea>
                <small class="text-muted">You can use HTML tags for formatting. Use &lt;br&gt; for line breaks or &lt;p&gt; tags for paragraphs.</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Terms & Conditions</button>
        </form>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<script>
    // Make textarea taller on focus for better editing experience
    document.getElementById('terms_content').addEventListener('focus', function() {
        this.style.minHeight = '500px';
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/terms/index.blade.php ENDPATH**/ ?>