@extends('layouts.email')

@section('title')
	{{ trans('check.job.email.online.title') }}
@stop

@section('content')
	<h1>{{ trans('check.job.email.online.headline') }}</h1>

	<p>{{ trans('check.job.email.online.content', array('url' => URL::route('check.show', array('id' => $check->id)), 'title' => $check->title)) }}</p>
@stop