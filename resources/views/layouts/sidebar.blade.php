<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name', 'Freelance') }}</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

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
			<div class="sidebar-header">
				<a class="sidebar-brand" href="{{ route('home') }}"><span class="highlight">Free</span> Lancers</a>
			</div>
			<div class="sidebar-menu">
				<ul class="sidebar-nav">
					<li class="{{ !Request::is('/') ? : 'active' }}">
						<a href="{{ route('home') }}">
							<div class="icon">
								<i class="fa fa-home" aria-hidden="true"></i>
							</div>
							<div class="title">Home</div>
						</a>
					</li>
					<li class="dropdown {{ Request::is('projects') || Request::is('projects/*') ? 'active' : '' }}">
						<a href="{{ route('projects.index') }}">
							<div class="icon">
								<i class="fa fa-book" aria-hidden="true"></i>
							</div>
							<div class="title">Projects</div>
						</a>
						<div class="dropdown-menu">
							<ul>
								<li class="section"><i class="fa fa-book" aria-hidden="true"></i>Projects</li>
								<li><a href="{{ route('projects.index') }}">My Projects</a></li>
								<li><a href="{{ route('projects.create') }}">New Project</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</aside>
		<div class="app-container">
			<nav class="navbar navbar-default" id="navbar">
				<div class="container-fluid">
					<div class="navbar-collapse collapse in">
						<ul class="nav navbar-nav navbar-left">
							<li class="navbar-title">@yield('title')</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown profile">
								<a href="#" class="dropdown-toggle"  data-toggle="dropdown">
									<img class="profile-img" src="{{ Storage::url(Auth::user()->profile_picture) }}">
									<div class="title">Profile</div>
								</a>
								<div class="dropdown-menu">
									<div class="profile-info">
										<h4 class="username">{{ Auth::user()->name }}</h4>
									</div>
									<ul class="action">
										<li>
											<a href="#">
												Profile
											</a>
										</li>
										<li>
											<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
												Logout
											</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>
										</li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</div>

				
			</nav>
			<div class="row">
				<div class="col-xs-12">
					@yield('content')
				</div>
			</div>
		</div>
	</div>
  
	<script type="text/javascript" src="{{ asset('js/vendor.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/app-sidebar.js') }}"></script>
	<script src="{{ asset('js/jquery-1.11.1.js') }}"></script>
	<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script type"text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')
</body>
</html>