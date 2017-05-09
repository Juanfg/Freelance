@extends('layouts.sidebar')

@section('title', 'Grade Collaborators')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Grade the people that collaborated in your project</div>
        </div>
            {!! Form::open(['method' => 'POST', 'route' => ['store_category']] ) !!}
              @foreach ($collaborators as $collaborator)
            <div class="card-body">
                  <label class="col-md-3 control-label">{{ $collaborator->name }}</label>
                  <div class="col-md-9">
                    <div class="radio radio-inline">
                        <input type="radio" name="grade" id="radio1" value="1">
                        <label for="radio1">
                          1
                        </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" name="grade" id="radio2" value="2">
                        <label for="radio2">
                          2
                        </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" name="grade" id="radio3" value="3">
                        <label for="radio3">
                          3
                        </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" name="grade" id="radio4" value="4">
                        <label for="radio4">
                          4
                        </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" name="grade" id="radio5" value="5">
                        <label for="radio5">
                          5
                        </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" name="grade" id="radio6" value="6">
                        <label for="radio6">
                          6
                        </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" name="grade" id="radio7" value="7">
                        <label for="radio7">
                          7
                        </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" name="grade" id="radio8" value="8">
                        <label for="radio8">
                          8
                        </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" name="grade" id="radio9" value="9">
                        <label for="radio9">
                          9
                        </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" name="grade" id="radio10" value="10">
                        <label for="radio10">
                          10
                        </label>
                    </div>
                  </div>
                </div>
                @endforeach
                  <div class="form-control">
                    <button class="btn btn-success" id="update">Grade Collaborators</button>
                  </div>
            </div>
        {{ Form::close() }}
      </div>
    </div>
</div>
@endsection