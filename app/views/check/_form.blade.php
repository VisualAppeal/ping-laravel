{{
	$new
		? Form::model($check, array('route' => 'check.store', 'method' => 'post', 'class' => 'form-horizontal'))
		: Form::model($check, array('route' => array('check.update', $check->id), 'method' => 'post', 'class' => 'form-horizontal'))
}}

	<div class="form-group<?php if ($errors->has('company_id')): ?> has-error<?php endif; ?>">
		{{ Form::label('company_id', trans('check.form.company_id'), array('class' => 'control-label col-sm-2')) }}

		<div class="col-sm-10 col-md-6">
			{{ Form::select('company_id', $companies, null, array('class' => 'form-control')) }}

			@if ($errors->has('company_id'))
				<span class="help-block">{{ $errors->first('company_id') }}</span>
			@endif
		</div>
	</div>

	<div class="form-group<?php if ($errors->has('url')): ?> has-error<?php endif; ?>">
		{{ Form::label('url', trans('check.form.url'), array('class' => 'control-label col-sm-2')) }}

		<div class="col-sm-10 col-md-6">
			{{ Form::text('url', null, array('class' => 'form-control', 'placeholder' => trans('check.form.url-placeholder'))) }}

			@if ($errors->has('url'))
				<span class="help-block">{{ $errors->first('url') }}</span>
			@endif
		</div>
	</div>

	<div class="form-group<?php if ($errors->has('port')): ?> has-error<?php endif; ?>">
		{{ Form::label('port', trans('check.form.port'), array('class' => 'control-label col-sm-2')) }}

		<div class="col-sm-10 col-md-6">
			{{ Form::text('port', null, array('class' => 'form-control')) }}

			@if ($errors->has('port'))
				<span class="help-block">{{ $errors->first('port') }}</span>
			@endif
		</div>
	</div>

	<div class="form-group<?php if ($errors->has('username')): ?> has-error<?php endif; ?>">
		{{ Form::label('username', trans('check.form.username'), array('class' => 'control-label col-sm-2')) }}

		<div class="col-sm-10 col-md-6">
			{{ Form::text('username', null, array('class' => 'form-control')) }}

			@if ($errors->has('username'))
				<span class="help-block">{{ $errors->first('username') }}</span>
			@endif
		</div>
	</div>

	<div class="form-group<?php if ($errors->has('password')): ?> has-error<?php endif; ?>">
		{{ Form::label('password', trans('check.form.password'), array('class' => 'control-label col-sm-2')) }}

		<div class="col-sm-10 col-md-6">
			{{ Form::text('password', null, array('class' => 'form-control')) }}

			@if ($errors->has('password'))
				<span class="help-block">{{ $errors->first('password') }}</span>
			@endif
		</div>
	</div>

	<div class="form-group<?php if ($errors->has('check_for')): ?> has-error<?php endif; ?>">
		{{ Form::label('check_for', trans('check.form.check_for'), array('class' => 'control-label col-sm-2')) }}

		<div class="col-sm-10 col-md-6">
			{{ Form::text('check_for', null, array('class' => 'form-control')) }}

			@if ($errors->has('check_for'))
				<span class="help-block">{{ $errors->first('check_for') }}</span>
			@endif
		</div>
	</div>

	<div class="form-group<?php if ($errors->has('interval')): ?> has-error<?php endif; ?>">
		{{ Form::label('interval', trans('check.form.interval'), array('class' => 'control-label col-sm-2')) }}

		<div class="col-sm-10 col-md-6">
			{{ Form::text('interval', null, array('class' => 'form-control')) }}

			@if ($errors->has('interval'))
				<span class="help-block">{{ $errors->first('interval') }}</span>
			@endif
		</div>
	</div>

	<div class="form-group<?php if ($errors->has('notify_failed_checks')): ?> has-error<?php endif; ?>">
		{{ Form::label('notify_failed_checks', trans('check.form.notify_failed_checks'), array('class' => 'control-label col-sm-2')) }}

		<div class="col-sm-10 col-md-6">
			{{ Form::checkbox('notify_failed_checks') }}

			@if ($errors->has('notify_failed_checks'))
				<span class="help-block">{{ $errors->first('notify_failed_checks') }}</span>
			@endif
		</div>
	</div>

	<div class="form-group<?php if ($errors->has('notify_back_online')): ?> has-error<?php endif; ?>">
		{{ Form::label('notify_back_online', trans('check.form.notify_back_online'), array('class' => 'control-label col-sm-2')) }}

		<div class="col-sm-10 col-md-6">
			{{ Form::checkbox('notify_back_online') }}

			@if ($errors->has('notify_back_online'))
				<span class="help-block">{{ $errors->first('notify_back_online') }}</span>
			@endif
		</div>
	</div>

	<div class="form-group<?php if ($errors->has('rum_satisfied')): ?> has-error<?php endif; ?>">
		{{ Form::label('rum_satisfied', trans('check.form.rum_satisfied'), array('class' => 'control-label col-sm-2')) }}

		<div class="col-sm-10 col-md-6">
			{{ Form::text('rum_satisfied', null, array('class' => 'form-control')) }}

			@if ($errors->has('rum_satisfied'))
				<span class="help-block">{{ $errors->first('rum_satisfied') }}</span>
			@endif
		</div>
	</div>

	<div class="form-group<?php if ($errors->has('rum_tolerating')): ?> has-error<?php endif; ?>">
		{{ Form::label('rum_tolerating', trans('check.form.rum_tolerating'), array('class' => 'control-label col-sm-2')) }}

		<div class="col-sm-10 col-md-6">
			{{ Form::text('rum_tolerating', null, array('class' => 'form-control')) }}

			@if ($errors->has('rum_tolerating'))
				<span class="help-block">{{ $errors->first('rum_tolerating') }}</span>
			@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			{{ Form::button($new ? trans('check.create.submit') : trans('check.edit.submit'), array('class' => 'btn btn-primary', 'type' => 'submit')) }}
		</div>
	</div>

{{ Form::close() }}