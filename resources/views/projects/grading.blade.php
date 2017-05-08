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
            <div class="card-body">
                <label class="col-md-3 control-label">User name</label>
                <div class="col-md-9">
                  <div class="radio radio-inline">
                      <input type="radio" name="grade" id="radio10" value="grade">
                      <label for="radio10">
                        1
                      </label>
                  </div>
                  <div class="radio radio-inline">
                      <input type="radio" name="grade" id="radio11" value="grade">
                      <label for="radio11">
                        2
                      </label>
                  </div>
                  <div class="radio radio-inline">
                      <input type="radio" name="grade" id="radio11" value="grade">
                      <label for="radio11">
                        3
                      </label>
                  </div>
                  <div class="radio radio-inline">
                      <input type="radio" name="grade" id="radio11" value="grade">
                      <label for="radio11">
                        4
                      </label>
                  </div>
                  <div class="radio radio-inline">
                      <input type="radio" name="grade" id="radio11" value="grade">
                      <label for="radio11">
                        5
                      </label>
                  </div>
                </div>
                 <button class="btn btn-success" id="update">Grade Collaborators</button>
            </div>
        {{ Form::close() }}
      </div>
    </div>
</div>
@endsection