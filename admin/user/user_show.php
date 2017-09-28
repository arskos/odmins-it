<?
$my=mysql_query("SELECT * FROM `admins_user` ORDER BY id;");
?>
<form name="user_show" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="1" cellpadding="3">
<tr class="blue1">
	<td width="16%" height="21" background="imgadm/mm_top2.gif">Логин</td>
	<td width="16%" height="21" background="imgadm/mm_top2.gif">Пароль</td>
	<td width="40%" height="21" background="imgadm/mm_top2.gif">Полное имя</td>
	<td width="16%" height="21" background="imgadm/mm_top2.gif">Роль</td>
	<td width="4%" background="imgadm/mm_top2.gif"><img src="imgadm/iedit.gif" alt="Редактирование" width="26" height="15"></td>
	<td width="4%" background="imgadm/mm_top2.gif"><img src="imgadm/idel.gif" alt="Удаление" width="26" height="15"></td>
	<td width="4%" background="imgadm/mm_top2.gif"><img src="imgadm/isel.gif" alt="Выделение" width="25" height="15"></td>
</tr>
<?
$i=0;
while ($main=mysql_fetch_array($my))
{
		if ($i%2==0){?>
<tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#FFFFFF'">
<?} else {?><tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#F8FAFC'" bgcolor="F8FAFC"><?}?>
	<td class="blue1" width="16%" height="21"><?echo $main['login'];?></td>
	<td class="blue1" width="16%" height="21""><?echo $main['pas'];?></td>
	<td class="blue1" width="16%" height="21"><?echo $main['full_name'];?></td>
	<td class="blue1" width="16%" height="21"><?echo $main['role'];?></td>
<?if ($main['role']!=='admin'){?>
	<td><div align="center"><a href="admin.php?user=yes&user_edit=yes&user_ids=<?echo $main['id'];?>"><img src="imgadm/b_edit.gif" alt="Редактировать" width="20" height="20" border="0"></a></div></td>
	<td ><div align="center"><a href="#" onClick=answer_user(<?echo $main['id'];?>)><img src="imgadm/b_del.gif" alt="Удалить" width="20" height="20" border="0"></a></div></td>
	<td ><div align="center">
		<input name="vpage_check[<? echo $i;?>]" type="checkbox" class="fld" value="<?echo $main['id'];?>"></div>
	</td>
<?}else{?><td><div align='center'><a href="admin.php?user=yes&user_edit=yes&user_ids=<? echo $main['id'];?>"><img src="imgadm/b_edit.gif" alt='Редактировать' width='20' height='20' border='0'></a></div></td><td></td><td></td><?}$i++;?>
</tr>
<?}?>
<tr>
	<td height="21" colspan="7" bgcolor="EFEFEF" class="blue1">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="21" width="22"><a href="#" onClick="querys_user();"><img src="imgadm/b_del.gif" width="20" height="20" border="0"></a></td>
			<td width="573"><a href="#" class="blue1" onClick="querys_user();">удалить все выделенные </a></td>
			<td width="20"><input name="checkbox" type="checkbox" class="fld" value="checkbox" onClick=F(this.form)></td>
			<td width="87" class="blue1">Выделить все </td>
		</tr>
		<tr>
		<td>
			<input type="hidden" name="user_post" value="yes">
			<input type="hidden" name="user_del_all" value="yes">
			<input type="hidden" name="user_kol_check" value="<? echo $i;?>">
			<input name="action" type="hidden" value="send">
		</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</form>