@extends('layouts.sidebar')


@section('title', 'Available Projects')

@section('content')
<div class="row fix" data-step="1" data-intro="This is the home page. You can see all the projects here!" data-position='top'>
	@foreach($projects as $project)
	<div class="col-xs-3">
		<div class="card card-mini"  data-step="2" data-intro="This is a single project" data-position='top'>
			<div class="card-body-title style=" display: "inline-block;" data-step="3" data-intro="This is the name of the project" data-position='top'>
				{{$project->name}}
			</div>
			<div class="card-body-description" data-step="4" data-intro="This is name of the owner of the project" data-position='top'>
				Owner: {{$project->owner()->first()->name}}
			</div>
			<div class="card-body-description" data-step="5" data-intro="This is how difficult is the project from 1 to 10" data-position='top'>
				Difficulty: {{$project->difficulty}}
			</div>
			<div class="card-body-description" data-step="6" data-intro="These are the categories of the project" data-position='top'>
				@foreach ($project->categories()->get() as $category)
				<button type="button" class="btn btn-primary btn-xs">{{$category->name}}</button>
				@endforeach
			</div>
			<div class="card-body">

				<a type="button" href="{{ route('projects.show', [ $project->id]) }}" class="btn btn-success"  data-step="7" data-intro="With this button you can have a better perspective of the project" data-position='top'>
					See more
				</a>

			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection
