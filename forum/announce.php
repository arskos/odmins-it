<?php
/**********************************************************************************
* announce.php                                                                    *
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

define('SMF_TORRENT_SKIP_QS', true);
define('IN_TRACKER', true);

require_once('SSI.php');

require_once($sourcedir . '/Subs-Tracker.php');
require_once($sourcedir . '/Announce.php');
require_once($sourcedir . '/Scrape.php');
loadClassFile('BEncode.php');

if (get_magic_quotes_gpc() != 0)
	$_GET = stripslashes__recursive($_GET);

// Some clients may send invalid query
if (isset($_GET['p']) && is_string($_GET['p']) && strpos($_GET['p'], '?') !== false)
{
	$temp = explode('?', $_GET['p'], 2);
	$_GET['p'] = $temp[0];

	@list ($key, $val) = @explode('=', $temp[1], 2);
	if (!isset($_GET[$key]))
		$_GET[$key] = $val;

	unset($temp);
}

// BT doesn't use post
$_REQUEST = $_GET;

// Make sure we know the URL of the current request.
$_SERVER['REQUEST_URL'] = $_SERVER['REQUEST_URI'];

loadLanguage('Tracker');

if (!empty($maintenance))
	btFatalError($mtitle . ':' . $mmessage);
elseif (empty($modSettings['enableTracker']))
	btFatalError($txt['tracker_disabled']);

if (!defined('scrape') && !isset($_REQUEST['scrape']))
	AnnounceMain();
else
	ScrapeMain();

btFatalError($txt['invalid_request']);

?>