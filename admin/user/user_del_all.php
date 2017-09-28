<div class=blue1 align=center>
<?
$y=1;
$vpage_check=array();
if($_POST['action'] == 'send'){$vpage_check=($_POST['vpage_check']);}
foreach($vpage_check as $key => $value)
{
if (mysql_query("DELETE FROM `admins_user` WHERE id='$value'")===true)
	{$y++;}
else {echo mysql_errno();}
}
echo "Всего удалено ".($y-1)." записей";
?>
</div>
<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?user=yes&user_show=yes'>