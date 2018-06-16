<?php
/**
* phpBB Extension - marttiphpbb Topic Template
* @copyright (c) 2015 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\topictemplate\event;

use phpbb\event\data as event;
use marttiphpbb\topictemplate\service\store;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class posting_listener implements EventSubscriberInterface
{
	protected $store;

	public function __construct(store $store)
	{
		$this->store = $store;
	}

	static public function getSubscribedEvents()
	{
		return [
			'core.posting_modify_template_vars'			=> 'core_posting_modify_template_vars',
		];
	}

	public function core_posting_modify_template_vars(event $event)
	{
		$page_data = $event['page_data'];
		$post_data = $event['post_data'];
		$mode = $event['mode'];
		$submit = $event['submit'];
		$preview = $event['preview'];
		$load = $event['load'];
		$save = $event['save'];
		$refresh = $event['refresh'];
		$forum_id = $event['forum_id'];

		if ($mode == 'post'
			&& !$submit && !$preview && !$load && !$save && !$refresh
			&& empty($post_data['post_text']) && empty($post_data['post_subject'])
			&& $this->store->template_is_set($forum_id))
		{
			$page_data['MESSAGE'] = $this->store->get_template($forum_id);
		}

		$event['page_data'] = $page_data;
	}
}
