@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>

    @php
        $user = Auth::user();
    @endphp

    @include('components.navbar', ['user' => $user])

    <div class="min-h-screen bg-gray-50 flex items-center justify-center pt-48 pb-8 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-3xl mx-auto flex flex-col items-center justify-center">
            <!-- Back Button -->
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Dashboard
            </a>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Request Academic Advice</h1>
                    <p class="text-gray-600">Get guidance and assistance for your academic journey</p>
                </div>

                <form action="#" method="POST" class="space-y-6">
                    @csrf

                    <!-- Advice Category -->
                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                            Advice Category <span class="text-red-500">*</span>
                        </label>
                        <select id="category" name="category" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="">Select a category</option>
                            <option value="course-selection">Course Selection</option>
                            <option value="study-strategies">Study Strategies</option>
                            <option value="exam-preparation">Exam Preparation</option>
                            <option value="time-management">Time Management</option>
                            <option value="career-planning">Career Planning</option>
                            <option value="research">Research Opportunities</option>
                            <option value="internships">Internships/Work Experience</option>
                            <option value="graduate-school">Graduate School</option>
                            <option value="academic-writing">Academic Writing</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Current Academic Level -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="level" class="block text-sm font-semibold text-gray-700 mb-2">
                                Current Academic Level <span class="text-red-500">*</span>
                            </label>
                            <select id="level" name="level" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                                <option value="">Select level</option>
                                <option value="freshman">Freshman/Year 1</option>
                                <option value="sophomore">Sophomore/Year 2</option>
                                <option value="junior">Junior/Year 3</option>
                                <option value="senior">Senior/Year 4</option>
                                <option value="graduate">Graduate Student</option>
                            </select>
                        </div>

                        <div>
                            <label for="major" class="block text-sm font-semibold text-gray-700 mb-2">
                                Major/Field of Study <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="major" name="major" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                                placeholder="e.g., Computer Science">
                        </div>
                    </div>

                    <!-- Question/Issue -->
                    <div>
                        <label for="question" class="block text-sm font-semibold text-gray-700 mb-2">
                            Your Question or Issue <span class="text-red-500">*</span>
                        </label>
                        <textarea id="question" name="question" rows="6" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Please describe your question or the academic advice you need in detail..."></textarea>
                    </div>

                    <!-- Context/Background -->
                    <div>
                        <label for="context" class="block text-sm font-semibold text-gray-700 mb-2">
                            Additional Context
                        </label>
                        <textarea id="context" name="context" rows="4"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Provide any relevant background information that might help us give you better advice..."></textarea>
                    </div>

                    <!-- What You've Tried -->
                    <div>
                        <label for="attempted_solutions" class="block text-sm font-semibold text-gray-700 mb-2">
                            What have you already tried?
                        </label>
                        <textarea id="attempted_solutions" name="attempted_solutions" rows="4"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                            placeholder="Let us know what approaches or solutions you've already attempted..."></textarea>
                    </div>

                    <!-- Urgency -->
                    <div>
                        <label for="urgency" class="block text-sm font-semibold text-gray-700 mb-2">
                            Urgency <span class="text-red-500">*</span>
                        </label>
                        <select id="urgency" name="urgency" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="low">Low - General inquiry</option>
                            <option value="medium">Medium - Needed within a week</option>
                            <option value="high">High - Needed within 2-3 days</option>
                            <option value="urgent">Urgent - Immediate attention needed</option>
                        </select>
                    </div>

                    <!-- Preferred Response Method -->
                    <div>
                        <label for="response_method" class="block text-sm font-semibold text-gray-700 mb-2">
                            Preferred Response Method <span class="text-red-500">*</span>
                        </label>
                        <select id="response_method" name="response_method" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="email">Email Response</option>
                            <option value="video-call">Video Call</option>
                            <option value="phone">Phone Call</option>
                            <option value="in-person">In-Person Meeting</option>
                        </select>
                    </div>

                    <!-- Help Notice -->
                    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-indigo-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            <div class="text-sm text-indigo-800">
                                <p class="font-semibold mb-1">Expert Guidance Available</p>
                                <p>Our academic advisors and mentors are here to help you succeed. You'll receive a response
                                    based on your urgency level.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('dashboard') }}"
                            class="px-6 py-3 text-gray-700 hover:text-gray-900 font-medium">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-black text-white rounded-lg hover:bg-gray-800 font-semibold transition-colors duration-200">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
