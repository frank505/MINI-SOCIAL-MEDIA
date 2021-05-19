
@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit BioMessage </div>

                    <div class="card-body" style="">

                        <div class="display_err">

                        </div>
                        <meta name="_token" content="{{ csrf_token() }}" />

                        <div class="form-group">
                           <label>Bio Data:</label>
                            <textarea id="bio-data-text-area"
                            class="form-control"
                            >
                                {{$message}}
                            </textarea>

                        </div>


                        <div class="form-group">
                            <button type="button" id="btn-submit-bio-data" class="btn btn-primary">
                                Submit Form
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



