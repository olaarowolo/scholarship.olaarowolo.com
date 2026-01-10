<?php $__env->startSection('content'); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                                    <dd class="text-lg font-semibold text-gray-900"><?php echo e($userStats['total']); ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-purple-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Admins</dt>
                                    <dd class="text-lg font-semibold text-gray-900"><?php echo e($userStats['admin']); ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Applicants</dt>
                                    <dd class="text-lg font-semibold text-gray-900"><?php echo e($userStats['applicant']); ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Scholars</dt>
                                    <dd class="text-lg font-semibold text-gray-900"><?php echo e($userStats['scholar']); ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Review Team</dt>
                                    <dd class="text-lg font-semibold text-gray-900"><?php echo e($userStats['review_team']); ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Back Button & Success Message -->
                    <?php echo $__env->make('admin._header', [
                        'title' => 'User Management',
                        'subtitle' => 'Manage all registered users',
                        'actions' => '<a href="'.route('admin.dashboard').'" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-full text-sm font-semibold transition duration-200">← Back to Dashboard</a>'
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <?php if(session('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <!-- Search and Filter Form -->
                    <form method="GET" action="<?php echo e(route('admin.users')); ?>" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search
                                    Users</label>
                                <input type="text" name="search" id="search" value="<?php echo e(request('search')); ?>"
                                    placeholder="Name or Email..."
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>

                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Filter by
                                    Role</label>
                                <select name="role" id="role"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    <option value="all" <?php echo e(request('role') == 'all' ? 'selected' : ''); ?>>All Roles
                                    </option>
                                    <option value="admin" <?php echo e(request('role') == 'admin' ? 'selected' : ''); ?>>Admin
                                    </option>
                                    <option value="applicant" <?php echo e(request('role') == 'applicant' ? 'selected' : ''); ?>>
                                        Applicant</option>
                                    <option value="scholar" <?php echo e(request('role') == 'scholar' ? 'selected' : ''); ?>>
                                        Scholar</option>
                                    <option value="review_team"
                                        <?php echo e(request('role') == 'review_team' ? 'selected' : ''); ?>>Review Team</option>
                                </select>
                            </div>

                            <div class="flex items-end">
                                <button type="submit"
                                    class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded mr-2">
                                    Apply Filters
                                </button>
                                <a href="<?php echo e(route('admin.users')); ?>"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                    Clear
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Users Table -->
                    <div class="overflow-x-auto">

                        <!-- Mobile: stacked card list -->
                        <div class="md:hidden space-y-4">
                            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="bg-white border rounded-lg p-4 shadow-sm">
                                    <div class="flex items-center justify-between">
                                        <div class="min-w-0">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                                                    <span class="text-purple-600 font-semibold"><?php echo e(strtoupper(substr($user->name, 0, 2))); ?></span>
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-sm font-semibold text-gray-900 truncate"><?php echo e($user->name); ?></p>
                                                    <p class="text-xs text-gray-500 truncate"><?php echo e($user->email); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-3 flex-shrink-0 text-right space-y-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold <?php echo e($user->role == 'admin' ? 'bg-purple-100 text-purple-800' : ($user->role == 'scholar' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800')); ?>"><?php echo e(ucfirst(str_replace('_',' ', $user->role ?? 'user'))); ?></span>
                                            <p class="text-xs text-gray-400"><?php echo e($user->created_at->format('M d, Y')); ?></p>
                                        </div>
                                    </div>

                                    <div class="mt-4 flex items-center justify-between">
                                        <form method="POST" action="<?php echo e(route('admin.users.update-role', $user->id)); ?>" class="w-full">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="flex items-center gap-3">
                                                <select name="role" onchange="if(confirm('Change role for <?php echo e(addslashes($user->name)); ?>?')) { this.form.submit(); }"
                                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                    <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                                    <option value="applicant" <?php echo e($user->role == 'applicant' ? 'selected' : ''); ?>>Applicant</option>
                                                    <option value="scholar" <?php echo e($user->role == 'scholar' ? 'selected' : ''); ?>>Scholar</option>
                                                    <option value="review_team" <?php echo e($user->role == 'review_team' ? 'selected' : ''); ?>>Review Team</option>
                                                </select>
                                                <a href="<?php echo e(route('admin.users')); ?>#" class="text-sm text-gray-500">Manage</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="p-6 text-center">
                                    <p class="text-gray-500">No users found.</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Desktop / Tablet: table -->
                        <div class="hidden md:block">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">2FA</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                                                        <span class="text-purple-600 font-semibold"><?php echo e(strtoupper(substr($user->name, 0, 2))); ?></span>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900"><?php echo e($user->name); ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($user->email); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($user->role == 'admin' ? 'bg-purple-100 text-purple-800' : ($user->role == 'scholar' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800')); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $user->role ?? 'applicant'))); ?></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($user->created_at->format('M d, Y')); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <?php if($user->two_factor_enabled): ?>
                                                    <span class="text-green-600 font-semibold">✓ Enabled</span>
                                                <?php else: ?>
                                                    <span class="text-gray-400">Disabled</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <form method="POST" action="<?php echo e(route('admin.users.update-role', $user->id)); ?>" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <select name="role" onchange="if(confirm('Are you sure you want to change this user\'s role?')) { this.form.submit(); }" class="border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                                                        <option value="applicant" <?php echo e($user->role == 'applicant' ? 'selected' : ''); ?>>Applicant</option>
                                                        <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                                        <option value="scholar" <?php echo e($user->role == 'scholar' ? 'selected' : ''); ?>>Scholar</option>
                                                        <option value="review_team" <?php echo e($user->role == 'review_team' ? 'selected' : ''); ?>>Review Team</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No users found. Try adjusting your filters.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4 px-6 py-4 border-t border-gray-200">
                            <?php echo e($users->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\tech.olaarowolo.com\Dev\OAScholarshipLiveApp01092026\resources\views/admin/users.blade.php ENDPATH**/ ?>