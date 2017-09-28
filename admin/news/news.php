<?
$my=mysql_query("SELECT * FROM `admins_user` WHERE LOGIN='$login';");
$main=mysql_fetch_array($my);
if ($main['news']==1)
{
if ($news_show==="yes")
{
$news_kol="";
$news_kol=$_GET['news_kol'];
if (empty($news_kol)) {$news_kol=1;}
?>
<td width="154" valign="top"><? require "news_show_help.php"; ?></td>
<td valign="top"><? require "news_show.php"; ?></td>
<?
}
elseif ($news_add==="yes")
{
?>
<td width="154" valign="top"><? require "news_add_help.php"; ?></td>
<td valign="top"><? require "news_add.php"; ?></td>
<?
}
elseif ($news_edit==="yes")
{
?>
<td width="154" valign="top"><? require "news_edit_help.php"; ?></td>
<td valign="top"><? require "news_edit.php"; ?></td>
<?
}
elseif ($news_add_vis==="yes")
{
?>
<td valign="top"><? require "news_add_vis.php"; ?></td>
<?
}
elseif ($news_edit_vis==="yes")
{
?>
<td valign="top"><? require "news_edit_vis.php"; ?></td>
<?
}
elseif ($news_add_ok==="yes")
{
?>
<td valign="top"><? require "news_add_ok.php"; ?></td>
<?
}
elseif ($news_edit_ok==="yes")
{
?>
<td valign="top"><? require "news_edit_ok.php"; ?></td>
<?
}
elseif ($news_del==="yes")
{
	if (mysql_query("DELETE FROM `admins_news` WHERE id='$ids'")===true)
	{echo "<div class=blue1 align=center>Удаление прошло успешно</div>";
	print "<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?news=yes&news_show=yes'>";}
	else {echo mysql_errno();}
}
elseif ($news_del_all==="yes")
{
?>
<td valign="top"><? require "news_del_all.php"; ?></td>
<?
}
}