<?
require "../bash/config.php";
require "../query.php";
function dates($dates_temp)
{
	//�������������� ���� � ������ dd-mm-yyyy
	$year_temp=substr($dates_temp,0,4);
	$mounth_temp=substr($dates_temp,5,2);
	$day_temp=substr($dates_temp,8,2);
	$dates_ok=$day_temp.".".$mounth_temp.".".$year_temp;
	return $dates_ok;
	//����� �������������� ����
}
if (isset($_GET['id'])) $key=codechar($_GET['id']);
switch ($key)
{
	case "-help":
		echo "������� �� ������� news:<br>";
		echo "������ �������: news ����<br>";
		echo "-h�  -  ������ � ���������<br>";
		echo "-t�  -  ��������� � ��������<br>";
		echo "-an  -  ��� ������ �������<br>";
		echo "-af  -  ��� �������<br>";
		echo "-dDDMMYYYY  -  ������� �� ����, ��� DD-����, MM-�����, YYYY-���, ����� � ���� ����������� � �������� ������, �������� 09022009 ���������� ����� �������� �� 9 ������� 2009 ����<br>";
		echo "-stat  -  ����� ��������<br>";
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
		echo "����� �������� - ".$num_str;
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
					else echo "���-�� ������� �����������. ���������� ��� ���<br>";
					break;
				}
				else echo "������� �� ����� ����� �����.";
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
					else echo "���-�� ������� �����������. ���������� ��� ���<br>";
					break;
				}
				else echo "������� �� ����� ����� �����.";
			case "-d":
				if (is_numeric($temp_key2))
				{
					//�������������� ���� � ������ dd-mm-yyyy
					$year_temp=substr($temp_key2,4,4);
					$mounth_temp=substr($temp_key2,2,2);
					$day_temp=substr($temp_key2,0,2);
					$dates_ok=$year_temp."-".$mounth_temp."-".$day_temp;
					//����� �������������� ����
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
					else echo "�� ������� �������� �� ������ ����. ���������� ��� ���<br>";
					break;
				}
				else echo "������ ������������ ������<br>";
			default:
				echo "������������ ���� �������<br>�������� site -help ��� ��������� ������� �� ������";
			}
}
?>