<div class=blue1 align=center>
<?
$vpage_name="";$vpage_name=$_POST['vpage_name'];
$vpage_comment="";$vpage_comment=$_POST['vpage_comment'];
$vpage_kod="";$vpage_kod=$_POST['vpage_kod'];
$vpage_ids="";$vpage_ids=$_POST['vpage_ids'];
if (!empty($vpage_name))
{
	$n = mysql_result((mysql_query("SELECT MAX(id) FROM `comperence_vpage`;")),0);
	$n++;
	$ssylka="index.php?vpage=".$n;
	if ((mysql_query("UPDATE `comperence_vpage` SET name='$vpage_name', kod='$vpage_kod', comment='$vpage_comment' WHERE id='$vpage_ids';"))===true)
	{echo "<p class=blue1 align=center>������ ������ �������</p>";
			?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?vpage=yes&vpage_show=yes'><?}
	else {echo mysql_error();}
}
else {?>������. �� ������� �������� ������� ��������<br>
<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">��������� �����</a><?}
?>
</div>