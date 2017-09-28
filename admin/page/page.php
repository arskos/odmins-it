<?
$my=mysql_query("SELECT * FROM `admins_user` WHERE LOGIN='$login';");
$main=mysql_fetch_array($my);
if ($main['page']==1)
{
if ($page_show==="yes")
{
?>
<td width="154" valign="top"><? require "page_show_help.php"; ?></td>
<td valign="top"><? require "page_show.php"; ?></td>
<?
}
elseif ($page_add_1==="yes")
{
?>
<td width="154" valign="top"><? require "page_add_1_help.php"; ?></td>
<td valign="top"><? require "page_add_1.php"; ?></td>
<?
}
elseif ($page_add_2==="yes")
{
?>
<td width="154" valign="top"><? require "page_add_2_help.php"; ?></td>
<td valign="top"><? include "page_add_2.php"; ?></td>
<?
}
elseif ($page_add_vis==="yes")
{
?>
<td valign="top"><? require "page_add_2_vis.php"; ?></td>
<?
}
elseif ($page_add_ok==="yes")
{
?>
<td valign="top"><? require "page_add_ok.php"; ?></td>
<?
}
elseif ($page_edit==="yes")
{
?>
<td width="154" valign="top"><? require "page_edit_help.php"; ?></td>
<td valign="top"><? require "page_edit.php"; ?></td>
<?
}
elseif ($page_edit_vis==="yes")
{
?>
<td valign="top"><? require "page_edit_vis.php"; ?></td>
<?
}
elseif ($page_edit_ok==="yes")
{
?>
<td valign="top"><? require "page_edit_ok.php"; ?></td>
<?
}
elseif ($page_sort_razd==="yes")
{
?>
<td width="154" valign="top"><? require "page_sort_razd_help.php"; ?></td>
<td valign="top"><? require "page_sort_razd.php"; ?></td>
<?
}
elseif ($page_sort_razd_ok==="yes")
{
?>
<td valign="top"><? require "page_sort_razd_ok.php"; ?></td>
<?
}
elseif ($page_sort_podrazd==="yes")
{
?>
<td width="154" valign="top"><? require "page_sort_podrazd_help.php"; ?></td>
<td valign="top"><? require "page_sort_podrazd.php"; ?></td>
<?
}
elseif ($page_sort_podrazd_ok==="yes")
{
?>
<td valign="top"><? require "page_sort_podrazd_ok.php"; ?></td>
<?
}
elseif ($page_del_all==="yes")
{
?>
<td valign="top"><? require "page_del_all.php"; ?></td>
<?
}
elseif ($page_del_razdel==="yes")
{
	if (mysql_query("DELETE FROM `admins_page` WHERE ids_razdel='$ids'")===true)
	{echo "<div class=blue1 align=center>Удаление прошло успешно</div>";
	print "<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?page=yes&page_show=yes'>";}
	else {echo mysql_errno();}
}
elseif ($page_del_podrazdel==="yes")
{
	$ids_razdel="";$ids_razdel=$_GET['ids_razdel'];
	$ids_podrazdel="";$ids_podrazdel=$_GET['ids_podrazdel'];
 	if (mysql_query("DELETE FROM `admins_page` WHERE ids_razdel='$ids_razdel' && ids_podrazdel='$ids_podrazdel'")===true)
	{echo "<div class=blue1 align=center>Удаление прошло успешно</div>";
	print "<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?page=yes&page_show=yes'>";}
	else {echo mysql_errno();}
}
}
?>