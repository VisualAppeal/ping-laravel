@extends('layouts.email')

@section('title')
	{{ trans('user.activate.email.title') }}
@stop

@section('content')
	<h1>{{ trans('user.activate.email.headline') }}</h1>

	<p>{{ trans('user.activate.email.content', array('url' => $activationUrl)) }}</p>
@stop