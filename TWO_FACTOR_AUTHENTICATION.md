# Two-Factor Authentication (2FA) Implementation

## Overview
This document describes the implementation of email-based two-factor authentication (2FA) for the scholarship application system.

## Features Implemented

### 1. Database Schema
**Migration:** `database/migrations/2025_12_06_121658_add_two_factor_columns_to_users_table.php`

Added three columns to the `users` table:
- `two_factor_enabled` (boolean, default: false) - Indicates if user has 2FA enabled
- `two_factor_code` (string, nullable) - Stores the current 6-digit verification code
- `two_factor_expires_at` (timestamp, nullable) - Expiration time for the code (10 minutes)

### 2. User Model Methods
**File:** `app/Models/User.php`

Added three methods to handle 2FA:

#### `generateTwoFactorCode(): string`
- Generates a random 6-digit code
- Sets expiration to 10 minutes from now
- Saves to database
- Returns the code

#### `verifyTwoFactorCode(string $code): bool`
- Validates the provided code against stored code
- Checks if code has expired
- Returns true if valid, false otherwise

#### `resetTwoFactorCode(): void`
- Clears the 2FA code and expiration
- Called after successful verification or when disabling 2FA

### 3. Email Notification
**Mailable:** `app/Mail/TwoFactorCode.php`
**Template:** `resources/views/emails/two-factor-code.blade.php`

Sends a beautifully designed email with:
- Large, prominent 6-digit code
- Expiration warning (10 minutes)
- Security tips
- Professional gradient design matching the brand

### 4. Middleware
**File:** `app/Http/Middleware/EnsureTwoFactorVerified.php`

Protects routes by checking:
1. If user has 2FA enabled
2. If current session is verified (via session key: `two_factor_verified_{user_id}`)
3. Redirects to verification page if needed

**Registered as:** `two-factor` middleware alias in `bootstrap/app.php`

### 5. Controller
**File:** `app/Http/Controllers/TwoFactorController.php`

#### Routes & Methods:

**GET `/two-factor/verify`** → `show()`
- Displays verification form
- Auto-redirects if 2FA not enabled

**POST `/two-factor/verify`** → `verify()`
- Validates 6-digit code
- Verifies against User model
- Sets session flag on success
- Redirects to intended page (dashboard)

**POST `/two-factor/resend`** → `resend()`
- Generates new code
- Sends fresh email
- Useful if code expired or lost

**GET `/two-factor/settings`** → `settings()`
- Settings page to enable/disable 2FA
- Shows current status and instructions

**POST `/two-factor/toggle`** → `toggle()`
- Enables or disables 2FA
- Sends initial code when enabling
- Clears session verification when disabling

### 6. Authentication Flow
**File:** `app/Http/Controllers/Auth/AuthenticatedSessionController.php`

Modified `store()` method to:
1. Authenticate user normally
2. Check if user has 2FA enabled
3. If yes: Generate code, send email, redirect to verification
4. If no: Continue to dashboard normally

### 7. Views

#### Verification Page
**File:** `resources/views/auth/two-factor-verify.blade.php`

Features:
- Clean, centered form with gradient background
- Large input for 6-digit code
- Numeric keyboard on mobile (inputmode="numeric")
- Auto-focus on code input
- Resend code button
- Expiration reminder
- Error feedback

#### Settings Page
**File:** `resources/views/auth/two-factor-settings.blade.php`

Features:
- Visual status indicator (enabled/disabled badge)
- How it works explanation
- Enable/Disable toggle button
- Email address confirmation reminder
- Color-coded actions (purple for enable, red for disable)

### 8. Navigation
**File:** `resources/views/layouts/navigation.blade.php`

Added "Two-Factor Authentication" link to:
- Desktop dropdown menu
- Mobile responsive menu

### 9. Protected Routes
**File:** `routes/web.php`

Applied `two-factor` middleware to:
- `/dashboard`
- `/apply-form`
- `/apply-utme-jamb-form`
- All admin routes (`/admin/*`)
- All scholar routes (`/scholar/*`)

## User Experience Flow

### Enabling 2FA
1. User logs in normally
2. Navigates to "Two-Factor Authentication" in profile menu
3. Sees settings page with explanation
4. Clicks "Enable 2FA"
5. System generates code and sends email
6. User is redirected back with success message
7. Next login will require 2FA

### Login with 2FA Enabled
1. User enters email/password
2. System authenticates credentials
3. System detects 2FA is enabled
4. Generates 6-digit code
5. Sends code via email
6. Redirects to verification page
7. User enters code from email
8. System verifies code and expiration
9. Sets session flag for verification
10. Redirects to intended page (dashboard)

### Code Expiration
- Codes expire after 10 minutes
- User can request new code via "Resend Code" button
- Old code is invalidated when new one is generated

### Disabling 2FA
1. User navigates to settings
2. Clicks "Disable 2FA"
3. System clears 2FA code and session verification
4. User is notified of successful disable
5. Next login won't require 2FA

## Security Features

1. **Code Expiration:** 10-minute window prevents replay attacks
2. **Single-Use Codes:** Code is cleared after successful verification
3. **Session-Based:** Verification tied to specific session
4. **Email Delivery:** Code sent to registered email only
5. **Middleware Protection:** Critical routes protected automatically
6. **Optional Feature:** Users can choose to enable/disable

## Testing

All existing tests pass (81/81):
- User model tests updated with new fillable/casts
- No breaking changes to existing functionality
- 2FA is opt-in, doesn't affect existing users

## Files Created/Modified

### Created:
- `database/migrations/2025_12_06_121658_add_two_factor_columns_to_users_table.php`
- `app/Mail/TwoFactorCode.php`
- `app/Http/Middleware/EnsureTwoFactorVerified.php`
- `app/Http/Controllers/TwoFactorController.php`
- `resources/views/auth/two-factor-verify.blade.php`
- `resources/views/auth/two-factor-settings.blade.php`
- `resources/views/emails/two-factor-code.blade.php`

### Modified:
- `app/Models/User.php` - Added 2FA methods and fields
- `app/Http/Controllers/Auth/AuthenticatedSessionController.php` - Added 2FA check on login
- `bootstrap/app.php` - Registered middleware
- `routes/web.php` - Added routes and applied middleware
- `resources/views/layouts/navigation.blade.php` - Added navigation link
- `tests/Unit/UserTest.php` - Updated tests for new fields

## Configuration

### Mail Settings
Ensure your `.env` file has proper mail configuration:
```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@scholarship.olaarowolo.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Session Configuration
2FA verification relies on sessions. Ensure session driver is properly configured in `.env`:
```env
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

## Future Enhancements

Possible improvements:
1. SMS-based 2FA as alternative to email
2. Authenticator app support (TOTP)
3. Backup codes for account recovery
4. "Remember this device" option
5. IP-based restrictions
6. Activity log of 2FA attempts
7. Admin-enforced 2FA for sensitive roles
8. Rate limiting on code attempts

## Support

Users can:
- Resend codes if not received
- Check spam folders
- Disable 2FA if they lose email access (requires admin intervention)
- Contact support for assistance

## Conclusion

The 2FA implementation provides a balance between security and usability:
- **Optional:** Users choose to enable it
- **Email-based:** No additional apps required
- **Time-limited:** Codes expire for security
- **User-friendly:** Clear UI and instructions
- **Non-breaking:** Existing functionality unchanged
