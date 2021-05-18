<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'=>'work@tvzcorp.com',
            'name'=>'work@tvzcorp.com',
            'email'=>'work@tvzcorp.com',
            'password'=>Hash::make('“pAs!sw@rd@#61g”'),
            'pic'=>'default.png',
            'bio'=>'this is the admin',
            'role'=>'admin',
            'pvt'=>true,
            'last_login_date'=>Carbon::now()->toDateTimeString()
        ]);
        //g

    }
}
