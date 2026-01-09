<nav class="sticky top-0 z-40 bg-white border-b border-gray-200 shadow-sm" role="navigation" aria-label="Admin Navigation">
    <?php
        use App\Models\Application;
        use App\Models\ScholarRequest;
        use App\Models\User;

        $pendingApplications = Application::where('status', 'pending')->count();
        $pendingScholarRequests = ScholarRequest::where('status', 'pending')->count();
        $disabledUsers = User::whereNull('email_verified_at')->count();
    ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14">
            <div class="flex items-center space-x-6 overflow-x-auto">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center space-x-2 mr-4 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a1 1 0 001 1h16a1 1 0 001-1V7M3 7l9-4 9 4"></path>
                    </svg>
                    <span class="text-sm font-bold text-gray-900">OA Admin</span>
                </a>

                <!-- Mobile toggle (visible on small screens) -->
                <button id="admin-menu-toggle" aria-controls="admin-menu-mobile" aria-expanded="false" class="ml-2 md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-label="Toggle menu">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                    </svg>
                </button>

                <!-- Desktop links -->
                <div id="admin-menu-links" class="hidden md:flex items-center space-x-6">
                    <a href="<?php echo e(route('admin.applications')); ?>"
                        aria-current="<?php echo e(request()->routeIs('admin.applications*') ? 'page' : ''); ?>"
                        class="whitespace-nowrap px-3 py-2 rounded-md flex items-center space-x-2 <?php echo e(request()->routeIs('admin.applications*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'); ?> focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-sm font-medium">Applications</span>
                        <?php if($pendingApplications > 0): ?>
                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800" aria-label="<?php echo e($pendingApplications); ?> pending applications"><?php echo e($pendingApplications); ?></span>
                        <?php endif; ?>
                    </a>

                    <a href="<?php echo e(route('admin.scholar-requests')); ?>"
                        aria-current="<?php echo e(request()->routeIs('admin.scholar-requests*') ? 'page' : ''); ?>"
                        class="whitespace-nowrap px-3 py-2 rounded-md flex items-center space-x-2 <?php echo e(request()->routeIs('admin.scholar-requests*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'); ?> focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <span class="text-sm font-medium">Requests</span>
                        <?php if($pendingScholarRequests > 0): ?>
                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800" aria-label="<?php echo e($pendingScholarRequests); ?> pending requests"><?php echo e($pendingScholarRequests); ?></span>
                        <?php endif; ?>
                    </a>

                    <a href="<?php echo e(route('admin.users')); ?>"
                        aria-current="<?php echo e(request()->routeIs('admin.users*') ? 'page' : ''); ?>"
                        class="whitespace-nowrap px-3 py-2 rounded-md flex items-center space-x-2 <?php echo e(request()->routeIs('admin.users*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'); ?> focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="text-sm font-medium">Users</span>
                        <?php if($disabledUsers > 0): ?>
                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800" aria-label="<?php echo e($disabledUsers); ?> unverified users"><?php echo e($disabledUsers); ?></span>
                        <?php endif; ?>
                    </a>

                    <a href="<?php echo e(route('admin.analytics')); ?>"
                        aria-current="<?php echo e(request()->routeIs('admin.analytics*') ? 'page' : ''); ?>"
                        class="whitespace-nowrap px-3 py-2 rounded-md flex items-center space-x-2 <?php echo e(request()->routeIs('admin.analytics*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'); ?> focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19V6l5 3 5-3v13" />
                        </svg>
                        <span class="text-sm font-medium">Analytics</span>
                    </a>

                    <a href="<?php echo e(route('admin.export')); ?>"
                        aria-current="<?php echo e(request()->routeIs('admin.export*') ? 'page' : ''); ?>"
                        class="whitespace-nowrap px-3 py-2 rounded-md flex items-center space-x-2 <?php echo e(request()->routeIs('admin.export*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'); ?> focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-sm font-medium">Export</span>
                    </a>

                    <a href="<?php echo e(route('admin.form-settings')); ?>"
                        aria-current="<?php echo e(request()->routeIs('admin.form-settings*') ? 'page' : ''); ?>"
                        class="whitespace-nowrap px-3 py-2 rounded-md flex items-center space-x-2 <?php echo e(request()->routeIs('admin.form-settings*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'); ?> focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 1.343-3 3 0 1.106.6 2.073 1.5 2.58V19l1.5-1.5L13.5 19v-5.42c.9-.507 1.5-1.474 1.5-2.58 0-1.657-1.343-3-3-3z" />
                        </svg>
                        <span class="text-sm font-medium">Forms</span>
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <a href="<?php echo e(url('/')); ?>" target="_blank" rel="noopener" class="text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">View Site</a>
                <div class="h-6 border-l border-gray-200"></div>
                <div class="text-sm text-gray-700 hidden sm:block"><?php echo e(Auth::user()->name); ?></div>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Logout</button>
                </form>
            </div>
        </div>

        <!-- Mobile collapsible menu -->
        <div id="admin-menu-mobile" class="md:hidden hidden bg-white border-t border-gray-200">
            <div class="px-4 py-3 space-y-1">
                <a href="<?php echo e(route('admin.applications')); ?>" class="flex items-center justify-between px-3 py-2 rounded-md text-sm font-medium <?php echo e(request()->routeIs('admin.applications*') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-50'); ?>">
                    <span>Applications</span>
                    <?php if($pendingApplications > 0): ?>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800"><?php echo e($pendingApplications); ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?php echo e(route('admin.scholar-requests')); ?>" class="flex items-center justify-between px-3 py-2 rounded-md text-sm font-medium <?php echo e(request()->routeIs('admin.scholar-requests*') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-50'); ?>">
                    <span>Requests</span>
                    <?php if($pendingScholarRequests > 0): ?>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800"><?php echo e($pendingScholarRequests); ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?php echo e(route('admin.users')); ?>" class="flex items-center justify-between px-3 py-2 rounded-md text-sm font-medium <?php echo e(request()->routeIs('admin.users*') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-50'); ?>">
                    <span>Users</span>
                    <?php if($disabledUsers > 0): ?>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800"><?php echo e($disabledUsers); ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?php echo e(route('admin.analytics')); ?>" class="block px-3 py-2 rounded-md text-sm font-medium <?php echo e(request()->routeIs('admin.analytics*') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-50'); ?>">Analytics</a>
                <a href="<?php echo e(route('admin.export')); ?>" class="block px-3 py-2 rounded-md text-sm font-medium <?php echo e(request()->routeIs('admin.export*') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-50'); ?>">Export</a>
                <a href="<?php echo e(route('admin.form-settings')); ?>" class="block px-3 py-2 rounded-md text-sm font-medium <?php echo e(request()->routeIs('admin.form-settings*') ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:bg-gray-50'); ?>">Forms</a>

                <div class="border-t border-gray-100 my-2"></div>
                <a href="<?php echo e(url('/')); ?>" target="_blank" rel="noopener" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">View Site</a>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="px-3 py-2">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full text-left text-sm text-red-600 hover:text-red-800">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('admin-menu-toggle');
            const mobileMenu = document.getElementById('admin-menu-mobile');

            if (toggle && mobileMenu) {
                toggle.addEventListener('click', function () {
                    const expanded = toggle.getAttribute('aria-expanded') === 'true';
                    toggle.setAttribute('aria-expanded', (!expanded).toString());
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</nav>
<?php /**PATH C:\Users\user\OneDrive\tech.olaarowolo.com\Dev\OAScholarshipLiveApp01092026\resources\views/admin/_menu.blade.php ENDPATH**/ ?>