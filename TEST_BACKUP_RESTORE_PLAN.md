# Backup, Test, Fix, and Restore Plan

Goal: run the test suite while ensuring the production/development SQLite database is fully backed up and can be restored without data loss. After tests and any code fixes, restore the original data and remap any schema changes so existing data remains intact.

Prerequisites
- Windows environment (current workspace).
- PHP and Composer installed.
- Ensure git working tree is clean (commit or stash local changes).

Overview
- Create a timestamped backup of the live SQLite DB.
- Run the test suite.
- If tests or migrations modify the DB schema in a destructive way, restore the backup.
- Apply targeted migration fixes (idempotent checks) and rerun tests until green.
- When schema changes are required to persist, perform a migration that preserves and remaps existing data.
- Create a final backup of the migrated DB and verify data integrity.

Detailed steps

1) Prepare
- Commit or stash all local changes: git add -A && git commit -m "WIP: save before test-backup" (or stash)
- Ensure no other processes are writing to database/database.sqlite

2) Create a snapshot backup (safe, timestamped)
- Run the backup script: php backup.php
- Note the printed backup path (database/backups/database.sqlite.YYYYMMDD_HHMMSS.bak)
- Also keep the pre-existing backups (database/database.sqlite.bak and database/database.sqlite.zip) as additional safety copies.

3) Run the tests (non-destructive attempt)
- Run the test suite: php artisan test
- Observe failures and note any migration issues or unexpected schema changes.

4) If tests change or break the DB schema unexpectedly
- Immediately stop and restore the original DB from the backup you created in step 2.
  - Copy the backup file back to database/database.sqlite (Windows): copy "<backup-path>" database\database.sqlite
- Re-run only the failing tests locally (use --filter) to reproduce and debug safely.

5) Fix migrations and code (iterative)
- Make migration changes idempotent and resilient to different migration orders (check Schema::hasColumn before adding/dropping).
- Avoid dropping or recreating the live table in a way that loses data; for SQLite emulate ALTER by creating a temp table and copying only the columns that exist or by using explicit SQL that SELECTs NULL for missing columns.
- Use small, well-targeted migration files for each logical change (add column X, add column Y) and make them safe in tests by checking columns first.
- Run php artisan migrate --path=database/migrations/<file> if you want to apply a single migration for testing.
- Re-run the tests after each fix.

6) If a migration *must* transform data (remapping)
- Create a migration that:
  - Adds the new columns as nullable.
  - Runs a DB transaction that copies data from legacy columns to new columns (INSERT INTO ... SELECT ...), using COALESCE or CASE to handle missing columns.
  - After verification, sets columns NOT NULL or removes legacy columns in a separate reversible migration.
- Test the migration against a copy of the production DB first.

7) Finalize and restore
- After tests pass and fixes applied:
  - Create a post-migration backup: php backup.php
  - If you restored the original DB earlier and then applied non-destructive migrations to the live DB, ensure you replay the remapping migration using the backed-up data.

8) Verify
- Run a set of smoke checks against key tables (count rows, sample records).
- Compare important fields before/after migration to ensure parity.

Reverting to pre-test state (if necessary)
- If anything goes wrong, restore the original snapshot: copy "<backup-path>" database\database.sqlite

Notes and best practices
- Never modify production data directly during test fixes — operate on a copy first.
- Keep migrations small and additive; prefer adding nullable columns and filling them later.
- Keep an audit trail (create a migration log or meta file for each backup and migration run)

Example commands (Windows)
- Backup: php backup.php
- Restore: copy "database\\backups\\database.sqlite.YYYYMMDD_HHMMSS.bak" database\\database.sqlite
- Run tests: php artisan test
- Run a single migration: php artisan migrate --path=database/migrations/2026_01_09_000003_add_missing_columns_to_applications.php

If you want, I will:
- Create a timestamped backup now (php backup.php)
- Run the test suite and capture results
- If tests cause destructive migration, restore the DB from the backup and produce a remediation patch and a remap migration to migrate your data safely

End of plan.