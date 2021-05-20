
@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New User</div>

                    <div class="card-body" style="">

                        <div class="display_err">

                        </div>
                        <meta name="_token" content="{{ csrf_token() }}" />


                        <div class="form-group">
                            <label>Username:</label>
                            <input type="text" id="username" class="form-control"/>
                        </div>


                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" id="name" class="form-control"/>
                        </div>


                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" id="email" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" id="password" class="form-control"/>
                        </div>


                        <div class="form-group">
                            <label>Confirm:</label>
                            <input type="password" id="password_confirmation" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <button type="button" id="btn-submit-user-create" class="btn btn-primary">
                                Submit Form
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



