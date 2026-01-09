<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Login Credentials</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .success-icon {
            text-align: center;
            font-size: 60px;
            color: #10b981;
            margin: 20px 0;
        }

        .content {
            padding: 30px 20px;
        }

        .credentials-box {
            background: #f0fdf4;
            border: 2px solid #10b981;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
        }

        .credential-item {
            margin: 15px 0;
        }

        .credential-label {
            color: #065f46;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .credential-value {
            background: white;
            padding: 12px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 16px;
            color: #1f2937;
            border: 1px solid #d1fae5;
            word-break: break-all;
        }

        .password-value {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #dc2626;
        }

        .action-button {
            display: inline-block;
            padding: 14px 40px;
            background: #10b981;
            color: white !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            text-align: center;
            margin: 20px 0;
            font-size: 16px;
        }

        .action-button:hover {
            background: #059669;
        }

        .security-notice {
            background: #fef2f2;
            border-left: 4px solid #dc2626;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }

        .security-notice strong {
            color: #991b1b;
        }

        .info-box {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }

        .steps {
            background: #f9fafb;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }

        .step {
            display: flex;
            align-items: start;
            margin: 15px 0;
        }

        .step-number {
            background: #10b981;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
            margin-right: 15px;
        }

        .step-content {
            flex-grow: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Welcome to Your Scholarship Portal!</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Your account has been created successfully</p>
        </div>

        <div class="content">
            <div class="success-icon">✅</div>

            <p style="text-align: center; font-size: 18px; color: #1f2937; margin: 20px 0;">
                <strong>Hello {{ $user->name }}!</strong>
            </p>

            <p style="color: #4b5563;">
                Thank you for submitting your scholarship application! Your application has been received and assigned
                the following ID:
            </p>

            <div style="text-align: center; background: #eff6ff; padding: 15px; border-radius: 6px; margin: 20px 0;">
                <div style="color: #3b82f6; font-size: 12px; text-transform: uppercase; margin-bottom: 5px;">Application
                    ID</div>
                <div style="color: #1e40af; font-size: 24px; font-weight: 700; font-family: 'Courier New', monospace;">
                    {{ $applicationId }}
                </div>
            </div>

            <p style="color: #4b5563;">
                We've created an account for you to track your application status and access your scholarship portal.
                Please find your login credentials below:
            </p>

            <!-- Credentials Box -->
            <div class="credentials-box">
                <div style="text-align: center; margin-bottom: 20px;">
                    <strong style="color: #065f46; font-size: 18px;">🔐 Your Login Credentials</strong>
                </div>

                <div class="credential-item">
                    <div class="credential-label">📧 Email / Username</div>
                    <div class="credential-value">{{ $user->email }}</div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">🔑 Temporary Password</div>
                    <div class="credential-value password-value">{{ $password }}</div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">🌐 Login URL</div>
                    <div class="credential-value">
                        <a href="{{ env('APP_URL') }}/login" style="color: #3b82f6; text-decoration: none;">
                            {{ env('APP_URL') }}/login
                        </a>
                    </div>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="security-notice">
                <strong>🔒 Important Security Notice:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li>This is a temporary password for your first login</li>
                    <li>Please change your password immediately after logging in</li>
                    <li>Never share your password with anyone</li>
                    <li>Keep this email in a secure location</li>
                </ul>
            </div>

            <!-- Login Button -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ env('APP_URL') }}/login" class="action-button">
                    🚀 Login to Your Portal
                </a>
            </div>

            <!-- Steps -->
            <div class="steps">
                <h3 style="margin: 0 0 20px 0; color: #1f2937; font-size: 18px;">Next Steps:</h3>

                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <strong style="color: #1f2937;">Login to Your Account</strong>
                        <p style="margin: 5px 0 0 0; color: #6b7280; font-size: 14px;">
                            Use the credentials above to access your scholarship portal
                        </p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <strong style="color: #1f2937;">Change Your Password</strong>
                        <p style="margin: 5px 0 0 0; color: #6b7280; font-size: 14px;">
                            Update your temporary password to something secure and memorable
                        </p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <strong style="color: #1f2937;">Track Your Application</strong>
                        <p style="margin: 5px 0 0 0; color: #6b7280; font-size: 14px;">
                            Monitor your application status and receive updates in your dashboard
                        </p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <strong style="color: #1f2937;">Stay Updated</strong>
                        <p style="margin: 5px 0 0 0; color: #6b7280; font-size: 14px;">
                            Check your email regularly for updates about your application
                        </p>
                    </div>
                </div>
            </div>

            <!-- Information Box -->
            <div class="info-box">
                <strong style="color: #1e40af;">💡 What Happens Next?</strong>
                <p style="margin: 10px 0 0 0; color: #4b5563; font-size: 14px;">
                    Our team will review your application thoroughly. You'll receive an email notification once a
                    decision has been made.
                    The review process typically takes 2-3 weeks. You can check your application status anytime by
                    logging into your portal.
                </p>
            </div>

            <!-- Help Section -->
            <div style="background: #f9fafb; padding: 20px; border-radius: 6px; margin: 20px 0;">
                <strong style="color: #1f2937;">❓ Need Help?</strong>
                <p style="margin: 10px 0; color: #4b5563; font-size: 14px;">
                    If you have any questions or need assistance:
                </p>
                <ul style="margin: 10px 0; padding-left: 20px; color: #4b5563; font-size: 14px;">
                    <li>Email us at: <a href="mailto:scholarship@olaarowolo.com"
                            style="color: #3b82f6;">scholarship@olaarowolo.com</a></li>
                    <li>Visit our website: <a href="{{ env('APP_URL') }}"
                            style="color: #3b82f6;">{{ env('APP_URL') }}</a></li>
                    <li>Check our FAQs and resources in your portal</li>
                </ul>
            </div>

            <!-- Thank You -->
            <p style="text-align: center; color: #4b5563; margin: 30px 0;">
                Thank you for your interest in the OA Foundation & Scholarship program.<br>
                We look forward to supporting your educational journey!
            </p>
        </div>

        <div class="footer">
            <p style="margin: 0 0 10px 0;">
                <strong>OA Foundation & Scholarship</strong><br>
                Empowering Iba Kingdom Youth Through Education
            </p>
            <p style="margin: 0; font-size: 12px;">
                This email contains sensitive information. Please keep it secure.<br>
                If you did not apply for this scholarship, please contact us immediately.
            </p>
        </div>
    </div>
</body>

</html>
