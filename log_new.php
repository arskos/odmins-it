<?
require "config_tal.php";
if (isset($_POST['action'])) $action=$_POST['action'];else$action="";
if (isset($_POST['news_day'])) {$news_day=$_POST['news_day']; $days=$news_day;}else $days=date("j");
if (isset($_POST['news_mounth'])) {$news_mounth=$_POST['news_mounth'];$mounths=$news_mounth;}else $mounths=date("n");
if (isset($_POST['news_year'])) {$news_year=$_POST['news_year'];$years=$news_year;} else $years=date("Y");
if (isset($_POST['news_hours_start'])) {$news_hours_start=$_POST['news_hours_start']; $hours_st=$news_hours_start;}else $hours_st=date("G");
if (isset($_POST['news_hours_end'])) {$news_hours_end=$_POST['news_hours_end']; $hours_end=$news_hours_end;}else $hours_end=date("G");
if (isset($_POST['news_minute_start'])) {$news_minute_start=$_POST['news_minute_start']; $minute_st=$news_minute_start;}else $minute_st="0";
if (isset($_POST['news_minute_end'])) {$news_minute_end=$_POST['news_minute_end']; $minute_end=$news_minute_end;}else $minute_end="59";
if (isset($_POST['news_nick'])) $news_nick=htmlspecialchars($_POST['news_nick']);else $news_nick="";
?>
<h1>Поиск/просмотрет логов конференции admins@c.j.r.</h1>
<form name="logs" method="POST" action="">
<table width="100%" border="1" cellpadding="0" cellspacing="0">
<tr>
	<td align="center">День</td>
	<td align="center">
			<select name="news_day" class="blue1">
				<?
					for ($i=1;$i<=31;$i++)
					{
						if ($days==$i) {echo "<option value=$i selected>$i</option>";}
						else {echo "<option value=$i>$i</option>";}
					}
				?>
			</select>	
	</td>
	<td align="center">Месяц</td>
	<td align="center">
				<select name="news_mounth" class="blue1">
					<?
						for ($i=1;$i<=12;$i++)
						{
							if ($mounths==$i) {echo "<option value=$i selected>$i</option>";}
							else {echo "<option value=$i>$i</option>";}
						}
					?>
				</select>	
	</td>
	<td align="center">Год</td>
	<td align="center">
				<select name="news_year" class="blue1">
					<?$cur_years=date("Y");
						for ($i=2008;$i<=$cur_years;$i++)
						{
							if ($years==$i) {echo "<option value=$i selected>$i</option>";}
							else {echo "<option value=$i>$i</option>";}
						}
					?>
				</select>	
	</td>
</tr>
</table><br>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
<tr>
	<td align="center" rowspan="2">Время</td>
	<td align="center">Начало</td>
	<td align="center" rowspan="2">Час</td>
	<td align="center">
			<select name="news_hours_start" class="blue1">
				<?
					for ($i=0;$i<=23;$i++)
					{
						if ($hours_st==$i) {echo "<option value=$i selected>$i</option>";}
						else {echo "<option value=$i>$i</option>";}
					}
				?>
			</select>	
	</td>
	<td align="center" rowspan="2">Минуты</td>
	<td align="center">
				<select name="news_minute_start" class="blue1">
					<?
						for ($i=0;$i<=59;$i++)
						{
							if ($minute_st==$i) {echo "<option value=$i selected>$i</option>";}
							else {echo "<option value=$i>$i</option>";}
						}
					?>
				</select>	
	</td>
</tr>
<tr>
	<td align="center">Окончание</td>
	<td align="center">
			<select name="news_hours_end" class="blue1">
				<?
					for ($i=0;$i<=23;$i++)
					{
						if ($hours_end==$i) {echo "<option value=$i selected>$i</option>";}
						else {echo "<option value=$i>$i</option>";}
					}
				?>
			</select>	
	</td>
	<td align="center">
				<select name="news_minute_end" class="blue1">
					<?
						for ($i=0;$i<=59;$i++)
						{
							if ($minute_end==$i) {echo "<option value=$i selected>$i</option>";}
							else {echo "<option value=$i>$i</option>";}
						}
					?>
				</select>	
	</td>
</tr>
</table><br>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
<tr>
	<td align="right" colspan="2">Введите ник</td>
	<td align="left" colspan="4"><input type="text" name="news_nick" value="<?if (!empty($news_nick)) echo $news_nick;?>" style="width:90%;"></td>
</tr>
</table><br>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td>Поиск по....</td>
	<td><input type="Submit" value="Дата" name="action"></td>
	<td><input type="Submit" value="Дата+ник" name="action"></td>
</tr>

</table>
</form>
<br>
<?
if (!empty($action)){ echo "Поиск по критериям:";
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td><strong>Дата:</strong> <?echo $news_day."/".$news_mounth."/".$news_year;?></td></tr>
<tr><td><strong>Время:</strong> <?echo $news_hours_start.":".$news_minute_start." - ".$news_hours_end.":".$news_minute_end;?></td></tr>
<?if ($action==="Дата+ник"){?>
<tr><td><strong>Ник:</strong> <?if (!empty($news_nick)) echo $news_nick; else echo "ник не задан";?></td></tr>
<?}?>
</table>
<?
//составляем запрос
if ($news_mounth<10) {$news_mounth="0".$news_mounth;}
$tabl=$news_year."-".$news_mounth;
$tabl_ok=0;
//смотрим есть ли такая таблица
$my_tabl=mysql_query("show tables");
while ($main_table=mysql_fetch_array($my_tabl))
{if ($main_table['Tables_in_talisman']===$tabl) $tabl_ok=1;}
if ($tabl_ok==1){
//преобразуем даты и время
if ($news_day<10) {$news_day="0".$news_day;}

if ($news_hours_start<10) {$news_hours_start="0".$news_hours_start;}
if ($news_minute_start<10) {$news_minute_start="0".$news_minute_start;}
if ($news_hours_end<10) {$news_hours_end="0".$news_hours_end;}
if ($news_minute_end<10) {$news_minute_end="0".$news_minute_end;}
$data_st=$news_year."-".$news_mounth."-".$news_day." ".$news_hours_start.":".$news_minute_start.":00";
$data_end=$news_year."-".$news_mounth."-".$news_day." ".$news_hours_end.":".$news_minute_end.":59";

if ($data_st<$data_end){
if (($action==="Дата+ник") and (!empty($news_nick)))
{$my_search=mysql_query("SELECT *  FROM `".$tabl."` WHERE (`times` >= '".$data_st."' and `times` <= '".$data_end."') and `nick`='".$news_nick."';");}
else {$my_search=mysql_query("SELECT *  FROM `".$tabl."` WHERE (`times` >= '".$data_st."' and `times` <= '".$data_end."');");}
if (mysql_num_rows($my_search)==true)
{
	?>
<style type="text/css">
<!--
.userjoin {color: #009900; font-style: italic; font-weight: bold}
.userleave {color: #dc143c; font-style: italic; font-weight: bold}
.statuschange {color: #a52a2a; font-weight: bold}
.rachange {color: #0000FF; font-weight: bold}
.userkick {color: #FF7F50; font-weight: bold}
.userban {color: #DAA520; font-weight: bold}
.nickchange {color: #FF69B4; font-style: italic; font-weight: bold}
.timestamp {color: #aaa;}
.timestamp a {color: #aaa; text-decoration: none;}
.system {color: #090; font-weight: bold;}
.emote {color: #800080;}
.self {color: #0000AA;}
.selfmoder {color: #DC143C;}
.normal {color: #483d8b;}
#//-->
</style><br>
	<table width="100%" border="0" cellpadding="0" cellspacing="0"><?
	while ($main_search=mysql_fetch_array($my_search))
	{?>
		<tr>
			<td align="left">
				<span class="timestamp"><?echo $main_search['times'];?></span>
<?if ($main_search['status']==1){$str=$main_search['messag']; echo '<span class="userkick">'.mb_convert_encoding($str, "windows-1251", "UTF-8").'</span>';}
elseif ($main_search['status']==2){$str=$main_search['messag']; echo '<span class="userban">'.mb_convert_encoding($str, "windows-1251", "UTF-8").'</span>';}
elseif ($main_search['status']==3){$str=$main_search['messag']; echo '<span class="emote">'.mb_convert_encoding($main_search['nick'], "windows-1251", "UTF-8")." ".mb_convert_encoding($str, "windows-1251", "UTF-8").'</span>';}
elseif ($main_search['status']==4){$str=$main_search['messag']; echo '<span class="nickchange">'.mb_convert_encoding($str, "windows-1251", "UTF-8").'</span>';}
else{?>
				<span class="self">&lt;<?echo mb_convert_encoding($main_search['nick'], "windows-1251", "UTF-8");?>&gt;</span> <?$str=$main_search['messag']; echo mb_convert_encoding($str, "windows-1251", "UTF-8");}?>
			</td>
		</tr>
	<?}
	?></table><?
}else {echo "По вашему запросу ничего не найдено";}
}else {echo "Начальная дата не может быть больше конечной";}
}else {echo "По вашему запросу ничего не найдено";}
}
?>