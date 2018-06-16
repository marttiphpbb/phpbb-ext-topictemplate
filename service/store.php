<?php

/**
* phpBB Extension - marttiphpbb Topic Template
* @copyright (c) 2015 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\topictemplate\service;

use phpbb\config\db_text as config_text;
use phpbb\cache\driver\driver_interface as cache;

class store
{
	const KEY = 'marttiphpbb_topictemplate';
	const CACHE_KEY = '_' . self::KEY;

	protected $config_text;
	protected $cache;
	protected $data = [];

	public function __construct(config_text $config_text, cache $cache)
	{
		$this->config_text = $config_text;
		$this->cache = $cache;
	}

	private function load()
	{
		if ($this->data)
		{
			return;
		}

		$this->data = $this->cache->get(self::CACHE_KEY);

		if ($this->data)
		{
			return;
		}

		$this->data = unserialize($this->config_text->get(self::KEY));
		$this->cache->put(self::CACHE_KEY, $this->data);
	}

	private function write()
	{
		$this->config_text->set(self::KEY, serialize($this->data));
		$this->cache->put(self::CACHE_KEY, $this->data);
	}

	public function get(string $key)
	{
		$this->load();
		return $this->data[$key] ?? null;
	}

	public function set(string $key, $data)
	{
		$this->load();
		$this->data[$key] = $data;
		$this->write();
	}

	public function delete(string $key)
	{
		$this->load();
		unset($this->data[$key]);
		$this->write();
	}

	public function get_template_forum_ids():array
	{
		$this->load();
		return array_keys($this->data['templates'] ?? []);
	}

	public function get_template(int $forum_id):string
	{
		$this->load();
		return $this->data['templates'][$forum_id] ?? '';
	}

	public function set_template(int $forum_id, string $template)
	{
		$this->load();

		if (strlen($template) === 0)
		{
			unset($this->data['templates'][$forum_id]);
		}
		else
		{
			$this->data['templates'][$forum_id] = $template;
		}

		$this->write();
	}

	public function template_is_set(int $forum_id):bool
	{
		$this->load();

		return isset($this->data['templates'][$forum_id]);
	}

	public function delete_all_templates_but(array $keep_forum_ids)
	{
		$keep_forum_ids = array_fill_keys($keep_forum_ids, true);

		$this->load();

		if (!isset($data['templates']))
		{
			return;
		}

		foreach ($this->data['templates'] as $forum_id => $template)
		{
			if (!isset($keep_forum_ids[$forum_id]))
			{
				if (isset($this->data['deleted']))
				{
					$this->data['deleted'][] = $forum_id;
				}
				else
				{
					$this->data['deleted'] = [$forum_id];
				}

				unset($this->data['templates'][$forum_id]);
			}
		}

		$this->write();
	}
}
