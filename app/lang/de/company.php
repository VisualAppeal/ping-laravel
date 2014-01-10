<?php

return array(
	'index' => array(
		'title' => 'Unternehmen',
		'headline' => 'Unternehmen',
		'create' => 'Neues Unternehmen erstellen',
		'name' => 'Name',
		'users' => 'Benutzer',
		'show' => 'Anzeigen',
		'edit' => 'Bearbeiten',
		'delete' => 'Löschen',
		'add-user' => 'Benutzer hinzufügen',
		'empty' => 'Du hast noch kein Unternehmen erstellt. Möchtest du <a href=":createUrl" title="Erstelle dein erstes Unternehmen">jetzt eins erstellen</a>?',
	),

	'user' => array(
		'add' => array(
			'title' => 'Füge einen Benutzer hinzu',
			'description' => 'Füge einen Benutzer über seine E-Mail Adresse zu dem Unternehmen hinzu. Zur Zeit ist es nur möglich bereits registrierte Benutzer hinzuzufügen.',
			'user' => 'E-Mail Adresse',
			'close' => 'Abbrechen',
			'invite' => 'Hinzufügen',
			'success' => 'Der Benutzer wurde zu dem Unternehmen hinzugefügt.',
			'user-not-found' => 'Ein Benutzer mit dieser E-Mail Adresse existiert noch nicht!',
			'user-already-added' => 'Der Benutzer hat bereits Zugriff auf das Unternehmen!',
		),

		'remove' => array(
			'not-found' => 'Der Benutzer konnte nicht gefunden werden!',
			'not-creator' => 'Der Ersteller des Unternehmens kann nicht gelöscht werden!',
			'success' => 'Der Benutzer wurde aus dem Unternehmen entfernt.',
		),
	),

	'show' => array(
		'title' => ':name',
		'headline' => ':name',
		'delete' => 'Unternehmen löschen',
	),

	'create' => array(
		'title' => 'Neues Unternehmen erstellen',
		'headline' => 'Neues Unternehmen',
		'submit' => 'Unternehmen erstellen',
		'success' => 'Das Unternehmen wurde erfolgreich erstellt.',
	),

	'edit' => array(
		'title' => ':name bearbeiten',
		'headline' => ':name bearbeiten',
		'submit' => 'Unternehmen bearbeiten',
		'success' => 'Die Änderungen wurden erfolgreich gespeichert.'
	),

	'delete' => array(
		'success' => ':name wurde erfolgreich gelöscht! Du kannst es aber jetzt noch <a href=":restoreUrl" title=":name wiederherstellen">wiederherstellen</a>.'
	),

	'form' => array(
		'name' => 'Name',
	),
);