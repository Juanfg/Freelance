@extends('layouts.sidebar')

@section('title', 'Update User')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                Create a new project and show it to the world!
            </div>
            
            <div class="card-body">
            {!! Form::open(['method' => 'PUT', 'route' => ['users.update', $user->id ], 'files' =>true] ) !!}
                <div class="col-md-12">                
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="name">Name:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" name="name" placeholder="Name" id="name" value="{{{$user->name}}}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="photos">Profile Picture</label>
                            <input type="file" id="profile" name="profile"/>
                            <p class="help-block">Add photo</p>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="photos">Resume</label>
                            <input type="file" id="resume" name="resume"/>
                            <p class="help-block">Add resume</p>
                        </div>

                        <div class="form-group col-xs-12 col-md-6">
                            <label for="name">Subtitle</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                                <input class="form-control" type="text" name="subtitle" placeholder="subtitle" id="name" value="{{$user->subtitle}}">
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-md-12">
                            <label for="description">Bio:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                <textarea class="form-control" name="bio" id="bio" rows="4">{{$user->bio}}</textarea>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-md-6">
                        <label for="name">New password:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input class="form-control" type="password" name="password" placeholder="Password" id="password"}}>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Confirm your new password:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Password Confirmation" id="password-confirmation">
                        </div>
                    </div>                   
                </div>

                <button class="btn btn-success" id="store" style="margin-left: 30px;">
                    Update
                </button>

                {!! Form::close() !!}
                
            </div>
        </div>
    </div>
</div>
@endsection
