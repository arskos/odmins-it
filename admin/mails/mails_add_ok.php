<div class=blue1 align=center>
<?
if (isset($_POST['days'])) $days=$_POST['days']; else $days="";
if (isset($_POST['mounth'])) $mounth=$_POST['mounth']; else $mounth="";
if (isset($_POST['years'])) $years=$_POST['years']; else $years="";
if (isset($_POST['mails_title'])) $mails_title=$_POST['mails_title']; else $mails_title="";
if (isset($_POST['mails_full'])) $mails_full=$_POST['mails_full']; else $mails_full="";
if ($days<10) {$days="0".$days;}
if ($mounth<10) {$mounth="0".$mounth;}
$dates=$years."-".$mounth."-".$days;
if ((checkdate($mounth, $days, $years))===true)
{
	if (!empty($mails_title))
	{
		if (!empty($mails_full))
		{
			if ((mysql_query("INSERT INTO `mail_tasman` VALUES (NULL,'$dates','$mails_title','$mails_full','0','0');"))===true)
				{echo "<p class=blue1 align=center>������ ������ �������</p>";
				?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?mails=yes&mails_show=yes'><?}
			else {echo mysql_error();}
		}
		else {?>������. �� ������� ��������<br>
		<a href="javascript:history.back(1)" class="blue1">��������� �����</a><?}
	}
	else {?>������. �� ������� ���� ��������<br>
	<a href="javascript:history.back(1)" class="blue1">��������� �����</a><?}
}
else {?>������. ����������� ������� ����<br>
<a href="javascript:history.back(1)" class="blue1">��������� �����</a><?}
?>
</div>