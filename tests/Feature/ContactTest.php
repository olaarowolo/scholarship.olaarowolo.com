<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use WithFaker;

    /**
     * Test successful contact form submission.
     */
    public function test_contact_form_submission_successful()
    {
        Mail::fake();

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->paragraph,
        ];

        $response = $this->post('/contact/send', $data);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Your message has been sent successfully!');

        Mail::assertSent(\App\Mail\ContactMail::class, function ($mail) use ($data) {
            return $mail->hasTo(config('mail.to.address')) &&
                   $mail->data['name'] === $data['name'] &&
                   $mail->data['email'] === $data['email'] &&
                   $mail->data['message'] === $data['message'];
        });
    }

    /**
     * Test contact form validation fails with missing name.
     */
    public function test_contact_form_validation_fails_missing_name()
    {
        $data = [
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->paragraph,
        ];

        $response = $this->post('/contact/send', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('name');
    }

    /**
     * Test contact form validation fails with invalid email.
     */
    public function test_contact_form_validation_fails_invalid_email()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => 'invalid-email',
            'message' => $this->faker->paragraph,
        ];

        $response = $this->post('/contact/send', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('email');
    }

    /**
     * Test contact form validation fails with missing message.
     */
    public function test_contact_form_validation_fails_missing_message()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
        ];

        $response = $this->post('/contact/send', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('message');
    }

    /**
     * Test contact form validation fails with all fields missing.
     */
    public function test_contact_form_validation_fails_all_fields_missing()
    {
        $response = $this->post('/contact/send', []);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }
}
