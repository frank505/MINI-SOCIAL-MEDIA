<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexPageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

    protected $user;

    public function setUp():void
    {
        parent::setUp();
        $this->user = User::factory()->make();
    }

    public function createUser()
    {
        User::factory()->times(10)->create();
    }


    public function test_homepage_loads_with_created()
    {
        $this->createUser();

        $response = $this->call('GET', '/');

        $response->assertSeeText(['All Registered Users','Log in','Register']);

        $response->assertStatus(200);
    }


    public function test_go_to_login_onclick_page()
    {
        $this->createUser();

        $response =  $this->visit('/')
        ->click('Log in')
        ->seePageIs('/login')
        ->seeText('Login');

        $response->assertResponseStatus(200);
    }


    public function test_go_to_login_page()
    {
        $this->createUser();

        $response =  $this->visit('/')
            ->click('Log in')
            ->seePageIs('/login')
            ->seeText('Login');

        $response->assertResponseStatus(200);
    }


    public function test_go_to_register_page()
    {
        $this->createUser();

        $response =  $this->visit('/')
            ->click('Register')
            ->seePageIs('/register')
            ->seeText('Register');

        $response->assertResponseStatus(200);
    }


}
