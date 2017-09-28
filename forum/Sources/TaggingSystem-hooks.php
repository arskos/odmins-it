<?php
/*---------------------------------------------------------------------------------
*	SMFSIMPLE Tagging System												 	  *
*	Author: SSimple Team - 4KSTORE										          *
*	Powered by www.smfsimple.com												  *
**********************************************************************************/

if (!defined('SMF'))
	die('Hacking attempt...');

function tagging_actions(&$actionArray)
{
	$actionArray['tags'] = array('TaggingSystem.php', 'TaggingSystemMain');
}

function tagging_admin_area(&$admin_areas)
{
	global $txt;

	loadLanguage('Tagging');
	$admin_areas['config']['areas']['taggingsystem'] = array(
		'label' => $txt['tags_admin_title'],
		'file' => 'TaggingSystem.php',
		'function' => 'TaggingSystemAdmin',
		'icon' => 'package_ops.gif',
		'subsections' => array(
			'main' => array($txt['tags_admin_title_main']),
			'list_cloud' => array($txt['tags_admin_list_cloud_title']),
		),
	);
}

function tagging_load_theme()
{
	global $context, $settings, $modSettings, $scripturl;

	$context['html_headers'] .='<link rel="stylesheet" type="text/css" href="'. $settings['default_theme_url']. '/css/tags.css" />';
	$_REQUEST['action'] = !empty($_REQUEST['action']) ? $_REQUEST['action'] : '';
	if (($_REQUEST['action'] == 'post' || $_REQUEST['action'] == 'post2')&& (!empty($_REQUEST['board']) || !empty($_REQUEST['msg'])))
	{
		$tag_max_per_topic = !empty($modSettings['tag_max_per_topic']) ? $modSettings['tag_max_per_topic'] - 1 : 5;
		$max = !empty($modSettings['tag_max_length']) ? $modSettings['tag_max_length'] : 15;
		$min = !empty($modSettings['tag_min_length']) ? $modSettings['tag_min_length'] : 2;

		$context['html_headers'] .= '
		<script type="text/javascript">window.jQuery || document.write(unescape(\'%3Cscript src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"%3E%3C/script%3E\'))</script>
		<script type="text/javascript" src="'. $settings['default_theme_url']. '/scripts/tags.js"></script>
		<script type="text/javascript"><!-- // --><![CDATA[
             jQuery(document).ready(function($){
                 $(\'#consulta\').sugerir({
                    \'limite\' : '.$tag_max_per_topic.',
                    \'max\' : '.$max.',
                    \'min\' : '.$min.',
                    \'ajaxSuggestUrl\' : "'.$scripturl.'?action=tags;sa=suggest",
                });
                $(\'#consulta\').teclear();
            });
        // ]]></script>';
	}
}

function tagging_menu_button(&$buttons)
{
	global $scripturl, $txt, $context, $modSettings;

	loadLanguage('Tagging');

	if (!empty($modSettings['tag_enabled']))
	{
		if (!$context['user']['is_logged'])
			$boton = 'login';

		else
			$boton = 'logout';

		$find_me = 0;
		reset($buttons);

		while((list($key, $val) = each($buttons)) && $key != $boton)
			$find_me++;

		$buttons = array_merge(
			array_slice($buttons, 0, $find_me),
			array(
				'tags' => array(
					'title' => $txt['tags_menu_btn'],
					'href' => $scripturl . '?action=tags',
					'show' => true,
					'sub_buttons' => array(
					)
				),
			),
			array_slice($buttons, $find_me)
		);
	}
}