<?
if ($vpage_show==="yes")
{
$vpage_kol="";
$vpage_kol=$_GET['vpage_kol'];
if (empty($vpage_kol)) {$vpage_kol=1;}
?>
<td width="154" valign="top"><? require "vpage_show_help.php"; ?></td>
<td valign="top"><? require "vpage_show.php"; ?></td>
<?
}
elseif ($vpage_add==="yes")
{
?>
<td width="154" valign="top"><? require "vpage_add_help.php"; ?></td>
<td valign="top"><? require "vpage_add.php"; ?></td>
<?
}
elseif ($vpage_add_vis==="yes")
{
?>
<td valign="top"><? require "vpage_add_vis.php"; ?></td>
<?
}
elseif ($vpage_add_ok==="yes")
{
?>
<td valign="top"><? require "vpage_add_ok.php"; ?></td>
<?
}
elseif ($vpage_edit==="yes")
{
?>
<td width="154" valign="top"><? require "vpage_edit_help.php"; ?></td>
<td valign="top"><? require "vpage_edit.php"; ?></td>
<?
}
elseif ($vpage_edit_vis==="yes")
{
?>
<td valign="top"><? require "vpage_edit_vis.php"; ?></td>
<?
}
elseif ($vpage_edit_ok==="yes")
{
?>
<td valign="top"><? require "vpage_edit_ok.php"; ?></td>
<?
}
elseif ($vpage_del==="yes")
{
	if (mysql_query("DELETE FROM `comperence_vpage` WHERE id='$ids'")===true)
	{echo "<div class=blue1 align=center>Удаление прошло успешно</div>";
	print "<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?vpage=yes&vpage_show=yes'>";}
	else {echo mysql_errno();}
}
elseif ($vpage_del_all==="yes")
{
?>
<td valign="top"><? require "vpage_del_all.php"; ?></td>
<?
}