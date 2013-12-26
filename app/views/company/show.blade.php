@extends('layouts.master')

@section('title')
	{{ trans('company.show.title', array('name' => $company->name)) }}
@stop

@section('content')
	<h2>{{ trans('company.show.headline', array('name' => $company->name)) }} <small><a href="{{ URL::route('company.edit', array('id' => $company->id)) }}" title="{{ trans('company.show.edit') }}"><i class="glyphicon glyphicon-pencil"></i></a></small></h2>

	<ul>
		@foreach ($company->users as $user)
			<li>{{{ $user->email }}}</li>
		@endforeach
	</ul>

	<p>
		<a href="{{ URL::route('company.delete', array('id' => $company->id)) }}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> {{ trans('company.show.delete') }}</a>
	</p>
@stop