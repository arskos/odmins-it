<form action="admin.php" method="post" name="article_show">
<table width="100%"  border="0" cellspacing="1" cellpadding="3">
<tr class="blue1">
	<td width="6%" height="21" background="imgadm/mm_top2.gif" class="blue1">�</td>
	<td width="30%" background="imgadm/mm_top2.gif" class="blue1">��������</td>
	<td width="45%" background="imgadm/mm_top2.gif" class="blue1">�����</td>
	<td width="10%" background="imgadm/mm_top2.gif" class="blue1">������</td>
	<td width="3%" background="imgadm/mm_top2.gif"><img src="imgadm/iedit.gif" alt="��������������" width="26" height="15"></td>
	<td width="3%" background="imgadm/mm_top2.gif"><img src="imgadm/idel.gif" alt="��������" width="26" height="15"></td>
	<td width="3%" background="imgadm/mm_top2.gif"><img src="imgadm/isel.gif" alt="��������" width="25" height="15"></td>
</tr>
<?
$my=mysql_query("SELECT * FROM `admins_article` ORDER BY id;");
if (mysql_num_rows($my)==true)
{
$kol_rows=mysql_num_rows($my);
//����� 10 �������
if (empty($ids)) {$article_kol=($article_kol-1)*10;}
else 
{
	$i=0;
	while ($main=mysql_fetch_array($my))
	{if ($main['id']===$ids) {$its=$i;} $i++;}
	$article_kol=floor($its/10);
	if ($article_kol!=0){$article_kol=$article_kol*10;}
}
$my=mysql_query("SELECT * FROM `admins_article` ORDER BY id DESC LIMIT $article_kol,10;");
$i=0;
while ($main=mysql_fetch_array($my))
{
	if ($i%2==0){?>
<tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#FFFFFF'">
<?} else {?><tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#F8FAFC'" bgcolor="F8FAFC"><?}?>
		<td class="blue1"><?echo $main['id'];?></td>
		<td class="blue1"><div align="justify"><span class="ntxt"><?echo $main['name'];?></td>
		<td class="blue1"><div align="justify"><span class="ntxt"><?echo $main['anons'];?></td>
		<td class="blue1"><div align="justify"><span class="ntxt"><?if ($main['status']==1) {echo "������������";}else {echo "�� ������������";};?></td>
		<td><div align="center"><a href="admin.php?article=yes&article_edit=yes&article_ids=<?echo $main['id'];?>"><img src="imgadm/b_edit.gif" alt="�������������" width="20" height="20" border="0"></a></div></td>
		<td ><div align="center"><a href="#" onClick=answer_article(<?echo $main['id'];?>)><img src="imgadm/b_del.gif" alt="�������" width="20" height="20" border="0"></a></div></td>
		<td ><div align="center">
			<input name="article_check[<? echo $i;?>]" type="checkbox" class="fld" value="<?echo $main['id'];?>"></div>
		</td>
	</tr>
<?
$i++;
}
?>
<tr>
	<td height="21" colspan="7" bgcolor="EFEFEF" class="blue1">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="21" width="22"><a href="#" onClick=querys_article()><img src="imgadm/b_del.gif" width="20" height="20" border="0"></a></td>
			<td width="573"><a href="#" class="blue1" onClick=querys_article()>������� ��� ���������� </a></td>
			<td width="20"><input name="checkbox" type="checkbox" class="fld" value="checkbox" onClick=F(this.form)></td>
			<td width="87" class="blue1">�������� ��� </td>
			<input type="hidden" name="article_post" value="yes">
			<input type="hidden" name="article_del_all" value="yes">
			<input type="hidden" name="article_kol_check" value="<? echo $i;?>">
			<input name="action" type="hidden" value="send">
		</tr>
		</table>
	</td>
</tr>
<?}?>
</table>
<table border="0" cellspacing="1" cellpadding="3" align="right">
<tr>
<?
if ($kol_rows>10)
{
	$del=5;
	$kol_str=ceil($kol_rows/10);
	if (($kol_str>$del) && (($article_kol/10+1)>$del))
	{$st=$article_kol/10+1;}
	else{$st=1;}
	for ($i=1;$i<=$kol_str; ($i=$i+$del))
	{
		if (($st>=$i) && ($st<=($i+$del-1))) {$start=$i;}
	}
	if (($kol_str>$del) && (($start+$del-1)<$kol_str)){$fin=$start+$del-1;}
	else {$fin=$kol_str;}	
	if ($start>$del)
	{
		echo "<td>";
		echo "<a href='admin.php?article=yes&article_show=yes&article_kol=".($start-$del)."' class='pg'>&lt&lt</a>";
		echo "</td>";
	}
	for ($i=$start;$i<=$fin;$i++)
	{
		echo "<td>";
		if ($i==($article_kol/10+1)) {echo "<span class='pgsel'>".$i."</span>";}
		else {echo "<a href='admin.php?article=yes&article_show=yes&article_kol=".$i."' class='pg'>".$i."</a>";}
		echo "</td>";
	}
	if (($kol_rows>($del*10)) and ((($start+$del))<=$kol_str))
	{
		echo "<td>";
		echo "<a href='admin.php?article=yes&article_show=yes&article_kol=".($fin+1)."' class='pg'>&gt&gt</a>";
		echo "</td>";
	}
}
?>
</tr>
</table>
</form>
