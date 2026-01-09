<?php $__env->startSection('content'); ?>
    <!-- Load Tailwind CSS configuration -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#000000',
                        'accent-yellow': '#facc15',
                        'accent-green': '#10b981',
                        'accent-blue': '#3b82f6',
                    },
                }
            }
        }
    </script>

    <!-- Inline Styles for Inter Font -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f8f8;
        }
    </style>

    <?php
        use App\Models\Application;
        $statusOptions = Application::STATUSES;
        $statusColors = Application::statusColors();
    ?>

    <?php
        // Use centralized status color classes
        $badgeClass = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800';
    ?>

    <!-- Application Detail Content -->
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <div>
                        <a href="<?php echo e(route('admin.applications')); ?>"
                            class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition duration-200 mb-4">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Applications
                        </a>
                        <h1 class="text-3xl font-bold text-gray-900">Application Details</h1>
                        <p class="mt-1 text-lg text-gray-600">Application ID: <span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded"><?php echo e($application->application_id); ?></span></p>
                    </div>
                    <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                        <span class="px-4 py-2 rounded-full text-sm font-semibold <?php echo e($badgeClass); ?>">
                            <?php echo e(ucfirst($application->status)); ?>

                        </span>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Submitted</p>
                            <p class="text-sm font-medium text-gray-900"><?php echo e($application->created_at->format('M d, Y H:i')); ?></p>
                            <p class="text-sm text-gray-500">Last Updated</p>
                            <p class="text-sm font-medium text-gray-900"><?php echo e($application->updated_at->format('M d, Y H:i')); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <?php if(session('success')): ?>
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <form action="<?php echo e(route('admin.applications.update-status', $application->id)); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black">
                                <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($s); ?>" <?php echo e($application->status === $s ? 'selected' : ''); ?>><?php echo e(ucfirst(str_replace('_', ' ', $s))); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes (Optional)</label>
                            <textarea name="admin_notes" id="admin_notes" rows="3" placeholder="Add admin notes..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black"><?php echo e(old('admin_notes', $application->admin_notes)); ?></textarea>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="submit" class="bg-black text-white hover:bg-gray-800 px-6 py-2 rounded-lg font-semibold transition duration-200">Update Application</button>
                        <a href="<?php echo e(route('admin.applications')); ?>" class="text-sm text-gray-600 hover:underline">Back to Applications</a>
                    </div>
                </form>
            </div>

            <!-- Personal Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">First Name</label>
                        <p class="text-base text-gray-900 font-semibold"><?php echo e($application->first_name); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Last Name</label>
                        <p class="text-base text-gray-900 font-semibold"><?php echo e($application->last_name); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Middle Name</label>
                        <p class="text-base text-gray-900"><?php echo e($application->middle_name ?? 'Data not available'); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                        <p class="text-base text-gray-900"><?php echo e($application->email); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                        <p class="text-base text-gray-900"><?php echo e($application->phone); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Date of Birth</label>
                        <p class="text-base text-gray-900"><?php echo e(\Carbon\Carbon::parse($application->date_of_birth)->format('M d, Y')); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Gender</label>
                        <p class="text-base text-gray-900"><?php echo e($application->gender ? ucfirst($application->gender) : 'Data not available'); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">State of Origin</label>
                        <p class="text-base text-gray-900"><?php echo e($application->state_of_origin ?? 'Data not available'); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">LGA of Origin</label>
                        <p class="text-base text-gray-900"><?php echo e($application->lga_of_origin ?? 'Data not available'); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">IBA Indigene</label>
                        <p class="text-base text-gray-900">
                            <?php if($application->is_iba_indigene): ?>
                                <span class="text-green-600 font-semibold">Yes</span>
                            <?php else: ?>
                                <span class="text-red-600 font-semibold">No</span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="md:col-span-2 lg:col-span-3">
                        <label class="block text-sm font-medium text-gray-500 mb-1">Home Address</label>
                        <p class="text-base text-gray-900"><?php echo e($application->home_address ?? 'Data not available'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Academic Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Academic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Institution</label>
                        <p class="text-base text-gray-900 font-semibold"><?php echo e($application->institution); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Course of Study</label>
                        <p class="text-base text-gray-900"><?php echo e($application->course); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Level of Study</label>
                        <p class="text-base text-gray-900"><?php echo e($application->level ? ucfirst($application->level) : 'Data not available'); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">JAMB Registration Number</label>
                        <p class="text-base text-gray-900 font-mono text-sm"><?php echo e($application->jamb_reg_number ?? 'Data not available'); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">JAMB Score</label>
                        <p class="text-base text-gray-900 font-bold text-lg"><?php echo e($application->jamb_score ?? 'Data not available'); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">JAMB Year</label>
                        <p class="text-base text-gray-900"><?php echo e($application->jamb_year ?? 'Data not available'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Uploaded Documents</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php if($application->jamb_result_path): ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">JAMB Result</p>
                                        <p class="text-xs text-gray-500">PDF Document</p>
                                    </div>
                                </div>
                                <a href="<?php echo e(Storage::url($application->jamb_result_path)); ?>" target="_blank" class="text-sm text-black hover:text-blue-600 font-medium">View →</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($application->waec_result_path): ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">WAEC/NECO Result</p>
                                        <p class="text-xs text-gray-500">PDF Document</p>
                                    </div>
                                </div>
                                <a href="<?php echo e(Storage::url($application->waec_result_path)); ?>" target="_blank" class="text-sm text-black hover:text-blue-600 font-medium">View →</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($application->indigene_certificate_path): ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Indigene Certificate</p>
                                        <p class="text-xs text-gray-500">PDF Document</p>
                                    </div>
                                </div>
                                <a href="<?php echo e(Storage::url($application->indigene_certificate_path)); ?>" target="_blank" class="text-sm text-black hover:text-blue-600 font-medium">View →</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($application->admission_letter_path): ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Admission Letter</p>
                                        <p class="text-xs text-gray-500">PDF Document</p>
                                    </div>
                                </div>
                                <a href="<?php echo e(Storage::url($application->admission_letter_path)); ?>" target="_blank" class="text-sm text-black hover:text-blue-600 font-medium">View →</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Notes Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Application Notes -->
                <?php if($application->notes): ?>
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Application Notes</h3>
                        <?php
                            $notes = json_decode($application->notes, true);
                        ?>
                        <?php if($notes): ?>
                            <ul class="text-base text-gray-700 space-y-1">
                                <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><strong><?php echo e(ucfirst(str_replace('_', ' ', $key))); ?>:</strong> <?php echo e($value); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-base text-gray-700"><?php echo e($application->notes); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Admin Notes -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Admin Notes</h3>
                    <?php if($application->adminNotes->count()): ?>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $application->adminNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-start space-x-3">
                                    <form method="POST" action="<?php echo e(route('admin.applications.notes.toggle', $note->id)); ?>" class="inline-flex items-center">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="focus:outline-none">
                                            <input type="checkbox" <?php echo e($note->is_checked ? 'checked' : ''); ?> class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded pointer-events-none" readonly>
                                        </button>
                                    </form>
                                    <div class="flex-1">
                                        <p class="text-base text-gray-700 <?php echo e($note->is_checked ? 'line-through text-gray-500' : ''); ?>"><?php echo e($note->note); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo e($note->created_at->format('M d, Y H:i')); ?></p>
                                    </div>
                                    <form method="POST" action="<?php echo e(route('admin.applications.notes.delete', $note->id)); ?>" class="inline" onsubmit="return confirm('Delete this note?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                                    </form>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-base text-gray-500">No admin notes yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- User Information -->
            <?php if($application->user): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">User Account Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                            <p class="text-sm text-gray-900"><?php echo e($application->user->name); ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                            <p class="text-sm text-gray-900"><?php echo e($application->user->email); ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">User ID</label>
                            <p class="text-sm text-gray-900 font-mono"><?php echo e($application->user->id); ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Role</label>
                            <p class="text-sm text-gray-900"><?php echo e(ucfirst($application->user->role)); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <a href="<?php echo e(route('admin.applications')); ?>" class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-semibold transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Back to Applications
                    </a>
                    <form action="<?php echo e(route('admin.applications.delete', $application->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this application? This action cannot be undone.');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="bg-red-600 text-white hover:bg-red-700 px-6 py-3 rounded-lg font-semibold transition duration-200">
                            Delete Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\tech.olaarowolo.com\Dev\OAScholarshipLiveApp01092026\resources\views/admin/application-detail.blade.php ENDPATH**/ ?>