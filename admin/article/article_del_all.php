<div class=blue1 align=center>
<?
$y=1;
$article_check=array();
if($_POST['action'] == 'send'){$article_check=($_POST['article_check']);}
foreach($article_check as $key => $value)
{
if (mysql_query("DELETE FROM `admins_article` WHERE id='$value'")===true)
	{$y++;}
else {echo mysql_errno();}
}
echo "Всего удалено ".($y-1)." записей";
?>
</div>
<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?article=yes&article_show=yes'>