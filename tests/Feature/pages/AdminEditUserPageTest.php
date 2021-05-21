<?php

namespace Tests\Feature\pages;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminEditUserPageTest extends TestCase
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


    public function test_edit_user_account()
    {
        $this->createUser();
        $admin = $this->userAccount();
        $response =   $this->actingAs($admin)->call('PATCH',
            '/admin/2',
            array(
                '_token' => csrf_token(),
                'name'=>'dddd',
                'bio'=>'dfgfdsdfgh'
            ));

        $response->assertJson([
            'success'=>true
        ]);
    }





}
