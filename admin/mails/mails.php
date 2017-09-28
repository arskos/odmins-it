<?
$my=mysql_query("SELECT * FROM `user_tasman` WHERE LOGIN='$login';");
$main=mysql_fetch_array($my);
if ($main['mail']==1)
{
if ($mails_show==="yes")
{
$mails_kol="";
$mails_kol=$_GET['mails_kol'];
if (empty($mails_kol)) {$mails_kol=1;}
?>
<td width="154" valign="top"><? require "mails_show_help.php"; ?></td>
<td valign="top"><? require "mails_show.php"; ?></td>
<?
}
elseif ($mails_add==="yes")
{
?>
<td width="154" valign="top"><? require "mails_add_help.php"; ?></td>
<td valign="top"><? require "mails_add.php"; ?></td>
<?
}
elseif ($mails_add_vis==="yes")
{
?>
<td valign="top"><? require "mails_add_vis.php"; ?></td>
<?
}
elseif ($mails_add_ok==="yes")
{
?>
<td valign="top"><? require "mails_add_ok.php"; ?></td>
<?
}
elseif ($mails_conf==="yes")
{
?>
<td width="154" valign="top"><? require "mails_conf_help.php"; ?></td>
<td valign="top"><? require "mails_conf.php"; ?></td>
<?
}
elseif ($mails_conf_ok==="yes")
{
?>
<td valign="top"><? require "mails_conf_ok.php"; ?></td>
<?
}
elseif ($mails_edit==="yes")
{
?>
<td width="154" valign="top"><? require "mails_edit_help.php"; ?></td>
<td valign="top"><? require "mails_edit.php"; ?></td>
<?
}
elseif ($mails_edit_vis==="yes")
{
?>
<td valign="top"><? require "mails_edit_vis.php"; ?></td>
<?
}
elseif ($mails_edit_ok==="yes")
{
?>
<td valign="top"><? require "mails_edit_ok.php"; ?></td>
<?
}
elseif ($mails_del==="yes")
{
	if (mysql_query("DELETE FROM `mail_tasman` WHERE id='$ids'")===true)
	{echo "<div class=blue1 align=center>Удаление прошло успешно</div>";
	print "<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?mails=yes&mails_show=yes'>";}
	else {echo mysql_errno();}
}
elseif ($mails_del_all==="yes")
{
?>
<td valign="top"><? require "mails_del_all.php"; ?></td>
<?
}
elseif ($mails_user_show==="yes")
{
$mails_kol="";
$mails_kol=$_GET['mails_kol'];
if (empty($mails_kol)) {$mails_kol=1;}
?>
<td width="154" valign="top"><? require "mails_user_show_help.php"; ?></td>
<td valign="top"><? require "mails_user_show.php"; ?></td>
<?
}
elseif ($mails_user_add==="yes")
{
?>
<td width="154" valign="top"><? require "mails_user_add_help.php"; ?></td>
<td valign="top"><? require "mails_user_add.php"; ?></td>
<?
}
elseif ($mails_user_add_ok==="yes")
{
?>
<td valign="top"><? require "mails_user_add_ok.php"; ?></td>
<?
}
elseif ($mails_user_edit==="yes")
{
?>
<td width="154" valign="top"><? require "mails_user_edit_help.php"; ?></td>
<td valign="top"><? require "mails_user_edit.php"; ?></td>
<?
}
elseif ($mails_user_edit_ok==="yes")
{
?>
<td valign="top"><? require "mails_user_edit_ok.php"; ?></td>
<?
}
elseif ($mails_user_del==="yes")
{
	if (mysql_query("DELETE FROM `mail_user_tasman` WHERE id='$ids'")===true)
	{echo "<div class=blue1 align=center>Удаление прошло успешно</div>";
	print "<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?mails=yes&mails_user_show=yes'>";}
	else {echo mysql_errno();}
}
elseif ($mails_user_del_all==="yes")
{
?>
<td valign="top"><? require "mails_user_del_all.php"; ?></td>
<?
}
elseif ($mails_sends==="yes")
{
?>
<td width="154" valign="top"><? require "mails_send_help.php"; ?></td>
<td valign="top"><? require "mails_send.php"; ?></td>
<?
}
elseif ($mails_sends_ok==="yes")
{
?>
<td valign="top"><? require "mails_send_ok.php"; ?></td>
<?
}
}