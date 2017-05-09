@extends('layouts.sidebar')

@section('title', $project->name)

@section('content')

    @if($status==4)
        <div class="row">
            <div class="col-md-12">
                <div class="card card-banner card-red-light">
                    <div class="card-body">
                        <i class="icon fa fa-exclamation-triangle"></i>
                        <div class="content">
                            <div class="value">This project was already completed</div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    @endif

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
                            <a class="prev" onclick="plusSlides(-1)" data-step="2" data-intro="Move to the previous image" data-position="right">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)"  data-step="3" data-intro="Move to the next image" data-position="left">&#10095;</a>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row" data-step="1" data-intro="This is the complete information related to the project" data-position="top">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  data-step="1" data-intro="The owner of this project made a really hard work writing this description just for you. Why not have a closer look at what he has to say about his project?" data-position="top">
            <a class="card card-banner card-green-light">
                <div class="card-body">
                    <div class="content">
                        <div class="title">Description</div>
                        <div class="title">{{ $project->description }}</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="{{ route('users.show', $project->owner()->first()->id) }}" class="card card-banner card-orange-light">
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
                <a href="/downloadDocument/{{ $project->id }}" class="card card-banner card-blue-light" data-step="4" data-intro="The owner left you a document with an even deeper inside about the project itself! Click this box to download it right now." data-position="left">
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

            
            @if($status==2)
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <a class="card card-banner card-green-light join" data-id="{{ $project->id }}">
                    <div class="card-body">
                        <i class="icon fa fa-user-plus"></i>
                        <div class="content">
                            <div class="title">Click here to</div>
                            <div class="value">Join</div>
                        </div>
                    </div>
                </a>
            </div>
            @elseif($status==1)
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <a class="card card-banner card-orange-light finish" data-id="{{ $project->id }}">
                    <div class="card-body">
                        <i class="icon fa fa-check-square"></i>
                        <div class="content">
                            <div class="title">Click here to</div>
                            <div class="value">Finish</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <a class="card card-banner card-blue-light edit" data-id="{{ $project->id }}">
                    <div class="card-body">
                        <i class="icon fa fa-check-square"></i>
                        <div class="content">
                            <div class="title">Click here to</div>
                            <div class="value">Edit</div>
                        </div>
                    </div>
                </a>
            </div>
            @elseif($status==3)
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <a class="card card-banner card-red-light leave" data-id="{{ $project->id }}" >
                    <div class="card-body">
                        <i class="icon fa fa-times"></i>
                        <div class="content">
                            <div class="title">Click here to</div>
                            <div class="value">Leave</div>
                        </div>
                    </div>
                </a>
            </div>            
            @endif           
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/projects.js') }}"></script>
@endpush