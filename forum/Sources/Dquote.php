<?php

if (!defined('SMF'))
    die('Hacking attempt...');

function loadDquote() {
    global $context, $settings, $options, $txt;

    if (!empty($options['display_quick_reply']) && !empty($context['current_topic'])) {

        // TODO: Не грузить js для тех у кого нет прав отвечать
        // TODO: Добавить растяжку окна в быстром ответе
        loadLanguage('Dquote/');	
        $txt['quote'] = $txt['dQuoteSelection_txt']; 
        $context['insert_after_template'] .= '
        <script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/dquote.js?25b2"></script>';
    }     
}

?>