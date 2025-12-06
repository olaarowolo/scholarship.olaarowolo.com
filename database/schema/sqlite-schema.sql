CREATE TABLE IF NOT EXISTS "migrations"(
  "id" integer primary key autoincrement not null,
  "migration" varchar not null,
  "batch" integer not null
);
CREATE TABLE IF NOT EXISTS "password_reset_tokens"(
  "email" varchar not null,
  "token" varchar not null,
  "created_at" datetime,
  primary key("email")
);
CREATE TABLE IF NOT EXISTS "sessions"(
  "id" varchar not null,
  "user_id" integer,
  "ip_address" varchar,
  "user_agent" text,
  "payload" text not null,
  "last_activity" integer not null,
  primary key("id")
);
CREATE INDEX "sessions_user_id_index" on "sessions"("user_id");
CREATE INDEX "sessions_last_activity_index" on "sessions"("last_activity");
CREATE TABLE IF NOT EXISTS "cache"(
  "key" varchar not null,
  "value" text not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "cache_locks"(
  "key" varchar not null,
  "owner" varchar not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "jobs"(
  "id" integer primary key autoincrement not null,
  "queue" varchar not null,
  "payload" text not null,
  "attempts" integer not null,
  "reserved_at" integer,
  "available_at" integer not null,
  "created_at" integer not null
);
CREATE INDEX "jobs_queue_index" on "jobs"("queue");
CREATE TABLE IF NOT EXISTS "job_batches"(
  "id" varchar not null,
  "name" varchar not null,
  "total_jobs" integer not null,
  "pending_jobs" integer not null,
  "failed_jobs" integer not null,
  "failed_job_ids" text not null,
  "options" text,
  "cancelled_at" integer,
  "created_at" integer not null,
  "finished_at" integer,
  primary key("id")
);
CREATE TABLE IF NOT EXISTS "failed_jobs"(
  "id" integer primary key autoincrement not null,
  "uuid" varchar not null,
  "connection" text not null,
  "queue" text not null,
  "payload" text not null,
  "exception" text not null,
  "failed_at" datetime not null default CURRENT_TIMESTAMP
);
CREATE UNIQUE INDEX "failed_jobs_uuid_unique" on "failed_jobs"("uuid");
CREATE TABLE IF NOT EXISTS "applications"(
  "id" integer primary key autoincrement not null,
  "application_id" varchar not null,
  "user_id" integer,
  "first_name" varchar not null,
  "last_name" varchar,
  "date_of_birth" date,
  "address" text not null,
  "lga" varchar,
  "town" varchar,
  "phone" varchar not null,
  "jamb_reg_number" varchar,
  "jamb_score" numeric,
  "institution" varchar not null,
  "course" varchar not null,
  "passport_photo" varchar,
  "id_card" varchar,
  "jamb_result" varchar,
  "status" varchar not null default('draft'),
  "notes" text,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("user_id") references users("id") on delete cascade on update no action
);
CREATE UNIQUE INDEX "applications_application_id_unique" on "applications"(
  "application_id"
);
CREATE TABLE IF NOT EXISTS "users"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "email" varchar not null,
  "email_verified_at" datetime,
  "password" varchar not null,
  "remember_token" varchar,
  "created_at" datetime,
  "updated_at" datetime,
  "role" varchar check("role" in('admin', 'review_team', 'applicant', 'verified_beneficiary', 'user', 'scholar')) not null default 'applicant',
  "terms_accepted" tinyint(1) not null default '0',
  "device" varchar,
  "location" varchar,
  "credentials" text,
  "is_iba_indigene" tinyint(1) not null default '0',
  "terms_accepted_at" datetime,
  "marketing_accepted" tinyint(1) not null default '0',
  "two_factor_enabled" tinyint(1) not null default '0',
  "two_factor_code" varchar,
  "two_factor_expires_at" datetime
);
CREATE UNIQUE INDEX "users_temp_email_unique" on "users"("email");
CREATE TABLE IF NOT EXISTS "form_settings"(
  "id" integer primary key autoincrement not null,
  "form_name" varchar not null,
  "is_open" tinyint(1) not null default '0',
  "opens_at" datetime,
  "closes_at" datetime,
  "closed_message" text,
  "created_at" datetime,
  "updated_at" datetime
);
CREATE UNIQUE INDEX "form_settings_form_name_unique" on "form_settings"(
  "form_name"
);

INSERT INTO migrations VALUES(1,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO migrations VALUES(4,'2025_12_02_124617_create_applications_table',1);
INSERT INTO migrations VALUES(5,'2025_12_05_200110_make_user_id_nullable_in_applications_table',1);
INSERT INTO migrations VALUES(6,'2025_12_05_200717_add_missing_fields_to_applications_table',1);
INSERT INTO migrations VALUES(7,'2025_12_05_211221_make_jamb_score_nullable_in_applications_table',1);
INSERT INTO migrations VALUES(8,'2025_12_05_235848_add_scholar_role_to_users_table',1);
INSERT INTO migrations VALUES(9,'2025_12_06_002321_create_form_settings_table',1);
INSERT INTO migrations VALUES(10,'2025_12_06_115516_add_missing_terms_columns_to_users_table',1);
INSERT INTO migrations VALUES(11,'2025_12_06_121658_add_two_factor_columns_to_users_table',1);
