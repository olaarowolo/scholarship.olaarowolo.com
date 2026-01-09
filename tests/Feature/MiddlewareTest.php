<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_middleware_allows_admin_users()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        Route::middleware(['auth', 'role:admin'])->get('/admin-test', function () {
            return 'Admin Access';
        });

        $response = $this->actingAs($admin)->get('/admin-test');

        $response->assertStatus(200);
        $response->assertSee('Admin Access');
    }

    public function test_role_middleware_denies_non_admin_users()
    {
        $user = User::factory()->create(['role' => 'user']);

        Route::middleware(['auth', 'role:admin'])->get('/admin-test', function () {
            return 'Admin Access';
        });

        $response = $this->actingAs($user)->get('/admin-test');

        $response->assertStatus(403);
    }

    public function test_check_terms_acceptance_middleware_allows_accepted_users()
    {
        $user = User::factory()->create(['terms_accepted' => true]);

        Route::middleware(['auth', 'terms.accepted'])->get('/terms-test', function () {
            return 'Terms Accepted';
        });

        $response = $this->actingAs($user)->get('/terms-test');

        $response->assertStatus(200);
        $response->assertSee('Terms Accepted');
    }

    public function test_check_terms_acceptance_middleware_redirects_unaccepted_users()
    {
        $user = User::factory()->create(['terms_accepted' => false]);

        Route::middleware(['auth', 'terms.accepted'])->get('/terms-test', function () {
            return 'Terms Accepted';
        });

        $response = $this->actingAs($user)->get('/terms-test');

        $response->assertRedirect('/terms-acceptance');
    }
}
