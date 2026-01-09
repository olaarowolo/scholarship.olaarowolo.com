<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TermsTest extends TestCase
{
    use RefreshDatabase;

    public function test_terms_acceptance_page_can_be_rendered()
    {
        $response = $this->get('/terms-acceptance');

        $response->assertStatus(200);
        $response->assertViewIs('terms-acceptance');
    }

    public function test_terms_can_be_accepted_successfully()
    {
        $user = User::factory()->create();

        $data = [
            'device' => 'Desktop',
            'location' => 'Nigeria',
            'credentials' => 'Accepted',
        ];

        $response = $this->actingAs($user)->post('/terms-acceptance', $data);

        $response->assertRedirect('/');
        $this->assertTrue(Session::get('terms_accepted'));

        $user->refresh();
        $this->assertTrue($user->terms_accepted);
        $this->assertEquals('Desktop', $user->device);
        $this->assertEquals('Nigeria', $user->location);
        $this->assertEquals('Accepted', $user->credentials);
    }

    public function test_terms_acceptance_validation_fails_with_missing_fields()
    {
        $user = User::factory()->create();

        $data = [
            'device' => '',
            'location' => '',
        ];

        $response = $this->actingAs($user)->post('/terms-acceptance', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['device', 'location', 'credentials']);
    }

    public function test_terms_acceptance_works_for_guests()
    {
        $data = [
            'device' => 'Mobile',
            'location' => 'Lagos',
            'credentials' => 'Accepted',
        ];

        $response = $this->post('/terms-acceptance', $data);

        $response->assertRedirect('/');
        $this->assertTrue(Session::get('terms_accepted'));
    }
}
