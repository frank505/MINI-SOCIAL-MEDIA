<?php

namespace App\Http\Controllers;

use App\Helpers\HttpResponseHelper;
use App\Http\Requests\FollowOrUnfollowUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    //
    protected $users;
    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->middleware(
            ['auth','verified'],
            ['except'=>['followUser']]
        );
        $this->user = new User();
        $this->url = $urlGenerator->to('/');
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

        $count =  $this->user->isFollowingUser($followerUserId,$request->userid);

        if($count > 0)
        {
            return HttpResponseHelper::Response(false,'User is already being followed',[],422);
        }

        $this->user->createNewFollower($followerUserId,$request->userid);

        return HttpResponseHelper::Response(true,'Successfully Followed User ',[],200);
    }



    public function unFollowUser($id)
    {
        if(!Auth::check())
        {
            return HttpResponseHelper::Response(false,'Unauthenticated',[],422);
        }

        $followerUserId = Auth::user()->id;

        $this->user->unFollowerUser($followerUserId,$id);

        return HttpResponseHelper::Response(true,'Successfully unFollowed User ',[],200);
    }



    public function allUsersFollowed()
    {
        $id = Auth::user()->id;
        $data = $this->user->allUsersYouAreFollowing($id);
        return view('allUsersFollowed',[
            'data'=>$data
        ]);

    }

    public function allUsersFollowing()
    {
        $id = Auth::user()->id;
        $data = $this->user->allUsersFollowingYou($id);
        return view('allUsersFollowingYou',[
            'data'=>$data
        ]);
    }



}
