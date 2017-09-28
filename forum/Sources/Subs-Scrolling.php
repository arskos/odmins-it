<?php
/*******************************************************************************
* Scrolling Buttons © 2012, Bugo		        							   *
********************************************************************************
* Subs-Scrolling.php														   *
********************************************************************************
* License http://creativecommons.org/licenses/by-nc-sa/3.0/deed.ru CC BY-NC-SA *
* Support and updates for this software can be found at	http://dragomano.ru    *
*******************************************************************************/

if (!defined('SMF'))
	die('Hacking attempt...');

function scrolling_load_theme()
{
	global $context, $settings, $txt;
	
	if (isset($_REQUEST['xml']) || isset($_REQUEST['sa']) && $_REQUEST['sa'] == 'showoperations') return;
	
	if (!in_array($context['current_action'], array('helpadmin', 'printpage')) && !WIRELESS)
	{
		$context['html_headers'] .= '
	<link rel="stylesheet" type="text/css" href="' . $settings['default_theme_url'] . '/css/scrolling.css" />';
		
		if ($context['browser']['is_ie6'] || $context['browser']['is_ie7'])
			$context['html_headers'] .= '
	<!--[if lte IE 7]>
	<style type="text/css">a#toTop:active {background: url(' . $settings['default_images_url'] . '/scrolling-buttons.png) no-repeat left top;} a#toBottom:active {background: url(' . $settings['default_images_url'] . '/scrolling-buttons.png) no-repeat right top;}</style>
	<![endif]-->
	<!--[if IE 6]>
	<style type="text/css">html {background:url(about:blank); background-attachment: fixed;} #gtb_pos {position: absolute; top: expression(parseInt(document.documentElement.scrollTop + document.documentElement.clientHeight - this.offsetHeight, 10) -300 + "px");}</style>
	<![endif]-->';
	
		loadTemplate('Scrolling');
		$context['template_layers'][] = 'scrolling';
	}
}

function scrolling_menu_buttons()
{
	global $context;
	
	if ($context['current_action'] == 'credits')
		$context['copyrights']['mods'][] = '<a href="http://dragomano.ru/page/scrolling-buttons" target="_blank">Scrolling Buttons</a> &copy; 2012, Bugo';
}

/* ./Sources/Subs-Scrolling.php */