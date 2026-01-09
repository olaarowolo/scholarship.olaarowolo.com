@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    @php $user = Auth::user(); @endphp
    @include('components.navbar', ['user' => $user])
    <div class="min-h-screen bg-gray-50 flex items-center justify-center pt-48 pb-8 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl mx-auto flex flex-col items-center justify-center">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 w-full">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">My Academic Reports</h1>
                @if ($reports->isEmpty())
                    <p class="text-gray-600">You have not submitted any academic reports yet.</p>
                @else
                    <div class="space-y-6">
                        @foreach ($reports as $report)
                            <div class="border rounded-xl p-6 bg-gray-50">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-lg text-gray-800">{{ $report->semester }} -
                                        {{ $report->level }}</span>
                                    <span
                                        class="text-xs px-3 py-1 rounded-full {{ $report->status == 'submitted' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($report->status) }}
                                    </span>
                                </div>
                                <div class="mb-2 text-gray-700">CGPA: {{ $report->cgpa ?? 'N/A' }}</div>
                                <div class="mb-2 text-gray-700">GPA: {{ $report->gpa ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-400">Submitted:
                                    {{ $report->created_at->format('M d, Y H:i') }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
