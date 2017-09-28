<form name="page_sort_razd" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="1" cellpadding="3">
<tr class="blue1">
	<td width="7%" height="21" background="imgadm/mm_top2.gif" class="blue1">№ р. </td>
	<td width="43%" height="21" background="imgadm/mm_top2.gif" class="blue1">Разделы</td>
	<td width="7%" background="imgadm/mm_top2.gif">№ п.</td>
	<td width="43%" background="imgadm/mm_top2.gif">Подразделы<nobr></nobr></td>
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
		<td class="blue1"><a href="admin.php?page=yes&page_sort_podrazd=yes&ids=<?echo $main['ids_razdel'];?>" class="blue1"><?echo $main['ids_razdel'];?></a></td>
		<td class="blue1"><a href="admin.php?page=yes&page_sort_podrazd=yes&ids=<?echo $main['ids_razdel'];?>" class="blue1"><?echo $main['name'];?></a></td>
		<td class="blue1">&nbsp;</td>
		<td class="blue1">&nbsp;</td>
	</tr>
	<?
	if (!empty($ids))
	{
		if ($ids==$main['ids_razdel'])
		{
			$my2=mysql_query("SELECT * FROM `admins_page` WHERE ids_podrazdel<>'1' && ids_razdel='$ids' ORDER BY ids_razdel,ids_podrazdel;");
			if (mysql_num_rows($my2)==true)
			{
				while ($main2=mysql_fetch_array($my2))
				{
					if ($i%2==0)
		{?><tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#FFFFFF'"><?} 
		else{?><tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#F8FAFC'" bgcolor="F8FAFC"><?}?>	
				<td class="blue1">&nbsp;</td>
				<td class="blue1">&nbsp;</td>
				<td class="blue1"><input name="razdel[<?echo $main2['ids_podrazdel'];?>]" type="text" class="blue1" size="4" maxlength="4" value="<?echo $main2['ids_podrazdel'];?>" onBlur="validate(this);"></td>
				<td class="blue1"><?echo $main2['name'];?></td>
			</tr>
				<?}
			}
		}
	}
	$i++;
	}
}
?>
</table>
<input type="hidden" name="page_sort_podrazd_ok" value="yes">
<input type="hidden" name="ids_razdel" value="<?echo $ids;?>">
<input type="hidden" name="page_post" value="yes">
<input name="action" type="hidden" value="send">
</form>