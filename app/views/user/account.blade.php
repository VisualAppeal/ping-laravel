@extends('layouts.master')

@section('title')
	{{ trans('user.account.title') }}
@stop

@section('content')
	<h2>{{ trans('user.account.headline') }}</h2>

	{{ Form::model($user, array('route' => 'user.save', 'class' => 'form-horizontal')) }}
		{{ Form::token() }}

		<div class="form-group<?php if ($errors->has('email')): ?> has-error<?php endif; ?>">
			{{ Form::label('email', trans('user.account.form.email'), array('class' => 'col-sm-2 control-label')) }}

			<div class="col-sm-10">
				{{ Form::text('email', null, array('class' => 'form-control')) }}
				@if ($errors->has('email'))
					<span class="help-block">{{ $errors->first('email') }}</span>
				@endif
			</div>
		</div>

		<div class="form-group<?php if ($errors->has('first_name')): ?> has-error<?php endif; ?>">
			{{ Form::label('first_name', trans('user.account.form.first_name'), array('class' => 'col-sm-2 control-label')) }}

			<div class="col-sm-10">
				{{ Form::text('first_name', null, array('class' => 'form-control', 'autocomplete' => 'off')) }}
				@if ($errors->has('email'))
					<span class="help-block">{{ $errors->first('first_name') }}</span>
				@endif
			</div>
		</div>

		<div class="form-group<?php if ($errors->has('last_name')): ?> has-error<?php endif; ?>">
			{{ Form::label('last_name', trans('user.account.form.last_name'), array('class' => 'col-sm-2 control-label')) }}

			<div class="col-sm-10">
				{{ Form::text('last_name', null, array('class' => 'form-control', 'autocomplete' => 'off')) }}
				@if ($errors->has('email'))
					<span class="help-block">{{ $errors->first('last_name') }}</span>
				@endif
			</div>
		</div>

		<div class="form-group<?php if ($errors->has('old-password')): ?> has-error<?php endif; ?>">
			{{ Form::label('old-password', trans('user.account.form.old-password'), array('class' => 'col-sm-2 control-label')) }}

			<div class="col-sm-10">
				{{ Form::password('old-password', array('class' => 'form-control', 'autocomplete' => 'off')) }}
				@if ($errors->has('old-password'))
					<span class="help-block">{{ $errors->first('old-password') }}</span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">{{ trans('user.account.form.submit') }}</button>
			</div>
		</div>
	{{ Form::close() }}
@stop