<div class=blue1 align=center>
<?
$razd=$_POST['razd'];
$roditel=$_POST['roditel'];
$page_por=$_POST['page_por'];
$page_name=$_POST['page_name'];
$page_kod=$_POST['page_kod'];
$ids_temp=$_POST['ids_temp'];
$ids_temp_pod=$_POST['ids_temp_pod'];
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
		//елси порядок не изменился
		if ($ids_temp===$page_por)
		{
			if ((mysql_query("UPDATE `admins_page` SET name='$page_name', kod='$page_kod',title='$page_title',keywords='$page_word',description='$page_desc',soderganie='$page_ssylka' WHERE ids_razdel='$ids_temp' && ids_podrazdel='1';"))===true)
				{echo "<p>Запись прошла успешно</p>";
				?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?page=yes&page_show=yes'><?}
			else {echo mysql_error();}
		}
		//если изменился порядок
		else
		{
		//смотрим нет ли такого уже номера
			$my=mysql_query("SELECT * FROM `admins_page` WHERE ids_razdel='$page_por';");
			$main=mysql_fetch_array($my);
			if ($page_por!==$main['ids_razdel'])
			{
				$n=0;
				$my=mysql_query("SELECT * FROM `admins_page` WHERE ids_razdel='$ids_temp'");
				while ($main=mysql_fetch_array($my))
				{
				//вначале меняем тупо ids_razdele
					if ((mysql_query("UPDATE `admins_page` SET ids_razdel='$page_por' WHERE ids_razdel='$ids_temp';"))===true){$n++;}
				}
				//теперь меняем искомый раздел
				if ((mysql_query("UPDATE `admins_page` SET name='$page_name', kod='$page_kod',title='$page_title',keywords='$page_word',description='$page_desc',soderganie='$page_ssylka' WHERE ids_razdel='$page_por' && ids_podrazdel='1';"))===true)
				{echo "<p>Запись прошла успешно</p>".$n;
				?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?page=yes&page_show=yes'><?}
				else {echo mysql_error();}
			}
			else
			{?>Ошибка. Такой порядок уже существует<br>
				<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
		}
	}
	elseif ($razd==="Подраздел")
	{
		//определяем порядок родителя
		if (!empty($roditel))
		{
			//проверяем, а не страый ли номер остался
			if ($page_por===$ids_temp_pod)
			{
				if ((mysql_query("UPDATE `admins_page` SET name='$page_name', kod='$page_kod',title='$page_title',keywords='$page_word',description='$page_desc' ,soderganie='$page_ssylka' WHERE ids_razdel='$ids_temp' && ids_podrazdel='$ids_temp_pod';"))===true)
					{echo "<p>Запись прошла успешно</p>".$n;
				?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?page=yes&page_show=yes'><?}
				else {echo mysql_error();}
				
			}
			else
			{
			//проверяем, а нет ли такого номера подраздела
				$my=mysql_query("SELECT * FROM `admins_page` WHERE ids_razdel='$ids_temp' && ids_podrazdel='$page_por';");
				$main=mysql_fetch_array($my);
				if ($main['ids_podrazdel']!==$page_por)
				{
					if ((mysql_query("UPDATE `admins_page` SET ids_podrazdel='$page_por',name='$page_name', kod='$page_kod',title='$page_title',keywords='$page_word',description='$page_desc',soderganie='$page_ssylka'  WHERE ids_razdel='$ids_temp' && ids_podrazdel='$ids_temp_pod';"))===true)
					{echo "<p>Запись прошла успешно</p>".$n;
					?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?page=yes&page_show=yes'><?}
					else {echo mysql_error();}
				}
				else
				{?>Ошибка. Такой номер порядка уже существует<br>
			<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
			}
		}
		else
		{?>Ошибка. Не могу определить родителя<br>
			<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
	}
	else
	{?>Ошибка. Не могу определить к чему относится страница<br>
		<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
}
else
{?>Ошибка. Не введен порядок, или название страницы, или ЧПУ<br>
	<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a><?}
?>
</div>