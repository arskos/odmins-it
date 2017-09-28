<?
require "../config.php";
require "../query.php";
if (isset($_GET['id'])) $key=codechar($_GET['id']);
switch ($key)
{
	case "-help":
		echo "Справка по команде article:<br>";
		echo "Формат команды: article ключ<br>";
		echo "Ключи команды site:<br>";
			echo "-name  -  вывод статей вместе с анонсом<br>";
			echo "-stat  -  всего статей<br>";
		$my = mysql_query("SELECT * FROM `admins_article` WHERE status='1' ORDER BY id;");
		if (mysql_num_rows($my)==true)
		{
			while ($main=mysql_fetch_array($my))
			{
				echo "-".$main['id']."    - ".$main['name']."<br>";
			}
		}
		break;
	case "-stat":
		$my = mysql_query("SELECT * FROM `admins_article` WHERE status='1';");
		$num_str=mysql_num_rows($my);
		echo "Всего статей - ".$num_str;
		break;
	case "-name":
		$my = mysql_query("SELECT * FROM `admins_article` WHERE status='1' ORDER BY id;");
		if (mysql_num_rows($my)==true)
		{
			while ($main=mysql_fetch_array($my))
			{
				echo "<b>-".$main['id']."</b>    - <i>".$main['name']."</i><br>".$main['anons']."<br><br>";
			}
		}
		break;
	default:
		$temp_key1=substr($key,0,2);
		$temp_key2=substr($key,2,strlen($key));
		switch ($temp_key1)
		{
			case "-n":
				if (is_numeric($temp_key2))
				{
					$my = mysql_query("SELECT * FROM `admins_article` WHERE status='1' && id='$temp_key2';");
					if (mysql_num_rows($my)==true)
					{
						while ($main=mysql_fetch_array($my))
						{
							echo "<b>".$main['name']."</b><br>";
							echo html_entity_decode($main['full'])."<br><br>";
						}
					}
					else echo "Нет такой статьи. Попробуйте еще раз<br>";
					break;
				}
				else echo "Введена не цифра после ключа.";
			default:
				echo "Неправильный ключ команды<br>Наберите article -help для просмотра справки по ключам";
		}
}
?>