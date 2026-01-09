<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }

        .code-box {
            background: white;
            border: 2px solid #667eea;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }

        .code {
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 8px;
            color: #667eea;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }

        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Two-Factor Authentication</h1>
    </div>
    <div class="content">
        <p>Hello {{ $userName }},</p>

        <p>You have requested to log in to your scholarship account. To complete your login, please use the following
            verification code:</p>

        <div class="code-box">
            <div class="code">{{ $code }}</div>
        </div>

        <div class="warning">
            <strong>⏰ This code will expire in 10 minutes.</strong><br>
            If you didn't request this code, please ignore this email or contact support immediately.
        </div>

        <p>For your security:</p>
        <ul>
            <li>Never share this code with anyone</li>
            <li>Our staff will never ask for this code</li>
            <li>If you didn't request this, someone may be trying to access your account</li>
        </ul>

        <p>Best regards,<br>
            The Scholarship Team</p>
    </div>
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
    </div>
</body>

</html>
