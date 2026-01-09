@extends('layouts.admin')

@section('content')
    @include('admin._header', [
        'title' => 'Mentorship Bookings',
        'subtitle' => 'Manage mentorship bookings and schedules',
        'actions' => '<a href="'.route('admin.dashboard').'" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-full text-sm font-semibold transition duration-200">← Back to Dashboard</a>'
    ])

    <div class="mt-8">
        <!-- Content for mentorship bookings -->
    </div>
@endsection
