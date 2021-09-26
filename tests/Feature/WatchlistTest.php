<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WatchlistTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $attributes;

    protected function setUp():void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->attributes = [
            'name' => 'test-watchlist',
            'profile_id' => $this->user->profile->id
        ];
    }

    /** @test */
    public function a_watchlist_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/watchlists', $this->attributes);

        $this->get('/watchlists')->assertSee($this->attributes['name']);
    }

    /** @test */
    public function a_watchlist_requires_a_name()
    {
        $this->attributes['name'] = null;

        $this->post('/watchlists', $this->attributes)->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_watchlist_requires_a_profile()
    {
        $this->attributes['profile_id'] = null;

        $this->post('/watchlists', $this->attributes)->assertSessionHasErrors('profile_id');
    }
}
