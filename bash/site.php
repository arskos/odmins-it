<?
require "../bash/config.php";
require "../query.php";
if (isset($_GET['id'])) $key=codechar($_GET['id']);
if ($key==="-help")
{
	echo "������� �� ������� site:<br>";
	echo "������ �������: site ����<br>";
	echo "����� ������� site:<br>";
	$my = mysql_query("SELECT * FROM `admins_page` WHERE ids_podrazdel='1' ORDER BY ids_razdel, ids_podrazdel;");
	if (mysql_num_rows($my)==true)
	{
		while ($main=mysql_fetch_array($my))
		{
			if ($main['soderganie']!=="humor" && $main['soderganie']!=="article" && $main['soderganie']!=="humor_add" && $main['soderganie']!=="article_add" && $main['soderganie']!=="email")
			{echo "-".$main['soderganie']."    - ".$main['name']."<br>";}
		}
	}
	echo "-forum - ������� �� �����<br>";
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
	else echo "������������ ���� �������<br>�������� site -help ��� ��������� ������� �� ������";
}
?>
<!--
<tr valign='top' height='5px'><td colspan='3' height='10px'><a href='http://odmins-it.ru/log'>������ ����</a></td></tr>
<tr valign='top' height='5px'><td colspan='3' height='10px'><a href='http://odmins-it.ru/logs'>����� ����</a></td></tr>
<tr><td valign="top" height="5px"><a href="http://forum.odmins-it.ru/" class="lmm">�����</a></td></tr>
<tr><td valign="top" height="5px"><a href="/book/" class="lmm">������� �������</a></td></tr>
<tr><td valign="top" height="5px"><a href="/disc/" class="lmm">������� ���</a></td></tr>
-->