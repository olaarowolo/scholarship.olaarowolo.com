<?php $__env->startSection('content'); ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php $user = Auth::user(); ?>
    <?php echo $__env->make('components.navbar', ['user' => $user], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center pt-48 pb-8 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl mx-auto flex flex-col items-center justify-center">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 w-full">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">My Academic Advice Requests</h1>
                <?php if($adviceRequests->isEmpty()): ?>
                    <p class="text-gray-600">You have not submitted any advice requests yet.</p>
                <?php else: ?>
                    <div class="space-y-6">
                        <?php $__currentLoopData = $adviceRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border rounded-xl p-6 bg-gray-50">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-lg text-gray-800"><?php echo e(ucfirst($request->category)); ?></span>
                                    <span class="text-xs px-3 py-1 rounded-full <?php echo e($request->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800'); ?>">
                                        <?php echo e(ucfirst($request->status)); ?>

                                    </span>
                                </div>
                                <div class="mb-2 text-gray-700"><?php echo e($request->subject); ?></div>
                                <div class="text-sm text-gray-500 mb-2">Urgency: <?php echo e(ucfirst($request->urgency)); ?></div>
                                <div class="text-xs text-gray-400">Submitted: <?php echo e($request->created_at->format('M d, Y H:i')); ?></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/olasunkanmiarowolo/scholarship.olaarowolo.com/resources/views/scholar/my-advice-requests.blade.php ENDPATH**/ ?>