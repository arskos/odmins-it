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
		echo "������� �� ������� humor:<br>";
		echo "������ �������: humor ����<br>";
		echo "-h�  -  ������ � �����<br>";
		echo "-t�  -  ��������� � �����<br>";
		echo "-p�-�  -  ������ � � �� �<br>";
		echo "-a  -  ��� ������<br>";
		echo "-stat  -  ����� �����<br>";
		break;
	case "-a":
		$my = mysql_query("SELECT * FROM `admins_humor` WHERE status='1'  ORDER BY id DESC, `data` DESC;");
		if (mysql_num_rows($my)==true)
		{
			while ($main=mysql_fetch_array($my))
			{
				$dates_ok=dates($main['data']);
				echo "<b>".$dates_ok."</b><br>";
				echo html_entity_decode($main['humor_full'])."<br><br>";
			}
		}
		break;
	case "-stat":
		$my = mysql_query("SELECT * FROM `admins_humor` WHERE status='1';");
		$num_str=mysql_num_rows($my);
		echo "����� ����� - ".$num_str;
		break;
	default:
		$temp_key1=substr($key,0,2);
		$temp_key2=substr($key,2,strlen($key));
		switch ($temp_key1)
		{
			case "-h":
				if (is_numeric($temp_key2))
				{
					$my = mysql_query("SELECT * FROM `admins_humor` WHERE status='1'  ORDER BY id DESC, `data` DESC LIMIT 0,$temp_key2;");
					if (mysql_num_rows($my)==true)
					{
						while ($main=mysql_fetch_array($my))
						{
							$dates_ok=dates($main['data']);
							echo "<b>".$dates_ok."</b><br>";
							echo html_entity_decode($main['humor_full'])."<br><br>";
						}
					}
					else echo "���-�� ������� �����������. ���������� ��� ���<br>";
					break;
				}
				else echo "������� �� ����� ����� �����.";
			case "-t":
				if (is_numeric($temp_key2))
				{
					$my = mysql_query("SELECT * FROM `admins_humor` WHERE status='1';");
					$num_str=mysql_num_rows($my);
					$my = mysql_query("SELECT * FROM `admins_humor` WHERE status='1'  ORDER BY id DESC, `data` LIMIT ".($num_str-$temp_key2).",$temp_key2;");
					if (mysql_num_rows($my)==true)
					{
						while ($main=mysql_fetch_array($my))
						{
							$dates_ok=dates($main['data']);
							echo "<b>".$dates_ok."</b><br>";
							echo html_entity_decode($main['humor_full'])."<br><br>";
						}
					}
					else echo "���-�� ������� �����������. ���������� ��� ���<br>";
					break;
				}
				else echo "������� �� ����� ����� �����.";
			case "-p":
				$my = mysql_query("SELECT * FROM `admins_humor` WHERE status='1';");
				$num_str=mysql_num_rows($my);
				$sta=(strpos($temp_key2,'-'));
				$st=substr($temp_key2,0,$sta);
				$fin=substr(strrchr($temp_key2,'-'),1);
				if ((is_numeric($st) && is_numeric($fin)) && ($fin>$st))
				{
					$my = mysql_query("SELECT * FROM `admins_humor` WHERE status='1'  ORDER BY id DESC, `data` LIMIT ".($st-1).", ".($fin-$st+1).";");
					if (mysql_num_rows($my)==true)
					{
						while ($main=mysql_fetch_array($my))
						{
							$dates_ok=dates($main['data']);
							echo "<b>".$dates_ok."</b><br>";
							echo html_entity_decode($main['humor_full'])."<br><br>";
						}
					}
					break;
				}
				else echo "������ ������������ ������<br>";
			default:
				echo "������������ ���� �������<br>�������� site -help ��� ��������� ������� �� ������";
			}
}
?>