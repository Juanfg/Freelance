<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name', 'Kardex') }}</title>

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
								<i class="fa fa-user" aria-hidden="true"></i>
							</div>
							<div class="title">User</div>
						</a>
						<div class="dropdown-menu">
							<ul>
								<li class="section"><i class="fa fa-user" aria-hidden="true"></i>{{ Auth::user()->name }}</li>
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
		</aside>
		<div class="app-container">
			<div class="col-xs-12">
				@yield('content')
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