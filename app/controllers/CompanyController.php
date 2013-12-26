<?php

class CompanyController extends BaseController
{
	protected $rules = array(
		'name' => 'required',
	);

	public function index()
	{
		$companies = Company::forUser(Sentry::getUser()->id)->get();

		return View::make('company.index', array(
			'companies' => $companies,
		));
	}

	public function show($id)
	{
		$company = Company::findOrFail($id);

		return View::make('company.show', array(
			'company' => $company,
		));
	}

	public function create()
	{
		return View::make('company.create');
	}

	public function store()
	{
		$input = Input::all();

		$validator = Validator::make($input, $this->rules);
		if ($validator->passes()) {
			$company = Company::create(array(
				'user_id' => Sentry::getUser()->id,
				'name' => $input['name'],
			));

			UserCompany::create(array(
				'company_id' => $company->id,
				'user_id' => $company->user_id,
			));

			Session::flash('success', trans('company.create.success', array('name' => $company->name)));
			return Redirect::route('company.show', array('id' => $company->id));
		}

		return Redirect::back()->withErrors($validator)->withInput($input);
	}

	public function edit($id)
	{
		$company = Company::findOrFail($id);

		return View::make('company.edit', array(
			'company' => $company,
		));
	}

	public function update($id)
	{
		$company = Company::findOrFail($id);
		$input = Input::all();

		$validator = Validator::make($input, $this->rules);
		if ($validator->passes()) {
			$company->name = $input['name'];
			$company->save();

			Session::flash('success', trans('company.edit.success', array('name' => $company->name)));
			return Redirect::route('company.show', array('id' => $company->id));
		}

		return Redirect::back()->withErrors($validator)->withInput($input);
	}

	public function delete($id)
	{
		$company = Company::findOrFail($id);
		$company->delete();

		Session::flash('info', trans('company.delete.success', array(
			'name' => $company->name,
			'restoreUrl' => URL::route('company.restore', array('id' => $company->id))
		)));
		return Redirect::route('company.index');
	}

	public function restore($id)
	{
		$company = Company::onlyTrashed()->find($id);
		$company->restore();

		return Redirect::route('company.show', array('id' => $company->id));
	}
}