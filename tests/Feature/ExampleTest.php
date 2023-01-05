<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Mockery;
use Mockery\MockInterface;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    
    public function test_the_homepage_returns_a_successful_response()
    {
        
        $response = $this->get('/');
        $response->assertStatus(200);
       
       
    }

    public function test_the_productpage_returns_a_successful_response()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);   
    }


    public function test_insert_data_in_table_product()
    {
        //Création Mock
            // $this->instance(
            //     ProductController::class,
            //     Mockery::mock(ProductController::class, function (MockInterface $mock) {
            //         $mock->shouldReceive('store')->once();
            // Cache::spy();
            Bus::fake([
                ProductController::class,
                Product::class
            ]);
            Session::start();
            $token = csrf_token();
            dump($token);
            // Action
            $response = $this->withHeaders([
                'X-CSRF-TOKEN'=>$token
            ])
            ->postJson('/products', [
                'product'=>[
                    'name'=>'perceuse',
                    'description'=>'test',
                    'priceByDay'=>"52"
                ]
            ]);
            // $response->dump();
            // Assertions
            $response2 = $this->getJson("/products/30");
            $response->assertOk();
            $response2->assertOk();
        //     })
        // );
    }

    public function test_retreave_first_data_in_table_product()
    {
        // Assert that each user in the list has at least an id, name and email attribute.
        $response = $this->assertDatabaseHas('products', [
                'id'=> 1,
                'name'=>'perceuse',
                'description'=>'coucou',
                'price_by_day'=> 4500,
                'created_at'=> "2023-01-04 08:48:34",
                'updated_at'=> "2023-01-04 08:48:34"

        ]);
    }

    /*public function test_assert_database_count()
    {
        $response = $this->assertDatabaseCount('products', 26);
    }*/


    /*public function testBasicTest()
    {
        $data = [10, 20, 30];
        $result = array_sum($data);
        $this->assertEquals(60, $result);
    }
    public function testBasicTest2()
    {
        $data = 'Je suis petit';
        $this->assertTrue(Str::startsWith($data, 'Je'));
        $this->assertFalse(Str::startsWith($data, 'Tu'));
        $this->assertSame(Str::startsWith($data, 'Tu'), false);
        $this->assertStringStartsWith('Je', $data);
        $this->assertStringEndsWith('petit', $data);
    }*/
    
   
    
}
