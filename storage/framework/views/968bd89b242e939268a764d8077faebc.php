

<?php $__env->startSection('title', 'Blog Posts'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Blog Posts</h2>
    <a href="<?php echo e(route('admin.blog.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Published</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <?php if($post->featured_image): ?>
                                <img src="<?php echo e(asset('storage/' . $post->featured_image)); ?>" alt="<?php echo e($post->title); ?>" style="width: 80px; height: 60px; object-fit: cover;">
                            <?php else: ?>
                                <span class="text-muted">No image</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?php echo e($post->title); ?></strong>
                            <?php if($post->is_editor_choice): ?>
                                <span class="badge bg-warning">Editor's Choice</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($post->author); ?></td>
                        <td><?php echo e($post->category ?? 'N/A'); ?></td>
                        <td><?php echo e($post->published_at ? $post->published_at->format('M d, Y') : 'Not set'); ?></td>
                        <td>
                            <?php if($post->is_published): ?>
                                <span class="badge bg-success">Published</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Draft</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.blog.edit', $post)); ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="<?php echo e(route('admin.blog.destroy', $post)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center">No blog posts found. <a href="<?php echo e(route('admin.blog.create')); ?>">Create one</a></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\landing\resources\views/admin/blog/index.blade.php ENDPATH**/ ?>