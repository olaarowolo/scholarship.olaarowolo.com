@php
    // ...existing code...
@endphp

@php
    $statusColors = [
        'pending' => 'bg-yellow-100 text-yellow-800',
        'answered' => 'bg-green-100 text-green-800',
        'closed' => 'bg-gray-100 text-gray-800',
    ];
    $statusClass = $statusColors[$request->status] ?? 'bg-gray-100 text-gray-800';
@endphp

@include('admin._header', [
    'title' => 'Advice Request',
    'subtitle' => '#'.($request->id ?? 'N/A').' submitted by '.($request->user->name ?? 'N/A'),
    'actions' => '<a href="'.route('admin.advice-requests').'" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-full text-sm font-semibold transition duration-200">← Back to Requests</a>'
])

<div class="mb-6 flex items-center justify-end space-x-4">
    <span class="inline-flex items-center px-3 py-1.5 text-sm font-semibold rounded-full {{ $statusClass }}">{{ ucfirst(str_replace('_',' ', $request->status)) }}</span>
    <div class="text-sm text-gray-500 text-right">
        <div>Submitted: <span class="font-medium text-gray-900">{{ $request->created_at->format('M d, Y H:i') }}</span></div>
        <div>Last Updated: <span class="font-medium text-gray-900">{{ $request->updated_at->format('M d, Y H:i') }}</span></div>
    </div>
</div>

<!-- rest of the view -->