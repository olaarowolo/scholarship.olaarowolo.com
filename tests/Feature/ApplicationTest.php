<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_apply_form_page_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/apply-form');

        $response->assertStatus(200);
        $response->assertViewIs('apply-form');
    }

    public function test_application_can_be_submitted_successfully()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $data = [
            'hasTakenJamb' => 'Yes',
            'needsJambSupport' => '',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'dateOfBirth' => '2000-01-01',
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'lga' => 'Ojo',
            'town' => 'Iba',
            'isIndigene' => 'Yes',
            'jambRegNumber' => '12345678AB',
            'jambScore' => 250,
            'waecGceYear' => '2023',
            'institution' => $this->faker->company,
            'course' => $this->faker->jobTitle,
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->create('jamb.pdf', 1000),
            'waecResult' => UploadedFile::fake()->create('waec.pdf', 1000),
            'indigeneCert' => UploadedFile::fake()->create('indigene.pdf', 1000),
        ];

        $response = $this->actingAs($user)->post('/apply-form', $data);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Application submitted successfully!',
        ]);

        $this->assertDatabaseHas('applications', [
            'user_id' => $user->id,
            'first_name' => $data['firstName'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'jamb_score' => $data['jambScore'],
            'institution' => $data['institution'],
            'course' => $data['course'],
            'status' => 'submitted',
        ]);
    }

    public function test_application_submission_validation_fails_with_missing_fields()
    {
        $user = User::factory()->create();

        $data = [
            'firstName' => '',
            'email' => 'invalid-email',
        ];

        $response = $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/apply-form', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'hasTakenJamb',
            'firstName',
            'lastName',
            'dateOfBirth',
            'email',
            'phone',
            'address',
            'lga',
            'town',
            'isIndigene',
            'waecGceYear',
            'institution',
            'course',
            'admissionStatus',
            'jambResult',
            'waecResult',
            'indigeneCert'
        ]);
    }

    public function test_application_submission_validation_fails_with_invalid_jamb_score()
    {
        $user = User::factory()->create();

        $data = [
            'fullName' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'isIndigene' => 'Yes',
            'jambScore' => 150, // Below minimum
            'waecGceYear' => '2023',
            'institution' => $this->faker->company,
            'course' => $this->faker->jobTitle,
            'admissionStatus' => 'Admitted',
            'jambResult' => UploadedFile::fake()->create('jamb.pdf', 1000),
            'waecResult' => UploadedFile::fake()->create('waec.pdf', 1000),
            'indigeneCert' => UploadedFile::fake()->create('indigene.pdf', 1000),
        ];

        $response = $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/apply-form', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('jambScore');
    }

    public function test_application_submission_validation_fails_with_invalid_file_types()
    {
        $user = User::factory()->create();

        $data = [
            'fullName' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'isIndigene' => 'Yes',
            'jambScore' => 250,
            'waecGceYear' => '2023',
            'institution' => $this->faker->company,
            'course' => $this->faker->jobTitle,
            'admissionStatus' => 'Admitted',
            'jambResult' => UploadedFile::fake()->create('jamb.txt', 1000), // Invalid type
            'waecResult' => UploadedFile::fake()->create('waec.pdf', 1000),
            'indigeneCert' => UploadedFile::fake()->create('indigene.pdf', 1000),
        ];

        $response = $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/apply-form', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('jambResult');
    }

    public function test_application_submission_validation_fails_with_large_files()
    {
        $user = User::factory()->create();

        $data = [
            'fullName' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'isIndigene' => 'Yes',
            'jambScore' => 250,
            'waecGceYear' => '2023',
            'institution' => $this->faker->company,
            'course' => $this->faker->jobTitle,
            'admissionStatus' => 'Admitted',
            'jambResult' => UploadedFile::fake()->create('jamb.pdf', 6000), // Too large
            'waecResult' => UploadedFile::fake()->create('waec.pdf', 1000),
            'indigeneCert' => UploadedFile::fake()->create('indigene.pdf', 1000),
        ];

        $response = $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/apply-form', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('jambResult');
    }
}
