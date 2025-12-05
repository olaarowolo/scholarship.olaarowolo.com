<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_can_be_rendered()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    public function test_about_page_can_be_rendered()
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertViewIs('about');
    }

    public function test_how_it_works_page_can_be_rendered()
    {
        $response = $this->get('/how-it-works');

        $response->assertStatus(200);
        $response->assertViewIs('how-it-works');
    }

    public function test_apply_page_can_be_rendered()
    {
        $response = $this->get('/apply');

        $response->assertStatus(200);
        $response->assertViewIs('apply');
    }

    public function test_contact_page_can_be_rendered()
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertViewIs('contact');
    }

    public function test_our_story_page_can_be_rendered()
    {
        $response = $this->get('/our-story');

        $response->assertStatus(200);
        $response->assertViewIs('our-story');
    }

    public function test_application_steps_page_can_be_rendered()
    {
        $response = $this->get('/application-steps');

        $response->assertStatus(200);
        $response->assertViewIs('application-steps');
    }

    public function test_view_impact_page_can_be_rendered()
    {
        $response = $this->get('/view-impact');

        $response->assertStatus(200);
        $response->assertViewIs('view-impact');
    }

    public function test_scholar_login_page_can_be_rendered()
    {
        $response = $this->get('/scholar-login');

        $response->assertStatus(200);
        $response->assertViewIs('scholar-login');
    }

    public function test_sponsor_information_page_can_be_rendered()
    {
        $response = $this->get('/sponsor-information');

        $response->assertStatus(200);
        $response->assertViewIs('sponsor-information');
    }

    public function test_terms_page_can_be_rendered()
    {
        $response = $this->get('/terms');

        $response->assertStatus(200);
        $response->assertViewIs('terms');
    }

    public function test_resources_page_can_be_rendered()
    {
        $response = $this->get('/resources');

        $response->assertStatus(200);
        $response->assertViewIs('resources');
    }

    public function test_testimonials_page_can_be_rendered()
    {
        $response = $this->get('/testimonials');

        $response->assertStatus(200);
        $response->assertViewIs('testimonials');
    }

    public function test_dashboard_page_can_be_rendered_for_authenticated_users()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
    }

    public function test_dashboard_page_redirects_guests()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_apply_form_page_can_be_rendered()
    {
        $response = $this->get('/apply-form');

        $response->assertStatus(200);
        $response->assertViewIs('apply-form');
    }

    public function test_apply_utme_jamb_form_page_can_be_rendered()
    {
        $response = $this->get('/apply-utme-jamb-form');

        $response->assertStatus(200);
        $response->assertViewIs('apply-utme-jamb-form');
    }
}
