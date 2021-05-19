<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   protected $user;
    public function __construct()
    {
//        $this->middleware(['auth','verified']);
        $this->user = new User();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $itemPerPage = 10;
        $profiles = $this->user->allPaginatedUsers($itemPerPage);
        return view('home',[
            'profiles'=>$profiles
        ]);
    }



}
