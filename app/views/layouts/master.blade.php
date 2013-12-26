<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>@yield('title') | Ping</title>

		<link rel="stylesheet" type="text/css" href="{{ asset('js/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/main.min.css') }}">

		@yield('head')
	</head>

	<body>
		@yield('sidebar')

		<header>
			<nav class="navbar navbar-default navbar-inverse" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{ URL::route('home') }}"> Ping</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					@if (!$guest)
						<ul class="nav navbar-nav">
							<li><a href="{{ URL::route('company.index') }}">{{ trans('base.nav.companies') }}</a></li>
							<li><a href="{{ URL::route('check.index') }}">{{ trans('base.nav.checks') }}</a></li>
						</ul>
					@endif

					<ul class="nav navbar-nav navbar-right">
						@if ($guest)
							<li><a href="{{ URL::route('user.login') }}"><i class="glyphicon glyphicon-user"></i> {{ trans('base.nav.login') }}</a></li>
						@else
							<li><a href="{{ URL::route('user.account') }}"><i class="glyphicon glyphicon-user"></i> {{ trans('base.nav.account') }}</a></li>
							<li><a href="{{ URL::route('user.logout') }}"><i class="glyphicon glyphicon-off"></i> {{ trans('base.nav.logout') }}</a></li>
						@endif
					</ul>
				</div>
			</nav>
		</header>

		<section role="main" class="container">
			<div id="flash-messages">
				@if (isset($session['warning']))
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{{ $session['warning'] }}
					</div>
				@endif

				@if (isset($session['error']))
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{{ $session['error'] }}
					</div>
				@endif

				@if (isset($session['info']))
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{{ $session['info'] }}
					</div>
				@endif

				@if (isset($session['success']))
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{{ $session['success'] }}
					</div>
				@endif
			</div>

			<div id="content">
				@yield('content')
			</div>

			<footer>
				<p>&copy; 2013, <a href="http://github.com/t-visualappeal/">Tim Helfensdörfer</a></p>
			</footer>
		</div>

		<script type="text/javascript" src="{{ asset('js/vendor/jquery/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="//code.highcharts.com/stock/highstock.js"></script>
		@yield('scripts')
		<script type="text/javascript" src="{{ asset('js/main.min.js') }}"></script>
	</body>
</html>