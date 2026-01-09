# API Documentation - Ola Arowolo Scholarship System

## Overview

This document provides comprehensive documentation for the Ola Arowolo Scholarship Management System API endpoints, including authentication, request/response formats, and error handling.

---

## Base URL

```
Development: http://localhost:8000
Production: https://scholarship.olaarowolo.com
```

---

## Authentication

### Authentication Methods

The system uses Laravel Sanctum/Session-based authentication with CSRF protection.

#### Required Headers

```http
Content-Type: application/json
Accept: application/json
X-CSRF-TOKEN: {csrf_token}
```

#### Getting CSRF Token

```javascript
// Available in meta tag on all pages
const token = document.querySelector('meta[name="csrf-token"]').content;
```

### Authenticated Routes

All routes under `/dashboard`, `/profile`, `/apply-form`, and admin routes require authentication.

**Middleware:** `auth`

**Unauthorized Response (401):**

```json
{
    "message": "Unauthenticated"
}
```

---

## Public Endpoints

### 1. Home Page

**Endpoint:** `GET /`

**Description:** Display landing page with scholarship information

**Authentication:** Not required

**Response:** HTML view

---

### 2. About Page

**Endpoint:** `GET /about`

**Description:** Information about the scholarship program

**Authentication:** Not required

**Response:** HTML view

---

### 3. How It Works

**Endpoint:** `GET /how-it-works`

**Description:** Application process and guidelines

**Authentication:** Not required

**Response:** HTML view

---

### 4. Contact Form

**Endpoint:** `POST /contact`

**Description:** Submit contact inquiry

**Authentication:** Not required

**Request Body:**

```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "message": "I have a question about the scholarship..."
}
```

**Validation Rules:**

-   `name`: required, string, max:255
-   `email`: required, email
-   `message`: required, string, min:10

**Success Response (200):**

```json
{
    "message": "Thank you for your message. We'll get back to you soon."
}
```

**Error Response (422):**

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field must be a valid email address."],
        "message": ["The message must be at least 10 characters."]
    }
}
```

---

## Authentication Endpoints

### 1. User Registration

**Endpoint:** `POST /register`

**Description:** Create new user account

**Authentication:** Not required

**Request Body:**

```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "SecurePass123!",
    "password_confirmation": "SecurePass123!"
}
```

**Validation Rules:**

-   `name`: required, string, max:255
-   `email`: required, string, lowercase, email, max:255, unique:users
-   `password`: required, confirmed, min:8

**Success Response (302):**

-   Redirect to `/dashboard`
-   User automatically logged in
-   Verification email sent

**Error Response (422):**

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email has already been taken."]
    }
}
```

---

### 2. User Login

**Endpoint:** `POST /login`

**Description:** Authenticate user

**Authentication:** Not required

**Request Body:**

```json
{
    "email": "john@example.com",
    "password": "SecurePass123!",
    "remember": true
}
```

**Validation Rules:**

-   `email`: required, email
-   `password`: required
-   `remember`: optional, boolean

**Success Response (302):**

-   Redirect to `/dashboard`
-   Session cookie set

**Error Response (422):**

```json
{
    "message": "These credentials do not match our records."
}
```

---

### 3. User Logout

**Endpoint:** `POST /logout`

**Description:** End user session

**Authentication:** Required

**Request Body:** None

**Success Response (302):**

-   Redirect to `/`
-   Session destroyed

---

### 4. Email Verification

**Endpoint:** `GET /verify-email/{id}/{hash}`

**Description:** Verify user email address

**Authentication:** Required

**Parameters:**

-   `id`: User ID
-   `hash`: Verification hash

**Success Response (302):**

-   Redirect to `/dashboard`
-   Email verified status updated

**Error Response (403):**

```json
{
    "message": "Invalid verification link."
}
```

---

### 5. Password Reset Request

**Endpoint:** `POST /forgot-password`

**Description:** Request password reset link

**Authentication:** Not required

**Request Body:**

```json
{
    "email": "john@example.com"
}
```

**Success Response (200):**

```json
{
    "status": "We have emailed your password reset link."
}
```

**Error Response (422):**

```json
{
    "message": "We can't find a user with that email address."
}
```

---

### 6. Password Reset

**Endpoint:** `POST /reset-password`

**Description:** Reset user password

**Authentication:** Not required

**Request Body:**

```json
{
    "token": "reset_token_here",
    "email": "john@example.com",
    "password": "NewSecurePass123!",
    "password_confirmation": "NewSecurePass123!"
}
```

**Success Response (302):**

-   Redirect to `/login`
-   Password updated

**Error Response (422):**

```json
{
    "message": "This password reset token is invalid."
}
```

---

## Application Endpoints

### 1. View Application Form

**Endpoint:** `GET /apply-form`

**Description:** Display scholarship application form

**Authentication:** Required

**Middleware:** `auth`, `check.terms`

**Response:** HTML form view

**Note:** User must accept terms before accessing this page

---

### 2. Submit Application

**Endpoint:** `POST /apply-form`

**Description:** Submit scholarship application with documents

**Authentication:** Required

**Middleware:** `auth`, `check.terms`

**Request Type:** `multipart/form-data`

**Request Body:**

```json
{
    "first_name": "John",
    "last_name": "Doe",
    "date_of_birth": "2005-01-15",
    "address": "123 Main Street, Iba Town",
    "lga": "Ojo",
    "town": "Iba",
    "phone": "08012345678",
    "jamb_reg_number": "12345678AB",
    "jamb_score": "285",
    "institution": "University of Lagos",
    "course": "Computer Science",
    "passport_photo": "file",
    "id_card": "file",
    "jamb_result": "file"
}
```

**Validation Rules:**

-   `first_name`: required, string, max:255
-   `last_name`: required, string, max:255
-   `date_of_birth`: required, date, before:today, age between 15-35
-   `address`: required, string, max:500
-   `lga`: required, string, must be 'Ojo'
-   `town`: required, string, max:100
-   `phone`: required, string, regex:/^0[789][01]\d{8}$/
-   `jamb_reg_number`: required, string, size:10, unique
-   `jamb_score`: required, integer, min:180, max:400
-   `institution`: required, string, max:255
-   `course`: required, string, max:255
-   `passport_photo`: required, image, mimes:jpeg,png,jpg, max:2048
-   `id_card`: required, image, mimes:jpeg,png,jpg, max:2048
-   `jamb_result`: required, image, mimes:jpeg,png,jpg, max:2048

**Success Response (302):**

-   Redirect to `/dashboard`
-   Application ID generated (format: OA-YYYY-XXXXXX)
-   Confirmation email sent

**Application ID Format:**

```
OA-2025-AB1234
├── OA: Prefix (Ola Arowolo)
├── 2025: Year
└── AB1234: Random alphanumeric
```

**Error Response (422):**

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "jamb_score": ["The JAMB score must be at least 180."],
        "passport_photo": ["The passport photo must be an image."],
        "lga": [
            "Applications are only accepted from Ojo Local Government Area."
        ]
    }
}
```

---

### 3. View JAMB Application Form

**Endpoint:** `GET /apply-utme-jamb-form`

**Description:** Alternative JAMB-specific application form

**Authentication:** Required

**Middleware:** `auth`, `check.terms`

**Response:** HTML form view

---

## Terms & Conditions Endpoints

### 1. View Terms Page

**Endpoint:** `GET /terms-acceptance`

**Description:** Display terms and conditions acceptance page

**Authentication:** Required

**Response:** HTML view with terms content

---

### 2. Accept Terms

**Endpoint:** `POST /accept-terms`

**Description:** User accepts terms and conditions

**Authentication:** Required

**Request Body:**

```json
{
    "accept_terms": true
}
```

**Validation Rules:**

-   `accept_terms`: required, accepted (must be true)

**Success Response (302):**

-   Redirect to `/apply-form`
-   User record updated with acceptance timestamp

**Error Response (422):**

```json
{
    "message": "You must accept the terms and conditions to continue."
}
```

---

## User Dashboard Endpoints

### 1. Dashboard

**Endpoint:** `GET /dashboard`

**Description:** User dashboard with application status

**Authentication:** Required

**Response:** HTML view

**Data Returned:**

-   User information
-   Application status (if exists)
-   Application ID
-   Submission date
-   Current status

---

### 2. Profile Management

**Endpoint:** `GET /profile`

**Description:** User profile management page

**Authentication:** Required

**Response:** HTML view with profile form

---

### 3. Update Profile

**Endpoint:** `PATCH /profile`

**Description:** Update user profile information

**Authentication:** Required

**Request Body:**

```json
{
    "name": "John Updated Doe",
    "email": "john.updated@example.com"
}
```

**Validation Rules:**

-   `name`: required, string, max:255
-   `email`: required, string, lowercase, email, max:255, unique:users,email,{user_id}

**Success Response (302):**

-   Redirect to `/profile`
-   Profile updated
-   If email changed, verification email sent

**Error Response (422):**

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email has already been taken."]
    }
}
```

---

### 4. Update Password

**Endpoint:** `PUT /password`

**Description:** Change user password

**Authentication:** Required

**Request Body:**

```json
{
    "current_password": "OldPassword123!",
    "password": "NewPassword123!",
    "password_confirmation": "NewPassword123!"
}
```

**Validation Rules:**

-   `current_password`: required, current_password
-   `password`: required, confirmed, min:8

**Success Response (302):**

-   Redirect to `/profile`
-   Password updated

**Error Response (422):**

```json
{
    "message": "The provided password does not match your current password."
}
```

---

### 5. Delete Account

**Endpoint:** `DELETE /profile`

**Description:** Delete user account and associated data

**Authentication:** Required

**Request Body:**

```json
{
    "password": "UserPassword123!"
}
```

**Success Response (302):**

-   Redirect to `/`
-   Account deleted
-   Session destroyed

**Error Response (422):**

```json
{
    "message": "The provided password is incorrect."
}
```

---

## Admin Endpoints (Future Implementation)

### 1. Admin Dashboard

**Endpoint:** `GET /admin/dashboard`

**Authentication:** Required

**Middleware:** `auth`, `role:admin`

**Response:** Admin dashboard with statistics

---

### 2. List Applications

**Endpoint:** `GET /admin/applications`

**Authentication:** Required

**Middleware:** `auth`, `role:admin`

**Query Parameters:**

-   `status`: Filter by status (pending, approved, rejected)
-   `page`: Pagination page number
-   `per_page`: Results per page (default: 15)
-   `search`: Search by name, email, or application ID

**Example Request:**

```
GET /admin/applications?status=pending&page=1&per_page=20
```

**Response (200):**

```json
{
    "data": [
        {
            "id": 1,
            "application_id": "OA-2025-AB1234",
            "user": {
                "name": "John Doe",
                "email": "john@example.com"
            },
            "first_name": "John",
            "last_name": "Doe",
            "jamb_score": 285,
            "institution": "University of Lagos",
            "status": "pending",
            "created_at": "2025-12-01T10:30:00.000000Z"
        }
    ],
    "current_page": 1,
    "per_page": 20,
    "total": 45,
    "last_page": 3
}
```

---

### 3. View Application Details

**Endpoint:** `GET /admin/applications/{id}`

**Authentication:** Required

**Middleware:** `auth`, `role:admin`

**Response (200):**

```json
{
    "id": 1,
    "application_id": "OA-2025-AB1234",
    "user": {
        "id": 5,
        "name": "John Doe",
        "email": "john@example.com"
    },
    "first_name": "John",
    "last_name": "Doe",
    "date_of_birth": "2005-01-15",
    "address": "123 Main Street, Iba Town",
    "lga": "Ojo",
    "town": "Iba",
    "phone": "08012345678",
    "jamb_reg_number": "12345678AB",
    "jamb_score": 285,
    "institution": "University of Lagos",
    "course": "Computer Science",
    "passport_photo": "/storage/applications/passport_photos/abc123.jpg",
    "id_card": "/storage/applications/id_cards/def456.jpg",
    "jamb_result": "/storage/applications/jamb_results/ghi789.jpg",
    "status": "pending",
    "notes": null,
    "created_at": "2025-12-01T10:30:00.000000Z",
    "updated_at": "2025-12-01T10:30:00.000000Z"
}
```

---

### 4. Update Application Status

**Endpoint:** `PATCH /admin/applications/{id}/status`

**Authentication:** Required

**Middleware:** `auth`, `role:admin`

**Request Body:**

```json
{
    "status": "approved",
    "notes": "Excellent application. All requirements met."
}
```

**Validation Rules:**

-   `status`: required, in:pending,under_review,approved,rejected
-   `notes`: nullable, string, max:1000

**Success Response (200):**

```json
{
    "message": "Application status updated successfully",
    "application": {
        "id": 1,
        "application_id": "OA-2025-AB1234",
        "status": "approved",
        "notes": "Excellent application. All requirements met.",
        "updated_at": "2025-12-06T14:30:00.000000Z"
    }
}
```

**Note:** Status change triggers email notification to applicant

---

### 5. Form Settings Management

**Endpoint:** `GET /admin/form-settings`

**Authentication:** Required

**Middleware:** `auth`, `role:admin`

**Response:** Form settings configuration page

---

### 6. Update Form Settings

**Endpoint:** `POST /admin/form-settings`

**Authentication:** Required

**Middleware:** `auth`, `role:admin`

**Request Body:**

```json
{
    "is_open": true,
    "opening_date": "2025-01-15",
    "closing_date": "2025-03-31",
    "announcement": "Applications for 2025 scholarship are now open!"
}
```

**Success Response (302):**

-   Redirect to `/admin/form-settings`
-   Settings updated

---

## File Upload Handling

### Upload Specifications

**Maximum File Size:** 2MB per file

**Allowed Types:**

-   Images: jpeg, jpg, png

**Storage Location:**

```
storage/app/public/applications/
├── passport_photos/
├── id_cards/
└── jamb_results/
```

**File Naming Convention:**

```
{user_id}_{timestamp}_{random}.{extension}
```

**Example:**

```
5_1701432000_abc123def456.jpg
```

### Access URLs

**Public URL Format:**

```
/storage/applications/{type}/{filename}
```

**Example:**

```
https://scholarship.olaarowolo.com/storage/applications/passport_photos/5_1701432000_abc123def456.jpg
```

---

## Error Handling

### HTTP Status Codes

| Code | Meaning              | Description                   |
| ---- | -------------------- | ----------------------------- |
| 200  | OK                   | Request successful            |
| 201  | Created              | Resource created successfully |
| 302  | Redirect             | Redirect to another page      |
| 401  | Unauthorized         | Authentication required       |
| 403  | Forbidden            | Access denied                 |
| 404  | Not Found            | Resource not found            |
| 422  | Unprocessable Entity | Validation failed             |
| 429  | Too Many Requests    | Rate limit exceeded           |
| 500  | Server Error         | Internal server error         |

### Error Response Format

**Validation Errors (422):**

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "field_name": ["Error message for this field."],
        "another_field": ["First error message.", "Second error message."]
    }
}
```

**Authentication Errors (401):**

```json
{
    "message": "Unauthenticated."
}
```

**Authorization Errors (403):**

```json
{
    "message": "This action is unauthorized."
}
```

**Not Found Errors (404):**

```json
{
    "message": "The requested resource was not found."
}
```

**Server Errors (500):**

```json
{
    "message": "Server Error",
    "error": "Detailed error message (development only)"
}
```

---

## Rate Limiting

### Default Limits

**Web Routes:** 60 requests per minute per IP

**API Routes:** 60 requests per minute per user

**Contact Form:** 10 submissions per hour per IP

### Rate Limit Headers

```http
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 45
X-RateLimit-Reset: 1701432000
```

### Rate Limit Exceeded Response (429)

```json
{
    "message": "Too Many Attempts.",
    "retry_after": 60
}
```

---

## Security Considerations

### CSRF Protection

All POST, PUT, PATCH, DELETE requests require CSRF token.

**Include in Forms:**

```html
<form method="POST">
    @csrf
    <!-- form fields -->
</form>
```

**Include in AJAX:**

```javascript
fetch("/api/endpoint", {
    method: "POST",
    headers: {
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
});
```

### Password Requirements

-   Minimum 8 characters
-   Must be confirmed
-   No specific complexity requirements (configurable)

### File Upload Security

-   File type validation (whitelist)
-   File size limits enforced
-   Files stored outside public directory
-   Direct file access controlled

---

## Testing API Endpoints

### Using cURL

**Example - Contact Form:**

```bash
curl -X POST https://scholarship.olaarowolo.com/contact \
  -H "Content-Type: application/json" \
  -H "X-CSRF-TOKEN: your-csrf-token" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "message": "I have a question"
  }'
```

**Example - Login:**

```bash
curl -X POST https://scholarship.olaarowolo.com/login \
  -H "Content-Type: application/json" \
  -H "X-CSRF-TOKEN: your-csrf-token" \
  -d '{
    "email": "john@example.com",
    "password": "SecurePass123!"
  }'
```

### Using Postman

1. Set base URL: `https://scholarship.olaarowolo.com`
2. Add CSRF token in headers
3. For file uploads, use form-data
4. Store authentication cookie for session

---

## Webhooks (Future Implementation)

### Application Status Change

**Endpoint:** Configurable in admin panel

**Method:** POST

**Payload:**

```json
{
    "event": "application.status_changed",
    "application_id": "OA-2025-AB1234",
    "old_status": "pending",
    "new_status": "approved",
    "timestamp": "2025-12-06T14:30:00.000000Z"
}
```

---

## Versioning

**Current Version:** 1.0.0

**API Versioning Strategy:** Currently not versioned. Future versions will use URL prefix:

```
/api/v2/endpoint
```

---

## Support

For API support and questions:

-   **Email:** scholarship@olaarowolo.com
-   **Technical Email:** oatutors@gmail.com

---

## Changelog

### Version 1.0.0 (December 2025)

-   Initial API implementation
-   Public endpoints (home, about, contact)
-   Authentication endpoints (register, login, logout)
-   Application submission endpoint
-   Profile management endpoints
-   Terms acceptance endpoints

### Planned Features

-   Admin API endpoints
-   Application review workflow
-   Beneficiary management API
-   Performance tracking endpoints
-   Advanced filtering and search
-   Webhook integrations
