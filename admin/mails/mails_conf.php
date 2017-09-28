<?
$my=mysql_query("SELECT * FROM `mail_conf_tasman`;");
$main=mysql_fetch_array($my);
$mails_st=$main['mails_st'];
$mails_fin=$main['mails_fin'];
$mails_email=$main['mails_email'];
?>
<form action="admin.php" method="post" name="mails_conf">
<table width="100%"  border="0" cellspacing="1" cellpadding="3">
<tr>
	<td width="14%"></td>
	<td width="86%"></td>
</tr>
<tr class="blue1" bgcolor="F8FAFC">
	<td valign="top" class="blue1"><div align="right"><strong>Приветсвие</strong></div></td>
	<td><textarea name="mails_st" rows="3" class="fld" style="width:100%" onBlur="mag(document.mails_conf.mails_st.value);"><?echo $mails_st;?></textarea></td>
</tr>
<tr>
	<td colspan="2" class="blue1" align="center"><strong>Здесь будет располагаться Ваша информационная часть рассылки</strong></td>
</tr>
<tr class="blue1" bgcolor="F8FAFC">
	<td valign="top" class="blue1"><div align="right"><strong>Подпись</strong></div></td>
	<td><textarea name="mails_fin" rows="3" class="fld" style="width:100%" onBlur="mag1(document.mails_conf.mails_fin.value);"><?echo $mails_fin;?></textarea></td>
</tr>
<tr>
	<td valign="top" class="blue1"><div align="right"><strong>Email</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1"><input type="text" name="mails_email" class="fld" style="width:100%" maxlength="50" value="<?echo $mails_email;?>"></td>
</tr>
<tr>
	<td colspan="2" valign="top" class="blue1"><strong>Общий вид:</strong></td>
</tr>
<tr>
	<td colspan="2" class="blue1">
		<div id="asd">
		<?
		$text = unhtmlentities($postedValue);
		echo $text;
		?>
		</div>
	</td>
</tr>
<tr>
	<td colspan="2" class="blue1" align="center"><strong>Здесь будет располагаться Ваша информационная часть рассылки</strong></td>
</tr>
<tr>
	<td colspan="2" class="blue1">
		<div id="asd1">
		<?
		$text = unhtmlentities($postedValue);
		echo $text;
		?>
		</div>
	</td>
</tr>
</table>
<input type="hidden" name="mails_post" value="yes">
<input type="hidden" name="mails_conf_ok" value="yes">
</form>