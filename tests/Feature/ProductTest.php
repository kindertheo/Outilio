<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Service;
use Database\Factories\ProductFactory as Factory;
use Mockery;
use Mockery\MockInterface;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProductGet()
    {
        $produdcts = Product::factory()->count(10)->create();
        $response = $this->get('/all-products?date=2023-01-05T08:30:11.900Z');
        $response->assertStatus(200);
    }
}
