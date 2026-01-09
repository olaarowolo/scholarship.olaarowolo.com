<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEW Application Submitted - Ola Arowolo Foundation</title>
    <!-- Load Tailwind CSS (for web preview simplicity) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Define custom colors (Black and Gold theme) */
        :root {
            --color-primary: #000000;
            --color-accent: #F59E0B;
            /* Gold */
            --color-background: #f8f8f8;
            --color-text: #1f2937;
            --color-alert: #dc2626;
            /* Red for alerts */
        }

        /* General Email Body Styles */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--color-background);
            color: var(--color-text);
        }

        /* Important: Use table-based layout for email client compatibility */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* Inline styles are best practice for emails */
        .primary-text {
            color: var(--color-primary);
        }

        .accent-bg {
            background-color: var(--color-accent);
        }

        .accent-text {
            color: var(--color-accent);
        }

        /* Responsive adjustments */
        @media (max-width: 620px) {
            .email-container {
                width: 95% !important;
                border-radius: 0;
            }
        }

        /* Custom table styles for application summary */
        .details-table {
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .details-table td {
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
            font-size: 15px;
            line-height: 1.5;
        }

        .details-table tr:last-child td {
            border-bottom: none;
        }

        .details-table td:first-child {
            font-weight: 600;
            color: #4b5563;
            width: 40%;
        }
    </style>
</head>

<body>

    <table width="100%" cellpadding="0" cellspacing="0" border="0" role="presentation"
        style="background-color: var(--color-background); padding: 40px 0;">
        <tr>
            <td align="center">

                <!-- Email Wrapper Card -->
                <table class="email-container" width="100%" cellpadding="0" cellspacing="0" border="0"
                    role="presentation">

                    <!-- Header/Logo -->
                    <tr>
                        <td style="padding: 32px 32px 16px 32px;" align="center">
                            <img src="https://scholarship.olaarowolo.com/assets/img/favicon/olaarowolo.com_logo_black.png"
                                alt="Ola Arowolo Foundation" width="150" style="max-width: 150px; height: auto;">
                        </td>
                    </tr>

                    <!-- Confirmation Content -->
                    <tr>
                        <td style="padding: 32px 32px 16px 32px;">
                            <h1 class="text-3xl font-bold primary-text"
                                style="font-size: 28px; font-weight: 700; line-height: 1.2; text-align: center; color: var(--color-alert);">
                                🚨 NEW APPLICATION ALERT 🚨
                            </h1>

                            <!-- Success Icon -->
                            <div
                                style="font-size: 60px; color: var(--color-alert); text-align: center; margin: 20px 0;">
                                ★
                            </div>

                            <p class="mt-4 text-gray-700" style="font-size: 16px; line-height: 1.6; color: #374151;">
                                Dear <strong class="primary-text">Admin Team</strong>,
                            </p>
                            <p class="mt-4 text-gray-700" style="font-size: 16px; line-height: 1.6; color: #374151;">
                                A new scholarship application has been successfully submitted and is awaiting your
                                review. Please find the summary details below.
                            </p>

                            <!-- Application Summary Table (Enhanced Details) -->
                            <div class="mt-8 p-6 rounded-lg border-t-4"
                                style="border-color: var(--color-accent); background-color: #f3f4f6; border-radius: 8px;">
                                <h3 class="text-xl font-semibold primary-text mb-4"
                                    style="font-size: 20px; font-weight: 600;">Applicant Summary</h3>
                                <table class="details-table" width="100%" cellpadding="0" cellspacing="0"
                                    border="0" role="presentation">
                                    <tr>
                                        <td>Application ID:</td>
                                        <td style="color: var(--color-accent); font-weight: 700;">
                                            {{ $application->application_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Submission Date:</td>
                                        <td>{{ $application->created_at->format('F d, Y \a\t h:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Applicant Name:</td>
                                        <td>{{ $application->first_name }} {{ $application->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td><a href="mailto:{{ $application->user->email }}"
                                                style="color: var(--color-accent); text-decoration: none;">{{ $application->user->email }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Institution Applied To:</td>
                                        <td>{{ $application->institution }}</td>
                                    </tr>
                                    <tr>
                                        <td>Course of Study:</td>
                                        <td>{{ $application->course }}</td>
                                    </tr>
                                    @if ($application->jamb_score)
                                        <tr>
                                            <td>JAMB Score:</td>
                                            <td>{{ $application->jamb_score }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Current Status:</td>
                                        <td style="color: var(--color-alert); font-weight: 700;">
                                            {{ ucfirst($application->status) }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Next Steps for Admin -->
                            <h3 class="mt-8 text-2xl font-bold primary-text" style="font-size: 24px; font-weight: 700;">
                                Action Required:</h3>
                            <ul class="mt-4 space-y-3 pl-5 list-disc text-gray-700"
                                style="font-size: 16px; line-height: 1.6; color: #374151; margin-left: 20px;">
                                <li style="margin-bottom: 8px;">
                                    <strong class="primary-text">Review and Verify:</strong> Click the link below to
                                    access the full application, review supporting documents, and begin the indigene
                                    status verification process.
                                </li>
                                <li style="margin-bottom: 8px;">
                                    <strong class="primary-text">Status Update:</strong> Once reviewed, update the
                                    application status on the portal (e.g., 'Pending Verification', 'Shortlisted',
                                    'Rejected').
                                </li>
                            </ul>

                            <!-- CTA Button (Admin Portal Link) -->
                            <div align="center" class="mt-10">
                                <a href="{{ url('/admin/applications/' . $application->application_id) }}"
                                    class="px-8 py-3 inline-block font-bold text-lg rounded-full"
                                    style="background-color: var(--color-primary); color: var(--color-accent); text-decoration: none; font-size: 18px; border-radius: 9999px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                                    Review Application Now &rarr;
                                </a>
                            </div>

                            <p style="margin-top: 30px; font-size: 16px; line-height: 1.6; color: #374151;">
                                This is a system notification. Do not forward this email to the applicant.
                            </p>

                            <p style="margin-top: 20px; font-size: 16px; line-height: 1.6; color: #374151;">
                                Sincerely,<br>
                                <strong>The Automated System</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 32px 32px 24px 32px; background-color: var(--color-primary); color: #ffffff; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;"
                            align="center">
                            <p class="text-sm text-gray-400" style="font-size: 12px; line-height: 1.5; color: #9ca3af;">
                                Admin Portal Notification System.
                            </p>
                            <p class="mt-2 text-xs text-gray-500" style="font-size: 11px; color: #6b7280;">
                                &copy; 2024 Ola Arowolo Foundation | Empowering Education.
                            </p>
                        </td>
                    </tr>
                </table>
                <!-- End Email Wrapper Card -->

            </td>
        </tr>
    </table>

</body>

</html>
