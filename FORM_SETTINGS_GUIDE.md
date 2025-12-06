# Form Settings and Countdown Timer Integration

## Overview

The form settings system allows administrators to control when forms are open for submissions through the admin dashboard. The countdown timer on the homepage automatically syncs with these settings to display accurate open/close times and enable/disable application buttons accordingly.

## How It Works

### 1. Admin Dashboard Form Settings (`/admin/form-settings`)

Administrators can configure each form with:

-   **Form Name**: Identifier for the form (e.g., `application_form`)
-   **Is Open**: Manual toggle to open/close the form
-   **Opens At**: Date and time when the form should automatically open
-   **Closes At**: Date and time when the form should automatically close
-   **Closed Message**: Custom message displayed when form is closed

### 2. Database Model (`app/Models/FormSetting.php`)

The `FormSetting` model includes:

-   `isCurrentlyOpen()`: Checks if form is open based on:
    -   Manual `is_open` toggle
    -   Current time vs `opens_at` date
    -   Current time vs `closes_at` date

### 3. API Endpoint (`/api/form-settings/{formName}`)

Returns JSON with form status:

```json
{
    "form_name": "application_form",
    "is_open": true,
    "is_currently_open": false,
    "opens_at": "2025-12-08T00:00:00+00:00",
    "closes_at": "2026-01-16T23:59:59+00:00",
    "closed_message": "The Scholarship Application Form is currently closed..."
}
```

### 4. Countdown Timer (`resources/views/components/header.blade.php`)

The homepage header:

-   Fetches form settings from the API every page load
-   Updates countdown every second
-   Shows different states:
    -   **Before Opens**: Countdown to opening date, button hidden
    -   **Open Period**: Countdown to closing date, button enabled with "NOW"
    -   **After Closed**: "Applications Closed" message, button disabled
    -   **Manually Closed**: Custom closed message, button disabled

### 5. Form Protection Middleware (`app/Http/Middleware/CheckFormOpen.php`)

-   Protects application form routes
-   Redirects users if form is closed
-   Shows custom closed message from admin settings
-   Works for both web and API requests

### 6. Routes Protected

```php
// All these routes check if application_form is open
Route::get('/apply-form')->middleware(['form.open:application_form']);
Route::get('/apply-utme-jamb-form')->middleware(['form.open:application_form']);
Route::post('/apply-form')->middleware(['form.open:application_form']);
```

## Usage Instructions

### For Administrators

#### Opening the Application Form

1. Navigate to `/admin/form-settings`
2. Find "Application Form" card
3. Check "Form is Open"
4. Set "Opens At" date (e.g., December 8, 2025 at 00:00)
5. Set "Closes At" date (e.g., January 16, 2026 at 23:59)
6. Optionally customize "Closed Message"
7. Click "Update Settings"

#### Closing the Form Early

1. Go to `/admin/form-settings`
2. Uncheck "Form is Open" for the application form
3. The form will immediately close regardless of dates
4. Users will see the custom closed message

#### Extending the Deadline

1. Edit "Closes At" date to a later time
2. The countdown timer will automatically update
3. Users will see the new countdown

### For Developers

#### Adding New Forms

```php
// In admin dashboard
$formSetting = FormSetting::create([
    'form_name' => 'new_form',
    'is_open' => false,
    'opens_at' => Carbon::parse('2025-12-15 00:00:00'),
    'closes_at' => Carbon::parse('2026-01-31 23:59:59'),
    'closed_message' => 'This form is currently closed.',
]);
```

#### Protecting Routes

```php
Route::get('/your-form', function () {
    return view('your-form');
})->middleware(['auth', 'form.open:your_form_name']);
```

#### Checking Form Status Programmatically

```php
$formSetting = FormSetting::getByName('application_form');

if ($formSetting->isCurrentlyOpen()) {
    // Form is open
} else {
    // Form is closed
}
```

## Files Modified/Created

### Created

-   `app/Http/Middleware/CheckFormOpen.php` - Middleware to check form status
-   `database/seeders/FormSettingsSeeder.php` - Seed default form settings

### Modified

-   `routes/web.php` - Added API endpoint and middleware to routes
-   `app/Http/Controllers/ApplicationController.php` - Added `getFormSettings()` method
-   `resources/views/components/header.blade.php` - Dynamic countdown with API integration
-   `resources/views/home.blade.php` - Added error message display
-   `bootstrap/app.php` - Registered form.open middleware

## Default Settings

The seeder (`FormSettingsSeeder`) sets:

-   **Application Form**:
    -   Opens: December 8, 2025 at 00:00
    -   Closes: January 16, 2026 at 23:59
    -   Status: Open
-   **Other Forms**: All closed by default

Run seeder:

```bash
php artisan db:seed --class=FormSettingsSeeder
```

## Benefits

1. **No Code Changes Needed**: Admins control dates without developer intervention
2. **Real-time Updates**: Countdown syncs with database settings
3. **Security**: Middleware prevents access even if users bypass frontend
4. **Flexibility**: Manual override allows closing forms instantly
5. **User Experience**: Clear messaging about form availability
6. **Custom Messages**: Admins can customize closed messages per form

## Testing

### Test Form Closed State

1. Set `is_open = false` in admin settings
2. Visit homepage - should see closed message
3. Try accessing `/apply-form` - should redirect with error

### Test Countdown Timer

1. Set `opens_at` to a future date
2. Homepage should show countdown to opening
3. Application button should be hidden

### Test Form Open State

1. Set current time between `opens_at` and `closes_at`
2. Set `is_open = true`
3. Homepage should show countdown to closing
4. Application button should be enabled

## API Response Example

```bash
curl http://localhost:8001/api/form-settings/application_form
```

Response:

```json
{
    "form_name": "application_form",
    "is_open": true,
    "is_currently_open": false,
    "opens_at": "2025-12-08T00:00:00+00:00",
    "closes_at": "2026-01-16T23:59:59+00:00",
    "closed_message": "The Scholarship Application Form is currently closed. Please check back later for the next application period."
}
```

## Troubleshooting

### Countdown Not Updating

-   Clear browser cache and reload page
-   Check browser console for JavaScript errors
-   Verify API endpoint returns correct data

### Forms Not Closing

-   Check `is_open` is set to true
-   Verify dates are in correct timezone
-   Ensure middleware is attached to routes

### Users Can Still Access Closed Forms

-   Clear Laravel cache: `php artisan cache:clear`
-   Clear route cache: `php artisan route:clear`
-   Verify middleware is registered in `bootstrap/app.php`
