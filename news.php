<?
if (($name!=="book") and ($name!=="disc"))
{
	$my=mysql_query("SELECT * FROM `admins_constants`");
	$main=mysql_fetch_array($my);
	$news_col=$main['news'];
	$my=mysql_query("SELECT * FROM `admins_news`;");
	$news_col_all=mysql_num_rows($my);
	if ($news_col_all<$news_col) {$news_col=$news_col_all;}
	$main=mysql_fetch_array($my);
	$my=mysql_query("SELECT * FROM `admins_news` ORDER BY `data` DESC, id DESC LIMIT 0, $news_col;");
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="40" valign="top"><a href="/rss/rss.php" target="_blank" class="lnk">RSS-рассылка</a></td>
</tr>
<tr>
	<td><h1>ѕоследние новости</h1></td>
</tr>
<?
while ($main=mysql_fetch_array($my))
{
//преобразование даты в формат dd-mm-yyyy
$dates_temp=$main['data'];
$year_temp=substr($dates_temp,0,4);
$mounth_temp=substr($dates_temp,5,2);
$day_temp=substr($dates_temp,8,2);
$dates_ok=$day_temp.".".$mounth_temp.".".$year_temp;
//конец преобразовани€ даты
?>
<tr>
	<td>
		<div align="justify"><span class="ndata">
		<?echo $dates_ok;?>
		</span><br />
		<span class="ntxt">
		<a href="/news/<?echo $main['id'];?>/" class="lnk"><?echo $main['news_anons'];?></a>
		</span>
		</div>
	</td>
</tr>
<tr>
	<td height="13px" background="/img/dots.gif"></td>
</tr>
<?
}
?>
<tr>
	<td height="24">
		<div align="right" ><a href="/news/" class="lnk2"><strong>¬се новости</strong></a></div>
	</td>
</tr>
</table>
<?}elseif ($name==="book"){require "books_cat.php";} elseif ($name==="disc"){$xml = simplexml_load_file("shop.xml");require "disk_main_cat.php";}?>