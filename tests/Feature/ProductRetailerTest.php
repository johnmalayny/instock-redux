<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Retailer;
use App\Models\Watchlist;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductRetailerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $retailer;
    protected $product;
    protected $attributes;

    protected function setUp():void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->user->profile->watchlists()->save(
            Watchlist::create([
                'profile_id' => $this->user->profile->id,
                'name' => 'test-watchlist'
            ])
        );

        $this->retailer = Retailer::create([
            'name' => 'Test Retailer',
            'website' => 'https://johnmalayny.com'
        ]);

        $this->product = Product::create([
            'profile_id' => $this->user->profile->id,
            'name' => 'Test Product',
            'manufacturer_sku' => 'test-000-000',
        ]);

        $this->user->profile->watchlists->first()->products()->save($this->product);

        $this->attributes = [
            'product_id' => $this->product->id,
            'retailer_id' => $this->retailer->id,
            'retailer_product_page_url' => 'https://www.test.com/blah'
        ];
    }

    /** @test */
    public function a_product_can_be_associated_with_a_retailer()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user)
            ->post(route('retailers.addProduct'), $this->attributes)
            ->assertRedirect(route('watchlists.index'));

        $this->actingAs($this->user)
            ->get(route('watchlists.index'))
            ->assertSee($this->retailer->name);
    }

    /** @test */
    public function a_product_associated_with_a_retailer_must_have_a_retailer_product_page_url()
    {
        $this->attributes['retailer_product_page_url'] = null;

        $this->actingAs($this->user)
            ->post(route('retailers.addProduct'), $this->attributes)
            ->assertSessionHasErrors('retailer_product_page_url');
    }
}
