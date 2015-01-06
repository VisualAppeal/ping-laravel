[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d1c84f2e-5a58-465e-b49c-3d72f1f4c683/big.png)](https://insight.sensiolabs.com/account/widget?project=d1c84f2e-5a58-465e-b49c-3d72f1f4c683)

This application monitors the uptime by making cURL requests to a defined set of websites and display the data in charts.

The only languages currently available are english and german. You can edit the language files in `app/lang/[2_LETTER_COUNTRY_CODE]/*.php`. Just copy the english/german translation and edit the files. Pull requests are welcomed.

## Requirements

* npm (node.js package manger)

## Screenshots

![Screenshot 1](http://www.visualappeal.de/github/ping/screenshot_uptime.png)
![Screenshot 2](http://www.visualappeal.de/github/ping/screenshot_latency.png)
![Screenshot 3](http://www.visualappeal.de/github/ping/screenshot_edit_check.png)

## Configuration

In the future there might be an installer.

Set the environment variable `APPLICATION_ENV` to a value which is unequal `testing`, e.g. `development` or `production`. Create the folder `app/config/[APPLICATION_ENV]`. All config files in this directory will be merged with the config files in `app/config`. The most important files are `database.php` and `app.php` which should similar to this:

```php
<?php

// app/config/[APPLICATION_ENV]/database.php
return array(
	'connections' => array(
		'app' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'ping_database',
			'username'  => 'ping_database_user',
			'password'  => 'ping_database_user_password',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => 'ping_',
		),
	),
);
```

```php
<?php

// app/config/[APPLICATION_ENV]/app.php
return array(
	'format' => array(
		'datetime' => 'd/m/Y H:i', // see http://php.net/date
	),
	'url' => 'http://127.0.0.1/ping/public',
	'locale' => 'en',
	'timezone' => 'Europe/Berlin',
	'key' => '' // 32 random alphanumeric chars
);
```

For a normal installation you should create an `auth.php` which will create a admin after installation:

```php
<?php

// app/config/[APPLICATION_ENV]/auth.php
return array(
	'default' => array(
		'email' => 'email@example.com',
		'password' => '123456',
	),
);
```

## Installation

1. Clone the repository
2. Create your config
4. `php artisan migrate --package=cartalyst/sentry`
5. `php artisan migrate`
6. `grunt build`
4. visit http://url-to-repository/public

## ToDo

* Dashboard!
* Search in body for string when checking uptime
* Fix translation issues
* Unit Tests

## Contributors, Credits and libraries

* Framework: http://laravel.com/
* User management: https://cartalyst.com/manual/sentry
* Uptime check: https://github.com/rmccue/Requests/
* Favicon: http://www.iconarchive.com/show/ivista-2-icons-by-gakuseisean/Files-Upload-File-icon.html
