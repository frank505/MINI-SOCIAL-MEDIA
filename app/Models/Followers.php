<?php

namespace App\Models;

use App\Contracts\FollowersContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followers extends Model implements FollowersContract
{
    use HasFactory;

    protected $table = 'followed_users';

    protected $fillable = ['userid','followed_userid'];

    public function followers()
    {
        // TODO: Implement followers() method.
        return $this->belongsTo('App\Models\User','userid','id');
    }

    public function following()
    {
        // TODO: Implement following() method.
        return $this->belongsTo('App\Models\User','followed_userid','id');
    }


    public function followUser($id,$followerId)
    {
      return $this->create([
          'userid'=>$id,
          'followed_userid'=>$followerId
      ]);
    }



    public   function unFollowUser($id,$followerId)
    {
        return $this->where([
            'userid'=>$id,
            'followed_userid'=>$followerId
        ])->delete();
    }


    public function allUsersFollowingYou($id)
    {
        $perPage = 3;
        return $this->where(['userid'=>$id])->with('following')->paginate($perPage);
    }


    public function allUsersYouAreFollowing($id)
    {
        // TODO: Implement allUsersFollowingYou() method.
        $perPage = 3;
        return $this->where(['followed_userid'=>$id])->with('followers')->paginate($perPage);
    }


    public function isFollowingUser($followerUserId,$userid)
    {
        return $this->where([
            'userid'=>$userid,
            'followed_userid'=>$followerUserId
        ])->count();
    }


}
