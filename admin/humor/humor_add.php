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
$status=$_POST['status'];
if (isset($status)) $humor_status=$status;
?>
<form name="humor_add" id="humor_add" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="2">
<tr>
	<td width="14%" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Дата</strong></div></td>
	<td width="86%" valign="middle" bgcolor="F8FAFC">
		<table width="300"  border="0" cellpadding="0" cellspacing="2" class="blue1">
		<tr>
			<td width="11%"><div align="right">День</div></td>
			<td width="16%">
			<select name="humor_day" class="blue1">
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
				<select name="humor_mounth" class="blue1">
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
				<select name="humor_year" class="blue1">
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
	<td valign="top" class="blue1"><div align="right"><strong>Полный текст</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1">
		<textarea name="text_edit" rows="8" class="fld" style="width:100%" onBlur="mag(document.humor_add.text_edit.value);"><?echo unhtmlentities($postedValue);?></textarea>
		<br>
	</td>
</tr>
<tr>
	<td width="5%" align="right" bgcolor="F8FAFC"><a href="javascript: document.humor_add.submit();" onClick="humor_add.action='admin.php?humor_text=full';"><img src="imgadm/b_edit.gif" width="20" height="20" border="0"></a></td>
	<td width="95%" bgcolor="F8FAFC"><a href="javascript: document.humor_add.submit();" onClick="humor_add.action='admin.php?humor_text=full';" class="blue1">Запустить Редактор </a></td>
</tr>
<tr>
	<td valign="top" class="blue1" bgcolor="F8FAFC"><div align="right"><strong>Опубликовано:</strong></div></td>
	<td bgcolor="F8FAFC"><input name="status" type="checkbox" class="fld" value="yes" onClick="humor_check();" <?if ($humor_status==1) echo "Checked"; ?>></td>
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
		<input type="hidden" name="humor_add_vis" value="yes">
		<input type="hidden" name="humor_post" value="yes">
		<input type="hidden" name="humor_status" value="<?echo  $humor_status;?>">
</form>
<form name="humor_add_save" action="admin.php" method="post">
	<input type="hidden" name="humor_add_ok" value="yes">
	<input type="hidden" name="humor_post" value="yes">
	<input type="hidden" name="days">
	<input type="hidden" name="mounth">
	<input type="hidden" name="years">
	<input type="hidden" name="humor_full">
	<input type="hidden" name="status">
</form>
