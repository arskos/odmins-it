<form name="page_show" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="1" cellpadding="3">
<tr class="blue1">
	<td width="7%" height="21" background="imgadm/mm_top2.gif" class="blue1">№ р. </td>
	<td width="31%" height="21" background="imgadm/mm_top2.gif" class="blue1">Разделы</td>
	<td width="7%" background="imgadm/mm_top2.gif">№ п.</td>
	<td width="31%" background="imgadm/mm_top2.gif">Подразделы<nobr></nobr></td>
	<td width="12%" background="imgadm/mm_top2.gif">ЧПУ<nobr></nobr></td>
	<td width="4%" background="imgadm/mm_top2.gif"><img src="imgadm/iedit.gif" alt="Редактирование" width="26" height="15"></td>
	<td width="4%" background="imgadm/mm_top2.gif"><img src="imgadm/idel.gif" alt="Удаление" width="26" height="15"></td>
	<td width="4%" background="imgadm/mm_top2.gif"><img src="imgadm/isel.gif" alt="Выделение" width="25" height="15"></td>
</tr>
<?
$my=mysql_query("SELECT * FROM `admins_page` ORDER BY ids_razdel, ids_podrazdel;");
if (mysql_num_rows($my)==true)
{
	$i=0;
	while ($main=mysql_fetch_array($my))
	{
		if ($main['ids_podrazdel']==1)
		{
		if ($i%2==0){?>
<tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#FFFFFF'">
<?} else {?><tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#F8FAFC'" bgcolor="F8FAFC"><?}?>
	<td class="blue1"><?echo $main['ids_razdel'];?></td>
	<td class="blue1"><?echo $main['name'];?></td>
<td width="4%" class="blue1">&nbsp;</td>
	<td class="blue1">&nbsp;</td>
	<td class="blue1"><?echo $main['soderganie'];?></td>
<?if (($main['soderganie']!=="humor") and ($main['soderganie']!=="humor_add") and ($main['soderganie']!=="email") and ($main['soderganie']!=="article") and ($main['soderganie']!=="article_add")){?>
	<td><a href="admin.php?page=yes&page_edit=yes&razd=Раздел&ids_razdel=<?echo $main['ids_razdel'];?>"><img src="imgadm/b_edit.gif" alt="Редактировать" width="20" height="20" border="0"></a></td>
	<td><a href="#" onClick="answer_page_razdel(<?echo $main['ids_razdel'];?>)"><img src="imgadm/b_del.gif" alt="Удалить" width="20" height="20" border="0"></a></td>
	<td><input name="page_check[<? echo $i;?>]" type="checkbox" class="fld" value="<?echo $main['ids_razdel'];?>//1"></td>
<?}
else{?><td class="blue1">&nbsp;</td><td class="blue1">&nbsp;</td><td class="blue1">&nbsp;</td><?}?>
</tr>
<?		}
		else
		{
		if ($i%2==0){?>
<tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#FFFFFF'">
<?} else {?><tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#F8FAFC'" bgcolor="F8FAFC"><?}?>
	<td class="blue1">&nbsp;</td>
	<td class="blue1">&nbsp;</td>
	<td class="blue1"><?echo $main['ids_podrazdel'];?></td>
	<td class="blue1"><?echo $main['name'];?></td>
	<td class="blue1"><?echo $main['soderganie'];?></td>
	<td><a href="admin.php?page=yes&page_edit=yes&razd=Подраздел&ids_razdel=<?echo $main['ids_razdel'];?>&ids_podrazdel=<?echo $main['ids_podrazdel'];?>"><img src="imgadm/b_edit.gif" alt="Редактировать" width="20" height="20" border="0"></a></td>
	<td><a href="#" onClick="answer_page_podrazdel(<?echo $main['ids_razdel'].",".$main['ids_podrazdel'];?>)"><img src="imgadm/b_del.gif" alt="Удалить" width="20" height="20" border="0"></a></td>
	<td><input name="page_check[<? echo $i;?>]" type="checkbox" class="fld" value="<?echo $main['ids_razdel']."//".$main['ids_podrazdel'];?>"></td>
</tr>
<?
}$i++;}
?>
<tr>
	<td height="21" colspan="8" >
		<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#EFEFEF">
		<tr bgcolor="#FFFFFF">
			<td width="25" height="5"></td>
			<td width="692"></td>
			<td width="23"></td>
			<td width="79" ></td>
		</tr>
		<tr>
			<td><a href="#" onClick="querys_page();"><img src="imgadm/b_del.gif" width="20" height="20" border="0"></a></td>
			<td><a href="#" onClick="querys_page();" class="blue1">удалить все выделенные </a></td>
			<td><input name="checkbox" type="checkbox" class="fld" value="checkbox" onClick="F(this.form);"></td>
			<td><a href="#"  onClick="F(this.form);" class="blue1">Выделить все</a> </td>
		</tr>
		</table>
		<input type="hidden" name="page_del_all" value="yes">
		<input type="hidden" name="page_post" value="yes">
		<input name="action" type="hidden" value="send">
	</td>
</tr>
<?}?>
</table>
</form>