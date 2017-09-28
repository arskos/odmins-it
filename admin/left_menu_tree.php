<?
	$my = mysql_query("SELECT * FROM `admins_page` WHERE ids_podrazdel='1' ORDER BY ids_razdel");
	if (mysql_num_rows($my)==true)
	{
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<?
		while ($main=mysql_fetch_array($my))
		{
			if ($main['soderganie']==='news')
			{?>
<tr>
	<td width="19" valign="top"><img src="imgadm/bullm.gif" width="19" height="21"></td>
	<td><a href="admin.php?news=yes&news_edit=yes" class="mm"><?echo $main['name'];?></a></td>
			<?}
 			elseif ($main['soderganie']==='article')
			{
?>
<tr>
	<td width="19" valign="top"><img src="imgadm/bullm.gif" width="19" height="21"></td>
	<td><a href="admin.php?article=yes&article_show=yes" class="mm"><? echo $main['name'];?></a></td>
</tr>
<?			
			}
 			elseif ($main['soderganie']==='humor')
			{
?>
<tr>
	<td width="19" valign="top"><img src="imgadm/bullm.gif" width="19" height="21"></td>
	<td><a href="admin.php?humor=yes&humor_show=yes" class="mm"><? echo $main['name'];?></a></td>
</tr>
<?			
			}
			else
			{
			if (!empty($main['soderganie']))
			{
?>
<tr>
	<td width="19" valign="top"><img src="imgadm/bullm.gif" width="19" height="21"></td>
	<td><a href="admin.php?page=yes&page_edit=yes&razd=Раздел&ids_razdel=<?echo $main['ids_razdel'];?>" class="mm"><?echo $main['name'];?></a></td>
</tr>
<?
			}
			else
			{
?>
<tr>
	<td width="19" valign="top"><img src="imgadm/bullm.gif" width="19" height="21"></td>
	<td><a href="admin.php?page=yes&page_edit=yes&razd=Раздел&ids_razdel=<?echo $main['ids_razdel'];?>" class="mm"><?echo $main['name'];?></a></td>
</tr>
<?
			}
			if (!empty($ids_razdel))
			{
				$my2 = mysql_query("SELECT * FROM `admins_page` WHERE ids_razdel='$ids_razdel' && ids_podrazdel<>'1' ORDER BY ids_razdel,ids_podrazdel");
				if (mysql_num_rows($my2)==true)
				{
					if ($ids_razdel===$main['ids_razdel'])
					{
					?>
<tr>
	<td valign="top">&nbsp;</td>
	<td>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<?
					while ($main2=mysql_fetch_array($my2))
					{
					?>
<tr>
	<td width="19" valign="top"><img src="imgadm/bullm.gif" width="19" height="21"></td>
	<td><a href="admin.php?page=yes&page_edit=yes&razd=Подраздел&ids_razdel=<?echo $main2['ids_razdel'];?>&ids_podrazdel=<?echo $main2['ids_podrazdel'];?>" class="blue1"><?echo $main2['name'];?></a></td>
</tr>
					<?
					}
					?>
		</table>
	</td>
</tr>
				<?}}
			}
			}
			}
		}
	?>
</table>