<?php

namespace Tests\Feature\pages;

use App\Models\Followers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserListFollowingYouPageTest extends TestCase
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


    public function test_list_of_user_following_you()
    {
        $this->createUser();
        $user = $this->userAccount();
        Followers::factory()->create([
            'followed_userid'=>'3', //since we created ten users before creating our own user he is number 11 user
            'userid'=>'11'
        ]);

        $response =   $this->actingAs($user)->call('GET',
            '/panel/home/following-you',
            array(
                '_token' => csrf_token(),
            ));

        $response->assertSeeText('Users Following You');

        $response->assertSeeText('View Bio'); //view bio button if a user is created

        $response->assertStatus(200);
    }



}
