<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetailerTest extends TestCase
{
    use RefreshDatabase;
    protected $attributes;
    protected $user;

    protected function setUp():void
    {
        parent::setUp();

        $this->attributes = [
            'name' => 'test-retailer',
            'website' => 'https://test-retailer.com',
        ];
    }

    /** @test */
    public function a_retailer_cant_be_created_by_users()
    {
        $this->post('/retailers', $this->attributes)->assertNotFound();
    }
}
