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
        $statusOptions = Application::STATUSES;
        $statusColors = Application::statusColors();
    @endphp

    @php
        // Use centralized status color classes
        $badgeClass = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800';
    @endphp

    @section('admin_breadcrumb')
        <nav class="text-sm" aria-label="Breadcrumb">
            <ol class="list-reset flex items-center space-x-2 text-gray-500">
                <li>
                    <a href="{{ route('admin.applications') }}" class="hover:text-gray-700">Applications</a>
                </li>
                <li><span class="text-gray-400">/</span></li>
                <li class="text-gray-700">{{ $application->application_id }}</li>
            </ol>
        </nav>
    @endsection

    <!-- Application Detail Content -->
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @include('admin._header', [
                'title' => 'Application Details',
                'subtitle' => 'Application ID: ' . ($application->application_id ?? 'N/A'),
                'actions' => '<a href="'.route('admin.applications').'" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-full text-sm font-semibold transition duration-200">← Back to Applications</a>'
            ])

            <div class="mb-6 flex items-center justify-end space-x-4">
                <span class="inline-flex items-center px-3 py-1.5 text-sm font-semibold rounded-full {{ $badgeClass }}">
                    {{ ucfirst(str_replace('_',' ', $application->status)) }}
                </span>
                <div class="text-right text-sm text-gray-500">
                    <div>Submitted: <span class="font-medium text-gray-900">{{ $application->created_at->format('M d, Y H:i') }}</span></div>
                    <div>Last Updated: <span class="font-medium text-gray-900">{{ $application->updated_at->format('M d, Y H:i') }}</span></div>
                </div>
            </div>

            <!-- Quick Actions -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <form action="{{ route('admin.applications.update-status', $application->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black">
                                @foreach($statusOptions as $s)
                                    <option value="{{ $s }}" {{ $application->status === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes (Optional)</label>
                            <textarea name="admin_notes" id="admin_notes" rows="3" placeholder="Add admin notes..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black">{{ old('admin_notes', $application->admin_notes) }}</textarea>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="submit" class="bg-black text-white hover:bg-gray-800 px-6 py-2 rounded-lg font-semibold transition duration-200">Update Application</button>
                        <a href="{{ route('admin.applications') }}" class="text-sm text-gray-600 hover:underline">Back to Applications</a>
                    </div>
                </form>
            </div>

            <!-- Personal Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">First Name</label>
                        <p class="text-base text-gray-900 font-semibold">{{ $application->first_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Last Name</label>
                        <p class="text-base text-gray-900 font-semibold">{{ $application->last_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Middle Name</label>
                        <p class="text-base text-gray-900">{{ $application->middle_name ?? 'Data not available' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                        <p class="text-base text-gray-900">{{ $application->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                        <p class="text-base text-gray-900">{{ $application->phone }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Date of Birth</label>
                        <p class="text-base text-gray-900">{{ \Carbon\Carbon::parse($application->date_of_birth)->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Gender</label>
                        <p class="text-base text-gray-900">{{ $application->gender ? ucfirst($application->gender) : 'Data not available' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">State of Origin</label>
                        <p class="text-base text-gray-900">{{ $application->state_of_origin ?? 'Data not available' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">LGA of Origin</label>
                        <p class="text-base text-gray-900">{{ $application->lga_of_origin ?? 'Data not available' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">IBA Indigene</label>
                        <p class="text-base text-gray-900">
                            @if ($application->is_iba_indigene)
                                <span class="text-green-600 font-semibold">Yes</span>
                            @else
                                <span class="text-red-600 font-semibold">No</span>
                            @endif
                        </p>
                    </div>
                    <div class="md:col-span-2 lg:col-span-3">
                        <label class="block text-sm font-medium text-gray-500 mb-1">Home Address</label>
                        <p class="text-base text-gray-900">{{ $application->home_address ?? 'Data not available' }}</p>
                    </div>
                </div>
            </div>

            <!-- Academic Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Academic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Institution</label>
                        <p class="text-base text-gray-900 font-semibold">{{ $application->institution }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Course of Study</label>
                        <p class="text-base text-gray-900">{{ $application->course }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Level of Study</label>
                        <p class="text-base text-gray-900">{{ $application->level ? ucfirst($application->level) : 'Data not available' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">JAMB Registration Number</label>
                        <p class="text-base text-gray-900 font-mono text-sm">{{ $application->jamb_reg_number ?? 'Data not available' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">JAMB Score</label>
                        <p class="text-base text-gray-900 font-bold text-lg">{{ $application->jamb_score ?? 'Data not available' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">JAMB Year</label>
                        <p class="text-base text-gray-900">{{ $application->jamb_year ?? 'Data not available' }}</p>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Uploaded Documents</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if ($application->jamb_result_path)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">JAMB Result</p>
                                        <p class="text-xs text-gray-500">PDF Document</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($application->jamb_result_path) }}" target="_blank" class="text-sm text-black hover:text-blue-600 font-medium">View →</a>
                            </div>
                        </div>
                    @endif
                    @if ($application->waec_result_path)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">WAEC/NECO Result</p>
                                        <p class="text-xs text-gray-500">PDF Document</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($application->waec_result_path) }}" target="_blank" class="text-sm text-black hover:text-blue-600 font-medium">View →</a>
                            </div>
                        </div>
                    @endif
                    @if ($application->indigene_certificate_path)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Indigene Certificate</p>
                                        <p class="text-xs text-gray-500">PDF Document</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($application->indigene_certificate_path) }}" target="_blank" class="text-sm text-black hover:text-blue-600 font-medium">View →</a>
                            </div>
                        </div>
                    @endif
                    @if ($application->admission_letter_path)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Admission Letter</p>
                                        <p class="text-xs text-gray-500">PDF Document</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($application->admission_letter_path) }}" target="_blank" class="text-sm text-black hover:text-blue-600 font-medium">View →</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Notes Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Application Notes -->
                @if ($application->notes)
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Application Notes</h3>
                        @php
                            $notes = json_decode($application->notes, true);
                        @endphp
                        @if($notes)
                            <ul class="text-base text-gray-700 space-y-1">
                                @foreach($notes as $key => $value)
                                    <li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-base text-gray-700">{{ $application->notes }}</p>
                        @endif
                    </div>
                @endif

                <!-- Admin Notes -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Admin Notes</h3>
                    @if($application->adminNotes->count())
                        <div class="space-y-3">
                            @foreach($application->adminNotes as $note)
                                <div class="flex items-start space-x-3">
                                    <form method="POST" action="{{ route('admin.applications.notes.toggle', $note->id) }}" class="inline-flex items-center">
                                        @csrf
                                        <button type="submit" class="focus:outline-none">
                                            <input type="checkbox" {{ $note->is_checked ? 'checked' : '' }} class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded pointer-events-none" readonly>
                                        </button>
                                    </form>
                                    <div class="flex-1">
                                        <p class="text-base text-gray-700 {{ $note->is_checked ? 'line-through text-gray-500' : '' }}">{{ $note->note }}</p>
                                        <p class="text-xs text-gray-500">{{ $note->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                    <form method="POST" action="{{ route('admin.applications.notes.delete', $note->id) }}" class="inline" onsubmit="return confirm('Delete this note?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-base text-gray-500">No admin notes yet.</p>
                    @endif
                </div>
            </div>

            <!-- User Information -->
            @if ($application->user)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">User Account Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                            <p class="text-sm text-gray-900">{{ $application->user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                            <p class="text-sm text-gray-900">{{ $application->user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">User ID</label>
                            <p class="text-sm text-gray-900 font-mono">{{ $application->user->id }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Role</label>
                            <p class="text-sm text-gray-900">{{ ucfirst($application->user->role) }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <a href="{{ route('admin.applications') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-semibold transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Back to Applications
                    </a>
                    <form action="{{ route('admin.applications.delete', $application->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this application? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white hover:bg-red-700 px-6 py-3 rounded-lg font-semibold transition duration-200">
                            Delete Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
