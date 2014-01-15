<?php

return array(
	'diff' => array(
		'days' => 'Tag|Tage',
		'hours' => 'Stunde|Stunden',
		'minutes' => 'Minute|Minuten',
	),

	'index' => array(
		'title' => 'Checks',
		'headline' => 'Checks',
		'empty' => 'Du hast noch keine Checks erstellt. Möchtest du <a href=":createUrl" title="Erstelle deinen ersten Check">jetzt einen Check erstellen</a>?',
		'create' => 'Check erstellen',
		'url' => 'URL',
		'user' => 'Benutzer',
		'company' => 'Unternehmen',
		'interval' => 'Intervall',
		'show' => 'Anzeigen',
		'edit' => 'Bearbeiten',
		'delete' => 'Löschen',
	),

	'show' => array(
		'title' => 'Check :title',
		'headline' => ':title',
		'uptime' => 'Verfügbarkeit',
		'success' => 'Verfügbar',
		'begin' => 'Beginn',
		'end' => 'Ende',
		'duration' => 'Dauer',
		'latency' => 'Latenz',
		'delete' => 'Check löschen',
	),

	'create' => array(
		'title' => 'Check erstellen',
		'headline' => 'Neuer Check',
		'submit' => 'Check erstellen',
		'success' => 'Der Check wurde erfolgreich erstellt.',
	),

	'form' => array(
		'company_id' => 'Unternehmen',
		'url' => 'URL',
		'url-placeholder' => 'http://www.google.de',
		'port' => 'Port',
		'username' => 'Benutzername (HTTP-Auth)',
		'password' => 'Passwort (HTTP-Auth)',
		'check_for' => 'Suche in Quelltext',
		'interval' => 'Intervall (in Minuten)',
		'notify_failed_checks' => 'Benachrichtigung bei fehlgeschlagenen Checks',
		'notify_back_online' => 'Benachrichtigung wenn Webseite wieder erreichbar',
		'latency_satisfied' => 'Latenz - Zufriedenstellend (in Sekunden)',
		'latency_tolerating' => 'Latenz - Toleriert (in Sekunden)',
	),

	'edit' => array(
		'title' => 'Check bearbeiten',
		'headline' => ':url bearbeiten',
		'submit' => 'Check bearbeiten',
		'success' => 'Der Check wurde erfolgreich bearbeitet.',
	),

	'delete' => array(
		'success' => 'Der Check :url wurde erfolgreich gelöscht! Du kannst den Check aber <a href=":restoreUrl" title="Check wiederherstellen">wiederherstellen</a>.'
	),

	'errors' => array(
		'resolve-host' => 'Der Host :host konnte nicht aufgelöst werden',
	),

	'job' => array(
		'email' => array(
			'online' => array(
				'subject' => '[ping] :title ist wieder online!',
				'title' => ':title ist online',
				'headline' => ':title ist online',
				'content' => '<a href=":url">:title</a> ist wieder erreichbar.',
			),

			'offline' => array(
				'subject' => '[ping] :title ist offline!',
				'title' => ':title ist offline',
				'headline' => ':title ist offline',
				'content' => ':title ist aufgrund eines Fehlers <a href=":url">:code</a> nicht erreichbar!',
			),
		),
	),
);