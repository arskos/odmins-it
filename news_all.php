<?
	$my=mysql_query("SELECT * FROM `admins_constants`");
	$main=mysql_fetch_array($my);
	$news_col=$main['news_all'];
	$my=mysql_query("SELECT * FROM `admins_news`;");
	$news_col_all=mysql_num_rows($my);
	if ($news_col_all<$news_col) {$news_col=$news_col_all;}
	$news_kol=$_GET['news_kol'];
	if (empty($news_kol)){$news_kol=1;}
	$st=($news_kol-1)*$news_col;
	$my=mysql_query("SELECT * FROM `admins_news` ORDER BY `data` DESC, id DESC LIMIT $st, $news_col;");
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="24" style="padding-left:17px;" colspan="2"><h1>Все новости</h1></td>
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
//конец преобразования даты
?>
		<tr>
			<td class="ndata"><?echo $dates_ok;?></td>
		</tr>
		<tr>
			<td class="ntxt">
			<?if (empty($news_kol)){?>
				<a href="/news/<?echo $main['id'];?>/" class="lnk"><?echo $main['news_anons'];?></a>
			<?}else{?>
				<a href="/news/<?echo $main['id'];?>/" class="lnk"><?echo $main['news_anons'];?></a>
			<?}?>
			</td>
		</tr>
		<tr valign="top">
			<td height="10"></td>
			<td></td>
		</tr>
<?}?>
		<tr valign="top">
			<td>&nbsp;</td>
			<td>
				<table border="0" cellspacing="1" cellpadding="3" align="right">
				<tr>
<?
if ($news_col_all>$news_col)
{
	$del=5;
	$kol_str=ceil($news_col_all/$news_col);
	if (($kol_str>$del) && ($news_kol)>$del)
	{$st=$news_kol;}
	else{$st=1;}
	for ($i=1;$i<=$kol_str; ($i=$i+$del))
	{
		if (($st>=$i) && ($st<=($i+$del-1))) {$start=$i;}
	}
	if (($kol_str>$del) && (($start+$del-1)<$kol_str)){$fin=$start+$del-1;}
	else {$fin=$kol_str;}
	if ($start>$del)
	{
		echo "<td>";
		echo "<a href='/news/st/".($start-$del)."/' class='pg'>&lt&lt</a>";
		echo "</td>";
	}
	for ($i=$start;$i<=$fin;$i++)
	{
		echo "<td>";
		if ($i==($news_kol)) {echo "<span class='pgsel'>".$i."</span>";}
		else {echo "<a href='/news/st/".$i."/' class='pg'>".$i."</a>";}
		echo "</td>";
	}
	if (($news_col_all>($del*10)) and (($start+$del)<=$kol_str))
	{
		echo "<td>";
		echo "<a href='/news/st/".($fin+1)."/' class='pg'>&gt&gt</a>";
		echo "</td>";
	}
}
?>
				</tr>
				</table>
			</td>
		</tr>
		</table>

