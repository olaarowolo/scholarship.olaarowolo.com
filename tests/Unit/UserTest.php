<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
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
            'device',
            'location',
            'credentials',
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
