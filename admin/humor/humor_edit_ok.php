<div class=blue1 align=center>
<?
$humor_ids=$_POST['humor_ids'];
$days=$_POST['days'];
$mounth=$_POST['mounth'];
$years=$_POST['years'];
$status=$_POST['status'];
$humor_anons=htmlspecialchars($_POST['humor_anons'],ENT_QUOTES);
$humor_full=htmlspecialchars($_POST['humor_full'],ENT_QUOTES);
if ($days<10) {$days="0".$days;}
if ($mounth<10) {$mounth="0".$mounth;}
$dates=$years."-".$mounth."-".$days;
if ((checkdate($mounth, $days, $years))===true)
{
	if (!empty($humor_full))
	{
		if ((mysql_query("UPDATE `admins_humor` SET data='$dates', humor_full='$humor_full',status='$status' WHERE id='$humor_ids';"))===true)
			{echo "Обновление прошло успешно";?>
			<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?humor=yes&humor_show=yes&ids=<?echo $humor_ids;?>'><?}
		else {echo mysql_error();}
	}
	else {?> Ошибка. Не введен полный текст новости<br>
<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
}
else {?>Ошибка. Неправильно введена дата<br>
<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
?>
</div>