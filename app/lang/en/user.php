<?php

return array(
	'login' => array(
		'title' => 'Login',
		'headline' => 'Login',

		'form' => array(
			'email' => 'Email address',
			'password' => 'Password',
			'submit' => 'Login',
		),
	),

	'account' => array(
		'title' => 'Your account',
		'headline' => 'Your account',

		'form' => array(
			'email' => 'E-mail address',
			'first_name' => 'First name',
			'last_name' => 'Last name',
			'old-password' => 'Current password',
			'submit' => 'Save account',
		),
	),

	'register' => array(
		'title' => 'Sign Up',
		'headline' => 'Sign up for a new account',

		'activation' => 'Your account was created successfully! Please check your mails and confirm your mail address.',
		'email-required' => 'You have to enter an email!',
		'password-required' => 'You have to enter a password!',
		'email-unique' => 'An user with your email already has an account! Do you want to <a href=":loginUrl">login</a>?',

		'form' => array(
			'email' => 'Email address',
			'password' => 'Password',
			'password_repeat' => 'Repeat password',
			'submit' => 'Sign Up',
		),
	),

	'activate' => array(
		'not-found' => 'Your activation code could not be found! Please sign up again.',
		'success' => 'Your account was created successfully.',
		'error' => 'For unknown reasons your account could not be created. Please contact us for further help.',
		'already-activated' => 'You already confirmed your account! You can login with your email and password.',

		'email' => array(
			'title' => 'Confirm email',
			'headline' => 'Confirm your email',
			'subject' => 'Confirm your Ping account',
			'content' => 'Your email address was used to create a Ping account! <a href=":url">Confirm</a> your email or or ignore this email if you did not sign up.',
		),
	),
);