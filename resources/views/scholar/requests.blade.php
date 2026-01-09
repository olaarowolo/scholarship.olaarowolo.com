@extends('layouts.app')

@section('title', 'My Requests - Scholar Dashboard')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">My Requests</h1>
                        <p class="mt-2 text-sm text-gray-600">View and track all your scholar requests</p>
                    </div>
                    <a href="{{ route('scholar.make-request') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New Request
                    </a>
                </div>
            </div>

            <!-- Filters -->
            <div class="mb-6 bg-white rounded-lg shadow-sm p-4">
                <div class="flex flex-wrap gap-4">
                    <select
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="under_review">Under Review</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <input type="text" placeholder="Search requests..."
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent flex-1">
                </div>
            </div>

            <!-- Requests List -->
            @if ($requests->count() > 0)
                <div class="space-y-4">
                    @foreach ($requests as $request)
                        <div
                            class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden border-l-4
                        {{ $request->status === 'pending'
                            ? 'border-yellow-500'
                            : ($request->status === 'approved'
                                ? 'border-green-500'
                                : ($request->status === 'rejected'
                                    ? 'border-red-500'
                                    : 'border-blue-500')) }}">
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <h3 class="text-xl font-semibold text-gray-900">{{ $request->request_type }}
                                            </h3>
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $request->status === 'pending'
                                                ? 'bg-yellow-100 text-yellow-800'
                                                : ($request->status === 'approved'
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($request->status === 'rejected'
                                                        ? 'bg-red-100 text-red-800'
                                                        : 'bg-blue-100 text-blue-800')) }}">
                                                {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                                            </span>
                                        </div>

                                        <p class="text-gray-700 mb-3">{{ Str::limit($request->details, 150) }}</p>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                            <div class="flex items-center text-gray-600">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>Submitted: {{ $request->created_at->format('M d, Y') }}</span>
                                            </div>

                                            @if ($request->urgency)
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2 {{ $request->urgency === 'high' ? 'text-red-600' : ($request->urgency === 'medium' ? 'text-yellow-600' : 'text-green-600') }}"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                                                    </svg>
                                                    <span
                                                        class="font-medium {{ $request->urgency === 'high' ? 'text-red-600' : ($request->urgency === 'medium' ? 'text-yellow-600' : 'text-green-600') }}">
                                                        {{ ucfirst($request->urgency) }} Priority
                                                    </span>
                                                </div>
                                            @endif

                                            @if ($request->amount)
                                                <div class="flex items-center text-gray-600">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>Amount: ₦{{ number_format($request->amount, 2) }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        @if ($request->admin_response)
                                            <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                                <p class="text-sm font-semibold text-blue-900 mb-1">Admin Response:</p>
                                                <p class="text-sm text-blue-800">{{ $request->admin_response }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="ml-4 flex flex-col gap-2">
                                        <a href="{{ route('scholar.requests.show', $request->id) }}"
                                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition duration-300 text-center">
                                            View Details
                                        </a>
                                        @if ($request->status === 'pending')
                                            <button
                                                onclick="if(confirm('Are you sure you want to cancel this request?')) { document.getElementById('cancel-form-{{ $request->id }}').submit(); }"
                                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition duration-300">
                                                Cancel
                                            </button>
                                            <form id="cancel-form-{{ $request->id }}"
                                                action="{{ route('scholar.requests.cancel', $request->id) }}"
                                                method="POST" class="hidden">
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $requests->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Requests Yet</h3>
                    <p class="text-gray-600 mb-6">You haven't submitted any requests. Start by creating your first request.
                    </p>
                    <a href="{{ route('scholar.make-request') }}"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Create Your First Request
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
