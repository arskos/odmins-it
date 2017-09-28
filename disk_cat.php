<?
foreach ( $xml->shop->category as $obj ) {
	if ($obj['id']==$ids){
		$cate=$obj;
	}
}
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
<tr>
	<td colspan="3"><h1>Продукты в категории <span style="text-decoration:underline;"><?echo iconv("UTF-8","CP1251//IGNORE",$cate);?></span></h1></td>
</tr>
<?
$i=0;
foreach ( $xml->shop->offers->offer as $obj ) {
 	if ($obj->category==$ids){
		if ($i%2==0){?>
<tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#FFFFFF'">
<?} else {?><tr onMouseOver="this.bgColor = '#EFF3F7'" onMouseOut ="this.bgColor = '#F8FAFC'" bgcolor="F8FAFC"><?}
		print "<td width='75px'><a href='/disc/item/".$obj['id']."'><img src=".$obj->smpicture." border='0'></a></td>";
		print "<td align='left'><a href='/disc/item/".$obj['id']."'>".iconv("UTF-8","CP1251//IGNORE",$obj->name)."</a><br>";
		print "Цена: ".$obj->price."</td>";
		print "<td width='75px'><a href='http://www.linuxcenter.ru/r_150144/?action=autocart&gid=".$obj['id']."&backurl=odmins-it.ru/disc/cat/".$ids."&sh=category'>Купить</a></td></tr>";
		$i++;
	}
}
?>
</tbody>
</table>