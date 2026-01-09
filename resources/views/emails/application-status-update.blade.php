<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status Update</title>
    <style>
        body { line-height: 1.6; color: #333; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 20px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .header { background: linear-gradient(135deg,#667eea 0%,#764ba2 100%); color: white; padding: 30px 20px; text-align: center; }
        .content { padding: 30px 20px; }
        .status-icon { text-align: center; font-size: 60px; margin: 20px 0; }
        .status-pending { color: #f59e0b; }
        .status-under_review { color: #4f46e5; }
        .status-in_progress { color: #f59e0b; }
        .status-submitted { color: #fb923c; }
        .status-approved { color: #10b981; }
        .status-rejected { color: #ef4444; }
        .details-table { width: 100%; margin: 20px 0; border-collapse: collapse; }
        .details-table td { padding: 10px; border-bottom: 1px solid #e5e7eb; }
        .button { display:inline-block; padding: 12px 28px; background: linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:#fff; text-decoration:none; border-radius:6px; }
        .footer { background:#f9fafb; padding:20px; text-align:center; font-size:12px; color:#6b7280; border-top:1px solid #e5e7eb; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 OA Foundation Scholarship</h1>
        </div>
        <div class="content">
            @php
                $statusIcon = match($application->status) {
                    'draft' => '📝',
                    'submitted' => '📬',
                    'pending' => '⏳',
                    'under_review' => '🔍',
                    'in_progress' => '🔄',
                    'approved' => '✅',
                    'rejected' => '❌',
                    default => 'ℹ️'
                };
                $statusClass = 'status-' . $application->status;
                $applicantName = $application->user->name ?? trim(($application->first_name ?? '') . ' ' . ($application->last_name ?? ''));
            @endphp

            <div class="status-icon {{ $statusClass }}">{{ $statusIcon }}</div>

            <h2 style="text-align:center;">Application Status Update</h2>
            <p>Dear {{ $applicantName }},</p>
            <p>Your scholarship application status has been updated to: <strong>{{ ucfirst(str_replace('_', ' ', $application->status)) }}</strong></p>

            <table class="details-table">
                <tr>
                    <td>Application ID</td>
                    <td>{{ $application->application_id }}</td>
                </tr>
                <tr>
                    <td>Course</td>
                    <td>{{ $application->course ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Level</td>
                    <td>{{ $application->level ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>JAMB Score</td>
                    <td>{{ $application->jamb_score ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Last Updated</td>
                    <td>{{ $application->updated_at->format('F d, Y \a\t h:i A') }}</td>
                </tr>
            </table>

            @if($application->admin_notes)
                <h3>Admin Notes</h3>
                <p style="background:#fef3c7;padding:15px;border-radius:4px;border-left:4px solid #f59e0b;">{{ $application->admin_notes }}</p>
            @endif

            <div style="text-align:center;margin-top:20px;">
                <a href="{{ url('/applications/my-applications') }}" class="button">View My Applications</a>
            </div>

            <p style="margin-top:20px;">If you have any questions, reply to this email or contact us through the OA Foundation portal.</p>
            <p>Best regards,<br><strong>The OA Foundation Team</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} OA Foundation. All rights reserved.</p>
        </div>
    </div>
</body>
</html>