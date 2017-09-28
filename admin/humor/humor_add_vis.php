<?
include_once("../fckeditor/fckeditor.php");
$text_edit=$_POST['text_edit'];
$dd=$_POST['humor_day'];
$mm=$_POST['humor_mounth'];
$yy=$_POST['humor_year'];
$nn=$_POST['humor_anons'];
$humor_text=$_GET['humor_text'];
if ($humor_text==="anons"){$buffer=$nn;}
else {$buffer=$text_edit;}
$buffer=stripcslashes($buffer);
$humor_status=$_POST['humor_status'];
?>
<form action="admin.php" method="post">
<table width="100%" height=100% border="0" cellspacing="2" cellpadding="0">
<tr>
	<td valign="top">
		<span class="blue1"><strong>Визуальный редактор</strong></span><br>
	</td>
</tr>
<tr>
	<td valign="top">
		
			<input type="hidden" name="action" value=<? echo $action; ?>>
			<input type="hidden" name="humor_add_post" value="yes">
			<input type="hidden" name="humor_post" value="yes">
			<input type="hidden" name="dd" value="<?echo $dd;?>">
			<input type="hidden" name="mm" value="<?echo $mm;?>">
			<input type="hidden" name="yy" value="<?echo $yy;?>">
			<input type="hidden" name="nn" value="<?echo $nn;?>">
			<input type="hidden" name="status" value="<?echo $humor_status;?>">
<?
	$oFCKeditor = new FCKeditor('FCKeditor1') ;
	$oFCKeditor->Height = 380;
	$oFCKeditor->BasePath = '../fckeditor/' ;
	$oFCKeditor->Value = $buffer;
	$oFCKeditor->Create() ;
?>
<br>
	<input type="submit" value="Сохранить">
	<a align="right" href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a>
	</td>
</tr>
</table>
</form>