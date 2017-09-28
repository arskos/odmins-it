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
$nn=$_POST['nn'];
//дата текущая
if (empty($dd)) {$days=date("j");}
else {$days=$dd;}
if (empty($dd)) {$mounths=date("n");}
else {$mounths=$mm;}
if (empty($yy)) {$years=date("Y");}
else {$years=$yy;}
?>
<form name="news_add" id="news_add" action="admin.php" method="post">
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
	<td width="5%" align="right"><a href="javascript: document.news_add.submit();" onClick="news_add.action='admin.php?news_text=anons';"><img src="imgadm/b_edit.gif" width="20" height="20" border="0"></a></td>
	<td width="95%"><a href="javascript: document.news_add.submit();" onClick="news_add.action='admin.php?news_text=anons';" class="blue1">Запустить Редактор </a></td>
</tr>
<tr>
	<td valign="top" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Полный текст</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1">
		<textarea name="text_edit" rows="8" class="fld" style="width:100%" onBlur="mag(document.news_add.text_edit.value);"><?echo unhtmlentities($postedValue);?></textarea>
		<br>
		<input type="hidden" name="news_add_vis" value="yes">
		<input type="hidden" name="news_post" value="yes">
		<table width="100%"  border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td width="5%" height="10"></td>
			<td width="95%"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td width="5%" align="right"><a href="javascript: document.news_add.submit();" onClick="news_add.action='admin.php?news_text=full';"><img src="imgadm/b_edit.gif" width="20" height="20" border="0"></a></td>
	<td width="95%"><a href="javascript: document.news_add.submit();" onClick="news_add.action='admin.php?news_text=full';" class="blue1">Запустить Редактор </a></td>
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
	<input type="hidden" name="news_add_ok" value="yes">
	<input type="hidden" name="news_post" value="yes">
	<input type="hidden" name="days">
	<input type="hidden" name="mounth">
	<input type="hidden" name="years">
	<input type="hidden" name="news_anons">
	<input type="hidden" name="news_full">
</form>
