<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@olaarowolo.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Create Scholar User
        User::factory()->create([
            'name' => 'John Scholar',
            'email' => 'scholar@olaarowolo.com',
            'role' => 'scholar',
            'password' => bcrypt('password'),
        ]);

        // Create Applicant User
        User::factory()->create([
            'name' => 'Jane Applicant',
            'email' => 'applicant@olaarowolo.com',
            'role' => 'applicant',
            'password' => bcrypt('password'),
        ]);

        // Create Review Team User
        User::factory()->create([
            'name' => 'Review Team Member',
            'email' => 'reviewer@olaarowolo.com',
            'role' => 'review_team',
            'password' => bcrypt('password'),
        ]);

        // Create Verified Beneficiary User
        User::factory()->create([
            'name' => 'Verified Beneficiary',
            'email' => 'beneficiary@olaarowolo.com',
            'role' => 'verified_beneficiary',
            'password' => bcrypt('password'),
        ]);

        // Create Regular User
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);
    }
}
