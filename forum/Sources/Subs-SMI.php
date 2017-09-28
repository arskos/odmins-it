<?php
/*******************************************************************************
* Social Media Icons © 5771, Bugo										       *
********************************************************************************
* Subs-SMI.php												 				   *
********************************************************************************
* License http://creativecommons.org/licenses/by-nc-sa/3.0/deed.ru CC BY-NC-SA *
* Support and updates for this software can be found at	http://dragomano.ru    *
*******************************************************************************/

if (!defined('SMF'))
	die('Hacking attempt...');
	
function smi_header()
{
	global $board_info, $context, $settings;

	if ((!empty($board_info['groups']) && in_array('-1', $board_info['groups'])) || $context['current_action'] == 'media')
		$context['html_headers'] .= "\n\t" . '<link type="text/css" rel="stylesheet" href="' . $settings['default_theme_url'] . '/css/smi.css" />';
}
	
function smi_display()
{
	global $txt, $board_info, $context, $settings, $modSettings, $scripturl, $boardurl;
		
	loadLanguage('SMI');
	
	if (in_array('-1', $board_info['groups'])) {
		$context['insert_after_template'] .= '
				<script type="text/javascript">!window.jQuery && document.write(unescape(\'%3Cscript src="http://code.jquery.com/jquery.min.js"%3E%3C/script%3E\'))</script>
				<script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/smi.js"></script>
				<script type="text/javascript"><!-- // --><![CDATA[
					var hint = new Array(' . $txt['smi_array'] . ');
					var lang = "' . $txt['lang_dictionary'] . '";
					var img = "' . (isset($modSettings['smi_app']) && $modSettings['smi_app'] == 1 ? "round" : "normal") . '";
					smi(encodeURIComponent("'. $scripturl . '?topic=' . $context['current_topic'] . '.0'. '"),encodeURIComponent("' . $context['subject'] . '"),encodeURIComponent("' . $boardurl . '"));
				// ]]></script>';
	}
}

function smi_buffer(&$buffer)
{
	global $txt, $context, $modSettings, $settings, $boardurl;
	
	loadLanguage('SMI');
	
	if ($context['current_action'] == 'printpage' || $context['current_action'] != 'media' || empty($modSettings['smi_aeva']))
		return $buffer;

	$search = '';
	$replace = '';
	
	if ($context['current_action'] == 'media' && isset($_REQUEST['sa']) && $_REQUEST['sa'] == 'item')
	{
		$item = $context['item_data'];
		$search = '<table cellspacing="1" cellpadding="8" border="0" class="bordercolor" width="100%" id="mg_coms">';
		$replace = $search . '
		<tr>
			<td colspan="2">
			<script type="text/javascript">!window.jQuery && document.write(unescape(\'%3Cscript src="http://code.jquery.com/jquery.min.js"%3E%3C/script%3E\'))</script>
			<script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/smi.js"></script>
			<script type="text/javascript"><!-- // --><![CDATA[
				var hint = new Array(' . $txt['smi_array'] . ');
				var lang = "' . $txt['lang_dictionary'] . '";
				var img = "' . (isset($modSettings['smi_app']) && $modSettings['smi_app'] == 1 ? "round" : "normal") . '";
				smi(encodeURIComponent("' . $boardurl . '/MGalleryItem.php?id=' . $item['id_media'] . '"),encodeURIComponent("' . html_entity_decode($item['title'], ENT_QUOTES, $context['character_set']) . '"),encodeURIComponent("' . $boardurl . '"));
			// ]]></script>
			</td>
		</tr>';
	}
	
	return (isset($_REQUEST['xml']) ? $buffer : str_replace($search, $replace, $buffer));
}

function smi_settings(&$config_vars)
{
	global $txt, $sourcedir;
	
	loadLanguage('SMI');
	
	if (isset($config_vars[0])) $config_vars[] = array('title', 'smi_title');
	$config_vars[] = array('select', 'smi_app', explode("|", $txt['smi_app_set']));
	if (file_exists($sourcedir . '/Aeva-Subs.php')) $config_vars[] = array('check', 'smi_aeva');
}

?>