
@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit User</div>

                    <div class="card-body" style="">

                        <div class="display_err">

                        </div>
                        <meta name="_token" content="{{ csrf_token() }}" />

                        <input type="hidden" value="{{request()->route('id')}}" id="content-edit-id"/>

                        <div class="form-group" style="text-align: center;align-items: center;align-self: center">
                            <img
                                style="height: 200px;width:200px;"
                                src="{{
                                  $data->pic=='default.png'?
                                  asset('./dist/img/custom_user_img.jpg')
                                  :
                                  $url."".$data->pic
                                  }}"
                                style="height: 150px;width: 150px;"
                                class="image img-rounded img-content"/>
                            <label style="position: absolute;margin-top: 10px;
                           z-index:20;margin-left: -40px;cursor:pointer"
                                   for="img-profile"
                                   id="profile-picture-label"
                            >
                                <i class="fas fa-camera fa-3x"></i>
                            </label>

                            <input type="file" id="img-profile"
                                   style="display: none;"/>

                        </div>

                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" id="name"
                                   value="{{$data->name}}"
                                   class="form-control"/>
                        </div>


                        <div class="form-group">
                            <label>Bio:</label>
                            <textarea id="bio-edit" class="form-control">
                                {{$data->bio}}
                            </textarea>
                        </div>





                        <div class="form-group">
                            <button type="button" id="btn-submit-user-edit" class="btn btn-primary">
                                Submit Form
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



