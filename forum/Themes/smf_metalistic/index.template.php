<?php
// Version: 1.0; index

/*	This template is, perhaps, the most important template in the theme.  It
	contains the main template layer that displays the header and footer of
	the forum, namely with main_above and main_below.  It also contains the
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
}

// The main sub template above the content.
function template_main_above()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;



	// Show right to left and the character set for ease of translating.
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html', $context['right_to_left'] ? ' dir="rtl"' : '', '><head>
	<meta http-equiv="Content-Type" content="text/html; charset=', $context['character_set'], '" />
	<meta name="description" content="', $context['page_title'], '" />
	<meta name="keywords" content="PHP, MySQL, bulletin, board, free, open, source, smf, simple, machines, forum" />
	<script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/script.js"></script>
	<script language="JavaScript" type="text/javascript"><!--
		var smf_theme_url = "', $settings['theme_url'], '";
		var smf_images_url = "', $settings['images_url'], '";
	// --></script>
	<title>', $context['page_title'], '</title>';

	// This is here because Gecko browsers properly support white-space....
	if ($context['browser']['is_gecko'])
		echo '
	<style type="text/css"><!--
		.code
		{
			white-space: pre;
		}
	--></style>';

	echo '
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/style.css" />';

	/* Internet Explorer 4/5 and Opera 6 just don't do font sizes properly. (they are big...)
		Thus, in Internet Explorer 4, 5, and Opera 6 this will show fonts one size smaller than usual.
		Note that this is affected by whether IE 6 is in standards compliance mode.. if not, it will also be big.
		Standards compliance mode happens when you use xhtml... */
	if ($context['browser']['needs_size_fix'])
		echo '
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/fonts-compat.css" />';

	// Show all the relative links, such as help, search, contents, and the like.
	echo '
	<link rel="help" href="', $scripturl, '?action=help" target="_blank" />
	<link rel="search" href="' . $scripturl . '?action=search" />
	<link rel="contents" href="', $scripturl, '" />';

	// If we're viewing a topic, these should be the previous and next topics, respectively.
	if (!empty($context['current_topic']))
		echo '
	<link rel="prev" href="' . $scripturl . '?action=;topic=' . $context['current_topic'] . '.0;prev_next=prev" />
	<link rel="next" href="' . $scripturl . '?action=;topic=' . $context['current_topic'] . '.0;prev_next=next" />';

	// If we're in a board, or a topic for that matter, the index will be the board's index.
	if (!empty($context['current_board']))
		echo '
	<link rel="index" href="' . $scripturl . '?action=;board=' . $context['current_board'] . '.0" />';

	// We'll have to use the cookie to remember the header...
	if ($context['user']['is_guest'])
		$options['collapse_header'] = !empty($_COOKIE['upshrink']);

	// Output any remaining HTML headers. (from mods, maybe?)
	echo $context['html_headers'], '
		  <script language="JavaScript" type="text/javascript"><!--
					 var current_rightbar = ', empty($options['collapse_rightbar']) ? 'false' : 'true', ';

					 function shrinkHeaderRightbar(mode)
					 {';

		  // Guests don't have theme options!!
		  if ($context['user']['is_guest'])
					 echo '
								document.cookie = "upshrink=" + (mode ? 1 : 0);';
		  else
					 echo '
								document.getElementById("upshrinkTempRightbar").src = "', $scripturl, '?action=jsoption;var=collapse_rightbar;val=" + (mode ? 1 : 0) + ";sesc=', $context['session_id'], ';" + (new Date().getTime());';

		  echo '
								document.getElementById("upshrinkRightbar").src = smf_images_url + (mode ? "/upshrink2.gif" : "/upshrink.gif");

								document.getElementById("rightbarHeader").style.display = mode ? "none" : "";

								current_rightbar = mode;
					 }
		 // --></script>

	<script language="JavaScript" type="text/javascript"><!--
		var current_header = ', empty($options['collapse_header']) ? 'false' : 'true', ';

		function shrinkHeader(mode)
		{';

	// Guests don't have theme options!!
	if ($context['user']['is_guest'])
		echo '
			document.cookie = "upshrink=" + (mode ? 1 : 0);';
	else
		echo '
			document.getElementById("upshrinkTemp").src = "', $scripturl, '?action=jsoption;var=collapse_header;val=" + (mode ? 1 : 0) + ";sesc=', $context['session_id'], ';" + (new Date().getTime());';

	echo '
			document.getElementById("upshrink").src = smf_images_url + (mode ? "/upshrink2.gif" : "/upshrink.gif");

			document.getElementById("upshrinkHeader").style.display = mode ? "none" : "";

			current_header = mode;
		}
	// --></script>
</head>
<body>';


	// The logo, user information, news, and menu.
	echo '

<table width="800"  border="0" cellpadding="0" cellspacing="0">
  <tr>
	 <td width="0" height="0" align="left" valign="top"><img src="' . $settings['images_url'] . '/blank.gif" width="0" height="0" alt=" " border="0" /></td>
	 <td width="100%" style="background-image:url(' . $settings['images_url'] . '/blank.gif)" valign="middle"></td>
	 <td width="0" height="0" align="right" valign="top"><img src="' . $settings['images_url'] . '/blank.gif" width="0" height="0" alt=" " border="0" /></td>
  </tr>
</table>

<table cellspacing="1" cellpadding="0" class="bordercolor" align="center" width="800">
  <tr colspan="3">
	 <td style="background-color: transparent;" width="0%" valign="top"></td>
	 <td class="windowbg3" valign="top">';	
	echo '

<br /><table cellspacing="0" cellpadding="0" border="0" align="center" width="800" style="position: relative;">
						<tr>
				<td colspan="2" valign="bottom" style="padding: 5px; white-space: nowrap;">';

	// This part is the logo and forum name.  You should be able to change this to whatever you want...
	echo '
					<div align="center"><img src="', $settings['images_url'], '/logo.gif" width="800" style="float: middle;" alt="" border="#b3b8bc" /></div>';
	echo '
				</td>
			</tr>

		<tr id="upshrinkHeader"', empty($options['collapse_header']) ? '' : ' style="display: none;"', '>
				<td valign="top">

<table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
  <tr>
	 <td width="174" height="29" align="left" valign="top"><img src="' . $settings['images_url'] . '/left.gif" width="174" height="29" alt=" " border="0" /></td>
	 <td width="100%" style="background-image:url(' . $settings['images_url'] . '/middle.gif)" valign="middle"></td>
	 <td width="174" height="29" align="right" valign="top"><img src="' . $settings['images_url'] . '/right.gif" width="174" height="29" alt=" " border="0" /></td>
  </tr>
</table>

<table border="0" align="center" class="bordercolor" width="800" cellspacing="1" cellpadding="4">
		<tr class="catbg" colspan="3">
			<td height="5" colspan="2" valign="middle" align="left">User Info</td>';

	// Show a random news item? (or you could pick one from news_lines...)
	if (!empty($settings['enable_news']))
		echo '
			<td height="5" valign="middle" align="center">News</td>';
echo '
</tr>
		<tr colspan="3">
			<td width="7%" class="windowbg" valign="middle" align="center">';

if ($context['user']['is_guest'] || empty($context['user']['avatar']['image']))
			echo '<img src="' . $settings['images_url'] . '/nophoto.gif" alt="No avatar" title="No avatar" border="0" />';
		else
			echo $context['user']['avatar']['image'];
echo '
</td>
			<td width="60%" class="windowbg2" valign="top" align="left">';

	// If the user is logged in, display stuff like their name, new messages, etc.
	if ($context['user']['is_logged'])
	{
		echo '
				', $txt['hello_member'], ' <b>', $context['user']['name'], '</b>', $context['allow_pm'] ? ', ' . $txt[152] . ' <a href="' . $scripturl . '?action=pm">' . $context['user']['messages'] . ' ' . ($context['user']['messages'] != 1 ? $txt[153] : $txt[471]) . '</a>' . $txt['newmessages4'] . ' ' . $context['user']['unread_messages'] . ' ' . ($context['user']['unread_messages'] == 1 ? $txt['newmessages0'] : $txt['newmessages1']) : '', '.';
				
			// Show the total time logged in?
		if (!empty($context['user']['total_time_logged_in']))
		{
			echo '
							<br />', $txt['totalTimeLogged1'];

			// If days is just zero, don't bother to show it.
			if ($context['user']['total_time_logged_in']['days'] > 0)
				echo $context['user']['total_time_logged_in']['days'] . $txt['totalTimeLogged2'];

			// Same with hours - only show it if it's above zero.
			if ($context['user']['total_time_logged_in']['hours'] > 0)
				echo $context['user']['total_time_logged_in']['hours'] . $txt['totalTimeLogged3'];

			// But, let's always show minutes - Time wasted here: 0 minutes ;).
			echo $context['user']['total_time_logged_in']['minutes'], $txt['totalTimeLogged4'];
		}

		echo '<br />
				<a href="', $scripturl, '?action=unread">', $txt['unread_since_visit'], '</a><br />
					<a href="', $scripturl, '?action=unreadreplies">', $txt['show_unread_replies'], '</a><br />
				 ';
			

		// Are there any members waiting for approval?
		if (!empty($context['unapproved_members']))
			echo '<br />
				', $context['unapproved_members'] == 1 ? $txt['approve_thereis'] : $txt['approve_thereare'], ' <a href="', $scripturl, '?action=regcenter">', $context['unapproved_members'] == 1 ? $txt['approve_member'] : $context['unapproved_members'] . ' ' . $txt['approve_members'], '</a> ', $txt['approve_members_waiting'];

		// Is the forum in maintenance mode?
		if ($context['in_maintenance'] && $context['user']['is_admin'])
			echo '<br />
				<b>', $txt[616], '</b>';
	}
	// Otherwise they're a guest - so politely ask them to register or login.
	else
		echo '
				', $txt['welcome_guest'], '<br />
	<form action="', $scripturl, '?action=login2" method="post" style="margin: 0px 1ex 0px 0; text-align:left;">
								<input type="text" name="user" size="10" /> <input type="password" name="passwrd" size="10" />
								<select name="cookielength">
									<option value="60">', $txt['smf53'], '</option>
									<option value="1440">', $txt['smf47'], '</option>
									<option value="10080">', $txt['smf48'], '</option>
									<option value="302400">', $txt['smf49'], '</option>
									<option value="-1" selected="selected">', $txt['smf50'], '</option>
								</select>
								<input type="submit" value="', $txt[34], '" /><br />
								', $txt['smf52'], '
							</form>';


	echo '
				', $context['current_time'], '

</td>';

	// Show a random news item? (or you could pick one from news_lines...)
	if (!empty($settings['enable_news']))
		echo '
			<td style="padding:3px" class="windowbg" valign="top" align="center">
	  ', $context['random_news_line'], '

		</td>';
echo '
</tr></table>
<table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
  <tr>
	 <td width="15" height="24" align="left" valign="top"><img src="' . $settings['images_url'] . '/b1.gif" width="15" height="24" alt=" " border="0" /></td>
	 <td width="100%" style="background-image:url(' . $settings['images_url'] . '/b.gif)" valign="middle"></td>
	 <td width="15" height="24" align="right" valign="top"><img src="' . $settings['images_url'] . '/b2.gif" width="15" height="24" alt=" " border="0" /></td>
  </tr>
</table>
</td></tr></table>

	<table cellspacing="0" cellpadding="2" border="0" align="center" width="800">
		<tr>
			<td valign="middle" align="center">
';



	// Show the menu here, according to the menu sub template.
	template_menu();

	echo '
			</td>
		</tr></table>';

	echo '


	<br />
	<table cellspacing="0" cellpadding="10" border="0" align="center" width="800">
		<tr><td valign="top">';

	  // The main content should go here.  A table is used because IE 6 just can't handle a div.
		  echo '<div id="bodyarea" style="padding: 10px 8px 0px 8px;">
		  <table width="800" cellpadding="0" cellspacing="0" border="0"><tr>';

}

function template_main_below()
{
	global $context, $settings, $options, $scripturl, $txt;

	echo '</td>
        </tr></table>';

	// Show a vB style login for quick login?
	if ($context['show_vBlogin'])
		echo '
	<table cellspacing="0" cellpadding="0" border="0" align="center" width="800">
		<tr><td nowrap="nowrap" align="right">
			<form action="', $scripturl, '?action=login2" method="post"><br />
				<input type="text" name="user" size="7" />
				<input type="password" name="passwrd" size="7" />
				<select name="cookielength">
					<option value="60">', $txt['smf53'], '</option>
					<option value="1440">', $txt['smf47'], '</option>
					<option value="10080">', $txt['smf48'], '</option>
					<option value="302400">', $txt['smf49'], '</option>
					<option value="-1" selected="selected">', $txt['smf50'], '</option>
				</select>
				<input type="submit" value="', $txt[34], '" /><br />
				', $txt['smf52'], '
			</form>
		</td></tr>
	</table>';
	// Don't show a login box, just a break.
	else
		echo '
	<br />';

echo '

</td>
</tr></table>
<table width="800"  border="0" cellpadding="0" cellspacing="0">
  <tr>
	 <td width="0" height="0" align="left" valign="top"><img src="' . $settings['images_url'] . '/blank.gif" width="0" height="0" alt=" " border="0" /></td>
	 <td width="100%" style="background-image:url(' . $settings['images_url'] . '/blank.gif)" valign="middle"></td>
	 <td width="0" height="0" align="right" valign="top"><img src="' . $settings['images_url'] . '/blank.gif" width="0" height="0" alt=" " border="0" /></td>
  </tr>
</table>';


	// Show the "Powered by" and "Valid" logos, as well as the copyright.  Remember, the copyright must be somewhere!
	echo '
	<br />

	<table cellspacing="0" border="0" align="middle" width="100%">
		<tr>
			<td width="100%" valign="middle" align="center">
				', theme_copyright(), '<br/>Theme Name : Metalistic<br/>Designer : <a href="http://gfxindia.com">Darkman</a><br/>Thanks to FasterPussyCat
			<br />
			</td>
		</tr>
	</table>';

	// Show the load time?
	if ($context['show_load_time'])
		echo '
	<div align="center" class="smalltext"><br />
		', $txt['smf301'], $context['load_time'], $txt['smf302'], $context['load_queries'], $txt['smf302b'], '
	</div>';

	// And then we're done!



	echo '

</body>
</html>';
}

// Show a linktree.  This is that thing that shows "My Community | General Category | General Discussion"..
function theme_linktree()
{
	global $context, $settings, $options;

	// Folder style or inline?  Inline has a smaller font.
	echo '<span class="nav"', $settings['linktree_inline'] ? ' style="font-size: smaller;"' : '', '>';

	// Each tree item has a URL and name.  Some may have extra_before and extra_after.
	foreach ($context['linktree'] as $link_num => $tree)
	{
		// Show the | | |-[] Folders.
		if (!$settings['linktree_inline'])
		{
			if ($link_num > 0)
				echo str_repeat('<img src="' . $settings['images_url'] . '/icons/linktree_main.gif" alt="| " border="0" />', $link_num - 1), '<img src="' . $settings['images_url'] . '/icons/linktree_side.gif" alt="|-" border="0" />';
			echo '<img src="' . $settings['images_url'] . '/icons/folder_open.gif" alt="+" border="0" />&nbsp; ';
		}

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
			echo $settings['linktree_inline'] ? ' &nbsp;|&nbsp; ' : '<br />';
	}

	echo '</span>';
}

// Show the menu up top.  Something like [home] [help] [profile] [logout]...
function template_menu()
{
	global $context, $settings, $options, $scripturl, $txt;

	// Show the [home] and [help] buttons.
		 echo '
							<a href="', $scripturl, '">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/home.gif" alt="' . $txt[103] . '" style="margin: 2px 0;" border="0" />' : $txt[103]), '</a>', $context['menu_separator'];
		 echo '		  <a href="', $scripturl, '?action=help" target="_blank">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/help.gif" alt="' . $txt[119] . '" style="margin: 2px 0;" border="0" />' : $txt[119]), '</a>', $context['menu_separator'];

	// How about the [search] button?
	if ($context['allow_search'])
		echo '
				<a href="', $scripturl, '?action=search">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/search.gif" alt="' . $txt[182] . '" border="0" />' : $txt[182]), '</a>', $context['menu_separator'];

	// Is the user allowed to administrate at all? ([admin])
	if ($context['allow_admin'])
		echo '
				<a href="', $scripturl, '?action=admin">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/admin.gif" alt="' . $txt[2] . '" border="0" />' : $txt[2]), '</a>', $context['menu_separator'];

	// Edit Profile... [profile]
	if ($context['allow_edit_profile'])
		echo '
				<a href="', $scripturl, '?action=profile">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/profile.gif" alt="' . $txt[79] . '" border="0" />' : $txt[467]), '</a>', $context['menu_separator'];

	// The [calendar]!
	if ($context['allow_calendar'])
		echo '
				<a href="', $scripturl, '?action=calendar">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/calendar.gif" alt="' . $txt['calendar24'] . '" border="0" />' : $txt['calendar24']), '</a>', $context['menu_separator'];

	// If the user is a guest, show [login] and [register] buttons.
	if ($context['user']['is_guest'])
	{
		echo '
				<a href="', $scripturl, '?action=login">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/login.gif" alt="' . $txt[34] . '" border="0" />' : $txt[34]), '</a>', $context['menu_separator'], '
				<a href="', $scripturl, '?action=register">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/register.gif" alt="' . $txt[97] . '" border="0" />' : $txt[97]), '</a>';
	}
	// Otherwise, they might want to [logout]...
	else
		echo '
				<a href="', $scripturl, '?action=logout;sesc=', $context['session_id'], '">', ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . $context['user']['language'] . '/logout.gif" alt="' . $txt[108] . '" border="0" />' : $txt[108]), '</a>';

}

// Generate a strip of buttons, out of buttons.
function template_button_strip($button_strip, $direction = 'top', $force_reset = false, $custom_td = '')
{
	global $settings, $buttons, $context, $txt, $scripturl;

	if (empty($button_strip))
		return '';

	// Create the buttons...
	foreach ($button_strip as $key => $value)
	{
		if (isset($value['test']) && empty($context[$value['test']]))
		{
			unset($button_strip[$key]);
			continue;
		}
		elseif (!isset($buttons[$key]) || $force_reset)
			$buttons[$key] = '<a href="' . $value['url'] . '" ' .( isset($value['custom']) ? $value['custom'] : '') . '>' . ($settings['use_image_buttons'] ? '<img src="' . $settings['images_url'] . '/' . ($value['lang'] ? $context['user']['language'] . '/' : '') . $value['image'] . '" alt="' . $txt[$value['text']] . '" border="0" />' : $txt[$value['text']]) . '</a>';

		$button_strip[$key] = $buttons[$key];
	}

	echo '
		<td ', $custom_td, '>', implode($context['menu_separator'], $button_strip) , '</td>';
}

?>