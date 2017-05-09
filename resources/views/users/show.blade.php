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

            @if($user->id == Auth::user()->id)
            <li role="tab2" data-step="4" data-intro="Remember when you created your first project? If lots of people were interested and asked to join your project, you will see their requests right here!" data-position='top'>
              <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Requests</a>
            </li>
            @endif

          </ul>
        </div>
        <div class="card-body no-padding tab-content">
          <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="row">
              <div class="col-md-3 col-sm-12">
                <div class="section" data-step="1" data-intro="You may always find interesting facts about the users in their biographies. Have you worked on yours already? " data-position='top'>
                  <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Bio</div>
                  <div class="section-body __indent">{{$user->bio}}</div>
                </div>
                @if($user->resume)
                  <div class="section" data-step="2" data-intro="It seems like this user wants you to see his resume. It's not that bad to brag if you've got actually something to brag about!" data-position='top'>
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
                  @if($user->id == Auth::user()->id)
                  <div class="section" data-step="5" data-intro="Make sure you keep updating your profile with the latest information!" data-position='top'>
                    <div class="section-title"><i class="icon fa fa-gear" aria-hidden="true"></i> Edit Profile</div>
                      <a href="{{ route('users.edit', [ Auth::user()]) }}" class="card card-banner card-orange-light">
                          <div class="card-body">
                            <i class="icon fa fa-gear"></i>
                            <div class="content">
                                <div class="title">Click here to </div>
                                <div class="value">Edit</div>
                          </div>
                      </div>
                    </a>
                  </div>
                  @endif
              </div>
              <div class="col-md-9 col-sm-12">
                <div class="section" data-step="3" data-intro="When a project you've worked on is finished by the owner, it will be shown here. Look at this as your resume throughout your life on this platform!" data-position='top'>
                  <div class="section-title">Projects I've collaborated in</div>
                  <div class="section-body">
                  @foreach($finished_projects as $project)
                    <div class="media social-post">
                      <div class="media-left">
                        <a href="#">
                          @if($project->photos())
                          <img src="{{ Storage::url($project->photos()->get()[0]->path) }}" />
                          @endif
                        </a>
                      </div>
                      
                      <div class="media-body">
                        <div class="media-heading">
                          <a href="{{ route('projects.show', [ $project->id]) }}"><h4 class="title">{{$project->name}}</h4></a>
                          <h5 class="timeing">
                            @foreach ($project->categories()->get() as $category)
                              <button type="button" class="btn btn-primary btn-xs">{{$category->name}}</button>
                            @endforeach
                          </h5>
                        </div>
                        <div class="media-content">{{$project->description}}</div>
                      </div>                     
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div role="tabpanel" class="tab-pane" id="tab2">
            
              
                <div class="card-header">
                  Pending Requests
                </div>
                <div class="card-body no-padding">
                  <table class="datatable table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Project</th>
                        <th>User name</th>
                        <th>Email</th>
                        <th>Accept</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($projects_requests as $project)
                        @if ($project->not_accepted_collaborators)
                          @foreach ($project->not_accepted_collaborators as $collaborator)
                            <tr collaborator="{{ $collaborator->id }}" project="{{ $project->id }}">
                              <td><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></td>
                              <td><a href="{{ route('users.show', $collaborator->id) }}">{{ $collaborator->name }}</a></td>
                              <td>{{ $collaborator->email }}</td>
                              <td>
                                <button class="btn btn-success btn-xs accept"><i class="fa fa-check"></i></button>
                              </td>
                            </tr>
                          @endforeach
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
             
           
          </div>

        </div>
      </div>
    </div>   
  </div>


@endsection

@push('scripts')
    <script src="{{ asset('js/projects.js') }}"></script>
@endpush
