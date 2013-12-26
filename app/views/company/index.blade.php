@extends('layouts.master')

@section('title')
	{{ trans('company.index.title') }}
@stop

@section('content')
	<h2>{{ trans('company.index.headline') }} <small><a href="{{ URL::route('company.create') }}" title="{{ trans('company.index.create') }}"><i class="glyphicon glyphicon-plus"></i></a></small></h2>

	@if (count($companies))
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>{{ trans('company.index.name') }}</th>
						<th>{{ trans('company.index.users') }}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($companies as $company)
						<tr>
							<td>{{{ $company->name }}}</td>
							<td>
								<ul>
									@foreach ($company->users as $user)
										<li>{{{ $user->email }}}</li>
									@endforeach
								</ul>
							</td>
							<td>
								<div class="btn-group">
										<a class="btn btn-default" href="{{ URL::route('company.show', array('id' => $company->id)) }}">{{ trans('company.index.show') }}</a>
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">{{ trans('company.index.toggle') }}</span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ URL::route('company.edit', array('id' => $company->id)) }}">{{ trans('company.index.edit') }}</a></li>
										<li><a href="{{ URL::route('company.delete', array('id' => $company->id)) }}">{{ trans('company.index.delete') }}</a></li>
										<li class="divider"></li>
										<li><a href="#">{{ trans('company.index.add-user') }}</a></li>
									</ul>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@else
		<div class="alert alert-info">{{ trans('company.index.empty', array('createUrl' => URL::route('company.create'))) }}</div>
	@endif
@stop