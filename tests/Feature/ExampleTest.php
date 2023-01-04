<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        var_dump($response);
       
    }

    public function testBasicTest()
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
    }
    /*
    public function testBasicTest3()
    {
        $response = $this->get('/');
        $response->assertSuccessful();
        $this->assertEquals('coucou', $response->getContent());
    }*/
    
}
