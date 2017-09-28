<?session_start();
/*
$crawltsite=2;
require_once("/home/arskos/data/www/stat.odmins-it.ru/crawltrack.php");
*/
require "config.php";
$ids_razdel=$_GET['ids_razdel'];
$ids_podrazdel=$_GET['ids_podrazdel'];
$ids="";$ids=$_GET['ids'];
$name="";$name=$_GET['name'];
if (empty($name)) {$name="page";$ids="about";}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?require "title.php";?></title>
<meta name="description" content="<?require "description.php";?>"/>
<meta name="keywords" content="<?require "keyword.php";?>"/>
<!-- description content -->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<meta http-equiv="Content-language" content="ru"/>
<link rel="stylesheet" href="/st.css" type="text/css"/>
<link rel="alternate" href="http://odmins-it.ru/rss/rss.php" type="application/rss+xml" title="RSS"/>
<script type="text/javascript" src="/script.js"></script>
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td height="100px" colspan="2" class="red1" align="center">
<!-- Логотип -->
		<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="red1" align="center" width="160px"><a href="http://odmins-it.ru"><img src="/img/odmins-full.png" alt="odmins-it" border="0"></a></td>
<td class="red1" align="center">Сайт конференции admins@conference.jabber.ru</td>
</tr>
</table>
<!-- конец Логотип -->	
	</td>
	<td rowspan="2" width="200px" valign="top">
<!-- Новости -->	
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td class="blue1" height="20px"></td>
</tr>
<tr>
	<td class="blue1" height="5px"></td>
	<td class="blue1" height="5px"></td>
</tr>
<tr>
<td>
<?require "news.php";?>
</td>
</tr>
</table>
<!-- конец Новости -->	
	</td>
</tr>
<tr>
	
	<td width="176px" height="100%" rowspan="2" valign="top">
<!-- навигация -->	
<table width="100%" border="0" height="100%" cellpadding="0" cellspacing="0">
<?require "navy_left.php";?>
<?require "setlink.php";?>
<?require "log.php";?>
</table>
<!-- конец Навигация -->	
	</td>
	<td valign="top">
<!--основная часть -->
		<table width="100%" height="100%" border="0" cellpadding="10" cellspacing="0">
		<tr valign="top">
			<td class="blue1" valign="top" align="center">
<?require "content.php";?>
			</td>
		</tr>
		</table>
<!--конец основная часть -->
	</td>
</tr>
<tr>
	<td colspan="2" height="20px" class="copy" valign="bottom">отдел маркетинга и PR конференции admins</td>
</tr>
</table>
</body>
</html>
