<?
$my = mysql_query("SELECT * FROM `admins_page` WHERE ids_podrazdel='1' ORDER BY ids_razdel");
if (mysql_num_rows($my)==true)
{
	while ($main=mysql_fetch_array($my))
	{
	 	if ($main['soderganie']==='article')
		{
			{echo "<tr valign='top' height='5px'>
	<td colspan='3' height='10px'><a href='index.php?page=article'>".$main['name']."</a></td>";}		
		}
	 	elseif ($main['soderganie']==='article_add')
		{
			{echo "<tr valign='top' height='5px'>
	<td colspan='3' height='10px'><a href='index.php?page=article_add'>".$main['name']."</a></td>";}		
		}
	 	elseif ($main['soderganie']==='humor')
		{
			{echo "<tr valign='top' height='5px'>
	<td colspan='3' height='10px'><a href='index.php?page=humor'>".$main['name']."</a></td>";}		
		}
	 	elseif ($main['soderganie']==='email')
		{
			{echo "<tr valign='top' height='5px'>
	<td colspan='3' height='10px'><a href='index.php?page=email'>".$main['name']."</a></td>";}		
		}
		else
		{
			if ($ids_razdel===$main['ids_razdel'])
				{echo "<tr valign='top' height='5px'>
	<td colspan='3' height='10px'><a href='#'>".$main['name']."</a></td>";}
			else
				{echo "<tr valign='top' height='5px'>
	<td colspan='3' height='10px'><a href='index.php?page=page&ids_razdel=".$main['ids_razdel']."'>".$main['name']."</a></td>";}
			if (!empty($ids_razdel))
			{
				$my2 = mysql_query("SELECT * FROM `admins_page` WHERE ids_razdel='$ids_razdel' && ids_podrazdel<>'1' ORDER BY ids_razdel,ids_podrazdel");
				if (mysql_num_rows($my2)==true)
				{
					if ($ids_razdel===$main['ids_razdel'])
					{
						while ($main2=mysql_fetch_array($my2))
						{
							if ($ids_podrazdel===$main2['ids_podrazdel'])
								{echo "<tr valign='top' height='5px'>
	<td width='10px' height='10px'></td><td colspan='2' height='10px'><a href='#'>".$main2['name']."</a></td></tr>";}
							else
								{echo "<tr valign='top' height='5px'>
	<td width='10px' height='10px'></td><td colspan='2' height='10px'><a href='index.php?page=page&ids_razdel=".$main2['ids_razdel']."&ids_podrazdel=".$main2['ids_podrazdel']."'>".$main2['name']."</a></td></tr>";}
						}
					}
				}
			}
		}
	}
}
?>
<tr valign='top' height='5px'><td colspan='3' height='10px'><a href='http://forum.odmins-it.ru/' target="_blank">Форум</a></td></tr>
<tr valign='top' height='5px'><td colspan='3' height='10px'><a href='http://odmins-it.ru/log' target="_blank">Старые логи</a></td></tr>
<tr valign='top' height='5px'><td colspan='3' height='10px'><a href='http://odmins-it.ru/logs' target="_blank">Новые логи</a></td></tr>