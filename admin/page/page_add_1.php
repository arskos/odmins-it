<form name="page_add_1" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="2">
<tr>
	<td width="14%" height="30" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Тип</strong></div></td>
	<td width="86%" valign="middle" bgcolor="F8FAFC" valign="top">
		<script>
			function ck(){
				el =document.getElementById('podrazd');
				sub=document.getElementById('roditel');
				if(el.checked){
				sub.disabled=false;
				}else{
				sub.disabled=true;
				}
			}
			function page_per(tx){
alert(tx);
}
			setTimeout("ck()",300);
		</script>
		<table width="60%"  border="0" cellpadding="0" cellspacing="0" class="blue1">
		<tr>
			<td width="5%"><input name="radiobutton" type="radio" value="razd" checked  id="razd"  onClick="ck();"></td>
			<td width="20%">Раздел</td>
			<td width="2%"><input name="radiobutton" type="radio" value="podrazd" id="podrazd" onClick="ck();"></td>
			<td width="73%">Подраздел</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td height="30" class="blue1"><div align="right"><strong>Родитель</strong></div></td>
	<td class="blue1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="blue1">
		<tr>
			<td>
				<select name="roditel" class="blue1" disabled id="roditel">
				<?
				$my=mysql_query("SELECT * FROM `admins_page` WHERE ids_podrazdel='1' ORDER BY ids_razdel;");
				while ($main=mysql_fetch_array($my))
				{
					if ((empty($main['soderganie'])) or ($main['soderganie']==='humor')) {echo "<option value='".$main['ids_razdel']."'>".$main['name']."</option>";}
				}
				?>
				</select>
					<em>только для подраздела! </em></td>
			<td>&nbsp;</td>
		</tr>
		</table></td>
</tr>
</table>
<input type="hidden" name="page_post" value="yes">
<input type="hidden" name="page_add_2" value="yes">
</form>