<?
	$party_col=mysql_result(mysql_query("SELECT * FROM `constants`"),0,2);
	$my=mysql_query("SELECT * FROM `partners`;");
	$party_col_all=mysql_num_rows($my);
	if ($party_col_all<$party_col) {$party_col=$party_col_all;}
	$party_kol=$_GET['party_kol'];
	if (empty($party_kol)){$party_kol=1;}
	$st=($party_kol-1)*$party_col;
	$my=mysql_query("SELECT * FROM `partners` ORDER BY `ids` LIMIT $st, $party_col;");
?>
<tr>
	<td height="24" class="tit" style="padding-left:17px;"><?echo mysql_result(mysql_query("SELECT * FROM `page` WHERE soderganie='partners'"),0,2);?></td>
</tr>
<tr>
    <td valign="top" >
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="17"><img src="img/sp.gif" width="17" height="300"></td>
			<td valign="top" class="txt">
		<table width="100%"  border="0" cellpadding="3" cellspacing="3" class="txt">
<?
while ($main=mysql_fetch_array($my))
{
?>
		<tr valign="top">
			<td width="13%">
			<?
				if ((!empty($main['img_url'])) and (!empty($main['ssylka'])))
					{echo "<a href='http://".$main['ssylka']."' class='lnk' target='_blank' title='Откроется в новом окне'><img src='".(str_replace("../","",$main['img_url']))."'></a>";}
				elseif (!empty($main['img_url']))
					{echo "<img src='".str_replace("../","",$main['img_url'])."'>";}?></td>
			<td width="87%"><?echo $main['title'];?>
					<br>
				<a href="http://<?echo $main['ssylka'];?>" class="lnk" target="_blank" title="Откроется в новом окне"><?echo $main['ssylka'];?></a>
			</td>
		</tr>
		<tr valign="top">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
<?}?>
		<tr valign="top">
			<td>&nbsp;</td>
			<td>
				<table border="0" cellspacing="1" cellpadding="3" align="right">
				<tr>
<?
if ($party_col_all>$party_col)
{
	$del=5;
	$kol_str=ceil($party_col_all/$party_col);
	if (($kol_str>$del) && ($party_kol)>$del)
	{$st=$party_kol;}
	else{$st=1;}
	for ($i=1;$i<=$kol_str; ($i=$i+$del))
	{
		if (($st>=$i) && ($st<=($i+$del-1))) {$start=$i;}
	}
	if (($kol_str>$del) && (($start+$del-1)<$kol_str)){$fin=$start+$del-1;}
	else {$fin=$kol_str;}
	if ($start>$del)
	{
		echo "<td>";
		echo "<a href='index.php?party=yes&party_kol=".($start-$del)."' class='pg'>&lt&lt</a>";
		echo "</td>";
	}
	for ($i=$start;$i<=$fin;$i++)
	{
		echo "<td>";
		if ($i==($party_kol)) {echo "<span class='pgsel'>".$i."</span>";}
		else {echo "<a href='index.php?party=yes&party_kol=".$i."' class='pg'>".$i."</a>";}
		echo "</td>";
	}
	if (($party_col_all>($del*10)) and (($start+$del)<=$kol_str))
	{
		echo "<td>";
		echo "<a href='index.php?party=yes&party_kol=".($fin+1)."' class='pg'>&gt&gt</a>";
		echo "</td>";
	}
}
?>
				</tr>
				</table>
			</td>
      </tr>
		</table>
</td>
		</tr>
        </table>
    </td>
</tr>