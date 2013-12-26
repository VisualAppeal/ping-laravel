@extends('layouts.master')

@section('title')
	{{ trans('check.create.title') }}
@stop

@section('content')
	<h2>{{ trans('check.create.headline') }}</h2>

	@include('/check/_form', array('check' => $check, 'new' => true, 'companies' => $companies))
@stop