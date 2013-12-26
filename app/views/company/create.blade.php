@extends('layouts.master')

@section('title')
	{{ trans('company.create.title') }}
@stop

@section('content')
	<h2>{{ trans('company.create.headline') }}</h2>

	@include('/company/_form', array('company' => null, 'new' => true))
@stop