<?php
/*
 ��� ������ ������ SetLinks.ru.
 ������ 4.0.0
*/
define('SETLINKS_CODE_VERSION', '4.0.0');

class SLConfig {
    var $aliases = Array(); // ������ ������. ��� www, � ������ ��������. ������: Array("sitealias.ru" => "mainsite.ru", "sitealias2.ru" => "mainsite.ru")
    var $userId = '602428';
    var $password = '62b32a0fdcdb8a2fd90e5a2ba43a65c2';  // ������
    var $encoding = 'WINDOWS-1251'; // ����������� ��� ���������. (WINDOWS-1251, UTF-8, KOI8-R)
    var $server = 'show.setlinks.ru'; // ������ � �������� ������� ���� ������
    var $cachetimeout = 3600;  // ����� ���������� ���� � ��������
    var $errortimeout = 600;  // ������ ���������� ���� ����� ������ � ��������
    var $cachedir = ''; // ���������� ���� ����� ����������� ���(���� �����, �� ����� �������� � ����� �� ��������), � ����� ���������� ���� "/"
    var $cachetype = 'FILE'; // ��� ����. (FILE, MYSQL)
    var $connecttype = '';  // ��� ���������� � �������� setlinks. (CURL - ������������ ���������� CURL, SOCKET - ������������ ������, NONE - �� ����������� � ��������, ������������ ������ ����)
                            // ���� $connecttype �����, �� ��� ���������� ������������ ���������
    var $sockettimeout = 5; // �������� ����, ������
    var $indexfile = '^/index\\.(html|htm|php|phtml|asp)$'; // ������ ��������� ��������

    var $use_safe_method = false; // ������ �� �������� �� ����������� ������, ������ ��� http://forum.setlinks.ru/showthread.php?p=1506#post1495
    var $allow_url_params = ""; // ��������� ������� ����� ��������� � ���� ����� ������ "mod id username"

    var $show_comment = true; // ���� true, �� �������� ���������� ����, � �� ������ ������������
    var $show_errors = true; // �������� ��� ��� ������

    // --- ��������� ��� ��������� ---
    // ������ ����� � ������� �� ����� ������������� ����������� ������
    var $context_bad_tags = array( "a", "title", "head", "meta", "link", "h1", "h2", "thead", "xmp", "textarea", "select", "button", "script", "style", "label", "noscript", "noindex" );
    var $context_show_comments = false; // ���� true, �� �������� ���������� ����, � �� ������ ������������

    var $path = '/articles/'; // ���� � �������� ������� ������

    var $show_demo_links = false;
}

?>
