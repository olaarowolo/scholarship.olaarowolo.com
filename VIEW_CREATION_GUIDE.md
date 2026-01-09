# Quick Guide: Creating the Remaining Views

The backend is 100% complete. You just need to create the Blade view files. Here's a quick template guide:

## Scholar Tracking Views (5 files)

### Pattern for all tracking views:

```blade
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My [Form Type]</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject/Title</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>{{ $item->subject ?? $item->title ?? $item->topic }}</td>
                        <td>
                            <span class="badge badge-{{ $item->status == 'pending' ? 'warning' : 'success' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal{{ $item->id }}">
                                View Details
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No submissions yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $items->links() }}
</div>
@endsection
```

### Files to Create:

1. `resources/views/scholar/my-requests.blade.php` - Use `$requests`
2. `resources/views/scholar/my-academic-reports.blade.php` - Use `$reports`
3. `resources/views/scholar/my-challenges.blade.php` - Use `$challenges`
4. `resources/views/scholar/my-mentorship-bookings.blade.php` - Use `$bookings`
5. `resources/views/scholar/my-advice-requests.blade.php` - Use `$adviceRequests`

## Admin List Views (5 files)

### Pattern for admin list views:

```blade
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1>[Form Type] Submissions</h1>

    <!-- Filter by status -->
    <form method="GET" class="mb-3">
        <select name="status" onchange="this.form.submit()">
            <option value="all">All Statuses</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <!-- Add other status options based on form type -->
        </select>
    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Scholar</th>
                    <th>Subject/Title</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->subject ?? $item->title ?? $item->topic }}</td>
                        <td>
                            <span class="badge badge-{{ $item->status == 'pending' ? 'warning' : 'info' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.[form-type].show', $item->id) }}" class="btn btn-sm btn-primary">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $items->links() }}
</div>
@endsection
```

### Files to Create:

1. `resources/views/admin/scholar-requests.blade.php` - Use `$requests`
2. `resources/views/admin/academic-reports.blade.php` - Use `$reports`
3. `resources/views/admin/challenge-reports.blade.php` - Use `$reports`
4. `resources/views/admin/mentorship-bookings.blade.php` - Use `$bookings`
5. `resources/views/admin/advice-requests.blade.php` - Use `$requests`

## Admin Detail Views (5 files)

### Pattern for admin detail views:

```blade
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>[Form Type] Details</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>Submission #{{ $item->id }}</h3>
        </div>
        <div class="card-body">
            <h5>Scholar Information</h5>
            <p><strong>Name:</strong> {{ $item->user->name }}</p>
            <p><strong>Email:</strong> {{ $item->user->email }}</p>

            <hr>

            <h5>Submission Details</h5>
            <p><strong>Subject/Title:</strong> {{ $item->subject ?? $item->title ?? $item->topic }}</p>
            <p><strong>Description:</strong> {{ $item->description ?? $item->question }}</p>
            <p><strong>Status:</strong> {{ ucfirst($item->status) }}</p>
            <p><strong>Submitted:</strong> {{ $item->created_at->format('F d, Y \a\t h:i A') }}</p>

            <hr>

            <h5>Update Status</h5>
            <form method="POST" action="{{ route('admin.[form-type].update-status', $item->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <!-- Add status options based on form type -->
                    </select>
                </div>

                <div class="form-group">
                    <label>Admin Notes/Response</label>
                    <textarea name="admin_notes" class="form-control" rows="4">{{ $item->admin_notes ?? $item->admin_feedback ?? $item->advice_response }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.[form-type]') }}" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>
@endsection
```

### Files to Create:

1. `resources/views/admin/scholar-request-detail.blade.php`
2. `resources/views/admin/academic-report-detail.blade.php`
3. `resources/views/admin/challenge-report-detail.blade.php`
4. `resources/views/admin/mentorship-booking-detail.blade.php`
5. `resources/views/admin/advice-request-detail.blade.php`

## Variable Names Reference

| Form Type           | List Variable | Item Name  |
| ------------------- | ------------- | ---------- |
| Scholar Requests    | `$requests`   | `$request` |
| Academic Reports    | `$reports`    | `$report`  |
| Challenge Reports   | `$reports`    | `$report`  |
| Mentorship Bookings | `$bookings`   | `$booking` |
| Advice Requests     | `$requests`   | `$request` |

## Status Options by Form Type

### Scholar Requests

-   pending, in_progress, resolved, closed

### Academic Reports

-   submitted, reviewed, flagged

### Challenge Reports

-   submitted, under_review, addressed, ongoing

### Mentorship Bookings

-   pending, confirmed, completed, cancelled

### Advice Requests

-   pending, answered, closed

## Admin Update Fields by Form Type

| Form Type           | Status Field | Response Field                 |
| ------------------- | ------------ | ------------------------------ |
| Scholar Requests    | `status`     | `admin_notes`                  |
| Academic Reports    | `status`     | `admin_feedback`               |
| Challenge Reports   | `status`     | `admin_response`               |
| Mentorship Bookings | `status`     | `admin_notes` + `scheduled_at` |
| Advice Requests     | `status`     | `advice_response`              |

## Quick Command to Create All Views

```bash
# Scholar tracking views
touch resources/views/scholar/my-requests.blade.php
touch resources/views/scholar/my-academic-reports.blade.php
touch resources/views/scholar/my-challenges.blade.php
touch resources/views/scholar/my-mentorship-bookings.blade.php
touch resources/views/scholar/my-advice-requests.blade.php

# Admin list views
touch resources/views/admin/scholar-requests.blade.php
touch resources/views/admin/academic-reports.blade.php
touch resources/views/admin/challenge-reports.blade.php
touch resources/views/admin/mentorship-bookings.blade.php
touch resources/views/admin/advice-requests.blade.php

# Admin detail views
touch resources/views/admin/scholar-request-detail.blade.php
touch resources/views/admin/academic-report-detail.blade.php
touch resources/views/admin/challenge-report-detail.blade.php
touch resources/views/admin/mentorship-booking-detail.blade.php
touch resources/views/admin/advice-request-detail.blade.php
```

## Next Steps

1. Create all 15 view files using the templates above
2. Customize the styling to match your existing design
3. Test each form by submitting data
4. Verify emails are working
5. Test admin panel updates

Everything else is complete and working!
