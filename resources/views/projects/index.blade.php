@extends('layouts.sidebar')

@section('title', 'My Projects')

@section('content')
<div class="row">
	<div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                Here you can see your own projects.
            </div>
            <div class="scroll card-body no-padding">
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
                                <td><a href="{{ route('projects.show', [ $project->id]) }}"><img src="{{Storage::url($project->photos()->first()->path)}}" width=100 height=100 class="img-responsive img-thumbnail"></td>
                                <td>{{ $project->name }}</td>                    
                                <td>{{ $project->description }}</td>
                                <td>{{ $project->difficulty }}</td>
                                <td>{{ $project->document ? 'YES' : 'NO' }}</td>
                                <td>{{ $project->active ? 'YES' : 'NO' }}</td>
                                <td>
                                    <button class="btn btn-primary btn-xs edit"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o "></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-body">
                <button class="btn btn-success create">Create a new Project</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/projects.js') }}"></script>
@endpush
