<?php $__env->startSection('content'); ?>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f8f8;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#000000',
                        'secondary': '#333333',
                        'accent': '#e5e7eb',
                    },
                }
            }
        }
    </script>

    <?php
        use App\Models\Application;
        use Illuminate\Support\Str;
        $statusOptions = Application::STATUSES;
        $statusColors = Application::statusColors();
    ?>

    <!-- Applications Management -->
    <div class="min-h-screen pt-6 md:pt-12 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php echo $__env->make('admin._header', [
                'title' => 'Manage Applications',
                'subtitle' => 'View and manage all scholarship applications',
                'actions' => '<a href="'.route('admin.dashboard').'" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-full text-sm font-semibold transition duration-200">← Back to Dashboard</a>'
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <?php if(session('success')): ?>
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <!-- Filters -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 mb-6">
                <form method="GET" action="<?php echo e(route('admin.applications')); ?>"
                    class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" name="search" id="search" value="<?php echo e(request('search')); ?>"
                            placeholder="Name, Email, App ID..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                            <option value="all" <?php echo e(request('status', 'all') == 'all' ? 'selected' : ''); ?>>All Status</option>
                            <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($s); ?>" <?php echo e(request('status') == $s ? 'selected' : ''); ?>><?php echo e(ucfirst(str_replace('_',' ',$s))); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-end space-x-2">
                        <button type="submit"
                            class="bg-black text-white hover:bg-gray-800 px-6 py-2 rounded-lg font-semibold transition duration-200">
                            Apply Filters
                        </button>
                        <a href="<?php echo e(route('admin.applications')); ?>"
                            class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-6 py-2 rounded-lg font-semibold transition duration-200">
                            Clear
                        </a>
                    </div>
                </form>
            </div>

            <!-- Applications Table -->
            <div class="bg-white rounded-lg shadow-md border border-gray-200">
                <?php if($applications->count() > 0): ?>

                    <!-- Mobile: stacked card list -->
                    <div class="md:hidden space-y-4 p-4">
                        <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-white border rounded-lg p-4 shadow-sm">
                                <div class="flex items-start justify-between">
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 truncate"><?php echo e($application->first_name); ?> <?php echo e($application->last_name); ?></p>
                                        <p class="text-xs text-gray-500 mt-1"><?php echo e($application->application_id); ?> • <?php echo e($application->created_at->format('M d, Y')); ?></p>
                                        <p class="text-sm text-gray-700 mt-2 truncate"><?php echo e(Str::limit($application->course, 80)); ?></p>
                                    </div>
                                    <div class="ml-3 flex-shrink-0 text-right space-y-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold <?php echo e($statusColors[$application->status] ?? 'bg-gray-100 text-gray-800'); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $application->status))); ?></span>
                                        <a href="<?php echo e(route('admin.applications.show', $application->id)); ?>" class="text-sm font-semibold text-black block">View →</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Desktop / Tablet: table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Application ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Applicant</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Course</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        JAMB Score</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <?php echo e($application->application_id); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?php echo e($application->first_name); ?> <?php echo e($application->last_name); ?>

                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <?php echo e(Str::limit($application->course, 40)); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?php echo e($application->jamb_score); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php
                                                $badgeClass = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800';
                                            ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($badgeClass); ?>">
                                                <?php echo e(ucfirst(str_replace('_', ' ', $application->status))); ?>

                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <?php echo e($application->created_at->format('M d, Y')); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="<?php echo e(route('admin.applications.show', $application->id)); ?>"
                                                class="text-black hover:underline">View</a>
                                            <span class="text-gray-300">|</span>
                                            <form action="<?php echo e(route('admin.applications.delete', $application->id)); ?>"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this application?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        <?php echo e($applications->links()); ?>

                    </div>
                <?php else: ?>
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="mt-4 text-gray-600">No applications found</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\tech.olaarowolo.com\Dev\OAScholarshipLiveApp01092026\resources\views/admin/applications.blade.php ENDPATH**/ ?>