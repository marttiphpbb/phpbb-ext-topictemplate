<?php

/**
* phpBB Extension - marttiphpbb Topic Template
* @copyright (c) 2015 - 2025 marttiphpbb <info@martti.be>
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

	'ACP_MARTTIPHPBB_TOPICTEMPLATE'			=> 'Topic template',
	'ACP_MARTTIPHPBB_TOPICTEMPLATE_EXPLAIN'	=> 'When starting a topic, the text editor will be pre-filled with this "Topic Template". Leave blank when you don’t wish to use this. This functionality comes from the "Topic Template" extension.',
]);
