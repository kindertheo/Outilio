<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Database\Factories\UserFactory as Factory;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     public function test_home_screen_can_be_rendered()
    {
        $response = $this->get('/login');
        $response->assertSee("location sur Metz"); //title
        $response->assertStatus(200);
    }

    public function test_user_model_exist_in_database()
    {
        $user = User::factory()->create();
        $this->assertModelExists($user);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();
        Session::start();
        $token = csrf_token();
        
 
        $response = $this->withHeaders([
            'X-CSRF-TOKEN'=>$token
        ])->postJson('/login', 
            [
                "user" => [
                    'email' => $user->email,
                    'password' => $user->password,
                ]
        ]);
 
        $response->assertOk();
        $response = $this->actingAs($user)->get('/');
        $this->assertAuthenticatedAs($user);
    }


    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();
 
        $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
 
        $this->assertGuest();
    }

    public function test_users_can_not_authenticate_with_good_password_but_invalid_token()
    {
        $user = User::factory()->create();
        
        $response = $this->withHeaders([
            'X-CSRF-TOKEN'=>'wrong-token'
        ])->postJson('/login', 
            [
                "user" => [
                    'email' => $user->email,
                    'password' => $user->password,
                ]
        ]);
 
        $this->assertGuest();
    }
}
