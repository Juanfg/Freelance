@extends('layouts.sidebar')

@section('title', 'Update User')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                Create a new project and show it to the world!
            </div>
            
            <div class="card-body" data-step="1" data-intro="Update your profile with the form we have provided you!" data-position='top'>
            {!! Form::open(['method' => 'PUT', 'route' => ['users.update', $user->id ], 'files' =>true] ) !!}
                <div class="col-md-12">                
                        <div class="form-group col-xs-12 col-md-6" data-step="2" data-intro="Changed your name? Don't worry, we got you covered." data-position='top'>
                            <label for="name">Name:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" name="name" placeholder="Name" id="name" value="{{{$user->name}}}">
                            </div>
                        </div>
                        <div class="form-group col-md-3" data-step="3" data-intro="Don't be shy! Give your profile the best smile you have. Make sure that smile is in the supported formats, though. (JPG, JPEG, PNG, SUVG)" data-position='top'>
                            <label for="photos">Profile Picture</label>
                            <input type="file" id="profile" name="profile"/>
                            <p class="help-block">Add photo</p>
                        </div>
                        <div class="form-group col-md-3" data-step="4" data-intro="If you upload a resume it will be easier for a project owner to decide whether to choose you over that collaborator with the most beautiful profile picture or not." data-position='top'>
                            <label for="photos">Resume</label>
                            <input type="file" id="resume" name="resume"/>
                            <p class="help-block">Add resume</p>
                        </div>

                        <div class="form-group col-xs-12 col-md-6" data-step="5" data-intro="Think your teeth are perfect? How about 'The One With The Best In The Game' sounds? Write a subtitle for you that differentiates yourself from the rest! " data-position='top'>
                            <label for="name">Subtitle</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                                <input class="form-control" type="text" name="subtitle" placeholder="subtitle" id="name" value="{{$user->subtitle}}">
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-md-12" data-step="6" data-intro="Write the story of your life here! (Actually not, we don't want to read our way through your puberty)." data-position='top'>
                            <label for="description">Bio:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                <textarea class="form-control" name="bio" id="bio" rows="4">{{$user->bio}}</textarea>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-md-6" data-step="7" data-intro="You can always change your password here! The confirmation on the right is self explanatory." data-position='top'>
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
