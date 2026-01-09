<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_fillable_attributes()
    {
        $fillable = [
            'name',
            'email',
            'password',
            'role',
            'terms_accepted',
            'terms_accepted_at',
            'marketing_accepted',
            'device',
            'location',
            'credentials',
            'is_iba_indigene',
            'two_factor_enabled',
            'two_factor_code',
            'two_factor_expires_at',
        ];

        $user = new User();

        $this->assertEquals($fillable, $user->getFillable());
    }

    public function test_user_has_hidden_attributes()
    {
        $hidden = [
            'password',
            'remember_token',
        ];

        $user = new User();

        $this->assertEquals($hidden, $user->getHidden());
    }

    public function test_user_has_correct_casts()
    {
        $casts = [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'terms_accepted' => 'boolean',
            'marketing_accepted' => 'boolean',
            'is_iba_indigene' => 'boolean',
            'two_factor_enabled' => 'boolean',
            'two_factor_expires_at' => 'datetime',
            'id' => 'int',
        ];

        $user = new User();

        $this->assertEquals($casts, $user->getCasts());
    }

    public function test_user_uses_correct_table()
    {
        $user = new User();

        $this->assertEquals('users', $user->getTable());
    }

    public function test_user_can_have_applications()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $user->applications());
    }
}
