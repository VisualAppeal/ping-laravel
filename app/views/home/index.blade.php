@extends('layouts.master')

@section('title')
	{{ trans('home.index.title') }}
@stop

@section('content')
	<div class="jumbotron">
		<h1>{{ trans('home.index.headline') }}</h1>
		<p>
			{{ trans('home.index.intro') }}
		</p>

		@if ($guest)
			<p>
				<a href="{{ URL::route('user.register') }}" class="btn btn-primary btn-lg">{{ trans('home.index.register') }}</a>
			</p>
		@else
			<p>
				<a href="{{ URL::route('check.index') }}" class="btn btn-primary btn-lg">{{ trans('home.index.checks') }}</a>
			</p>
		@endif
	</div>
@stop