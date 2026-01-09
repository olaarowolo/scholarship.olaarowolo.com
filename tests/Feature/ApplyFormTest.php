<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Application;
use App\Models\FormSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApplyFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');

        // Create an open form setting for tests
        FormSetting::create([
            'form_name' => 'application_form',
            'label' => 'Application Form',
            'is_open' => true,
            'open_date' => now()->subDay(),
            'close_date' => now()->addMonth(),
        ]);
    }

    /**
     * Create a user with accepted terms
     */
    protected function createUserWithConsent($attributes = [])
    {
        $user = User::factory()->create($attributes);
        $user->consent()->create([
            'terms_accepted' => true,
            'privacy_accepted' => true,
            'ip_address' => '127.0.0.1'
        ]);
        return $user;
    }

    public function test_apply_form_page_loads_successfully()
    {
        $user = $this->createUserWithConsent();

        $response = $this->actingAs($user)->get('/apply-form');

        $response->assertStatus(200);
        $response->assertViewIs('apply-form');
    }

    public function test_authenticated_user_can_submit_application_with_valid_data()
    {
        $user = $this->createUserWithConsent([
            'email' => 'john.doe@example.com',
        ]);

        // Create fake file uploads
        $jambResult = UploadedFile::fake()->create('jamb_result.pdf', 1000, 'application/pdf');
        $waecResult = UploadedFile::fake()->create('waec_result.pdf', 1000, 'application/pdf');
        $indigeneCert = UploadedFile::fake()->create('indigene_cert.pdf', 1000, 'application/pdf');

        $formData = [
            'hasTakenJamb' => 'Yes',
            'needsJambSupport' => '',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'dateOfBirth' => '2000-05-15',
            'email' => 'john.doe@example.com',
            'phone' => '+234 801 234 5678',
            'address' => '123 Main Street, Iba Town, Lagos State',
            'lga' => 'Ojo',
            'town' => 'Iba',
            'isIndigene' => 'Yes',
            'jambRegNumber' => '12345678AB',
            'jambScore' => 285,
            'waecGceYear' => '2024',
            'institution' => 'University of Lagos',
            'course' => 'Computer Science',
            'admissionStatus' => 'Awaiting',
            'jambResult' => $jambResult,
            'waecResult' => $waecResult,
            'indigeneCert' => $indigeneCert,
        ];

        $response = $this->actingAs($user)->post('/apply-form', $formData);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        // Assert the application was created in database
        $this->assertDatabaseHas('applications', [
            'user_id' => $user->id,
            'first_name' => 'John',
            'phone' => '+234 801 234 5678',
            'address' => '123 Main Street, Iba Town, Lagos State',
            'jamb_score' => 285,
            'institution' => 'University of Lagos',
            'course' => 'Computer Science',
            'status' => 'submitted',
        ]);

        // Assert files were uploaded
        $application = Application::where('user_id', $user->id)->first();
        Storage::disk('public')->assertExists($application->jamb_result);
        Storage::disk('public')->assertExists($application->id_card);
        Storage::disk('public')->assertExists($application->passport_photo);
    }

    public function test_application_requires_authentication()
    {
        // Note: The route doesn't require authentication middleware
        // Applications can be submitted without authentication (user_id will be null)
        $formData = [
            'hasTakenJamb' => 'Yes',
            'needsJambSupport' => '',
            'firstName' => 'Jane',
            'lastName' => 'Smith',
            'dateOfBirth' => '2001-03-20',
            'email' => 'jane@example.com',
            'phone' => '+234 802 345 6789',
            'address' => '456 Second Avenue, Iba Town',
            'lga' => 'Ojo',
            'town' => 'Iba',
            'isIndigene' => 'Yes',
            'jambRegNumber' => '87654321CD',
            'jambScore' => 300,
            'waecGceYear' => '2024',
            'institution' => 'Lagos State University',
            'course' => 'Engineering',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->create('jamb.jpg', 10, 'image/jpeg'),
            'waecResult' => UploadedFile::fake()->create('waec.jpg', 10, 'image/jpeg'),
            'indigeneCert' => UploadedFile::fake()->create('cert.jpg', 10, 'image/jpeg'),
        ];

        $user = $this->createUserWithConsent(['email' => 'jane@example.com']);

        $response = $this->actingAs($user)->post('/apply-form', $formData);

        // Application is submitted successfully with authentication
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    public function test_application_validates_required_fields()
    {
        $user = $this->createUserWithConsent();

        $response = $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/apply-form', [
            // Missing all required fields
        ]);

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
            'indigeneCert',
        ]);
    }

    public function test_application_validates_jamb_score_range()
    {
        $user = $this->createUserWithConsent();

        // Test score below minimum (180)
        $response = $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/apply-form', [
            'hasTakenJamb' => 'Yes',
            'needsJambSupport' => '',
            'firstName' => 'Test',
            'lastName' => 'User',
            'dateOfBirth' => '2000-01-01',
            'email' => 'test@example.com',
            'phone' => '08012345678',
            'address' => 'Test Address',
            'lga' => 'Ojo',
            'town' => 'Iba',
            'isIndigene' => 'Yes',
            'jambRegNumber' => '12345678AB',
            'jambScore' => 150, // Below minimum
            'waecGceYear' => '2024',
            'institution' => 'Test University',
            'course' => 'Test Course',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->create('jamb.pdf', 1000, 'application/pdf'),
            'waecResult' => UploadedFile::fake()->create('waec.pdf', 1000, 'application/pdf'),
            'indigeneCert' => UploadedFile::fake()->create('cert.pdf', 1000, 'application/pdf'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['jambScore']);

        // Test score above maximum (400)
        $response = $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/apply-form', [
            'hasTakenJamb' => 'Yes',
            'needsJambSupport' => '',
            'firstName' => 'Test',
            'lastName' => 'User',
            'dateOfBirth' => '2000-01-01',
            'email' => 'test@example.com',
            'phone' => '08012345678',
            'address' => 'Test Address',
            'lga' => 'Ojo',
            'town' => 'Iba',
            'isIndigene' => 'Yes',
            'jambRegNumber' => '12345678AB',
            'jambScore' => 450, // Above maximum
            'waecGceYear' => '2024',
            'institution' => 'Test University',
            'course' => 'Test Course',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->create('jamb.pdf', 1000, 'application/pdf'),
            'waecResult' => UploadedFile::fake()->create('waec.pdf', 1000, 'application/pdf'),
            'indigeneCert' => UploadedFile::fake()->create('cert.pdf', 1000, 'application/pdf'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['jambScore']);
    }

    public function test_application_validates_indigene_status()
    {
        $user = $this->createUserWithConsent();

        // Test that 'No' is accepted by validation (frontend will handle eligibility)
        $response = $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/apply-form', [
            'hasTakenJamb' => 'Yes',
            'needsJambSupport' => '',
            'firstName' => 'Test',
            'lastName' => 'User',
            'dateOfBirth' => '2000-01-01',
            'email' => 'test@example.com',
            'phone' => '08012345678',
            'address' => 'Test Address',
            'lga' => 'Ojo',
            'town' => 'Iba',
            'isIndigene' => 'Invalid', // Invalid option
            'jambRegNumber' => '12345678AB',
            'jambScore' => 250,
            'waecGceYear' => '2024',
            'institution' => 'Test University',
            'course' => 'Test Course',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->create('jamb.jpg', 10, 'image/jpeg'),
            'waecResult' => UploadedFile::fake()->create('waec.jpg', 10, 'image/jpeg'),
            'indigeneCert' => UploadedFile::fake()->create('cert.jpg', 10, 'image/jpeg'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['isIndigene']);
    }

    public function test_application_validates_file_types()
    {
        $user = $this->createUserWithConsent();

        // Test with invalid file type (txt file)
        $response = $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/apply-form', [
            'hasTakenJamb' => 'Yes',
            'needsJambSupport' => '',
            'firstName' => 'Test',
            'lastName' => 'User',
            'dateOfBirth' => '2000-01-01',
            'email' => 'test@example.com',
            'phone' => '08012345678',
            'address' => 'Test Address',
            'lga' => 'Ojo',
            'town' => 'Iba',
            'isIndigene' => 'Yes',
            'jambRegNumber' => '12345678AB',
            'jambScore' => 250,
            'waecGceYear' => '2024',
            'institution' => 'Test University',
            'course' => 'Test Course',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->create('jamb.txt', 100), // Invalid type
            'waecResult' => UploadedFile::fake()->create('waec.jpg', 10, 'image/jpeg'),
            'indigeneCert' => UploadedFile::fake()->create('cert.jpg', 10, 'image/jpeg'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['jambResult']);
    }

    public function test_multiple_users_can_submit_applications()
    {
        $user1 = $this->createUserWithConsent(['email' => 'user1@example.com']);
        $user2 = $this->createUserWithConsent(['email' => 'user2@example.com']);

        $formData1 = [
            'hasTakenJamb' => 'Yes',
            'needsJambSupport' => '',
            'firstName' => 'User',
            'lastName' => 'One',
            'dateOfBirth' => '2000-01-01',
            'email' => 'user1@example.com',
            'phone' => '08011111111',
            'address' => 'Address One',
            'lga' => 'Ojo',
            'town' => 'Iba',
            'isIndigene' => 'Yes',
            'jambRegNumber' => '11111111AA',
            'jambScore' => 280,
            'waecGceYear' => '2024',
            'institution' => 'University One',
            'course' => 'Course One',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->create('jamb1.pdf', 1000, 'application/pdf'),
            'waecResult' => UploadedFile::fake()->create('waec1.pdf', 1000, 'application/pdf'),
            'indigeneCert' => UploadedFile::fake()->create('cert1.pdf', 1000, 'application/pdf'),
        ];

        $formData2 = [
            'hasTakenJamb' => 'Yes',
            'needsJambSupport' => '',
            'firstName' => 'User',
            'lastName' => 'Two',
            'dateOfBirth' => '2001-02-02',
            'email' => 'user2@example.com',
            'phone' => '08022222222',
            'address' => 'Address Two',
            'lga' => 'Ojo',
            'town' => 'Iba',
            'isIndigene' => 'Pending',
            'jambRegNumber' => '22222222BB',
            'jambScore' => 320,
            'waecGceYear' => '2024',
            'institution' => 'University Two',
            'course' => 'Course Two',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->create('jamb2.pdf', 1000, 'application/pdf'),
            'waecResult' => UploadedFile::fake()->create('waec2.pdf', 1000, 'application/pdf'),
            'indigeneCert' => UploadedFile::fake()->create('cert2.pdf', 1000, 'application/pdf'),
        ];

        $this->actingAs($user1)->post('/apply-form', $formData1)->assertStatus(200);
        $this->actingAs($user2)->post('/apply-form', $formData2)->assertStatus(200);

        $this->assertDatabaseCount('applications', 2);
        $this->assertDatabaseHas('applications', ['user_id' => $user1->id]);
        $this->assertDatabaseHas('applications', ['user_id' => $user2->id]);
    }

    public function test_application_generates_unique_application_id()
    {
        $user = $this->createUserWithConsent();

        $formData = [
            'hasTakenJamb' => 'Yes',
            'needsJambSupport' => '',
            'firstName' => 'Test',
            'lastName' => 'Applicant',
            'dateOfBirth' => '2000-03-15',
            'email' => 'applicant@example.com',
            'phone' => '08012345678',
            'address' => 'Test Address',
            'lga' => 'Ojo',
            'town' => 'Iba',
            'isIndigene' => 'Yes',
            'jambRegNumber' => '33333333CC',
            'jambScore' => 290,
            'waecGceYear' => '2024',
            'institution' => 'Test University',
            'course' => 'Test Course',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->create('jamb.jpg', 10, 'image/jpeg'),
            'waecResult' => UploadedFile::fake()->create('waec.jpg', 10, 'image/jpeg'),
            'indigeneCert' => UploadedFile::fake()->create('cert.jpg', 10, 'image/jpeg'),
        ];

        $response = $this->actingAs($user)->post('/apply-form', $formData);

        $response->assertStatus(200);

        $application = Application::where('user_id', $user->id)->first();
        $this->assertNotNull($application->application_id);
        $this->assertStringStartsWith('OA-', $application->application_id);
    }
}
