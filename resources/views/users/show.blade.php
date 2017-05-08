@extends('layouts.sidebar')

@section('title', 'User Profile')

@section('content')
	

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body app-heading">
          <img class="profile-img" src="{{ Storage::url($user->profile_picture) }}">
          <div class="app-title">
            <div class="title"><span class="highlight">{{$user->name}}</span></div>
            <div class="description">{{$user->subtitle}}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-tab">
        <div class="card-header">
          <ul class="nav nav-tabs">
            <li role="tab1" class="active">
              <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Profile</a>
            </li>
          </ul>
        </div>
        <div class="card-body no-padding tab-content">
          <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="row">
              <div class="col-md-3 col-sm-12">
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Bio</div>
                  <div class="section-body __indent">{{$user->bio}}</div>
                </div>
                @if($user->resume)
                  <div class="section">
                    <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Resume</div>
                      <a href="/downloadDocument/{{ $user->id }}" class="card card-banner card-blue-light">
                          <div class="card-body">
                            <i class="icon fa fa-file"></i>
                            <div class="content">
                                <div class="title">Click to download</div>
                                <div class="value">Here</div>
                          </div>
                      </div>
                    </a>
                  </div>
                @endif
              </div>
              <div class="col-md-9 col-sm-12">
                <div class="section">
                  <div class="section-title">Projects I've collaborated in</div>
                  <div class="section-body">
                    <div class="media social-post">
                      <div class="media-left">
                        <a href="#">
                          <img src="../assets/images/profile.png" />
                        </a>
                      </div>
                      <div class="media-body">
                        <div class="media-heading">
                          <h4 class="title">Project name here</h4>
                          <h5 class="timeing">Categories</h5>
                        </div>
                        <div class="media-content">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        @if($user->id == Auth::user()->id)
		      <a class="btn btn-success margin-top" href="{{ route('users.edit', [ Auth::user()]) }}">Update Profile</a>
        @endif
    </div>   
  </div>


@endsection
