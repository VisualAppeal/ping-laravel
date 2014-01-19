@extends('layouts.master')

@section('title')
	{{ trans('user.login.title') }}
@stop

@section('content')
	<h2>{{ trans('user.login.headline') }}</h2>

	{{ Form::model(null, array('route' => 'user.do-login', 'class' => 'form-horizontal')) }}
		{{ Form::token() }}

		<div class="form-group<?php if ($errors->has('email')): ?> has-error<?php endif; ?>">
			{{ Form::label('email', trans('user.login.form.email'), array('class' => 'col-sm-2 control-label')) }}

			<div class="col-sm-10">
				{{ Form::text('email', null, array('class' => 'form-control')) }}
				@if ($errors->has('email'))
					<span class="help-block">{{ $errors->first('email') }}</span>
				@endif
			</div>
		</div>

		<div class="form-group<?php if ($errors->has('password')): ?> has-error<?php endif; ?>">
			{{ Form::label('password', trans('user.login.form.password'), array('class' => 'col-sm-2 control-label')) }}

			<div class="col-sm-10">
				{{ Form::password('password', array('class' => 'form-control')) }}
				@if ($errors->has('email'))
					<span class="help-block">{{ $errors->first('email') }}</span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<label>
					{{ Form::checkbox('remember') }} {{ trans('user.login.form.remember') }}
				</label>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">{{ trans('user.login.form.submit') }}</button>
			</div>
		</div>
	{{ Form::close() }}
@stop