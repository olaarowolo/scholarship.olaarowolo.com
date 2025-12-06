<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if doesn't exist
        User::firstOrCreate(
            ['email' => 'oa@olaarowolo.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('O@rowolo2021'),
                'role' => 'admin',
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
                'marketing_accepted' => false,
                'is_iba_indigene' => true,
            ]
        );

        $this->command->info('Admin user created successfully!');
    }
}
