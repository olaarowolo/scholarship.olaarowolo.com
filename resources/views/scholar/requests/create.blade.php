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

                <form action="{{ route('scholar.requests.store.create') }}" method="POST" class="space-y-6">
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
@endsection
