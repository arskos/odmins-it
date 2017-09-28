<?php
// Version: 2.0 RC2; index

/*	This template is, perhaps, the most important template in the theme. It
	contains the main template layer that displays the header and footer of
	the forum, namely with main_above and main_below. It also contains the
	menu sub template, which appropriately displays the menu; the init sub
	template, which is there to set the theme up; (init can be missing.) and
	the linktree sub template, which sorts out the link tree.

	The init sub template should load any data and set any hardcoded options.

	The main_above sub template is what is shown above the main content, and
	should contain anything that should be shown up there.

	The main_below sub template, conversely, is shown after the main content.
	It should probably contain the copyright statement and some other things.

	The linktree sub template should display the link tree, using the data
	in the $context['linktree'] variable.

	The menu sub template should display all the relevant buttons the user
	wants and or needs.

	For more information on the templating system, please see the site at:
	http://www.simplemachines.org/
*/

// Initialize the template... mainly little settings.
function template_init()
{
	global $context, $settings, $options, $txt;

	/* Use images from default theme when using templates from the default theme?
		if this is 'always', images from the default theme will be used.
		if this is 'defaults', images from the default theme will only be used with default templates.
		if this is 'never' or isn't set at all, images from the default theme will not be used. */
	$settings['use_default_images'] = 'never';

	/* What document type definition is being used? (for font size and other issues.)
		'xhtml' for an XHTML 1.0 document type definition.
		'html' for an HTML 4.01 document type definition. */
	$settings['doctype'] = 'xhtml';

	/* The version this template/theme is for.
		This should probably be the version of SMF it was created for. */
	$settings['theme_version'] = '2.0 RC2';

	/* Set a setting that tells the theme that it can render the tabs. */
	$settings['use_tabs'] = true;

	/* Use plain buttons - as oppossed to text buttons? */
	$settings['use_buttons'] = true;

	/* Show sticky and lock status separate from topic icons? */
	$settings['separate_sticky_lock'] = true;

	/* Does this theme use the strict doctype? */
	$settings['strict_doctype'] = false;

	/* Does this theme use post previews on the message index? */
	$settings['message_index_preview'] = false;
	
	/* Set the following variable to true if this theme requires the optional theme strings file to be loaded. */
	$settings['require_theme_strings'] = false;
}

// The main sub template above the content.
function template_html_above()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	// Show right to left and the character set for ease of translating.
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"', $context['right_to_left'] ? ' dir="rtl"' : '', '><head>
	<meta http-equiv="Content-Type" content="text/html; charset=', $context['character_set'], '" />
	<meta name="description" content="', $context['page_title_html_safe'], '" />
	<meta name="keywords" content="', $context['meta_keywords'], '" />
	<script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/scripts/script.js?rc2"></script>
	<script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/scripts/theme.js?rc2"></script>
	<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
		var smf_theme_url = "', $settings['theme_url'], '";
		var smf_default_theme_url = "', $settings['default_theme_url'], '";
		var smf_images_url = "', $settings['images_url'], '";
		var smf_scripturl = "', $scripturl, '";
		var smf_iso_case_folding = ', $context['server']['iso_case_folding'] ? 'true' : 'false', ';
		var smf_charset = "', $context['character_set'], '";', $context['show_pm_popup'] ? '
		if (confirm("' . $txt['show_personal_messages'] . '"))
			window.open(smf_prepareScriptUrl(smf_scripturl) + "action=pm");' : '', '
		var ajax_notification_text = "', $txt['ajax_in_progress'], '";
		var ajax_notification_cancel_text = "', $txt['modify_cancel'], '";
	// ]]></script>
	<title>', $context['page_title_html_safe'], '</title>';
        echo '
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/css/print.css?rc2" media="print" />
 <link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/css/onetruelayout1.css" />';
// Load the mootools.js and the fancymenu.js
	echo'
	<script language="JavaScript" type="text/javascript" src="', $settings['theme_url'], '/scripts/mootools.js"></script>
                  <script language="JavaScript" type="text/javascript" src="', $settings['theme_url'], '/scripts/menu.js"></script>
                  <script language="JavaScript" type="text/javascript" src="', $settings['theme_url'], '/scripts/main.js"></script>';
	// Please don't index these Mr Robot.
	if (!empty($context['robot_no_index']))
		echo '
	<meta name="robots" content="noindex" />';

	// Present a canonical url for search engines to prevent duplicate content in their indices.
	if (!empty($context['canonical_url']))
		echo '
	<link rel="canonical" href="', $context['canonical_url'], '" />';

	// The ?rc2 part of this link is just here to make sure browsers don't cache it wrongly.
	echo '
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/css/index.css" />
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/css/print.css?rc2" media="print" />';

	// Show all the relative links, such as help, search, contents, and the like.
	echo '
	<link rel="help" href="', $scripturl, '?action=help" />
	<link rel="search" href="', $scripturl, '?action=search" />
	<link rel="contents" href="', $scripturl, '" />';

	// If RSS feeds are enabled, advertise the presence of one.
	if (!empty($modSettings['xmlnews_enable']) && (!empty($modSettings['allow_guestAccess']) || $context['user']['is_logged']))
		echo '
	<link rel="alternate" type="application/rss+xml" title="', $context['forum_name_html_safe'], ' - ', $txt['rss'], '" href="', $scripturl, '?type=rss;action=.xml" />';

	// If we're viewing a topic, these should be the previous and next topics, respectively.
	if (!empty($context['current_topic']))
		echo '
	<link rel="prev" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=prev" />
	<link rel="next" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=next" />';

	// If we're in a board, or a topic for that matter, the index will be the board's index.
	if (!empty($context['current_board']))
		echo '
	<link rel="index" href="', $scripturl, '?board=', $context['current_board'], '.0" />';

	// IE7 needs some fixes for styles.
	if ($context['browser']['is_ie7'])
		echo '
	<link rel="stylesheet" type="text/css" href="',  $settings['theme_url'], '/css/ie7.css" />';
	// ..and IE6!
	elseif ($context['browser']['is_ie6'])
		echo '
	<link rel="stylesheet" type="text/css" href="',  $settings['theme_url'], '/css/ie6.css" />';
	// Firefox - all versions - too!
	elseif ($context['browser']['is_firefox'])
		echo '
	<link rel="stylesheet" type="text/css" href="',  $settings['theme_url'], '/css/firefox.css" />';
// Firefox - all versions - too!
	elseif ($context['browser']['is_safari'])
		echo '
	<link rel="stylesheet" type="text/css" href="',  $settings['theme_url'], '/css/safari.css" />';
	// RTL languages require an additional stylesheet.
	if ($context['right_to_left'])
		echo '
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/css/rtl.css" />';


	echo '
	<script type="text/javascript" src="', $settings['default_theme_url'], '/scripts/script.js?rc2"></script>
	<script type="text/javascript" src="', $settings['theme_url'], '/scripts/theme.js?rc2"></script>
	<script type="text/javascript"><!-- // --><![CDATA[
		var smf_theme_url = "', $settings['theme_url'], '";
		var smf_default_theme_url = "', $settings['default_theme_url'], '";
		var smf_images_url = "', $settings['images_url'], '";
		var smf_scripturl = "', $scripturl, '";
		var smf_iso_case_folding = ', $context['server']['iso_case_folding'] ? 'true' : 'false', ';
		var smf_charset = "', $context['character_set'], '";', $context['show_pm_popup'] ? '
		var fPmPopup = function ()
		{
			if (confirm("' . $txt['show_personal_messages'] . '"))
				window.open(smf_prepareScriptUrl(smf_scripturl) + "action=pm");
		}
		addLoadEvent(fPmPopup);' : '', '
		var ajax_notification_text = "', $txt['ajax_in_progress'], '";
		var ajax_notification_cancel_text = "', $txt['modify_cancel'], '";
	// ]]></script>';

	// Output any remaining HTML headers. (from mods, maybe?)
	echo $context['html_headers'];

	echo '
</head>
<body>';
}

function template_body_above()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;
	echo $context['tapatalk_body_hook'];


echo '
		 <div id="header">
		  <div id="head-l">
			<div id="head-r"><div class="ista1"><img src="',$settings['images_url'], '/ista1.png" alt="" /></div><div class="ista2">&nbsp;&nbsp;<img src="',$settings['images_url'], '/mem.png" alt="" width="14px" height="15px" />&nbsp;' . $txt['latest_member']  , ':&nbsp;', ($settings['show_latest_member'] ? ' <b>' . $context['common_stats']['latest_member']['link'] . '</b>': ''), '
</div><div class="ista3"><img src="',$settings['images_url'], '/cizgi.png" alt="" /></div><div class="ista4"><img src="',$settings['images_url'], '/ista2.png" alt="" /></div><div class="ista5">&nbsp;&nbsp;<img src="',$settings['images_url'], '/pos.png" alt="" width="14px" height="15px" />&nbsp;', $txt['topics'], ': ', $context['common_stats']['total_topics'], '&nbsp;&nbsp;<img src="',$settings['images_url'], '/pos.png" alt="" width="14px" height="14px" />&nbsp;', $txt['posts_made'], ': ', $context['common_stats']['total_posts'], '
</div><div class="ista6"><img src="',$settings['images_url'], '/cizgi.png" alt="" /></div><div class="ista7"><img src="',$settings['images_url'], '/ista3.png" alt="" /></div><div class="ista8">&nbsp;&nbsp;<img src="',$settings['images_url'], '/tot.png" alt="" width="14px" height="14px" />&nbsp;', $txt['members'], ': ', $context['common_stats']['total_members'], '
</div><div style="padding-top:160px;padding-right:480px;float:right;">';if (!empty($context['user']['avatar']))
	{	echo '
					 <img src="', $context['user']['avatar']['href'], '" alt="" height="68" />';}elseif ($context['user']['is_guest']) {
                echo '<img src="', $settings['images_url'], '/avatar.gif" alt="" />';} 
	  elseif ($context['user']['is_logged']) {
                echo ' <img src="', $settings['images_url'], '/avatar.gif" alt="" />';} 
echo'</div><div id="userarea" style="padding-top:130px;">	';	
	// If the user is logged in, display stuff like their name, new messages, etc.
	if ($context['user']['is_logged'])
	{
		echo '', $txt['hello_member_ndt'], ' <span>', $context['user']['name'], '</span><br/>
			 <a href="', $scripturl, '?action=unread">', $txt['unread_since_visit'], '</a> <br />
			 <a href="', $scripturl, '?action=unreadreplies">', $txt['show_unread_replies'], '</a><br />';

	}
	// Otherwise they're a guest - send them a lovely greeting...
	else
		echo sprintf($txt['welcome_guest'], $txt['guest_title']);

	// Now, onto our second set of info, are they logged in again?
	if ($context['user']['is_logged'])
	{
		// Is the forum in maintenance mode?
		if ($context['in_maintenance'] && $context['user']['is_admin'])
			echo '
				<b>', $txt['maintain_mode_on'], '</b><br />';

		// Are there any members waiting for approval?
		if (!empty($context['unapproved_members']))
			echo '
				', $context['unapproved_members'] == 1 ? $txt['approve_thereis'] : $txt['approve_thereare'], ' <a href="', $scripturl, '?action=admin;area=viewmembers;sa=browse;type=approve">', $context['unapproved_members'] == 1 ? $txt['approve_member'] : $context['unapproved_members'] . ' ' . $txt['approve_members'], '</a> ', $txt['approve_members_waiting'], '<br />';

		// Show the total time logged in?
		if (!empty($context['user']['total_time_logged_in']))
		{
			echo '
				', $txt['totalTimeLogged1'], '<br />';

			// If days is just zero, don't bother to show it.
			if ($context['user']['total_time_logged_in']['days'] > 0)
				echo $context['user']['total_time_logged_in']['days'] . $txt['totalTimeLogged2'];

			// Same with hours - only show it if it's above zero.
			if ($context['user']['total_time_logged_in']['hours'] > 0)
				echo $context['user']['total_time_logged_in']['hours'] . $txt['totalTimeLogged3'];

			// But, let's always show minutes - Time wasted here: 0 minutes ;).
			echo $context['user']['total_time_logged_in']['minutes'], $txt['totalTimeLogged4'], '<br /><br />';
		}

		if (!empty($context['open_mod_reports']) && $context['show_open_reports'])
			echo '
				<a href="', $scripturl, '?action=moderate;area=reports">', sprintf($txt['mod_reports_waiting'], $context['open_mod_reports']), '</a><br />';
	}
						// Otherwise they're a guest - this time ask them to either register or login - lazy bums...
						else
						{
						echo '	
                                                <script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/scripts/sha1.js"></script>
			                              <form action="', $scripturl, '?action=login2" method="post" accept-charset="', $context['character_set'], '" style="margin: 4px 0;"', empty($context['disable_login_hashing']) ? ' onsubmit="hashLoginPassword(this, \'' . $context['session_id'] . '\');"' : '', '>
							<div style="width:275px;float:right;"><div style="float:right;">	<div id="ds-usernme"><input id="usrnme" type="text" name="user" value="Username" onblur="if(this.value==\'\') this.value=\'Username\';" onfocus="if(this.value==\'Username\') this.value=\'\';" /> 
</div>
								<div id="ds-passwrd"><input id="psswrd" type="password" name="passwrd" value="password" onblur="if(this.value==\'\') this.value=\'password\';" onfocus="if(this.value==\'password\') this.value=\'\';" />
</div></div><br/>	<div style="margin-top:20px;"><div id="ds-forever" style="padding-top:9px;padding-right:3px;">	<select name="cookielength" id="droplogin">
						<option value="60">', $txt['one_hour'], '</option>
						<option value="1440">', $txt['one_day'], '</option>
						<option value="10080">', $txt['one_week'], '</option>
						<option value="43200">', $txt['one_month'], '</option>
						<option value="-1" selected="selected">', $txt['forever'], '</option>
					</select></div>
								<input id="loginbutton" type="submit" value="', $txt['login'], '"/>
								<input type="hidden" name="cookielength" value="-1" /></div></div>
							</form><br />';


						}


				echo '<div style="width:260px;float:right;position:absolute;top:215px;right:155px;"> ', $txt['news'], '<br/>
', $context['random_news_line'], ' 

			</div></div>
							<div id="logo">';if (empty($settings['header_logo_url']))
			echo '<a href="', $scripturl, '">
<img src="' , $settings['images_url'] , '/logo.png" alt="', $context['forum_name_html_safe'], '" /></a>
		';
	else
		echo '
					<a href="', $scripturl, '"><img src="', $settings['header_logo_url'], '" alt="', $context['forum_name_html_safe'], '" /></a>'; echo'</div>';
				echo '
				  </div>		 
			  </div>
			</div>

		  <div id="nav"><div id="fancymenu">',template_menu(),'</div>
	 </div>
		';		echo'

 <div id="searcharea">
		 <form action="', $scripturl, '?action=search2" method="post" accept-charset="', $context['character_set'], '" style="margin: 0;">
		 <input class="inputbox" type="text" name="search" value="', $txt['search'], ' ..." onfocus="this.value = \'\';" onblur="if(this.value==\'\') this.value=\'', $txt['search'], '...\';" /> 
		 <input class="submitbox" type="submit" name="submit" value="', $txt['go'], '" />
		 <input type="hidden" name="advanced" value="0" />';

		 // Search within current topic?
			if (!empty($context['current_topic']))
			 echo '
			<input type="hidden" name="topic" value="', $context['current_topic'], '" />';

		 // If we're on a certain board, limit it to this board ;).
			 elseif (!empty($context['current_board']))
			 echo '
			<input type="hidden" name="brd[', $context['current_board'], ']" value="', $context['current_board'], '" />';
	echo '
		</form></div>
		
		 <div id="mainarea">
';// Show the navigation tree.
		theme_linktree2();
}

function template_body_below()
{
	global $context, $settings, $options, $scripturl, $txt;

	echo '
';

		// Show the "Powered by" and "Valid" logos, as well as the copyright. Remember, the copyright must be somewhere!
	echo '
		</div>  <div id="footer">
		    <div id="footer-l">
			 <div id="footer-r">
		          <div id="footerarea">
				', theme_copyright(), '<br/>
<font color="#757575">      Warex theme Coded by </font> <a href="http://www.smfyoo.com" style="color:#9ca517;" title="smfyoo" target="_blank"><img src="' , $settings['images_url'] , '/yoo.png" alt="Smfyoo Team" height="30"/></a> <font color="#757575">and Designed by </font> <a href="http://www.ajansretro.com" style="color:#9ca517;" title="sencerbugrahan" target="_blank"><img src="' , $settings['images_url'] , '/sencerbugrahan.png" alt="sencerbugrahan" height="30"/></a> 
<div style="float:right;padding-right:20px;margin-top:10px;" class="ieduzen">
<a title="w3 xhtml verified" href="http://validator.w3.org/check?uri=referer" target="-blank"><img src="' , $settings['images_url'] , '/xhtml.png" alt="xhtml valid" /></a>&nbsp;<a title="w3 css verified" href="http://jigsaw.w3.org/css-validator/check/referer" target="-blank"><img src="' , $settings['images_url'] , '/css.png" alt="css valid" /></a>&nbsp;<a title="w3 tableless verified" href="http://w3tableless.com?uri=" target="-blank"><img src="' , $settings['images_url'] , '/tableless.png" alt="css valid" /></a></div>

                       </div>';

		// Show the load time?
		if ($context['show_load_time'])
			echo '<br />'. $txt['page_created'], $context['load_time'], $txt['seconds_with'], $context['load_queries'], $txt['queries'], '';

	echo '
                </div>
		</div>
	</div> ';
}

function template_html_below()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;
	
	// HS4SMF enable footer
	if (!empty($modSettings['hs4smf_enabled'])) 
		echo hs4smf_prepare_footer();
	

echo '
</body></html>';
}

// Show a linktree. This is that thing that shows "My Community | General Category | General Discussion"..
function theme_linktree()
{

}
// Show a linktree2. This is that thing that shows "My Community | General Category | General Discussion"..
function theme_linktree2()
{
global $context, $settings, $options;

echo '<div class="nav" style="font-size: normal; margin-top:45px;margin-bottom: 10px;">';

// Each tree item has a URL and name. Some may have extra_before and extra_after.
foreach ($context['linktree'] as $link_num => $tree)
{
// Show something before the link?
if (isset($tree['extra_before']))
echo $tree['extra_before'];

// Show the link, including a URL if it should have one.
echo '<b>', $settings['linktree_link'] && isset($tree['url']) ? '<a href="' . $tree['url'] . '" class="nav">' . $tree['name'] . '</a>' : $tree['name'], '</b>';

// Show something after the link...?
if (isset($tree['extra_after']))
echo $tree['extra_after'];

// Don't show a separator for the last one.
if ($link_num != count($context['linktree']) - 1)
echo '&nbsp;|&nbsp;';
}

echo '</div>';
}


// Show the menu up top. Something like [home] [help] [profile] [logout]...
function template_menu()
{
	global $context, $settings, $options, $scripturl, $txt;

	echo '
		<ul>';

	foreach ($context['menu_buttons'] as $act => $button)
	{		
		echo '
			<li', $button['active_button'] ? ' class="current"' : '', '><a title="', $act, '" href="', $button['href'], '">' ,$button['title'], '</a></li>';
	}

	echo '
	</ul>';

}

// Generate a strip of buttons.
function template_button_strip($button_strip, $direction = 'top', $force_reset = false, $custom_td = '')
{
	global $settings, $context, $txt, $scripturl;

	// Create the buttons...
	$buttons = array();
	foreach ($button_strip as $key => $value)
	{
		if (!isset($value['test']) || !empty($context[$value['test']]))
			$buttons[] = '<a href="' . $value['url'] . '" ' . (isset($value['custom']) ? $value['custom'] : '') . '><span>' . $txt[$value['text']] . '</span></a>';
	}

	if (empty($buttons))
		return '';

	// Make the last one, as easy as possible.
	$buttons[count($buttons) - 1] = str_replace('<span>', '<span class="last">', $buttons[count($buttons) - 1]);

	echo '
		<div class="buttonlist', $direction != 'top' ? '_bottom' : '', '">
			<ul class="clearfix">
				<li>', implode('</li><li>', $buttons), '</li>
			</ul>
		</div>';

}

?>