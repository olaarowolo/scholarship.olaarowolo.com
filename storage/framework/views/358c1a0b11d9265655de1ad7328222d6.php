<?php $__env->startSection('content'); ?>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Form Settings</h1>
                <p class="text-gray-600">Control when forms are open for submissions</p>
            </div>

            <!-- Success Message -->
            <?php if(session('success')): ?>
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-green-800"><?php echo e(session('success')); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Forms Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <form action="<?php echo e(route('admin.form-settings.update', $form->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <!-- Form Name -->
                            <div class="mb-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">
                                    <?php echo e(ucwords(str_replace('_', ' ', $form->form_name))); ?>

                                </h3>
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-700 mr-3">Status:</span>
                                    <?php if($form->isCurrentlyOpen()): ?>
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            <span class="w-2 h-2 bg-green-600 rounded-full mr-2"></span>
                                            Open
                                        </span>
                                    <?php else: ?>
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            <span class="w-2 h-2 bg-red-600 rounded-full mr-2"></span>
                                            Closed
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Is Open Toggle -->
                            <div class="mb-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="hidden" name="is_open" value="0">
                                    <input type="checkbox" name="is_open" value="1"
                                        <?php echo e($form->is_open ? 'checked' : ''); ?>

                                        class="w-5 h-5 text-black border-gray-300 rounded focus:ring-black">
                                    <span class="ml-3 text-sm font-semibold text-gray-700">Form is Open</span>
                                </label>
                            </div>

                            <!-- Opens At -->
                            <div class="mb-4">
                                <label for="opens_at_<?php echo e($form->id); ?>"
                                    class="block text-sm font-semibold text-gray-700 mb-2">
                                    Opens At (Optional)
                                </label>
                                <input type="datetime-local" id="opens_at_<?php echo e($form->id); ?>" name="opens_at"
                                    value="<?php echo e($form->opens_at ? $form->opens_at->format('Y-m-d\TH:i') : ''); ?>"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black">
                                <p class="mt-1 text-xs text-gray-500">Form will open at this date/time</p>
                            </div>

                            <!-- Closes At -->
                            <div class="mb-4">
                                <label for="closes_at_<?php echo e($form->id); ?>"
                                    class="block text-sm font-semibold text-gray-700 mb-2">
                                    Closes At (Optional)
                                </label>
                                <input type="datetime-local" id="closes_at_<?php echo e($form->id); ?>" name="closes_at"
                                    value="<?php echo e($form->closes_at ? $form->closes_at->format('Y-m-d\TH:i') : ''); ?>"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black">
                                <p class="mt-1 text-xs text-gray-500">Form will close at this date/time</p>
                            </div>

                            <!-- Closed Message -->
                            <div class="mb-6">
                                <label for="closed_message_<?php echo e($form->id); ?>"
                                    class="block text-sm font-semibold text-gray-700 mb-2">
                                    Closed Message
                                </label>
                                <textarea id="closed_message_<?php echo e($form->id); ?>" name="closed_message" rows="3"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black"
                                    placeholder="Message shown when form is closed"><?php echo e($form->closed_message); ?></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 font-semibold transition-colors duration-200">
                                Update Settings
                            </button>
                        </form>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/olasunkanmiarowolo/scholarship.olaarowolo.com/resources/views/admin/form-settings.blade.php ENDPATH**/ ?>