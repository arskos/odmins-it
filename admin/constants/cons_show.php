<?
$my=mysql_query("SELECT * FROM `admins_constants`");
$main=mysql_fetch_array($my);
?>
<form name="cons_show" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="0">
<tr>
	<td width="41%">&nbsp;			</td>
	<td width="59%">&nbsp;</td>
</tr>
<tr>
	<td valign="middle" >
		<div align="right"><span class="blue1"><strong> оличество новостей в правой колонке :</strong></span><br>
		</div>
	</td>
	<td valign="top" >
		<input name="cons_news" type="text" size="4" class="blue1" value="<?echo $main['news'];?>">
	</td>
</tr>
<tr>
	<td valign="middle" >
		<div align="right"><span class="blue1"><strong> оличество новостей дл€ общего показа :</strong></span><br>
		</div>
	</td>
	<td valign="top" >
		<input name="cons_news_all" type="text" size="4" class="blue1" value="<?echo $main['news_all'];?>">
	</td>
</tr>
<tr>
	<td valign="middle" >
		<div align="right"><span class="blue1"><strong> оличество статей на одной странице :</strong></span><br>
		</div>
	</td>
	<td valign="top" >
		<input name="cons_article" type="text" size="4" class="blue1" value="<?echo $main['article'];?>">
	</td>
</tr>
<tr>
	<td valign="middle" >
		<div align="right"><span class="blue1"><strong>ящик дл€ обратной св€зи:</strong></span><br>
		</div>
	</td>
	<td valign="top" >
		<input name="cons_email" type="text" size="30" class="blue1" value="<?echo $main['email'];?>">
	</td>
</tr>
	<input type="hidden" name="consts_post" value="yes">
	<input type="hidden" name="consts_save" value="yes">
</table>
</form>