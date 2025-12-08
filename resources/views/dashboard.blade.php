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
        use App\Models\Application;
        use App\Models\User;

        $user = Auth::user();
        $isAdmin = $user->role === 'admin';

        // Define status colors for badges
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

        if ($isAdmin) {
            $totalApplications = Application::count();
            $pendingApplications = Application::where('status', 'pending')->count();
            $approvedApplications = Application::where('status', 'approved')->count();
            $rejectedApplications = Application::where('status', 'rejected')->count();
            $recentApplications = Application::with('user')->latest()->take(5)->get();
            $totalUsers = User::count();
        } else {
            $myApplications = Application::where('user_id', $user->id)->latest()->get();
            $pendingCount = $myApplications->where('status', 'pending')->count();
            $approvedCount = $myApplications->where('status', 'approved')->count();
        }
    @endphp

    <!-- Navigation Bar -->
    @include('components.navbar', ['user' => $user])

    <!-- Dashboard Content -->
    <div class="min-h-screen pt-24 mt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div>
                    <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight">Dashboard</h1>
                    <p class="mt-2 text-lg text-gray-600">Welcome back, **{{ $user->name }}!</p>
                </div>
                <span
                    class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $isAdmin ? 'bg-black text-white' : 'bg-gray-200 text-gray-800' }}">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ $isAdmin ? 'Administrator' : 'Standard Applicant' }}
                </span>
            </div>

            @if ($isAdmin)
                <!-- Admin Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    <!-- Total Applications -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-black">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 font-medium">Total Applications</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalApplications }}</p>
                            </div>
                            <div class="bg-gray-100 rounded-full p-3">
                                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Review -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 font-medium">Pending Review</p>
                                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingApplications }}</p>
                            </div>
                            <div class="bg-yellow-100 rounded-full p-3">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Approved -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 font-medium">Approved</p>
                                <p class="text-3xl font-bold text-green-600 mt-2">{{ $approvedApplications }}</p>
                            </div>
                            <div class="bg-green-100 rounded-full p-3">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Users -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 font-medium">Total Users</p>
                                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalUsers }}</p>
                            </div>
                            <div class="bg-blue-100 rounded-full p-3">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Applications Table -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 mb-12">
                    <div class="flex justify-between items-center mb-6 border-b pb-4">
                        <h3 class="text-2xl font-semibold text-gray-900">Recent Applications</h3>
                        <a href="{{ route('admin.applications') }}"
                            class="text-sm text-black hover:underline font-medium flex items-center space-x-1">
                            <span>View All</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>

                    @if ($recentApplications->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Application ID</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Applicant</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Course</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Score</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status & Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($recentApplications as $application)
                                        <tr class="hover:bg-gray-50 transition duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                {{ $application->application_id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $application->first_name }} {{ $application->last_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ Str::limit($application->course, 30) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $application->jamb_score }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ $application->created_at->diffForHumans() }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center space-x-4">
                                                @php
                                                    $statusData =
                                                        $statusColors[$application->status] ?? $statusColors['pending'];
                                                @endphp
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusData['bg'] }} {{ $statusData['text'] }}">
                                                    {{ ucfirst($application->status) }}
                                                </span>
                                                <!-- Action dropdown/button mock -->
                                                <a href="{{ route('admin.applications.show', $application->id) }}"
                                                    class="text-black hover:text-blue-600 font-medium text-xs">Review</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <p class="mt-4 text-gray-600">No applications requiring review at this time.</p>
                        </div>
                    @endif
                </div>
            @else
                <!-- User Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <!-- My Applications -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-black">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 font-medium">My Applications</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $myApplications->count() }}</p>
                            </div>
                            <div class="bg-gray-100 rounded-full p-3">
                                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pending -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 font-medium">Pending</p>
                                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingCount }}</p>
                            </div>
                            <div class="bg-yellow-100 rounded-full p-3">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Approved -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 font-medium">Approved</p>
                                <p class="text-3xl font-bold text-green-600 mt-2">{{ $approvedCount }}</p>
                            </div>
                            <div class="bg-green-100 rounded-full p-3">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- My Applications List -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 mb-12">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 border-b pb-4">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4 sm:mb-0">My Applications History</h3>
                        <a href="{{ route('apply-form') }}"
                            class="bg-black text-white hover:bg-gray-800 px-5 py-2.5 rounded-full text-sm font-semibold transition duration-200 shadow-md flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            <span>New Application</span>
                        </a>
                    </div>

                    @if ($myApplications->count() > 0)
                        <div class="space-y-4">
                            @foreach ($myApplications as $application)
                                @php
                                    $statusData = $statusColors[$application->status] ?? $statusColors['pending'];
                                @endphp
                                <div
                                    class="border {{ $statusData['border'] }} border-opacity-30 bg-gray-50 rounded-lg p-5 hover:shadow-lg transition duration-200">
                                    <div class="flex justify-between items-start flex-col md:flex-row">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center space-x-3 mb-2">
                                                <h4 class="text-lg font-semibold text-gray-900 truncate">
                                                    {{ $application->course }} at {{ $application->institution }}</h4>
                                                <span
                                                    class="px-3 py-1 text-xs leading-5 font-bold rounded-full {{ $statusData['bg'] }} {{ $statusData['text'] }} shrink-0">
                                                    {{ ucfirst($application->status) }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600 mt-1">Application ID: <span
                                                    class="font-mono text-xs">{{ $application->application_id }}</span>
                                            </p>
                                            <p class="text-sm text-gray-500 mt-2">Submitted:
                                                {{ $application->created_at->format('M d, Y') }}
                                                ({{ $application->created_at->diffForHumans() }})
                                            </p>
                                        </div>
                                        <div class="flex flex-col space-y-2 mt-4 md:mt-0 md:ml-4">
                                            <a href="{{ route('admin.applications.show', $application->id) }}"
                                                class="text-sm text-black hover:text-blue-600 font-medium whitespace-nowrap">View
                                                Details →</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <h3 class="mt-4 text-xl font-medium text-gray-900">No applications yet</h3>
                            <p class="mt-2 text-gray-600">Get started by submitting your first scholarship application.</p>
                            <a href="{{ route('apply-form') }}"
                                class="mt-6 inline-block bg-black text-white hover:bg-gray-800 px-8 py-3 rounded-full font-semibold transition duration-200 shadow-xl">
                                Submit Application
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Quick Links / Utility Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Account Profile</h3>
                    <div class="space-y-2 mb-4">
                        <p class="text-base text-gray-800"><span class="font-semibold">Name:</span> {{ $user->name }}
                        </p>
                        <p class="text-base text-gray-800"><span class="font-semibold">Email:</span> {{ $user->email }}
                        </p>
                        <p class="text-base text-gray-800"><span class="font-semibold">User ID:</span> <span
                                class="font-mono text-xs">{{ $user->id }}</span></p>
                    </div>
                    <a href="{{ route('profile.edit') }}"
                        class="text-sm text-black hover:underline font-medium flex items-center space-x-1">
                        <span>Update Profile Settings</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Quick Links</h3>
                    <div class="space-y-3">
                        @if ($isAdmin)
                            <a href="{{ route('admin.dashboard') }}"
                                class="block text-base font-semibold text-black hover:text-gray-700 transition duration-200 bg-gray-50 -mx-2 px-2 py-2 rounded-lg">
                                <span class="inline-flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                    Admin Dashboard
                                </span>
                            </a>
                            <a href="{{ route('admin.form-settings') }}"
                                class="block text-base text-gray-600 hover:text-black transition duration-200">→ Form
                                Settings</a>
                            <a href="{{ route('admin.export') }}"
                                class="block text-base text-gray-600 hover:text-black transition duration-200">→ Export
                                Data & Reports</a>
                            <a href="#"
                                class="block text-base text-gray-600 hover:text-black transition duration-200">→ System
                                Configuration</a>
                            <a href="#"
                                class="block text-base text-gray-600 hover:text-black transition duration-200">→ View Audit
                                Logs</a>
                        @else
                            <a href="{{ route('how-it-works') }}"
                                class="block text-base text-gray-600 hover:text-black transition duration-200">→
                                Scholarship Guidelines</a>
                            <a href="{{ route('resources') }}"
                                class="block text-base text-gray-600 hover:text-black transition duration-200">→ Resources
                                & FAQ</a>
                            <a href="{{ route('contact') }}"
                                class="block text-base text-gray-600 hover:text-black transition duration-200">→ Contact
                                Support</a>
                        @endif
                    </div>
                </div>

                <!-- Security -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Security & Logout</h3>
                    <div class="space-y-3">
                        <a href="#" class="block text-base text-gray-600 hover:text-black transition duration-200">→
                            Change
                            Password</a>
                        <a href="#" class="block text-base text-gray-600 hover:text-black transition duration-200">→
                            Two-Factor
                            Authentication</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-base text-red-600 hover:text-red-800 transition duration-200">
                                → Secure Logout
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Message Tray -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 mt-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Message Tray</h3>
                    <div id="message-tray" class="space-y-3">
                        <!-- Messages will be dynamically loaded here -->
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            fetch('/messages/tray')
                                .then(response => response.json())
                                .then(messages => {
                                    const tray = document.getElementById('message-tray');
                                    tray.innerHTML = '';
                                    if (messages.length === 0) {
                                        tray.innerHTML = '<p class="text-gray-500">No messages yet.</p>';
                                    } else {
                                        messages.forEach(msg => {
                                            tray.innerHTML +=
                                                `<div class='p-3 bg-gray-50 rounded border mb-2'><span class='font-semibold'>${msg.content}</span><br><span class='text-xs text-gray-400'>${new Date(msg.created_at).toLocaleString()}</span></div>`;
                                        });
                                    }
                                });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
