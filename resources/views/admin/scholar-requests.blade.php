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

    <!-- Scholar Requests Management -->
    <div class="min-h-screen pt-6 md:pt-12 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            @include('admin._header', [
                'title' => 'Scholar Requests',
                'subtitle' => 'View and manage scholar requests',
                'actions' => '<a href="'.route('admin.dashboard').'" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-full text-sm font-semibold transition duration-200">← Back to Dashboard</a>'
            ])

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Filters -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 mb-6">
                <form method="GET" action="{{ route('admin.scholar-requests') }}" class="flex items-end space-x-4">
                    <!-- Status Filter -->
                    <div class="flex-1">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved
                            </option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected
                            </option>
                        </select>
                    </div>

                    <!-- Actions -->
                    <div class="flex space-x-2">
                        <button type="submit"
                            class="bg-black text-white hover:bg-gray-800 px-6 py-2 rounded-lg font-semibold transition duration-200">
                            Apply Filter
                        </button>
                        <a href="{{ route('admin.scholar-requests') }}"
                            class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-6 py-2 rounded-lg font-semibold transition duration-200">
                            Clear
                        </a>
                    </div>
                </form>
            </div>

            <!-- Requests Table -->
            <div class="bg-white rounded-lg shadow-md border border-gray-200">
                @if ($requests->count() > 0)

                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'under_review' => 'bg-indigo-100 text-indigo-800',
                            'in_progress' => 'bg-yellow-100 text-yellow-800',
                            'resolved' => 'bg-green-100 text-green-800',
                            'closed' => 'bg-gray-100 text-gray-800',
                            'rejected' => 'bg-red-100 text-red-800',
                        ];
                    @endphp

                    <!-- Mobile: stacked card list -->
                    <div class="md:hidden space-y-4 p-4">
                        @foreach ($requests as $request)
                            <div class="bg-white border rounded-lg p-4 shadow-sm">
                                <div class="flex items-start justify-between">
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 truncate">#{{ $request->id }} — {{ $request->user->name ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ ucfirst(str_replace('_', ' ', $request->request_type ?? '')) }} • {{ $request->created_at->format('M d, Y') }}</p>
                                        <p class="text-sm text-gray-700 mt-2 truncate">{{ \Illuminate\Support\Str::limit($request->subject ?? $request->description ?? 'No subject', 90) }}</p>
                                    </div>
                                    <div class="ml-3 flex-shrink-0 text-right space-y-2">
                                        @php $statusClass = $statusColors[$request->status] ?? 'bg-gray-100 text-gray-800'; @endphp
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $request->status)) }}</span>
                                        <a href="{{ route('admin.scholar-requests.show', $request->id) }}" class="text-sm font-semibold text-black block">View →</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Desktop / Tablet: table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Request ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Scholar</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Request Type</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date Submitted</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($requests as $request)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            #{{ $request->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $request->user->name ?? 'N/A' }}</div>
                                            <div class="text-sm text-gray-500">{{ $request->user->email ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ ucfirst(str_replace('_', ' ', $request->type ?? 'general')) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $request->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'approved' => 'bg-green-100 text-green-800',
                                                    'rejected' => 'bg-red-100 text-red-800',
                                                ];
                                                $statusClass =
                                                    $statusColors[$request->status] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.scholar-requests.show', $request->id) }}"
                                                class="text-black hover:text-gray-700 font-semibold transition duration-200">
                                                View Details →
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $requests->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No scholar requests found</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            @if (request('status') && request('status') != 'all')
                                Try adjusting your filters or clearing them to see all requests.
                            @else
                                Scholar requests will appear here once scholars submit them.
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
