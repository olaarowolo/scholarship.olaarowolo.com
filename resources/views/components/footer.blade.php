<footer id="contact" class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Contact Info -->
            <div class="text-center md:text-left space-y-4">
                <img class="h-10 w-auto mb-4 mx-auto md:mx-0"
                     src="{{ asset('assets/img/favicon/olaarowolo.com_logo_black.png') }}"
                     alt="OA Logo" style="filter: invert(1) grayscale(100%) brightness(200%);">
                <p class="text-gray-400 text-sm">A commitment to educational equity for Iba indigenes.</p>
                <div class="text-sm text-gray-400 space-y-1 pt-2">
                    <div class="flex items-center justify-center md:justify-start space-x-2">
                         <i class="fa-solid fa-envelope"></i>
                         <p>Email: <a href="mailto:scholarship@olaarowolo.com" class="hover:text-white">scholarship@olaarowolo.com</a></p>
                    </div>
                    <div class="flex items-center justify-center md:justify-start space-x-2">
                         <i class="fa-solid fa-location-dot"></i>
                         <p>Location: Iba Town, Ojo, Lagos, Nigeria</p>
                    </div>
                </div>
            </div>
            <!-- Navigation Links -->
            <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-8 text-center md:text-left">
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                        Quick Links
                    </h3>
                    <ul role="list" class="mt-4 space-y-3">
                        <li><a href="{{ route('our-story') }}" class="text-base text-gray-300 hover:text-white">Our Story</a></li>
                        <li><a href="{{ route('application-steps') }}" class="text-base text-gray-300 hover:text-white">Application Steps</a></li>
                        <li><a href="{{ route('view-impact') }}" class="text-base text-gray-300 hover:text-white">View Impact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                        Portal & Legal
                    </h3>
                    <ul role="list" class="mt-4 space-y-3">
                        <li><a href="{{ route('scholar-login') }}" class="text-base text-gray-300 hover:text-white">Scholar Login</a></li>
                        <li><a href="{{ route('sponsor-information') }}" class="text-base text-gray-300 hover:text-white">Sponsor Information</a></li>
                        <li><a href="{{ route('terms') }}" class="text-base text-gray-300 hover:text-white">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mt-12 border-t border-gray-700 pt-8 text-center">
            <p class="text-base text-gray-400">
                &copy; 2024 OA Scholarship. All rights reserved.
            </p>
        </div>
    </div>
</footer>
