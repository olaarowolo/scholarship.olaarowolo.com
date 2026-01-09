<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 md:p-6 mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div class="min-w-0">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 truncate"><?php echo e($title ?? 'Admin'); ?></h1>
            <?php if(!empty($subtitle)): ?>
                <p class="mt-1 text-sm md:text-lg text-gray-600 truncate"><?php echo e($subtitle); ?></p>
            <?php endif; ?>
        </div>

        <div class="mt-3 md:mt-0 flex items-center justify-end w-full md:w-auto space-x-2">
            <?php echo $actions ?? ''; ?>

        </div>
    </div>

    <div class="mt-3">
        <?php if (! empty(trim($__env->yieldContent('admin_breadcrumb')))): ?>
            <?php echo $__env->yieldContent('admin_breadcrumb'); ?>
        <?php else: ?>
            <nav class="text-sm" aria-label="Breadcrumb">
                <ol class="list-reset flex items-center space-x-2 text-gray-500">
                    <li>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-gray-700">Dashboard</a>
                    </li>
                    <li><span class="text-gray-400">/</span></li>
                    <li class="text-gray-700"><?php echo e($breadcrumbTitle ?? ($title ?? 'Overview')); ?></li>
                </ol>
            </nav>
        <?php endif; ?>
    </div>
</div><?php /**PATH C:\Users\user\OneDrive\tech.olaarowolo.com\Dev\OAScholarshipLiveApp01092026\resources\views/admin/_header.blade.php ENDPATH**/ ?>