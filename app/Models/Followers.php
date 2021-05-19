<?php

namespace App\Models;

use App\Contracts\FollowersContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followers extends Model implements FollowersContract
{
    use HasFactory;


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

}
