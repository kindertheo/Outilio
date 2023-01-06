<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Service;
use Database\Factories\ProductFactory as Factory;
use Illuminate\Testing\Fluent\AssertableJson;

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
        $products = Product::factory()->count(5)->create();
        $response = $this->get('/all-products?date=2023-01-05T08:30:11.900Z');
        $response->assertOk();
    }
 
    public function test_product_model_exist_in_database()
    {
        $products = Product::factory()->create();
        $this->assertModelExists($products);
    }


    public function test_retreave_data_in_field_in_table_product()
    {
        $products = Product::factory()->create();
        $this->assertDatabaseHas('products', [
            "id"=> $products->id,
            "name"=> $products->name,
        ]);
        
    }

    public function test_retreave_invalid_data_in_field_in_table_product()
    {
        $products = Product::factory()->create();
        $this->assertDatabaseMissing('products', [
            "id"=> $products->id,
            "name"=> "email",
        ]);
        
    }
}
