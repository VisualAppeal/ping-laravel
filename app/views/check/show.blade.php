@extends('layouts.master')

@section('title')
	{{ trans('check.show.title', array('title' => $check->title)) }}
@stop

@section('content')
	<h2>{{ trans('check.show.headline', array('title' => $check->title)) }} <small><a href="{{ URL::route('check.edit', array('id' => $check->id)) }}" title="{{ trans('check.show.edit') }}"><i class="glyphicon glyphicon-pencil"></i></a></small></h2>

	<h3>{{ trans('check.show.uptime') }}</h3>
	<div class="chart" id="chart-check-uptime" data-url="{{ URL::route('api.check.uptime', array('id' => $check->id)) }}" data-seconds="{{ trans('check.seconds') }}">
	</div>

	<table class="table table-striped table-condensed">
		<thead>
			<tr>
				<th>{{ trans('check.show.success') }}</th>
				<th>{{ trans('check.show.begin') }}</th>
				<th>{{ trans('check.show.end') }}</th>
				<th>{{ trans('check.show.duration') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($log as $date)
				<tr>
					<td>
						@if ($date['success'] == 1)
							<i class="glyphicon glyphicon-ok"></i>
						@else
							<i class="glyphicon glyphicon-remove"></i>
						@endif
					</td>
					<td>{{{ $date['start']->format(Config::get('app.format.datetime')) }}}</td>
					<td>{{{ $date['end']->format(Config::get('app.format.datetime')) }}}</td>
					<td>{{{ $date['duration_locale'] }}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<h3>{{ trans('check.show.latency') }}</h3>
	<div class="chart" id="chart-check-latency" data-url="{{ URL::route('api.check.latency', array('id' => $check->id)) }}" data-seconds="{{ trans('check.seconds') }}">
	</div>

	<p>
		<a href="{{ URL::route('check.delete', array('id' => $check->id)) }}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> {{ trans('check.show.delete') }}</a>
	</p>
@stop