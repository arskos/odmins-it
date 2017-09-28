<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr valign="bottom">
	<td height="30px" style="font-weight:bold;" class="txt">Дистрибутивы</td>
</tr>
<?
foreach ( $xml->shop->category as $obj ) {
	if ($obj['parent']=="lc1001"){
		print "<tr><td><a href='/disc/cat/".$obj['id']."'>".iconv("UTF-8","CP1251//IGNORE",$obj)."</a></td></tr>";
	}
}
?>
<tr valign="bottom">
	<td height="30px" style="font-weight:bold;" class="txt">Программы для Linux</td>
</tr>
<?
foreach ( $xml->shop->category as $obj ) {
	if ($obj['parent']=="lc1006"){
		print "<tr><td><a href='/disc/cat/".$obj['id']."'>".iconv("UTF-8","CP1251//IGNORE",$obj)."</a></td></tr>";
	}
}
?>
<tr valign="bottom">
	<td height="30px" style="font-weight:bold;" class="txt">Атрибутика</td>
</tr>
<?
foreach ( $xml->shop->category as $obj ) {
	if (($obj['id']!="lc45") && ($obj['parent']=="lc1013") || ($obj['parent']=="lc45")){
		print "<tr><td><a href='/disc/cat/".$obj['id']."'>".iconv("UTF-8","CP1251//IGNORE",$obj)."</a></td></tr>";
	}
}
?>
</table>