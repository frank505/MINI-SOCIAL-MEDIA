<?php
namespace  App\Contracts;

interface  FollowersContract
{

   public function followers();

   public function following();

   public function followUser($id,$followerId);

   public  function unFollowUser($id,$followerId);

    public function allUsersFollowingYou($id);

    public function allUsersYouAreFollowing($id);

    public function isFollowingUser($followerUserId,$userid);

}
