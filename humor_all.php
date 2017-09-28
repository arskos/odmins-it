<?
	$my=mysql_query("SELECT * FROM `admins_constants`");
	$main=mysql_fetch_array($my);
	$humor_col=$main['humor'];
	$my=mysql_query("SELECT * FROM `admins_humor`  WHERE status='1';");
	$humor_col_all=mysql_num_rows($my);
	if ($humor_col_all<$humor_col) {$humor_col=$humor_col_all;}
	$humor_kol=$_GET['humor_kol'];
	if (empty($humor_kol)){$humor_kol=1;}
	$st=($humor_kol-1)*$humor_col;
	$my=mysql_query("SELECT * FROM `admins_humor` WHERE status='1'  ORDER BY id DESC, `data` DESC LIMIT $st, $humor_col;");
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="24" style="padding-left:17px;" colspan="2"><h1>Цитаты</h1></td>
</tr>
<?
if (mysql_num_rows($my)==true){
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
			<td span class="ndata"><?echo $dates_ok;?></td>
		</tr>
		<tr>
			<td span class="ntxt">
<?echo html_entity_decode($main['humor_full']);?>
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
if ($humor_col_all>$humor_col)
{
	$del=5;
	$kol_str=ceil($humor_col_all/$humor_col);
	if (($kol_str>$del) && ($humor_kol)>$del)
	{$st=$humor_kol;}
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
		echo "<a href='/humor/st/".($start-$del)."/' class='pg'>&lt&lt</a>";
		echo "</td>";
	}
	for ($i=$start;$i<=$fin;$i++)
	{
		echo "<td>";
		if ($i==($humor_kol)) {echo "<span class='pgsel'>".$i."</span>";}
		else {echo "<a href='/humor/st/".$i."/' class='pg'>".$i."</a>";}
		echo "</td>";
	}
	if (($humor_col_all>($del*10)) and (($start+$del)<=$kol_str))
	{
		echo "<td>";
		echo "<a href='/humor/st/".($fin+1)."/' class='pg'>&gt&gt</a>";
		echo "</td>";
	}
}
?>
				</tr>
				</table>
			</td>
		</tr>
<?}?>
		</table>

