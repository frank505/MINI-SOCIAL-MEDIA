<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class HomePageTest extends TestCase
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
     $allUser =    User::factory()->times(10)->create();
     return $allUser;
    }

    public function userAccount()
    {
       $user =  User::factory()->create([
           'name' => 'dddd',
           'username'=>'dewdsdvfdsdf',
           'email' => 'akpufranklin2@gmail.com',
           'email_verified_at' => now(),
           'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
           'remember_token' => Str::random(10),
        ]);

       return $user;
    }

    public function test_call_home_page_user()
    {
        $user = $this->userAccount();
      $response =   $this->actingAs($user)->call('GET','/home');
      $response->assertSeeText('Dashboard');
      $response->assertStatus(200);
    }

    public function test_call_check_all_links_on_sidebar()
    {
        $this->createUser();

        $user = $this->userAccount();

        $this->actingAs($user)
            ->visit('/panel/profile/profile-picture')
            ->assertResponseStatus(200);


        $this->actingAs($user)
            ->visit('/panel/profile/bio-message')
            ->assertResponseStatus(200);

        $this->actingAs($user)
            ->visit('/panel/profile/change-password')
            ->assertResponseStatus(200);


        $this->actingAs($user)
            ->visit('/panel/profile/profile-status')
            ->assertResponseStatus(200);

        $this->actingAs($user)
            ->visit('/panel/profile/profile-picture')
            ->assertResponseStatus(200);

        $this->actingAs($user)
            ->visit('/panel/home/following-you')
            ->assertResponseStatus(200);

        $this->actingAs($user)
            ->visit('/panel/home/users-you-follow')
            ->assertResponseStatus(200);


    }


    public function test_logout_action_user()
    {
        $user = $this->userAccount();
        $response =   $this->actingAs($user)->call('POST','/logout');
        $response->assertRedirectedTo('/');
        $response->assertResponseStatus(302);
    }



}
