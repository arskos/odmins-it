<?
$my=mysql_query("SELECT * FROM `admins_user` WHERE LOGIN='$login';");
$main=mysql_fetch_array($my);
if ($main['article']==1)
{
if ($article_show==="yes")
{
$article_kol="";
$article_kol=$_GET['article_kol'];
if (empty($article_kol)) {$article_kol=1;}
?>
<td width="154" valign="top"><? require "article_show_help.php"; ?></td>
<td valign="top"><? require "article_show.php"; ?></td>
<?
}
elseif ($article_add==="yes")
{
?>
<td width="154" valign="top"><? require "article_add_help.php"; ?></td>
<td valign="top"><? require "article_add.php"; ?></td>
<?
}
elseif ($article_edit==="yes")
{
?>
<td width="154" valign="top"><? require "article_edit_help.php"; ?></td>
<td valign="top"><? require "article_edit.php"; ?></td>
<?
}
elseif ($article_add_vis==="yes")
{
?>
<td valign="top"><? require "article_add_vis.php"; ?></td>
<?
}
elseif ($article_edit_vis==="yes")
{
?>
<td valign="top"><? require "article_edit_vis.php"; ?></td>
<?
}
elseif ($article_add_ok==="yes")
{
?>
<td valign="top"><? require "article_add_ok.php"; ?></td>
<?
}
elseif ($article_edit_ok==="yes")
{
?>
<td valign="top"><? require "article_edit_ok.php"; ?></td>
<?
}
elseif ($article_del==="yes")
{
	if (mysql_query("DELETE FROM `admins_article` WHERE id='$ids'")===true)
	{echo "<div class=blue1 align=center>Удаление прошло успешно</div>";
	print "<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?article=yes&article_show=yes'>";}
	else {echo mysql_errno();}
}
elseif ($article_del_all==="yes")
{
?>
<td valign="top"><? require "article_del_all.php"; ?></td>
<?
}
}