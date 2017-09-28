<div class=blue1 align=center>
<?
$news_ids=$_POST['news_ids'];
$days=$_POST['days'];
$mounth=$_POST['mounth'];
$years=$_POST['years'];
$news_anons=htmlspecialchars($_POST['news_anons'],ENT_QUOTES);
$news_full=htmlspecialchars($_POST['news_full'],ENT_QUOTES);
if ($days<10) {$days="0".$days;}
if ($mounth<10) {$mounth="0".$mounth;}
$dates=$years."-".$mounth."-".$days;
if ((checkdate($mounth, $days, $years))===true)
{
	if (!empty($news_anons))
	{
		if (!empty($news_full))
		{
			if ((mysql_query("UPDATE `admins_news` SET data='$dates', news_anons='$news_anons',news_full='$news_full' WHERE id='$news_ids';"))===true)
				{echo "Обновление прошло успешно";?>
				<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?news=yes&news_show=yes&ids=<?echo $news_ids;?>'><?}
			else {echo mysql_error();}
		}
		else {?> Ошибка. Не введен полный текст новости<br>
	<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
	}
	else
	{?>Ошибка. Не введен анонс новости<br>
	<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
}
else {?>Ошибка. Неправильно введена дата<br>
<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
?>
</div>