<?
require "../config.php";
require "../query.php";
if (isset($_GET['id'])) $key=codechar($_GET['id']);
switch ($key)
{
	case "-help":
		echo "������� �� ������� article:<br>";
		echo "������ �������: article ����<br>";
		echo "����� ������� site:<br>";
			echo "-name  -  ����� ������ ������ � �������<br>";
			echo "-stat  -  ����� ������<br>";
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
		echo "����� ������ - ".$num_str;
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
					else echo "��� ����� ������. ���������� ��� ���<br>";
					break;
				}
				else echo "������� �� ����� ����� �����.";
			default:
				echo "������������ ���� �������<br>�������� article -help ��� ��������� ������� �� ������";
		}
}
?>