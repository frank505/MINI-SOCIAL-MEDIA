<?php

namespace App\Http\Controllers;

use App\Helpers\HttpResponseHelper;
use App\Http\Requests\FollowOrUnfollowUserRequest;
use App\Models\Followers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    //

   protected $follow, $url;
    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->middleware(
            ['auth','verified'],
            ['except'=>['followUser']]
        );
        $this->url = $urlGenerator->to('/');
        $this->follow = new Followers();
    }

    public function followUser(FollowOrUnfollowUserRequest $request)
    {
        $request->validated();

        if(!Auth::check())
        {
            return HttpResponseHelper::Response(false,'Unauthenticated',[],422);
        }

        $followerUserId = Auth::user()->id;

        /**
         * check to ensure you cannot follow yourself
         */

        if($followerUserId == $request->userid)
        {
            return HttpResponseHelper::Response(false,'Sorry You cannot follow yourself',[],
                422);
        }

        $count =  $this->follow->isFollowingUser($followerUserId,$request->userid);

        if($count > 0)
        {
            return HttpResponseHelper::Response(false,'User is already being followed',[],422);
        }

        $this->follow->followUser($request->userid,$followerUserId);

        return HttpResponseHelper::Response(true,'Successfully Followed User ',[],200);
    }



    public function unFollowUser($id)
    {
        if(!Auth::check())
        {
            return HttpResponseHelper::Response(false,'Unauthenticated',[],422);
        }

        $followerUserId = Auth::user()->id;

         $this->follow->unFollowUser($id,$followerUserId);

        return HttpResponseHelper::Response(true,'Successfully unFollowed User ',[],200);
    }



    public function allUsersFollowed()
    {
        $id = Auth::user()->id;
        $data = $this->follow->allUsersYouAreFollowing($id);
        return view('allUsersFollowed',[
            'data'=>$data,
            'url'=>$this->url
        ]);

    }

    public function allUsersFollowing()
    {
        $id = Auth::user()->id;
        $data = $this->follow->allUsersFollowingYou($id);
        return view('allUsersFollowingYou',[
            'data'=>$data,
            'url'=>$this->url
        ]);
    }



}
