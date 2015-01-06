@extends('layouts.email')

@section('title')
	{{ trans('check.job.email.offline.title') }}
@stop

@section('content')
	<h1>{{ trans('check.job.email.offline.headline') }}</h1>

	<p>{{ trans('check.job.email.offline.content', array('url' => URL::route('check.show', array('id' => $id)), 'title' => $title, 'code' => $statusCode)) }}</p>
@stop
