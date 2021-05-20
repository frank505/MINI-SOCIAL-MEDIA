
@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3 ><b>All Registered Users</b></h3>
            </div>


            @foreach ($data as $profile)


                <div class="col-md-4">

                    <div class="card" >
                        <img class="card-img-top" src="{{
                   $profile->pic=='default.png'?
                    asset('/dist/img/custom_user_img.jpg')
                   :
            $url."/".$profile->pic
                }}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><b>{{$profile->name}}</b></h4><br>
                            <a href="/panel/home/username/{{$profile->id}}" class="btn btn-primary">View Bio</a>
                            <a href="/admin/edit/{{$profile->id}}" class="btn btn-primary">Edit User</a>
                            <a href="/admin/{{$profile->id}}" class="btn btn-primary">Delete User</a>
                        </div>
                    </div>

                </div>


            @endforeach


            {{ $data->onEachSide(2)->links() }}

        </div>
    </div>
    </div>
@endsection



