<?php
namespace  App\Contracts;

interface  FollowersContract
{

   public function followers();

   public function following();

   public static function followUser($id,$followerId);

   public static function unFollowUser($id,$followerId);

}
