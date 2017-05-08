@extends('layouts.sidebar')

@section('title', 'Manage Projects')

@section('content')
<div class="row">
	<div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                Here you can manage all projects.
            </div>
            <div class="scroll card-body no-padding">
                <table class="table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Project Name</th>
                            <th>Owner</th>
                            <th>Activate / Deactivate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr> 
                                <td>{{ $project->id}}</td>
                                <td><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></td>                    
                                <td><a href="{{ route('users.show', $project->owner()->first()->id) }}">{{ $project->owner()->first()->name }}</a></td>
                                <td>
                                	@if($project->active)
                                		<a class="btn btn-primary btn-xs" href="{{route('deactivate_project', [$project->id])}}"><i class="fa fa-times"></i></a>
                                	@else
                                		<a class="btn btn-warning btn-xs" href="{{route('deactivate_project', [$project->id])}}"><i class="fa fa-pencil"></i></a>
                                	@endif	
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