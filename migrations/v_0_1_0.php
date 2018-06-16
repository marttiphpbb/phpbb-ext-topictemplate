<?php
/**
* phpBB Extension - marttiphpbb Topic Template
* @copyright (c) 2015 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\topictemplate\migrations;

use marttiphpbb\topictemplate\service\store;

class v_0_1_0 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return [
			'\phpbb\db\migration\data\v32x\v320',
		];
	}

	public function update_data()
	{
		$data = [];

	/**
		Migrate data from the "Posting Template" extension
		https://github.com/marttiphpbb/phpbb-ext-postingtemplate
		Only when it's enabled.
	*/

		$sql = 'select ext_active
			from ' . EXT_TABLE . '
			where ext_name = \'marttiphpbb/postingtemplate\'';
		$result = $this->db->sql_query($sql);
		$active = $this->db->sql_fetchfield('ext_active');
		$this->db->sql_freeresult($result);

		if ($active)
		{
			$sql = 'select config_name, config_value
				from ' . CONFIG_TEXT_TABLE . '
				where config_name ' . $this->db->sql_like_expression('marttiphpbb_postingtemplate_forum' . $this->db->get_any_char());
			$result = $this->db->sql_query($sql);
			while ($row = $this->db->sql_fetchrow($result))
			{
				$forum_id = str_replace(['marttiphpbb_postingtemplate_forum[', ']'], '', $row['config_name']);
				if (!ctype_digit($forum_id))
				{
					continue;
				}

				$data['templates'][(int) $forum_id] = $row['config_value'];
			}
			$this->db->sql_freeresult($result);

			if (isset($data['templates']) && count($data['templates']))
			{
				$data['imported_data_at'] = time();
			}
		}

		return [
			['config_text.add', [store::KEY, serialize($data)]],
		];
	}
}
