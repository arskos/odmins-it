<table width="100%"  border="0" cellspacing="0" cellpadding="2">
<tr>
	<td width="16%"><a href="javascript: document.mails_send.submit();"><img src="imgadm/b_save.gif" width="20" height="20" border="0"></a></td>
	<td width="84%"><a href="javascript: document.mails_send.submit();" class="blue1">Отправить рассылку </a></td>
</tr>
<tr>
	<td width="16%"><a href="javascript:history.back(1)"><img src="imgadm/b_prev.gif" width="20" height="20" border="0"></a></td>
	<td width="84%"><a href="javascript:history.back(1)" class="blue1">Назад</a></td>
</tr>
<tr>
	<td colspan="2"><img src="imgadm/sp.gif" width="147" height="1"></td>
</tr>
</table>
<br>
<table width="147"  border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="17" background="imgadm/hlp2.gif"><strong><span class="blue1">&nbsp;&nbsp;ПОДСКАЗКА</span></strong></td>
</tr>
<tr>
	<td><img src="imgadm/hlp3.gif" width="147" height="4"></td>
</tr>
<tr>
	<td bgcolor="DBE3ED" class="blue1" style="padding:5px"><div align="left">
	<?
		$help=parse_ini_file("help.ini",false);
		foreach ($help as $key => $value)
		{if ($key==="Mails_send"){echo $value;}}
	?>	
	</div></td>
</tr>
<tr>
	<td><img src="imgadm/hlp4.gif" width="147" height="4"></td>
</tr>
</table>