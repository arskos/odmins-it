<div class=blue1 align=center>
<?
if (isset($_POST['mails_st'])) $mails_st=$_POST['mails_st']; else $mails_st="";
if (isset($_POST['mails_fin'])) $mails_fin=$_POST['mails_fin']; else $mails_fin="";
if (isset($_POST['mails_email'])) $mails_email=$_POST['mails_email']; else $mails_email="";
if (preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $mails_email))
{
	if ((mysql_query("UPDATE `mail_conf_tasman` SET mails_st='$mails_st',mails_fin='$mails_fin',mails_email='$mails_email';"))===true)
			{echo "<p>Запись прошла успешно</p>";
				?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?mails=yes&mails_show=yes'><?}
			else {echo mysql_error();}
}
else {?>Ошибка. Введен неправильный email<br>
		<a href="javascript:history.back(1)" class="blue1">Вернуться назад</a><?}

?>
</div>