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
        return $this->belongsTo('App\Models\Users','userid','id');
    }

    public function following()
    {
        // TODO: Implement following() method.
        return $this->belongsTo('App\Models\Users','followed_userid','id');
    }


    public static function followUser($id,$followerId)
    {
      return self::create([
          'userid'=>$id,
          'followed_userid'=>$followerId
      ]);
    }



    public  static function unFollowUser($id,$followerId)
    {
        return self::where([
            'userid'=>$id,
            'followed_userid'=>$followerId
        ])->delete();
    }




}
