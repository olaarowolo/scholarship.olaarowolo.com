@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    @php $user = Auth::user(); @endphp
    @include('components.navbar', ['user' => $user])
    <div class="min-h-screen bg-gray-50 flex items-center justify-center pt-48 pb-8 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl mx-auto flex flex-col items-center justify-center">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 w-full">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">My Academic Advice Requests</h1>
                @if ($adviceRequests->isEmpty())
                    <p class="text-gray-600">You have not submitted any advice requests yet.</p>
                @else
                    <div class="space-y-6">
                        @foreach ($adviceRequests as $request)
                            <div class="border rounded-xl p-6 bg-gray-50">
                                <div class="flex justify-between items-center mb-2">
                                    <span
                                        class="font-semibold text-lg text-gray-800">{{ ucfirst($request->category) }}</span>
                                    <span
                                        class="text-xs px-3 py-1 rounded-full {{ $request->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </div>
                                <div class="mb-2 text-gray-700">{{ $request->subject }}</div>
                                <div class="text-sm text-gray-500 mb-2">Urgency: {{ ucfirst($request->urgency) }}</div>
                                <div class="text-xs text-gray-400">Submitted:
                                    {{ $request->created_at->format('M d, Y H:i') }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
