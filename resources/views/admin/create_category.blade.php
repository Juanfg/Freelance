@extends('layouts.sidebar')

@section('title', 'Create Category')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Change the name of the category</div>
        </div>
        {!! Form::open(['method' => 'POST', 'route' => ['store_category']] ) !!}
            <div class="card-body">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                    <i class="fa fa-user" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" placeholder="Name" aria-describedby="basic-addon1">
                </div>
                 <button class="btn btn-success" id="update">Create Category</button>
            </div>
        {{ Form::close() }}
      </div>
    </div>
</div>
@endsection