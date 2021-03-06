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

/*	The single function this file contains is used to display the main
	board index.  It uses just the following functions:

	void BoardIndex()
		- shows the board index.
		- uses the BoardIndex template, and main sub template.
		- may use the boardindex subtemplate for wireless support.
		- updates the most online statistics.
		- is accessed by ?action=boardindex.

	void CollapseCategory()
		- collapse or expand a category
*/

// Show the board index!
function BoardIndex()
{
	global $txt, $user_info, $sourcedir, $modSettings, $context, $settings, $scripturl;

	// For wireless, we use the Wireless template...
	if (WIRELESS)
		$context['sub_template'] = WIRELESS_PROTOCOL . '_boardindex';
	else
		loadTemplate('BoardIndex');

	// Set a canonical URL for this page.
	$context['canonical_url'] = $scripturl;

	// Do not let search engines index anything if there is a random thing in $_GET.
	if (!empty($_GET))
		$context['robot_no_index'] = true;

	// Retrieve the categories and boards.
	require_once($sourcedir . '/Subs-BoardIndex.php');
	$boardIndexOptions = array(
		'include_categories' => true,
		'base_level' => 0,
		'parent_id' => 0,
		'set_latest_post' => true,
		'countChildPosts' => !empty($modSettings['countChildPosts']),
	);
	$context['categories'] = getBoardIndex($boardIndexOptions);
	//The latest member?
	if (!empty($modSettings['latestMember']) && !empty($modSettings['MemberColorLatestMember']))
		$context['MemberColor_ID_MEMBER'][$modSettings['latestMember']] = $modSettings['latestMember'];

	// Know set the colors for the last post...
	if (!empty($context['MemberColor_ID_MEMBER'])) {
		$colorDatas = load_onlineColors($context['MemberColor_ID_MEMBER']);
		$cmemcolid = null;

		//So the BoardIndex need colored links
		if (!empty($modSettings['MemberColorBoardindex']) && !empty($context['MemberColor_board'])) {
			foreach($context['MemberColor_board'] as $boardid_memcolor) {
				$cmemcolid = $context['categories'][$boardid_memcolor['cat']]['boards'][$boardid_memcolor['bid']]['last_post']['member']['id'];
				if(!empty($colorDatas[$cmemcolid]['colored_link']))
					$context['categories'][$boardid_memcolor['cat']]['boards'][$boardid_memcolor['bid']]['last_post']['member']['link'] = $colorDatas[$cmemcolid]['colored_link'];
			}
		}

		//You are not know what you do ;P Colors allready loaded :D
		if(!empty($modSettings['MemberColorModeratorLinks']) && !empty($context['MemberColor_ModBoard'])) {
			//Okay now... do a heavy serach for moderators... only jokeing... but you know... it look so ugly ;)
			$onlineColor = load_mod_color(true);
			global $scripturl, $color_profile;
			foreach($context['MemberColor_ModBoard'] as $boardid_memcolor) {
				//Reset it :D
				$context['categories'][$boardid_memcolor['cat']]['boards'][$boardid_memcolor['bid']]['link_moderators'] = array();
				foreach($context['categories'][$boardid_memcolor['cat']]['boards'][$boardid_memcolor['bid']]['moderators'] as $moderators) {
					$cmemcolid = $moderators['id'];
					//Replace "Profil of" with "Moderator" ;D
					$link = str_replace($txt['profile_of'], $txt['board_moderator'], $colorDatas[$cmemcolid]['colored_link']); 
					if(empty($colorDatas[$cmemcolid]['online_color']) && !empty($onlineColor))
						$link = '<a href="' . $scripturl . '?action=profile;u=' . $color_profile[$cmemcolid]['id_member'] . '" title="' . $txt['board_moderator'] . ' ' . $color_profile[$cmemcolid]['real_name'] . '"'.(!empty($modSettings['MemberColorLinkOldSpanStyle']) ? '><span style="color:'.$onlineColor.';">' : ' style="color:'.$onlineColor.';">') . $color_profile[$cmemcolid]['real_name'] . (!empty($modSettings['MemberColorLinkOldSpanStyle']) ? '</span>' : '').'</a>';
					$context['categories'][$boardid_memcolor['cat']]['boards'][$boardid_memcolor['bid']]['moderators'][$cmemcolid]['link'] = $link;
					//Creat the new list...
					$context['categories'][$boardid_memcolor['cat']]['boards'][$boardid_memcolor['bid']]['link_moderators'][] = $link;
				}
			}
		}
	}

	// Get the user online list.
	require_once($sourcedir . '/Subs-MembersOnline.php');
	$membersOnlineOptions = array(
		'show_hidden' => allowedTo('moderate_forum'),
		'sort' => 'log_time',
		'reverse_sort' => true,
	);
	$context += getMembersOnlineStats($membersOnlineOptions);

	// Get the user online today list.
	$context += getUsersOnlineTodayStats();
			
	$context['show_buddies'] = !empty($user_info['buddies']);

	// Are we showing all membergroups on the board index?
	if (!empty($settings['show_group_key']))
		$context['membergroups'] = cache_quick_get('membergroup_list', 'Subs-Membergroups.php', 'cache_getMembergroupList', array());

	// Track most online statistics? (Subs-MembersOnline.php)
	if (!empty($modSettings['trackStats']))
		trackStatsUsersOnline($context['num_guests'] + $context['num_spiders'] + $context['num_users_online']);

	// Retrieve the latest posts if the theme settings require it.
	if (isset($settings['number_recent_posts']) && $settings['number_recent_posts'] > 1)
	{
		$latestPostOptions = array(
			'number_posts' => $settings['number_recent_posts'],
		);
		$context['latest_posts'] = cache_quick_get('boardindex-latest_posts:' . md5($user_info['query_wanna_see_board'] . $user_info['language']), 'Subs-Recent.php', 'cache_getLastPosts', array($latestPostOptions));
	}

	$settings['display_recent_bar'] = !empty($settings['number_recent_posts']) ? $settings['number_recent_posts'] : 0;
	$settings['show_member_bar'] &= allowedTo('view_mlist');
	$context['show_stats'] = allowedTo('view_stats') && !empty($modSettings['trackStats']);
	$context['show_member_list'] = allowedTo('view_mlist');
	$context['show_who'] = allowedTo('who_view') && !empty($modSettings['who_enabled']);
$context['show_karmastat'] = allowedTo('karmalog_view') && empty($modsettings['karmapermiss']);
	//Load last karma chage?
    global $db_prefix, $smcFunc;

    if (!empty($modSettings['karmadescmod']) && !empty($modSettings['karmalastchange']) && ($context['show_karmastat']) && ($context['user']['is_admin']))
    {
    	$result = $smcFunc['db_query']('', "
                             SELECT lk.id_target, lk.id_executor, lk.log_time, lk.action, lk.description, lk.link, memt.real_name AS target_name, meme.real_name AS executor_name, memt.karma_good AS target_karma_good, memt.karma_bad AS target_karma_bad, meme.karma_good AS executor_karma_good, meme.karma_bad AS executor_karma_bad
                             FROM {$db_prefix}log_karma AS lk, {$db_prefix}members AS memt, {$db_prefix}members AS meme
                             WHERE memt.id_member = lk.id_target
                             AND meme.id_member = lk.id_executor
                             ORDER BY lk.log_time DESC
                             LIMIT $modSettings[karmalastchangenum] ");

        //All recieve values to context variables please.
        $context['karma_changes'] = array();
            while ($row = $smcFunc['db_fetch_assoc']($result))
        $context['karma_changes'][] = array(
                      'executor' => stripslashes($row['executor_name']),
                      'target' => stripslashes($row['target_name']),
                      'action' => ($row['action'] == 1) ? '+' : '-',
                      'Description' => stripslashes($row['description']),
                      'time' => timeformat($row['log_time']),
                      'id_exec' => stripslashes($row['id_executor']),
                      'id_targ' => stripslashes($row['id_target']),
                      'link' => stripslashes($row['link']),
                      'logtime' => strftime("%H:%M:%S, %d %b %Y",$row['log_time']),
                                            );
        $smcFunc['db_free_result']($result);
    }

   if (!empty($modSettings['karmadescmod']) && !empty($modSettings['karmalastchange']) && $context['show_karmastat'] && empty($modSettings['karmaisowner']))
    {
    	$result = $smcFunc['db_query']('', "
                             SELECT lk.id_target, lk.id_executor, lk.log_time, lk.action, lk.description, lk.link, memt.real_name AS target_name, meme.real_name AS executor_name, memt.karma_good AS target_karma_good, memt.karma_bad AS target_karma_bad, meme.karma_good AS executor_karma_good, meme.karma_bad AS executor_karma_bad
                             FROM {$db_prefix}log_karma AS lk, {$db_prefix}members AS memt, {$db_prefix}members AS meme
                             WHERE memt.id_member = lk.id_target
                             AND meme.id_member = lk.id_executor
                             ORDER BY lk.log_time DESC
                             LIMIT $modSettings[karmalastchangenum] ");

        //All recieve values to context variables please.
        $context['karma_changes'] = array();
            while ($row = $smcFunc['db_fetch_assoc']($result))
        $context['karma_changes'][] = array(
                      'executor' => stripslashes($row['executor_name']),
                      'target' => stripslashes($row['target_name']),
                      'action' => ($row['action'] == 1) ? '+' : '-',
                      'Description' => stripslashes($row['description']),
                      'time' => timeformat($row['log_time']),
                      'id_exec' => stripslashes($row['id_executor']),
                      'id_targ' => stripslashes($row['id_target']),
                      'link' => stripslashes($row['link']),
                      'logtime' => strftime("%H:%M:%S, %d %b %Y",$row['log_time']),
                                            );
        $smcFunc['db_free_result']($result);
    }

	// Load the calendar?
	if (!empty($modSettings['cal_enabled']) && allowedTo('calendar_view'))
	{
		// Retrieve the calendar data (events, birthdays, holidays).
		$eventOptions = array(
			'include_holidays' => $modSettings['cal_showholidays'] > 1,
			'include_birthdays' => $modSettings['cal_showbdays'] > 1,
			'include_events' => $modSettings['cal_showevents'] > 1,
			'num_days_shown' => empty($modSettings['cal_days_for_index']) || $modSettings['cal_days_for_index'] < 1 ? 1 : $modSettings['cal_days_for_index'],
		);
		$context += cache_quick_get('calendar_index_offset_' . ($user_info['time_offset'] + $modSettings['time_offset']), 'Subs-Calendar.php', 'cache_getRecentEvents', array($eventOptions));

		// Whether one or multiple days are shown on the board index.
		$context['calendar_only_today'] = $modSettings['cal_days_for_index'] == 1;

		// This is used to show the "how-do-I-edit" help.
		$context['calendar_can_edit'] = allowedTo('calendar_edit_any');
	}
	else
		$context['show_calendar'] = false;

	$context['page_title'] = sprintf($txt['forum_index'], $context['forum_name']);
}

// Collapse or expand a category
function CollapseCategory()
{
	global $user_info, $sourcedir, $context;

	// Just in case, no need, no need.
	$context['robot_no_index'] = true;

	checkSession('request');

	if (!isset($_GET['sa']))
		fatal_lang_error('no_access', false);

	// Check if the input values are correct.
	if (in_array($_REQUEST['sa'], array('expand', 'collapse', 'toggle')) && isset($_REQUEST['c']))
	{
		// And collapse/expand/toggle the category.
		require_once($sourcedir . '/Subs-Categories.php');
		collapseCategories(array((int) $_REQUEST['c']), $_REQUEST['sa'], array($user_info['id']));
	}

	// And go back to the board index.
	BoardIndex();
}

?>