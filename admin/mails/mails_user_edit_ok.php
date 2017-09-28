<div class=blue1 align=center>
<?
if ((isset($_POST['emails'])) && (!empty($_POST['emails'])))
{
	$emails=$_POST['emails'];
	if (isset($_POST['days'])) $days=$_POST['days']; else $days="";
	if (isset($_POST['mounths'])) $mounths=$_POST['mounths']; else $mounths="";
	if (isset($_POST['years'])) $years=$_POST['years']; else $years="";
	if (isset($_POST['comment'])) $comment=$_POST['comment']; else $comment="";
	if (isset($_POST['emails_temp'])) $emails_temp=$_POST['emails_temp']; else $emails_temp="";
	if (isset($_POST['emails_ids'])) $emails_ids=$_POST['emails_ids']; else $emails_ids="";
	if (preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $emails))
	{
		if ((checkdate($mounths, $days, $years))===true)
		{
			if ($emails===$emails_temp)
			{
				$dates_ok=$years."-".$mounths."-".$days;
				if ((mysql_query("UPDATE `mail_user_tasman` SET data='$dates_ok',mails_email='$emails',mails_comment='$comment' WHERE id='$emails_ids';"))===true)
					{echo "<p class=blue1 align=center>Запись прошла успешно</p>";
					?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?mails=yes&mails_user_show=yes&ids=<?echo $emails_ids;?>'><?}
				else {echo mysql_error();}
			}
			else
			{
				$my=mysql_query("SELECT * FROM `mail_user_tasman` WHERE mails_email='$emails'");
				if (mysql_num_rows($my)!=true)
				{
					$dates_ok=$years."-".$mounths."-".$days;
					if ((mysql_query("UPDATE `mail_user_tasman` SET data='$dates_ok',mails_email='$emails',mails_comment='$comment' WHERE id='$emails_ids';"))===true)
						{echo "<p class=blue1 align=center>Запись прошла успешно</p>";
						?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?mails=yes&mails_user_show=yes&ids=<?echo $emails_ids;?>'><?}
					else {echo mysql_error();}				
				}
				else {?>Ошибка. Такой email уже существует<br><?}
			}
		}
		else {?>Ошибка. Неправильно введена дата<br><?}
	}
	else {?>Ошибка. Такой email уже существует<br><?}
}
else {?>Ошибка. Введен неправильный email<br><?}
?>
</div>