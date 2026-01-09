# Field Mapping Update - Database to UI Alignment

## Summary

Updated the application form UI to match all database fields in the `applications` table, ensuring complete data collection.

## Database Fields (from migration `2025_12_02_124617_create_applications_table.php`)

| Database Field    | Type       | Required | Form Field        | Status    |
| ----------------- | ---------- | -------- | ----------------- | --------- |
| `id`              | Auto       | Yes      | N/A               | ✅ Auto   |
| `application_id`  | String     | Yes      | N/A               | ✅ Auto   |
| `user_id`         | Foreign ID | No       | N/A               | ✅ Auto   |
| `first_name`      | String     | Yes      | `firstName`       | ✅ Added  |
| `last_name`       | String     | No       | `lastName`        | ✅ Added  |
| `date_of_birth`   | Date       | No       | `dateOfBirth`     | ✅ Added  |
| `address`         | Text       | Yes      | `address`         | ✅ Exists |
| `lga`             | String     | No       | `lga`             | ✅ Added  |
| `town`            | String     | No       | `town`            | ✅ Added  |
| `phone`           | String     | Yes      | `phone`           | ✅ Exists |
| `jamb_reg_number` | String     | No       | `jambRegNumber`   | ✅ Added  |
| `jamb_score`      | Decimal    | Yes      | `jambScore`       | ✅ Exists |
| `institution`     | String     | Yes      | `institution`     | ✅ Exists |
| `course`          | String     | Yes      | `course`          | ✅ Exists |
| `passport_photo`  | String     | No       | `indigeneCert`    | ✅ Exists |
| `id_card`         | String     | No       | `waecResult`      | ✅ Exists |
| `jamb_result`     | String     | No       | `jambResult`      | ✅ Exists |
| `status`          | Enum       | Yes      | N/A               | ✅ Auto   |
| `notes`           | Text       | No       | `admissionStatus` | ✅ Exists |
| `timestamps`      | DateTime   | Yes      | N/A               | ✅ Auto   |

## Changes Made

### 1. Updated Form State (`apply-form.blade.php`)

**Before:**

```javascript
data: {
    personal: {
        fullName: '',
        email: '',
        phone: '',
        address: '',
        isIndigene: 'No',
    },
    academic: {
        jambScore: 0,
        waecGceYear: '',
        institution: '',
        course: '',
        admissionStatus: 'Awaiting',
    },
    ...
}
```

**After:**

```javascript
data: {
    personal: {
        firstName: '',           // NEW
        lastName: '',            // NEW
        dateOfBirth: '',         // NEW
        email: '',
        phone: '',
        address: '',
        lga: '',                 // NEW
        town: '',                // NEW
        isIndigene: 'No',
    },
    academic: {
        jambRegNumber: '',       // NEW
        jambScore: 0,
        waecGceYear: '',
        institution: '',
        course: '',
        admissionStatus: 'Awaiting',
    },
    ...
}
```

### 2. Updated Step 1 (Personal Information)

**New Fields Added:**

-   ✅ First Name (split from fullName)
-   ✅ Last Name (split from fullName)
-   ✅ Date of Birth (date picker)
-   ✅ Local Government Area (LGA)
-   ✅ Town/City

**Layout:** Used 2-column grid for First Name/Last Name and LGA/Town pairs

### 3. Updated Step 2 (Academic Information)

**New Field Added:**

-   ✅ JAMB Registration Number (placed before JAMB Score)

### 4. Updated Step 4 (Review Screen)

**Updated to display all new fields:**

-   First Name, Last Name (instead of Full Name)
-   Date of Birth
-   LGA, Town
-   JAMB Registration Number

### 5. Updated Controller (`ApplicationController.php`)

**Validation Rules Updated:**

```php
'firstName' => 'required|string|max:255',
'lastName' => 'required|string|max:255',
'dateOfBirth' => 'required|date|before:today',
'lga' => 'required|string|max:255',
'town' => 'required|string|max:255',
'jambRegNumber' => 'required|string|max:255',
```

**Database Mapping Updated:**

```php
Application::create([
    'first_name' => $request->firstName,      // Fixed
    'last_name' => $request->lastName,         // Fixed
    'date_of_birth' => $request->dateOfBirth,  // Fixed
    'lga' => $request->lga,                    // Fixed
    'town' => $request->town,                  // Fixed
    'jamb_reg_number' => $request->jambRegNumber, // Fixed
    ...
]);
```

**Added Proper Imports:**

-   `use Illuminate\Support\Facades\Auth;`
-   `use Illuminate\Support\Facades\Log;`

### 6. Form Validation Updates

All new fields are now **required** in Step 1 and Step 2:

-   User cannot proceed to next step without filling all required fields
-   Button remains disabled until all fields are valid

## Fields NOT Stored in Database

The following form fields are collected but **not stored** (by design):

-   ✅ `email` - Used for validation but not in applications table
-   ✅ `isIndigene` - Used for eligibility check but not stored directly
-   ✅ `waecGceYear` - Collected but not stored (can be added to DB if needed)

## Testing Recommendations

1. **Test Step 1:**

    - Verify all personal fields are required
    - Test date picker for Date of Birth
    - Ensure LGA and Town fields accept text input

2. **Test Step 2:**

    - Verify JAMB Registration Number is required
    - Ensure validation for JAMB Score (min 180) still works

3. **Test Review Screen:**

    - Verify all new fields display correctly
    - Check layout is not broken on mobile

4. **Test Submission:**
    - Submit a complete application
    - Verify all fields are saved to database
    - Check database records match form input

## Next Steps (Optional Enhancements)

1. Add `email` field to applications table if needed for future contact
2. Add `waec_gce_year` field to database if tracking exam year is important
3. Consider adding validation for JAMB Registration Number format
4. Add LGA dropdown with predefined options instead of free text
5. Add age validation based on Date of Birth
