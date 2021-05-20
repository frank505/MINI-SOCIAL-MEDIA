
@extends('layouts.home')

@section('content')
    <div class="container">

       <h1 style="margin-bottom:100px;">
           All Registered Users
       </h1>

        <div class="row">


            @foreach ($data as $profile)


            <div class="col-md-3" style="margin-bottom: 15px;">

                <div class="card" >
                    <img class="card-img-top" src="{{
                   $profile->pic=='default.png'?
                    asset('./dist/img/custom_user_img.jpg')
                   :
            $url."/".$profile->pic
       }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><b>{{$profile->name}}</b></h5>
                        <a href="/username/{{$profile->id}}" class="btn btn-primary">View Bio</a>
                    </div>
                </div>

                </div>


            @endforeach


                {{ $data->onEachSide(2)->links() }}

            </div>
        </div>
    </div>
@endsection



