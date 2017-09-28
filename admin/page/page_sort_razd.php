<form name="page_sort_razd" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="1" cellpadding="3">
<tr class="blue1">
	<td width="7%" height="21" background="imgadm/mm_top2.gif" class="blue1">№ р. </td>
	<td width="93%" height="21" background="imgadm/mm_top2.gif" class="blue1">Разделы</td>
</tr>
<?
$my=mysql_query("SELECT * FROM `admins_page` WHERE ids_podrazdel='1' ORDER BY ids_razdel;");
if (mysql_num_rows($my)==true)
{
	$i=0;
	while ($main=mysql_fetch_array($my))
	{
		if ($i%2==0)
		{?><tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#FFFFFF'"><?} 
		else{?><tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#F8FAFC'" bgcolor="F8FAFC"><?}
		?>
		<td class="blue1"><input name="razdel[<?echo $main['ids_razdel'];?>]" type="text" class="blue1" size="4" maxlength="4" value="<?echo $main['ids_razdel'];?>" onBlur="validate(this);"></td>
	<td class="blue1"><?echo $main['name'];?></td>
	</tr>
	<?
	$i++;
	}
}
?>
</table>
<input type="hidden" name="page_sort_razd_ok" value="yes">
<input type="hidden" name="page_post" value="yes">
<input name="action" type="hidden" value="send">
</form>