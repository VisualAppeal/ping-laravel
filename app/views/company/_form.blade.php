{{
	$new
		? Form::model($company, array('route' => 'company.store', 'method' => 'post', 'class' => 'form-horizontal'))
		: Form::model($company, array('route' => array('company.update', $company->id), 'method' => 'post', 'class' => 'form-horizontal'))
}}

	<div class="form-group<?php if ($errors->has('name')): ?> has-error<?php endif; ?>">
		{{ Form::label('name', trans('company.form.name'), array('class' => 'control-label col-sm-2')) }}

		<div class="col-sm-10 col-md-6">
			{{ Form::text('name', null, array('class' => 'form-control')) }}

			@if ($errors->has('name'))
				<span class="help-block">{{ $errors->first('name') }}</span>
			@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			{{ Form::button($new ? trans('company.create.submit') : trans('company.edit.submit'), array('class' => 'btn btn-primary', 'type' => 'submit')) }}
		</div>
	</div>

{{ Form::close() }}