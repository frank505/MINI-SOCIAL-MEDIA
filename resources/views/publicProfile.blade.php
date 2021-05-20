
@extends('layouts.home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">





                <div class="col-md-8">


                    <meta name="_token" content="{{ csrf_token() }}" />

                    <div class="card" >

                        <div class="display_err"></div>

                        <img
                             style="height: 300px;width:60%;
                             margin-left: 20%;margin-right:20%;margin-top:40px;"
                             src="{{
                   $profile->pic=='default.png'?
                    asset('./dist/img/custom_user_img.jpg')
                   :
            $url."/".$profile->pic
       }}" alt="Card image cap">
                        <div class="card-body" style="text-align: center;">
                            <h5 class="card-title"><b>{{$profile->name}}</b></h5>
                            <p class="card-text">{{$profile->bio == '' || $profile->bio==null?
                                  'Bio is yet to updated':
                                  $profile->bio
                                  }}</p>


                            @if($is_following_user==0)
                            <a class="btn btn-primary" id="follow-user" data-user="{{$profile->id}}">Follow User</a>
                                @else
                                <a  class="btn btn-danger" id="unfollow-user" data-user="{{$profile->id}}">UnFollow User</a>
                           @endif
                        </div>
                    </div>

                </div>

        </div>
    </div>
    </div>
@endsection



