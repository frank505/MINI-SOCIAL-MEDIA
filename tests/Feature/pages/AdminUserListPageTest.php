<?php

namespace Tests\Feature\pages;

use App\Models\Followers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminUserListPageTest extends TestCase
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
            'role'=>'admin',
            'pic'=>'default.png'
        ]);

        return $user;
    }


    public function test_list_all_users()
    {
        $this->createUser();
        $admin = $this->userAccount();
        $response =   $this->actingAs($admin)->call('GET',
            '/admin/users',
            array(
                '_token' => csrf_token(),
            ));

        $response->assertSeeText('All Registered Users');

        $response->assertSeeText('View Bio'); //view bio button if a user is created

        $response->assertStatus(200);
    }




    public function test_go_to_edit_user_page()
    {
        // /admin/2/edit

        $this->createUser();
        $admin = $this->userAccount();
        $response =   $this->actingAs($admin)->call('GET',
            '/admin/2/edit',
            array(
                '_token' => csrf_token(),
            )); //since we are creating 10 users surely user number two always exist

        $response->assertSeeText('Edit User');

        $response->assertSeeText('Submit Form'); //view bio button if a user is created

        $response->assertStatus(200);
    }



    public function test_delete_user_action()
    {
        // /admin/2/edit

        $this->createUser();
        $admin = $this->userAccount();
        $response =   $this->actingAs($admin)->call('DELETE',
            '/admin/2'); //since we are creating 10 users surely user number two always exist

        $response->assertJson([
            'success'=>true
        ]);
    }





}
