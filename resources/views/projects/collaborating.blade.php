@extends('layouts.sidebar')

@section('title', 'My collaborating projects')

@section('content')
<div class="row">
	<div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                Here are the projects where you are helping and doing magic!
            </div>
            <div class="scroll card-body no-padding" data-step="1" data-intro="Here are the projects you are currently working on!" data-position='top'>
                <table class="table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Name</th>
                            <th>difficulty</th>
                            <th>Document</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr data-id="{{ $project->id }}">
                                <td>
                                    <a href="{{ route('projects.show', [ $project->id]) }}">
                                    @if ($project->photos()->first())
                                        <img src="{{Storage::url($project->photos()->first()->path)}}" width=80 height=80 class="img-responsive img-thumbnail">
                                    @endif
                                    </a>
                                </td>
                                <td><a href="{{ route('projects.show', [ $project->id]) }}" data-step="2" data-intro="You can click here if you want all the information about the project" data-position='top'>{{$project->name}}</a>

                                </td>                    
                                <td>{{ $project->difficulty }}</td>
                                <td>{{ $project->document ? 'YES' : 'NO' }}</td>
                                <td>
                                    <button class="btn btn-danger btn-xs leave" data-step="4" data-intro="Click hereIf you want to leave a project. But remember, the lovely friends you made along the way will miss you :(" data-position="left">Leave project</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/projects.js') }}"></script>
@endpush
