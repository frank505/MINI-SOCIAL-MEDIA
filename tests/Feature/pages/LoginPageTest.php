<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_load_login_page()
    {
        $response = $this->call('GET','/login');

        $response->assertStatus(200);
    }


    public function test_login_form_action()
    {
        $user = User::factory()->create([
            'name' => 'dddd',
            'username'=>'dewdsdvfdsdf',
            'email' => 'akpufranklin2@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $response =   $this->call('POST','/login',array(
            'email'=>'akpufranklin2@gmail.com',
            'password'=>'password',
        ));

        $response->assertRedirectedTo('/home');
        $response->assertResponseStatus(302);
    }


    public function test_register_link_is_clicked()
    {
        $response =  $this->visit('/login')
            ->click('Register')
            ->seePageIs('/register')
            ->seeText('Register');

        $response->assertResponseStatus(200);
    }


    public function test_home_link_is_clicked()
    {
        $response =  $this->visit('/register')
            ->click('Laravel')
            ->seePageIs('/')
            ->seeText('All Registered Users');

        $response->assertResponseStatus(200);
    }
}
