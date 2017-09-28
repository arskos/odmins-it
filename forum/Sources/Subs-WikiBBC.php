<?php

if (!defined('SMF'))
	die('Hacking attempt...');

function wiki_bbc_add_code($codes)
{
	global $txt;

	loadLanguage('WikiBBC');

	$codes[] = array(
				'tag' => 'wiki',
				'type' => 'unparsed_content',
				'content' => '<a href="http://'.$txt['lang'].'.wikipedia.org/wiki/$1" target="_blank" style="border-bottom:1px dashed #FF0000;text-decoration:none" class="wiki_link">$1</a><sup><span style="font-size:7pt;color:red;" class="wiki_sup">'.$txt['wiki'].'</span></sup>',
				'validate' => create_function('&$tag, &$data, $disabled', '
						$data = strtr($data, array(\'<br />\' => \'\'));
				'),
                'disallow_children' => array('email', 'ftp', 'url', 'iurl'),
				'disabled_content' => '$1',
			);
	$codes[] = array(
				'tag' => 'wiki',
				'type' => 'unparsed_equals',
				'before' => '<a href="http://'.$txt['lang'].'.wikipedia.org/wiki/$1" target="_blank" style="border-bottom:1px dashed #FF0000;text-decoration:none" class="wiki_link">',
                'after' => '</a><sup><span style="font-size:7pt;color:red;" class="wiki_sup">'.$txt['wiki'].'</span></sup>',
                'disallow_children' => array('email', 'ftp', 'url', 'iurl'),
				'disabled_before' => '',
                'disabled_after' => '$1',
			);

}

function wiki_bbc_add_button($buttons)
{
	global $txt;

	loadLanguage('WikiBBC');

	$buttons[count($buttons) - 1][] = array(
		'image' => 'wiki',
		'code' => 'wiki',
		'before' => '[wiki]',
		'after' => '[/wiki]',
		'description' => $txt['wiki_desc'],
	);
}
?> 