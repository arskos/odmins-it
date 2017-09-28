<?php
/**********************************************************************************
* Announce.php                                                                    *
***********************************************************************************
* SMF Torrent                                                                     *
* =============================================================================== *
* Software Version:           SMF Torrent 0.1 Alpha                               *
* Software by:                Niko Pahajoki (http://www.madjoki.com)              *
* Copyright 2008 by:          Niko Pahajoki (http://www.madjoki.com)              *
* Support, News, Updates at:  http://www.madjoki.com                              *
***********************************************************************************
* This program is free software; you may redistribute it and/or modify it under   *
* the terms of the provided license as published by Simple Machines LLC.          *
*                                                                                 *
* This program is distributed in the hope that it is and will be useful, but      *
* WITHOUT ANY WARRANTIES; without even any implied warranty of MERCHANTABILITY    *
* or FITNESS FOR A PARTICULAR PURPOSE.                                            *
*                                                                                 *
* See the "license.txt" file for details of the Simple Machines license.          *
* The latest version can always be found at http://www.simplemachines.org.        *
**********************************************************************************/

function AnnounceMain()
{
	global $smcFunc, $user_info, $txt, $modSettings;

	if (empty($_REQUEST['peer_id']) || strlen($_REQUEST['peer_id']) != 20)
		btFatalError($txt['invalid_request']);
	
	$user_info['peer_id'] = bin2hex(trim($_REQUEST['peer_id']));

	if (isset($_REQUEST['info_hash']))
		$info_hash = bin2hex($_REQUEST['info_hash']);
	else
		btFatalError($txt['invalid_request']);

	if (empty($user_info['id']))
		btFatalError($txt['tracker_not_authorized']);

	// Load torrent
	$request = $smcFunc['db_query']('', '
		SELECT id_torrent, seeders, leechers
		FROM {db_prefix}tracker_torrents
		WHERE info_hash = {string:info_hash}',
		array(
			'info_hash' => $info_hash,
		)
	);
	$row = $smcFunc['db_fetch_assoc']($request);
	$smcFunc['db_free_result']($request);
	
	if (!$row)
		btFatalError($txt['torrent_not_authorized']);

	$torrent = array(
		'id' => $row['id_torrent'],
		'seeders' => (int) $row['seeders'],
		'leechers' => (int) $row['leechers'],
	);

	unset($row);

	// Make sure that numeric values are numeric
	// TODO: Add check for client sending invalid information
	$_REQUEST['uploaded'] = (float) $_REQUEST['uploaded'];
	$_REQUEST['downloaded'] = (float) $_REQUEST['downloaded'];
	$_REQUEST['left'] = (float) $_REQUEST['left'];
	$_REQUEST['port'] = (int) $_REQUEST['port'];
	
	$_REQUEST['event'] = isset($_REQUEST['event']) ? $_REQUEST['event'] : '';

	// User is seeding if it has no more data to download
	$user_info['is_seeder'] = $_REQUEST['left'] == 0;
	
	$user_info['current_mode'] = $user_info['is_seeder'] ? 'seeders' : 'leechers';

	$updatePeers = false;

	$time = time();

	$torrentUpdates = array();
	$downloadUpdates = array();
	$memberUpdates = array();

	// Values for all queries
	$values = array(
		'time_now' => $time,
		'event' => $_REQUEST['event'],
		'download_left' => $_REQUEST['left'],
		'downloaded' => $_REQUEST['downloaded'],
		'uploaded' => $_REQUEST['uploaded'],
		'peer_id' => $user_info['peer_id'],
		'torrent' => $torrent['id'],
		'member' => $user_info['id'],
		'new_upload' => 0,
		'new_download' => 0,
		'upload_rate' => 0,
		'download_rate' => 0,
		'time_elapsed' => 1,
	);

	if ($user_info['is_seeder'])
		$torrentUpdates['last_seeder'] = '{int:time_now}';

	if ($_REQUEST['event'] == 'completed')
	{
		$torrentUpdates['downloads'] = 'downloads + 1';
		$downloadUpdates['complete_time'] = '{int:time_now}';
	}

	$request = $smcFunc['db_query']('', '
		SELECT
			peer_id, id_member, last_action, event,
			download_left, ip, port, downloaded, uploaded
		FROM {db_prefix}tracker_peers
		WHERE peer_id = {string:peer_id}
			AND id_torrent = {int:torrent}
			AND id_member = {int:member}',
		array(
			'peer_id' => $user_info['peer_id'],
			'torrent' => $torrent['id'],
			'member' => $user_info['id']
		)
	);
	
	$row = $smcFunc['db_fetch_assoc']($request);
	$smcFunc['db_free_result']($request);
	
	// Update peer if it exists
	if ($row)
	{
		// How long it was from last announce?
		$values['time_elapsed'] = $time - $row['last_action'];

		if ($values['time_elapsed'] < 1)
			$values['time_elapsed'] = 1;

		// What we need to update?
		$values['new_upload'] = max($_REQUEST['uploaded'] - $row['uploaded'], 0);
		$values['new_download'] = max($_REQUEST['downloaded'] - $row['downloaded'], 0);

		// How fast?
		$values['upload_rate'] = $values['new_upload'] / $values['time_elapsed'];
		$values['download_rate'] = $values['new_download'] / $values['time_elapsed'];

		// TODO: Move these directy to memberUpdate query?
		if ($values['upload_rate'] > 0)
			$memberUpdates['ulrate_max'] = "IF(ulrate_max < {float:upload_rate}, {float:upload_rate}, ulrate_max)";

		if ($values['download_rate'] > 0)
			$memberUpdates['dlrate_max'] = "IF(dlrate_max < {float:download_rate}, {float:download_rate}, dlrate_max)";

		$user_info['previous_mode'] = $row['download_left'] == 0 ? 'seeders' : 'leechers';

		// Torrent is stopping
		if ($_REQUEST['event'] == 'stopped')
		{
			$smcFunc['db_query']('', '
				DELETE FROM {db_prefix}tracker_peers
				WHERE peer_id = {string:peer_id}
					AND id_torrent = {int:torrent}
					AND id_member = {int:member}',
				$values
			);

			//$updatePeers = true;

			$torrentUpdates[$user_info['previous_mode']] = "$user_info[previous_mode] - 1";
			$memberUpdates['active_' . $user_info['previous_mode']] = "active_$user_info[previous_mode] - 1";
		}
		else
		{
			if ($user_info['previous_mode'] != $user_info['current_mode'])
			{
				$torrentUpdates[$user_info['previous_mode']] = "$user_info[previous_mode] - 1";
				$memberUpdates['active_' . $user_info['previous_mode']] = "active_$user_info[previous_mode] - 1";

				$torrentUpdates[$user_info['current_mode']] = "$user_info[current_mode] + 1";
				$memberUpdates['active_' . $user_info['current_mode']] = "active_$user_info[current_mode] + 1";
			}

			$smcFunc['db_query']('', '
				UPDATE {db_prefix}tracker_peers
				SET
					last_action = {int:time_now},
					event = {string:event},
					download_left = {float:download_left},
					downloaded = {float:downloaded},
					uploaded = {float:uploaded},
					ulrate = {float:upload_rate},
					dlrate = {float:download_rate},
					ulrate_max = IF(ulrate_max < {float:upload_rate}, {float:upload_rate}, ulrate_max),
					dlrate_max = IF(dlrate_max < {float:download_rate}, {float:download_rate}, dlrate_max)
				WHERE peer_id = {string:peer_id}
					AND id_torrent = {int:torrent}
					AND id_member = {int:member}',
				$values
			);
		}
	}
	// It's new peer (or old whose connection has dropped)
	elseif ($_REQUEST['event'] != 'stopped')
	{
		$torrentUpdates[$user_info['current_mode']] = "$user_info[current_mode] + 1";
		$memberUpdates['active_' . $user_info['current_mode']] = "active_$user_info[current_mode] + 1";

		$smcFunc['db_insert']('insert',
			'{db_prefix}tracker_peers',
			array(
				'id_torrent' => 'int',
				'id_member' => 'int',
				'peer_id' => 'string',
				'agent' => 'string-60',
				'ip' => 'string-15',
				'port' => 'int',
				'last_action' => 'int',
				'event' => 'string-10',
				'download_left' => 'float',
				'downloaded' => 'float',
				'uploaded' => 'float',
				'ulrate_max' => 'float',
				'dlrate_max' => 'float',
				'ulrate' => 'float',
				'dlrate' => 'float',
			),
			array(
				$torrent['id'],
				$user_info['id'],
				$user_info['peer_id'],
				!empty($_SERVER['HTTP_USER_AGENT']) ? (string) $_SERVER['HTTP_USER_AGENT'] : '',
				$user_info['ip'],
				$_REQUEST['port'],
				$values['time_now'],
				$values['event'],
				$values['download_left'],
				$values['downloaded'],
				$values['uploaded'],
				0,
				0,
				0,
				0,
			),
			array('peer_id', 'id_member', 'id_torrent')
		);
	}

	updateTorrentAnnounce($torrent, $values, $torrentUpdates, $updatePeers);

	// Stats table
	$request = $smcFunc['db_query']('', '
		SELECT start_time, complete_time
		FROM {db_prefix}tracker_downloaders
		WHERE id_torrent = {int:torrent}
			AND id_member = {int:member}', $values);
	
	$row = $smcFunc['db_fetch_assoc']($request);
	$smcFunc['db_free_result']($request);

	if (!$row)
	{
		// Updates many fields that shouldnd be 0 in case of data has been cleared by stupid admin?
		$smcFunc['db_insert']('insert',
			'{db_prefix}tracker_downloaders',
			array(
				'id_torrent' => 'int',
				'id_member' => 'int',
				'start_time' => 'int',
				'last_action' => 'int',
				'seed_time' => 'int',
				'leech_time' => 'int',
				'download_left' => 'float',
				'downloaded' => 'float',
				'uploaded' => 'float',
				'complete_time' => 'int',
			),
			array(
				$torrent['id'],
				$user_info['id'],
				$time,
				$time,
				$user_info['is_seeder'] ? $values['time_elapsed'] : 0,
				!$user_info['is_seeder'] ? $values['time_elapsed'] : 0,
				$values['download_left'],
				$values['new_download'],
				$values['new_upload'],
				$user_info['is_seeder'] ? time() : 0,
			),
			array('id_torrent', 'id_member')
		);
	}
	else
	{
		if ($row['start_time'] == 0)
			$downloadUpdates['start_time'] = $time;

		if ($row['complete_time'] == 0 && $user_info['is_seeder'])
			$downloadUpdates['complete_time'] = $time;

		// There's many dynamic fields
		$values['download_updates'] = '';
		if (!empty($downloadUpdates))
		{
			foreach ($downloadUpdates as $column => $value)
				$values['download_updates'] .= ",
				$column = $value";

			$values['download_updates'] = $smcFunc['db_quote']($values['download_updates'], $values);
		}

		$values['timefield'] = $user_info['is_seeder'] ? 'seed_time' : 'leech_time';

		$smcFunc['db_query']('', '
			UPDATE {db_prefix}tracker_downloaders
			SET
				downloaded = downloaded + {float:new_download},
				uploaded = uploaded + {float:new_upload},
				download_left = IF(download_left < {float:download_left}, download_left, {float:download_left}),
				{raw:timefield} = {raw:timefield} + {int:time_elapsed}{raw:download_updates}
			WHERE id_torrent = {int:torrent}
				AND id_member = {int:member}',
			$values
		);

		unset($values['download_updates'], $downloadUpdates);
	}

	// There's many dynamic fields
	$values['member_updates'] = '';
	if (!empty($memberUpdates))
	{
		foreach ($memberUpdates as $column => $value)
			$values['member_updates'] .= ",
			$column = $value";

		$values['member_updates'] = $smcFunc['db_quote']($values['member_updates'], $values);
	}

	$smcFunc['db_query']('', '
		UPDATE {db_prefix}members
		SET
			downloaded = downloaded + {float:new_download},
			uploaded = uploaded + {float:new_upload}{raw:member_updates}
		WHERE id_member = {int:member}',
		$values
	);

	// Bye! Bye!
	unset($values['member_updates'], $memberUpdates);

	// Delete old peers!
	if (empty($modSettings['peersTime']) || time() - $modSettings['peersTime'] > $modSettings['trackerCleanInterval'])
	{
		// This will make it less likely for multiple updates
		updateSettings(array('peersTime' => time()));
		cleanOldPeers(4200);
	}

	// If stopped then we don't need to give more peers
	if ($_REQUEST['event'] == 'stopped')
	{
		btOutput(array(
			'complete' => (int) $torrent['seeders'],
			'incomplete' => (int) $torrent['leechers'],
			'interval' => (int) $modSettings['trackerInterval'],
			'min interval' => (int) $modSettings['trackerMinInterval'],
			'peers' => array(),
		));
	}

	// Build the output data.
	$values['timelimit'] = time() - 3600;

	if (!$user_info['is_seeder'])
		$where = "id_torrent = {int:torrent}
			AND NOT peer_id = {string:peer_id}
			AND last_action > {int:timelimit}";
	else
		$where = "id_torrent = {int:torrent}
			AND NOT peer_id = {string:peer_id}
			AND last_action > {int:timelimit}
			AND download_left > 0";

	$outdata = array(
		'complete' => (int) $torrent['seeders'],
		'incomplete' => (int) $torrent['leechers'],
		'interval' => (int) $modSettings['trackerInterval'],
		'min interval' => (int) $modSettings['trackerMinInterval'],
		'peers' => getPeerlist(
			$where,
			!isset($_REQUEST['compact']) ? true : !empty($_REQUEST['compact']),
			$values),
	);

	btOutput($outdata);
}

function updateTorrentAnnounce($torrent, $values, $torrentUpdates, $updatePeers)
{
	global $smcFunc;

	if ($updatePeers)
	{
		$request = $smcFunc['db_query']('', '
			SELECT DISTINCT id_member
			FROM {db_prefix}tracker_peers
			WHERE last_action < {int:time_limit}
				AND id_torrent = {int:torrent}',
			array(
				'time_limit' => time() - 4200,
				'torrent' => $values['torrent']
			)
		);

		while ($row = $smcFunc['db_fetch_assoc']($request))
			memberStatUpdate($row['id_member']);
		$smcFunc['db_free_result']($request);

		$smcFunc['db_query']('', '
			DELETE FROM {db_prefix}tracker_peers
			WHERE last_action < {int:time_limit}
				AND id_torrent = {int:torrent}',
			array(
				'time_limit' => time() - 4200,
				'torrent' => $values['torrent']
			)
		);

		$request = $smcFunc['db_query']('', '
			SELECT COUNT(*)
			FROM {db_prefix}tracker_peers
			WHERE download_left = 0
			AND id_torrent = {int:torrent}',
			array(
				'torrent' => $values['torrent']
			)
		);

		list ($torrentUpdates['seeders']) = $smcFunc['db_fetch_row']($request);
		$smcFunc['db_free_result']($request);

		$request = $smcFunc['db_query']('', '
			SELECT COUNT(*)
			FROM {db_prefix}tracker_peers
			WHERE download_left > 0
			AND id_torrent = {int:torrent}',
			array(
				'torrent' => $values['torrent']
			)
		);
		list ($torrentUpdates['leechers']) = $smcFunc['db_fetch_row']($request);
		$smcFunc['db_free_result']($request);
	}

	// There's many dynamic fields
	$values['torrent_updates'] = '';
	if (!empty($torrentUpdates))
	{
		foreach ($torrentUpdates as $column => $value)
			$values['torrent_updates'] .= ",
			$column = $value";

		$values['torrent_updates'] = $smcFunc['db_quote']($values['torrent_updates'], $values);
	}

	$smcFunc['db_query']('', '
		UPDATE {db_prefix}tracker_torrents
		SET
			last_action = {int:time_now},
			transfer = transfer + {float:new_upload}{raw:torrent_updates}
		WHERE id_torrent = {int:torrent}',
		$values
	);

	// Bye! Bye!
	unset($values['torrent_updates']);
}
?>