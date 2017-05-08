@extends('layouts.sidebar')

@section('title', 'Manage Users')

@section('content')
<div class="row">
	<div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                Here you can manage your users.
            </div>
            <div class="scroll card-body no-padding">
                <table class="table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Activate / Deactivate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr> 
                                <td>{{ $user->id}}</td>
                                <td>{{ $user->name }}</td>                    
                                <td>{{ $user->email }}</td>
                                <td>
                                	@if($user->active)
                                		<a class="btn btn-primary btn-xs" href="{{route('deactivate_user', [$user->id])}}"><i class="fa fa-times"></i></a>
                                	@else
                                		<a class="btn btn-warning btn-xs" href="{{route('activate_user', [$user->id])}}"><i class="fa fa-pencil"></i></a>
                                	@endif	
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>

@endsection