@php
    // ...existing code...
@endphp

@section('admin_breadcrumb')
    <nav class="text-sm" aria-label="Breadcrumb">
        <ol class="list-reset flex items-center space-x-2 text-gray-500">
            <li>
                <a href="{{ route('admin.academic-reports') }}" class="hover:text-gray-700">Academic Reports</a>
            </li>
            <li><span class="text-gray-400">/</span></li>
            <li class="text-gray-700">#{{ $report->id }}</li>
        </ol>
    </nav>
@endsection

@include('admin._header', [
    'title' => 'Academic Report',
    'subtitle' => 'Submitted by ' . ($report->user->name ?? 'N/A'),
    'actions' => '<a href="'.route('admin.academic-reports').'" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-full text-sm font-semibold transition duration-200">← Back to Reports</a>'
])

<div class="mb-6 flex items-center justify-end space-x-4">
    <span class="inline-flex items-center px-3 py-1.5 text-sm font-semibold rounded-full {{ $report->status == 'submitted' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }}">{{ ucfirst($report->status) }}</span>
    <div class="text-sm text-gray-500 text-right">
        <div>Submitted: <span class="font-medium text-gray-900">{{ $report->created_at->format('M d, Y H:i') }}</span></div>
        <div>Last Updated: <span class="font-medium text-gray-900">{{ $report->updated_at->format('M d, Y H:i') }}</span></div>
    </div>
</div>

<!-- rest of detail view -->
