<?php /** @var \\Illuminate\\View\\View $slot */ ?>

<div class="min-h-screen bg-gray-100">
    {{-- Admin menu (visible only to admin users) --}}
    @if(auth()->check() && auth()->user()->role === 'admin')
        @include('admin._menu')
        <style>
            /* when admin menu present, add top offset to main content to account for sticky menu height */
            main#app-content { padding-top: 3.5rem; } /* 56px = h-14 */
            @media (max-width: 640px) {
                main#app-content { padding-top: 4rem; }
            }
        </style>
    @endif

    <!-- Page Header Slot -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <main id="app-content" class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
</div>