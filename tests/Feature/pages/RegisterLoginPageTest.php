<?php

namespace Tests\Feature;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class RegisterLoginPageTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_loads_register_page()
    {
        $response = $this->call('GET','/register');

        $response->assertSeeText(['Register']);

        $response->assertStatus(200);
    }


    public function test_fill_and_submit_register_form()
    {
        Event::fake();
      $response =   $this->call('POST','/register',array(
            'name'=>'desmond',
            'email'=>'akpufranklin2@gmail.com',
            'username'=>'eeeemanuel205555',
            'password'=>'password',
            'password_confirmation'=>'password',
        ));
         Event::assertDispatched(Registered::class);
        $response->assertResponseStatus(302);
    }

    public function test_login_link_is_clicked()
    {
        $response =  $this->visit('/register')
            ->click('Login')
            ->seePageIs('/login')
            ->seeText('Login');

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
