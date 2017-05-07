@extends('layouts.sidebar')

@section('content')
<div class="row fix">
	@foreach($projects as $project)
	<div class="col-xs-3">
		<div class="card card-mini">
			<div class="card-header">
				<!-- Aquí iría la imagen -->
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
				<button type="button" class="btn btn-success">See more</button>
			</div>
		</div>
		</div>
	@endforeach
</div>
@endsection
