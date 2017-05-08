@extends('layouts.sidebar')

@section('title', 'Edit Profile')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">Update your profile with your most recent information.</div>
            {!! Form::open(['method' => 'PUT', 'route' => ['users.update', $user->id ], 'files' =>true] ) !!}
            <div class="card-body">
                <div class="col-md-12">
                    <input class="form-control" type="hidden" id="user_id" value="{{ $user->id }}">
                    <div class="form-group col-xs-12 col-md-12">
                        <div class="slideshow-container">

                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="name">Name:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" type="text" name="name" placeholder="Name" id="name" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="profile">Update your profile picture:</label>
                        <input type="file" id="profile" name="profile"/>
                        <p class="help-block">Add photo</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="resume">Update your resume:</label>
                        <input type="file" id="resume" name="resume"/>
                        <p class="help-block">Add document</p>
                    </div>

                    <div class="form-group col-xs-12 col-md-12">
                        <label for="description">Subtitle:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                            <textarea class="form-control" name="subtitle" id="subtitile" rows="1">{{ $user->subtitle}}</textarea>
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-md-12">
                        <label for="description">Biography:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-info"></i></span>
                            <textarea class="form-control" name="bio" id="bio" rows="4">{{ $user->bio}}</textarea>
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-md-6">
                        <label for="name">New password:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" type="password" name="password" placeholder="Password" id="password"}}>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Confirm your new password:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Password Confirmation" id="password-confirmation">
                        </div>
                    </div>

                 <div class="card-body">
                     <button class="btn btn-success" id="update" style="margin-left: -15px;">Update</button>
                 </div>                
             </div>
         </div>
        {!! Form::close() !!}
     </div>

    </div>
</div>
@endsection