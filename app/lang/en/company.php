<?php

return array(
	'index' => array(
		'title' => 'Company',
		'headline' => 'Company',
		'create' => 'Create new company',
		'name' => 'Name',
		'users' => 'User',
		'show' => 'Display',
		'edit' => 'Edit',
		'delete' => 'Delete',
		'add-user' => 'Create user',
		'empty' => 'You did not create a company yet. Do you want to <a href=":createUrl" title="Create your first company">create a company</a> now?',
	),

	'user' => array(
		'add' => array(
			'title' => 'Add a user',
			'description' => 'Add a user to this company. At the moment you only can add already registered users.',
			'user' => 'Email address',
			'close' => 'Cancel',
			'invite' => 'Add',
			'success' => 'The user was added to the company.',
			'user-not-found' => 'An user with the email address does not exist yet!',
			'user-already-added' => 'The user already has access to the company!',
		),

		'remove' => array(
			'not-found' => 'The user could not be found in this company!',
			'not-creator' => 'You cannot delete the creator of the company!',
			'success' => 'The user was removed from the company.',
		),
	),

	'show' => array(
		'title' => ':name',
		'headline' => ':name',
		'delete' => 'Delete company',
	),

	'create' => array(
		'title' => 'Create new company',
		'headline' => 'New Company',
		'submit' => 'Create company',
		'success' => 'You successfully created the company.',
	),

	'edit' => array(
		'title' => 'Edit :name',
		'headline' => 'Edit :name',
		'submit' => 'Edit company',
		'success' => 'The company was edited successfully.'
	),

	'delete' => array(
		'success' => ':name was successfully deleted! You can <a href=":restoreUrl" title="Restore :name">restore</a> it.'
	),

	'form' => array(
		'name' => 'Name',
	),
);