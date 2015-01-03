<?php
/**
* @package phpBB Extension - marttiphpbb posting template
* @copyright (c) 2014 marttiphpbb <info@martti.be>
* @license http://opensource.org/licenses/MIT
*/

namespace marttiphpbb\postingtemplate\event;

use phpbb\config\db_text as config_text;
use phpbb\request\request;
use phpbb\user;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var config_text */
	protected $config_text;

	/* @var request */
	protected $request;

	/* @var user */
	protected $user;

	
	/**
	* @param config_text		$config_text
	* @param request			$request	
	* @param user				$user
	*/
	public function __construct(
			config_text $config_text,
			request $request,
			user $user
		)
	{
		$this->config_text = $config_text;
		$this->request = $request;
		$this->user = $user;
	}	
	

	static public function getSubscribedEvents()
	{
		return array(
			'core.acp_manage_forums_request_data'		=> 'core_acp_manage_forums_request_data',
			'core.acp_manage_forums_initialise_data'	=> 'core_acp_manage_forums_initialise_data',
			'core.acp_manage_forums_display_form'		=> 'core_acp_manage_forums_display_form',
			'core.posting_modify_template_vars'			=> 'core_posting_modify_template_vars',
		);
	}
	
	
	public function core_acp_manage_forums_request_data($event)
	{
		$forum_data = $event['forum_data'];
		
		$forum_data['forum_postingtemplate'] = $this->request->variable('forum_postingtemplate', '', true);
		
		$event['forum_data'] = $forum_data;
	}

	public function core_acp_manage_forums_initialise_data($event)
	{
		$forum_data = $event['forum_data'];
		$update = $event['update'];
		$action = $event['action'];
		
		if (!$update && $action != 'edit')
		{
			$forum_data['forum_postingtemplate'] = '';
		}
		
		$event['forum_data'] = $forum_data;
	}

	public function core_acp_manage_forums_display_form($event)
	{
		$forum_id = $event['forum_id'];
		$template_data = $event['template_data'];

		$postingtemplate = $this->config_text->get('marttiphpbb_postingtemplate_forum[' . $forum . ']');

		$template_data['FORUM_POSTINGTEMPLATE'] = ($postingtemplate) ? $postingtemplate : '';
		
		$event['template_data'] = $template_data;

		$this->user->add_lang_ext('marttiphpbb/postingtemplate', 'acp');
	}

	public function core_posting_modify_template_vars($event)
	{
		$page_data = $event['page_data'];
		$post_data = $event['post_data'];
		$mode = $event['mode'];
		$submit = $event['submit'];
		$preview = $event['preview'];
		$load = $event['load'];
		$save = $event['save'];
		$refresh = $event['refresh'];
		
		if ($mode == 'post' 
			&& !$submit && !$preview && !$load && !$save && !$refresh 
			&& empty($post_data['post_text']) && empty($post_data['post_subject']))
		{
			$page_data['MESSAGE'] = $post_data['forum_postingtemplate'];
		}
		
		$event['page_data'] = $page_data;
	}
}