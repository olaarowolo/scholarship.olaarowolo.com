<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analytics Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('admin.dashboard') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Dashboard
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Applications by Status</h3>
                            <ul class="space-y-2">
                                <li class="flex justify-between items-center p-3 bg-yellow-50 rounded-lg">
                                    <span class="font-medium text-gray-900">Pending</span>
                                    <span class="text-2xl font-bold text-yellow-600">{{ $pendingApplications }}</span>
                                </li>
                                <li class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                    <span class="font-medium text-gray-900">Approved</span>
                                    <span class="text-2xl font-bold text-green-600">{{ $approvedApplications }}</span>
                                </li>
                                <li class="flex justify-between items-center p-3 bg-red-50 rounded-lg">
                                    <span class="font-medium text-gray-900">Rejected</span>
                                    <span class="text-2xl font-bold text-red-600">{{ $rejectedApplications }}</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Application Statistics</h3>
                            <div class="space-y-4">
                                <div class="p-4 bg-blue-50 rounded-lg">
                                    <div class="text-sm text-gray-500">Total Applications</div>
                                    <div class="text-3xl font-bold text-blue-600">{{ $totalApplications }}</div>
                                </div>
                                <div class="p-4 bg-purple-50 rounded-lg">
                                    <div class="text-sm text-gray-500">Top Course</div>
                                    <div class="text-lg font-semibold text-purple-600">
                                        {{ $topCourses->first()?->course ?? 'N/A' }}
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $topCourses->first()?->count ?? 0 }}
                                        applications</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Average JAMB Scores by Status -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Average JAMB Scores by Status</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach ($avgScoreByStatus as $stat)
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <div class="text-sm text-gray-500">{{ ucfirst($stat->status) }} Applications</div>
                                    <div class="text-2xl font-bold text-gray-700">
                                        {{ number_format($stat->avg_score, 1) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Top Courses -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Top 10 Courses</h3>
                        @if ($topCourses->count() > 0)
                            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Course</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Applications</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($topCourses as $course)
                                            <tr class="hover:bg-gray-50">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $course->course }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $course->count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-gray-50 p-8 text-center rounded-lg">
                                <p class="text-gray-500">No course data available.</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Applications by Month (Last 6 Months)</h3>
                        @if ($applicationsByMonth->count() > 0)
                            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Month</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Applications</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($applicationsByMonth as $month)
                                            <tr class="hover:bg-gray-50">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ \Carbon\Carbon::createFromFormat('Y-m', $month->month)->format('M Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $month->count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-gray-50 p-8 text-center rounded-lg">
                                <p class="text-gray-500">No application data available for the last 6 months.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Visitor Analytics Section -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4">Visitor Analytics</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Total Visitors -->
                            <div class="bg-indigo-50 p-6 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-500">Total Visitors</p>
                                        <p class="text-2xl font-bold text-indigo-600">
                                            {{ $visitorStats['total_visitors'] }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Visits Today -->
                            <div class="bg-blue-50 p-6 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-500">Visits Today</p>
                                        <p class="text-2xl font-bold text-blue-600">
                                            {{ $visitorStats['unique_visitors_today'] }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Page Views -->
                            <div class="bg-green-50 p-6 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-500">Total Page Views</p>
                                        <p class="text-2xl font-bold text-green-600">
                                            {{ $visitorStats['visits_today'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Top Countries -->
                        @if (count($visitorStats['top_countries']) > 0)
                            <div class="mt-6">
                                <h4 class="text-md font-semibold mb-3">Top Countries</h4>
                                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Country</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Visitors</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($visitorStats['top_countries'] as $country)
                                                <tr class="hover:bg-gray-50">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $country['country'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $country['count'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <!-- Top States -->
                        @if (count($visitorStats['top_states']) > 0)
                            <div class="mt-6">
                                <h4 class="text-md font-semibold mb-3">Top States</h4>
                                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    State</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Visitors</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($visitorStats['top_states'] as $state)
                                                <tr class="hover:bg-gray-50">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $state['state'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $state['count'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <!-- Top LGAs -->
                        @if (count($visitorStats['top_lgas']) > 0)
                            <div class="mt-6">
                                <h4 class="text-md font-semibold mb-3">Top LGAs</h4>
                                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    LGA</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    State</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Visitors</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($visitorStats['top_lgas'] as $lga)
                                                <tr class="hover:bg-gray-50">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $lga['lga'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $lga['state'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $lga['count'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <!-- Recent Visits -->
                        @if (count($visitorStats['recent_visits']) > 0)
                            <div class="mt-6">
                                <h4 class="text-md font-semibold mb-3">Recent Visits</h4>
                                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                    <div class="max-h-64 overflow-y-auto">
                                        @foreach ($visitorStats['recent_visits'] as $visit)
                                            <div class="px-6 py-4 border-b border-gray-200 hover:bg-gray-50">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">
                                                            {{ $visit['ip_address'] }}
                                                            @if ($visit['country'])
                                                                <span
                                                                    class="text-xs text-gray-500">({{ $visit['country'] }})</span>
                                                            @endif
                                                        </p>
                                                        <p class="text-xs text-gray-500">
                                                            {{ \Carbon\Carbon::parse($visit['last_visit_at'])->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="text-sm font-medium text-gray-900">
                                                            {{ $visit['visit_count'] }} visits</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
