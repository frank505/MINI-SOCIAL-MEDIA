
@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3 ><b>Users You Are Following</b></h3>
            </div>


            @foreach ($data as $profile)


                <div class="col-md-4">

                    <div class="card" >
                        <img class="card-img-top"
                             style="height: 250px;"
                             src="{{
                   $profile->followers->pic=='default.png'?
                    asset('/dist/img/custom_user_img.jpg')
                   :
            $url."/".$profile->followers->pic
                }}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><b>{{$profile->followers->name}}</b></h4><br>
                            <a href="/panel/home/username/{{$profile->followers->id}}" class="btn btn-primary">View Bio</a>
                        </div>
                    </div>

                </div>


            @endforeach


            {{ $data->onEachSide(2)->links() }}

        </div>
    </div>
    </div>
@endsection



