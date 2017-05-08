@extends('layouts.sidebar')

@section('title', 'Manage Categories')

@section('content')
<div class="row">
	<div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                Here you can manage your categories.
            </div>
            <div class="scroll card-body no-padding">
                <table class="table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr> 
                                <td>{{ $category->id}}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                	@if($category->active)
                                		<a class="btn btn-primary btn-xs" href="{{route('deactivate_category', [$category->id])}}"><i class="fa fa-times"></i></a>
                                	@else
                                		<a class="btn btn-warning btn-xs" href="{{route('activate_category', [$category->id])}}"><i class="fa fa-pencil"></i></a>
                                	@endif	
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <a class="btn btn-success" href="{{ route('create_category') }}">Create new category</a>
            </div>
        </div>
    </div>
</div>

@endsection