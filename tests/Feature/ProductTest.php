<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    protected $attributes;
    protected $user;

    protected function setUp():void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->attributes = [
            'name' => 'test-product',
            'manufacturer_sku' => 'test-000-0001',
            'profile_id' => $this->user->profile->id
        ];
    }

    /** @test */
    public function a_proudct_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/products', $this->attributes);

        $this->get('/products')->assertSee($this->attributes['name']);
    }

    /** @test */
    public function a_product_requires_a_name()
    {
        $this->attributes['name'] = null;

        $this->post('/products', $this->attributes)->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_product_requires_a_manufacturer_sku()
    {
        $this->attributes['manufacturer_sku'] = null;

        $this->post('/products', $this->attributes)->assertSessionHasErrors('manufacturer_sku');
    }

    /** @test */
    public function a_product_requires_a_profile()
    {
        $this->attributes['profile_id'] = null;

        $this->post('/products', $this->attributes)->assertSessionHasErrors('profile_id');
    }
}
