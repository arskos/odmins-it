<?
$my=mysql_query("SELECT * FROM `admins_user` WHERE LOGIN='$login';");
$main=mysql_fetch_array($my);
if ($main['humor']==1)
{
if ($humor_show==="yes")
{
$humor_kol="";
$humor_kol=$_GET['humor_kol'];
if (empty($humor_kol)) {$humor_kol=1;}
?>
<td width="154" valign="top"><? require "humor_show_help.php"; ?></td>
<td valign="top"><? require "humor_show.php"; ?></td>
<?
}
elseif ($humor_add==="yes")
{
?>
<td width="154" valign="top"><? require "humor_add_help.php"; ?></td>
<td valign="top"><? require "humor_add.php"; ?></td>
<?
}
elseif ($humor_edit==="yes")
{
?>
<td width="154" valign="top"><? require "humor_edit_help.php"; ?></td>
<td valign="top"><? require "humor_edit.php"; ?></td>
<?
}
elseif ($humor_add_vis==="yes")
{
?>
<td valign="top"><? require "humor_add_vis.php"; ?></td>
<?
}
elseif ($humor_edit_vis==="yes")
{
?>
<td valign="top"><? require "humor_edit_vis.php"; ?></td>
<?
}
elseif ($humor_add_ok==="yes")
{
?>
<td valign="top"><? require "humor_add_ok.php"; ?></td>
<?
}
elseif ($humor_edit_ok==="yes")
{
?>
<td valign="top"><? require "humor_edit_ok.php"; ?></td>
<?
}
elseif ($humor_del==="yes")
{
	if (mysql_query("DELETE FROM `admins_humor` WHERE id='$ids'")===true)
	{echo "<div class=blue1 align=center>Удаление прошло успешно</div>";
	print "<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?humor=yes&humor_show=yes'>";}
	else {echo mysql_errno();}
}
elseif ($humor_del_all==="yes")
{
?>
<td valign="top"><? require "humor_del_all.php"; ?></td>
<?
}
}