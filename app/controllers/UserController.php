<?php

class UserController extends BaseController
{
	protected $accountRules = array(
		'email' => 'required|email',
	);

	protected $registerRules = array(
		'email' => 'required|email|unique:users',
		'password' => 'required|min:6',
		'password_repeat' => 'same:password',
	);

	public function login()
	{
		return View::make('user.login');
	}

	public function doLogin()
	{
		try {
			$user = Sentry::findUserByCredentials(array(
				'email' => isset($_POST['email']) ? $_POST['email'] : '',
				'password' => isset($_POST['password']) ? $_POST['password'] : '',
			));

			$remember = isset($_POST['remember']) ? true : false;

			Sentry::login($user, $remember);

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

	public function register()
	{
		return View::make('user.register');
	}

	public function doRegister()
	{
		$input = Input::all();

		$validator = Validator::make($input, $this->registerRules);
		if ($validator->passes()) {
			try {
				$user = Sentry::register(array(
					'email'    => $input['email'],
					'password' => $input['password'],
				));

				Mail::queue('email.activate', array(
						'activationUrl' => URL::route('user.activate', array(
							'code' => $user->getActivationCode()
						)),
					),
					function($message) use($user) {
						$message->to($user->email)
							->subject(trans('user.activate.email.subject'));
					}
				);

				Session::flash('success', trans('user.register.activation'));
				return Redirect::route('home');
			} catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
				Session::flash('error', trans('user.register.email-required'));
			} catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
				Session::flash('error', trans('user.register.password-required'));
			} catch (Cartalyst\Sentry\Users\UserExistsException $e) {
				Session::flash('error', trans('user.register.email-unique'));
				return Redirect::route('user.login');
			}

			return Redirect::back()->withInput();
		}

		return Redirect::back()->withErrors($validator)->withInput($input);
	}

	public function activate($code)
	{
		try {
			$user = Sentry::findUserByActivationCode($code);

			try {
				if ($user->attemptActivation($code))
					Session::flash('success', trans('user.activate.success'));
				else
					Session::flash('error', trans('user.activate.error'));
			} catch (Cartalyst\Sentry\Users\UserAlreadyActivatedException $e) {
				Session::flash('warning', trans('user.activate.already-activated'));
			}
		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			Session::flash('error', trans('user.activate.not-found'));
			return Redirect::route('user.register');
		}

		return Redirect::route('home');
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

		$validator = Validator::make($input, $this->accountRules);
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