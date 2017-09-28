<?
	$my=mysql_query("SELECT * FROM `vpage` WHERE id='$vpage';");
	$main=mysql_fetch_array($my);
?>
<tr>
	<td height="24" class="tit" style="padding-left:17px;"><?echo $main['name'];?></td>
</tr>
<tr>
    <td valign="top" >
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="17"><img src="img/sp.gif" width="17" height="300"></td>
			<td valign="top" class="txt"><?echo $main['kod'];?></td>
		</tr>
        </table>
    </td>
</tr>