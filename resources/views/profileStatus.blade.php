
@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile Status {{$profile_status}}</div>

                    <div class="card-body" style="">
                       <div>
                          <h6>
                             <b>Set Your profile status to public or private</b>
                          </h6>
                           <span>Private status means your profile bio can only be viewed by people following you</span>
                       </div>

                        <div class="display_err">

                        </div>
                        <meta name="_token" content="{{ csrf_token() }}" />

                        <div class="form-check form-check-inline">
                            @if($profile_status==1)
                            <input class="form-check-input elem_checked" type="checkbox"
                                   id="inlineRadio1" value="1"
                                   checked>
                            @else
                                <input class="form-check-input" type="checkbox"
                                        id="inlineRadio1" value="1"
                                        >

                                @endif

                            <label class="form-check-label" for="inlineRadio1">Public Status</label>
                        </div>
                        <div class="form-check form-check-inline">
                            @if($profile_status==0)
                                <input class="form-check-input elem_checked" type="checkbox"
                                       id="inlineRadio2" value="0"
                                       checked>
                            @else
                                <input class="form-check-input" type="checkbox"
                                       id="inlineRadio1" value="0"
                                       >

                            @endif
                            <label class="form-check-label" for="inlineRadio2">Private Status</label>
                        </div>

                        <div class="form-group">
                            <button type="button" id="btn-submit-profile-status" class="btn btn-primary">
                                Submit Form
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



