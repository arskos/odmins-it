<div class=blue1 align=center>
<?
echo "<strong>Статистика по записи 1-го пользователя:</strong><br>";
if ((isset($_POST['emails1'])) && (!empty($_POST['emails1'])))
{
	$emails1=$_POST['emails1'];
	if (isset($_POST['day1'])) $day1=$_POST['day1']; else $day1="";
	if (isset($_POST['mounth1'])) $mounth1=$_POST['mounth1']; else $mounth1="";
	if (isset($_POST['year1'])) $year1=$_POST['year1']; else $year1="";
	if (isset($_POST['comment1'])) $comment1=$_POST['comment1']; else $comment1="";
	if (preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $emails1))
	{
		$my=mysql_query("SELECT * FROM `mail_user_tasman` WHERE mails_email='$emails1'");
		if (mysql_num_rows($my)!=true)
		{
			if ((checkdate($mounth1, $day1, $year1))===true)
			{
				$dates_ok=$year1."-".$mounth1."-".$day1;
				if ((mysql_query("INSERT INTO `mail_user_tasman` VALUES (NULL,'$dates_ok','$emails1','$comment1');"))===true)
					{echo "<p class=blue1 align=center>Запись 1-го пользователя прошла успешно</p>";}
				else {echo mysql_error();}
			}
			else {?>Ошибка. Неправильно введена дата<br><?}
		}
		else {?>Ошибка. Такой email уже существует<br><?}
	}
	else {?>Ошибка. Введен неправильный email<br><?}
}
else {$emails1=""; echo "Ошибка. Не введен email";}
echo "<br><br>";
echo "<strong>Статистика по записи 2-го пользователя:</strong><br>";
if ((isset($_POST['emails2'])) && (!empty($_POST['emails2'])))
{
	$emails2=$_POST['emails2']; 
	if (isset($_POST['day2'])) $day2=$_POST['day2']; else $day2="";
	if (isset($_POST['mounth2'])) $mounth2=$_POST['mounth2']; else $mounth2="";
	if (isset($_POST['year2'])) $year2=$_POST['year2']; else $year2="";
	if (isset($_POST['comment2'])) $comment2=$_POST['comment2']; else $comment2="";
	if (preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $emails2))
	{
		$my=mysql_query("SELECT * FROM `mail_user_tasman` WHERE mails_email='$emails2'");
		if (mysql_num_rows($my)!=true)
		{
			if ((checkdate($mounth2, $day2, $year2))===true)
			{
				$dates_ok=$year2."-".$mounth2."-".$day2;
				if ((mysql_query("INSERT INTO `mail_user_tasman` VALUES (NULL,'$dates_ok','$emails2','$comment2');"))===true)
					{echo "<p class=blue2 align=center>Запись 2-го пользователя прошла успешно</p>";}
				else {echo mysql_error();}
			}
			else {?>Ошибка. Неправильно введена дата<br><?}
		}
		else {?>Ошибка. Такой email уже существует<br><?}
	}
	else {?>Ошибка. Введен неправильный email<br><?}
}
else {$emails2=""; echo "Ошибка. Не введен email";}
echo "<br><br>";
echo "<strong>Статистика по записи 3-го пользователя:</strong><br>";
if ((isset($_POST['emails3'])) && (!empty($_POST['emails3'])))
{
	$emails3=$_POST['emails3']; 
	if (isset($_POST['day3'])) $day3=$_POST['day3']; else $day3="";
	if (isset($_POST['mounth3'])) $mounth3=$_POST['mounth3']; else $mounth3="";
	if (isset($_POST['year3'])) $year3=$_POST['year3']; else $year3="";
	if (isset($_POST['comment3'])) $comment3=$_POST['comment3']; else $comment3="";
	if (preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $emails3))
	{
		$my=mysql_query("SELECT * FROM `mail_user_tasman` WHERE mails_email='$emails3'");
		if (mysql_num_rows($my)!=true)
		{
			if ((checkdate($mounth3, $day3, $year3))===true)
			{
				$dates_ok=$year3."-".$mounth3."-".$day3;
				if ((mysql_query("INSERT INTO `mail_user_tasman` VALUES (NULL,'$dates_ok','$emails3','$comment3');"))===true)
					{echo "<p class=blue3 align=center>Запись 3-го пользователя прошла успешно</p>";}
				else {echo mysql_error();}
			}
			else {?>Ошибка. Неправильно введена дата<br><?}
		}
		else {?>Ошибка. Такой email уже существует<br><?}
	}
	else {?>Ошибка. Введен неправильный email<br><?}
}
else {$emails3=""; echo "Ошибка. Не введен email";}
?>
<br><br><br>
<strong>Основываясь на полученной статистики записи Вы можете:</strong><br>
<a href="admin.php?mails=yes&mails_user_show=yes" class="blue1">перейти к просмотру пользователей</a><br>
или<br>
<a href="javascript:history.back(1)" class="blue1">вернуться к редактированию</a>
</div>