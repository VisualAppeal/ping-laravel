@extends('layouts.master')

@section('title')
	{{ trans('check.edit.title', array('url' => $check->url)) }}
@stop

@section('content')
	<h2>{{ trans('check.edit.headline', array('url' => $check->url)) }}</h2>

	@include('/check/_form', array('check' => $check, 'new' => false, 'companies' => $companies))
@stop