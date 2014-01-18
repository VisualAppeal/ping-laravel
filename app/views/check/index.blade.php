@extends('layouts.master')

@section('title')
	{{ trans('check.index.title') }}
@stop

@section('content')
	<h2>{{ trans('check.index.headline') }} <small><a href="{{ URL::route('check.create') }}" title="{{ trans('check.index.create') }}"><i class="glyphicon glyphicon-plus"></i></a></small></h2>

	@if (count($checks))
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th></th>
						<th>{{ trans('check.index.url') }}</th>
						<th>{{ trans('check.index.user') }}</th>
						<th>{{ trans('check.index.company') }}</th>
						<th>{{ trans('check.index.interval') }}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($checks as $check)
						<?php $status = $check->statusOk; ?>
						<tr class="<?php if ($status === false): ?>danger<?php endif; ?>">
							<td>
								@if ($status === null)
								@elseif ($status)
									<i class="glyphicon glyphicon-ok"></i>
								@else
									<i class="glyphicon glyphicon-remove"></i>
								@endif
							</td>
							<td>{{{ $check->url }}}</td>
							<td>{{{ $check->theUser->email }}}</td>
							<td>{{{ $check->theCompany->name }}}</td>
							<td>{{{ $check->intervalFormatted }}}</td>
							<td class="clearfix">
								<div class="pull-right">
									<div class="btn-group">
											<a class="btn btn-default" href="{{ URL::route('check.show', array('id' => $check->id)) }}">{{ trans('check.index.show') }}</a>
											<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">{{ trans('check.index.toggle') }}</span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="{{ URL::route('check.edit', array('id' => $check->id)) }}"><span class="glyphicon glyphicon-pencil"></span> {{ trans('check.index.edit') }}</a></li>
											@if ($check->isPaused())
												<li><a href="{{ URL::route('check.unpause', array('id' => $check->id)) }}"><span class="glyphicon glyphicon-play"></span> {{ trans('check.index.unpause') }}</a></li>
											@else
												<li><a href="{{ URL::route('check.pause', array('id' => $check->id)) }}"><span class="glyphicon glyphicon-stop"></span> {{ trans('check.index.pause') }}</a></li>
											@endif
											<li><a href="{{ URL::route('check.delete', array('id' => $check->id)) }}"><span class="glyphicon glyphicon-trash"></span> {{ trans('check.index.delete') }}</a></li>
										</ul>
									</div>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@else
		<div class="alert alert-info">{{ trans('check.index.empty', array('createUrl' => URL::route('check.create'))) }}</div>
	@endif
@stop