<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Factories\OrderFactory as Factory;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // public function test_order_screen_can_be_rendered()
    // {
    //     $response = $this->get('/all-orders');
    //     $response->dd();
    //     $response->assertStatus(200);
    // }
    // public function testOrderGet()
    // {
    //     $orders = Order::factory()->count(5)->create();
    //     $response = $this->get('/orders');
    //     $response->assertOk();
    // }

    public function test_order_model_exist_in_database()
    {
        $orders = Order::factory()->create();
        $this->assertModelExists($orders);
    }

    public function test_retreave_data_in_field_in_table_order()
    {
        $orders = Order::factory()->create();
        $this->assertDatabaseHas('orders', [
            "id"=> $orders->id,
            "customer_firstname"=> $orders->customer_firstname,
        ]);
        
    }

    public function test_retreave_invalid_data_in_field_in_table_order()
    {
        $orders = Order::factory()->create();
        $this->assertDatabaseMissing('orders', [
            "id"=> $orders->id,
            "customer_firstname"=> "test",
            "customer_lastname" => $orders->customer_lastname,
        ]);
        
    }
}
