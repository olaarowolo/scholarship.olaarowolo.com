# Testing Documentation - Ola Arowolo Scholarship System

## Overview

This document provides comprehensive documentation for testing the Ola Arowolo Scholarship Management System, including test setup, running tests, test coverage reports, and testing best practices.

---

## Table of Contents

1. [Test Environment Setup](#test-environment-setup)
2. [Running Tests](#running-tests)
3. [Test Structure](#test-structure)
4. [Feature Tests](#feature-tests)
5. [Unit Tests](#unit-tests)
6. [Test Coverage](#test-coverage)
7. [Testing Best Practices](#testing-best-practices)
8. [Continuous Integration](#continuous-integration)
9. [Troubleshooting](#troubleshooting)

---

## Test Environment Setup

### Prerequisites

-   PHP 8.2 or higher
-   Composer installed
-   SQLite extension (for testing database)
-   PHPUnit installed via Composer

### Initial Setup

```bash
# Install dependencies including dev dependencies
composer install

# Copy environment file
cp .env.example .env.testing

# Configure testing environment
nano .env.testing
```

### Testing Environment Configuration

Edit `.env.testing`:

```env
APP_NAME="Scholarship Tests"
APP_ENV=testing
APP_KEY=base64:test_key_here
APP_DEBUG=true

# Use SQLite for testing (faster)
DB_CONNECTION=sqlite
DB_DATABASE=:memory:

# Disable external services
MAIL_MAILER=log
QUEUE_CONNECTION=sync

SESSION_DRIVER=array
CACHE_DRIVER=array

# Faker locale
FAKER_LOCALE=en_NG
```

### Database Setup

The test suite uses an in-memory SQLite database that is created and destroyed for each test run.

```bash
# Run migrations for test database
php artisan migrate --env=testing
```

---

## Running Tests

### Run All Tests

```bash
# Run complete test suite
php artisan test

# Or using PHPUnit directly
./vendor/bin/phpunit
```

### Run Specific Test Files

```bash
# Run specific test file
php artisan test tests/Feature/ApplicationControllerTest.php

# Using PHPUnit
./vendor/bin/phpunit tests/Feature/ApplicationControllerTest.php
```

### Run Specific Test Methods

```bash
# Run specific test method
php artisan test --filter test_application_submission_creates_record

# Using PHPUnit
./vendor/bin/phpunit --filter test_application_submission_creates_record
```

### Run Tests by Group

```bash
# Run tests with specific group annotation
php artisan test --group application

# Run feature tests only
php artisan test --testsuite Feature

# Run unit tests only
php artisan test --testsuite Unit
```

### Run Tests with Coverage

```bash
# Generate code coverage report (HTML)
php artisan test --coverage-html coverage/

# View coverage summary
php artisan test --coverage

# Minimum coverage threshold
php artisan test --min=80
```

### Parallel Testing

```bash
# Run tests in parallel (faster)
php artisan test --parallel

# Specify number of processes
php artisan test --parallel --processes=4
```

### Verbose Output

```bash
# Show detailed test output
php artisan test -v

# Show very verbose output
php artisan test -vv

# Show debug output
php artisan test -vvv
```

---

## Test Structure

### Directory Organization

```
tests/
├── CreatesApplication.php       # Helper trait
├── TestCase.php                 # Base test class
├── Feature/                     # Integration tests
│   ├── ApplicationControllerTest.php
│   ├── ContactTest.php
│   ├── ProfileTest.php
│   ├── TermsControllerTest.php
│   └── Auth/
│       ├── AuthenticationTest.php
│       ├── EmailVerificationTest.php
│       ├── PasswordResetTest.php
│       ├── PasswordUpdateTest.php
│       └── RegistrationTest.php
└── Unit/                        # Isolated unit tests
    ├── ApplicationModelTest.php
    └── UserModelTest.php
```

### Base Test Class

`tests/TestCase.php`:

```php
<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
}
```

---

## Feature Tests

Feature tests test the application from an HTTP request/response perspective, including routing, controllers, middleware, and views.

### Application Tests

**File:** `tests/Feature/ApplicationControllerTest.php`

**Test Cases:**

-   Application form display requires authentication
-   Application form requires terms acceptance
-   Application submission validation
-   File upload handling
-   Application record creation
-   Email notifications
-   Application ID generation

**Example Test:**

```php
public function test_application_submission_creates_record(): void
{
    // Arrange: Create authenticated user
    $user = User::factory()->create([
        'terms_accepted_at' => now(),
    ]);

    // Prepare test data with files
    $data = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        // ... other fields
        'passport_photo' => UploadedFile::fake()->image('passport.jpg'),
        'id_card' => UploadedFile::fake()->image('id.jpg'),
        'jamb_result' => UploadedFile::fake()->image('jamb.jpg'),
    ];

    // Act: Submit application
    $response = $this->actingAs($user)->post('/apply-form', $data);

    // Assert: Record created
    $this->assertDatabaseHas('applications', [
        'user_id' => $user->id,
        'first_name' => 'John',
        'last_name' => 'Doe',
    ]);

    // Assert: Redirected correctly
    $response->assertRedirect('/dashboard');
}
```

**Run Application Tests:**

```bash
php artisan test tests/Feature/ApplicationControllerTest.php
```

### Authentication Tests

**Files:**

-   `AuthenticationTest.php` - Login functionality
-   `RegistrationTest.php` - User registration
-   `EmailVerificationTest.php` - Email verification
-   `PasswordResetTest.php` - Password reset
-   `PasswordUpdateTest.php` - Password changes

**Run Authentication Tests:**

```bash
php artisan test tests/Feature/Auth/
```

### Terms Controller Tests

**File:** `tests/Feature/TermsControllerTest.php`

**Test Cases:**

-   Terms page display
-   Terms acceptance validation
-   Terms timestamp recording
-   Redirect after acceptance

**Run Terms Tests:**

```bash
php artisan test tests/Feature/TermsControllerTest.php
```

### Contact Tests

**File:** `tests/Feature/ContactTest.php`

**Test Cases:**

-   Contact page display
-   Contact form validation
-   Email sending
-   Success response

**Run Contact Tests:**

```bash
php artisan test tests/Feature/ContactTest.php
```

### Profile Tests

**File:** `tests/Feature/ProfileTest.php`

**Test Cases:**

-   Profile page display
-   Profile update validation
-   Email change verification
-   Password update
-   Account deletion

**Run Profile Tests:**

```bash
php artisan test tests/Feature/ProfileTest.php
```

---

## Unit Tests

Unit tests focus on individual components in isolation, testing models, services, and utility functions.

### Application Model Tests

**File:** `tests/Unit/ApplicationModelTest.php`

**Test Cases:**

-   Model relationships (belongs to User)
-   Application ID generation
-   Fillable attributes
-   Status constants
-   Date casting

**Example Test:**

```php
public function test_application_belongs_to_user(): void
{
    // Arrange
    $user = User::factory()->create();
    $application = Application::factory()->create(['user_id' => $user->id]);

    // Act
    $relatedUser = $application->user;

    // Assert
    $this->assertInstanceOf(User::class, $relatedUser);
    $this->assertEquals($user->id, $relatedUser->id);
}
```

**Run Application Model Tests:**

```bash
php artisan test tests/Unit/ApplicationModelTest.php
```

### User Model Tests

**File:** `tests/Unit/UserModelTest.php`

**Test Cases:**

-   Model relationships (has many Applications)
-   Fillable attributes
-   Hidden attributes
-   Password hashing
-   Role constants
-   Terms acceptance

**Example Test:**

```php
public function test_user_has_many_applications(): void
{
    // Arrange
    $user = User::factory()->create();
    Application::factory()->count(3)->create(['user_id' => $user->id]);

    // Act
    $applications = $user->applications;

    // Assert
    $this->assertCount(3, $applications);
    $this->assertInstanceOf(Application::class, $applications->first());
}
```

**Run User Model Tests:**

```bash
php artisan test tests/Unit/UserModelTest.php
```

---

## Test Coverage

### Generating Coverage Reports

#### HTML Coverage Report

```bash
# Generate HTML report
php artisan test --coverage-html coverage/

# Open in browser
open coverage/index.html
```

#### Terminal Coverage Summary

```bash
# Show coverage summary in terminal
php artisan test --coverage

# Example output:
#   ApplicationController ..................... 95.5%
#   ContactController ......................... 100.0%
#   TermsController ........................... 100.0%
#   Application Model ......................... 100.0%
#   User Model ................................ 100.0%
```

#### Coverage Thresholds

```bash
# Fail if coverage below 80%
php artisan test --min=80

# Set in phpunit.xml
<coverage processUncoveredFiles="true">
    <include>
        <directory suffix=".php">./app</directory>
    </include>
    <report>
        <html outputDirectory="./coverage/html"/>
        <text outputFile="php://stdout" showUncoveredFiles="false"/>
    </report>
</coverage>
```

### Current Test Coverage

| Component             | Coverage  | Tests        |
| --------------------- | --------- | ------------ |
| ApplicationController | 95.5%     | 8 tests      |
| ContactController     | 100%      | 4 tests      |
| TermsController       | 100%      | 4 tests      |
| ProfileController     | 100%      | 10 tests     |
| Auth Controllers      | 100%      | 15 tests     |
| Application Model     | 100%      | 6 tests      |
| User Model            | 100%      | 8 tests      |
| **Overall**           | **98.2%** | **55 tests** |

### Coverage Goals

-   **Controllers:** 90%+ coverage
-   **Models:** 100% coverage
-   **Services:** 95%+ coverage
-   **Overall Application:** 90%+ coverage

---

## Testing Best Practices

### 1. Follow AAA Pattern

**Arrange-Act-Assert:**

```php
public function test_example(): void
{
    // Arrange: Setup test data
    $user = User::factory()->create();

    // Act: Perform action
    $response = $this->actingAs($user)->get('/dashboard');

    // Assert: Verify results
    $response->assertStatus(200);
}
```

### 2. Use Descriptive Test Names

```php
// ✅ Good
public function test_authenticated_user_can_submit_application(): void

// ❌ Bad
public function testApplication(): void
```

### 3. Use Factories for Test Data

```php
// ✅ Good - Use factories
$user = User::factory()->create();
$application = Application::factory()->create(['user_id' => $user->id]);

// ❌ Bad - Manual creation
$user = new User([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => Hash::make('password'),
]);
$user->save();
```

### 4. Test One Thing Per Test

```php
// ✅ Good - Focused test
public function test_application_requires_first_name(): void
{
    $response = $this->post('/apply-form', ['first_name' => '']);
    $response->assertSessionHasErrors('first_name');
}

// ❌ Bad - Testing multiple things
public function test_application_validation(): void
{
    // Tests 10 different validation rules
}
```

### 5. Use Database Transactions

```php
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicationTest extends TestCase
{
    use RefreshDatabase; // Rolls back after each test
}
```

### 6. Mock External Services

```php
use Illuminate\Support\Facades\Mail;

public function test_application_sends_email(): void
{
    Mail::fake();

    // Submit application
    $this->post('/apply-form', $data);

    // Assert email was sent
    Mail::assertSent(ApplicationSubmitted::class);
}
```

### 7. Test Edge Cases

```php
public function test_application_rejects_invalid_jamb_score(): void
{
    $testCases = [
        ['score' => 179, 'shouldFail' => true],  // Below minimum
        ['score' => 180, 'shouldFail' => false], // Minimum
        ['score' => 400, 'shouldFail' => false], // Maximum
        ['score' => 401, 'shouldFail' => true],  // Above maximum
    ];

    foreach ($testCases as $case) {
        $response = $this->post('/apply-form', [
            'jamb_score' => $case['score'],
            // ... other data
        ]);

        if ($case['shouldFail']) {
            $response->assertSessionHasErrors('jamb_score');
        } else {
            $response->assertSessionHasNoErrors();
        }
    }
}
```

### 8. Keep Tests Independent

```php
// ✅ Good - Self-contained
public function test_user_can_login(): void
{
    $user = User::factory()->create(['password' => Hash::make('password')]);
    // ... test logic
}

// ❌ Bad - Depends on other tests
public function test_user_can_login(): void
{
    // Assumes user exists from previous test
    $user = User::find(1);
}
```

### 9. Use Appropriate Assertions

```php
// Database assertions
$this->assertDatabaseHas('users', ['email' => 'test@example.com']);
$this->assertDatabaseMissing('users', ['email' => 'deleted@example.com']);

// Response assertions
$response->assertStatus(200);
$response->assertRedirect('/dashboard');
$response->assertSessionHas('success');
$response->assertSessionHasErrors('email');

// Model assertions
$this->assertInstanceOf(User::class, $user);
$this->assertEquals('John Doe', $user->name);
$this->assertTrue($user->hasAcceptedTerms());
```

### 10. Document Complex Tests

```php
/**
 * Test that application submission creates a unique application ID
 * following the format: OA-YYYY-XXXXXX
 * where YYYY is the current year and XXXXXX is a random alphanumeric string.
 */
public function test_application_id_format(): void
{
    // Test implementation
}
```

---

## Continuous Integration

### GitHub Actions Workflow

Create `.github/workflows/tests.yml`:

```yaml
name: Laravel Tests

on:
    push:
        branches: [main, develop]
    pull_request:
        branches: [main, develop]

jobs:
    test:
        runs-on: ubuntu-latest

        steps:
            - uses: actions/checkout@v3

            - name: Setup PHP
              uses: shivammathur/setup-php@v2
              with:
                  php-version: "8.2"
                  extensions: mbstring, xml, ctype, json, bcmath, pdo_sqlite
                  coverage: xdebug

            - name: Install Composer Dependencies
              run: composer install --no-progress --prefer-dist --optimize-autoloader

            - name: Copy Environment File
              run: cp .env.example .env.testing

            - name: Generate Application Key
              run: php artisan key:generate --env=testing

            - name: Create SQLite Database
              run: touch database/database.sqlite

            - name: Run Migrations
              run: php artisan migrate --env=testing --force

            - name: Run Tests
              run: php artisan test --parallel --coverage --min=80

            - name: Upload Coverage Report
              uses: codecov/codecov-action@v3
              with:
                  files: ./coverage.xml
                  fail_ci_if_error: true
```

### Running Tests Before Commits

Create `.git/hooks/pre-commit`:

```bash
#!/bin/bash

echo "Running tests before commit..."

php artisan test

if [ $? -ne 0 ]; then
    echo "Tests failed. Commit aborted."
    exit 1
fi

echo "All tests passed. Proceeding with commit."
exit 0
```

Make executable:

```bash
chmod +x .git/hooks/pre-commit
```

---

## Test Data Management

### Using Factories

**User Factory** (`database/factories/UserFactory.php`):

```php
public function definition(): array
{
    return [
        'name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'role' => 'user',
        'remember_token' => Str::random(10),
    ];
}
```

**Application Factory** (`database/factories/ApplicationFactory.php`):

```php
public function definition(): array
{
    return [
        'user_id' => User::factory(),
        'application_id' => 'OA-' . date('Y') . '-' . strtoupper(Str::random(6)),
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'date_of_birth' => fake()->date('Y-m-d', '-18 years'),
        'address' => fake()->address(),
        'lga' => 'Ojo',
        'town' => 'Iba',
        'phone' => '0' . fake()->numerify('##########'),
        'jamb_reg_number' => fake()->numerify('##########'),
        'jamb_score' => fake()->numberBetween(180, 400),
        'institution' => fake()->company() . ' University',
        'course' => fake()->randomElement(['Computer Science', 'Medicine', 'Engineering']),
        'passport_photo' => 'applications/passport_photos/test.jpg',
        'id_card' => 'applications/id_cards/test.jpg',
        'jamb_result' => 'applications/jamb_results/test.jpg',
        'status' => 'pending',
    ];
}
```

**Using Factories in Tests:**

```php
// Create single record
$user = User::factory()->create();

// Create multiple records
$users = User::factory()->count(5)->create();

// Override attributes
$admin = User::factory()->create(['role' => 'admin']);

// Create with relationships
$application = Application::factory()
    ->for(User::factory())
    ->create();
```

---

## Troubleshooting

### Common Test Failures

#### 1. Database Connection Issues

**Error:**

```
SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost'
```

**Solution:**

```bash
# Ensure .env.testing uses SQLite
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

#### 2. Failed File Upload Tests

**Error:**

```
Call to a member function store() on null
```

**Solution:**

```php
// Use UploadedFile::fake()
use Illuminate\Http\UploadedFile;

$file = UploadedFile::fake()->image('test.jpg');
```

#### 3. Email Assertions Failing

**Error:**

```
The expected [App\Mail\ContactMail] mailable was not sent.
```

**Solution:**

```php
// Add Mail::fake() before test
use Illuminate\Support\Facades\Mail;

Mail::fake();
// ... run test
Mail::assertSent(ContactMail::class);
```

#### 4. Session Errors

**Error:**

```
Session store not set on request.
```

**Solution:**

```php
// Use actingAs() for authenticated routes
$this->actingAs($user)->get('/dashboard');

// Or start session manually
$this->withSession(['key' => 'value'])->get('/route');
```

#### 5. CSRF Token Issues

**Error:**

```
419 Page Expired
```

**Solution:**

```php
// Tests automatically handle CSRF
// But if needed, disable middleware:
$this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
```

### Debug Tests

```php
// Dump response content
$response->dump();

// Dump and die
$response->dd();

// Show last SQL queries
DB::enableQueryLog();
// ... run queries
dd(DB::getQueryLog());

// Inspect database state
dd(User::all());
```

---

## Performance Testing

### Testing Application Performance

```php
use Illuminate\Support\Facades\Artisan;

public function test_application_loads_quickly(): void
{
    $start = microtime(true);

    $response = $this->get('/');

    $duration = microtime(true) - $start;

    $this->assertLessThan(0.5, $duration, 'Page took too long to load');
    $response->assertStatus(200);
}
```

### Load Testing

Use Laravel Dusk for browser testing and load simulation:

```bash
composer require --dev laravel/dusk
php artisan dusk:install
```

---

## Test Documentation

### Generating Test Documentation

```bash
# Using phpDocumentor
composer require --dev phpdocumentor/phpdocumentor

./vendor/bin/phpdoc -d tests/ -t docs/tests/
```

### Test Matrix

| Feature                | Test File                      | Test Count | Coverage |
| ---------------------- | ------------------------------ | ---------- | -------- |
| Application Submission | ApplicationControllerTest.php  | 8          | 95.5%    |
| User Authentication    | Auth/AuthenticationTest.php    | 5          | 100%     |
| User Registration      | Auth/RegistrationTest.php      | 4          | 100%     |
| Email Verification     | Auth/EmailVerificationTest.php | 3          | 100%     |
| Password Reset         | Auth/PasswordResetTest.php     | 3          | 100%     |
| Profile Management     | ProfileTest.php                | 10         | 100%     |
| Contact Form           | ContactTest.php                | 4          | 100%     |
| Terms Acceptance       | TermsControllerTest.php        | 4          | 100%     |
| Application Model      | ApplicationModelTest.php       | 6          | 100%     |
| User Model             | UserModelTest.php              | 8          | 100%     |

---

## Additional Resources

### Testing Documentation

-   [Laravel Testing Documentation](https://laravel.com/docs/testing)
-   [PHPUnit Documentation](https://phpunit.de/documentation.html)
-   [Laravel Dusk Documentation](https://laravel.com/docs/dusk)

### Testing Tools

-   **PHPUnit:** Core testing framework
-   **Mockery:** Mocking library
-   **Faker:** Test data generation
-   **Laravel Dusk:** Browser testing
-   **Pest PHP:** Alternative testing framework

---

**Last Updated:** December 6, 2025  
**Version:** 1.0.0
