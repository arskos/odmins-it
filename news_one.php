<?
$news_kol=$_GET['news_kol'];
$my=mysql_query("SELECT * FROM `admins_news` WHERE id='$ids';");
$main=mysql_fetch_array($my);
//преобразование даты в формат dd-mm-yyyy
$dates_temp=$main['data'];
$year_temp=substr($dates_temp,0,4);
$mounth_temp=substr($dates_temp,5,2);
$day_temp=substr($dates_temp,8,2);
$dates_ok=$day_temp.".".$mounth_temp.".".$year_temp;
//конец преобразовани€ даты
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="24" class="tit" style="padding-left:17px;" colspan="2"><h1>ѕолное содержание новости</h1></td>
</tr>
<tr valign="top">
	<td width="8%" class="ndata"><?echo $dates_ok;?></td>
</tr>
<tr>
	<td width="92%" span class="txt"><?echo html_entity_decode($main['news_full']);?></td>
</tr>
<tr>
	<td class="ntxt"><br>
		<a href="/news/">Ќазад</span><br></a>
	</td>
</tr>
</table>
