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
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Academic Standing Report</h1>
                    <p class="text-gray-600">Submit your current grades and academic progress</p>
                </div>

                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <!-- Academic Term -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="term" class="block text-sm font-semibold text-gray-700 mb-2">
                                Academic Term/Semester <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="term" name="term" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                                placeholder="e.g., Fall 2025">
                        </div>

                        <div>
                            <label for="year" class="block text-sm font-semibold text-gray-700 mb-2">
                                Academic Year <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="year" name="year" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                                placeholder="e.g., 2025-2026">
                        </div>
                    </div>

                    <!-- Current GPA/CGPA -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="gpa" class="block text-sm font-semibold text-gray-700 mb-2">
                                Current GPA/CGPA <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="gpa" name="gpa" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                                placeholder="e.g., 3.75">
                        </div>

                        <div>
                            <label for="scale" class="block text-sm font-semibold text-gray-700 mb-2">
                                GPA Scale <span class="text-red-500">*</span>
                            </label>
                            <select id="scale" name="scale" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                                <option value="4.0">4.0 Scale</option>
                                <option value="5.0">5.0 Scale</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>
                    </div>

                    <!-- Course Load -->
                    <div>
                        <label for="course_load" class="block text-sm font-semibold text-gray-700 mb-2">
                            Current Course Load <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="course_load" name="course_load" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Number of courses/credit hours">
                    </div>

                    <!-- Academic Performance Summary -->
                    <div>
                        <label for="performance_summary" class="block text-sm font-semibold text-gray-700 mb-2">
                            Academic Performance Summary <span class="text-red-500">*</span>
                        </label>
                        <textarea id="performance_summary" name="performance_summary" rows="6" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Describe your academic performance, achievements, courses you're excelling in, and any areas where you need support..."></textarea>
                    </div>

                    <!-- Achievements/Awards -->
                    <div>
                        <label for="achievements" class="block text-sm font-semibold text-gray-700 mb-2">
                            Recent Achievements or Awards
                        </label>
                        <textarea id="achievements" name="achievements" rows="4"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="List any academic achievements, awards, or recognitions received..."></textarea>
                    </div>

                    <!-- Academic Goals -->
                    <div>
                        <label for="goals" class="block text-sm font-semibold text-gray-700 mb-2">
                            Academic Goals for Next Term
                        </label>
                        <textarea id="goals" name="goals" rows="4"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Share your academic goals and what you hope to achieve..."></textarea>
                    </div>

                    <!-- File Attachments -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Supporting Documents <span class="text-red-500">*</span>
                        </label>
                        <p class="text-sm text-gray-600 mb-4">
                            Upload academic documents such as transcripts, grade reports, certificates, or any other
                            relevant documents.
                            <span class="font-semibold">At least one file is required.</span>
                        </p>

                        <!-- File Upload Area -->
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                            <input type="file" id="documents" name="documents[]" multiple required
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="hidden" onchange="handleFileSelect(event)">

                            <label for="documents" class="cursor-pointer">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="mt-4">
                                    <span class="text-sm font-medium text-gray-700">
                                        Click to upload files
                                    </span>
                                    <span class="text-sm text-gray-500"> or drag and drop</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">
                                    PDF, DOC, DOCX, JPG, PNG up to 10MB each
                                </p>
                            </label>
                        </div>

                        <!-- Selected Files Display -->
                        <div id="fileList" class="mt-4 space-y-2"></div>
                    </div>

                    <!-- Info Notice -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-sm text-blue-800">
                                <p class="font-semibold mb-1">Document Requirements</p>
                                <p>Please upload official or unofficial transcripts, grade reports, or screenshots showing
                                    your current academic standing. Multiple files can be uploaded.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="<?php echo e(route('dashboard')); ?>"
                            class="px-6 py-3 text-gray-700 hover:text-gray-900 font-medium">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-black text-white rounded-lg hover:bg-gray-800 font-semibold transition-colors duration-200">
                            Submit Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function handleFileSelect(event) {
            const files = event.target.files;
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = ''; // Clear previous list

            if (files.length === 0) {
                return;
            }

            // Display selected files
            Array.from(files).forEach((file, index) => {
                const fileSize = (file.size / 1024 / 1024).toFixed(2); // Convert to MB
                const fileItem = document.createElement('div');
                fileItem.className =
                    'flex items-center justify-between p-3 bg-gray-50 border border-gray-200 rounded-lg';

                fileItem.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">${file.name}</p>
                            <p class="text-xs text-gray-500">${fileSize} MB</p>
                        </div>
                    </div>
                    <button type="button" onclick="removeFile(${index})" class="text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;

                fileList.appendChild(fileItem);
            });

            // Update file count indicator
            const fileInput = document.getElementById('documents');
            if (files.length > 0) {
                fileInput.classList.remove('border-red-300');
            }
        }

        function removeFile(index) {
            const fileInput = document.getElementById('documents');
            const dt = new DataTransfer();
            const files = fileInput.files;

            for (let i = 0; i < files.length; i++) {
                if (i !== index) {
                    dt.items.add(files[i]);
                }
            }

            fileInput.files = dt.files;

            // Trigger change event to update display
            const event = new Event('change', {
                bubbles: true
            });
            fileInput.dispatchEvent(event);
        }

        // Drag and drop functionality
        const dropArea = document.querySelector('label[for="documents"]').parentElement;

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => {
                dropArea.classList.add('border-black', 'bg-gray-50');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => {
                dropArea.classList.remove('border-black', 'bg-gray-50');
            }, false);
        });

        dropArea.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            document.getElementById('documents').files = files;
            handleFileSelect({
                target: {
                    files: files
                }
            });
        }, false);
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home1/httprapu/scholarship.olaarowolo.com/resources/views/scholar/academic-standing.blade.php ENDPATH**/ ?>