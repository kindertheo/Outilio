<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;
use App\Service;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function testBasicTest()
    {
        $data = [10, 20, 30];
        $result = array_sum($data);
        $this->assertEquals(60, $result);
       
    }
}
