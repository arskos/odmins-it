<div class=blue1 align=center>
<?
$y=1;
$mails_user_check=array();
if($_POST['action'] == 'send'){$mails_user_check=($_POST['mails_user_check']);}
foreach($mails_user_check as $key => $value)
{
if (mysql_query("DELETE FROM `mail_user_tasman` WHERE id='$value'")===true)
	{$y++;}
else {echo mysql_errno();}
}
echo "Всего удалено ".($y-1)." записей";
?>
</div>
<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?mails=yes&mails_user_show=yes'>