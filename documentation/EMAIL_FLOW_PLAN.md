# Email Flow Plan - Iba Kingdom Scholarship System

## Email Configuration

### Current Setup

-   **SMTP Server:** Gmail (smtp.gmail.com:587)
-   **Sender Account:** oatutors@gmail.com (technical sender)
-   **From Address:** oatutors@gmail.com
-   **Reply-To Address:** scholarship@olaarowolo.com (public-facing address)
-   **Admin Address:** oatutors@gmail.com

### Why This Configuration?

1. **oatutors@gmail.com** sends emails (technical/system account)
2. **scholarship@olaarowolo.com** receives replies (professional/public address)
3. Users see "From: Iba Kingdom Scholarship" but replies go to scholarship@olaarowolo.com
4. Admin notifications go to oatutors@gmail.com for monitoring

---

## Recommended Email Flows

### 1. Contact Form Submission ✅ (IMPLEMENTED)

**Trigger:** User submits contact form

**Flow:**

```
User submits form
    ↓
Send to: oatutors@gmail.com (admin)
From: oatutors@gmail.com
Reply-To: user's email address
Subject: "Contact Form Submission from [User Name]"
Content: Name, email, message from user
```

**Status:** ✅ Working
**Purpose:** Admin receives inquiry, can reply directly to user

---

### 2. Application Submission - Applicant Notification ⚠️ (NEEDS IMPLEMENTATION)

**Trigger:** User successfully submits scholarship application

**Flow:**

```
Application submitted
    ↓
Send to: applicant's email
From: oatutors@gmail.com
Reply-To: scholarship@olaarowolo.com
Subject: "Your Scholarship Application Has Been Received - [Application ID]"
Content:
  - Confirmation of submission
  - Application ID
  - Summary of submitted information
  - Next steps
  - Expected timeline
  - Contact information
```

**Implementation:**

```php
// In ApplicationController::submit() after saving application
Mail::to($user->email)->send(new ApplicationSubmitted($application));
```

**Priority:** 🔴 HIGH

---

### 3. Application Submission - Admin Notification ⚠️ (NEEDS IMPLEMENTATION)

**Trigger:** New application submitted

**Flow:**

```
Application submitted
    ↓
Send to: oatutors@gmail.com (admin)
From: oatutors@gmail.com
Reply-To: applicant's email
Subject: "New Scholarship Application Received - [Applicant Name]"
Content:
  - Applicant details
  - Application ID
  - Key information summary
  - Link to admin dashboard
  - Quick action buttons
```

**Implementation:**

```php
// In ApplicationController::submit() after saving application
Mail::to(config('mail.admin.address'))->send(new ApplicationSubmittedAdmin($application));
```

**Priority:** 🔴 HIGH

---

### 4. New Account Credentials Email ⚠️ (NEEDS IMPLEMENTATION)

**Trigger:** Guest submits application, account auto-created

**Flow:**

```
Account auto-created for guest applicant
    ↓
Send to: applicant's email
From: oatutors@gmail.com
Reply-To: scholarship@olaarowolo.com
Subject: "Your Scholarship Portal Account - Login Credentials"
Content:
  - Welcome message
  - Email address (username)
  - Generated password
  - Login URL
  - Instructions to change password
  - Security notice
```

**Implementation:**

```php
// In ApplicationController::submit() after creating user
Mail::to($user->email)->send(new WelcomeCredentials($user, $password, $applicationId));
```

**Priority:** 🔴 HIGH
**Security Note:** Use secure password generation, encourage immediate password change

---

### 5. Application Status Update - Approved ⚠️ (NEEDS IMPLEMENTATION)

**Trigger:** Admin approves application

**Flow:**

```
Admin approves application
    ↓
Send to: applicant's email
From: oatutors@gmail.com
Reply-To: scholarship@olaarowolo.com
Subject: "Congratulations! Your Scholarship Application Has Been Approved"
Content:
  - Congratulations message
  - Application ID
  - Award details
  - Next steps
  - Required documentation
  - Contact for questions
```

**Implementation:**

```php
// In AdminController::updateApplicationStatus() when status = 'approved'
Mail::to($application->user->email)->send(new ApplicationApproved($application));
```

**Priority:** 🟡 MEDIUM

---

### 6. Application Status Update - Rejected ⚠️ (NEEDS IMPLEMENTATION)

**Trigger:** Admin rejects application

**Flow:**

```
Admin rejects application
    ↓
Send to: applicant's email
From: oatutors@gmail.com
Reply-To: scholarship@olaarowolo.com
Subject: "Update on Your Scholarship Application"
Content:
  - Professional rejection message
  - Application ID
  - Reason (if applicable)
  - Encouragement to reapply
  - Alternative resources
  - Contact for questions
```

**Implementation:**

```php
// In AdminController::updateApplicationStatus() when status = 'rejected'
Mail::to($application->user->email)->send(new ApplicationRejected($application));
```

**Priority:** 🟡 MEDIUM

---

### 7. Scholar Academic Standing Submission ⚠️ (NEEDS IMPLEMENTATION)

**Trigger:** Scholar submits academic standing report

**Flow:**

```
Scholar submits academic report
    ↓
Send to: oatutors@gmail.com (admin)
From: oatutors@gmail.com
Reply-To: scholar's email
Subject: "Academic Standing Report Received - [Scholar Name]"
Content:
  - Scholar information
  - Report details
  - Uploaded files list
  - Review link
  - Action required notice
```

**Confirmation to Scholar:**

```
Send to: scholar's email
From: oatutors@gmail.com
Reply-To: scholarship@olaarowolo.com
Subject: "Academic Standing Report Received"
Content:
  - Confirmation of submission
  - What happens next
  - Expected response time
```

**Priority:** 🟡 MEDIUM

---

### 8. Scholar Support Request ⚠️ (NEEDS IMPLEMENTATION)

**Trigger:** Scholar submits request for support

**Flow:**

```
Scholar creates support request
    ↓
Send to: oatutors@gmail.com (admin)
From: oatutors@gmail.com
Reply-To: scholar's email
Subject: "Scholar Support Request - [Request Type]"
Content:
  - Scholar information
  - Request type and details
  - Urgency level
  - Action required
```

**Confirmation to Scholar:**

```
Send to: scholar's email
From: oatutors@gmail.com
Reply-To: scholarship@olaarowolo.com
Subject: "Your Support Request Has Been Received"
Content:
  - Confirmation message
  - Request reference number
  - Expected response time
  - Emergency contact (if urgent)
```

**Priority:** 🟡 MEDIUM

---

### 9. Password Reset ✅ (LARAVEL DEFAULT)

**Trigger:** User requests password reset

**Flow:**

```
User clicks "Forgot Password"
    ↓
Send to: user's email
From: oatutors@gmail.com
Reply-To: scholarship@olaarowolo.com
Subject: "Reset Password Notification"
Content:
  - Password reset link
  - Link expiration time
  - Security notice
  - Contact if not requested
```

**Status:** ✅ Laravel handles this by default
**Priority:** ✅ COMPLETE

---

### 10. Email Verification ✅ (LARAVEL DEFAULT)

**Trigger:** New user registration (if enabled)

**Flow:**

```
User registers account
    ↓
Send to: user's email
From: oatutors@gmail.com
Reply-To: scholarship@olaarowolo.com
Subject: "Verify Your Email Address"
Content:
  - Verification link
  - Link expiration time
  - Importance of verification
```

**Status:** ✅ Laravel handles this by default
**Priority:** 🟢 LOW (currently not enforced)

---

## Email Templates to Create

### High Priority

1. ✅ `ApplicationSubmitted.php` - EXISTS, needs triggering
2. ❌ `ApplicationSubmittedAdmin.php` - EXISTS but incomplete
3. ❌ `WelcomeCredentials.php` - Create new
4. ❌ `ApplicationApproved.php` - Create new
5. ❌ `ApplicationRejected.php` - Create new

### Medium Priority

6. ❌ `ScholarReportSubmitted.php` - Create new
7. ❌ `ScholarReportConfirmation.php` - Create new
8. ❌ `ScholarSupportRequest.php` - Create new
9. ❌ `ScholarSupportConfirmation.php` - Create new

### Optional/Future

10. ❌ `ApplicationInReview.php` - Status update
11. ❌ `DocumentsRequested.php` - Request additional docs
12. ❌ `ScholarshipReminder.php` - Deadline reminders
13. ❌ `MonthlyNewsletter.php` - Updates to scholars

---

## Implementation Priority

### Phase 1: Critical (Do First) 🔴

1. **Fix ApplicationSubmittedAdmin** - Complete the template
2. **Trigger ApplicationSubmitted** - Send confirmation to applicant
3. **Trigger ApplicationSubmittedAdmin** - Notify admin of new applications
4. **Create & Trigger WelcomeCredentials** - Send login info to new users

### Phase 2: Important (Do Next) 🟡

5. **Create ApplicationApproved** - Notify approved applicants
6. **Create ApplicationRejected** - Notify rejected applicants
7. **Create Scholar notification emails** - For academic reports and support requests

### Phase 3: Enhancement (Do Later) 🟢

8. **Reminder emails** - Application deadlines, document submissions
9. **Bulk notifications** - Announcements to all scholars/applicants
10. **Email preferences** - Allow users to customize notifications

---

## Email Queue Strategy

### Current: Synchronous (Blocking)

-   Emails sent immediately during request
-   User waits for email to send
-   Can slow down response time

### Recommended: Queue-Based (Async)

```php
// In Mailable class
class ApplicationSubmitted extends Mailable implements ShouldQueue
{
    use Queueable;
    // ...
}
```

**Benefits:**

-   Faster user experience
-   Retry failed emails automatically
-   Better error handling
-   Scale better under load

**Setup:**

```bash
php artisan queue:table
php artisan migrate
php artisan queue:work
```

**Priority:** 🟡 MEDIUM (implement after basic emails working)

---

## Testing Strategy

### Local Development

```env
MAIL_MAILER=log
```

Emails saved to `storage/logs/laravel.log`

### Staging/Testing

```env
MAIL_MAILER=smtp
```

Use test Gmail account or Mailtrap.io

### Production

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
```

Use actual Gmail account with App Password

---

## Monitoring & Analytics

### Track These Metrics

1. Email delivery rate
2. Bounce rate
3. Open rate (if tracking pixels added)
4. Click-through rate on action buttons
5. Time to send
6. Queue backlog

### Tools to Consider

-   Laravel Horizon (for queue monitoring)
-   Mail logs (storage/logs)
-   Gmail sent folder audit
-   Third-party service (SendGrid, Mailgun) for better analytics

---

## Security Best Practices

1. ✅ Use app-specific password for Gmail (not main password)
2. ✅ Use TLS encryption (port 587)
3. ⚠️ Don't send passwords in plain text (use reset links instead)
4. ⚠️ Implement rate limiting on email sending
5. ⚠️ Add unsubscribe links (for newsletter emails)
6. ⚠️ Validate email addresses before sending
7. ⚠️ Log all email sending activity

---

## Cost Considerations

### Gmail Free Tier Limits

-   500 emails/day (per account)
-   2,000 emails/day (Google Workspace)

### If Volume Exceeds Gmail Limits

Consider these alternatives:

1. **SendGrid** - 100 emails/day free, then $19.95/month for 50k
2. **Mailgun** - 5,000 emails/month free, then pay-as-you-go
3. **Amazon SES** - $0.10 per 1,000 emails
4. **Postmark** - $15/month for 10k emails

**Current Volume Estimate:**

-   Average 5-10 applications/day = 20-40 emails/day
-   Well within Gmail limits
-   Monitor and upgrade if needed

---

## Next Steps

### Immediate Actions

1. ✅ Update .env with reply-to configuration
2. ✅ Update mail config with reply_to and admin settings
3. ✅ Update ContactMail with reply-to header
4. ❌ Fix ApplicationSubmittedAdmin template
5. ❌ Trigger emails in ApplicationController
6. ❌ Create WelcomeCredentials mailable
7. ❌ Test all email flows

### Commands to Run

```bash
# Test contact form email
php artisan tinker
Mail::to('test@example.com')->send(new ContactMail(['name' => 'Test', 'email' => 'user@test.com', 'message' => 'Hello']));

# View mail logs
tail -f storage/logs/laravel.log

# Test queue (when implemented)
php artisan queue:work --once
```

---

## Configuration Summary

### Environment Variables Required

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=oatutors@gmail.com
MAIL_PASSWORD="vtql hzsc kgaw ikmg"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=oatutors@gmail.com
MAIL_FROM_NAME="Iba Kingdom Scholarship"
MAIL_REPLY_TO_ADDRESS=scholarship@olaarowolo.com
MAIL_REPLY_TO_NAME="Iba Kingdom Scholarship"
MAIL_ADMIN_ADDRESS=oatutors@gmail.com
```

### Config Access Patterns

```php
// Send to admin
Mail::to(config('mail.admin.address'))

// Set reply-to from config
'replyTo' => [
    config('mail.reply_to.address') => config('mail.reply_to.name')
]

// Send to user with reply-to
Mail::to($user->email)
    ->send(new SomeMailable());
```
