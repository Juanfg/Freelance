@extends('layouts.sidebar')

@section('title', 'Create Project')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                Create a new project and show it to the world!
            </div>
            <div class="messages"></div>
            <div class="card-body">
                <div class="col-md-12"  data-step="1" data-intro="This is the form where you create a new project" data-position="top">
                    <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="" name="form-data">
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="name">Name:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" name="name" placeholder="Name" id="name">
                            </div>
                        </div>
                        <div class="form-group col-md-6" data-step="2" data-intro="If you want to add multiple photos related to your project, remember to Ctrl+Click to select more than one! " data-position="left">
                            <label for="photos">Photos of the project (optional):</label>
                            <input type="file" id="photos" name="photos[]" multiple/>
                            <p class="help-block">Add photos</p>
                        </div>
                        <div class="form-group col-xs-12 col-md-12">
                            <label for="description">Description:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-6" data-step="3" data-intro="Please tell us how difficult your project is" data-position="top">
                            <label for="difficulty">From 1 to 10, how difficult is your proyect:</label>
                            <input id="difficulty" name="difficulty" type="range" min="1" max="10" step="1" value="1" onchange="updateRangeInput(this.value);"/>
                            <input type="text" id="rangeInput" value="1">
                        </div>
                        <div class="form-group col-md-6" data-step="4" data-intro="If you want to add a document related to your project, click here and add it" data-position="left">
                            <label for="document">Document related to the project (optional):</label>
                            <input type="file" id="document" name="document"/>
                            <p class="help-block">Add document</p>
                        </div>
                    </form>
                </div>
                <div class="form-group col-md-12" style="margin-top: 5px;" data-step="5" data-intro="If you think that there is a category from here that relates to your project, drag it to the green box" data-position="top">
                    <div class="col-md-12">
                        <label for="categories">Please drop the categories related to your project:</label>
                    </div>
                    <div class="col-md-12">
                        @foreach ($categories as $category)
                            <span id="{{ $category->id }}" class="draggable btn btn-danger">{{ $category->name }}</span>
                        @endforeach
                        <div class="droptarget" id="droppable"></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-success" id="store" style="margin-left: 30px;" data-step="6" data-intro="Click here if you want to show your project to the world!" data-position="top">
                    Create
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/projects.js') }}"></script>
@endpush