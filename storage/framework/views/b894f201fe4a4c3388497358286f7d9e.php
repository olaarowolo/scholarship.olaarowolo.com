<?php $__env->startSection('content'); ?>
    <script src="https://cdn.tailwindcss.com"></script>

    <?php
        $user = Auth::user();
    ?>

    <?php echo $__env->make('components.navbar', ['user' => $user], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
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
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Book Mentorship Session</h1>
                    <p class="text-gray-600">Schedule a drop-in session with one of our mentors</p>
                </div>

                <form action="#" method="POST" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <!-- Mentorship Type -->
                    <div>
                        <label for="session_type" class="block text-sm font-semibold text-gray-700 mb-2">
                            Session Type <span class="text-red-500">*</span>
                        </label>
                        <select id="session_type" name="session_type" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="">Select session type</option>
                            <option value="academic">Academic Mentoring</option>
                            <option value="career">Career Guidance</option>
                            <option value="personal">Personal Development</option>
                            <option value="general">General Discussion</option>
                        </select>
                    </div>

                    <!-- Preferred Date/Time -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="preferred_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                Preferred Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="preferred_date" name="preferred_date" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                        </div>

                        <div>
                            <label for="preferred_time" class="block text-sm font-semibold text-gray-700 mb-2">
                                Preferred Time <span class="text-red-500">*</span>
                            </label>
                            <select id="preferred_time" name="preferred_time" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                                <option value="">Select time slot</option>
                                <option value="morning">Morning (9:00 AM - 12:00 PM)</option>
                                <option value="afternoon">Afternoon (12:00 PM - 4:00 PM)</option>
                                <option value="evening">Evening (4:00 PM - 7:00 PM)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Session Duration -->
                    <div>
                        <label for="duration" class="block text-sm font-semibold text-gray-700 mb-2">
                            Preferred Session Duration <span class="text-red-500">*</span>
                        </label>
                        <select id="duration" name="duration" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="30">30 minutes</option>
                            <option value="60">1 hour</option>
                            <option value="90">1.5 hours</option>
                        </select>
                    </div>

                    <!-- Meeting Format -->
                    <div>
                        <label for="format" class="block text-sm font-semibold text-gray-700 mb-2">
                            Meeting Format <span class="text-red-500">*</span>
                        </label>
                        <select id="format" name="format" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="virtual">Virtual (Video Call)</option>
                            <option value="phone">Phone Call</option>
                            <option value="in-person">In-Person (If Available)</option>
                        </select>
                    </div>

                    <!-- Topics to Discuss -->
                    <div>
                        <label for="topics" class="block text-sm font-semibold text-gray-700 mb-2">
                            Topics to Discuss <span class="text-red-500">*</span>
                        </label>
                        <textarea id="topics" name="topics" rows="5" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Please list the topics or questions you'd like to discuss during the mentorship session..."></textarea>
                    </div>

                    <!-- Specific Goals -->
                    <div>
                        <label for="goals" class="block text-sm font-semibold text-gray-700 mb-2">
                            Session Goals
                        </label>
                        <textarea id="goals" name="goals" rows="4"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="What do you hope to achieve from this mentorship session? (Optional)"></textarea>
                    </div>

                    <!-- Special Requirements -->
                    <div>
                        <label for="special_requirements" class="block text-sm font-semibold text-gray-700 mb-2">
                            Special Requirements or Accommodations
                        </label>
                        <textarea id="special_requirements" name="special_requirements" rows="3"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Any special requirements we should know about? (Optional)"></textarea>
                    </div>

                    <!-- Info Notice -->
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-purple-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-sm text-purple-800">
                                <p class="font-semibold mb-1">Booking Confirmation</p>
                                <p>You'll receive a confirmation email with meeting details once your booking is processed. Please check your email regularly.</p>
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
                            Book Session
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home1/httprapu/scholarship.olaarowolo.com/resources/views/scholar/mentorship.blade.php ENDPATH**/ ?>