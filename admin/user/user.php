<?
$my=mysql_query("SELECT * FROM `admins_user` WHERE LOGIN='$login';");
$main=mysql_fetch_array($my);
if ($main['user']==1)
{
if ($user_show==="yes")
{
?>
<td width="154" valign="top"><? require "user_show_help.php"; ?></td>
<td valign="top"><? require "user_show.php"; ?></td>
<?
}
elseif ($user_add==="yes")
{
?>
<td width="154" valign="top"><? require "user_add_help.php"; ?></td>
<td valign="top"><? require "user_add.php"; ?></td>
<?
}
elseif ($user_add_ok==="yes")
{
?>
<td valign="top"><? require "user_add_ok.php"; ?></td>
<?
}
elseif ($user_edit==="yes")
{
?>
<td width="154" valign="top"><? require "user_edit_help.php"; ?></td>
<td valign="top"><? require "user_edit.php"; ?></td>
<?
}
elseif ($user_edit_ok==="yes")
{
?>
<td valign="top"><? require "user_edit_ok.php"; ?></td>
<?
}
elseif ($user_del==="yes")
{
	if (mysql_query("DELETE FROM `admins_user` WHERE id='$ids'")===true)
	{echo "<div class=blue1 align=center>Удаление прошло успешно</div>";
	print "<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?user=yes&user_show=yes'>";}
	else {echo mysql_errno();}
}
elseif ($user_del_all==="yes")
{
?>
<td valign="top"><? require "user_del_all.php"; ?></td>
<?
}
}
?>