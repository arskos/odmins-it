<?
//раздел или подраздел
$my2 = mysql_query("SELECT * FROM `admins_page` WHERE soderganie='$ids';");
$main2=mysql_fetch_array($my2);
if ($main2['ids_podrazdel']==1) $razd="razd"; else $razd="podrazd";
$ids_podrazdel=$main2['ids_podrazdel'];
$ids_razdel=$main2['ids_razdel'];
$my3 = mysql_query("SELECT * FROM `admins_page` WHERE ids_razdel='$ids_razdel' && ids_podrazdel='1';");
$main3=mysql_fetch_array($my3);
$my = mysql_query("SELECT * FROM `admins_page` ORDER BY ids_razdel, ids_podrazdel;");
if (mysql_num_rows($my)==true)
{
	while ($main=mysql_fetch_array($my))
	{
		if ($main['soderganie']==="article")
		{
			if ($ids===$main['soderganie'])
				{echo '<tr><td valign="top" height="5px"><a href="/article/" class="lmm_sel">'.$main['name'].'</a></td></tr>';}
			else
				{echo '<tr><td valign="top" height="5px"><a href="/article/" class="lmm">'.$main['name'].'</a></td></tr>';}
		}
		elseif ($main['soderganie']==="article_add")
		{
			if ($ids===$main['soderganie'])
				{echo '<tr><td valign="top" height="5px"><a href="/article_add/" class="lmm_sel">'.$main['name'].'</a></td></tr>';}
			else
				{echo '<tr><td valign="top" height="5px"><a href="/article_add/" class="lmm">'.$main['name'].'</a></td></tr>';}
		}
		elseif ($main['soderganie']==="email")
		{
			if ($ids===$main['soderganie'])
				{echo '<tr><td valign="top" height="5px"><a href="/email/" class="lmm_sel">'.$main['name'].'</a></td></tr>';}
			else
				{echo '<tr><td valign="top" height="5px"><a href="/email/" class="lmm">'.$main['name'].'</a></td></tr>';}
		}
		elseif ($main['soderganie']==="humor")
		{
			if ($ids===$main['soderganie'])
				{echo '<tr><td valign="top" height="5px"><a href="/humor/" class="lmm_sel">'.$main['name'].'</a></td></tr>';}
			else
				{echo '<tr><td valign="top" height="5px"><a href="/humor/" class="lmm">'.$main['name'].'</a></td></tr>';}
		}
		elseif ($main['soderganie']==="humor_add")
		{
			if ($ids===$main['soderganie'])
				{echo '<tr><td valign="top" height="5px"><a href="/humor_add/" class="lmm_sel">'.$main['name'].'</a></td></tr>';}
			else
				{echo '<tr><td valign="top" height="5px"><a href="/humor_add/" class="lmm">'.$main['name'].'</a></td></tr>';}
		}
		elseif ($main['ids_podrazdel']==1)
		{
			if ($ids===$main['soderganie'])
				{echo '<tr><td valign="top" height="5px"><a href="/page/'.$main['soderganie'].'/" class="lmm_sel">'.$main['name'].'</a></td></tr>';}
			else
				{echo '<tr><td valign="top" height="5px"><a href="/page/'.$main['soderganie'].'/" class="lmm">'.$main['name'].'</a></td></tr>';}
		}
		else
		{
			if ($ids_razdel===$main['ids_razdel'])
			{
				if ($ids_podrazdel===$main['ids_podrazdel'])
					{echo '<tr vlaign="top"><td valign="top" height="5px" style="padding-left:7px;"><a href="/page/'.$main['soderganie'].'/" class="lmm_sel">'.$main['name'].'</a></td></tr>';}
				else
					{echo '<tr><td valign="top" height="5px" style="padding-left:7px;"><a href="/page/'.$main['soderganie'].'/" class="lmm">'.$main['name'].'</a></td></tr>';}
			}
		}
	}
}
?>
<!--<tr valign='top' height='5px'><td colspan='3' height='10px'><a href='http://odmins-it.ru/log'>Старые логи</a></td></tr>
<tr valign='top' height='5px'><td colspan='3' height='10px'><a href='http://odmins-it.ru/logs'>Новые логи</a></td></tr>-->
<tr><td valign="top" height="5px"><a href="/forum/" class="lmm">Форум</a></td></tr>
<tr><td valign="top" height="5px"><a href="/book/" class="lmm">Книжный магазин</a></td></tr>
<tr><td valign="top" height="5px"><a href="/disc/" class="lmm">Магазин СПО</a></td></tr>
