<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-600 to-blue-600 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-xl">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Two-Factor Authentication
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Enter the 6-digit code sent to your email
                </p>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('two-factor.verify.post') }}" method="POST">
                @csrf

                <div>
                    <label for="code" class="sr-only">Verification Code</label>
                    <input id="code" name="code" type="text" inputmode="numeric" pattern="[0-9]{6}"
                        maxlength="6" required
                        class="appearance-none rounded-lg relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 text-center text-2xl tracking-widest focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-3xl @error('code') border-red-500 @enderror"
                        placeholder="000000" autofocus>
                    @error('code')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                        Verify Code
                    </button>
                </div>
            </form>

            <div class="text-center">
                <form action="{{ route('two-factor.resend') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-purple-600 hover:text-purple-500 underline">
                        Resend Code
                    </button>
                </form>
            </div>

            <div class="mt-4 text-center text-xs text-gray-500">
                <p>Code expires in 10 minutes</p>
                <p class="mt-2">Didn't receive the code? Check your spam folder</p>
            </div>
        </div>
    </div>
</x-guest-layout>
