<footer id="contact" class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Contact Info -->
            <div class="flex items-start space-x-4 md:col-span-2">
                <img class="h-24 w-auto" src="{{ asset('assets/img/favicon/olaarowolo.com_logo_black.png') }}"
                    alt="OA Logo" style="filter: invert(1) grayscale(100%) brightness(200%);">
                <div class="text-left">
                    <p class="text-gray-400 text-sm">A commitment to educational equity for Iba indigenes.</p>
                    <div class="text-sm text-gray-400 space-y-1 pt-2">
                        <div class="flex items-center justify-start space-x-2">
                            <i class="fa-solid fa-envelope"></i>
                            <p>Email: <a href="mailto:scholarship@olaarowolo.com"
                                    class="hover:text-white">scholarship@olaarowolo.com</a></p>
                        </div>
                        <div class="flex items-center justify-start space-x-2">
                            <i class="fa-solid fa-location-dot"></i>
                            <p>Location: Iba Town, Ojo, Lagos, Nigeria</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quick Links -->
            <div class="text-left">
                <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                    Quick Links
                </h3>
                <ul role="list" class="mt-4 space-y-3">
                    <li><a href="{{ route('our-story') }}" class="text-base text-gray-300 hover:text-white">Our
                            Story</a></li>
                    <li><a href="{{ route('application-steps') }}"
                            class="text-base text-gray-300 hover:text-white">Application Steps</a></li>
                    <li><a href="{{ route('view-impact') }}" class="text-base text-gray-300 hover:text-white">View
                            Impact</a></li>
                    <li><a href="{{ route('how-it-works') }}" class="text-base text-gray-300 hover:text-white">How It
                            Works</a></li>
                </ul>
            </div>
            <!-- Portal & Legal -->
            <div class="text-left">
                <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                    Portal & Legal
                </h3>
                <ul role="list" class="mt-4 space-y-3">
                    <li><a href="{{ route('scholar-login') }}" class="text-base text-gray-300 hover:text-white">Scholar
                            Login</a></li>
                    <li><a href="https://olaarowolo.com" class="text-base text-gray-300 hover:text-white">Sponsor</a>
                    </li>
                    {{-- <li><a href="{{ route('sponsor-information') }}" class="text-base text-gray-300 hover:text-white">Sponsor Information</a></li> --}}
                    <li><a href="{{ route('terms') }}" class="text-base text-gray-300 hover:text-white">Terms &
                            Conditions</a></li>
                    <li><a href="{{ route('contact') }}" class="text-base text-gray-300 hover:text-white">Contact Us</a>
                    </li>
                    <li><a href="{{ route('resources') }}"
                            class="text-base text-gray-300 hover:text-white">Resources</a></li>
                </ul>
            </div>
        </div>
        <!-- Newsletter Subscription -->
        <div class="bg-transparent py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-2xl font-extrabold text-white sm:text-3xl">
                    Stay Updated with Our Newsletter
                </h2>
                <p class="mt-4 text-lg text-white">
                    Subscribe to receive the latest updates about the OA Scholarship, application deadlines, and more.
                </p>
                {{-- Newsletter form temporarily disabled --}}
                {{-- <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mt-6">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <input type="email" name="email" placeholder="Enter your email address" required class="w-full sm:w-auto px-4 py-3 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">
                        <button type="submit" class="btn-primary text-lg font-bold px-8 py-3 rounded-full shadow-lg">
                            Subscribe
                        </button>
                    </div>
                </form> --}}
                <div class="mt-6 text-center">
                    <p class="text-gray-300 italic">Newsletter subscription coming soon!</p>
                </div>
            </div>
        </div>
        <!-- Social Media and Copyright -->
        <div class="mt-12 border-t border-gray-700 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex space-x-6 mb-4 md:mb-0">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                <p class="text-base text-gray-400 text-center md:text-right">
                    &copy; 2024 OA Scholarship. All rights reserved.
                </p>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                <ul class="list-disc list-inside">
                    <a href="{{ route('resources') }}" class="hover:text-white">Resources</a>
                </ul>
            </div>
        </div>
    </div>
</footer>
