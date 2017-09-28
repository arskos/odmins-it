<div class=blue1 align=center>
<?
$y=1;
$vpage_check=array();
if($_POST['action'] == 'send'){$vpage_check=($_POST['vpage_check']);}
foreach($vpage_check as $key => $value)
{
if (mysql_query("DELETE FROM `comperence_vpage` WHERE id='$value'")===true)
	{$y++;}
else {echo mysql_errno();}
}
echo "Всего удалено ".($y-1)." записей";
?>
</div>
<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?vpage=yes&vpage_show=yes'>