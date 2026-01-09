<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FormSetting;
use Carbon\Carbon;

class FormSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forms = [
            [
                'form_name' => 'application_form',
                'is_open' => true,
                'opens_at' => Carbon::create(2025, 12, 8, 0, 0, 0),
                'closes_at' => Carbon::create(2026, 1, 16, 23, 59, 59),
                'closed_message' => 'The Scholarship Application Form is currently closed. Please check back later for the next application period.',
            ],
            [
                'form_name' => 'scholar_requests',
                'is_open' => false,
                'opens_at' => null,
                'closes_at' => null,
                'closed_message' => 'The Scholar Request Form is currently closed.',
            ],
            [
                'form_name' => 'academic_standing',
                'is_open' => false,
                'opens_at' => null,
                'closes_at' => null,
                'closed_message' => 'The Academic Standing Report Form is currently closed.',
            ],
            [
                'form_name' => 'challenges',
                'is_open' => false,
                'opens_at' => null,
                'closes_at' => null,
                'closed_message' => 'The Challenge Documentation Form is currently closed.',
            ],
            [
                'form_name' => 'mentorship',
                'is_open' => false,
                'opens_at' => null,
                'closes_at' => null,
                'closed_message' => 'The Mentorship Booking Form is currently closed.',
            ],
            [
                'form_name' => 'advice',
                'is_open' => false,
                'opens_at' => null,
                'closes_at' => null,
                'closed_message' => 'The Academic Advice Request Form is currently closed.',
            ],
        ];

        foreach ($forms as $form) {
            FormSetting::updateOrCreate(
                ['form_name' => $form['form_name']],
                $form
            );
        }
    }
}
