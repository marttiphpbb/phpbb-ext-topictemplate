<?php

/**
* phpBB Extension - marttiphpbb Topic Template
* @copyright (c) 2015 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [

	'ACP_MARTTIPHPBB_TOPICTEMPLATE'			=> 'Beitragsvorlage',
	'ACP_MARTTIPHPBB_TOPICTEMPLATE_EXPLAIN'	=> 'Wird im Forum auf den Button "Neues Thema" geklickt , läd eine "Beitragsvorlage" im Texteditor, die du hier individuell erstellen kannst.

Möchtest du keine Beitragsvorlage, dann lass das Feld frei. Diese Funktion kommt aus der Extension "Topic Template".',
]);
