<?php
/*******************************************************************************
* Zen Block © 2011-2012, Bugo											       *
********************************************************************************
* Subs-ZenBlock.php															   *
********************************************************************************
* License http://creativecommons.org/licenses/by-nc-nd/3.0/deed.ru CC BY-NC-ND *
* Support and updates for this software can be found at	http://dragomano.ru    *
*******************************************************************************/

if (!defined('SMF'))
	die('Hacking attempt...');
	
loadLanguage('ZenBlock');

// Loading from integrate_menu_buttons
function zen_preload()
{
	global $modSettings, $context;

	if (empty($modSettings['zen_block_enable']) || empty($context['current_board'])) return;

	$ignore_boards = array();
	
	if (!empty($modSettings['zen_ignore_boards']))
		$ignore_boards = explode(",", $modSettings['zen_ignore_boards']);
		
	if (!empty($modSettings['recycle_board']))
		$ignore_boards[] = $modSettings['recycle_board'];
	
	if (in_array($context['current_board'], $ignore_boards)) return;

	if (!empty($context['current_topic']) && isset($context['topic_first_message']))
	{
		if (empty($modSettings['zen_block_enable'])) return;
		
		if ($modSettings['zen_block_enable'] == 1 ? $context['first_message'] != $context['topic_first_message'] : $modSettings['zen_block_enable'] == 2)
			$context['zen_block'] = zen_block();
	}
}

// Loading from zen_preload (see above)
function zen_block()
{
	global $txt, $smcFunc, $context, $boarddir, $scripturl, $modSettings, $settings;
	
	loadTemplate('ZenBlock', 'zen');
	$context['template_layers'][] = 'zen';

	$post = array();
	
	$request = $smcFunc['db_query']('', '
		SELECT body, icon
		FROM {db_prefix}messages
		WHERE id_topic = {int:current_topic}
			AND id_msg = {int:first_message}
		LIMIT 1',
		array(
			'current_topic' => $context['current_topic'],
			'first_message' => $context['topic_first_message'],
		)
	);
	
	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		$row['body'] = parse_bbc($row['body']);
		censorText($row['body']);
		$post[] = $row['body'];
		$context['zen_topic_icon'] = $settings['images_url'] . '/post/' . $row['icon'] . '.gif';
	}
	
	$smcFunc['db_free_result']($request);
	
	// Check topic popularity
	$context['top_topic'] = false;
	
	if (!file_exists($boarddir . '/SSI.php')) return;
	
	require_once($boarddir . '/SSI.php');
	$link = $scripturl . '?topic=' . $context['current_topic'] . '.0';
	$topics = ssi_topTopicsReplies(1, null, 'array');
	
	foreach ($topics as $topic)
	{
		if ($link == $topic['href'])
			$context['top_topic'] = true;
	}
		
	// Attachments block
	$context['zen_attachments'] = '';
	
	if (!empty($modSettings['zen_attach_block']) && allowedTo('view_attachments'))
	{	
		$attachment_ext = explode(",", $modSettings['attachmentExtensions']);
		
		$request = $smcFunc['db_query']('', '
			SELECT id_attach, id_thumb, filename, width, height
			FROM {db_prefix}attachments
			WHERE id_msg = {int:first_message}
				AND attachment_type = 0
				AND fileext IN ({array_string:attachment_ext})
				AND approved = 1
			ORDER BY id_attach ASC
			LIMIT {int:num_attachments}',
			array(
				'first_message' => $context['topic_first_message'],
				'attachment_ext' => $attachment_ext,
				'num_attachments' => $modSettings['attachmentNumPerPostLimit']
			)
		);
		
		$context['attachments'] = array();
		while ($row = $smcFunc['db_fetch_assoc']($request))
		{
			$filename = preg_replace('~&amp;#(\\d{1,7}|x[0-9a-fA-F]{1,6});~', '&#\\1;', htmlspecialchars($row['filename']));
			
			$context['attachments'][$row['id_attach']] = array(
				'file' => array(
					'filename' => $filename,
					'href' => $scripturl . '?action=dlattach;topic=' . $context['current_topic'] . '.0;attach=' . $row['id_attach'],
					'is_image' => !empty($row['width']) && !empty($row['height']) && !empty($modSettings['attachmentShowImages']),
				),
			);
			
			if ($context['attachments'][$row['id_attach']]['file']['is_image'])
			{
				$id_thumb = empty($row['id_thumb']) ? $row['id_attach'] : $row['id_thumb'];
				$context['attachments'][$row['id_attach']]['file']['image'] = array(
					'id' => $id_thumb,
					'href' => $scripturl . '?action=dlattach;topic=' . $context['current_topic'] . '.0;attach=' . $id_thumb . ';image',
				);
			}
		}
		
		$smcFunc['db_free_result']($request);
		
		foreach ($context['attachments'] as $attach)
		{
			if (!$attach['file']['is_image'])
				$link = '<img src="' . $settings['images_url'] . '/icons/clip.gif" alt="" />&nbsp;<a href="' . $attach['file']['href'] . '">' . $attach['file']['filename'] . '</a>';
			else
				$link = '<img src="' . $settings['images_url'] . '/icons/clip.gif" alt="" />&nbsp;<a href="' . $attach['file']['href'] . '" class="imgTip' . $attach['file']['image']['id'] . '">' . $attach['file']['filename'] . '</a>';
			$context['zen_attachments'] .= $link . '<br/>';
		}
		
		if (!isset($context['tooltips']))
			$context['tooltips'] = 'dark';
	}

	return $post[0];
}

// Loading from integrate_admin_areas
function zen_admin_areas(&$admin_areas)
{
	global $txt;
	
	$admin_areas['config']['areas']['modsettings']['subsections']['zen'] = array($txt['zen_settings']);
}

// Loading from integrate_modify_modifications
function zen_modifications(&$subActions)
{
	$subActions['zen'] = 'zen_settings';
}

// Loading from zen_modifications (see above)
function zen_settings()
{
	global $txt, $context, $scripturl, $modSettings;
	
	$context['page_title'] = $context['settings_title'] = $txt['zen_settings'];
	$context['post_url'] = $scripturl . '?action=admin;area=modsettings;save;sa=zen';
	$context[$context['admin_menu_name']]['tab_data']['tabs']['zen'] = array('description' => $txt['zen_desc']);
	
	if (!isset($modSettings['zen_yashare_blocks'])) updateSettings(array('zen_yashare_blocks' => $txt['zen_yashare_icons']));
	
	$config_vars = array(
		array('select', 'zen_block_enable', $txt['zen_where_is']),
		array('select', 'zen_block_status', $txt['zen_block_status_set']),
		array('text', 'zen_ignore_boards'),
		array('check', 'zen_attach_block'),
		array('check', 'zen_img_preview'),
		array('check', 'zen_gplus'),
		array('select', 'zen_yashare', $txt['zen_yashare_set'])
	);
	
	if (!empty($modSettings['zen_yashare']))
	{
		$config_vars[] = array('title', 'zen_yashare_title');
		$config_vars[] = array('desc', 'zen_yashare_desc');
		$config_vars[] = array('large_text', 'zen_yashare_blocks', '" style="width:80%');
		$config_vars[] = array('large_text', 'zen_yashare_array', '" style="width:80%');
	}
	
	// Saving?
	if (isset($_GET['save']))
	{
		$test = array();
		$temp = explode(',', $_POST['zen_ignore_boards']);
		
		foreach ($temp as &$check)
		{
			$check = trim($check);
			if (((string)(int) $check) == ((string) $check))
				$test[] = $check;
		}
		
		$_POST['zen_ignore_boards'] = implode(',', $test);
	
		checkSession();
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=modsettings;sa=zen');
	}
	
	prepareDBSettingContext($config_vars);
}

?>