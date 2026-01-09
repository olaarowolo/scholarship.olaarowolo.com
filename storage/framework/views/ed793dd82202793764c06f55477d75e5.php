<?php $__env->startSection('content'); ?>
    <script src="https://cdn.tailwindcss.com"></script>

    <?php
        $user = Auth::user();
    ?>

    <?php echo $__env->make('components.navbar', ['user' => $user], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="min-h-screen bg-gray-50 flex items-center justify-center pt-48 pb-8 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-3xl mx-auto flex flex-col items-center justify-center">
            <!-- Back Button -->
            <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Dashboard
            </a>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Document Your Challenges</h1>
                    <p class="text-gray-600">Share challenges you're facing so we can provide appropriate support</p>
                </div>

                <form action="#" method="POST" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <!-- Challenge Category -->
                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                            Challenge Category <span class="text-red-500">*</span>
                        </label>
                        <select id="category" name="category" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="">Select a category</option>
                            <option value="academic">Academic Difficulties</option>
                            <option value="financial">Financial Hardship</option>
                            <option value="personal">Personal/Family Issues</option>
                            <option value="health">Health Concerns</option>
                            <option value="accommodation">Accommodation/Housing</option>
                            <option value="technology">Technology/Internet Access</option>
                            <option value="transportation">Transportation</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Challenge Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Challenge Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Brief summary of the challenge">
                    </div>

                    <!-- Detailed Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Detailed Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" name="description" rows="6" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Provide detailed information about the challenge you're facing..."></textarea>
                        <p class="mt-2 text-sm text-gray-500">Be as specific as possible to help us understand your
                            situation</p>
                    </div>

                    <!-- Impact on Studies -->
                    <div>
                        <label for="impact" class="block text-sm font-semibold text-gray-700 mb-2">
                            How is this affecting your studies? <span class="text-red-500">*</span>
                        </label>
                        <textarea id="impact" name="impact" rows="4" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Describe how this challenge is impacting your academic performance and well-being..."></textarea>
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration" class="block text-sm font-semibold text-gray-700 mb-2">
                            How long have you been facing this challenge? <span class="text-red-500">*</span>
                        </label>
                        <select id="duration" name="duration" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="">Select duration</option>
                            <option value="recent">Just started (less than a week)</option>
                            <option value="short">Recent (1-4 weeks)</option>
                            <option value="medium">Ongoing (1-3 months)</option>
                            <option value="long">Long-term (3+ months)</option>
                        </select>
                    </div>

                    <!-- Support Needed -->
                    <div>
                        <label for="support_needed" class="block text-sm font-semibold text-gray-700 mb-2">
                            What type of support would help? <span class="text-red-500">*</span>
                        </label>
                        <textarea id="support_needed" name="support_needed" rows="4" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Describe what kind of support or assistance would help you address this challenge..."></textarea>
                    </div>

                    <!-- Urgency Level -->
                    <div>
                        <label for="urgency" class="block text-sm font-semibold text-gray-700 mb-2">
                            Urgency Level <span class="text-red-500">*</span>
                        </label>
                        <select id="urgency" name="urgency" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="low">Low - Can wait for regular review</option>
                            <option value="medium">Medium - Should be addressed soon</option>
                            <option value="high">High - Needs prompt attention</option>
                            <option value="critical">Critical - Requires immediate intervention</option>
                        </select>
                    </div>

                    <!-- Privacy Notice -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-sm text-blue-800">
                                <p class="font-semibold mb-1">Your Privacy Matters</p>
                                <p>Your information will be kept confidential and only shared with relevant support staff to
                                    help address your challenges.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="<?php echo e(route('dashboard')); ?>" class="px-6 py-3 text-gray-700 hover:text-gray-900 font-medium">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-black text-white rounded-lg hover:bg-gray-800 font-semibold transition-colors duration-200">
                            Submit Challenge Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home1/httprapu/scholarship.olaarowolo.com/resources/views/scholar/challenges.blade.php ENDPATH**/ ?>