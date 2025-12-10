@extends('layouts.app')

@section('content')
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f8f8;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#000000',
                        'secondary': '#333333',
                        'accent': '#e5e7eb',
                    },
                }
            }
        }
    </script>

    <!-- Scholar Request Detail -->
    <div class="min-h-screen pt-12 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900">Scholar Request #{{ $request->id }}</h1>
                        <p class="mt-2 text-gray-600">Submitted on {{ $request->created_at->format('F d, Y \a\t g:i A') }}
                        </p>
                    </div>
                    <a href="{{ route('admin.scholar-requests') }}"
                        class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-full text-sm font-semibold transition duration-200">
                        ← Back to Requests
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Scholar Information -->
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Scholar Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                                <p class="text-lg font-semibold text-gray-900">{{ $request->user->name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                                <p class="text-lg font-semibold text-gray-900">{{ $request->user->email ?? 'N/A' }}</p>
                            </div>
                            @if ($request->user && $request->user->phone)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                                    <p class="text-lg font-semibold text-gray-900">{{ $request->user->phone }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Request Details -->
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Request Details</h2>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Request Type</label>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ ucfirst(str_replace('_', ' ', $request->request_type ?? 'General Request')) }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Subject</label>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $request->subject ?? 'No subject provided' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Message</label>
                                <div class="mt-2 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-900 whitespace-pre-wrap">
                                        {{ $request->description ?? 'No message provided' }}</p>
                                </div>
                            </div>

                            @if ($request->attachments && count($request->attachments) > 0)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Attachments</label>
                                    <div class="mt-2 space-y-2">
                                        @foreach ($request->attachments as $attachment)
                                            <a href="{{ Storage::url($attachment) }}" target="_blank"
                                                class="flex items-center space-x-2 text-blue-600 hover:text-blue-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                </svg>
                                                <span>{{ basename($attachment) }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status Card -->
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Request Status</h3>

                        @php
                            $statusColors = [
                                'pending' => [
                                    'bg' => 'bg-yellow-100',
                                    'text' => 'text-yellow-800',
                                    'border' => 'border-yellow-200',
                                ],
                                'approved' => [
                                    'bg' => 'bg-green-100',
                                    'text' => 'text-green-800',
                                    'border' => 'border-green-200',
                                ],
                                'rejected' => [
                                    'bg' => 'bg-red-100',
                                    'text' => 'text-red-800',
                                    'border' => 'border-red-200',
                                ],
                            ];
                            $statusStyle = $statusColors[$request->status] ?? [
                                'bg' => 'bg-gray-100',
                                'text' => 'text-gray-800',
                                'border' => 'border-gray-200',
                            ];
                        @endphp

                        <div class="mb-4">
                            <span
                                class="px-4 py-2 inline-flex text-sm font-bold rounded-full {{ $statusStyle['bg'] }} {{ $statusStyle['text'] }} {{ $statusStyle['border'] }} border">
                                {{ ucfirst($request->status) }}
                            </span>
                        </div>

                        <!-- Update Status Form -->
                        <form action="{{ route('admin.scholar-requests.update-status', $request->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Update
                                    Status</label>
                                <select name="status" id="status" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                                    <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="approved" {{ $request->status == 'approved' ? 'selected' : '' }}>
                                        Approved</option>
                                    <option value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }}>
                                        Rejected</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes
                                    (Optional)</label>
                                <textarea name="admin_notes" id="admin_notes" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"
                                    placeholder="Add notes about this decision...">{{ $request->admin_notes }}</textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-black text-white hover:bg-gray-800 px-6 py-3 rounded-lg font-semibold transition duration-200">
                                Update Status
                            </button>
                        </form>
                    </div>

                    <!-- Timeline Card -->
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Timeline</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-2 h-2 mt-2 rounded-full bg-blue-500"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Request Submitted</p>
                                    <p class="text-xs text-gray-500">{{ $request->created_at->format('M d, Y g:i A') }}</p>
                                </div>
                            </div>
                            @if ($request->updated_at != $request->created_at)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 mt-2 rounded-full bg-green-500"></div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Last Updated</p>
                                        <p class="text-xs text-gray-500">{{ $request->updated_at->format('M d, Y g:i A') }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($request->admin_notes)
                        <!-- Admin Notes Card -->
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Admin Notes</h3>
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $request->admin_notes }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
