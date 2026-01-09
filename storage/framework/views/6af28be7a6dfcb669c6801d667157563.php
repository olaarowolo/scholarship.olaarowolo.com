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
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <?php echo e(__('Admin Dashboard')); ?>

                </h2>
                <p class="text-sm text-gray-600 mt-1">Welcome back, <?php echo e(Auth::user()->name); ?></p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="px-4 py-2 bg-black text-white text-sm font-semibold rounded-full shadow-lg">
                    <svg class="w-4 h-4 inline-block mr-1.5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Admin
                </span>
                <div
                    class="w-10 h-10 rounded-full bg-gradient-to-br from-black to-gray-700 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                    <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                </div>
                <!-- Logout Button -->
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="ml-4 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Logout
                    </button>
                </form>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .pulse-icon {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .7;
            }
        }
    </style>

    <div class="py-8 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <!-- Total Applications -->
                <div class="stat-card bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 animate-fadeInUp"
                    style="animation-delay: 0.1s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-3 shadow-lg">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total</span>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-semibold text-gray-600">Applications</dt>
                            <dd class="text-4xl font-extrabold text-gray-900 tracking-tight"><?php echo e($totalApplications); ?>

                            </dd>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="<?php echo e(route('admin.applications')); ?>"
                                class="text-blue-600 hover:text-blue-700 text-sm font-semibold flex items-center group">
                                View all
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pending Applications -->
                <div class="stat-card bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 animate-fadeInUp"
                    style="animation-delay: 0.2s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-xl p-3 shadow-lg pulse-icon">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Pending</span>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-semibold text-gray-600">Review Needed</dt>
                            <dd class="text-4xl font-extrabold text-gray-900 tracking-tight"><?php echo e($pendingApplications); ?>

                            </dd>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="<?php echo e(route('admin.applications', ['status' => 'pending'])); ?>"
                                class="text-yellow-600 hover:text-yellow-700 text-sm font-semibold flex items-center group">
                                Review now
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Approved Applications -->
                <div class="stat-card bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 animate-fadeInUp"
                    style="animation-delay: 0.3s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-3 shadow-lg">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Approved</span>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-semibold text-gray-600">Successful</dt>
                            <dd class="text-4xl font-extrabold text-gray-900 tracking-tight"><?php echo e($approvedApplications); ?>

                            </dd>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="<?php echo e(route('admin.applications', ['status' => 'approved'])); ?>"
                                class="text-green-600 hover:text-green-700 text-sm font-semibold flex items-center group">
                                View approved
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="stat-card bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 animate-fadeInUp"
                    style="animation-delay: 0.4s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-3 shadow-lg">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Users</span>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-semibold text-gray-600">Registered</dt>
                            <dd class="text-4xl font-extrabold text-gray-900 tracking-tight"><?php echo e($totalUsers); ?></dd>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="<?php echo e(route('admin.users')); ?>"
                                class="text-purple-600 hover:text-purple-700 text-sm font-semibold flex items-center group">
                                Manage users
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Visitors -->
                <div class="stat-card bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 animate-fadeInUp"
                    style="animation-delay: 0.5s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-3 shadow-lg">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Traffic</span>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-semibold text-gray-600">Total Visitors</dt>
                            <dd class="text-4xl font-extrabold text-gray-900 tracking-tight">
                                <?php echo e(\App\Models\Visitor::count()); ?></dd>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="<?php echo e(route('admin.analytics')); ?>"
                                class="text-indigo-600 hover:text-indigo-700 text-sm font-semibold flex items-center group">
                                View analytics
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-2xl rounded-2xl mb-8 border border-gray-200 animate-fadeInUp"
                style="animation-delay: 0.6s">
                <div class="px-6 py-5 border-b border-gray-200 bg-white">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-gray-700 mr-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <h3 class="text-xl font-bold text-gray-900">Quick Actions</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="<?php echo e(route('admin.applications')); ?>"
                            class="group flex items-center p-5 bg-white rounded-xl hover:bg-blue-50 transition-all duration-300 border-2 border-transparent hover:border-blue-200 shadow-md hover:shadow-lg">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="ml-4 text-sm font-bold text-gray-900">View Applications</span>
                        </a>

                        <a href="<?php echo e(route('admin.users')); ?>"
                            class="group flex items-center p-5 bg-white rounded-xl hover:bg-purple-50 transition-all duration-300 border-2 border-transparent hover:border-purple-200 shadow-md hover:shadow-lg">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <span class="ml-4 text-sm font-bold text-gray-900">Manage Users</span>
                        </a>

                        <a href="<?php echo e(route('admin.analytics')); ?>"
                            class="group flex items-center p-5 bg-white rounded-xl hover:bg-green-50 transition-all duration-300 border-2 border-transparent hover:border-green-200 shadow-md hover:shadow-lg">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <span class="ml-4 text-sm font-bold text-gray-900">View Analytics</span>
                        </a>

                        <a href="<?php echo e(route('admin.export')); ?>"
                            class="group flex items-center p-5 bg-white rounded-xl hover:bg-yellow-50 transition-all duration-300 border-2 border-transparent hover:border-yellow-200 shadow-md hover:shadow-lg">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="ml-4 text-sm font-bold text-gray-900">Export Data</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Scholar Submissions Statistics -->
            <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-2xl rounded-2xl mb-8 border border-gray-200 animate-fadeInUp"
                style="animation-delay: 0.65s">
                <div class="px-6 py-5 border-b border-gray-200 bg-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-indigo-600 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900">Scholar Submissions</h3>
                        </div>
                        <span class="text-xs font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Active
                            Scholars</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <!-- Scholar Requests -->
                        <a href="<?php echo e(route('admin.scholar-requests')); ?>"
                            class="group flex flex-col p-5 bg-white rounded-xl hover:bg-blue-50 transition-all duration-300 border-2 border-transparent hover:border-blue-200 shadow-md hover:shadow-lg">
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                </div>
                                <?php if($pendingScholarRequests > 0): ?>
                                    <span
                                        class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full pulse-icon"><?php echo e($pendingScholarRequests); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="text-2xl font-bold text-gray-900"><?php echo e($totalScholarRequests); ?></div>
                            <span class="text-sm font-medium text-gray-600 mt-1">Requests</span>
                        </a>

                        <!-- Academic Reports -->
                        <a href="<?php echo e(route('admin.academic-reports')); ?>"
                            class="group flex flex-col p-5 bg-white rounded-xl hover:bg-green-50 transition-all duration-300 border-2 border-transparent hover:border-green-200 shadow-md hover:shadow-lg">
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </div>
                                <?php if($pendingAcademicReports > 0): ?>
                                    <span
                                        class="bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-full"><?php echo e($pendingAcademicReports); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="text-2xl font-bold text-gray-900"><?php echo e($totalAcademicReports); ?></div>
                            <span class="text-sm font-medium text-gray-600 mt-1">Reports</span>
                        </a>

                        <!-- Challenge Reports -->
                        <a href="<?php echo e(route('admin.challenge-reports')); ?>"
                            class="group flex flex-col p-5 bg-white rounded-xl hover:bg-yellow-50 transition-all duration-300 border-2 border-transparent hover:border-yellow-200 shadow-md hover:shadow-lg">
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="flex-shrink-0 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </div>
                                <?php if($criticalChallenges > 0): ?>
                                    <span
                                        class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full pulse-icon"><?php echo e($criticalChallenges); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="text-2xl font-bold text-gray-900"><?php echo e($totalChallengeReports); ?></div>
                            <span class="text-sm font-medium text-gray-600 mt-1">Challenges</span>
                        </a>

                        <!-- Mentorship Bookings -->
                        <a href="<?php echo e(route('admin.mentorship-bookings')); ?>"
                            class="group flex flex-col p-5 bg-white rounded-xl hover:bg-purple-50 transition-all duration-300 border-2 border-transparent hover:border-purple-200 shadow-md hover:shadow-lg">
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </div>
                                <?php if($pendingMentorshipBookings > 0): ?>
                                    <span
                                        class="bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full"><?php echo e($pendingMentorshipBookings); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="text-2xl font-bold text-gray-900"><?php echo e($totalMentorshipBookings); ?></div>
                            <span class="text-sm font-medium text-gray-600 mt-1">Bookings</span>
                        </a>

                        <!-- Advice Requests -->
                        <a href="<?php echo e(route('admin.advice-requests')); ?>"
                            class="group flex flex-col p-5 bg-white rounded-xl hover:bg-indigo-50 transition-all duration-300 border-2 border-transparent hover:border-indigo-200 shadow-md hover:shadow-lg">
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="flex-shrink-0 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </div>
                                <?php if($pendingAdviceRequests > 0): ?>
                                    <span
                                        class="bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full"><?php echo e($pendingAdviceRequests); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="text-2xl font-bold text-gray-900"><?php echo e($totalAdviceRequests); ?></div>
                            <span class="text-sm font-medium text-gray-600 mt-1">Advice</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Applications & User Management -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Applications -->
                <div class="bg-white overflow-hidden shadow-2xl rounded-2xl border border-gray-200 animate-fadeInUp"
                    style="animation-delay: 0.7s">
                    <div
                        class="px-6 py-5 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-blue-50 to-white">
                        <div class="flex items-center">
                            <div class="bg-blue-100 rounded-lg p-2 mr-3">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Recent Applications</h3>
                        </div>
                        <a href="<?php echo e(route('admin.applications')); ?>"
                            class="text-sm text-blue-600 hover:text-blue-800 font-semibold flex items-center group">
                            View all
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $recentApplications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="p-5 hover:bg-gray-50 transition-all duration-200 cursor-pointer group">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center text-white font-bold text-sm shadow-lg group-hover:scale-110 transition-transform">
                                                <?php echo e(strtoupper(substr($application->first_name, 0, 1))); ?><?php echo e(strtoupper(substr($application->last_name, 0, 1))); ?>

                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-gray-900 truncate">
                                                <?php echo e($application->first_name); ?> <?php echo e($application->last_name); ?>

                                            </p>
                                            <p class="text-sm text-gray-600 truncate"><?php echo e($application->email); ?></p>
                                            <p class="text-xs text-gray-400 mt-1 flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <?php echo e($application->created_at->diffForHumans()); ?>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full shadow-sm
                                            <?php echo e($application->status == 'pending' ? 'bg-yellow-100 text-yellow-800 ring-2 ring-yellow-200' : ''); ?>

                                            <?php echo e($application->status == 'approved' ? 'bg-green-100 text-green-800 ring-2 ring-green-200' : ''); ?>

                                            <?php echo e($application->status == 'rejected' ? 'bg-red-100 text-red-800 ring-2 ring-red-200' : ''); ?>">
                                            <?php echo e(ucfirst($application->status)); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="p-12 text-center">
                                <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <p class="mt-4 text-gray-500 font-medium">No applications yet</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- User Management Summary -->
                <div class="bg-white overflow-hidden shadow-2xl rounded-2xl border border-gray-200 animate-fadeInUp"
                    style="animation-delay: 0.8s">
                    <div
                        class="px-6 py-5 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-purple-50 to-white">
                        <div class="flex items-center">
                            <div class="bg-purple-100 rounded-lg p-2 mr-3">
                                <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">User Management</h3>
                        </div>
                        <a href="<?php echo e(route('admin.users')); ?>"
                            class="text-sm text-purple-600 hover:text-purple-800 font-semibold flex items-center group">
                            Manage all
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div
                                class="flex items-center justify-between p-5 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-3 shadow-lg">
                                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.025 12.025 0 003 12a12.025 12.025 0 001.382 5.618A11.955 11.955 0 0112 21.056a11.955 11.955 0 008.618-3.04A12.025 12.025 0 0021 12a12.025 12.025 0 00-1.382-5.618A11.955 11.955 0 0112 2.944z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Total Users</p>
                                        <p class="text-2xl font-bold text-gray-800"><?php echo e($totalUsers); ?></p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="<?php echo e(route('admin.users')); ?>"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-purple-100 text-purple-600 hover:bg-purple-200 transition-all duration-300">
                                        View all
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between p-5 bg-gradient-to-r from-green-50 to-green-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-3 shadow-lg">
                                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Approved Users</p>
                                        <p class="text-2xl font-bold text-gray-800"><?php echo e($approvedUsers); ?></p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="<?php echo e(route('admin.users', ['status' => 'approved'])); ?>"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition-all duration-300">
                                        View all
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between p-5 bg-gradient-to-r from-red-50 to-red-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-3 shadow-lg">
                                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Rejected Users</p>
                                        <p class="text-2xl font-bold text-gray-800"><?php echo e($rejectedUsers); ?></p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="<?php echo e(route('admin.users', ['status' => 'rejected'])); ?>"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition-all duration-300">
                                        View all
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between p-5 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-xl p-3 shadow-lg">
                                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Pending Users</p>
                                        <p class="text-2xl font-bold text-gray-800"><?php echo e($pendingUsers); ?></p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="<?php echo e(route('admin.users', ['status' => 'pending'])); ?>"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition-all duration-300">
                                        View all
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Message Tray -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 mt-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Message Tray</h3>
            <div id="message-tray" class="space-y-3">
                <!-- Messages will be dynamically loaded here -->
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    fetch('/messages/tray')
                        .then(response => response.json())
                        .then(messages => {
                            const tray = document.getElementById('message-tray');
                            tray.innerHTML = '';
                            if (messages.length === 0) {
                                tray.innerHTML = '<p class="text-gray-500">No messages yet.</p>';
                            } else {
                                messages.forEach(msg => {
                                    tray.innerHTML +=
                                        `<div class='p-3 bg-gray-50 rounded border mb-2'><span class='font-semibold'>${msg.content}</span><br><span class='text-xs text-gray-400'>${new Date(msg.created_at).toLocaleString()}</span></div>`;
                                });
                            }
                        });
                });
            </script>
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
<?php /**PATH /home1/httprapu/scholarship.olaarowolo.com/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>