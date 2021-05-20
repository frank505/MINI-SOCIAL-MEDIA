
@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">





            <div class="col-md-8">

                <div class="card">

                    <meta name="_token" content="{{ csrf_token() }}" />

                    <div class="card-header">User Profile Details </div>

                    <div class="card-body" style="text-align: center">

                        <div class="display_err"></div>

                        <img
                            style="width:150px;height: 150px;"
                            src="{{
                   $profile->pic=='default.png'?
                    asset('./dist/img/custom_user_img.jpg')
                   :
            $url."/".$profile->pic
       }}" alt="Card image cap">
                        <div class="card-body" >
                            <h3 class="card-title" style="text-align: center;"><b>Name: {{$profile->name}}</b></h3>
                            <p class="card-text">{{$profile->bio}}</p>

                        </div>
                    </div>


                </div>



            </div>

        </div>
    </div>
    </div>
@endsection



