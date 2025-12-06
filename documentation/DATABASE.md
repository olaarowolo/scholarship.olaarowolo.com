# Database Documentation - Ola Arowolo Scholarship System

## Overview

This document provides comprehensive documentation for the database schema, relationships, migrations, seeders, and best practices for the Ola Arowolo Scholarship Management System.

---

## Table of Contents

1. [Database Overview](#database-overview)
2. [Entity Relationship Diagram](#entity-relationship-diagram)
3. [Tables Reference](#tables-reference)
4. [Relationships](#relationships)
5. [Migrations](#migrations)
6. [Seeders](#seeders)
7. [Indexes and Performance](#indexes-and-performance)
8. [Data Integrity](#data-integrity)
9. [Backup and Restore](#backup-and-restore)
10. [Queries and Examples](#queries-and-examples)

---

## Database Overview

### Database Configuration

**Production:**

-   **Engine:** MySQL 5.7+ / MariaDB 10.3+
-   **Charset:** utf8mb4
-   **Collation:** utf8mb4_unicode_ci
-   **Timezone:** Africa/Lagos

**Development:**

-   Same as production

**Testing:**

-   **Engine:** SQLite (in-memory)
-   Faster test execution
-   Reset between tests

### Connection Settings

`.env` configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=scholarship_db
DB_USERNAME=scholarship_user
DB_PASSWORD=secure_password
```

---

## Entity Relationship Diagram

```
┌─────────────────────────┐
│        Users            │
├─────────────────────────┤
│ id (PK)                 │
│ name                    │
│ email (UNIQUE)          │
│ password                │
│ role (ENUM)             │
│ email_verified_at       │
│ terms_accepted          │
│ device                  │
│ location                │
│ credentials             │
│ remember_token          │
│ created_at              │
│ updated_at              │
└──────────┬──────────────┘
           │
           │ 1:N
           │
           ▼
┌─────────────────────────┐
│    Applications         │
├─────────────────────────┤
│ id (PK)                 │
│ application_id (UNIQUE) │
│ user_id (FK) → users.id │
│ first_name              │
│ last_name               │
│ date_of_birth           │
│ address                 │
│ lga                     │
│ town                    │
│ phone                   │
│ jamb_reg_number         │
│ jamb_score              │
│ institution             │
│ course                  │
│ passport_photo          │
│ id_card                 │
│ jamb_result             │
│ status (ENUM)           │
│ notes                   │
│ created_at              │
│ updated_at              │
└─────────────────────────┘

┌─────────────────────────┐
│    Form Settings        │
├─────────────────────────┤
│ id (PK)                 │
│ form_name (UNIQUE)      │
│ is_open                 │
│ opens_at                │
│ closes_at               │
│ closed_message          │
│ created_at              │
│ updated_at              │
└─────────────────────────┘

┌─────────────────────────┐
│  Password Reset Tokens  │
├─────────────────────────┤
│ email (PK)              │
│ token                   │
│ created_at              │
└─────────────────────────┘

┌─────────────────────────┐
│      Sessions           │
├─────────────────────────┤
│ id (PK)                 │
│ user_id (FK) → users.id │
│ ip_address              │
│ user_agent              │
│ payload                 │
│ last_activity (INDEX)   │
└─────────────────────────┘

┌─────────────────────────┐
│        Cache            │
├─────────────────────────┤
│ key (PK)                │
│ value                   │
│ expiration (INDEX)      │
└─────────────────────────┘

┌─────────────────────────┐
│         Jobs            │
├─────────────────────────┤
│ id (PK)                 │
│ queue (INDEX)           │
│ payload                 │
│ attempts                │
│ reserved_at             │
│ available_at (INDEX)    │
│ created_at              │
└─────────────────────────┘

┌─────────────────────────┐
│    Failed Jobs          │
├─────────────────────────┤
│ id (PK)                 │
│ uuid (UNIQUE)           │
│ connection              │
│ queue                   │
│ payload                 │
│ exception               │
│ failed_at               │
└─────────────────────────┘
```

---

## Tables Reference

### 1. Users Table

**Purpose:** Store registered user accounts with authentication details and roles.

**Table Name:** `users`

| Column            | Type            | Attributes                  | Description                  |
| ----------------- | --------------- | --------------------------- | ---------------------------- |
| id                | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique user identifier       |
| name              | VARCHAR(255)    | NOT NULL                    | User's full name             |
| email             | VARCHAR(255)    | UNIQUE, NOT NULL            | User's email address (login) |
| email_verified_at | TIMESTAMP       | NULLABLE                    | Email verification timestamp |
| password          | VARCHAR(255)    | NOT NULL                    | Hashed password              |
| role              | ENUM            | DEFAULT 'applicant'         | User role (see roles below)  |
| terms_accepted    | BOOLEAN         | DEFAULT false               | Terms acceptance status      |
| device            | VARCHAR(255)    | NULLABLE                    | Device used for registration |
| location          | VARCHAR(255)    | NULLABLE                    | Location at registration     |
| credentials       | VARCHAR(255)    | NULLABLE                    | Additional credentials info  |
| remember_token    | VARCHAR(100)    | NULLABLE                    | Remember me token            |
| created_at        | TIMESTAMP       | AUTO                        | Account creation timestamp   |
| updated_at        | TIMESTAMP       | AUTO                        | Last update timestamp        |

**Roles:**

-   `admin` - System administrators
-   `review_team` - Application reviewers
-   `applicant` - Default role for applicants
-   `verified_beneficiary` - Verified scholarship recipients
-   `scholar` - Current scholars
-   `user` - Basic registered users

**Indexes:**

-   PRIMARY KEY: `id`
-   UNIQUE: `email`
-   INDEX: `created_at` (for sorting)

**Sample Data:**

```sql
INSERT INTO users (name, email, password, role, email_verified_at, terms_accepted, created_at, updated_at)
VALUES
('Admin User', 'oa@olaarowolo.com', '$2y$12$...hashed...', 'admin', NOW(), true, NOW(), NOW()),
('John Doe', 'john@example.com', '$2y$12$...hashed...', 'applicant', NOW(), true, NOW(), NOW());
```

---

### 2. Applications Table

**Purpose:** Store scholarship application submissions with documents.

**Table Name:** `applications`

| Column          | Type            | Attributes                       | Description                        |
| --------------- | --------------- | -------------------------------- | ---------------------------------- |
| id              | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT      | Unique application identifier      |
| application_id  | VARCHAR(255)    | UNIQUE, NOT NULL                 | Human-readable ID (OA-YYYY-XXXXXX) |
| user_id         | BIGINT UNSIGNED | FOREIGN KEY → users.id, NULLABLE | Applicant user ID                  |
| first_name      | VARCHAR(255)    | NOT NULL                         | Applicant's first name             |
| last_name       | VARCHAR(255)    | NULLABLE                         | Applicant's last name              |
| date_of_birth   | DATE            | NULLABLE                         | Date of birth                      |
| address         | TEXT            | NOT NULL                         | Residential address                |
| lga             | VARCHAR(255)    | NULLABLE                         | Local Government Area              |
| town            | VARCHAR(255)    | NULLABLE                         | Town/city                          |
| phone           | VARCHAR(255)    | NOT NULL                         | Contact phone number               |
| jamb_reg_number | VARCHAR(255)    | NULLABLE                         | JAMB registration number           |
| jamb_score      | DECIMAL(5,2)    | NULLABLE                         | JAMB/UTME score (180-400)          |
| institution     | VARCHAR(255)    | NOT NULL                         | University/institution name        |
| course          | VARCHAR(255)    | NOT NULL                         | Course of study                    |
| passport_photo  | VARCHAR(255)    | NULLABLE                         | Path to passport photo             |
| id_card         | VARCHAR(255)    | NULLABLE                         | Path to ID card image              |
| jamb_result     | VARCHAR(255)    | NULLABLE                         | Path to JAMB result                |
| status          | ENUM            | DEFAULT 'draft'                  | Application status                 |
| notes           | TEXT            | NULLABLE                         | Admin notes/comments               |
| created_at      | TIMESTAMP       | AUTO                             | Application submission timestamp   |
| updated_at      | TIMESTAMP       | AUTO                             | Last update timestamp              |

**Status Values:**

-   `draft` - Application started but not submitted
-   `submitted` - Application submitted, awaiting review
-   `under_review` - Application being reviewed
-   `approved` - Application approved
-   `rejected` - Application rejected

**Indexes:**

-   PRIMARY KEY: `id`
-   UNIQUE: `application_id`
-   FOREIGN KEY: `user_id` → `users(id)` ON DELETE CASCADE
-   INDEX: `status` (for filtering)
-   INDEX: `created_at` (for sorting)

**Constraints:**

-   `user_id` cascades on delete (removes applications when user deleted)
-   `application_id` must be unique

**Sample Data:**

```sql
INSERT INTO applications (
    application_id, user_id, first_name, last_name, date_of_birth,
    address, lga, town, phone, jamb_reg_number, jamb_score,
    institution, course, status, created_at, updated_at
)
VALUES (
    'OA-2025-AB1234', 1, 'John', 'Doe', '2005-03-15',
    '123 Main Street, Iba Town', 'Ojo', 'Iba', '08012345678',
    '12345678AB', 285.00, 'University of Lagos', 'Computer Science',
    'submitted', NOW(), NOW()
);
```

---

### 3. Form Settings Table

**Purpose:** Control form availability and scheduling.

**Table Name:** `form_settings`

| Column         | Type            | Attributes                  | Description                    |
| -------------- | --------------- | --------------------------- | ------------------------------ |
| id             | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique setting ID              |
| form_name      | VARCHAR(255)    | UNIQUE, NOT NULL            | Form identifier                |
| is_open        | BOOLEAN         | DEFAULT false               | Whether form is currently open |
| opens_at       | DATETIME        | NULLABLE                    | Scheduled opening date/time    |
| closes_at      | DATETIME        | NULLABLE                    | Scheduled closing date/time    |
| closed_message | TEXT            | NULLABLE                    | Message shown when form closed |
| created_at     | TIMESTAMP       | AUTO                        | Record creation timestamp      |
| updated_at     | TIMESTAMP       | AUTO                        | Last update timestamp          |

**Form Names:**

-   `application_form` - Main scholarship application
-   `scholar_requests` - Scholar support requests
-   `academic_standing` - Academic progress submissions

**Indexes:**

-   PRIMARY KEY: `id`
-   UNIQUE: `form_name`

**Sample Data:**

```sql
INSERT INTO form_settings (form_name, is_open, opens_at, closes_at, closed_message, created_at, updated_at)
VALUES
('application_form', true, '2025-01-15 00:00:00', '2025-03-31 23:59:59',
 'Applications for 2025 scholarship are currently closed.', NOW(), NOW());
```

---

### 4. Password Reset Tokens Table

**Purpose:** Store password reset tokens for user authentication recovery.

**Table Name:** `password_reset_tokens`

| Column     | Type         | Attributes  | Description              |
| ---------- | ------------ | ----------- | ------------------------ |
| email      | VARCHAR(255) | PRIMARY KEY | User email address       |
| token      | VARCHAR(255) | NOT NULL    | Reset token (hashed)     |
| created_at | TIMESTAMP    | NULLABLE    | Token creation timestamp |

**Indexes:**

-   PRIMARY KEY: `email`

**Token Expiration:** 60 minutes (configurable in `config/auth.php`)

---

### 5. Sessions Table

**Purpose:** Store user session data for authentication.

**Table Name:** `sessions`

| Column        | Type            | Attributes                              | Description             |
| ------------- | --------------- | --------------------------------------- | ----------------------- |
| id            | VARCHAR(255)    | PRIMARY KEY                             | Session ID              |
| user_id       | BIGINT UNSIGNED | FOREIGN KEY → users.id, NULLABLE, INDEX | Associated user ID      |
| ip_address    | VARCHAR(45)     | NULLABLE                                | IP address              |
| user_agent    | TEXT            | NULLABLE                                | Browser user agent      |
| payload       | LONGTEXT        | NOT NULL                                | Serialized session data |
| last_activity | INTEGER         | INDEX, NOT NULL                         | Last activity timestamp |

**Indexes:**

-   PRIMARY KEY: `id`
-   INDEX: `user_id`
-   INDEX: `last_activity` (for cleanup)

---

### 6. Cache Table

**Purpose:** Store application cache data.

**Table Name:** `cache`

| Column     | Type         | Attributes      | Description          |
| ---------- | ------------ | --------------- | -------------------- |
| key        | VARCHAR(255) | PRIMARY KEY     | Cache key            |
| value      | MEDIUMTEXT   | NOT NULL        | Cached value         |
| expiration | INTEGER      | INDEX, NOT NULL | Expiration timestamp |

**Indexes:**

-   PRIMARY KEY: `key`
-   INDEX: `expiration` (for cleanup)

---

### 7. Jobs Table

**Purpose:** Store queued jobs for background processing.

**Table Name:** `jobs`

| Column       | Type             | Attributes                  | Description                |
| ------------ | ---------------- | --------------------------- | -------------------------- |
| id           | BIGINT UNSIGNED  | PRIMARY KEY, AUTO_INCREMENT | Job ID                     |
| queue        | VARCHAR(255)     | INDEX, NOT NULL             | Queue name                 |
| payload      | LONGTEXT         | NOT NULL                    | Job data                   |
| attempts     | TINYINT UNSIGNED | NOT NULL                    | Number of attempts         |
| reserved_at  | INTEGER UNSIGNED | NULLABLE                    | When job was reserved      |
| available_at | INTEGER UNSIGNED | INDEX, NOT NULL             | When job becomes available |
| created_at   | INTEGER UNSIGNED | NOT NULL                    | Job creation timestamp     |

**Indexes:**

-   PRIMARY KEY: `id`
-   INDEX: `queue`
-   INDEX: `available_at`

---

### 8. Failed Jobs Table

**Purpose:** Store information about failed queued jobs.

**Table Name:** `failed_jobs`

| Column     | Type            | Attributes                  | Description       |
| ---------- | --------------- | --------------------------- | ----------------- |
| id         | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Failed job ID     |
| uuid       | VARCHAR(255)    | UNIQUE, NOT NULL            | Job UUID          |
| connection | TEXT            | NOT NULL                    | Connection name   |
| queue      | TEXT            | NOT NULL                    | Queue name        |
| payload    | LONGTEXT        | NOT NULL                    | Job data          |
| exception  | LONGTEXT        | NOT NULL                    | Exception details |
| failed_at  | TIMESTAMP       | DEFAULT CURRENT_TIMESTAMP   | Failure timestamp |

**Indexes:**

-   PRIMARY KEY: `id`
-   UNIQUE: `uuid`

---

## Relationships

### User → Applications (One-to-Many)

```php
// User Model
public function applications()
{
    return $this->hasMany(Application::class);
}

// Application Model
public function user()
{
    return $this->belongsTo(User::class);
}
```

**SQL:**

```sql
-- Get user with applications
SELECT users.*, applications.*
FROM users
LEFT JOIN applications ON users.id = applications.user_id
WHERE users.id = 1;
```

**Usage:**

```php
// Get user's applications
$user = User::find(1);
$applications = $user->applications;

// Get application's user
$application = Application::find(1);
$user = $application->user;
```

---

## Migrations

### Migration Order

Migrations run in filename order (chronological):

1. `0001_01_01_000000_create_users_table.php`
2. `0001_01_01_000001_create_cache_table.php`
3. `0001_01_01_000002_create_jobs_table.php`
4. `2025_12_02_115934_add_role_to_users_table.php`
5. `2025_12_02_124617_create_applications_table.php`
6. `2025_12_05_193736_add_terms_fields_to_users_table.php`
7. `2025_12_05_200110_make_user_id_nullable_in_applications_table.php`
8. `2025_12_05_200717_add_missing_fields_to_applications_table.php`
9. `2025_12_05_211221_make_jamb_score_nullable_in_applications_table.php`
10. `2025_12_05_231945_add_is_iba_indigene_to_users_table.php`
11. `2025_12_05_235848_add_scholar_role_to_users_table.php`
12. `2025_12_06_002321_create_form_settings_table.php`

### Running Migrations

```bash
# Run all pending migrations
php artisan migrate

# Run migrations with output
php artisan migrate -v

# Run migrations on production (with confirmation)
php artisan migrate --force

# Check migration status
php artisan migrate:status

# Rollback last batch
php artisan migrate:rollback

# Rollback specific number of migrations
php artisan migrate:rollback --step=3

# Rollback all migrations
php artisan migrate:reset

# Rollback all and re-run
php artisan migrate:refresh

# Fresh migration (drops all tables)
php artisan migrate:fresh
```

### Creating New Migrations

```bash
# Create new migration
php artisan make:migration create_beneficiaries_table

# Create migration with table creation
php artisan make:migration create_beneficiaries_table --create=beneficiaries

# Create migration to modify table
php artisan make:migration add_status_to_beneficiaries --table=beneficiaries
```

### Migration Best Practices

1. **Always create down() method** for rollback capability
2. **Use descriptive names** for migrations
3. **Don't modify existing migrations** once deployed
4. **Use nullable() wisely** for optional fields
5. **Add indexes** for frequently queried columns
6. **Use foreign keys** for relationships with cascades

**Example Migration:**

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->decimal('funding_amount', 10, 2);
            $table->enum('funding_status', ['active', 'paused', 'completed']);
            $table->timestamps();

            // Indexes
            $table->index('funding_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
```

---

## Seeders

### Running Seeders

```bash
# Run all seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=UserSeeder

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

### Database Seeder

**File:** `database/seeders/DatabaseSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Application;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'oa@olaarowolo.com',
            'password' => Hash::make('O@rowolo2021'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'terms_accepted' => true,
        ]);

        // Create test users with applications
        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) {
                Application::factory()->create([
                    'user_id' => $user->id,
                ]);
            });
    }
}
```

### Creating Custom Seeders

```bash
# Create new seeder
php artisan make:seeder FormSettingsSeeder
```

**Example Seeder:**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormSettingsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('form_settings')->insert([
            [
                'form_name' => 'application_form',
                'is_open' => true,
                'opens_at' => '2025-01-15 00:00:00',
                'closes_at' => '2025-03-31 23:59:59',
                'closed_message' => 'Applications are currently closed.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'form_name' => 'scholar_requests',
                'is_open' => true,
                'opens_at' => null,
                'closes_at' => null,
                'closed_message' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
```

---

## Indexes and Performance

### Current Indexes

**Users Table:**

-   `PRIMARY KEY (id)`
-   `UNIQUE (email)`

**Applications Table:**

-   `PRIMARY KEY (id)`
-   `UNIQUE (application_id)`
-   `INDEX (user_id)` - Foreign key
-   `INDEX (status)` - For filtering
-   `INDEX (created_at)` - For sorting

**Sessions Table:**

-   `PRIMARY KEY (id)`
-   `INDEX (user_id)`
-   `INDEX (last_activity)` - For cleanup

**Jobs Table:**

-   `PRIMARY KEY (id)`
-   `INDEX (queue)`
-   `INDEX (available_at)`

### Query Optimization Tips

```php
// ✅ Good - Eager loading
$users = User::with('applications')->get();

// ❌ Bad - N+1 query problem
$users = User::all();
foreach ($users as $user) {
    echo $user->applications->count();
}

// ✅ Good - Select only needed columns
$users = User::select('id', 'name', 'email')->get();

// ✅ Good - Use pagination
$applications = Application::paginate(15);

// ✅ Good - Use indexes in WHERE clauses
$applications = Application::where('status', 'submitted')->get();
```

### Adding Indexes

```php
// In migration
Schema::table('applications', function (Blueprint $table) {
    $table->index('jamb_score'); // For range queries
    $table->index(['status', 'created_at']); // Composite index
});
```

---

## Data Integrity

### Foreign Key Constraints

```php
// Cascade delete - Remove applications when user deleted
$table->foreignId('user_id')
    ->constrained()
    ->onDelete('cascade');

// Restrict delete - Prevent user deletion if applications exist
$table->foreignId('user_id')
    ->constrained()
    ->onDelete('restrict');

// Set null - Set user_id to null when user deleted
$table->foreignId('user_id')
    ->nullable()
    ->constrained()
    ->onDelete('set null');
```

### Data Validation

**Model Level:**

```php
// Application Model
protected $fillable = [
    'first_name',
    'last_name',
    // ... other fields
];

protected $casts = [
    'date_of_birth' => 'date',
    'jamb_score' => 'decimal:2',
    'created_at' => 'datetime',
];
```

**Database Level:**

```sql
-- Check constraints (MySQL 8.0.16+)
ALTER TABLE applications
ADD CONSTRAINT check_jamb_score
CHECK (jamb_score >= 180 AND jamb_score <= 400);
```

---

## Backup and Restore

### Manual Backup

```bash
# Backup database
mysqldump -u username -p scholarship_db > backup_$(date +%Y%m%d).sql

# Backup with compression
mysqldump -u username -p scholarship_db | gzip > backup_$(date +%Y%m%d).sql.gz

# Backup specific tables
mysqldump -u username -p scholarship_db users applications > backup_users_apps.sql
```

### Restore Database

```bash
# Restore from backup
mysql -u username -p scholarship_db < backup_20251206.sql

# Restore from compressed backup
gunzip < backup_20251206.sql.gz | mysql -u username -p scholarship_db
```

### Automated Backup Script

```bash
#!/bin/bash
# backup-database.sh

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/home/backup/scholarship"
DB_NAME="scholarship_db"
DB_USER="scholarship_user"
DB_PASS="password"

mkdir -p $BACKUP_DIR

# Create backup
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | gzip > $BACKUP_DIR/scholarship_$DATE.sql.gz

# Keep only last 30 days
find $BACKUP_DIR -name "scholarship_*.sql.gz" -mtime +30 -delete

echo "Backup completed: scholarship_$DATE.sql.gz"
```

### Laravel Backup Package

```bash
# Install package
composer require spatie/laravel-backup

# Configure
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"

# Run backup
php artisan backup:run

# List backups
php artisan backup:list

# Clean old backups
php artisan backup:clean
```

---

## Queries and Examples

### Common Queries

#### Get All Pending Applications

```php
$pending = Application::where('status', 'submitted')
    ->with('user')
    ->orderBy('created_at', 'desc')
    ->get();
```

```sql
SELECT applications.*, users.*
FROM applications
INNER JOIN users ON applications.user_id = users.id
WHERE applications.status = 'submitted'
ORDER BY applications.created_at DESC;
```

#### Get User's Latest Application

```php
$latestApplication = $user->applications()
    ->latest()
    ->first();
```

```sql
SELECT *
FROM applications
WHERE user_id = 1
ORDER BY created_at DESC
LIMIT 1;
```

#### Count Applications by Status

```php
$statusCounts = Application::select('status', DB::raw('count(*) as count'))
    ->groupBy('status')
    ->get();
```

```sql
SELECT status, COUNT(*) as count
FROM applications
GROUP BY status;
```

#### Get Top Applicants by JAMB Score

```php
$topScorers = Application::where('status', 'submitted')
    ->orderBy('jamb_score', 'desc')
    ->limit(10)
    ->get();
```

```sql
SELECT *
FROM applications
WHERE status = 'submitted'
ORDER BY jamb_score DESC
LIMIT 10;
```

#### Search Applications

```php
$results = Application::where('first_name', 'like', "%{$search}%")
    ->orWhere('last_name', 'like', "%{$search}%")
    ->orWhere('application_id', 'like', "%{$search}%")
    ->orWhere('institution', 'like', "%{$search}%")
    ->get();
```

```sql
SELECT *
FROM applications
WHERE first_name LIKE '%John%'
   OR last_name LIKE '%John%'
   OR application_id LIKE '%John%'
   OR institution LIKE '%John%';
```

#### Get Applications Within Date Range

```php
$applications = Application::whereBetween('created_at', [$startDate, $endDate])
    ->get();
```

```sql
SELECT *
FROM applications
WHERE created_at BETWEEN '2025-01-01' AND '2025-12-31';
```

#### Update Application Status

```php
$application = Application::find(1);
$application->update([
    'status' => 'approved',
    'notes' => 'Approved based on excellent credentials.',
]);
```

```sql
UPDATE applications
SET status = 'approved',
    notes = 'Approved based on excellent credentials.',
    updated_at = NOW()
WHERE id = 1;
```

---

## Database Maintenance

### Optimize Tables

```sql
-- Optimize all tables
OPTIMIZE TABLE users, applications, sessions;

-- Analyze tables
ANALYZE TABLE users, applications;
```

### Clean Old Sessions

```bash
# Laravel command
php artisan session:table
php artisan migrate

# Or manually
DELETE FROM sessions WHERE last_activity < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 120 MINUTE));
```

### Monitor Database Size

```sql
-- Check database size
SELECT
    table_schema AS 'Database',
    ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS 'Size (MB)'
FROM information_schema.tables
WHERE table_schema = 'scholarship_db'
GROUP BY table_schema;

-- Check table sizes
SELECT
    table_name AS 'Table',
    ROUND(((data_length + index_length) / 1024 / 1024), 2) AS 'Size (MB)'
FROM information_schema.tables
WHERE table_schema = 'scholarship_db'
ORDER BY (data_length + index_length) DESC;
```

---

## Security Best Practices

### 1. Use Parameterized Queries

```php
// ✅ Good - Using Eloquent ORM
$user = User::where('email', $email)->first();

// ✅ Good - Using query builder with bindings
$users = DB::select('SELECT * FROM users WHERE email = ?', [$email]);

// ❌ Bad - SQL injection risk
$users = DB::select("SELECT * FROM users WHERE email = '$email'");
```

### 2. Encrypt Sensitive Data

```php
use Illuminate\Support\Facades\Crypt;

// Encrypt before storing
$encrypted = Crypt::encryptString($sensitiveData);

// Decrypt when retrieving
$decrypted = Crypt::decryptString($encrypted);
```

### 3. Hash Passwords

```php
use Illuminate\Support\Facades\Hash;

// Always hash passwords
$user->password = Hash::make($request->password);

// Verify passwords
if (Hash::check($password, $user->password)) {
    // Password correct
}
```

### 4. Use Database Transactions

```php
use Illuminate\Support\Facades\DB;

DB::transaction(function () {
    // Multiple database operations
    $user = User::create($userData);
    $application = Application::create([
        'user_id' => $user->id,
        // ... other data
    ]);
});
```

---

## Troubleshooting

### Common Issues

#### Migration Failed

```bash
# Check migration status
php artisan migrate:status

# Rollback and try again
php artisan migrate:rollback
php artisan migrate

# Reset and migrate fresh (CAUTION: Drops all tables)
php artisan migrate:fresh
```

#### Foreign Key Constraint Error

```
SQLSTATE[23000]: Integrity constraint violation
```

**Solution:** Ensure parent record exists before creating child record

```php
// ✅ Create user first, then application
$user = User::create($userData);
$application = Application::create(['user_id' => $user->id, ...]);
```

#### Duplicate Entry Error

```
SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry
```

**Solution:** Check for existing records before inserting

```php
// Check if email exists
if (User::where('email', $email)->exists()) {
    // Handle duplicate
}
```

---

## Additional Resources

-   [Laravel Database Documentation](https://laravel.com/docs/database)
-   [Laravel Migrations Documentation](https://laravel.com/docs/migrations)
-   [Laravel Eloquent ORM](https://laravel.com/docs/eloquent)
-   [MySQL Documentation](https://dev.mysql.com/doc/)

---

**Last Updated:** December 6, 2025  
**Version:** 1.0.0
