<?
$my=mysql_query("SELECT * FROM `mail_user_tasman` WHERE id='$ids';");
//дата текущая
$main=mysql_fetch_array($my);
	$dates_temp=$main['data'];
	$years=substr($dates_temp,0,4);
	$mounths=substr($dates_temp,5,2);
	$days=substr($dates_temp,8,2);
	$emails=$main['mails_email'];
	$emails_temp=$main['mails_email'];
	$comment=$main['mails_comment'];
?>
<form name="mails_user_add" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="2">
<tr bgcolor="F8FAFC">
	<td width="14%" class="blue1"><div align="right"><strong>Дата</strong></div></td>
	<td width="86%" valign="middle">
		<table width="300"  border="0" cellpadding="0" cellspacing="2" class="blue1">
		<tr bgcolor="F8FAFC">
			<td width="11%"><div align="right">День</div></td>
			<td width="16%">
				<select name="days" class="blue1">
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
				<select name="mounths" class="blue1">
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
				<select name="years" class="blue1">
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
	<td valign="top" class="blue1"><div align="right"><strong>Email</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1">
		<input type="text" name="emails" class="fld" style="width:100%" value="<? echo $emails;?>" maxlength="50">
	</td>
</tr>
<tr bgcolor="F8FAFC">
	<td valign="top" class="blue1"><div align="right"><strong>Комментарий</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1"><input type="text" name="comment" class="fld" style="width:100%" value="<? echo $comment;?>" maxlength="50"></td>
</tr>
</table>
<input type="hidden" name="mails_post" value="yes">
<input type="hidden" name="mails_user_edit_ok" value="yes">
<input type="hidden" name="emails_temp" value="<?echo $emails_temp;?>">
<input type="hidden" name="emails_ids" value="<?echo $ids;?>">
</form>