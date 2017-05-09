@extends('layouts.sidebar')

@section('title', 'Update ' . $project->name)

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                Improve your project!
            </div>
            <div class="messages"></div>
            <div class="card-body">
                <div class="col-md-12" data-step="1" data-intro="This is the form where you update your project." data-position="top">
                    <form enctype="multipart/form-data" id="upload_form" role="form" method="PUT" action="" name="form-data">
                        <input class="form-control" type="hidden" id="project_id" value="{{ $project->id }}">
                        <div class="form-group col-xs-12 col-md-12">
                            <div class="slideshow-container">
                                @foreach ($project->photos()->get() as $photo)
                                    <div class="mySlides" id="{{ $photo->id }}"  data-step="2" data-intro="If you want to delete a photo, click on the red X on the top right">
                                        <img src="{{ Storage::url($photo->path) }}" style="width:100%; height:500px; object-fit:cover;" id="{{ $photo->id }}">
                                        <img src="{{ Storage::url('public/x_button.png') }}" class="close current_photo" id="{{ $photo->id }}"></img>
                                    </div>
                                @endforeach
                                <a class="prev" onclick="plusSlides(-1)" data-step="3" data-intro="Move to the previous image" data-position="right">&#10094;</a>
                                <a class="next" onclick="plusSlides(1)" data-step="4" data-intro="Move to the next image" data-position="left">&#10095;</a>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="name">Name:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" name="name" placeholder="Name" id="name" value="{{ $project->name }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6" data-step="5" data-intro="If you want more images in your project, add them here." data-position="left">
                            <label for="photos">Add photos:</label>
                            <input type="file" id="photos" name="photos[]" multiple/>
                            <p class="help-block">Add photos</p>
                        </div>
                        <div class="form-group col-xs-12 col-md-12">
                            <label for="description">Description:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                <textarea class="form-control" name="description" id="description" rows="4">{{ $project->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="difficulty">From 1 to 10, how difficult is your proyect:</label>
                            <input id="difficulty" name="difficulty" type="range" min="1" max="10" step="1" value="{{ $project->difficulty }}" onchange="updateRangeInput(this.value);"/>
                            <input type="text" id="rangeInput" value="{{ $project->difficulty }}">
                        </div>
                        <div class="form-group col-md-6" data-step="6" data-intro="If you want to update your current document or add a new one, click here." data-position="left">
                            <label for="document">Change your project document:</label>
                            <input type="file" id="document" name="document"/>
                            <p class="help-block">Update document</p>
                        </div>
                    </form>
                </div>
                <div class="form-group col-md-12" style="margin-top: 5px;" data-step="6" data-intro="If you think that there is a category from here related to your project, drag it to the green box" data-position="top">
                    <div class="col-md-12">
                        <label for="categories">Please drop the categories related to your project:</label>
                    </div>
                    <div class="col-md-12">
                        @foreach ($categories as $category)
                            <span id="{{ $category->id }}" class="draggable btn btn-danger">{{ $category->name }}</span>
                        @endforeach
                        <div class="droptarget" id="droppable">
                            @if ($project)
                                @foreach ($project->categories()->get() as $category)
                                    <span id="{{ $category->id }}" class="draggable btn btn-success">{{ $category->name }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-success" id="update" style="margin-left: 30px;" data-step="7" data-intro="Click here if you are finished with your changes." data-position="top">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/projects.js') }}"></script>
@endpush