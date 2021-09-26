<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    public $user;

    /** @test */
    public function a_profile_is_made_when_a_user_is_created()
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->assertNotEmpty($user);

        $this->assertnotEmpty($user->profile);
    }
}
