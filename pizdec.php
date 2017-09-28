<?
include "config_tal.php";
$fr=$_GET['fr'];
$tab=$_GET['tab'];
$my=mysql_query("SELECT * FROM `".$tab."` WHERE messag LIKE '%".$fr."%';");
while ($main=mysql_fetch_array($my))
{
	echo $main['times']."   ";
	echo $main['nick']."    ";
	echo $main['messag']."<br>";
}
?>