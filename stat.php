<?
//вначале смотри куки
$Visited_rus=$_COOKIE['Visited_rus'];
if (!isset($Visited_rus))
{
	$Visited_rus=1;
	setcookie("Visited_rus",$Visited_rus,time()+3600*24);
	//провер€ем на уникальность »ѕ
	$unique=1;
	$rem_IP=$_SERVER['REMOTE_ADDR'];
	$rem_ag=$_SERVER['HTTP_USER_AGENT'];
	//если такого ип нет в базе, то заносим
	$my=mysql_query("SELECT * FROM `stat` WHERE IP='$rem_IP'");
	$dates=date("Y-m-d H:i:s");
	if (mysql_num_rows($my)==false)
	{
		mysql_query("INSERT INTO `stat` VALUES ('$rem_IP','$dates','$rem_ag','1');");
	}
	else
	{
		$kol=mysql_result(mysql_query("SELECT * FROM `stat` WHERE IP='$rem_IP'"),0,3)+1;
		mysql_query("UPDATE `stat` SET data='$dates', agent='$rem_ag', kol_vo=$kol WHERE IP='$rem_IP';");
	}
}
?>