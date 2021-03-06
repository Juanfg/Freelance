@extends('layouts.sidebar')

@section('title', 'My Projects')

@section('content')
<div class="row">
	<div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                Here you can see your own projects.
            </div>
            <div class="scroll card-body no-padding" data-step="1" data-intro="All of the projects you've submitted to the platform are listed here!" data-position='top'>
                <table class="table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Name</th>
                            <th>difficulty</th>
                            <th>Document</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr data-id="{{ $project->id }}"> 
                                <td>               
                                  @if ($project->photos()->first())
                                        <a href="{{ route('projects.show', [ $project->id]) }}">
                                        <img src="{{Storage::url($project->photos()->first()->path)}}" width=80 height=80 class="img-responsive img-thumbnail">
                                    @endif
                                </td>
                                <td ><a href="{{ route('projects.show', [$project->id]) }}" data-step="2" data-intro="If you want to see the project's page you better click here!" data-position='top'>{{ $project->name }}</a></td>                    
                                <td>{{ $project->difficulty }}</td>
                                <td>{{ $project->document ? 'YES' : 'NO' }}</td>
                                <td>{{ $project->active ? 'YES' : 'NO' }}</td>
                                <td>
                                    <button class="btn btn-primary btn-xs edit" data-step="3" data-intro="Want to change some things about your project? Click here!" data-position="left"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs delete" data-step="4" data-intro="Careful! If you press this button your project will be permanently deleted." data-position="left"><i class="fa fa-trash-o "></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-body">
                <button class="btn btn-success create" data-step="5" data-intro="Want to create a new project? Think no more and click here!" data-position="top">
                    Create a new Project
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/projects.js') }}"></script>
@endpush
