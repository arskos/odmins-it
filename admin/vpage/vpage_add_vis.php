<?
include_once("../fckeditor/fckeditor.php");
$buffer=$_POST['vpage_kod'];
$buffer=stripcslashes($buffer);
$vpage_name=$_POST['vpage_name'];
$vpage_comment=$_POST['vpage_comment'];
$yy=$_POST['news_year'];
$nn=$_POST['news_anons'];
?>
<table width="100%" height=100% border="0" cellspacing="2" cellpadding="0">
<tr>
	<td valign="top">
		<span class="blue1"><strong>Визуальный редактор</strong></span><br>
	</td>
</tr>
<tr>
	<td valign="top">
		<form action="admin.php" method="post">
			<input type="hidden" name="action" value=<? echo $action; ?>>
			<input type="hidden" name="vpage_add_post" value="yes">
			<input type="hidden" name="vpage_post" value="yes">
			<input type="hidden" name="vpage_name" value="<?echo $vpage_name;?>">
			<input type="hidden" name="vpage_comment" value="<?echo $vpage_comment;?>">
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
		</form>
	</td>
</tr>
</table>