@extends('layouts.sidebar')

@section('title', $project->name);

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <a class="card card-banner">
                <div class="card-body">
                    <div class="content">
                        <div class="slideshow-container">
                            @foreach ($project->photos()->get() as $photo)
                                <div class="mySlides">
                                    <img src="{{ Storage::url($photo->path) }}" style="width:100%; height:500px; object-fit:cover;">
                                </div>
                            @endforeach
                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-banner card-green-light">
                <div class="card-body">
                    <i class="icon fa fa-book"></i>
                    <div class="content">
                        <div class="title">{{ $project->description }}</div>
                    </div>  
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="#" class="card card-banner card-orange-light">
                <div class="card-body">
                    <i class="icon fa fa-user"></i>
                    <div class="content">
                        <div class="title">Owner</div>
                        <div class="value">{{ $project->owner()->first()->name }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="card card-banner card-red-light">
                <div class="card-body">
                    <i class="icon fa fa-wrench"></i>
                    <div class="content">
                        <div class="title">Difficulty</div>
                        <div class="value">{{ $project->difficulty }}</div>
                    </div>
                </div>
            </div>
        </div>
        @if ($project->document)
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <a href="/downloadDocument/{{ $project->id }}" class="card card-banner card-blue-light">
                    <div class="card-body">
                        <i class="icon fa fa-file"></i>
                        <div class="content">
                            <div class="title">Click here to get the</div>
                            <div class="value">File</div>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        @if ($project->categories()->get()->count() > 0)
            <div class="col-md-12">
                <div class="card categories">
                    <div class="card-body">
                        <div class="content">
                        <div class="title">Categories</div>
                            @foreach ($project->categories()->get() as $category)
                                <span id="{{ $category->id }}" class="btn btn-success">{{ $category->name }}</span>
                            @endforeach
                        </div>  
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/projects.js') }}"></script>
@endpush