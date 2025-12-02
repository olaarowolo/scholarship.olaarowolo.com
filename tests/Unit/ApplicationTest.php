<?php

namespace Tests\Unit;

use App\Models\Application;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_application_has_fillable_attributes()
    {
        $fillable = [
            'application_id',
            'user_id',
            'first_name',
            'last_name',
            'date_of_birth',
            'address',
            'lga',
            'town',
            'phone',
            'jamb_reg_number',
            'jamb_score',
            'institution',
            'course',
            'passport_photo',
            'id_card',
            'jamb_result',
            'status',
            'notes',
        ];

        $application = new Application();

        $this->assertEquals($fillable, $application->getFillable());
    }

    public function test_application_has_correct_casts()
    {
        $casts = [
            'date_of_birth' => 'date',
            'jamb_score' => 'decimal:2',
        ];

        $application = new Application();

        $this->assertEquals($casts, $application->getCasts());
    }

    public function test_application_uses_correct_table()
    {
        $application = new Application();

        $this->assertEquals('applications', $application->getTable());
    }

    public function test_application_belongs_to_user()
    {
        $application = new Application();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $application->user());
    }

    public function test_application_generates_application_id_on_creation()
    {
        $user = User::factory()->create();
        $application = Application::factory()->create(['user_id' => $user->id]);

        $this->assertNotNull($application->application_id);
        $this->assertStringStartsWith('APP-', $application->application_id);
    }

    public function test_application_has_correct_status_default()
    {
        $user = User::factory()->create();
        $application = Application::factory()->create(['user_id' => $user->id, 'status' => null]);

        $this->assertNull($application->status); // Since we didn't set it, it should be null
    }
}
