<?
$my2=mysql_query("SELECT * FROM `mail_tasman` WHERE id='$ids'");
$main2=mysql_fetch_array($my2);
?>
<form name="mails_send" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="2">
<tr bgcolor="F8FAFC">
	<td class="blue1" width="14%"><strong>Тема: </strong></td>
	<td class="blue1" width="86%"><?echo $main2['title'];?></td>
</tr>
<tr class="blue1">
	<td class="blue1" width="14%"><strong>Содержание: </strong></td>
	<td class="blue1">
<?
$my=mysql_query("SELECT * FROM `mail_conf_tasman`");
$main=mysql_fetch_array($my);
echo $main['mails_st']."<br>";
echo $main2['text']."<br>";
echo $main['mails_fin'];
?>
	</td>
</tr>
</table>
<input type="hidden" name="mails_post" value="yes">
<input type="hidden" name="mails_sends_ok" value="yes">
<input type="hidden" name="mails_sends_ids" value="<?echo $ids;?>">
</form>