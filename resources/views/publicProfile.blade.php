
@extends('layouts.home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">





                <div class="col-md-8">

                    <div class="card" >
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
                            <p class="card-text">{{$profile->bio}}</p>
                            <a href="/username/{{$profile->id}}" class="btn btn-primary">Follow User</a>
                        </div>
                    </div>

                </div>

        </div>
    </div>
    </div>
@endsection



