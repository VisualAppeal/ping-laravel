<?php

class UserController extends BaseController
{
	protected $rules = array(
		'email' => 'required|email',
	);

	public function login()
	{
		return View::make('user.login');
	}

	public function doLogin()
	{
		try {
			$user = Sentry::findUserByCredentials(array(
				'email' => $_POST['email'],
				'password' => $_POST['password'],
			));

			Sentry::login($user);

			if (Session::get('redirectUri', false) !== false)
				return Redirect::to(Session::get('redirectUri'));
			else
				return Redirect::route('home');
		} catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
			Session::flash('error', trans('user.login.no-email'));
		} catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
			Session::flash('error', trans('user.login.not-activated'));
		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			Session::flash('error', trans('user.login.unknown'));
		} catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
			Session::flash('error', trans('user.login.suspended', $throttle->getSuspensionTime()));
		} catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
			Session::flash('error', trans('user.login.banned'));
		}

		return Redirect::back()->withInput();
	}

	public function account()
	{
		return View::make('user.account', array(
			'user' => Sentry::getUser(),
		));
	}

	public function save()
	{
		$input = Input::all();

		$validator = Validator::make($input, $this->rules);
		if ($validator->passes()) {
			$user = Sentry::getUser();
			if (!$user->checkPassword($input['old-password'])) {
				Session::flash('error', trans('user.save.wrong-password'));
				return Redirect::route('user.account');
			}

			try {
				$user->email = $input['email'];
				$user->first_name = $input['first_name'];
				$user->last_name = $input['last_name'];
				$user->save();

				Session::flash('success', trans('user.save.success'));
			}
			catch (Cartalyst\Sentry\Users\UserExistsException $e) {
				Session::flash('error', trans('user.save.already-exists'));
			}

			return Redirect::route('user.account');
		}

		return Redirect::back()->withErrors($validator)->withInput($input);
	}

	public function logout()
	{
		Sentry::logout();
		return Redirect::route('home');
	}
}