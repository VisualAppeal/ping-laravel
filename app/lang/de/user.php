<?php

return array(
	'login' => array(
		'title' => 'Anmelden',
		'headline' => 'Anmelden',

		'no-email' => 'Keine E-Mail Adresse angegeben!',
		'not-activated' => 'Konto noch nicht aktiviert!',
		'unknown' => 'Die E-Mail Adresse oder das Passwort ist falsch!',
		'suspended' => 'Das Konto wurde deaktiviert!',
		'banned' => 'Das Konto wurde gesperrt!',

		'form' => array(
			'email' => 'E-Mail Adresse',
			'password' => 'Passwort',
			'remember' => 'Angemeldet bleiben',
			'submit' => 'Anmelden',
		),
	),

	'account' => array(
		'title' => 'Dein Konto',
		'headline' => 'Dein Konto',

		'form' => array(
			'email' => 'E-Mail Adresse',
			'first_name' => 'Vorname',
			'last_name' => 'Nachname',
			'old-password' => 'Aktuelles Passwort',
			'submit' => 'Speichern',
		),
	),

	'register' => array(
		'title' => 'Registrieren',
		'headline' => 'Neuen Benutzer anlegen',

		'activation' => 'Ihr Konto wurde erfolgreich angelegt! Bitte prüfe deine E-Mails und bestätige sie mit einem Klick auf den Aktivierungs-Code.',
		'email-required' => 'Du musst eine E-Mail Adresse angeben!',
		'password-required' => 'Du musst ein Passwort angeben!',
		'email-unique' => 'Es gibt bereits einen Benutzer mit dem Passwort! Möchtest du dich lieber <a href=":loginUrl">anmelden</a>?',

		'form' => array(
			'email' => 'E-Mail Adresse',
			'password' => 'Passwort',
			'password_repeat' => 'Passwort wiederholen',
			'submit' => 'Registrieren',
		),

		'social' => array(
			'github' => array(
				'no-emails' => 'In Ihrem GitHub Konto konnten keine E-Mail Adresse gefunden werden! Bitte fügen Sie eine E-Mail Adresse zu Ihrem GitHub Konto hinzu oder versuchen Sie die Registrierung mit einem anderen Dienst.',
				'login' => 'Anmelden mit <strong>GitHub</strong>',
			),
		),
	),

	'social' => array(
		'title' => 'Registrieren',
		'headline' => 'Wählen Sie Ihre primäre E-Mail Adresse',
		'description' => 'In Ihrem Konto wurden mehrere E-Mail Adressen gefunden, bitte wählen Sie die E-Mail Adresse aus mit der Sie sich registrieren wollen.',
		'submit' => 'Registrieren',
	),

	'activate' => array(
		'not-found' => 'Dein Aktivierungs-Code wurde nicht gefunden! Bitte registriere dich noch einmal.',
		'success' => 'Dein Konto wurde erfolgreich aktiviert.',
		'error' => 'Dein Konto konnte aus unbekannten Gründen nicht aktiviert werden. Bitte wende dich an den Kontakt',
		'already-activated' => 'Du hast dein Konto schon aktiviert! Du kannst dich jetzt direkt anmelden.',

		'email' => array(
			'title' => 'E-Mail bestätigen',
			'headline' => 'Bestätige deine E-Mail',
			'subject' => 'Bestätige deine Ping Konto',
			'content' => 'Deine E-Mail Adresse wurde benutzt um dich bei Ping zu registrieren! <a href=":url">Bestätige</a> jetzt deine E-Mail oder ignoriere sie wenn du dich nicht registriert hast.',
		),
	),
);