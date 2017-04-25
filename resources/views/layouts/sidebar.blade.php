<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name', 'Kardex') }}</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/flat-admin.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

	<!-- Theme -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/blue-sky.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/blue.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/red.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/yellow.css') }}">

</head>
<body>
	<div class="app app-default">
		<aside class="app-sidebar" id="sidebar">
			<div class="sidebar-menu">
				<ul class="sidebar-nav">
					<li>
						<a href="{{ route('home') }}">
							<div class="icon">
								<i class="fa fa-home" aria-hidden="true"></i>
							</div>
							<div class="title">Home</div>
						</a>
					</li>
					<li>
						<a href="#">
							<div class="icon">
								<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
							</div>
							<div class="title">#</div>
						</a>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown">
							<div class="icon">
								<i class="fa fa-tasks" aria-hidden="true"></i>
							</div>
							<div class="title">#</div>
						</a>
						<div class="dropdown-menu">
							<ul>
								<li class="section"><i class="fa fa-graduation-cap" aria-hidden="true"></i>#</li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</aside>
		<div class="app-container">
			<div class="col-xs-12">
				@yield('content')
			</div>
		</div>
	</div>
  
	<script type="text/javascript" src="{{ asset('js/vendor.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/app-sidebar.js') }}"></script>

</body>
</html>