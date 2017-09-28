<div class=blue1 align=center>
<?
$y=1;
$news_check=array();
if($_POST['action'] == 'send'){$news_check=($_POST['news_check']);}
foreach($news_check as $key => $value)
{
if (mysql_query("DELETE FROM `admins_news` WHERE id='$value'")===true)
	{$y++;}
else {echo mysql_errno();}
}
echo "Всего удалено ".($y-1)." записей";
?>
</div>
<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?news=yes&news_show=yes'>