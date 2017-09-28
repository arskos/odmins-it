<?php

function template_zen_above()
{
	global $context, $modSettings, $txt, $settings, $scripturl;

	if (!empty($context['zen_block']))
	{
		echo '
	<div id="zen"', $context['is_poll'] && empty($context['linked_calendar_events']) ? ' style="margin-top: 10px"' : (!empty($context['is_poll']) ? '' : ''), '>
		<div', !empty($context['zen_attachments']) ? ' id="first_message"' : '', ' class="description">
			<div class="zen-head ', empty($modSettings['zen_block_status']) ? 'full' : 'mini', '_text information">', $txt['zen_block_enable'], '</div>
			<div', empty($modSettings['zen_block_status']) ? ' class="zen-body"' : '', '>';
						
		if ($settings['name'] != 'ClearSky')
			echo '
				<span class="upperframe"><span></span></span>
				<div class="roundframe">';
		else
			echo '
				<div class="sky">';
							
		echo '
					<div class="zen_message">', $context['zen_block'], '</div>
					<hr />
					<div class="smalltext">
						<span class="lefttext">', $txt['zen_link'], '</span>
						<span class="floatright">',
							!empty($modSettings['zen_yashare']) ? '<span id="yashare-zen"' . ($modSettings['zen_yashare'] == 'icon' ? ' title="' . $txt['zen_share_title'] . '"' : '') . '></span>' : '',
							!empty($modSettings['zen_gplus']) ? '<span id="plusone-zen"></span>' : '',
							$context['top_topic'] ? '<img src="' . $settings['default_images_url'] . '/zen/zen_pop.png" alt="' . $txt['zen_block_topic'] . '" title="' . $txt['zen_block_topic'] . '" />&nbsp;' : '',
							!empty($context['can_make_bookmarks']) ? '<a href="' .  $scripturl . '?action=bookmarks;sa=add;topic=' . $context['current_topic'] . ';' . $context['session_var'] . '=' . $context['session_id'] . '"><img src="' . $settings['default_images_url'] . '/zen/zen_bookmark.png" alt="" title="' . $txt['bookmark_add'] . '" /></a>&nbsp;' : '',
							'<a href="', $scripturl, '?topic=', $context['current_topic'], '.msg', $context['topic_first_message'], '#msg', $context['topic_first_message'], '" title="', $txt['zen_block_link'], '"><img src="', $settings['default_images_url'], '/zen/zen_anchor.png" alt="', $txt['zen_block_link'], '" /></a>
						</span>
					</div>
				</div>';
	
		if ($settings['name'] != 'ClearSky')
			echo '
				<span class="lowerframe"><span></span></span>';
							
		echo '
			</div>
		</div>';
					
		if (!empty($context['zen_attachments']) && !empty($modSettings['zen_attach_block']))
		{
			echo '
		<div id="zen_attach" class="description">
			<div class="zen-head ', empty($modSettings['zen_block_status']) ? 'full' : 'mini', '_text information">', $txt['zen_attachments'], '</div>
			<div class="', empty($modSettings['zen_block_status']) ? 'zen-body ' : '', 'smalltext">';
						
			if ($settings['name'] != 'ClearSky')
				echo '
				<span class="upperframe"><span></span></span>
				<div class="roundframe">';
			else
				echo '
				<div class="sky">';

			echo '
					<div class="zen_message">',	$context['zen_attachments'], '</div>
				</div>';
					
			if ($settings['name'] != 'ClearSky')
				echo '					
				<span class="lowerframe"><span></span></span>';
							
			echo '
			</div>
		</div>
		<br class="clear" />';
		}
		
		echo '
	</div>';
	}
}

function template_zen_below()
{
	global $context, $modSettings, $settings, $scripturl, $txt, $topicinfo;
	
	if (!empty($context['zen_block']))
	{
		echo '
	<script type="text/javascript">window.jQuery || document.write(unescape(\'%3Cscript src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"%3E%3C/script%3E\'))</script>';
				
		if (!empty($modSettings['zen_gplus']))
			echo '
	<script type="text/javascript">!window.gapi && document.write(unescape(\'%3Cscript src="https://apis.google.com/js/plusone.js"%3E{"parsetags": "explicit", "lang": "' . $txt['lang_dictionary'] . '"}%3C/script%3E\'))</script>';
	
		if (!empty($modSettings['zen_yashare']))
			echo '
	<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>';
				
		echo '
	<script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/jquery.zen.js"></script>
	<script type="text/javascript">window.addEvent && document.write(unescape(\'%3Cscript type="text/javascript"%3EjQuery.noConflict();%3C/script%3E\'))</script>
	<script type="text/javascript"><!-- // --><![CDATA[
		jQuery(document).ready(function($){';

		if (!empty($modSettings['zen_attach_block']) && !empty($modSettings['zen_img_preview']) && !empty($context['zen_attachments']))
		{
			foreach ($context['attachments'] as $attach)
			{
				if ($attach['file']['is_image'])
				{
					echo '
			$(\'a.imgTip' . $attach['file']['image']['id'] . '\').tinyTips(\'' . $context['tooltips'] . '\', \'<img alt="" src="' . $attach['file']['image']['href'] . '" />\');';
				}
			}
		}

		echo '
			$(\'.zen-head\').click(function(){
				$(this).toggleClass("full_text").toggleClass("mini_text").next().toggle()
			})
		})
	// ]]></script>';

		if (!empty($modSettings['zen_gplus']) || !empty($modSettings['zen_yashare']))
		{
			echo '
	<script type="text/javascript"><!-- // --><![CDATA[';
				
			if (!empty($modSettings['zen_gplus']))
				echo '
		gapi.plusone.render("plusone-zen", {"size": "small", "href" : "' . $scripturl . '?topic=' . $context['current_topic'] . '.0"});';
		
			$services = '';
			if (!empty($modSettings['zen_yashare_array']))
			{
				$temp = explode(",", $modSettings['zen_yashare_array']);
				foreach ($temp as $name)
				{
					$name = '"' . trim($name) . '"';
					$services .= $name . ",";
				}
				$services = substr($services, 0, strlen($services) - 1);
			}
		
			$blocks = '';
			if (!empty($modSettings['zen_yashare_blocks']))
			{
				$temp = explode(",", $modSettings['zen_yashare_blocks']);
				foreach ($temp as $name)
				{
					$name = '"' . trim($name) . '"';
					$blocks .= $name . ",";
				}
				$blocks = substr($blocks, 0, strlen($blocks) - 1);
			}
					
			if (!empty($modSettings['zen_yashare']))
				echo '
		new Ya.share({
			element : "yashare-zen",
			l10n : "' . (in_array($txt['lang_dictionary'], array('en','ru','be','kk','tt','uk')) ? $txt['lang_dictionary'] : 'en') . '",
			link : "' . $scripturl . '?topic=' . $context['current_topic'] . '.0",
			elementStyle: {
				type: "' . $modSettings['zen_yashare'] . '",
				linkIcon: true,
				border: false,
				quickServices: [' . $services . ']
			},
			popupStyle: {
				blocks: {
					"' . $txt['zen_share_title'] . '": [' . $blocks . ']
				},
				codeForBlog: \'<img src="' . $context['zen_topic_icon'] . '" border="0" alt="' . $context['page_title'] . '" title="' . $context['page_title'] . '" />&nbsp;<a href="' . $scripturl . '?topic=' . $context['current_topic'] . '.0" target="_blank">' . $topicinfo['subject'] . '</a>\'
			}
		})';
					
			echo '	
	// ]]></script>';
		}
	}
}

?>