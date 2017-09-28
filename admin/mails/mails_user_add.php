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
//дата текущая
$days=date("j");
$mounths=date("n");
$years=date("Y");
?>
<form name="mails_user_add" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="2">
<tr><td colspan="2" class="blue1" align="center"><strong>1-ый пользователь</strong></td></tr>
<tr bgcolor="F8FAFC">
	<td width="14%" class="blue1"><div align="right"><strong>Дата</strong></div></td>
	<td width="86%" valign="middle">
		<table width="300"  border="0" cellpadding="0" cellspacing="2" class="blue1">
		<tr bgcolor="F8FAFC">
			<td width="11%"><div align="right">День</div></td>
			<td width="16%">
				<select name="day1" class="blue1">
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
				<select name="mounth1" class="blue1">
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
				<select name="year1" class="blue1">
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
		<input type="text" name="emails1" class="fld" style="width:100%" value="" maxlength="50">
	</td>
</tr>
<tr bgcolor="F8FAFC">
	<td valign="top" class="blue1"><div align="right"><strong>Комментарий</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1"><input type="text" name="comment1" class="fld" style="width:100%" value="<? if (!empty($nt)) {echo $nt;}?>" maxlength="50"></td>
</tr>
<tr><td colspan="2" class="blue1" align="center"><strong>2-ой пользователь</strong></td></tr>
<tr bgcolor="F8FAFC">
	<td width="14%" class="blue1"><div align="right"><strong>Дата</strong></div></td>
	<td width="86%" valign="middle">
		<table width="300"  border="0" cellpadding="0" cellspacing="2" class="blue1">
		<tr bgcolor="F8FAFC">
			<td width="11%"><div align="right">День</div></td>
			<td width="16%">
				<select name="day2" class="blue1">
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
				<select name="mounth2" class="blue1">
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
				<select name="year2" class="blue1">
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
	<td bgcolor="F8FAFC" class="blue1"><input type="text" name="emails2" class="fld" style="width:100%" value="" maxlength="50"></td>
</tr>
<tr bgcolor="F8FAFC">
	<td valign="top" class="blue1"><div align="right"><strong>Комментарий</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1"><input type="text" name="comment2" class="fld" style="width:100%" value="<? if (!empty($nt)) {echo $nt;}?>" maxlength="50"></td>
</tr>
<tr><td colspan="2" class="blue1" align="center"><strong>3-ий пользователь</strong></td></tr>
<tr bgcolor="F8FAFC">
	<td width="14%" class="blue1"><div align="right"><strong>Дата</strong></div></td>
	<td width="86%" valign="middle">
		<table width="300"  border="0" cellpadding="0" cellspacing="2" class="blue1">
		<tr bgcolor="F8FAFC">
			<td width="11%"><div align="right">День</div></td>
			<td width="16%">
				<select name="day3" class="blue1">
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
				<select name="mounth3" class="blue1">
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
				<select name="year3" class="blue1">
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
	<td bgcolor="F8FAFC" class="blue1"><input type="text" name="emails3" class="fld" style="width:100%" value="" maxlength="50"></td>
</tr>
<tr bgcolor="F8FAFC">
	<td valign="top" class="blue1"><div align="right"><strong>Комментарий</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1"><input type="text" name="comment3" class="fld" style="width:100%" value="<? if (!empty($nt)) {echo $nt;}?>" maxlength="50"></td>
</tr>
</tr>
</table>
<input type="hidden" name="mails_post" value="yes">
<input type="hidden" name="mails_user_add_ok" value="yes">
</form>