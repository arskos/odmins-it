<?
$article_kol=$_GET['article_kol'];
$my=mysql_query("SELECT * FROM `admins_article` WHERE id='$ids';");
$main=mysql_fetch_array($my);
?>
<table width="100%"  border="0" cellpadding="3" cellspacing="3" class="txt">
<tr valign="top">
	<td height="24" style="padding-left:17px;"><h1><?echo $main['name'];?></h1></td>
</tr>
<tr>
	<td span class="txt"><?echo html_entity_decode($main['full']);?></span></td>
</tr>
<tr>
	<td span class="ntxt">
	<?if (empty($article_kol)){?>
		<a href="/article/">Назад</span><br></a>
	<?}else{?>
		<a href="/article/st/<?echo $article_kol;?>/">Назад</span><br></a>
	<?}?>
	</td>
</tr>
</table>
