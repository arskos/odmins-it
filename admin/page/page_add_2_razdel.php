<?
$my=mysql_query("SELECT * FROM `admins_page` WHERE ids_podrazdel='1' ORDER BY ids_razdel;");
if (mysql_num_rows($my)==true)
{
?>
<tr bgcolor="F8FAFC">
	<td height="25" valign="top" class="blue1"><div align="right"><strong>Существующие<br>
		разделы</strong></div></td>
	<td  class="blue1">
		<table width="100%"  border="0" cellpadding="3" cellspacing="1" class="blue1">
		<tr>
			<td width="12%" height="21" background="imgadm/mm_top2.gif">Порядок</td>
			<td width="88%" background="imgadm/mm_top2.gif">Название</td>
		</tr>
<?
while ($main=mysql_fetch_array($my))
{
?>
		<tr>
			<td><? echo $main['ids_razdel'];?></td>
			<td><? echo $main['name'];?></td>
		</tr>
<?}?>
		</table>
	</td>
</tr>
<?}?>