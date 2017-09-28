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
if ((isset($_GET['mails_edit'])) && ($_GET['mails_edit']==="yes"))
{
	$my=mysql_query("SELECT * FROM `mail_tasman` WHERE id='$ids';");
	$mails_ids=$ids;
	$main=mysql_fetch_array($my);
	$dates_temp=$main['data'];
	$years=substr($dates_temp,0,4);
	$mounths=substr($dates_temp,5,2);
	$days=substr($dates_temp,8,2);
	$nt=$main['title'];
	$postedValue=$main['text'];
}
else
{
	$days=$_POST['dd'];
	$mounths=$_POST['mm'];
	$years=$_POST['yy'];
	$nn=$_POST['nn'];
	$nt=$_POST['nt'];
	$mails_ids=$_POST['mails_ids'];
}
?>
<form name="mails_add" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="2">
<tr bgcolor="F8FAFC">
	<td width="14%" class="blue1"><div align="right"><strong>Дата</strong></div></td>
	<td width="86%" valign="middle">
		<table width="300"  border="0" cellpadding="0" cellspacing="2" class="blue1">
		<tr bgcolor="F8FAFC">
			<td width="11%"><div align="right">День</div></td>
			<td width="16%">
			<select name="mails_day" class="blue1">
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
				<select name="mails_mounth" class="blue1">
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
				<select name="mails_year" class="blue1">
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
	<td valign="top" class="blue1"><div align="right"><strong>Тема</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1"><input type="text" name="mails_title" class="fld" style="width:100%" value="<? if (!empty($nt)) {echo $nt;}?>" maxlength="50"></td>
</tr>
<tr>
	<td valign="top" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Полный текст</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1">
		<textarea name="text_edit" rows="8" class="fld" style="width:100%" onBlur="mag(document.mails_add.text_edit.value);"><?echo unhtmlentities($postedValue);?></textarea>
		<br>
		<input type="hidden" name="mails_edit_vis" value="yes">
		<input type="hidden" name="mails_post" value="yes">
		<table width="100%"  border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td width="5%" height="10"></td>
			<td width="95%"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td width="5%" align="right"><a href="javascript: document.mails_add.submit();"><img src="imgadm/b_edit.gif" width="20" height="20" border="0"></a></td>
	<td width="95%"><a href="javascript: document.mails_add.submit();" class="blue1">Запустить Редактор </a></td>
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
<input type="hidden" name="mails_ids" value="<?echo $mails_ids;?>">
</form>
<form name="mails_add_save" action="admin.php" method="post">
	<input type="hidden" name="mails_edit_ok" value="yes">
	<input type="hidden" name="mails_post" value="yes">
	<input type="hidden" name="mails_ids" value="<?echo $mails_ids;?>">
	<input type="hidden" name="days">
	<input type="hidden" name="mounth">
	<input type="hidden" name="years">
	<input type="hidden" name="mails_title">
	<input type="hidden" name="mails_full">
</form>
