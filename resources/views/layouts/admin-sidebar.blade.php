<aside x-data="{ open: true }"
    class="bg-white w-64 min-h-screen fixed top-0 left-0 z-40 border-r border-gray-200 hidden lg:block">
    <div class="flex flex-col h-full">
        <div class="flex items-center px-6 py-5 border-b border-gray-200">
            <span class="font-bold text-xl text-yellow-500">Admin</span>
            <span class="ml-2 text-xs text-gray-500">OA Foundation</span>
        </div>
        <nav class="flex-1 px-4 py-6 grid grid-cols-1 gap-4">
            <a href="{{ route('admin.scholar-requests') }}"
                class="block bg-gray-50 border border-gray-200 rounded-xl shadow hover:shadow-md hover:border-yellow-500 transition p-5">
                <div class="flex items-center">
                    <div class="bg-yellow-100 text-yellow-600 rounded-full p-2 mr-3">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div>
                        <div class="font-bold text-lg">Scholars</div>
                        <div class="text-xs text-gray-500">Manage scholar requests</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.users') }}"
                class="block bg-gray-50 border border-gray-200 rounded-xl shadow hover:shadow-md hover:border-yellow-500 transition p-5">
                <div class="flex items-center">
                    <div class="bg-yellow-100 text-yellow-600 rounded-full p-2 mr-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div class="font-bold text-lg">Users</div>
                        <div class="text-xs text-gray-500">View and manage users</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.analytics') }}"
                class="block bg-gray-50 border border-gray-200 rounded-xl shadow hover:shadow-md hover:border-yellow-500 transition p-5">
                <div class="flex items-center">
                    <div class="bg-yellow-100 text-yellow-600 rounded-full p-2 mr-3">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <div class="font-bold text-lg">Analytics</div>
                        <div class="text-xs text-gray-500">View analytics & reports</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.export') }}"
                class="block bg-gray-50 border border-gray-200 rounded-xl shadow hover:shadow-md hover:border-yellow-500 transition p-5">
                <div class="flex items-center">
                    <div class="bg-yellow-100 text-yellow-600 rounded-full p-2 mr-3">
                        <i class="fas fa-download"></i>
                    </div>
                    <div>
                        <div class="font-bold text-lg">Export</div>
                        <div class="text-xs text-gray-500">Export data & reports</div>
                    </div>
                </div>
            </a>
        </nav>
    </div>
    <!-- Mobile Toggle Button -->
    <button @click="open = !open"
        class="lg:hidden fixed top-4 left-4 z-50 bg-yellow-400 text-gray-900 p-2 rounded-md shadow-md">
        <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</aside>
<!-- Mobile Sidebar -->
<aside x-show="open"
    class="bg-gray-900 text-gray-100 w-64 min-h-screen fixed top-0 left-0 z-40 border-r border-gray-800 lg:hidden"
    style="display: none;">
    <div class="flex flex-col h-full">
        <div class="flex items-center px-6 py-5 border-b border-gray-800">
            <span class="font-bold text-xl text-yellow-400">Admin</span>
            <span class="ml-2 text-xs text-gray-400">OA Foundation</span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.scholar-requests') }}"
                class="flex items-center px-3 py-2 rounded-md hover:bg-gray-800 transition">
                <i class="fas fa-user-graduate mr-2"></i>
                <span>Scholars</span>
            </a>
            <a href="{{ route('admin.users') }}"
                class="flex items-center px-3 py-2 rounded-md hover:bg-gray-800 transition">
                <i class="fas fa-users mr-2"></i>
                <span>Users</span>
            </a>
            <div class="mt-4 mb-2 text-xs font-semibold text-gray-400">Analytics & Tools</div>
            <a href="{{ route('admin.analytics') }}"
                class="flex items-center px-3 py-2 rounded-md hover:bg-gray-800 transition">
                <i class="fas fa-chart-line mr-2"></i>
                <span>Analytics</span>
            </a>
            <a href="{{ route('admin.export') }}"
                class="flex items-center px-3 py-2 rounded-md hover:bg-gray-800 transition">
                <i class="fas fa-download mr-2"></i>
                <span>Export</span>
            </a>
        </nav>
    </div>
</aside>
