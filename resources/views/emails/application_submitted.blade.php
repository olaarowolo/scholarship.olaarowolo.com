<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Submitted Successfully</title>
    <style>
        body {
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px 20px;
        }
        .success-icon {
            text-align: center;
            font-size: 60px;
            color: #10b981;
            margin: 20px 0;
        }
        .info-box {
            background: #f0f9ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box strong {
            color: #1e40af;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
        .details-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        .details-table td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
        }
        .details-table td:first-child {
            font-weight: bold;
            color: #4b5563;
            width: 40%;
        }
        ul {
            padding-left: 20px;
        }
        ul li {
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 OA Scholarship Program</h1>
        </div>

        <div class="content">
            <div class="success-icon">✓</div>

            <h2 style="text-align: center; color: #10b981;">Application Submitted Successfully!</h2>

            <p>Dear {{ $application->first_name }} {{ $application->last_name }},</p>

            <p>Thank you for submitting your scholarship application to the OA Scholarship Program. We have successfully received your application and it is now under review.</p>

            <div class="info-box">
                <strong>Your Application ID:</strong> {{ $application->application_id }}<br>
                <strong>Submission Date:</strong> {{ $application->created_at->format('F d, Y \a\t h:i A') }}
            </div>

            <h3 style="color: #4b5563;">Application Summary:</h3>
            <table class="details-table">
                <tr>
                    <td>Full Name:</td>
                    <td>{{ $application->first_name }} {{ $application->last_name }}</td>
                </tr>
                <tr>
                    <td>Institution:</td>
                    <td>{{ $application->institution }}</td>
                </tr>
                <tr>
                    <td>Course of Study:</td>
                    <td>{{ $application->course }}</td>
                </tr>
                @if($application->jamb_score)
                <tr>
                    <td>JAMB Score:</td>
                    <td>{{ $application->jamb_score }}</td>
                </tr>
                @endif
                <tr>
                    <td>Status:</td>
                    <td style="color: #2563eb; font-weight: bold;">{{ ucfirst($application->status) }}</td>
                </tr>
            </table>

            <h3 style="color: #4b5563;">What Happens Next?</h3>
            <ul>
                <li>Our team will review your application and supporting documents</li>
                <li>You will receive updates via email at <strong>{{ $application->user->email ?? 'your registered email' }}</strong></li>
                <li>The review process typically takes 2-4 weeks</li>
                <li>You can track your application status on your dashboard</li>
            </ul>

            <div style="text-align: center;">
                <a href="{{ url('/dashboard') }}" class="button">View Your Dashboard</a>
            </div>

            <div class="info-box" style="background: #fef3c7; border-left-color: #f59e0b;">
                <strong>Important:</strong> Please keep this email for your records. You will need your Application ID for future reference.
            </div>

            <p style="margin-top: 30px;">If you have any questions, please don't hesitate to contact us at <a href="mailto:info@olaarowolo.com">info@olaarowolo.com</a>.</p>

            <p>Best wishes,<br>
            <strong>The OA Scholarship Team</strong></p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} OA Scholarship Program. All rights reserved.</p>
            <p>This is an automated message. Please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>
