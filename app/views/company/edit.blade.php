@extends('layouts.master')

@section('title')
	{{ trans('company.edit.title', array('name' => $company->name)) }}
@stop

@section('content')
	<h2>{{ trans('company.edit.headline', array('name' => $company->name)) }}</h2>

	@include('/company/_form', array('company' => $company, 'new' => false))
@stop