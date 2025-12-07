<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Admin Dashboard') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Welcome back, {{ Auth::user()->name }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="px-4 py-2 bg-black text-white text-sm font-semibold rounded-full shadow-lg">
                    <svg class="w-4 h-4 inline-block mr-1.5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Admin
                </span>
                <div
                    class="w-10 h-10 rounded-full bg-gradient-to-br from-black to-gray-700 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </x-slot>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .pulse-icon {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .7;
            }
        }
    </style>

    <div class="py-8 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <!-- Total Applications -->
                <div class="stat-card bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 animate-fadeInUp"
                    style="animation-delay: 0.1s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-3 shadow-lg">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total</span>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-semibold text-gray-600">Applications</dt>
                            <dd class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $totalApplications }}
                            </dd>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.applications') }}"
                                class="text-blue-600 hover:text-blue-700 text-sm font-semibold flex items-center group">
                                View all
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pending Applications -->
                <div class="stat-card bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 animate-fadeInUp"
                    style="animation-delay: 0.2s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-xl p-3 shadow-lg pulse-icon">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Pending</span>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-semibold text-gray-600">Review Needed</dt>
                            <dd class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $pendingApplications }}
                            </dd>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.applications', ['status' => 'pending']) }}"
                                class="text-yellow-600 hover:text-yellow-700 text-sm font-semibold flex items-center group">
                                Review now
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Approved Applications -->
                <div class="stat-card bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 animate-fadeInUp"
                    style="animation-delay: 0.3s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-3 shadow-lg">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Approved</span>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-semibold text-gray-600">Successful</dt>
                            <dd class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $approvedApplications }}
                            </dd>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.applications', ['status' => 'approved']) }}"
                                class="text-green-600 hover:text-green-700 text-sm font-semibold flex items-center group">
                                View approved
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="stat-card bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 animate-fadeInUp"
                    style="animation-delay: 0.4s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-3 shadow-lg">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Users</span>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-semibold text-gray-600">Registered</dt>
                            <dd class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $totalUsers }}</dd>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.users') }}"
                                class="text-purple-600 hover:text-purple-700 text-sm font-semibold flex items-center group">
                                Manage users
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Visitors -->
                <div class="stat-card bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 animate-fadeInUp"
                    style="animation-delay: 0.5s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-3 shadow-lg">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Traffic</span>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-semibold text-gray-600">Total Visitors</dt>
                            <dd class="text-4xl font-extrabold text-gray-900 tracking-tight">
                                {{ \App\Models\Visitor::count() }}</dd>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.analytics') }}"
                                class="text-indigo-600 hover:text-indigo-700 text-sm font-semibold flex items-center group">
                                View analytics
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-2xl rounded-2xl mb-8 border border-gray-200 animate-fadeInUp"
                style="animation-delay: 0.6s">
                <div class="px-6 py-5 border-b border-gray-200 bg-white">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-gray-700 mr-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <h3 class="text-xl font-bold text-gray-900">Quick Actions</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('admin.applications') }}"
                            class="group flex items-center p-5 bg-white rounded-xl hover:bg-blue-50 transition-all duration-300 border-2 border-transparent hover:border-blue-200 shadow-md hover:shadow-lg">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="ml-4 text-sm font-bold text-gray-900">View Applications</span>
                        </a>

                        <a href="{{ route('admin.users') }}"
                            class="group flex items-center p-5 bg-white rounded-xl hover:bg-purple-50 transition-all duration-300 border-2 border-transparent hover:border-purple-200 shadow-md hover:shadow-lg">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <span class="ml-4 text-sm font-bold text-gray-900">Manage Users</span>
                        </a>

                        <a href="{{ route('admin.analytics') }}"
                            class="group flex items-center p-5 bg-white rounded-xl hover:bg-green-50 transition-all duration-300 border-2 border-transparent hover:border-green-200 shadow-md hover:shadow-lg">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <span class="ml-4 text-sm font-bold text-gray-900">View Analytics</span>
                        </a>

                        <a href="{{ route('admin.export') }}"
                            class="group flex items-center p-5 bg-white rounded-xl hover:bg-yellow-50 transition-all duration-300 border-2 border-transparent hover:border-yellow-200 shadow-md hover:shadow-lg">
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-lg p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="ml-4 text-sm font-bold text-gray-900">Export Data</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Applications & User Management -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Applications -->
                <div class="bg-white overflow-hidden shadow-2xl rounded-2xl border border-gray-200 animate-fadeInUp"
                    style="animation-delay: 0.7s">
                    <div
                        class="px-6 py-5 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-blue-50 to-white">
                        <div class="flex items-center">
                            <div class="bg-blue-100 rounded-lg p-2 mr-3">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Recent Applications</h3>
                        </div>
                        <a href="{{ route('admin.applications') }}"
                            class="text-sm text-blue-600 hover:text-blue-800 font-semibold flex items-center group">
                            View all
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse($recentApplications as $application)
                            <div class="p-5 hover:bg-gray-50 transition-all duration-200 cursor-pointer group">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center text-white font-bold text-sm shadow-lg group-hover:scale-110 transition-transform">
                                                {{ strtoupper(substr($application->first_name, 0, 1)) }}{{ strtoupper(substr($application->last_name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-gray-900 truncate">
                                                {{ $application->first_name }} {{ $application->last_name }}
                                            </p>
                                            <p class="text-sm text-gray-600 truncate">{{ $application->email }}</p>
                                            <p class="text-xs text-gray-400 mt-1 flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $application->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full shadow-sm
                                            {{ $application->status == 'pending' ? 'bg-yellow-100 text-yellow-800 ring-2 ring-yellow-200' : '' }}
                                            {{ $application->status == 'approved' ? 'bg-green-100 text-green-800 ring-2 ring-green-200' : '' }}
                                            {{ $application->status == 'rejected' ? 'bg-red-100 text-red-800 ring-2 ring-red-200' : '' }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center">
                                <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <p class="mt-4 text-gray-500 font-medium">No applications yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- User Management Summary -->
                <div class="bg-white overflow-hidden shadow-2xl rounded-2xl border border-gray-200 animate-fadeInUp"
                    style="animation-delay: 0.8s">
                    <div
                        class="px-6 py-5 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-purple-50 to-white">
                        <div class="flex items-center">
                            <div class="bg-purple-100 rounded-lg p-2 mr-3">
                                <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">User Management</h3>
                        </div>
                        <a href="{{ route('admin.users') }}"
                            class="text-sm text-purple-600 hover:text-purple-800 font-semibold flex items-center group">
                            Manage all
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div
                                class="flex items-center justify-between p-5 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-3 shadow-lg">
                                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-900">Admin Users</p>
                                        <p class="text-xs text-gray-600 mt-0.5">Full system access</p>
                                    </div>
                                </div>
                                <div class="text-3xl font-extrabold text-purple-600">
                                    {{ \App\Models\User::where('role', 'admin')->count() }}
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between p-5 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-3 shadow-lg">
                                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-900">Applicants</p>
                                        <p class="text-xs text-gray-600 mt-0.5">Registered applicants</p>
                                    </div>
                                </div>
                                <div class="text-3xl font-extrabold text-blue-600">
                                    {{ \App\Models\User::where('role', 'applicant')->count() }}
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between p-5 bg-gradient-to-r from-green-50 to-green-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-3 shadow-lg">
                                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-900">Scholars</p>
                                        <p class="text-xs text-gray-600 mt-0.5">Active scholars</p>
                                    </div>
                                </div>
                                <div class="text-3xl font-extrabold text-green-600">
                                    {{ \App\Models\User::where('role', 'scholar')->count() }}
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('admin.users') }}"
                                    class="w-full flex items-center justify-center px-5 py-4 border-2 border-purple-200 text-sm font-bold rounded-xl text-white bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Manage All Users
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visitor Tracking Summary -->
                <div class="bg-white overflow-hidden shadow-2xl rounded-2xl border border-gray-200 animate-fadeInUp"
                    style="animation-delay: 0.9s">
                    <div
                        class="px-6 py-5 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-indigo-50 to-white">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 rounded-lg p-2 mr-3">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Visitor Tracking</h3>
                        </div>
                        <a href="{{ route('admin.analytics') }}"
                            class="text-sm text-indigo-600 hover:text-indigo-800 font-semibold flex items-center group">
                            View analytics
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div
                                class="flex items-center justify-between p-5 bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-3 shadow-lg">
                                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-900">Visits Today</p>
                                        <p class="text-xs text-gray-600 mt-0.5">Unique visitors today</p>
                                    </div>
                                </div>
                                <div class="text-3xl font-extrabold text-indigo-600">
                                    {{ \App\Models\Visitor::whereDate('last_visit_at', today())->count() }}
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between p-5 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-3 shadow-lg">
                                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-900">Total Page Views</p>
                                        <p class="text-xs text-gray-600 mt-0.5">All time visits</p>
                                    </div>
                                </div>
                                <div class="text-3xl font-extrabold text-blue-600">
                                    {{ \App\Models\Visitor::sum('visit_count') }}
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between p-5 bg-gradient-to-r from-green-50 to-green-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-3 shadow-lg">
                                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-900">Top Country</p>
                                        <p class="text-xs text-gray-600 mt-0.5">Most visitors from</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @php
                                        $topCountry = \App\Models\Visitor::selectRaw('country, COUNT(*) as count')
                                            ->whereNotNull('country')
                                            ->groupBy('country')
                                            ->orderBy('count', 'desc')
                                            ->first();
                                    @endphp
                                    <div class="text-3xl font-extrabold text-green-600">
                                        {{ $topCountry ? $topCountry->count : 0 }}
                                    </div>
                                    <div class="text-xs text-gray-600 mt-1 font-semibold">
                                        {{ $topCountry ? $topCountry->country : 'N/A' }}
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between p-5 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-3 shadow-lg">
                                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-900">Top State</p>
                                        <p class="text-xs text-gray-600 mt-0.5">Most visitors from</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @php
                                        $topState = \App\Models\Visitor::selectRaw('state, COUNT(*) as count')
                                            ->whereNotNull('state')
                                            ->groupBy('state')
                                            ->orderBy('count', 'desc')
                                            ->first();
                                    @endphp
                                    <div class="text-3xl font-extrabold text-purple-600">
                                        {{ $topState ? $topState->count : 0 }}
                                    </div>
                                    <div class="text-xs text-gray-600 mt-1 font-semibold">
                                        {{ $topState ? $topState->state : 'N/A' }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('admin.analytics') }}"
                                    class="w-full flex items-center justify-center px-5 py-4 border-2 border-indigo-200 text-sm font-bold rounded-xl text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    View Detailed Analytics
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
