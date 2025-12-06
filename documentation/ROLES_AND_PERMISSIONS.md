# Roles and Permissions

## Role-Based Access Control (RBAC)

### Available Roles

1. **admin** - System administrators
2. **review_team** - Application reviewers
3. **applicant** - Application submitters
4. **verified_beneficiary** - Verified scholarship recipients
5. **scholar** - Current scholars
6. **user** - Basic registered users

---

## Permissions by Role

### Admin (`admin`)

**Full System Access**

-   ✅ View admin dashboard
-   ✅ Manage all applications (view, approve, reject)
-   ✅ Manage users (create, update, delete, change roles)
-   ✅ Configure form settings (open/close application windows)
-   ✅ Access all reports and analytics
-   ✅ Manage system settings
-   ✅ View all user data
-   ✅ Send bulk communications

**Routes:**

-   `/admin/*` - All admin routes
-   `/dashboard` - Standard dashboard access

---

### Review Team (`review_team`)

**Application Review Access**

-   ✅ View assigned applications
-   ✅ Review application details
-   ✅ Add review comments
-   ✅ Recommend approval/rejection
-   ❌ Final approval (admin only)
-   ❌ User management
-   ❌ System settings

**Routes:**

-   `/review/*` - Review team routes
-   `/applications/review` - Application review interface

---

### Applicant (`applicant`)

**Application Submission**

-   ✅ Submit new scholarship applications
-   ✅ View own application status
-   ✅ Update pending applications
-   ✅ Upload required documents
-   ✅ Receive application notifications
-   ❌ View other users' applications
-   ❌ Admin functions

**Routes:**

-   `/apply-form` - Application form
-   `/apply-utme-jamb-form` - JAMB application form
-   `/dashboard` - Personal dashboard
-   `/profile` - Profile management

---

### Verified Beneficiary (`verified_beneficiary`)

**Beneficiary Portal Access**

-   ✅ View scholarship award details
-   ✅ Submit progress reports
-   ✅ Access beneficiary resources
-   ✅ Receive scholarship communications
-   ✅ View payment/disbursement status
-   ❌ Submit new applications
-   ❌ Scholar-specific features (use scholar role)

**Routes:**

-   `/beneficiary/*` - Beneficiary routes
-   `/dashboard` - Beneficiary dashboard

---

### Scholar (`scholar`)

**Scholar Portal Access**

-   ✅ Submit academic standing reports (with file uploads)
-   ✅ Request academic/financial support
-   ✅ Document challenges and issues
-   ✅ Book mentorship sessions
-   ✅ Ask for academic advice
-   ✅ Access scholar resources
-   ❌ Submit new scholarship applications
-   ❌ Admin functions

**Routes:**

-   `/scholar/*` - All scholar routes
-   `/scholar-login` - Scholar-specific login
-   `/scholar-register` - Scholar registration
-   Scholar Dashboard Features:
    -   `/scholar/requests` - Submit support requests
    -   `/scholar/academic-standing` - Submit academic progress (with files)
    -   `/scholar/challenges` - Document challenges
    -   `/scholar/mentorship` - Book mentorship
    -   `/scholar/advice` - Request academic advice
    -   `/scholar/resources` - Access resources

---

### User (`user`)

**Basic Access**

-   ✅ View public pages
-   ✅ Contact support
-   ✅ Update profile
-   ✅ Change password
-   ❌ Submit applications
-   ❌ Access special features
-   ❌ Admin functions

**Routes:**

-   `/dashboard` - Basic dashboard
-   `/profile` - Profile management
-   `/contact` - Contact form

---

## Middleware Implementation

### Authentication Middleware

```php
'auth' - Requires user to be logged in
'guest' - Only accessible when not logged in
```

### Role Middleware

```php
'role:admin' - Only admin users
'role:admin,review_team' - Admin or review team
'role:scholar' - Only scholars
```

### Custom Middleware

```php
'check.terms' - Ensures user has accepted terms
'form.open' - Checks if form is currently open
```

---

## Route Protection Examples

### Admin Routes

```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/form-settings', [AdminController::class, 'formSettings']);
});
```

### Scholar Routes

```php
Route::middleware(['auth', 'role:scholar'])->prefix('scholar')->group(function () {
    Route::get('/academic-standing', [ScholarController::class, 'academicStanding']);
    Route::post('/academic-standing', [ScholarController::class, 'submitAcademicStanding']);
});
```

### Application Routes

```php
Route::middleware(['auth', 'role:applicant,user'])->group(function () {
    Route::get('/apply-form', [ApplicationController::class, 'show']);
    Route::post('/apply-form', [ApplicationController::class, 'submit']);
});
```

---

## Implementation Checklist

### Phase 1: Core Role Middleware ✅

-   [x] Create role enum in User model
-   [x] Add role column to users table
-   [x] Create CheckRole middleware
-   [x] Register middleware in Kernel

### Phase 2: Route Protection

-   [ ] Apply role middleware to admin routes
-   [ ] Apply role middleware to scholar routes
-   [ ] Apply role middleware to review team routes
-   [ ] Apply role middleware to applicant routes
-   [ ] Test unauthorized access redirects

### Phase 3: UI Role-Based Display

-   [ ] Show/hide menu items based on role
-   [ ] Create role-specific dashboards
-   [ ] Add role badges to user profiles
-   [ ] Display appropriate error messages

### Phase 4: Permission Helpers

-   [ ] Create `@can('permission')` directives
-   [ ] Add `hasRole()` helper method
-   [ ] Add `hasPermission()` helper method
-   [ ] Create permission checking service

### Phase 5: Advanced Features

-   [ ] Role assignment UI in admin panel
-   [ ] Role-based email notifications
-   [ ] Audit log for role changes
-   [ ] Role-based data filtering

---

## Database Schema

### Users Table

```sql
- id
- name
- email
- password
- role (enum: admin, review_team, applicant, verified_beneficiary, scholar, user)
- email_verified_at
- remember_token
- created_at
- updated_at
```

### Future: Permissions Table (if needed)

```sql
- id
- role
- permission
- created_at
- updated_at
```

---

## Testing Roles

### Test Admin Access

```bash
# Login as admin
email: oa@olaarowolo.com
password: O@rowolo2021
```

### Test Scholar Access

```bash
# Login as scholar
email: scholar@demo.com
password: password
```

### Test Each Role

```bash
# Use demo accounts
applicant@demo.com
verified_beneficiary@demo.com
user@demo.com
scholar@demo.com
review_team@demo.com
```
