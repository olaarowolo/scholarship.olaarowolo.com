<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Two-Factor Authentication') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Security Settings</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Manage your two-factor authentication settings to keep your account secure.
                        </p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-purple-600 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <h4 class="text-lg font-medium text-gray-900">Two-Factor Authentication</h4>
                                </div>

                                <p class="mt-2 text-sm text-gray-600">
                                    @if (auth()->user()->two_factor_enabled)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Enabled
                                        </span>
                                        <span class="ml-2">Your account is protected with two-factor
                                            authentication.</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Disabled
                                        </span>
                                        <span class="ml-2">Add an extra layer of security to your account by enabling
                                            two-factor authentication.</span>
                                    @endif
                                </p>

                                <div class="mt-4 text-sm text-gray-600">
                                    <p class="font-medium mb-2">How it works:</p>
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>Each time you log in, we'll send a 6-digit code to your email</li>
                                        <li>Enter the code to complete your login</li>
                                        <li>The code expires after 10 minutes</li>
                                        <li>You can request a new code if needed</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="ml-4">
                                <form action="{{ route('two-factor.toggle') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white {{ auth()->user()->two_factor_enabled ? 'bg-red-600 hover:bg-red-700' : 'bg-purple-600 hover:bg-purple-700' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                                        @if (auth()->user()->two_factor_enabled)
                                            Disable 2FA
                                        @else
                                            Enable 2FA
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if (auth()->user()->two_factor_enabled)
                        <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        <strong>Important:</strong> Make sure you have access to your email
                                        <strong>{{ auth()->user()->email }}</strong>. You'll need to enter verification
                                        codes sent to this email address.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
