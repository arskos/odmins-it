<div class=blue1 align=center>
<?
$razd=$_POST['razd'];
$roditel=$_POST['roditel'];
$page_por=$_POST['page_por'];
$page_name=$_POST['page_name'];
$page_kod=$_POST['page_kod'];
$page_title=$_POST['page_title'];
$page_desc=$_POST['page_desc'];
$page_word=$_POST['page_word'];
$page_ssylka=$_POST['page_ssylka'];
//вначале проверяем не пустой ли порядок, имя
if ((!empty($page_por)) and (!empty($page_name)) and (!empty($page_ssylka)))
{
//определяем к чему относится страницы - раздел или подраздел
	if ($razd==="Раздел")
	{
		//смотрим нет ли такого номера порядка раздела
		$my=mysql_query("SELECT * FROM `admins_page` WHERE ids_razdel='$page_por';");
		$main=mysql_fetch_array($my);
		if ($page_por!==$main['ids_razdel'])
		{
			if ((mysql_query("INSERT INTO `admins_page` VALUES ('$page_por','1','$page_name','$page_kod','$page_title','$page_word','$page_desc','$page_ssylka');"))===true)
			{echo "<p>Запись прошла успешно</p>";
				?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?page=yes&page_show=yes'><?}
			else {echo mysql_error();}
		}
		else
		{?>Ошибка. Такой номер раздела уже существует<br>
			<a href="javascript:history.back(1)" class="blue1">Вернуться назад</a><?}
	}
	elseif ($razd==="Подраздел")
	{
		//определяем порядок родителя
		if (!empty($roditel))
		{
			//смотрим нет ли такого номера порядка подраздела
			$my=mysql_query("SELECT * FROM `admins_page` WHERE ids_razdel='$roditel' && ids_podrazdel='$page_por';");
			$main=mysql_fetch_array($my);
			if ($page_por!==$main['ids_podrazdel'])
			{
				if ((mysql_query("INSERT INTO `admins_page` VALUES ('$roditel','$page_por','$page_name','$page_kod','$page_title','$page_word','$page_desc','$page_ssylka');"))===true)
					{echo "<p>Запись прошла успешно</p>";
						?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?page=yes&page_show=yes'><?}
				else {echo mysql_error();}
			}
			else
			{?>Ошибка. Такой номер подраздела уже существует<br>
				<a href="javascript:history.back(1)" class="blue1">Вернуться назад</a><?}
		}
		else
		{?>Ошибка. Не могу определить родителя<br>
			<a href="javascript:history.back(1)" class="blue1">Вернуться назад</a><?}
	}
	else
	{?>Ошибка. Не могу определить к чему относится страница<br>
		<a href="javascript:history.back(1)" class="blue1">Вернуться назад</a><?}
}
else
{?>Ошибка. Не введен порядок, или название страницы, или ЧПУ<br>
	<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
?>
</div>