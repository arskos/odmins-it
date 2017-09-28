<?
require "../bash/config.php";
require "../query.php";
if (isset($_GET['id'])) $key=codechar($_GET['id']);
if ($key==="-help")
{
	echo "Справка по команде site:<br>";
	echo "Формат команды: site ключ<br>";
	echo "Ключи команды site:<br>";
	$my = mysql_query("SELECT * FROM `admins_page` WHERE ids_podrazdel='1' ORDER BY ids_razdel, ids_podrazdel;");
	if (mysql_num_rows($my)==true)
	{
		while ($main=mysql_fetch_array($my))
		{
			if ($main['soderganie']!=="humor" && $main['soderganie']!=="article" && $main['soderganie']!=="humor_add" && $main['soderganie']!=="article_add" && $main['soderganie']!=="email")
			{echo "-".$main['soderganie']."    - ".$main['name']."<br>";}
		}
	}
	echo "-forum - переход на форум<br>";
}
else
{
	$keys=substr(strrchr($key,'-'),1);
	$my = mysql_query("SELECT * FROM `admins_page` WHERE soderganie='$keys';");
	if (mysql_num_rows($my)==true)
	{
		$main=mysql_fetch_array($my);
		echo $main['kod'];
	}
	else echo "Неправильный ключ команды<br>Наберите site -help для просмотра справки по ключам";
}
?>
<!--
<tr valign='top' height='5px'><td colspan='3' height='10px'><a href='http://odmins-it.ru/log'>Старые логи</a></td></tr>
<tr valign='top' height='5px'><td colspan='3' height='10px'><a href='http://odmins-it.ru/logs'>Новые логи</a></td></tr>
<tr><td valign="top" height="5px"><a href="http://forum.odmins-it.ru/" class="lmm">Форум</a></td></tr>
<tr><td valign="top" height="5px"><a href="/book/" class="lmm">Книжный магазин</a></td></tr>
<tr><td valign="top" height="5px"><a href="/disc/" class="lmm">Магазин СПО</a></td></tr>
-->