<?
include_once("../fckeditor/fckeditor.php");
$buffer=$_POST['text_edit'];
$buffer=stripcslashes($buffer);
$dd=$_POST['mails_day'];
$mm=$_POST['mails_mounth'];
$yy=$_POST['mails_year'];
$nn=$_POST['mails_anons'];
$nt=$_POST['mails_title'];
if (isset($_POST['mails_ids'])) $mails_ids=$_POST['mails_ids']; else $mails_ids="";
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
			<input type="hidden" name="mails_edit_post" value="yes">
			<input type="hidden" name="mails_post" value="yes">
			<input type="hidden" name="mails_ids" value="<?echo $mails_ids;?>">
			<input type="hidden" name="dd" value="<?echo $dd;?>">
			<input type="hidden" name="mm" value="<?echo $mm;?>">
			<input type="hidden" name="yy" value="<?echo $yy;?>">
			<input type="hidden" name="nn" value="<?echo $nn;?>">
			<input type="hidden" name="nt" value="<?echo $nt;?>">
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