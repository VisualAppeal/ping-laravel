@extends('layouts.master')

@section('title')
	{{ trans('user.register.title') }}
@stop

@section('content')
	<h2>{{ trans('user.register.headline') }}</h2>

	<div class="row">
		<div class="col-md-6">
			{{ Form::model(null, array('route' => 'user.do-register')) }}
				{{ Form::token() }}

				<div class="form-group<?php if ($errors->has('email')): ?> has-error<?php endif; ?>">
					{{ Form::label('email', trans('user.register.form.email')) }}

					{{ Form::text('email', null, array('class' => 'form-control')) }}
					@if ($errors->has('email'))
						<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>

				<div class="form-group<?php if ($errors->has('password')): ?> has-error<?php endif; ?>">
					{{ Form::label('password', trans('user.register.form.password')) }}

					{{ Form::password('password', array('class' => 'form-control')) }}
					@if ($errors->has('password'))
						<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>

				<div class="form-group<?php if ($errors->has('password_repeat')): ?> has-error<?php endif; ?>">
					{{ Form::label('password_repeat', trans('user.register.form.password_repeat')) }}

					{{ Form::password('password_repeat', array('class' => 'form-control')) }}
					@if ($errors->has('password_repeat'))
						<span class="help-block">{{ $errors->first('password_repeat') }}</span>
					@endif
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">{{ trans('user.register.form.submit') }}</button>
				</div>
			{{ Form::close() }}
		</div>

		<div class="col-md-6">
			<ul class="list-unstyled">
				<li>
					<a href="{{ URL::route('user.login.github') }}" class="btn btn-default">{{ trans('user.register.social.github.login') }}</a>
				</li>
			</ul>
		</div>
	</div>
@stop