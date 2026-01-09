// ...existing code...

            @include('admin._header', [
                'title' => 'Academic Reports',
                'subtitle' => 'Review and manage academic reports submitted by scholars',
                'actions' => '<a href="'.route('admin.dashboard').'" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-full text-sm font-semibold transition duration-200">← Back to Dashboard</a>'
            ])

// ...existing code...
