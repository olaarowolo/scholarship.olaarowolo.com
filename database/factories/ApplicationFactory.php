<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date(),
            'address' => $this->faker->address,
            'lga' => $this->faker->city,
            'town' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
            'jamb_reg_number' => strtoupper($this->faker->bothify('####??####')),
            'jamb_score' => $this->faker->numberBetween(180, 400),
            'institution' => $this->faker->company,
            'course' => $this->faker->jobTitle,
            'passport_photo' => 'applications/passport_photos/test.jpg',
            'id_card' => 'applications/id_cards/test.jpg',
            'jamb_result' => 'applications/jamb_results/test.jpg',
            'status' => 'draft',
            'notes' => $this->faker->sentence,
            'application_id' => 'APP-' . strtoupper($this->faker->bothify('########')),
        ];
    }
}
