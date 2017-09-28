<div class=blue1 align=center>
<?
$y=1;
$humor_check=array();
if($_POST['action'] == 'send'){$humor_check=($_POST['humor_check']);}
foreach($humor_check as $key => $value)
{
if (mysql_query("DELETE FROM `admins_humor` WHERE id='$value'")===true)
	{$y++;}
else {echo mysql_errno();}
}
echo "Всего удалено ".($y-1)." записей";
?>
</div>
<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?humor=yes&humor_show=yes'>