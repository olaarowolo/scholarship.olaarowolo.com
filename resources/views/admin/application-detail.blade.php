@extends('layouts.app')

@section('content')
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

    @php
        $statusColors = [
            'pending' => [
                'bg' => 'bg-yellow-100',
                'text' => 'text-yellow-800',
                'border' => 'border-yellow-300',
            ],
            'approved' => [
                'bg' => 'bg-green-100',
                'text' => 'text-green-800',
                'border' => 'border-green-300',
            ],
            'rejected' => [
                'bg' => 'bg-red-100',
                'text' => 'text-red-800',
                'border' => 'border-red-300',
            ],
        ];

        $statusData = $statusColors[$application->status] ?? $statusColors['pending'];
    @endphp

    <!-- Application Detail Content -->
    <div class="min-h-screen pt-12 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <div>
                        <a href="{{ route('admin.applications') }}"
                            class="mb-3 inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                            Back to Applications
                        </a>
                        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mt-2">Application Details</h1>
                        <p class="mt-2 text-lg text-gray-600">Application ID: <span
                                class="font-mono text-sm">{{ $application->application_id }}</span></p>
                    </div>
                    <span
                        class="mt-4 sm:mt-0 px-4 py-2 rounded-full text-sm font-bold {{ $statusData['bg'] }} {{ $statusData['text'] }}">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
            </div>

            <!-- Status Update Form -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Update Application Status</h3>
                <form action="{{ route('admin.applications.update-status', $application->id) }}" method="POST"
                    class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" id="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black">
                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes
                                (Optional)</label>
                            <input type="text" name="notes" id="notes" value="{{ $application->notes ?? '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black"
                                placeholder="Add notes...">
                        </div>
                    </div>

                    <button type="submit"
                        class="bg-black text-white hover:bg-gray-800 px-6 py-2.5 rounded-lg font-semibold transition duration-200 shadow-md">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Application Information -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Personal Information -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6 pb-4 border-b">Personal Information</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">First Name</label>
                            <p class="text-base text-gray-900 font-semibold">{{ $application->first_name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Last Name</label>
                            <p class="text-base text-gray-900 font-semibold">{{ $application->last_name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Middle Name</label>
                            <p class="text-base text-gray-900">{{ $application->middle_name ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                            <p class="text-base text-gray-900">{{ $application->email }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                            <p class="text-base text-gray-900">{{ $application->phone }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Date of Birth</label>
                            <p class="text-base text-gray-900">
                                {{ \Carbon\Carbon::parse($application->date_of_birth)->format('M d, Y') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Gender</label>
                            <p class="text-base text-gray-900">{{ ucfirst($application->gender) }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">State of Origin</label>
                            <p class="text-base text-gray-900">{{ $application->state_of_origin }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">LGA of Origin</label>
                            <p class="text-base text-gray-900">{{ $application->lga_of_origin }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Ondo State Indigene</label>
                            <p class="text-base text-gray-900">
                                @if ($application->is_ondo_indigene)
                                    <span class="text-green-600 font-semibold">Yes</span>
                                @else
                                    <span class="text-red-600 font-semibold">No</span>
                                @endif
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500 mb-1">Home Address</label>
                            <p class="text-base text-gray-900">{{ $application->home_address }}</p>
                        </div>
                    </div>
                </div>

                <!-- Summary Card -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Timeline -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Timeline</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Submitted</label>
                                <p class="text-sm text-gray-900">{{ $application->created_at->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                                <p class="text-sm text-gray-900">{{ $application->updated_at->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $application->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- User Information -->
                    @if ($application->user)
                        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">User Account</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                                    <p class="text-sm text-gray-900">{{ $application->user->name }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                                    <p class="text-sm text-gray-900">{{ $application->user->email }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">User ID</label>
                                    <p class="text-sm text-gray-900 font-mono">{{ $application->user->id }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Academic Information -->
            <div class="mt-6 bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6 pb-4 border-b">Academic Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Institution</label>
                        <p class="text-base text-gray-900 font-semibold">{{ $application->institution }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Course of Study</label>
                        <p class="text-base text-gray-900">{{ $application->course }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Level of Study</label>
                        <p class="text-base text-gray-900">{{ ucfirst($application->level) }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">JAMB Registration Number</label>
                        <p class="text-base text-gray-900 font-mono text-sm">{{ $application->jamb_reg_number }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">JAMB Score</label>
                        <p class="text-base text-gray-900 font-bold text-lg">{{ $application->jamb_score }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">JAMB Year</label>
                        <p class="text-base text-gray-900">{{ $application->jamb_year }}</p>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="mt-6 bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6 pb-4 border-b">Uploaded Documents</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if ($application->jamb_result_path)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">JAMB Result</p>
                                        <p class="text-xs text-gray-500">PDF Document</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($application->jamb_result_path) }}" target="_blank"
                                    class="text-sm text-black hover:text-blue-600 font-medium">
                                    View →
                                </a>
                            </div>
                        </div>
                    @endif

                    @if ($application->waec_result_path)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">WAEC/NECO Result</p>
                                        <p class="text-xs text-gray-500">PDF Document</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($application->waec_result_path) }}" target="_blank"
                                    class="text-sm text-black hover:text-blue-600 font-medium">
                                    View →
                                </a>
                            </div>
                        </div>
                    @endif

                    @if ($application->indigene_certificate_path)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Indigene Certificate</p>
                                        <p class="text-xs text-gray-500">PDF Document</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($application->indigene_certificate_path) }}" target="_blank"
                                    class="text-sm text-black hover:text-blue-600 font-medium">
                                    View →
                                </a>
                            </div>
                        </div>
                    @endif

                    @if ($application->admission_letter_path)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Admission Letter</p>
                                        <p class="text-xs text-gray-500">PDF Document</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($application->admission_letter_path) }}" target="_blank"
                                    class="text-sm text-black hover:text-blue-600 font-medium">
                                    View →
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Admin Notes -->
            @if ($application->notes)
                <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Admin Notes</h3>
                    <p class="text-base text-gray-700">{{ $application->notes }}</p>
                </div>
            @endif

            <!-- Actions -->
            <div class="mt-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <a href="{{ route('admin.applications') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-semibold transition duration-200 shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Applications
                </a>

                <form action="{{ route('admin.applications.delete', $application->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this application? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 text-white hover:bg-red-700 px-6 py-2.5 rounded-lg font-semibold transition duration-200 shadow-md">
                        Delete Application
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
