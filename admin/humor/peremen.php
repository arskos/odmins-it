<?
//блок юмора
$humor="";$humor=$_GET['humor'];
$humor_post="";$humor_post=$_POST['humor_post'];
if ((empty($humor)) and ($humor_post==="yes")) {$humor="yes";}
if ($humor==="yes")
{
$humor_show="";$humor_show=$_GET['humor_show'];
$humor_del="";$humor_del=$_GET['humor_del'];
$humor_del_all="";$humor_del_all=$_POST['humor_del_all'];
$humor_add_vis="";$humor_add_vis=$_POST['humor_add_vis'];
$humor_edit_vis="";$humor_edit_vis=$_POST['humor_edit_vis'];
$humor_add="";$humor_add=$_GET['humor_add'];
$humor_add_post="";$humor_add_post=$_POST['humor_add_post'];
$humor_add_ok="";$humor_add_ok=$_POST['humor_add_ok'];
$humor_edit_ok="";$humor_edit_ok=$_POST['humor_edit_ok'];
if ((empty($humor_add)) and ($humor_add_post==="yes")) {$humor_add="yes";}
$humor_edit="";$humor_edit=$_GET['humor_edit'];
$humor_edit_post="";$humor_edit_post=$_POST['humor_edit_post'];
if ((empty($humor_edit)) and ($humor_edit_post==="yes")) {$humor_edit="yes";}
//что пишем в разделе
if ($humor_show==="yes") {$razdel="Юмор";}
if ($humor_add==="yes") {$razdel="<a href='admin.php?humor=yes&humor_show=yes' class='blue1'>Юмор</a> / Добавление цитаты";}
if ($humor_add_vis==="yes") {$razdel="<a href='admin.php?humor=yes&humor_show=yes' class='blue1'>Юмор</a> / <a href='admin.php?humor=yes&humor_add=yes' class='blue1'>Добавление цитаты</a> / Визульный редактор";}
if (($humor_add_ok==="yes") or ($humor_edit_ok==="yes")) {$razdel="<a href='admin.php?humor=yes&humor_show=yes' class='blue1'>Юмор</a> / Сохранение цитаты";}
if ($humor_edit==="yes") {$razdel="<a href='admin.php?humor=yes&humor_show=yes' class='blue1'>Юмор</a> / Редактирование цитаты";}
if ($humor_edit_vis==="yes") {$razdel="<a href='admin.php?humor=yes&humor_show=yes' class='blue1'>Юмор</a> / <a href='admin.php?humor=yes&humor_edit=yes' class='blue1'>Редактирование цитаты</a> / Визульный редактор";}
if ($humor_del_all==="yes") {$razdel="<a href='admin.php?humor=yes&humor_show=yes' class='blue1'>Юмор</a> / Удаление цитаты";}
}
//конец блока юмора
?>