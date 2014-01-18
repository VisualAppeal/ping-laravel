<?php

return array(
	'diff' => array(
		'days' => 'Day|Days',
		'hours' => 'Hour|Hours',
		'minutes' => 'Minute|Minutes',
	),

	'index' => array(
		'title' => 'Checks',
		'headline' => 'Checks',
		'empty' => 'You did not create any checks yet. Do you want to <a href=":createUrl" title="Create your first check">create a check now</a>?',
		'create' => 'Create check',
		'24h' => 'Last 24h',
		'url' => 'URL',
		'user' => 'User',
		'company' => 'Company',
		'interval' => 'Interval',
		'show' => 'Display',
		'edit' => 'Edit',
		'delete' => 'Delete',
		'pause' => 'Pause',
		'unpause' => 'Continue',
	),

	'show' => array(
		'title' => 'Check :title',
		'headline' => ':title',
		'uptime' => 'Uptime',
		'success' => 'Available',
		'begin' => 'Begin',
		'end' => 'End',
		'duration' => 'Duration',
		'latency' => 'Latency',
		'delete' => 'Delete check',
	),

	'create' => array(
		'title' => 'Create check',
		'headline' => 'New Check',
		'submit' => 'Create check',
		'success' => 'The check was created successfully.',
	),

	'form' => array(
		'company_id' => 'Company',
		'url' => 'URL',
		'url-placeholder' => 'http://www.google.com',
		'port' => 'Port',
		'username' => 'Username (HTTP-Auth)',
		'password' => 'Password (HTTP-Auth)',
		'check_for' => 'Search in body',
		'interval' => 'Interval (in minutes)',
		'notify_failed_checks' => 'Notification of failed checks',
		'notify_back_online' => 'Notification of a successfull check after a failed one',
		'latency_satisfied' => 'Latency - Satisfied (in seconds)',
		'latency_tolerating' => 'Latency - Tolerated (in seconds)',
	),

	'edit' => array(
		'title' => 'Edit check',
		'headline' => 'Edit :url',
		'submit' => 'Edit check',
		'success' => 'You successfully edited the check.',
	),

	'delete' => array(
		'success' => 'The check :url was successfully deleted! You can <a href=":restoreUrl" title="Restore the check">restore</a> it.'
	),

	'errors' => array(
		'resolve-host' => 'Host :host could not be resolved',
	),

	'job' => array(
		'email' => array(
			'online' => array(
				'subject' => '[ping] :title is back online!',
				'title' => ':title is online',
				'headline' => ':title is online',
				'content' => '<a href=":url">:title</a> is online again.',
			),

			'offline' => array(
				'subject' => '[ping] :title is offline!',
				'title' => ':title is offline',
				'headline' => ':title is offline',
				'content' => ':title is offline because of the error <a href=":url">:code</a>!',
			),
		),
	),

	'pause' => array(
		'success' => 'The check was successfully paused.',
	),

	'unpause' => array(
		'success' => 'The check is queued again.',
	),
);