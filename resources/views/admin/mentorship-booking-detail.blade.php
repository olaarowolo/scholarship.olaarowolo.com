@section('admin_breadcrumb')
    <nav class="text-sm" aria-label="Breadcrumb">
        <ol class="list-reset flex items-center space-x-2 text-gray-500">
            <li>
                <a href="{{ route('admin.mentorship-bookings') }}" class="hover:text-gray-700">Mentorship Bookings</a>
            </li>
            <li><span class="text-gray-400">/</span></li>
            <li class="text-gray-700">#{{ $booking->id }}</li>
        </ol>
    </nav>
@endsection

@php
    $statusClass = $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800');
@endphp

@include('admin._header', [
    'title' => 'Mentorship Booking Details',
    'subtitle' => '#'.($booking->id ?? 'N/A').' booked by '.($booking->user->name ?? 'N/A'),
    'actions' => '<a href="'.route('admin.mentorship-bookings').'" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-full text-sm font-semibold transition duration-200">← Back to Bookings</a>'
])

<div class="mb-6 flex items-center justify-end space-x-4">
    <span class="inline-flex items-center px-3 py-1.5 text-sm font-semibold rounded-full {{ $statusClass }}">{{ ucfirst(str_replace('_',' ', $booking->status)) }}</span>
    <div class="text-sm text-gray-500 text-right">
        <div>Scheduled: <span class="font-medium text-gray-900">{{ optional($booking->scheduled_at)->format('M d, Y H:i') ?? 'N/A' }}</span></div>
        <div>Last Updated: <span class="font-medium text-gray-900">{{ $booking->updated_at->format('M d, Y H:i') }}</span></div>
    </div>
</div>

<!-- existing content... -->
