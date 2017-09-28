<?php
/**********************************************************************************
* Scrape.php                                                                      *
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

function ScrapeMain()
{
	global $smcFunc, $modSettings, $txt, $user_info;

	if (!empty($modSettings['scrapePasskey']) && empty($user_info['id']))
		btFatalError($txt['tracker_not_authorized']);

	parse_str(str_replace('info_hash=', 'info_hash[]=', $_SERVER['QUERY_STRING']), $info_hash);

	if (isset($info_hash['info_hash']))
	{
		$info_hash = $info_hash['info_hash'];

		if (!is_array($info_hash))
			$info_hash = array($info_hash);

		foreach ($info_hash as $i => $h)
			$info_hash[$i] = bin2hex($h);
	}

	if (!empty($info_hash))
		$where = 'info_hash IN({array_string:info_hash})';

	$request = $smcFunc['db_query']('', '
		SELECT torrentname, seeders, leechers, downloads, info_hash
		FROM {db_prefix}tracker_torrents' . (isset($where) ? '
		WHERE ' . $where : ''),
		array(
			'info_hash' => $info_hash
		)
	);

	$outdata = array(
		'files' => array(),
	);

	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		$outdata['files'][hex2bin($row['info_hash'])] = array(
			'complete' => (int) $row['seeders'],
			'downloaded' => (int) $row['downloads'],
			'incomplete' => (int) $row['leechers'],
			'name' => $row['torrentname'],
		);
	}
	$smcFunc['db_free_result']($request);

	btOutput($outdata, 'resp');
}

?>