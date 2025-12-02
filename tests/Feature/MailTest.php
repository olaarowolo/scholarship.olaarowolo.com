<?php

namespace Tests\Feature;

use App\Mail\ApplicationSubmitted;
use App\Mail\ContactMail;
use App\Models\Application;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_mail_can_be_sent()
    {
        Mail::fake();

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'This is a test message',
        ];

        $mail = new ContactMail($data);

        $mail->build();

        $this->assertEquals('Contact Form Submission from John Doe', $mail->envelope()->subject);
        $this->assertEquals('emails.contact', $mail->content()->view);
        $this->assertEquals($data, $mail->data);
    }

    public function test_application_submitted_mail_can_be_sent()
    {
        Mail::fake();

        $user = User::factory()->create();
        $application = Application::factory()->create(['user_id' => $user->id]);

        $mail = new ApplicationSubmitted($application);

        $mail->build();

        $this->assertStringContains('Application Submitted', $mail->envelope()->subject);
        $this->assertEquals('emails.application_submitted', $mail->content()->view);
        $this->assertEquals($application, $mail->application);
    }
}
