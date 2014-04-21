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
				return Redirect::route('check.index');
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

	public function loginGithub()
	{
		$code = Input::get('code');
		$email = Input::get('email');
		$github = OAuth::consumer('GitHub');

		if (!empty($email)) {
			$user = User::where('email', '=', $email)->first();

			if (isset($user)) {
				Session::flash('warning', trans('user.register.social.already-exists'));
				return Redirect::route('user.register');
			}

			$user = Sentry::createUser(array(
				'email' => $email,
				'password' => md5(time() . uniqid()),
				'activated' => true,
			));

			UserGitHub::create(array(
				'user_id' => $user->id,
				'access_token' => Input::get('access_token'),
				'refresh_token' => !empty(Input::get('refresh_token')) ? Input::get('refresh_token') : null,
				'end_of_life' => !empty(Input::get('end_of_life')) ? Input::get('end_of_life') : null,
			));

			$user = Sentry::findUserByLogin($user->email);
			Sentry::login($user, false);

			Session::flash('success', trans('user.register.social.success'));
			return Redirect::route('home');
		} elseif (empty($code)) {
			$url = $github->getAuthorizationUri(array(
				'state' => md5(time() . uniqid()),
				'redirect_uri' => URL::route('user.login.github'),
			));

			return Response::make()->header('Location', (string) $url);
		} else {
			$token = $github->requestAccessToken($code);
			$emails = json_decode($github->request('/user/emails'), true);

			if (!is_array($emails) || count($emails) === 0) {
				Session::flash('error', trans('user.register.social.no-emails'));
				return Redirect::route('user.register');
			}

			if (count($emails) <= 1) {
				$user = User::where('email', '=', $emails[0])->first();

				if (isset($user)) {
					Session::flash('warning', trans('user.register.social.already-exists'));
					return Redirect::route('user.register');
				}

				$user = Sentry::createUser(array(
					'email' => $emails[0],
					'password' => md5(time() . uniqid()),
					'activated' => true,
				));

				UserGitHub::create(array(
					'user_id' => $user->id,
					'access_token' => $token->getAccessToken(),
					'refresh_token' => !empty($token->getRefreshToken()) ? $token->getRefreshToken() : null,
					'end_of_life' => !empty($token->getEndOfLife()) ? $token->getEndOfLife() : null,
				));

				Sentry::login($user, false);

				Session::flash('success', trans('user.register.social.success'));
				return Redirect::route('home');
			}

			return View::make('user.social', array(
				'emails' => $emails,
				'token' => $token,
			));
		}
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