<table width="100%"  border="0" cellspacing="0" cellpadding="2">
<tr>
	<td width="16%" align="right"><a href="javascript: document.mails_add_save.submit();" onClick="mails_mag();"><img src="imgadm/b_save.gif" width="20" height="20" border="0"></a></td>
	<td width="84%"><a href="javascript: document.mails_add_save.submit();" onClick="mails_mag();" class="blue1">���������</a></td>
</tr>
<tr>
	<td colspan="2"><img src="imgadm/sp.gif" width="147" height="1"></td>
</tr>
</table>
<br>
<table width="147"  border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="17" background="imgadm/hlp2.gif">
		<strong><span class="blue1">&nbsp;&nbsp;���������</span></strong>
	</td>
</tr>
<tr>
	<td><img src="imgadm/hlp3.gif" width="147" height="4"></td>
</tr>
<tr>
	<td bgcolor="DBE3ED" class="blue1" style="padding:5px">
		<div align="left">
	<?
		$help=parse_ini_file("help.ini",false);
		foreach ($help as $key => $value)
		{if ($key==="Mails_add"){echo $value;}}
	?>			
		</div>
	</td>
</tr>
<tr>
	<td><img src="imgadm/hlp4.gif" width="147" height="4"></td>
</tr>
</table>