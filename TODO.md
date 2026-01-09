# Scholar Dashboard Forms Backend Implementation Plan

## Overview

Implement backend functionality for the 5 scholar dashboard forms to handle form submissions, data storage, file uploads, and user feedback.

## Forms to Implement

1. **Make a Request** - General assistance/resource requests
2. **Academic Standing** - Academic progress reports with file uploads
3. **Document Challenges** - Challenge documentation and support requests
4. **Book Mentorship** - Mentorship session scheduling
5. **Academic Advice** - Academic guidance requests

## Database Models & Migrations Needed

### 1. ScholarRequest Model

-   Fields: user_id, request_type, subject, description, priority, status, created_at, updated_at
-   Migration: create_scholar_requests_table

### 2. AcademicReport Model

-   Fields: user_id, term, year, gpa, gpa_scale, course_load, performance_summary, achievements, goals, status, created_at, updated_at
-   Migration: create_academic_reports_table

### 3. ChallengeReport Model

-   Fields: user_id, challenge_type, description, impact_level, support_needed, status, created_at, updated_at
-   Migration: create_challenge_reports_table

### 4. MentorshipBooking Model

-   Fields: user_id, preferred_date, preferred_time, duration, topic, additional_notes, status, created_at, updated_at
-   Migration: create_mentorship_bookings_table

### 5. AdviceRequest Model

-   Fields: user_id, subject, question, context, urgency, status, created_at, updated_at
-   Migration: create_advice_requests_table

## File Upload Handling

-   Create storage directories for scholar uploads
-   Implement file validation (PDF, DOC, DOCX, JPG, PNG, max 10MB)
-   Store file paths in database
-   Add file cleanup for failed submissions

## Controller Updates

### ScholarController.php

Add POST methods:

-   storeRequest() - Handle request submissions
-   storeAcademicReport() - Handle academic standing submissions
-   storeChallenge() - Handle challenge documentation
-   storeMentorshipBooking() - Handle mentorship bookings
-   storeAdviceRequest() - Handle advice requests

Add validation rules for each form type.

## Route Updates

### web.php

Add POST routes in scholar middleware group:

-   POST /scholar/requests - ScholarController@storeRequest
-   POST /scholar/academic-standing - ScholarController@storeAcademicReport
-   POST /scholar/challenges - ScholarController@storeChallenge
-   POST /scholar/mentorship - ScholarController@storeMentorshipBooking
-   POST /scholar/advice - ScholarController@storeAdviceRequest

## Form Updates

### Update Form Actions

-   scholar/requests/create.blade.php: action="{{ route('scholar.requests.store') }}"
-   scholar/academic-standing.blade.php: action="{{ route('scholar.academic-standing.store') }}"
-   scholar/challenges.blade.php: action="{{ route('scholar.challenges.store') }}"
-   scholar/mentorship.blade.php: action="{{ route('scholar.mentorship.store') }}"
-   scholar/advice.blade.php: action="{{ route('scholar.advice.store') }}"

## Validation Rules

### Request Form

-   request_type: required|string|in:assistance,resources,other
-   subject: required|string|max:255
-   description: required|string|min:10
-   priority: required|in:low,medium,high

### Academic Report

-   term: required|string|max:100
-   year: required|string|max:20
-   gpa: required|numeric|min:0|max:5
-   gpa_scale: required|in:4.0,5.0,percentage
-   course_load: required|integer|min:1
-   performance_summary: required|string|min:50
-   achievements: nullable|string
-   goals: nullable|string
-   documents: required|array|min:1
-   documents.\*: file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240

### Challenge Report

-   challenge_type: required|string|in:academic,financial,personal,other
-   description: required|string|min:20
-   impact_level: required|in:low,medium,high
-   support_needed: required|string|min:10

### Mentorship Booking

-   preferred_date: required|date|after:today
-   preferred_time: required|string
-   duration: required|integer|min:30|max:120
-   topic: required|string|max:255
-   additional_notes: nullable|string

### Advice Request

-   subject: required|string|max:255
-   question: required|string|min:10
-   context: nullable|string
-   urgency: required|in:low,medium,high

## Success/Error Handling

### Flash Messages

-   Success: "Your [form type] has been submitted successfully. We'll review it shortly."
-   Error: "There was an error submitting your [form type]. Please try again."

### Redirects

-   Success: Redirect back to dashboard with success message
-   Error: Redirect back with input and error messages

## Email Notifications (Future Enhancement)

-   Notify admin when new submissions are made
-   Send confirmation emails to scholars

## Testing Workflow

### Unit Tests

-   Test model creation and relationships
-   Test validation rules
-   Test file upload handling

### Feature Tests

-   Test form submissions with valid data
-   Test form submissions with invalid data
-   Test file upload limits and types
-   Test authentication requirements

### Manual Testing

1. Login as scholar user
2. Navigate to each form
3. Submit valid data
4. Submit invalid data
5. Verify database entries
6. Verify file storage
7. Check success messages

## Implementation Order

1. Create models and migrations
2. Run migrations
3. Update ScholarController with POST methods
4. Add POST routes
5. Update form actions
6. Test each form individually
7. Add comprehensive validation
8. Implement file handling
9. Add success/error handling
10. Final testing and refinements

## Dependencies

-   Laravel Framework
-   File storage configured
-   Database migrations
-   Authentication system
-   Scholar role middleware

## Security Considerations

-   Validate all input data
-   Sanitize file uploads
-   Check user permissions
-   Rate limiting for submissions
-   CSRF protection
-   File type and size restrictions

## Performance Considerations

-   Optimize file storage
-   Add database indexes
-   Implement caching if needed
-   Monitor submission rates

## Rollback Plan

-   Keep backup of original files
-   Test in development environment first
-   Have database backup before migrations
-   Document all changes for easy reversal
