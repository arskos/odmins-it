<?php

/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines http://www.simplemachines.org
 * @copyright 2011 Simple Machines
 * @license http://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.0
 */

if (!defined('SMF'))
	die('Hacking attempt...');

/*	This file contains just one function that formats a topic to be printer
	friendly.

	void PrintTopic()
		- is called to format a topic to be printer friendly.
		- must be called with a topic specified.
		- uses the Printpage (main sub template.) template.
		- uses the print_above/print_below later without the main layer.
		- is accessed via ?action=printpage.
*/

function PrintTopic()
{
	global $topic, $txt, $scripturl, $context, $user_info;
	global $board_info, $smcFunc, $modSettings;

	// Redirect to the boardindex if no valid topic id is provided.
	if (empty($topic))
		redirectexit();

	// Whatever happens don't index this.
	$context['robot_no_index'] = true;

	// Get the topic starter information.
	$request = $smcFunc['db_query']('', '
		SELECT m.poster_time, IFNULL(mem.real_name, m.poster_name) AS poster_name
		FROM {db_prefix}messages AS m
			LEFT JOIN {db_prefix}members AS mem ON (mem.id_member = m.id_member)
		WHERE m.id_topic = {int:current_topic}
		ORDER BY m.id_msg
		LIMIT 1',
		array(
			'current_topic' => $topic,
		)
	);
	// Redirect to the boardindex if no valid topic id is provided.
	if ($smcFunc['db_num_rows']($request) == 0)
		redirectexit();
	$row = $smcFunc['db_fetch_assoc']($request);
	$smcFunc['db_free_result']($request);

	// Lets "output" all that info.
	loadTemplate('Printpage');
	$context['template_layers'] = array('print');
	$context['board_name'] = $board_info['name'];
	$context['category_name'] = $board_info['cat']['name'];
	$context['poster_name'] = $row['poster_name'];
	$context['post_time'] = timeformat($row['poster_time'], false);
	$context['parent_boards'] = array();
	foreach ($board_info['parent_boards'] as $parent)
		$context['parent_boards'][] = $parent['name'];

	// Split the topics up so we can print them.
	$request = $smcFunc['db_query']('', '
		SELECT subject, poster_time, body, IFNULL(mem.real_name, poster_name) AS poster_name, id_msg
		FROM {db_prefix}messages AS m
			LEFT JOIN {db_prefix}members AS mem ON (mem.id_member = m.id_member)
		WHERE m.id_topic = {int:current_topic}' . ($modSettings['postmod_active'] && !allowedTo('approve_posts') ? '
			AND (m.approved = {int:is_approved}' . ($user_info['is_guest'] ? '' : ' OR m.id_member = {int:current_member}') . ')' : '') . '
		ORDER BY m.id_msg',
		array(
			'current_topic' => $topic,
			'is_approved' => 1,
			'current_member' => $user_info['id'],
		)
	);
	$context['posts'] = array();
	$messages = array();
	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		// Censor the subject and message.
		censorText($row['subject']);
		censorText($row['body']);

		$context['posts'][] = array(
			'subject' => $row['subject'],
			'member' => $row['poster_name'],
			'time' => timeformat($row['poster_time'], false),
			'timestamp' => forum_time(true, $row['poster_time']),
			'body' => parse_bbc($row['body'], 'print'),
			'id_msg' => $row['id_msg'],
			'topic' => $topic,
		);
		$messages[] = $row['id_msg'];

		if (!isset($context['topic_subject']))
			$context['topic_subject'] = $row['subject'];
	}
	$smcFunc['db_free_result']($request);
	
	// Fetch attachments so we can print them if asked
	if (!empty($modSettings['attachmentEnable']) && allowedTo('view_attachments'))
	{
		// build the request
		$request = $smcFunc['db_query']('', '
			SELECT
				a.id_attach, a.id_msg, a.approved, a.width, a.height 
			FROM {db_prefix}attachments AS a
			WHERE a.id_msg IN ({array_int:message_list})
				AND a.attachment_type = {int:attachment_type}',
			array(
				'message_list' => $messages,
				'attachment_type' => 0,
				'is_approved' => 1,
			)
		);
		$temp = array();
		while ($row = $smcFunc['db_fetch_assoc']($request))
		{
			$temp[$row['id_attach']] = $row;
			if (!isset($context['printattach'][$row['id_msg']]))
				$context['printattach'][$row['id_msg']] = array();
		}
		$smcFunc['db_free_result']($request);
		ksort($temp);

		// load them into $context so we can use them
		foreach ($temp as $row)
		{
			// fix the image sizes if needed
			if (!empty($modSettings['max_image_width']) && (empty($modSettings['max_image_height']) || $row['height'] * ($modSettings['max_image_width'] / $row['width']) <= $modSettings['max_image_height']))
			{
				if ($row['width'] > $modSettings['max_image_width']) 
				{
					$row['height'] = floor($row['height'] * ($modSettings['max_image_width'] / $row['width']));
					$row['width'] = $modSettings['max_image_width'];
				}
			}
			elseif (!empty($modSettings['max_image_width']))
			{
				if ($row['height'] > $modSettings['max_image_height']) 
				{
					$row['width'] = floor($row['width'] * ($modSettings['max_image_height'] / $row['height']));
					$row['height'] = $modSettings['max_image_height'];
				}
			}
			
			// save for the template
			$context['printattach'][$row['id_msg']][] = $row;
		}
	}

	// Set a canonical URL for this page.
	$context['canonical_url'] = $scripturl . '?topic=' . $topic . '.0';
}

?>