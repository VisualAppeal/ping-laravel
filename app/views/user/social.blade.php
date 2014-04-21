@extends('layouts.master')

@section('title')
	{{ trans('user.social.title') }}
@stop

@section('content')
	<h2>{{ trans('user.social.headline') }}</h2>

	<p>
		{{ trans('user.social.description') }}
	</p>

	{{ Form::open() }}
		{{ Form::hidden('access_token', $token->getAccessToken()) }}
		{{ Form::hidden('refresh_token', $token->getRefreshToken()) }}
		{{ Form::hidden('end_of_life_token', $token->getEndOfLife()) }}

		<div class="form-group">
			<?php $i = 0; ?>
			@foreach ($emails as $email)
				<div class="radio">
					<label>
						<input type="radio" name="email" id="email-{{ $i }}" value="{{{ $email }}}"<?php if ($i == 0): ?> checked="checked"<?php endif; ?>> {{{ $email }}}
					</label>
				</div>
				<?php $i++; ?>
			@endforeach
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary" name="register">{{ trans('user.social.submit') }}</button>
		</div>
	{{ Form::close() }}
@stop