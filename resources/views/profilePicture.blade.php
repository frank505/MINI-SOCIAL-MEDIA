
@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile Picture </div>

                    <div class="card-body" style="text-align: center">

                     <div class="display_err">

                     </div>
                        <meta name="_token" content="{{ csrf_token() }}" />

                        <div class="form-group">
                            <img
                                src="{{
                                  $details=='default.png'?
                                  asset('./dist/img/custom_user_img.jpg')
                                  :
                                  $details
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
                              <button type="button" id="btn-submit-profile" class="btn btn-primary">
                                  Submit Form
                              </button>
                          </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



