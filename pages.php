<?
if (empty($ids_podrazdel))
{
	$my=mysql_query("SELECT * FROM `admins_page` WHERE ids_razdel='$ids_razdel' && ids_podrazdel='1';");
}
else
{
	$my=mysql_query("SELECT * FROM `admins_page` WHERE ids_razdel='$ids_razdel' && ids_podrazdel='$ids_podrazdel';");
}
	$main=mysql_fetch_array($my);
?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr valign="top">
	<td height="24" style="padding-left:17px;" valign="top" ><h1><?echo $main['name'];?></h1></td>
</tr>
<tr valign="top">
			<td valign="top" class="txt"><?echo html_entity_decode($main['kod']);?></td>
</tr>
</table>