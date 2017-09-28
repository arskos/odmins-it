<?php
if (!defined('SMF'))
    die('Hacking attempt...');
global $board_info, $context, $boardurl, $modSettings;

$app_kindle_url = isset($modSettings['tp_kindle_url']) ? $modSettings['tp_kindle_url'] : '';
$app_android_id = isset($modSettings['tp_android_url']) ? $modSettings['tp_android_url'] : '';
$app_ios_id = isset($modSettings['tp_app_ios_id']) ? $modSettings['tp_app_ios_id'] : '';;
$app_banner_message = isset($modSettings['tp_app_banner_msg']) ? $modSettings['tp_app_banner_msg'] : '';
$app_banner_message = preg_replace('/\r\n/','<br>',$app_banner_message);
$app_location_url = get_scheme_url();
$script_to_page = array(
   'home'          => 'home',
   'index'          => 'home',
   'topic'     => 'topic',
   'post'   => 'post',
   'forum'   => 'forum',
);
$page_type = isset($GLOBALS['exttMbqTempPageType']) && isset($script_to_page[$GLOBALS['exttMbqTempPageType']]) ? $script_to_page[$GLOBALS['exttMbqTempPageType']] : 'others';
$is_mobile_skin = false;
$app_forum_name = !empty($GLOBALS['mbname'])? $GLOBALS['mbname'] : '';
$tapatalk_dir = 'mobiquo';
$tapatalk_dir_url = $boardurl. '/mobiquo';
$api_key = isset($modSettings['tp_push_key']) ? $modSettings['tp_push_key'] : '';
$app_ads_enable = isset($modSettings['tp_full_ads']) ? $modSettings['tp_full_ads'] : 1;
$app_banner_enable = isset($modSettings['tp_full_banner']) ? $modSettings['tp_full_banner'] : 1;

$tt_banner_last_check = isset($modSettings['tt_banner_last_check']) ? intval($modSettings['tt_banner_last_check']) : null;
$tt_banner_control = isset($modSettings['tt_banner_control']) ? (bool)$modSettings['tt_banner_control'] : true;
$forum_root = dirname(__FILE__);
$validTime = 60 * 60 * 24;
if (empty($tt_banner_last_check) || time() - $tt_banner_last_check > $validTime){
    try
    {
        if (file_exists($forum_root .'/lib/classTTConnection.php')){
            include_once($forum_root .'/lib/classTTConnection.php');
        }
        if (class_exists('classTTConnection')){
            $connection = new classTTConnection();
            $url = "https://tapatalk.com/get_forum_info.php";
            $data = array(
            'key' => md5($api_key),
            'url' => $boardurl,
            );
            $response = $connection->getContentFromSever($url,$data,'post',true);
            if (!empty($response)){
                $result = explode(":", $response);
                if ($result[0] == 'banner_control'){
                    if ($tt_banner_control !== (bool)$result[1]){
                        $tt_banner_control = (bool)$result[1];
                        $input = array(
                        'tt_banner_control' => $tt_banner_control,
                        'tt_banner_last_check' => time(),
                        );
                        updateSettings($input);
                    }
                }
            }
        }
   }
    catch(Exception $ex)
    {
        $input = array(
                     'tt_banner_control' => true,
                     'tt_banner_last_check' => time(),
                     );
        updateSettings($input);
    }
}
if (!$tt_banner_control){
    $app_ads_enable = 1;
    $app_banner_enable = 1;
}

$board_url = $boardurl;
$twitterfacebook_card_enabled = isset($modSettings['tp_deep_link_enabled']) ? $modSettings['tp_deep_link_enabled'] : '';
$twc_title = isset($context['page_title_html_safe']) ? $context['page_title_html_safe'] : '';
$twc_description = ($page_type == 'forum') && isset($board_info['description']) ? $board_info['description'] : $twc_title;
if (file_exists($forum_root .'/smartbanner/head.inc.php'))
    include($forum_root .'/smartbanner/head.inc.php');

$hide_forums = array();
if (isset($modSettings['boards_hide_for_tapatalk'])){
    foreach(explode(',', $modSettings['boards_hide_for_tapatalk']) as $hide_forum){
        $hide_forum = intval($hide_forum);
        if (!empty($hide_forum)){
            $hide_forums[] = $hide_forum;
        }
    }
}
//$context['html_headers'] .= $app_head_include;
if (isset($context['html_headers']) && isset($app_head_include) && (!isset($context['current_board']) || !in_array($context['current_board'], $hide_forums))){
    $context['html_headers'] .= $app_head_include;
}

if (!isset($context['tapatalk_body_hook']))
    $context['tapatalk_body_hook'] = '';

$context['tapatalk_body_hook'] .= '
<!-- Tapatalk Detect body start -->
<style type="text/css">
.ui-mobile [data-role="page"], .ui-mobile [data-role="dialog"], .ui-page 
{
top:auto;
}
</style>
<script type="text/javascript">if (typeof(tapatalkDetect) == "function") tapatalkDetect();</script>
<!-- Tapatalk Detect banner body end -->

';

function get_scheme_url()
{
    global $boardurl, $user_info, $context, $exttMbqTempPageType, $modSettings, $options, $board, $topic;

    $baseUrl = $boardurl;
    $baseUrl = preg_replace('/https?:\/\//i', 'tapatalk://', $baseUrl);

    $location = 'index';
    $other_info = array();
    //is action? 'pm', 'profile', 'login2', 'login', 'search2'
    if(isset($_GET['action']) && !empty($_GET['action']))
    {
        if($_GET['action'] == 'pm')
            $location = 'message';
        else if($_GET['action'] == 'profile')
        {
            $location = 'profile';
            if(isset($_GET['u']) && !empty($_GET['u']))
                $other_info[] = 'uid='.$_GET['u'];
            else if(!empty($user_info['id']))
                $other_info[] = 'uid='.$user_info['id'];
        }
        else if($_GET['action'] == 'login2' || $_GET['action'] == 'login')
            $location = 'login';
        else if($_GET['action'] == 'search2')
            $location = 'search';
        else if($_GET['action'] == 'who')
            $location = 'online';
    }
    //Query string topic=36.msg123 board=1.0 topic=36.0
    else
    {
        $fid = 0;
        if(is_array($board) && array_key_exists('id',$board))
        {
            $fid = $board['id'];
        }
        else if(!is_array($board))
        {
            $fid = $board;
        }

        if (!empty($board) && empty($topic))
        {
            $location = 'forum';
            $other_info[] = 'fid='. $fid;
            
            $topics_per_page = empty($modSettings['disableCustomPerPage']) && !empty($options['topics_per_page']) && !WIRELESS ? $options['topics_per_page'] : $modSettings['defaultMaxTopics'];
            $current_page = isset($_REQUEST['start']) ? ($_REQUEST['start'] / $topics_per_page + 1) : 1;
            
            $other_info[] = 'page='.$current_page;
            $other_info[] = 'perpage='.$topics_per_page;
        }
        else if (!empty($topic))
        {
            $messages_per_page = empty($modSettings['disableCustomPerPage']) && !empty($options['messages_per_page']) && !WIRELESS ? $options['messages_per_page'] : $modSettings['defaultMaxMessages'];
            
            $other_info[] = 'fid='. $fid;
            $other_info[] = 'tid='.$topic;
            $other_info[] = 'perpage='.$messages_per_page;
            
            if (substr($_REQUEST['start'], 0, 3) == 'msg')
            {
                $location = 'post';
                $other_info[] = 'pid='.(int) substr($_REQUEST['start'], 3);
            }
            else
            {
                $location = 'topic';
                $current_page = isset($_REQUEST['start']) ? ($_REQUEST['start'] / $messages_per_page + 1) : 1;
                $other_info[] = 'page='.$current_page;
            }
        }
    }
    $other_info_str = implode('&', $other_info);
    $scheme_url = $baseUrl . '/' . (!empty($user_info['id']) ? '?user_id='.$user_info['id'].'&' : '?') . 'location='.$location.(!empty($other_info_str) ? '&'.$other_info_str : '');
    
    $exttMbqTempPageType = $location;
    if (
        (isset($_GET['action']) && $_GET['action'] == 'post' && isset($_GET['msg']) && isset($_GET['topic'])) || 
        (isset($_GET['action']) && $_GET['action'] == 'post' && isset($_GET['topic']) && isset($_GET['last_msg'])) || 
        (isset($_GET['action']) && $_GET['action'] == 'help') || 
        (isset($_GET['action']) && $_GET['action'] == 'search') || 
        (isset($_GET['action']) && $_GET['action'] == 'calendar') || 
        (isset($_GET['action']) && $_GET['action'] == 'register') || 
        (isset($_GET['action']) && $_GET['action'] == 'post' && isset($_GET['board'])) || 
        (isset($_GET['action']) && $_GET['action'] == 'post' && isset($_GET['quote']) && isset($_GET['topic'])) || 
        (isset($_GET['action']) && $_GET['action'] == 'editpoll' && isset($_GET['add']) && isset($_GET['topic'])) || 
        (isset($_GET['action']) && $_GET['action'] == 'splittopics' && isset($_GET['topic']) && isset($_GET['at'])) || 
        (isset($_GET['action']) && $_GET['action'] == 'post' && isset($_GET['board']) && isset($_GET['poll'])) || 
        (isset($_GET['action']) && $_GET['action'] == 'emailuser' && isset($_GET['sa']) && isset($_GET['topic'])) || 
        (isset($_GET['action']) && $_GET['action'] == 'admin') || 
        (isset($_GET['action']) && $_GET['action'] == 'moderate') || 
        (isset($_GET['action']) && $_GET['action'] == 'mlist')
    ) {
        $exttMbqTempPageType = 'other';
    }
    return $scheme_url;
}