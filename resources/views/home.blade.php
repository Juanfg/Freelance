@extends('layouts.sidebar')

@section('title', 'Available Projects')

@section('content')
<div class="row fix">
	@foreach($projects as $project)
	<div class="col-xs-3">
		<div class="card card-mini">
			<div class="card-header">
				<!-- Aquí iría la imagen... SI TUVIERA UNA -->
			</div>
			<div class="card-body-title style="display: inline-block;">
				{{$project->name}}
			</div>
			<div class="card-body-description">
				Owner: {{$project->owner()->first()->name}}
			</div>
			<div class="card-body-description">
				Difficulty: {{$project->difficulty}}
			</div>
			<div class="card-body-description">
				@foreach ($project->categories()->get() as $category)
				<button type="button" class="btn btn-primary btn-xs">{{$category->name}}</button>
				@endforeach
			</div>
			<div class="card-body">
				<a type="button" href="{{ route('projects.show', [ $project->id]) }}" class="btn btn-success">See more</a>
			</div>
		</div>
		</div>
	@endforeach
</div>
@endsection
