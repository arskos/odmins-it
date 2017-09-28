<table width="100%"  border="0" cellspacing="0" cellpadding="5">
<tr>
	<td colspan="2"><h1>Подробности о продукте</h1></td>
</tr>
<?
foreach ( $xml->shop->offers->offer as $obj ) { 
 	if ($obj['id']==$ids){
		print "<tr class='txt'><td width='75px'><img src=".$obj->picture." border='0'></td>";
		print "<td align='left'>".iconv("UTF-8","CP1251//IGNORE",$obj->name)."<br><br>";
		print "Цена: ".$obj->price."</br><br>";
?>
<form method="GET" action="http://www.linuxcenter.ru/r_150144/">
Положить <input type="text" size="5" maxlength="4" name="amount" value="1"> шт.
<input type="hidden" name="action" value="autocart">
<input type="hidden" name="gid" value="<?echo $ids;?>">
<input type="hidden" name="sh" value="item">
<input type="hidden" name="backurl" value="odmins-it.ru/disc/item/<?echo $ids;?>/">
<input type="submit" value="в корзину">
</form>
<?
		print "</tr>";
		print "<tr><td width='100%' colspan='2' class='txt'>".iconv("UTF-8","CP1251//IGNORE",$obj->description)."</a></tr>";
	}
}
?>
</tbody>
</table>