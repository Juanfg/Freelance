@extends('layouts.sidebar')

@section('content')
    <div class="col-md-12">
        <a class="card card-banner">
            <div class="card-body">
                <div class="content">
                    <div class="slideshow-container">
                        @foreach ($project->photos()->get() as $photo)
                            <div class="mySlides">
                                <img src="{{ Storage::url($photo->path) }}" style="width:100%">
                            </div>
                        @endforeach
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/projects.js') }}"></script>
@endpush

<!--<div class="card-header">
        {{ $project->name }}
    </div>

    <div class="col-md-12">
        <div class="card card-banner">
            <div class="slideshow-container">
                @foreach ($project->photos()->get() as $photo)
                    <div class="mySlides">
                        <img src="{{ Storage::url($photo->path) }}" style="width:100%">
                    </div>
                @endforeach
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <div class="col-md-6">
                <label for="description">Description:</label>
                <p>{{ $project->description }}</p>
            </div>
            <div class="col-md-6">
                <label for="difficulty">Difficulty:</label>
                <p>{{ $project->difficulty }}</p>
            </div>
            <div class="col-md-12">
                <label for="categories">Categories:</label>
                @foreach ($project->categories()->get() as $category)
                    <span id="{{ $category->id }}" class="btn btn-success">{{ $category->name }}</span>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card-body">
        hola
    </div>
</div>-->