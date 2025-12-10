@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>

    @php
        $user = Auth::user();
    @endphp

    @include('components.navbar', ['user' => $user])

    <div class="min-h-screen bg-gray-50 flex items-center justify-center pt-48 pb-8 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-3xl mx-auto flex flex-col items-center justify-center">
            <!-- Back Button -->
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Dashboard
            </a>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Make a Request</h1>
                    <p class="text-gray-600">Submit a request for assistance, resources, or support</p>
                </div>

                <form action="{{ route('scholar.requests.store.create') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <!-- Request Type -->
                    <div>
                        <label for="request_type" class="block text-sm font-semibold text-gray-700 mb-2">
                            Request Type <span class="text-red-500">*</span>
                        </label>
                        <select id="request_type" name="request_type" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="">Select a request type</option>
                            <option value="financial">Financial Assistance</option>
                            <option value="academic">Academic Support</option>
                            <option value="materials">Learning Materials</option>
                            <option value="technology">Technology/Equipment</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                            Subject <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="subject" name="subject" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Brief description of your request">
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Detailed Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" name="description" rows="6" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Provide detailed information about your request..."></textarea>
                        <p class="mt-2 text-sm text-gray-500">Be as specific as possible to help us understand your needs
                        </p>
                    </div>

                    <!-- Priority -->
                    <div>
                        <label for="priority" class="block text-sm font-semibold text-gray-700 mb-2">
                            Priority Level
                        </label>
                        <select id="priority" name="priority"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <!-- Attachments -->
                    <div>
                        <label for="attachments" class="block text-sm font-semibold text-gray-700 mb-2">
                            Attachments
                        </label>
                        <div id="file-upload-area" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors cursor-pointer">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <div class="mt-4">
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium text-gray-900">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX, JPG, PNG up to 5MB each</p>
                            </div>
                        </div>
                        <input type="file" id="attachments" name="attachments[]" multiple
                            class="hidden"
                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">

                        <!-- Selected Files List -->
                        <div id="selected-files" class="mt-4 space-y-2"></div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 text-gray-700 hover:text-gray-900 font-medium">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-black text-white rounded-lg hover:bg-gray-800 font-semibold transition-colors duration-200">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('attachments');
            const uploadArea = document.getElementById('file-upload-area');
            const selectedFiles = document.getElementById('selected-files');
            const maxFileSize = 5 * 1024 * 1024; // 5MB
            const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/jpg', 'image/png'];

            // Handle click on upload area
            uploadArea.addEventListener('click', function() {
                fileInput.click();
            });

            // Handle drag and drop
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadArea.classList.add('border-blue-400', 'bg-blue-50');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
                const files = Array.from(e.dataTransfer.files);
                handleFiles(files);
            });

            // Handle file input change
            fileInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                handleFiles(files);
            });

            function handleFiles(files) {
                files.forEach(file => {
                    if (validateFile(file)) {
                        addFileToList(file);
                    }
                });
                updateFileInput();
            }

            function validateFile(file) {
                if (file.size > maxFileSize) {
                    alert(`File "${file.name}" is too large. Maximum size is 5MB.`);
                    return false;
                }
                if (!allowedTypes.includes(file.type)) {
                    alert(`File "${file.name}" has an invalid type. Only PDF, DOC, DOCX, JPG, PNG are allowed.`);
                    return false;
                }
                return true;
            }

            function addFileToList(file) {
                const fileId = Date.now() + Math.random();
                const fileElement = document.createElement('div');
                fileElement.className = 'flex items-center justify-between p-3 bg-gray-50 rounded-lg border';
                fileElement.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">${file.name}</p>
                            <p class="text-xs text-gray-500">${formatFileSize(file.size)}</p>
                        </div>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeFile('${fileId}')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                `;
                selectedFiles.appendChild(fileElement);

                // Store file reference
                fileElement._file = file;
                fileElement.id = fileId;
            }

            window.removeFile = function(fileId) {
                const fileElement = document.getElementById(fileId);
                if (fileElement) {
                    fileElement.remove();
                    updateFileInput();
                }
            };

            function updateFileInput() {
                const fileElements = selectedFiles.querySelectorAll('[id]');
                const dt = new DataTransfer();
                fileElements.forEach(element => {
                    if (element._file) {
                        dt.items.add(element._file);
                    }
                });
                fileInput.files = dt.files;
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
        });
    </script>
@endsection
