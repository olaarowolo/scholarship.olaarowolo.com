<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Analytics Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <?php echo $__env->make('admin._header', [
                        'title' => 'Analytics',
                        'subtitle' => 'Platform usage and application trends',
                        'actions' => '<a href="'.route('admin.dashboard').'" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-full text-sm font-semibold transition duration-200">← Back to Dashboard</a>'
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Applications by Status</h3>
                            <ul class="space-y-2">
                                <li class="flex justify-between items-center p-3 bg-yellow-50 rounded-lg">
                                    <span class="font-medium text-gray-900">Pending</span>
                                    <span class="text-2xl font-bold text-yellow-600"><?php echo e($pendingApplications); ?></span>
                                </li>
                                <li class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                    <span class="font-medium text-gray-900">Approved</span>
                                    <span class="text-2xl font-bold text-green-600"><?php echo e($approvedApplications); ?></span>
                                </li>
                                <li class="flex justify-between items-center p-3 bg-red-50 rounded-lg">
                                    <span class="font-medium text-gray-900">Rejected</span>
                                    <span class="text-2xl font-bold text-red-600"><?php echo e($rejectedApplications); ?></span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Application Statistics</h3>
                            <div class="space-y-4">
                                <div class="p-4 bg-blue-50 rounded-lg">
                                    <div class="text-sm text-gray-500">Total Applications</div>
                                    <div class="text-3xl font-bold text-blue-600"><?php echo e($totalApplications); ?></div>
                                </div>
                                <div class="p-4 bg-purple-50 rounded-lg">
                                    <div class="text-sm text-gray-500">Top Course</div>
                                    <div class="text-lg font-semibold text-purple-600">
                                        <?php echo e($topCourses->first()?->course ?? 'N/A'); ?>

                                    </div>
                                    <div class="text-sm text-gray-500"><?php echo e($topCourses->first()?->count ?? 0); ?>

                                        applications</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Average JAMB Scores by Status -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Average JAMB Scores by Status</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <?php $__currentLoopData = $avgScoreByStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <div class="text-sm text-gray-500"><?php echo e(ucfirst($stat->status)); ?> Applications</div>
                                    <div class="text-2xl font-bold text-gray-700">
                                        <?php echo e(number_format($stat->avg_score, 1)); ?>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <!-- Top Courses -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Top 10 Courses</h3>
                        <?php if($topCourses->count() > 0): ?>
                            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Course</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Applications</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php $__currentLoopData = $topCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="hover:bg-gray-50">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <?php echo e($course->course); ?>

                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <?php echo e($course->count); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="bg-gray-50 p-8 text-center rounded-lg">
                                <p class="text-gray-500">No course data available.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Applications by Month (Last 6 Months)</h3>
                        <?php if($applicationsByMonth->count() > 0): ?>
                            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Month</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Applications</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php $__currentLoopData = $applicationsByMonth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="hover:bg-gray-50">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <?php echo e(\Carbon\Carbon::createFromFormat('Y-m', $month->month)->format('M Y')); ?>

                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <?php echo e($month->count); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="bg-gray-50 p-8 text-center rounded-lg">
                                <p class="text-gray-500">No application data available for the last 6 months.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Visitor Analytics Section -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4">Visitor Analytics</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Total Visitors -->
                            <div class="bg-indigo-50 p-6 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-500">Total Visitors</p>
                                        <p class="text-2xl font-bold text-indigo-600">
                                            <?php echo e($visitorStats['total_visitors']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Visits Today -->
                            <div class="bg-blue-50 p-6 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-500">Visits Today</p>
                                        <p class="text-2xl font-bold text-blue-600">
                                            <?php echo e($visitorStats['unique_visitors_today']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Page Views -->
                            <div class="bg-green-50 p-6 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-500">Total Page Views</p>
                                        <p class="text-2xl font-bold text-green-600">
                                            <?php echo e($visitorStats['visits_today']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Top Countries -->
                        <?php if(count($visitorStats['top_countries']) > 0): ?>
                            <div class="mt-6">
                                <h4 class="text-md font-semibold mb-3">Top Countries</h4>
                                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Country</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Visitors</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <?php $__currentLoopData = $visitorStats['top_countries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="hover:bg-gray-50">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        <?php echo e($country['country']); ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <?php echo e($country['count']); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Top States -->
                        <?php if(count($visitorStats['top_states']) > 0): ?>
                            <div class="mt-6">
                                <h4 class="text-md font-semibold mb-3">Top States</h4>
                                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    State</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Visitors</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <?php $__currentLoopData = $visitorStats['top_states']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="hover:bg-gray-50">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        <?php echo e($state['state']); ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <?php echo e($state['count']); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Top LGAs -->
                        <?php if(count($visitorStats['top_lgas']) > 0): ?>
                            <div class="mt-6">
                                <h4 class="text-md font-semibold mb-3">Top LGAs</h4>
                                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    LGA</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    State</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Visitors</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <?php $__currentLoopData = $visitorStats['top_lgas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="hover:bg-gray-50">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        <?php echo e($lga['lga']); ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <?php echo e($lga['state']); ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <?php echo e($lga['count']); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Recent Visits -->
                        <?php if(count($visitorStats['recent_visits']) > 0): ?>
                            <div class="mt-6">
                                <h4 class="text-md font-semibold mb-3">Recent Visits</h4>
                                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                    <div class="max-h-64 overflow-y-auto">
                                        <?php $__currentLoopData = $visitorStats['recent_visits']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="px-6 py-4 border-b border-gray-200 hover:bg-gray-50">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">
                                                            <?php echo e($visit['ip_address']); ?>

                                                            <?php if($visit['country']): ?>
                                                                <span
                                                                    class="text-xs text-gray-500">(<?php echo e($visit['country']); ?>)</span>
                                                            <?php endif; ?>
                                                        </p>
                                                        <p class="text-xs text-gray-500">
                                                            <?php echo e(\Carbon\Carbon::parse($visit['last_visit_at'])->diffForHumans()); ?>

                                                        </p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="text-sm font-medium text-gray-900">
                                                            <?php echo e($visit['visit_count']); ?> visits</p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\user\OneDrive\tech.olaarowolo.com\Dev\OAScholarshipLiveApp01092026\resources\views/admin/analytics.blade.php ENDPATH**/ ?>