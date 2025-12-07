@extends('layouts.app')

@section('content')
    <style>
        /* Define the black and white theme based on the logo */
        :root {
            --primary: #000000;
            --secondary: #333333;
            --background: #f8f8f8;
            --text-dark: #1f2937;
            --text-light: #ffffff;
            --accent: #e5e7eb;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            padding-top: 60px;
        }

        /* Mobile-first typography */
        .privacy-container h1 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }
        .privacy-container h2 {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--primary);
            margin-top: 2rem;
            margin-bottom: 0.75rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--accent);
        }
        .privacy-container h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--secondary);
            margin-top: 1.25rem;
            margin-bottom: 0.5rem;
        }
        .privacy-container h4 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--secondary);
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }
        .privacy-container p, .privacy-container li {
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 0.875rem;
            font-size: 0.875rem;
        }
        .privacy-container ul, .privacy-container ol {
            list-style-type: disc;
            margin-left: 1.25rem;
            padding-left: 0.5rem;
            margin-top: 0.75rem;
            margin-bottom: 1rem;
        }
        .privacy-container ol {
            list-style-type: decimal;
        }
        .privacy-container strong {
            font-weight: 600;
            color: var(--secondary);
        }
        .privacy-container hr {
            border: 0;
            height: 1px;
            background: var(--accent);
            margin: 1.5rem 0;
        }
        .privacy-container .effective-date {
            font-size: 0.875rem;
            color: #6b7280;
            font-style: italic;
        }
        .privacy-container .highlight-box {
            background: #fef3c7;
            border-left: 3px solid #f59e0b;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.5rem;
        }
        .privacy-container .info-box {
            background: #dbeafe;
            border-left: 3px solid #3b82f6;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.5rem;
        }
        .privacy-container .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
            font-size: 0.8rem;
            display: block;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .privacy-container .data-table th {
            background: var(--primary);
            color: var(--text-light);
            padding: 0.75rem 0.5rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.75rem;
        }
        .privacy-container .data-table td {
            padding: 0.75rem 0.5rem;
            border-bottom: 1px solid var(--accent);
            font-size: 0.75rem;
        }
        .privacy-container .data-table tr:hover {
            background: #f9fafb;
        }
        .privacy-container .data-table ul {
            margin-left: 0.75rem;
            font-size: 0.7rem;
        }
        .btn-back {
            color: var(--primary);
            font-weight: 600;
            transition: color 0.2s;
            font-size: 0.875rem;
        }
        .btn-back:hover {
            color: var(--secondary);
        }

        /* Tablet and up */
        @media (min-width: 640px) {
            body {
                padding-top: 64px;
            }
            .privacy-container h1 {
                font-size: 2rem;
            }
            .privacy-container h2 {
                font-size: 1.75rem;
                margin-top: 2.25rem;
            }
            .privacy-container h3 {
                font-size: 1.35rem;
            }
            .privacy-container h4 {
                font-size: 1.15rem;
            }
            .privacy-container p, .privacy-container li {
                font-size: 0.9375rem;
                line-height: 1.65;
            }
            .privacy-container .effective-date {
                font-size: 1rem;
            }
            .privacy-container .data-table {
                font-size: 0.875rem;
            }
            .privacy-container .data-table th,
            .privacy-container .data-table td {
                padding: 0.875rem 0.75rem;
                font-size: 0.875rem;
            }
            .privacy-container .data-table ul {
                font-size: 0.8125rem;
            }
            .btn-back {
                font-size: 0.9375rem;
            }
        }

        /* Desktop */
        @media (min-width: 1024px) {
            .privacy-container h1 {
                font-size: 2.5rem;
            }
            .privacy-container h2 {
                font-size: 2.25rem;
                margin-top: 2.5rem;
            }
            .privacy-container h3 {
                font-size: 1.5rem;
                margin-top: 1.5rem;
            }
            .privacy-container h4 {
                font-size: 1.25rem;
                margin-top: 1.25rem;
            }
            .privacy-container p, .privacy-container li {
                font-size: 1rem;
                line-height: 1.75;
                margin-bottom: 1rem;
            }
            .privacy-container ul, .privacy-container ol {
                margin-left: 2rem;
                margin-top: 1rem;
                margin-bottom: 1.5rem;
            }
            .privacy-container .effective-date {
                font-size: 1.125rem;
            }
            .privacy-container .highlight-box,
            .privacy-container .info-box {
                padding: 1.5rem;
                margin: 1.5rem 0;
            }
            .privacy-container .data-table {
                margin: 1.5rem 0;
                font-size: 0.9375rem;
            }
            .privacy-container .data-table th,
            .privacy-container .data-table td {
                padding: 1rem;
                font-size: 0.9375rem;
            }
            .privacy-container .data-table ul {
                font-size: 0.875rem;
                margin-left: 1rem;
            }
            .privacy-container hr {
                margin: 2rem 0;
            }
            .btn-back {
                font-size: 1rem;
            }
        }
    </style>

    <!-- Include Navbar -->
    <x-navbar :user="auth()->user() ?? null" />

    <!-- Privacy Policy Content -->
    <main class="max-w-4xl mx-auto px-3 sm:px-6 lg:px-8 py-6 sm:py-12 mb-8 sm:mb-16" style="padding-top: 100px;">
        <div class="privacy-container bg-white rounded-lg sm:rounded-xl shadow-lg p-4 sm:p-6 lg:p-8 border border-accent">

            <p class="effective-date">Effective Date: December 7, 2025</p>
            <p class="effective-date mb-6">Last Updated: December 7, 2025</p>

            <p>
                Welcome to the Ola Arowolo Scholarship Program ("we," "us," or "our"). We are committed to protecting your privacy and being transparent about how we collect, use, and safeguard your personal information. This Privacy Policy explains our practices regarding data collection and usage in detail.
            </p>

            <div class="highlight-box">
                <p class="font-semibold text-base sm:text-lg mb-2"><i class="fas fa-shield-alt mr-2"></i>Our Commitment to You</p>
                <p class="mb-0 text-sm sm:text-base">We collect only the data necessary to operate the scholarship program effectively. Your information is never sold to third parties, and we implement strong security measures to protect your data.</p>
            </div>

            <h2>1. Information We Collect</h2>

            <h3>1.1 Personal Information You Provide</h3>
            <p>When you interact with our scholarship platform, we collect the following information that you voluntarily provide:</p>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Data Category</th>
                        <th>Specific Information</th>
                        <th>Purpose</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Account Information</strong></td>
                        <td>
                            <ul class="mb-0 ml-0">
                                <li>Full name</li>
                                <li>Email address</li>
                                <li>Password (encrypted)</li>
                                <li>Phone number</li>
                            </ul>
                        </td>
                        <td>Account creation, authentication, and communication</td>
                    </tr>
                    <tr>
                        <td><strong>Application Data</strong></td>
                        <td>
                            <ul class="mb-0 ml-0">
                                <li>Personal details (date of birth, gender)</li>
                                <li>Educational records (WAEC, JAMB results)</li>
                                <li>Indigene verification documents</li>
                                <li>Academic transcripts</li>
                                <li>Proof of university admission</li>
                                <li>Family background information</li>
                                <li>Financial need documentation</li>
                                <li>Personal statement/essays</li>
                            </ul>
                        </td>
                        <td>Application processing, eligibility verification, and scholarship selection</td>
                    </tr>
                    <tr>
                        <td><strong>Contact Information</strong></td>
                        <td>
                            <ul class="mb-0 ml-0">
                                <li>Physical address</li>
                                <li>Guardian/parent contact details</li>
                                <li>Emergency contact information</li>
                            </ul>
                        </td>
                        <td>Communication, verification, and emergency situations</td>
                    </tr>
                    <tr>
                        <td><strong>Uploaded Documents</strong></td>
                        <td>
                            <ul class="mb-0 ml-0">
                                <li>Birth certificates</li>
                                <li>Passport photographs</li>
                                <li>Academic certificates</li>
                                <li>Identification documents</li>
                            </ul>
                        </td>
                        <td>Identity verification and application processing</td>
                    </tr>
                </tbody>
            </table>

            <h3>1.2 Automatically Collected Information</h3>
            <p>We automatically collect certain information when you visit our website:</p>

            <div class="info-box">
                <p class="font-semibold mb-2 text-sm sm:text-base"><i class="fas fa-info-circle mr-2"></i>Visitor Tracking Data</p>
                <p class="text-sm sm:text-base">Our website uses visitor tracking to improve user experience and understand our audience. Here's exactly what we collect:</p>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Data Type</th>
                        <th>What We Collect</th>
                        <th>How We Use It</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>IP Address</strong></td>
                        <td>Your device's internet protocol address</td>
                        <td>
                            <ul class="mb-0 ml-0">
                                <li>Geolocation (country, state/region, city)</li>
                                <li>Security and fraud prevention</li>
                                <li>Analytics and traffic analysis</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Session Data</strong></td>
                        <td>Unique session identifier</td>
                        <td>Track unique vs. returning visitors, session duration</td>
                    </tr>
                    <tr>
                        <td><strong>Browser Information</strong></td>
                        <td>User agent string (browser type, version, operating system)</td>
                        <td>Optimize website performance for different devices</td>
                    </tr>
                    <tr>
                        <td><strong>Visit Metrics</strong></td>
                        <td>
                            <ul class="mb-0 ml-0">
                                <li>Pages viewed</li>
                                <li>Time on site</li>
                                <li>Visit count</li>
                                <li>Last visit timestamp</li>
                            </ul>
                        </td>
                        <td>Understand user behavior, improve content and navigation</td>
                    </tr>
                    <tr>
                        <td><strong>Geolocation</strong></td>
                        <td>Country, state/region, city (derived from IP address)</td>
                        <td>
                            <ul class="mb-0 ml-0">
                                <li>Understand geographic reach</li>
                                <li>Target outreach efforts</li>
                                <li>Regional analytics</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>

            <h3>1.3 Communication Data</h3>
            <p>When you contact us via email or contact forms, we collect:</p>
            <ul>
                <li>Your name and email address</li>
                <li>Message content</li>
                <li>Date and time of communication</li>
                <li>Any attachments you provide</li>
            </ul>

            <h2>2. How We Use Your Information</h2>

            <h3>2.1 Primary Uses</h3>
            <p>We use your personal information for the following specific purposes:</p>

            <h4>Application Processing</h4>
            <ul>
                <li>Review and evaluate scholarship applications</li>
                <li>Verify eligibility criteria (indigene status, academic performance, financial need)</li>
                <li>Conduct background checks and verification</li>
                <li>Make scholarship award decisions</li>
                <li>Track application status and progress</li>
            </ul>

            <h4>Scholarship Administration</h4>
            <ul>
                <li>Manage scholarship awards and disbursements</li>
                <li>Monitor academic performance of scholars</li>
                <li>Track graduation and program completion</li>
                <li>Coordinate mentorship programs</li>
                <li>Evaluate program effectiveness</li>
            </ul>

            <h4>Communication</h4>
            <ul>
                <li>Send application status updates</li>
                <li>Provide important program announcements</li>
                <li>Request additional documentation when needed</li>
                <li>Share scholarship opportunities and deadlines</li>
                <li>Conduct surveys and gather feedback</li>
                <li>Respond to inquiries and support requests</li>
            </ul>

            <h4>Analytics and Improvement</h4>
            <ul>
                <li>Analyze website traffic patterns</li>
                <li>Understand user demographics and geographic reach</li>
                <li>Identify technical issues and improve website performance</li>
                <li>Optimize content based on user behavior</li>
                <li>Generate reports on program impact and reach</li>
            </ul>

            <h4>Legal and Security</h4>
            <ul>
                <li>Comply with legal obligations</li>
                <li>Prevent fraud and unauthorized access</li>
                <li>Protect against security threats</li>
                <li>Maintain data integrity and accuracy</li>
                <li>Enforce our terms and conditions</li>
            </ul>

            <h3>2.2 Website Visitor Data Usage</h3>
            <p>Our visitor tracking system specifically uses collected data to:</p>
            <ul>
                <li><strong>Geographic Analysis:</strong> Understand where our visitors come from (country, state, city) to assess program reach and plan outreach activities</li>
                <li><strong>Traffic Patterns:</strong> Identify peak usage times, popular pages, and user journey paths</li>
                <li><strong>Performance Monitoring:</strong> Detect slow page loads, errors, or technical issues affecting specific browsers or devices</li>
                <li><strong>Security:</strong> Identify and block suspicious activity, DDoS attacks, or unauthorized access attempts</li>
                <li><strong>ROI Measurement:</strong> Measure effectiveness of outreach campaigns and referral sources</li>
            </ul>

            <div class="highlight-box">
                <p class="font-semibold mb-2"><i class="fas fa-ban mr-2"></i>What We DON'T Do With Visitor Data</p>
                <ul class="mb-0">
                    <li>We do NOT track your personal browsing history outside our website</li>
                    <li>We do NOT share visitor data with advertisers or marketing companies</li>
                    <li>We do NOT use visitor data for targeted advertising</li>
                    <li>We do NOT link anonymous visitor data to your personal application data without your consent</li>
                </ul>
            </div>

            <h2>3. How We Share Your Information</h2>

            <h3>3.1 Limited Sharing</h3>
            <p>We share your information only in the following circumstances:</p>

            <h4>With Your Consent</h4>
            <p>We may share your information with third parties when you explicitly give us permission to do so, such as:</p>
            <ul>
                <li>Publishing success stories (with your written consent)</li>
                <li>Sharing achievements with educational institutions</li>
                <li>Connecting you with mentors or alumni</li>
            </ul>

            <h4>Service Providers</h4>
            <p>We work with trusted third-party service providers who help us operate our platform:</p>
            <ul>
                <li><strong>Email Service:</strong> For sending application updates and notifications</li>
                <li><strong>Cloud Storage:</strong> For secure document storage and backup</li>
                <li><strong>Payment Processors:</strong> For scholarship disbursements (only necessary financial information)</li>
                <li><strong>Analytics Services:</strong> For website traffic analysis (anonymized data only)</li>
            </ul>
            <p>All service providers are bound by confidentiality agreements and are prohibited from using your data for any purpose other than providing services to us.</p>

            <h4>Educational Institutions</h4>
            <p>With your consent, we may share relevant information with:</p>
            <ul>
                <li>Your university for verification of enrollment and academic performance</li>
                <li>JAMB or other examination bodies for result verification</li>
                <li>Local government authorities for indigene verification</li>
            </ul>

            <h4>Legal Requirements</h4>
            <p>We may disclose your information if required by law, court order, or government regulation, or if we believe disclosure is necessary to:</p>
            <ul>
                <li>Comply with legal processes</li>
                <li>Protect the rights, property, or safety of our organization, users, or the public</li>
                <li>Investigate fraud or security issues</li>
                <li>Respond to emergency situations</li>
            </ul>

            <h3>3.2 What We Never Share</h3>
            <p><strong>We will NEVER:</strong></p>
            <ul>
                <li>Sell your personal information to third parties</li>
                <li>Share your information with marketing companies for advertising purposes</li>
                <li>Rent or lease your contact information to other organizations</li>
                <li>Share sensitive documents (exam results, financial information) without your explicit consent</li>
            </ul>

            <h2>4. Data Security</h2>

            <h3>4.1 Security Measures</h3>
            <p>We implement comprehensive security measures to protect your data:</p>

            <h4>Technical Security</h4>
            <ul>
                <li><strong>Encryption:</strong> All data transmissions use HTTPS/TLS encryption</li>
                <li><strong>Password Security:</strong> Passwords are hashed using industry-standard bcrypt algorithm</li>
                <li><strong>Two-Factor Authentication:</strong> Optional 2FA available for enhanced account security</li>
                <li><strong>Database Security:</strong> Encrypted database storage with restricted access</li>
                <li><strong>Secure File Storage:</strong> Uploaded documents are stored in encrypted cloud storage</li>
                <li><strong>Regular Security Audits:</strong> Periodic vulnerability assessments and penetration testing</li>
            </ul>

            <h4>Administrative Security</h4>
            <ul>
                <li><strong>Access Controls:</strong> Role-based access - only authorized administrators can view sensitive data</li>
                <li><strong>Audit Logs:</strong> All data access is logged and monitored</li>
                <li><strong>Employee Training:</strong> Staff members receive privacy and security training</li>
                <li><strong>Confidentiality Agreements:</strong> All team members sign non-disclosure agreements</li>
            </ul>

            <h4>Physical Security</h4>
            <ul>
                <li>Servers hosted in secure, certified data centers</li>
                <li>Regular backups stored in geographically distributed locations</li>
                <li>Disaster recovery and business continuity plans in place</li>
            </ul>

            <h3>4.2 Your Responsibility</h3>
            <p>You can help protect your information by:</p>
            <ul>
                <li>Using a strong, unique password</li>
                <li>Enabling two-factor authentication</li>
                <li>Not sharing your login credentials with others</li>
                <li>Logging out after using shared computers</li>
                <li>Reporting suspicious activity immediately</li>
            </ul>

            <h2>5. Data Retention</h2>

            <h3>5.1 How Long We Keep Your Data</h3>
            <p>We retain your information for different periods depending on the type of data:</p>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Data Type</th>
                        <th>Retention Period</th>
                        <th>Reason</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Account Information</strong></td>
                        <td>Active accounts: indefinitely<br>Inactive: 5 years after last login</td>
                        <td>Support returning users; comply with record-keeping requirements</td>
                    </tr>
                    <tr>
                        <td><strong>Application Data</strong></td>
                        <td>7 years after application submission</td>
                        <td>Program evaluation, audit trails, legal compliance</td>
                    </tr>
                    <tr>
                        <td><strong>Scholar Records</strong></td>
                        <td>10 years after graduation</td>
                        <td>Alumni relations, impact measurement, verification requests</td>
                    </tr>
                    <tr>
                        <td><strong>Visitor Tracking Data</strong></td>
                        <td>2 years</td>
                        <td>Analytical trends; older data loses relevance</td>
                    </tr>
                    <tr>
                        <td><strong>Email Communications</strong></td>
                        <td>3 years</td>
                        <td>Reference and dispute resolution</td>
                    </tr>
                    <tr>
                        <td><strong>Financial Records</strong></td>
                        <td>7 years</td>
                        <td>Tax and audit requirements</td>
                    </tr>
                </tbody>
            </table>

            <h3>5.2 Data Deletion</h3>
            <p>When data is deleted:</p>
            <ul>
                <li>It is permanently removed from active databases</li>
                <li>Backups containing deleted data are purged within 90 days</li>
                <li>Some anonymized statistical data may be retained for research</li>
            </ul>

            <h2>6. Your Rights and Choices</h2>

            <h3>6.1 Access and Control</h3>
            <p>You have the following rights regarding your personal information:</p>

            <h4>Right to Access</h4>
            <p>You can request a copy of all personal information we hold about you. We will provide this within 30 days at no charge.</p>

            <h4>Right to Correction</h4>
            <p>You can update or correct inaccurate information through your account dashboard or by contacting us.</p>

            <h4>Right to Deletion</h4>
            <p>You can request deletion of your personal information, subject to certain exceptions:</p>
            <ul>
                <li>We may retain data required by law or for legitimate business purposes</li>
                <li>Scholar records may be retained for program evaluation even after deletion requests</li>
                <li>Anonymized data may be retained for statistical purposes</li>
            </ul>

            <h4>Right to Data Portability</h4>
            <p>You can request a copy of your data in a machine-readable format (CSV, JSON) for transfer to another service.</p>

            <h4>Right to Restrict Processing</h4>
            <p>You can request that we limit how we use your information in certain circumstances.</p>

            <h4>Right to Object</h4>
            <p>You can object to certain uses of your information, such as:</p>
            <ul>
                <li>Marketing communications (opt-out anytime)</li>
                <li>Non-essential data processing</li>
            </ul>

            <h3>6.2 How to Exercise Your Rights</h3>
            <p>To exercise any of these rights:</p>
            <ul>
                <li>Email us at: <a href="mailto:olasunkanmiarowolo@gmail.com" class="text-primary font-semibold">olasunkanmiarowolo@gmail.com</a></li>
                <li>Subject line: "Privacy Rights Request"</li>
                <li>Include your full name and email associated with your account</li>
                <li>Specify which right you wish to exercise</li>
            </ul>
            <p>We will respond within 30 days. For security, we may ask you to verify your identity before processing requests.</p>

            <h2>7. Cookies and Tracking Technologies</h2>

            <h3>7.1 What We Use</h3>
            <p>Our website uses the following technologies:</p>

            <h4>Essential Cookies</h4>
            <ul>
                <li><strong>Session Cookies:</strong> Required for login functionality and form submissions</li>
                <li><strong>Security Cookies:</strong> Used for authentication and CSRF protection</li>
                <li>These cannot be disabled as they're necessary for the site to function</li>
            </ul>

            <h4>Analytics Cookies</h4>
            <ul>
                <li>Track page views, session duration, and navigation paths</li>
                <li>Help us understand how users interact with our site</li>
                <li>Data is aggregated and anonymized</li>
            </ul>

            <h3>7.2 Your Cookie Choices</h3>
            <p>You can control cookies through your browser settings:</p>
            <ul>
                <li>Block all cookies (may affect site functionality)</li>
                <li>Delete existing cookies</li>
                <li>Set preferences for specific sites</li>
            </ul>

            <h2>8. Third-Party Links</h2>

            <p>Our website may contain links to external sites (universities, government portals, partner organizations). We are not responsible for the privacy practices of these sites. We encourage you to review their privacy policies before providing any personal information.</p>

            <h2>9. Children's Privacy</h2>

            <p>Our scholarship program targets high school graduates (typically 18+). We do not knowingly collect information from individuals under 18 without parental consent. If you are under 18:</p>
            <ul>
                <li>You must have a parent or guardian create your account</li>
                <li>A parent/guardian must review and approve this privacy policy</li>
                <li>We require parental contact information for verification</li>
            </ul>
            <p>If we discover we've collected data from someone under 18 without proper consent, we will delete it immediately.</p>

            <h2>10. International Users</h2>

            <p>While our scholarship primarily serves Iba Town indigenes, our website is accessible globally. Please note:</p>
            <ul>
                <li>Data is processed and stored in Nigeria</li>
                <li>By using our services, you consent to data transfer to Nigeria</li>
                <li>We comply with applicable Nigerian data protection laws</li>
                <li>International users retain the rights described in this policy</li>
            </ul>

            <h2>11. Changes to This Privacy Policy</h2>

            <p>We may update this Privacy Policy periodically to reflect:</p>
            <ul>
                <li>Changes in our data practices</li>
                <li>New features or services</li>
                <li>Legal or regulatory requirements</li>
                <li>User feedback and best practices</li>
            </ul>

            <p>When we make changes:</p>
            <ul>
                <li>We will update the "Last Updated" date at the top</li>
                <li>Material changes will be announced via email</li>
                <li>We may display a notice on the website</li>
                <li>Continued use after changes constitutes acceptance</li>
            </ul>

            <p>We encourage you to review this policy regularly to stay informed about how we protect your information.</p>

            <h2>12. Contact Us</h2>

            <p>If you have questions, concerns, or requests regarding this Privacy Policy or our data practices, please contact us:</p>

            <div class="info-box">
                <p class="font-semibold mb-3 text-sm sm:text-base"><i class="fas fa-envelope mr-2"></i>Privacy Inquiries</p>
                <p class="text-sm sm:text-base"><strong>Email:</strong> <a href="mailto:olasunkanmiarowolo@gmail.com" class="text-primary font-semibold">olasunkanmiarowolo@gmail.com</a></p>
                <p class="text-sm sm:text-base"><strong>Subject Line:</strong> "Privacy Policy Inquiry"</p>
                <p class="text-sm sm:text-base"><strong>Response Time:</strong> We aim to respond within 5 business days</p>
                <p class="mb-0 text-sm sm:text-base"><strong>Address:</strong> Ola Arowolo Scholarship Program, Iba Town, Lagos State, Nigeria</p>
            </div>

            <h2>13. Consent</h2>

            <p>By using our website and services, you acknowledge that:</p>
            <ul>
                <li>You have read and understood this Privacy Policy</li>
                <li>You consent to the collection, use, and sharing of your information as described</li>
                <li>You understand your rights and how to exercise them</li>
                <li>You agree to our data processing practices</li>
            </ul>

            <p>If you do not agree with any part of this policy, please do not use our services.</p>

            <hr>

            <div class="text-center mt-6 sm:mt-8">
                <p class="text-xs sm:text-sm text-gray-500 mb-3 sm:mb-4">This Privacy Policy is effective as of December 7, 2025</p>
                <a href="{{ route('home') }}" class="btn-back inline-flex items-center text-sm sm:text-base">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Return to Home
                </a>
            </div>

        </div>
    </main>
@endsection