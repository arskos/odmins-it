<?
require "../bash/config.php";
require "../query.php";
function dates($dates_temp)
{
	//преобразование даты в формат dd-mm-yyyy
	$year_temp=substr($dates_temp,0,4);
	$mounth_temp=substr($dates_temp,5,2);
	$day_temp=substr($dates_temp,8,2);
	$dates_ok=$day_temp.".".$mounth_temp.".".$year_temp;
	return $dates_ok;
	//конец преобразования даты
}
if (isset($_GET['id'])) $key=codechar($_GET['id']);
switch ($key)
{
	case "-help":
		echo "Справка по команде news:<br>";
		echo "Формат команды: news ключ<br>";
		echo "-h№  -  первые № новоестей<br>";
		echo "-t№  -  последние № новостей<br>";
		echo "-an  -  все анонсы новости<br>";
		echo "-af  -  все новости<br>";
		echo "-dDDMMYYYY  -  новости по дате, где DD-день, MM-месяц, YYYY-год, месяц и день указывается с ведущими нулями, например 09022009 обозначает вывод новостей за 9 февраля 2009 года<br>";
		echo "-stat  -  всего новостей<br>";
		break;
	case "-an":
		$my = mysql_query("SELECT * FROM `admins_news` ORDER BY id DESC, `data` DESC;");
		if (mysql_num_rows($my)==true)
		{
			while ($main=mysql_fetch_array($my))
			{
				$dates_ok=dates($main['data']);
				echo "<b>".$dates_ok."</b><br>";
				echo html_entity_decode($main['news_anons'])."<br><br>";
			}
		}
		break;
	case "-af":
		$my = mysql_query("SELECT * FROM `admins_news` ORDER BY id DESC, `data` DESC;");
		if (mysql_num_rows($my)==true)
		{
			while ($main=mysql_fetch_array($my))
			{
				$dates_ok=dates($main['data']);
				echo "<b>".$dates_ok."</b><br>";
				echo "<i>".html_entity_decode($main['news_anons'])."</i><br>";
				echo html_entity_decode($main['news_full'])."<br><br>";
			}
		}
		break;
	case "-stat":
		$my = mysql_query("SELECT * FROM `admins_news`;");
		$num_str=mysql_num_rows($my);
		echo "Всего новостей - ".$num_str;
		break;
	default:
		$temp_key1=substr($key,0,2);
		$temp_key2=substr($key,2,strlen($key));
		switch ($temp_key1)
		{
			case "-h":
				if (is_numeric($temp_key2))
				{
					$my = mysql_query("SELECT * FROM `admins_news` ORDER BY id DESC, `data` DESC LIMIT 0,$temp_key2;");
					if (mysql_num_rows($my)==true)
					{
						while ($main=mysql_fetch_array($my))
						{
							$dates_ok=dates($main['data']);
							echo "<b>".$dates_ok."</b><br>";
							echo "<i>".html_entity_decode($main['news_anons'])."</i><br>";
							echo html_entity_decode($main['news_full'])."<br><br>";
						}
					}
					else echo "Что-то набрано неправильно. Попробуйте еще раз<br>";
					break;
				}
				else echo "Введена не цифра после ключа.";
			case "-t":
				if (is_numeric($temp_key2))
				{
					$my = mysql_query("SELECT * FROM `admins_news`;");
					$num_str=mysql_num_rows($my);
					$my = mysql_query("SELECT * FROM `admins_news` ORDER BY id DESC, `data` LIMIT ".($num_str-$temp_key2).",$temp_key2;");
					if (mysql_num_rows($my)==true)
					{
						while ($main=mysql_fetch_array($my))
						{
							$dates_ok=dates($main['data']);
							echo "<b>".$dates_ok."</b><br>";
							echo "<i>".html_entity_decode($main['news_anons'])."</i><br>";
							echo html_entity_decode($main['news_full'])."<br><br>";
						}
					}
					else echo "Что-то набрано неправильно. Попробуйте еще раз<br>";
					break;
				}
				else echo "Введена не цифра после ключа.";
			case "-d":
				if (is_numeric($temp_key2))
				{
					//преобразование даты в формат dd-mm-yyyy
					$year_temp=substr($temp_key2,4,4);
					$mounth_temp=substr($temp_key2,2,2);
					$day_temp=substr($temp_key2,0,2);
					$dates_ok=$year_temp."-".$mounth_temp."-".$day_temp;
					//конец преобразования даты
					$my = mysql_query("SELECT * FROM `admins_news` WHERE data='$dates_ok'  ORDER BY id DESC;");
					if (mysql_num_rows($my)==true)
					{
						while ($main=mysql_fetch_array($my))
						{
							$dates_ok=dates($main['data']);
							echo "<b>".$dates_ok."</b><br>";
							echo "<i>".html_entity_decode($main['news_anons'])."</i><br>";
							echo html_entity_decode($main['news_full'])."<br><br>";
						}
					}
					else echo "Не найдено новостей за данную дату. Попробуйте еще раз<br>";
					break;
				}
				else echo "Указан неправильный период<br>";
			default:
				echo "Неправильный ключ команды<br>Наберите site -help для просмотра справки по ключам";
			}
}
?>