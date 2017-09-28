<?
	$my=mysql_query("SELECT * FROM `admins_constants`");
	$main=mysql_fetch_array($my);
	$article_col=$main['article'];
	$my=mysql_query("SELECT * FROM `admins_article` WHERE status='1';");
	$article_col_all=mysql_num_rows($my);
	if ($article_col_all<$article_col) {$article_col=$article_col_all;}
	$article_kol=$_GET['article_kol'];
	if (empty($article_kol)){$article_kol=1;}
	$st=($article_kol-1)*$article_col;
	$my=mysql_query("SELECT * FROM `admins_article` WHERE status='1' ORDER BY `id` DESC LIMIT $st, $article_col;");
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="24" style="padding-left:17px;"><h1>Все статьи</h1></td>
</tr>
<?
while ($main=mysql_fetch_array($my))
{
?>
		<tr><td span class="ndata"><?echo $main['name'];?></td></tr>
		<tr>
			<td span class="ntxt">
			<?if (empty($article_kol)){?>
			<a href="/article/<?echo $main['id'];?>/"><?echo $main['anons'];?></span><br></a>
			<?}else{?>
			<a href="/article/<?echo $main['id'];?>/"><?echo $main['anons'];?></span><br></a>
			<?}?>
			</td>
		</tr>
		<tr valign="top">
			<td height="10"></td>
			<td></td>
		</tr>
<?}?>
		<tr valign="top">
			<td>
				<table border="0" cellspacing="1" cellpadding="3" align="right">
				<tr>
<?
if ($article_col_all>$article_col)
{
	$del=5;
	$kol_str=ceil($article_col_all/$article_col);
	if (($kol_str>$del) && ($article_kol)>$del)
	{$st=$article_kol;}
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
		echo "<a href='/article/st/".($start-$del)."/' class='pg'>&lt&lt</a>";
		echo "</td>";
	}
	for ($i=$start;$i<=$fin;$i++)
	{
		echo "<td>";
		if ($i==($article_kol)) {echo "<span class='pgsel'>".$i."</span>";}
		else {echo "<a href='/article/st/".$i."/' class='pg'>".$i."</a>";}
		echo "</td>";
	}
	if (($article_col_all>($del)) and (($start+$del)<=$kol_str))
	{
		echo "<td>";
		echo "<a href='/article/st/".($fin+1)."/' class='pg'>&gt&gt</a>";
		echo "</td>";
	}
}
?>
			</tr>
			</table>
		</td>
	</tr>
	</table>
