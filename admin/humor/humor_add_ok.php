<div class=blue1 align=center>
<?
$days=$_POST['days'];
$mounth=$_POST['mounth'];
$years=$_POST['years'];
$humor_anons=htmlspecialchars($_POST['humor_anons'],ENT_QUOTES);
$humor_full=htmlspecialchars($_POST['humor_full'],ENT_QUOTES);
if ($days<10) {$days="0".$days;}
if ($mounth<10) {$mounth="0".$mounth;}
$dates=$years."-".$mounth."-".$days;
$status=$_POST['status'];
$max=mysql_result((mysql_query("SELECT MAX(id) FROM `admins_humor`;")),0);
$max++;
echo $dates;
if ((checkdate($mounth, $days, $years))===true)
{
	if (!empty($humor_full))
	{
		if ((mysql_query("INSERT INTO `admins_humor` VALUES ('$max','$dates','$humor_full','$status');"))===true)
			{echo "<p class=blue1 align=center>Запись прошла успешно</p>";
			?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?humor=yes&humor_show=yes&ids=<?echo $max;?>'><?}
		else {echo mysql_error();}
	}
	else {?> Ошибка. Не введен полный текст новости<br>
<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
}
else {?>Ошибка. Неправильно введена дата<br>
<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
?>
</div>