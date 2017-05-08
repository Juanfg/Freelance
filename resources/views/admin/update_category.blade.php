@extends('layouts.sidebar')

@section('title', 'Edit Category')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Change the name of the category</div>
        </div>
        {!! Form::open(['method' => 'PUT', 'route' => ['update_category', $category->id ]] ) !!}
            <div class="card-body">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                    <i class="fa fa-user" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" placeholder="Input group" aria-describedby="basic-addon1" value="{{$category->name}}">
                </div>
                 <button class="btn btn-success" id="update">Update Category</button>
            </div>
        {{ Form::close() }}
      </div>
    </div>
</div>
@endsection