<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #fff; padding: 30px; border: 1px solid #e5e7eb; }
        .success { text-align: center; font-size: 48px; color: #10b981; }
        .info-box { background: #f0f9ff; border-left: 4px solid #3b82f6; padding: 15px; margin: 20px 0; }
        .button { display: inline-block; padding: 12px 30px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; }
        .footer { background: #f9fafb; padding: 20px; text-align: center; font-size: 12px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header"><h1>🎓 Academic Report Submitted</h1></div>
        <div class="content">
            <div class="success">✓</div>
            <h2 style="text-align: center; color: #10b981;">Report Submitted Successfully!</h2>
            <p>Dear {{ $report->user->name }},</p>
            <p>Your academic report for <strong>{{ $report->semester }}</strong> has been successfully submitted.</p>
            <div class="info-box">
                <strong>Level:</strong> {{ $report->level }}<br>
                <strong>CGPA:</strong> {{ $report->cgpa ?? 'N/A' }}<br>
                <strong>GPA:</strong> {{ $report->gpa ?? 'N/A' }}<br>
                <strong>Status:</strong> {{ ucfirst($report->status) }}<br>
                <strong>Submitted:</strong> {{ $report->created_at->format('F d, Y') }}
            </div>
            <p>Our team will review your academic progress and may reach out if we have any questions.</p>
            <div style="text-align: center;">
                <a href="{{ url('/scholar/academic-reports/my-reports') }}" class="button">View My Reports</a>
            </div>
            <p>Keep up the great work!<br><strong>The OA Foundation Team</strong></p>
        </div>
        <div class="footer"><p>&copy; {{ date('Y') }} OA Foundation. All rights reserved.</p></div>
    </div>
</body>
</html>
