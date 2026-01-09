@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    @php $user = Auth::user(); @endphp
    @include('components.navbar', ['user' => $user])
    <div class="min-h-screen bg-gray-50 flex items-center justify-center pt-48 pb-8 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl mx-auto flex flex-col items-center justify-center">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 w-full">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">My Mentorship Bookings</h1>
                @if ($bookings->isEmpty())
                    <p class="text-gray-600">You have not booked any mentorship sessions yet.</p>
                @else
                    <div class="space-y-6">
                        @foreach ($bookings as $booking)
                            <div class="border rounded-xl p-6 bg-gray-50">
                                <div class="flex justify-between items-center mb-2">
                                    <span
                                        class="font-semibold text-lg text-gray-800">{{ ucfirst($booking->session_type) }}</span>
                                    <span
                                        class="text-xs px-3 py-1 rounded-full {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                                <div class="mb-2 text-gray-700">Topic: {{ $booking->topic }}</div>
                                <div class="text-sm text-gray-500 mb-2">Preferred Date: {{ $booking->preferred_date }}</div>
                                <div class="text-xs text-gray-400">Submitted:
                                    {{ $booking->created_at->format('M d, Y H:i') }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
