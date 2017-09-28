<div class=blue1 align=center>
<?
$y=1;
$x=1;
$page_check=array();
if($_POST['action'] == 'send'){$page_check=($_POST['page_check']);}
foreach($page_check as $key => $value)
{
$ids_podrazdel=str_replace("//","",(stristr($value,"//")));
$ids_razdel=str_replace("//".$ids_podrazdel,"",$value);
if ($ids_podrazdel==='1')
{
	if (mysql_query("DELETE FROM `admins_page` WHERE ids_razdel='$ids_razdel'")===true)
		{$y++;}
	else {echo mysql_errno();}
}
if ($ids_podrazdel!=='1')
{
	if (mysql_query("DELETE FROM `admins_page` WHERE ids_razdel='$ids_razdel' && ids_podrazdel='$ids_podrazdel'")===true)
		{$x++;}
	else {echo mysql_errno();}
}
}
echo "Всего удалено ".($y-1)." разделов<br>";
echo "Всего удалено ".($x-1)." подразделов";
?>
</div>
<META HTTP-EQUIV='REFRESH' content='3; url=admin.php?page=yes&page_show=yes'>