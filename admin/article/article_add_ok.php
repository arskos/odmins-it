<div class=blue1 align=center>
<?
$days=$_POST['days'];
$article_por=$_POST['article_por'];
$article_title=$_POST['article_title'];
$article_anons=$_POST['article_anons'];
$article_full=$_POST['article_full'];
$title=$_POST['title'];
$desc=$_POST['desc'];
$word=$_POST['word'];
$status=$_POST['status'];
if (!empty($article_por))
{
	if (!empty($article_title))
	{
		if ((mysql_query("INSERT INTO `admins_article` VALUES ('$article_por','$article_title','$article_anons','$article_full','$title','$desc','$word','$status');"))===true)
			{echo "<p class=blue1 align=center>Запись прошла успешно</p>";
			?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?article=yes&article_show=yes&ids=<?echo $article_por;?>'><?}
		else {echo mysql_error();}
	}
	else {?> Ошибка. Не введен заголовок статьи<br>
<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
}
else
{?>Ошибка. Не введен порядок статьи<br>
<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
?>
</div>