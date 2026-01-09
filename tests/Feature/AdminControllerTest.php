<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\User;
use App\Models\AdminNote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Mail\ApplicationStatusUpdate;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_can_update_application_status_and_add_note()
    {
        Mail::fake();

        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();
        $application = Application::factory()->create(['user_id' => $user->id, 'status' => 'submitted']);

        $newStatus = 'approved';
        $adminNotes = 'This is a test note.';

        $response = $this->actingAs($admin)
            ->put(route('admin.applications.update-status', $application->id), [
                'status' => $newStatus,
                'admin_notes' => $adminNotes,
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Application status updated successfully!');

        $this->assertDatabaseHas('applications', [
            'id' => $application->id,
            'status' => $newStatus,
        ]);

        $this->assertDatabaseHas('admin_notes', [
            'application_id' => $application->id,
            'note' => $adminNotes,
        ]);

        Mail::assertQueued(ApplicationStatusUpdate::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
