<div class=blue1 align=center>
<?
if($_POST['action'] == 'send'){$razdel=($_POST['razdel']);}
//��������, ��� �� ����������
//������ ����� ������, ���� � ����������� ���� ����������, �� ��� ���������
$result = array_unique ( $razdel );
$i=0;$y=0;
//������� ���-�� ��-��� � ����� ��������
foreach($razdel as $key => $value)
{$i++;}
foreach($result as $key => $value)
{$y++;}
//���� ���-�� ��-��� ���������, �� ����������, ���� ���... �� ������
if ($i===$y)
{
foreach($razdel as $key => $value)
{
	$my=mysql_query("SELECT * FROM `admins_page` ORDER BY ids_razdel;");
	while ($main=mysql_fetch_array($my))
	{
		$value_temp="99999".$value;
 		if ((mysql_query("UPDATE `admins_page` SET ids_razdel='$value_temp' WHERE ids_razdel='$key'"))===false)
			{echo mysql_error();}
	}
}
$my=mysql_query("SELECT * FROM `admins_page` ORDER BY ids_razdel;");
while ($main=mysql_fetch_array($my))
{
	$temp_ids=substr($main['ids_razdel'],0,5);
	$ids=$main['ids_razdel'];
	if ($temp_ids==="99999")
	{
		$real_ids=substr($main['ids_razdel'],5);
		if ((mysql_query("UPDATE `admins_page` SET ids_razdel='$real_ids' WHERE ids_razdel='$ids'"))===false)
			{echo mysql_error();}
	}
}
echo "<p>���������� ������ �������</p>";
	?> <META HTTP-EQUIV='REFRESH' content='3; url=admin.php?page=yes&page_show=yes'>
<?}
else {?>������. ������� ������������� ������ ��������<br>
<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">��������� �����</a><?}?>
</div>