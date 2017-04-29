@extends('layouts.sidebar')

@section('content')

<div class="card">
        <div class="card-header">
            Your Projects
        </div>
        <div class="scroll card-body no-padding">
            <table class="table table-striped primary" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>difficulty</th>
                        <th>Document</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr data-id="{{ $project->id }}">
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

@endsection

@push('scripts')
    <script src="{{ asset('js/projects.js') }}"></script>
@endpush
