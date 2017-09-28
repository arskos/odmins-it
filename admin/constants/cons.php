<?
$cons_news="";$cons_news=$_POST['cons_news'];
$cons_news_all="";$cons_news_all=$_POST['cons_news_all'];
$cons_article="";$cons_article=$_POST['cons_article'];
$cons_email="";$cons_email=$_POST['cons_email'];
$my=mysql_query("SELECT * FROM `admins_user` WHERE LOGIN='$login';");
$main=mysql_fetch_array($my);
if ($main['const']==1)
{
if ($consts_show==="yes") 
{
?>
	<td width="154" valign="top"><? require "cons_show_help.php"; ?></td>
	<td valign="top"><? require "cons_show.php"; ?></td>
<?
}
elseif ($consts_save==="yes")
{
	if ((!empty($cons_news)) or 
		(!empty($cons_news_all)) or 
		(!empty($cons_article)) or 
		(!empty($cons_email)))
	{
		if (mysql_query("UPDATE `admins_constants` SET news=$cons_news, news_all='$cons_news_all', article='$cons_article', email='$cons_email';")===true)
			{$err="";}
		else {echo mysql_errno();}
	}
	if (empty($err))
		{echo "<div class=blue1 align=center>Обновление прошло успешно</div>";
			print "<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?consts=yes&consts_show=yes'>";}
}
}
?>