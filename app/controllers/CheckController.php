<?php

class CheckController extends BaseController
{
	protected $rules = array(
		'company_id' => 'required|exists:companies,id',
		'url' => 'required|url',
		'port' => 'required|integer|max:65536',
		'interval' => 'required|integer',
		'latency_satisfied' => 'required|integer|max:30',
		'latency_tolerating' => 'required|integer|max:30',
	);

	public function index()
	{
		$checks = Check::forUser(Sentry::getUser()->id)->with('theCompany')->get();
		$checks = $checks->filter(function($check) {
			if (isset($check->theUser->id) and isset($check->theCompany->id))
				return $check;
			else
				return null;
		});

		return View::make('check.index', array(
			'checks' => $checks,
		));
	}

	public function show($id)
	{
		$check = Check::findOrFail($id);

		return View::make('check.show', array(
			'check' => $check,
			'log' => $check->getLog(),
		));
	}

	public function create()
	{
		return View::make('check.create', array(
			'check' => new Check(array(
				'port' => 80,
				'interval' => 5,
				'notify_failed_checks' => true,
				'notify_back_online' => true,
				'latency_satisfied' => 4,
				'latency_tolerating' => 15,
			)),
			'companies' => Company::forUser(Sentry::getUser()->id)->lists('name', 'id'),
		));
	}

	public function store()
	{
		$input = Input::all();

		$validator = Validator::make($input, $this->rules);
		if ($validator->passes()) {
			$company = Company::forUser(Sentry::getUser()->id)->findOrFail($input['company_id']);

			$check = Check::create(array(
				'company_id' => $company->id,
				'user_id' => Sentry::getUser()->id,
				'url' => $input['url'],
				'port' => $input['port'],
				'username' => !empty($input['username']) ? $input['username'] : null,
				'password' => !empty($input['password']) ? $input['password'] : null,
				'check_for' => !empty($input['check_for']) ? $input['check_for'] : null,
				'interval' => $input['interval'],
				'notify_failed_checks' => isset($input['notify_failed_checks']) ? true : false,
				'notify_back_online' => isset($input['notify_back_online']) ? true : false,
				'latency_satisfied' => $input['latency_satisfied'],
				'latency_tolerating' => $input['latency_tolerating'],
			));

			Session::flash('success', trans('check.create.success', array('url' => $check->url)));
			return Redirect::route('check.show', array('id' => $check->id));
		}

		return Redirect::back()->withErrors($validator)->withInput($input);
	}

	public function edit($id)
	{
		$check = Check::findOrFail($id);

		return View::make('check.edit', array(
			'check' => $check,
			'companies' => Company::forUser(Sentry::getUser()->id)->lists('name', 'id'),
		));
	}

	public function update($id)
	{
		$check = Check::findOrFail($id);
		$input = Input::all();

		$validator = Validator::make($input, $this->rules);
		if ($validator->passes()) {
			$check->url = $input['url'];
			$check->port = $input['port'];
			$check->username = !empty($input['username']) ? $input['username'] : null;
			$check->password = !empty($input['password']) ? $input['password'] : null;
			$check->check_for = !empty($input['check_for']) ? $input['check_for'] : null;
			$check->interval = $input['interval'];
			$check->notify_failed_checks = isset($input['notify_failed_checks']) ? true : false;
			$check->notify_back_online = isset($input['notify_back_online']) ? true : false;
			$check->latency_satisfied = $input['latency_satisfied'];
			$check->latency_tolerating = $input['latency_tolerating'];
			$check->save();

			Session::flash('success', trans('check.edit.success', array('url' => $check->url)));
			return Redirect::route('check.show', array('id' => $check->id));
		}

		return Redirect::back()->withErrors($validator)->withInput($input);
	}

	public function delete($id)
	{
		$check = Check::findOrFail($id);
		$check->delete();

		Session::flash('info', trans('check.delete.success', array(
			'url' => $check->url,
			'restoreUrl' => URL::route('check.restore', array('id' => $check->id))
		)));
		return Redirect::route('check.index');
	}

	public function restore($id)
	{
		$check = Check::onlyTrashed()->find($id);
		$check->restore();

		return Redirect::route('check.show', array('id' => $check->id));
	}
}