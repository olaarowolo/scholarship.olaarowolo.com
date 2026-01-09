    <?php if(session('success')): ?>
        <div class="max-w-7xl mx-auto mb-6">
            <div class="bg-green-100 border border-green-300 text-green-800 px-6 py-4 rounded-xl shadow">
                <?php echo e(session('success')); ?>

            </div>
        </div>
    <?php endif; ?>
    

    <?php $__env->startSection('content'); ?>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'primary': '#000000',
                            'accent-yellow': '#facc15',
                        },
                    }
                }
            }
        </script>

        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f8f8f8;
            }
        </style>

        <?php
            $user = Auth::user();
        ?>

        <?php echo $__env->make('components.navbar', ['user' => $user], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="min-h-screen bg-gray-50 pt-36 pb-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <!-- Welcome Header -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome back, <?php echo e($user->name); ?>!</h1>
                            <p class="text-gray-600">Scholar Dashboard</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Request Assistance -->
                    <a href="<?php echo e(route('scholar.requests.create')); ?>"
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Make a Request</h3>
                        <p class="text-gray-600 text-sm">Submit requests for assistance, resources, or support</p>
                    </a>

                    <!-- Academic Standing -->
                    <a href="<?php echo e(route('scholar.academic-standing')); ?>"
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Academic Standing</h3>
                        <p class="text-gray-600 text-sm">Submit your current grades and academic progress</p>
                    </a>

                    <!-- Document Challenges -->
                    <a href="<?php echo e(route('scholar.challenges')); ?>"
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Document Challenges</h3>
                        <p class="text-gray-600 text-sm">Share challenges you're facing and get support</p>
                    </a>

                    <!-- Book Mentorship -->
                    <a href="<?php echo e(route('scholar.mentorship')); ?>"
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Book Mentorship</h3>
                        <p class="text-gray-600 text-sm">Schedule drop-in sessions with mentors</p>
                    </a>

                    <!-- Academic Advice -->
                    <a href="<?php echo e(route('scholar.advice')); ?>"
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Academic Advice</h3>
                        <p class="text-gray-600 text-sm">Ask for academic guidance and assistance</p>
                    </a>

                    <!-- Resources -->
                    <a href="<?php echo e(route('resources')); ?>"
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Resources</h3>
                        <p class="text-gray-600 text-sm">Access scholarship resources and materials</p>
                    </a>
                </div>

                <!-- Statistics Overview -->
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-8">
                    <!-- Scholar Requests -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-medium text-gray-600">Requests</h3>
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-900"><?php echo e($requests->count()); ?></p>
                        <a href="<?php echo e(route('scholar.my-requests')); ?>"
                            class="text-sm text-blue-600 hover:text-blue-700 mt-2 inline-block">View all →</a>
                    </div>

                    <!-- Academic Reports -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-medium text-gray-600">Reports</h3>
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-900"><?php echo e($academicReports->count()); ?></p>
                        <a href="<?php echo e(route('scholar.my-academic-reports')); ?>"
                            class="text-sm text-green-600 hover:text-green-700 mt-2 inline-block">View all →</a>
                    </div>

                    <!-- Challenge Reports -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-medium text-gray-600">Challenges</h3>
                            <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-900"><?php echo e($challengeReports->count()); ?></p>
                        <a href="<?php echo e(route('scholar.my-challenges')); ?>"
                            class="text-sm text-yellow-600 hover:text-yellow-700 mt-2 inline-block">View all →</a>
                    </div>

                    <!-- Mentorship Bookings -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-medium text-gray-600">Mentorship</h3>
                            <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-900"><?php echo e($mentorshipBookings->count()); ?></p>
                        <a href="<?php echo e(route('scholar.my-mentorship-bookings')); ?>"
                            class="text-sm text-purple-600 hover:text-purple-700 mt-2 inline-block">View all →</a>
                    </div>

                    <!-- Advice Requests -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-medium text-gray-600">Advice</h3>
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-gray-900"><?php echo e($adviceRequests->count()); ?></p>
                        <a href="<?php echo e(route('scholar.my-advice-requests')); ?>"
                            class="text-sm text-indigo-600 hover:text-indigo-700 mt-2 inline-block">View all →</a>
                    </div>
                </div>

                <!-- Recent Submissions -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Recent Submissions</h2>

                    <?php
                        $allSubmissions = collect();

                        foreach ($requests as $request) {
                            $allSubmissions->push([
                                'type' => 'Request',
                                'title' => $request->subject,
                                'status' => $request->status,
                                'date' => $request->created_at,
                                'icon' => 'chat',
                                'color' => 'blue',
                            ]);
                        }

                        foreach ($academicReports as $report) {
                            $allSubmissions->push([
                                'type' => 'Academic Report',
                                'title' => $report->semester . ' - Level ' . $report->level,
                                'status' => $report->status,
                                'date' => $report->created_at,
                                'icon' => 'check',
                                'color' => 'green',
                            ]);
                        }

                        foreach ($challengeReports as $challenge) {
                            $allSubmissions->push([
                                'type' => 'Challenge',
                                'title' => $challenge->title,
                                'status' => $challenge->status,
                                'date' => $challenge->created_at,
                                'icon' => 'warning',
                                'color' => 'yellow',
                            ]);
                        }

                        foreach ($mentorshipBookings as $booking) {
                            $allSubmissions->push([
                                'type' => 'Mentorship',
                                'title' => $booking->topic,
                                'status' => $booking->status,
                                'date' => $booking->created_at,
                                'icon' => 'calendar',
                                'color' => 'purple',
                            ]);
                        }

                        foreach ($adviceRequests as $advice) {
                            $allSubmissions->push([
                                'type' => 'Advice',
                                'title' => $advice->subject,
                                'status' => $advice->status,
                                'date' => $advice->created_at,
                                'icon' => 'book',
                                'color' => 'indigo',
                            ]);
                        }

                        $allSubmissions = $allSubmissions->sortByDesc('date')->take(10);
                    ?>

                    <div class="space-y-4">
                        <?php $__empty_1 = true; $__currentLoopData = $allSubmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex items-center justify-between py-4 border-b border-gray-100 last:border-0">
                                <div class="flex items-center flex-1">
                                    <div
                                        class="w-10 h-10 rounded-full bg-<?php echo e($submission['color']); ?>-100 flex items-center justify-center mr-4">
                                        <?php if($submission['icon'] == 'chat'): ?>
                                            <svg class="w-5 h-5 text-<?php echo e($submission['color']); ?>-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        <?php elseif($submission['icon'] == 'check'): ?>
                                            <svg class="w-5 h-5 text-<?php echo e($submission['color']); ?>-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        <?php elseif($submission['icon'] == 'warning'): ?>
                                            <svg class="w-5 h-5 text-<?php echo e($submission['color']); ?>-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        <?php elseif($submission['icon'] == 'calendar'): ?>
                                            <svg class="w-5 h-5 text-<?php echo e($submission['color']); ?>-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        <?php else: ?>
                                            <svg class="w-5 h-5 text-<?php echo e($submission['color']); ?>-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-900 font-medium"><?php echo e($submission['title']); ?></p>
                                        <div class="flex items-center mt-1">
                                            <span class="text-gray-500 text-sm"><?php echo e($submission['type']); ?></span>
                                            <span class="mx-2 text-gray-300">•</span>
                                            <span
                                                class="text-gray-500 text-sm"><?php echo e($submission['date']->diffForHumans()); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <?php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                            'in_progress' => 'bg-blue-100 text-blue-800 border-blue-300',
                                            'resolved' => 'bg-green-100 text-green-800 border-green-300',
                                            'closed' => 'bg-gray-100 text-gray-800 border-gray-300',
                                            'submitted' => 'bg-blue-100 text-blue-800 border-blue-300',
                                            'reviewed' => 'bg-green-100 text-green-800 border-green-300',
                                            'flagged' => 'bg-red-100 text-red-800 border-red-300',
                                            'under_review' => 'bg-blue-100 text-blue-800 border-blue-300',
                                            'addressed' => 'bg-green-100 text-green-800 border-green-300',
                                            'ongoing' => 'bg-purple-100 text-purple-800 border-purple-300',
                                            'confirmed' => 'bg-green-100 text-green-800 border-green-300',
                                            'completed' => 'bg-gray-100 text-gray-800 border-gray-300',
                                            'cancelled' => 'bg-red-100 text-red-800 border-red-300',
                                            'answered' => 'bg-green-100 text-green-800 border-green-300',
                                        ];
                                        $statusClass =
                                            $statusColors[$submission['status']] ??
                                            'bg-gray-100 text-gray-800 border-gray-300';
                                    ?>
                                    <span class="px-3 py-1 rounded-full text-xs font-medium border <?php echo e($statusClass); ?>">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $submission['status']))); ?>

                                    </span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="flex items-center justify-between py-4 border-b border-gray-100 last:border-0">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mr-4">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-gray-900 font-medium">Welcome to your Scholar Dashboard</p>
                                        <p class="text-gray-500 text-sm">Get started by exploring the available features
                                            above
                                        </p>
                                    </div>
                                </div>
                                <span class="text-gray-400 text-sm">Just now</span>
                                <p class="text-gray-900 font-medium">Welcome to your Scholar Dashboard</p>
                                <p class="text-gray-500 text-sm">Get started by exploring the available features above</p>
                            </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        </div>
        </div>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home1/httprapu/scholarship.olaarowolo.com/resources/views/scholar-dashboard.blade.php ENDPATH**/ ?>