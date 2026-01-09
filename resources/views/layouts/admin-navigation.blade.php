<nav x-data="{ open: false }" @click.away="open = false" @keydown.escape.window="open = false" class="bg-gradient-to-r from-gray-900 to-gray-800 shadow-lg sticky top-0 z-50">
    <style>[x-cloak]{display:none !important;}</style>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Section: Logo & Primary Nav -->
            <div class="flex">
                <!-- Logo & Brand -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="relative">
                            <div
                                class="absolute inset-0 bg-yellow-400 rounded-lg blur opacity-50 group-hover:opacity-75 transition-opacity">
                            </div>
                            <svg class="relative w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-xl text-white">Admin Portal</span>
                            <div class="text-xs text-gray-400 -mt-0.5">OA Foundation</div>
                        </div>
                    </a>
                </div>

                <!-- Primary Navigation Links -->
                <div class="hidden md:flex md:items-center md:space-x-4 md:ml-6 lg:ml-10 overflow-x-auto">
                    <div class="flex flex-wrap md:flex-row lg:flex-col gap-2 md:items-center">
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                            class="flex items-center gap-2 text-gray-200 hover:text-yellow-400 hover:bg-gray-700 px-3 py-2 rounded-md transition">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="font-medium">Dashboard</span>
                        </x-nav-link>

                        <div class="hidden lg:block border-t border-gray-700 my-2"></div>
                        <div class="hidden lg:block text-xs font-semibold text-gray-400 px-2 mb-1">Management</div>

                        <x-nav-link :href="route('admin.applications')" :active="request()->routeIs('admin.applications*')"
                            class="flex items-center gap-2 text-gray-200 hover:text-yellow-400 hover:bg-gray-700 px-3 py-2 rounded-md transition">
                            <i class="fas fa-file-alt"></i>
                            <span class="font-medium">Applications</span>
                        </x-nav-link>

                        <x-nav-link :href="route('admin.scholar-requests')" :active="request()->routeIs('admin.scholar-requests*')"
                            class="flex items-center gap-2 text-gray-200 hover:text-yellow-400 hover:bg-gray-700 px-3 py-2 rounded-md transition">
                            <i class="fas fa-user-graduate"></i>
                            <span class="font-medium">Scholars</span>
                        </x-nav-link>

                        <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users*')"
                            class="flex items-center gap-2 text-gray-200 hover:text-yellow-400 hover:bg-gray-700 px-3 py-2 rounded-md transition">
                            <i class="fas fa-users"></i>
                            <span class="font-medium">Users</span>
                        </x-nav-link>

                        <div class="hidden lg:block border-t border-gray-700 my-2"></div>
                        <div class="hidden lg:block text-xs font-semibold text-gray-400 px-2 mb-1">Analytics &amp; Tools</div>

                        <x-nav-link :href="route('admin.analytics')" :active="request()->routeIs('admin.analytics')"
                            class="flex items-center gap-2 text-gray-200 hover:text-yellow-400 hover:bg-gray-700 px-3 py-2 rounded-md transition">
                            <i class="fas fa-chart-line"></i>
                            <span class="font-medium">Analytics</span>
                        </x-nav-link>

                        <x-nav-link :href="route('admin.export')" :active="request()->routeIs('admin.export*')"
                            class="flex items-center gap-2 text-gray-200 hover:text-yellow-400 hover:bg-gray-700 px-3 py-2 rounded-md transition">
                            <i class="fas fa-download"></i>
                            <span class="font-medium">Export</span>
                        </x-nav-link>
                    </div>
                </div>
            </div>

            <!-- Right Section: Settings & User Menu -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                <!-- Settings Quick Access -->
                <a href="{{ route('admin.form-settings') }}"
                    class="flex items-center gap-2 text-gray-200 hover:text-white hover:bg-gray-700 px-3 py-2 rounded-md transition {{ request()->routeIs('admin.form-settings*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span class="ml-3 font-medium hidden xl:inline">Settings</span>
                </a>

                <!-- Admin Badge & User Dropdown -->
                <div class="flex items-center space-x-10 pl-10 border-l border-gray-600">
                    <span
                        class="px-3 py-1 bg-yellow-400 text-gray-900 text-xs font-bold rounded-full shadow-lg uppercase tracking-wider">
                        <i class="fas fa-shield-alt mr-1"></i>Admin
                    </span>

                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 transition">
                                <div
                                    class="w-8 h-8 rounded-full bg-gradient-to-br from-red-600 to-red-800 flex items-center justify-center text-white font-bold text-sm">
                                    <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                </div>
                                <div class="text-left hidden xl:block">
                                    <div class="text-sm font-semibold text-white">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-400">Administrator</div>
                                </div>
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            {{-- User Info Header --}}
                            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                                <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-600">{{ Auth::user()->email }}</div>
                            </div>

                            {{-- Account Settings --}}
                            <div class="py-1">
                                <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                                    <i class="fas fa-user-circle w-5 text-gray-400"></i>
                                    <span class="ml-3">My Profile</span>
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('two-factor.settings')" class="flex items-center">
                                    <i class="fas fa-shield-alt w-5 text-gray-400"></i>
                                    <span class="ml-3">Security (2FA)</span>
                                </x-dropdown-link>
                            </div>

                            <div class="border-t border-gray-100"></div>

                            {{-- Quick Actions --}}
                            <div class="py-1">
                                <x-dropdown-link :href="route('home')" class="flex items-center" target="_blank">
                                    <i class="fas fa-external-link-alt w-5 text-gray-400"></i>
                                    <span class="ml-3">View Public Site</span>
                                </x-dropdown-link>
                            </div>

                            <div class="border-t border-gray-100"></div>

                            {{-- Logout --}}
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="flex items-center text-red-600 hover:bg-red-50">
                                        <i class="fas fa-sign-out-alt w-5"></i>
                                        <span class="ml-3 font-medium">Log Out</span>
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center lg:hidden">
                <button @click="open = ! open" :aria-expanded="open" aria-controls="mobile-menu"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400 transition"
                    aria-label="Toggle mobile menu">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <!-- Only show dashboard and applications for mobile nav, rest in sidebar -->
    <div x-show="open" x-cloak x-transition id="mobile-menu" aria-label="Mobile admin menu" class="lg:hidden border-t border-gray-200">
        <div class="px-4 py-4 bg-white">
            <div class="flex items-center space-x-3">
                <div
                    class="w-10 h-10 rounded-full bg-yellow-400 flex items-center justify-center text-gray-900 font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <span class="px-2 py-1 bg-yellow-400 text-gray-900 text-xs font-bold rounded uppercase">
                    <i class="fas fa-shield-alt"></i>
                </span>
            </div>
        </div>
        <div class="px-3 pt-3 pb-4 space-y-1 bg-white">
            <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Main Menu</div>
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" @click="open = false"
                class="block px-4 py-3 rounded-md text-base font-medium text-gray-700 hover:text-yellow-500 hover:bg-gray-50">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span class="ml-3">Dashboard</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.applications')" :active="request()->routeIs('admin.applications*')" @click="open = false"
                class="block px-4 py-3 rounded-md text-base font-medium text-gray-700 hover:text-yellow-500 hover:bg-gray-50">
                <i class="fas fa-file-alt w-5"></i>
                <span class="ml-3">Applications</span>
            </x-responsive-nav-link>

            <div class="border-t border-gray-100 my-2"></div>
            <x-responsive-nav-link :href="route('two-factor.settings')" @click="open = false" class="block px-4 py-3 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">
                <i class="fas fa-shield-alt w-5"></i>
                <span class="ml-3">Security (2FA)</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('home')" target="_blank" @click="open = false" class="block px-4 py-3 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">
                <i class="fas fa-external-link-alt w-5"></i>
                <span class="ml-3">View Public Site</span>
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" @click="open = false" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-3 rounded-md text-base font-medium text-red-600 hover:bg-red-50">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="ml-3 font-medium">Log Out</span>
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
