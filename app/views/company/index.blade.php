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
									@foreach ($company->users as $companyUser)
										<li>
											{{{ $companyUser->email }}}
											@if ($company->user_id != $companyUser->id)
												<a href="{{ URL::route('company.user.remove', array('id' => $company->id, 'user' => $companyUser->id)) }}"><i class="glyphicon glyphicon-trash"></i></a>
											@endif
										</li>
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
										<li><a data-toggle="modal" href="#invite-user-to-{{ $company->id }}">{{ trans('company.index.add-user') }}</a></li>
									</ul>
								</div>
							</td>
						</tr>

						<div class="modal fade" id="invite-user-to-{{ $company->id }}">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">{{ trans('company.user.add.title') }}</h4>
									</div>

									<form method="post" action="{{ URL::route('company.user.add', array('id' => $company->id)) }}" class="form-horizontal">
										<div class="modal-body">
											<p>{{ trans('company.user.add.description') }}</p>

											<div class="form-group">
												<label class="control-label col-sm-3">{{ trans('company.user.add.user') }}</label>

												<div class="col-sm-9">
													<input type="text" class="form-control" name="invite_user_email">
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('company.user.add.close') }}</button>
											<button type="submit" class="btn btn-primary">{{ trans('company.user.add.invite') }}</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					@endforeach
				</tbody>
			</table>
		</div>
	@else
		<div class="alert alert-info">{{ trans('company.index.empty', array('createUrl' => URL::route('company.create'))) }}</div>
	@endif
@stop