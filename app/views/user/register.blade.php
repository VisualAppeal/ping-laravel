@extends('layouts.master')

@section('title')
	{{ trans('user.register.title') }}
@stop

@section('content')
	<h2>{{ trans('user.register.headline') }}</h2>

	{{ Form::model(null, array('route' => 'user.do-register', 'class' => 'form-horizontal')) }}
		{{ Form::token() }}

		<div class="form-group<?php if ($errors->has('email')): ?> has-error<?php endif; ?>">
			{{ Form::label('email', trans('user.register.form.email'), array('class' => 'col-sm-2 control-label')) }}

			<div class="col-sm-10">
				{{ Form::text('email', null, array('class' => 'form-control')) }}
				@if ($errors->has('email'))
					<span class="help-block">{{ $errors->first('email') }}</span>
				@endif
			</div>
		</div>

		<div class="form-group<?php if ($errors->has('password')): ?> has-error<?php endif; ?>">
			{{ Form::label('password', trans('user.register.form.password'), array('class' => 'col-sm-2 control-label')) }}

			<div class="col-sm-10">
				{{ Form::password('password', array('class' => 'form-control')) }}
				@if ($errors->has('password'))
					<span class="help-block">{{ $errors->first('password') }}</span>
				@endif
			</div>
		</div>

		<div class="form-group<?php if ($errors->has('password_repeat')): ?> has-error<?php endif; ?>">
			{{ Form::label('password_repeat', trans('user.register.form.password_repeat'), array('class' => 'col-sm-2 control-label')) }}

			<div class="col-sm-10">
				{{ Form::password('password_repeat', array('class' => 'form-control')) }}
				@if ($errors->has('password_repeat'))
					<span class="help-block">{{ $errors->first('password_repeat') }}</span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">{{ trans('user.register.form.submit') }}</button>
			</div>
		</div>
	{{ Form::close() }}
@stop