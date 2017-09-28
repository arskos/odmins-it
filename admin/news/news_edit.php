<?
if ( isset( $_POST ) )
   $postArray = &$_POST ;			// 4.1.0 or later, use $_POST
else
   $postArray = &$HTTP_POST_VARS ;	// prior to 4.1.0, use HTTP_POST_VARS

foreach ( $postArray as $sForm => $value )
{
	if ( get_magic_quotes_gpc() )
		$postedValue = htmlspecialchars( stripslashes( $value ) ) ;
	else
		$postedValue = htmlspecialchars( $value ) ;
}
//дата заданная пользователем
$dd=$_POST['dd'];
$mm=$_POST['mm'];
$yy=$_POST['yy'];
//дата из базы
$news_ids=$_GET['news_ids'];
if (empty($news_ids)) {$news_ids=$_POST['news_ids'];}
$my=mysql_query("SELECT *FROM `admins_news` WHERE id=$news_ids;");
$main=mysql_fetch_array($my);
$dates_temp=$main['data'];
$years=substr($dates_temp,0,4);
$mounths=substr($dates_temp,5,2);
$days=substr($dates_temp,8,2);
if (empty($dd)) {$days=$days;}
else {$days=$dd;}
if (empty($dd)) {$mounths=$mounths;}
else {$mounths=$mm;}
if (empty($yy)) {$years=$years;}
else {$years=$yy;}
//анонс
$nn=$_POST['nn'];
$anons=$main['news_anons'];
if (empty($nn)) {$nn=$anons;}
//полная новость из базы
$news_full=$main['news_full'];
if (empty($postedValue)) {$postedValue=$news_full;}
?>
<form name="news_add" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="2">
<tr>
	<td width="14%" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Дата</strong></div></td>
	<td width="86%" valign="middle" bgcolor="F8FAFC">
		<table width="300"  border="0" cellpadding="0" cellspacing="2" class="blue1">
		<tr>
			<td width="11%"><div align="right">День</div></td>
			<td width="16%">
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
			<td width="18%"><div align="right">Месяц</div></td>
			<td width="17%">
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
			<td width="12%"><div align="right">Год</div></td>
			<td width="26%">
				<select name="news_year" class="blue1">
					<?
						for ($i=2008;$i<=2020;$i++)
						{
							if ($years==$i) {echo "<option value=$i selected>$i</option>";}
							else {echo "<option value=$i>$i</option>";}
						}
					?>
				</select>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td valign="top" class="blue1"><div align="right"><strong>Анонс</strong></div></td>
	<td  class="blue1"><textarea name="news_anons" class="fld" style="width:100%"><? if (!empty($nn)) {echo $nn;}?></textarea></td>
</tr>
<tr>
	<td valign="top" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Полный текст</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1">
		<textarea name="text_edit" rows="8" class="fld" style="width:100%" onBlur="mag(document.news_add.text_edit.value);"><?echo $postedValue;?></textarea>
		<br>
		<input type="hidden" name="news_edit_vis" value="yes">
		<input type="hidden" name="news_post" value="yes">
		<input type="hidden" name="news_ids" value="<?echo $news_ids;?>">
		<table width="100%"  border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td width="5%" height="10"></td>
			<td width="95%"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td width="5%" align="right"><a href="javascript: document.news_add.submit();"><img src="imgadm/b_edit.gif" width="20" height="20" border="0"></a></td>
	<td width="95%"><a href="javascript: document.news_add.submit();" class="blue1">Запустить Редактор </a></td>
</tr>
<tr>
	<td valign="top" class="blue1"><div align="right"><strong>Общий вид:</strong></div></td>
	<td class="blue1">
		<div id="asd">
		<?
		$text = unhtmlentities($postedValue);
		echo $text;
		?>
		</div>
	</td>
</tr>
</table>
</form>
<form name="news_add_save" action="admin.php" method="post">
	<input type="hidden" name="news_edit_ok" value="yes">
	<input type="hidden" name="news_post" value="yes">
	<input type="hidden" name="days">
	<input type="hidden" name="mounth">
	<input type="hidden" name="years">
	<input type="hidden" name="news_anons">
	<input type="hidden" name="news_full">
	<input type="hidden" name="news_ids" value="<?echo $news_ids;?>">
</form>
