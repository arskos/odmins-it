<? 

$dblocation = "localhost";
$dbname = "talisman";
$dbuser = "tali_show";
$dbpasswd = "k2WhvdVn";


//$dblocation = "52.3.181.164:3306";
//$dblocation = "https://python-odmins.rhcloud.com:3306";
//$dbname = "python";
//$dbuser = "adminBb5KERG";
//$dbpasswd = "pvh32hC247va";

$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
if (!$dbcnx) 
{
  echo( "<P>� ��������� ������ ������ ���� ������ �� ��������, ������� 
            ���������� ����������� �������� ����������.</P>" );
  exit();
}
if (!@mysql_select_db($dbname, $dbcnx)) 
{
  echo( "<P>� ��������� ������ ���� ������ �� ��������, �������
            ���������� ����������� �������� ����������.</P>" );
  exit();
}
?>
