<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Application;
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
    }

    public function test_apply_form_page_loads_successfully()
    {
        $response = $this->get('/apply-form');

        $response->assertStatus(200);
        $response->assertViewIs('apply-form');
    }

    public function test_authenticated_user_can_submit_application_with_valid_data()
    {
        $user = User::factory()->create([
            'email' => 'john.doe@example.com',
        ]);

        // Create fake file uploads
        $jambResult = UploadedFile::fake()->image('jamb_result.jpg');
        $waecResult = UploadedFile::fake()->image('waec_result.jpg');
        $indigeneCert = UploadedFile::fake()->image('indigene_cert.jpg');

        $formData = [
            'fullName' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '+234 801 234 5678',
            'address' => '123 Main Street, Iba Town, Lagos State',
            'isIndigene' => 'Yes',
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
            'first_name' => 'John Doe',
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
        $formData = [
            'fullName' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '+234 802 345 6789',
            'address' => '456 Second Avenue, Iba Town',
            'isIndigene' => 'Yes',
            'jambScore' => 300,
            'waecGceYear' => '2024',
            'institution' => 'Lagos State University',
            'course' => 'Engineering',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->image('jamb.jpg'),
            'waecResult' => UploadedFile::fake()->image('waec.jpg'),
            'indigeneCert' => UploadedFile::fake()->image('cert.jpg'),
        ];

        $response = $this->post('/apply-form', $formData);

        $response->assertRedirect('/login');
    }

    public function test_application_validates_required_fields()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/apply-form', [
            // Missing all required fields
        ]);

        $response->assertSessionHasErrors([
            'fullName',
            'email',
            'phone',
            'address',
            'isIndigene',
            'jambScore',
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
        $user = User::factory()->create();

        // Test score below minimum (180)
        $response = $this->actingAs($user)->post('/apply-form', [
            'fullName' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '08012345678',
            'address' => 'Test Address',
            'isIndigene' => 'Yes',
            'jambScore' => 150, // Below minimum
            'waecGceYear' => '2024',
            'institution' => 'Test University',
            'course' => 'Test Course',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->image('jamb.jpg'),
            'waecResult' => UploadedFile::fake()->image('waec.jpg'),
            'indigeneCert' => UploadedFile::fake()->image('cert.jpg'),
        ]);

        $response->assertSessionHasErrors(['jambScore']);

        // Test score above maximum (400)
        $response = $this->actingAs($user)->post('/apply-form', [
            'fullName' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '08012345678',
            'address' => 'Test Address',
            'isIndigene' => 'Yes',
            'jambScore' => 450, // Above maximum
            'waecGceYear' => '2024',
            'institution' => 'Test University',
            'course' => 'Test Course',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->image('jamb.jpg'),
            'waecResult' => UploadedFile::fake()->image('waec.jpg'),
            'indigeneCert' => UploadedFile::fake()->image('cert.jpg'),
        ]);

        $response->assertSessionHasErrors(['jambScore']);
    }

    public function test_application_validates_indigene_status()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/apply-form', [
            'fullName' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '08012345678',
            'address' => 'Test Address',
            'isIndigene' => 'No', // Not allowed
            'jambScore' => 250,
            'waecGceYear' => '2024',
            'institution' => 'Test University',
            'course' => 'Test Course',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->image('jamb.jpg'),
            'waecResult' => UploadedFile::fake()->image('waec.jpg'),
            'indigeneCert' => UploadedFile::fake()->image('cert.jpg'),
        ]);

        $response->assertSessionHasErrors(['isIndigene']);
    }

    public function test_application_validates_file_types()
    {
        $user = User::factory()->create();

        // Test with invalid file type (txt file)
        $response = $this->actingAs($user)->post('/apply-form', [
            'fullName' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '08012345678',
            'address' => 'Test Address',
            'isIndigene' => 'Yes',
            'jambScore' => 250,
            'waecGceYear' => '2024',
            'institution' => 'Test University',
            'course' => 'Test Course',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->create('jamb.txt', 100), // Invalid type
            'waecResult' => UploadedFile::fake()->image('waec.jpg'),
            'indigeneCert' => UploadedFile::fake()->image('cert.jpg'),
        ]);

        $response->assertSessionHasErrors(['jambResult']);
    }

    public function test_multiple_users_can_submit_applications()
    {
        $user1 = User::factory()->create(['email' => 'user1@example.com']);
        $user2 = User::factory()->create(['email' => 'user2@example.com']);

        $formData1 = [
            'fullName' => 'User One',
            'email' => 'user1@example.com',
            'phone' => '08011111111',
            'address' => 'Address One',
            'isIndigene' => 'Yes',
            'jambScore' => 280,
            'waecGceYear' => '2024',
            'institution' => 'University One',
            'course' => 'Course One',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->image('jamb1.jpg'),
            'waecResult' => UploadedFile::fake()->image('waec1.jpg'),
            'indigeneCert' => UploadedFile::fake()->image('cert1.jpg'),
        ];

        $formData2 = [
            'fullName' => 'User Two',
            'email' => 'user2@example.com',
            'phone' => '08022222222',
            'address' => 'Address Two',
            'isIndigene' => 'Pending',
            'jambScore' => 320,
            'waecGceYear' => '2024',
            'institution' => 'University Two',
            'course' => 'Course Two',
            'admissionStatus' => 'Admitted',
            'jambResult' => UploadedFile::fake()->image('jamb2.jpg'),
            'waecResult' => UploadedFile::fake()->image('waec2.jpg'),
            'indigeneCert' => UploadedFile::fake()->image('cert2.jpg'),
        ];

        $this->actingAs($user1)->post('/apply-form', $formData1)->assertStatus(200);
        $this->actingAs($user2)->post('/apply-form', $formData2)->assertStatus(200);

        $this->assertDatabaseCount('applications', 2);
        $this->assertDatabaseHas('applications', ['user_id' => $user1->id]);
        $this->assertDatabaseHas('applications', ['user_id' => $user2->id]);
    }

    public function test_application_generates_unique_application_id()
    {
        $user = User::factory()->create();

        $formData = [
            'fullName' => 'Test Applicant',
            'email' => 'applicant@example.com',
            'phone' => '08012345678',
            'address' => 'Test Address',
            'isIndigene' => 'Yes',
            'jambScore' => 290,
            'waecGceYear' => '2024',
            'institution' => 'Test University',
            'course' => 'Test Course',
            'admissionStatus' => 'Awaiting',
            'jambResult' => UploadedFile::fake()->image('jamb.jpg'),
            'waecResult' => UploadedFile::fake()->image('waec.jpg'),
            'indigeneCert' => UploadedFile::fake()->image('cert.jpg'),
        ];

        $response = $this->actingAs($user)->post('/apply-form', $formData);

        $response->assertStatus(200);

        $application = Application::where('user_id', $user->id)->first();
        $this->assertNotNull($application->application_id);
        $this->assertStringStartsWith('APP-', $application->application_id);
    }
}
