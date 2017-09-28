<?
include_once("../fckeditor/fckeditor.php");
$buffer=$_POST['text_edit'];
$buffer=stripcslashes($buffer);
$dd=$_POST['news_day'];
$mm=$_POST['news_mounth'];
$yy=$_POST['news_year'];
$nn=$_POST['news_anons'];
$news_ids=$_POST['news_ids'];
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
			<input type="hidden" name="news_edit_post" value="yes">
			<input type="hidden" name="news_post" value="yes">
			<input type="hidden" name="dd" value="<?echo $dd;?>">
			<input type="hidden" name="mm" value="<?echo $mm;?>">
			<input type="hidden" name="yy" value="<?echo $yy;?>">
			<input type="hidden" name="nn" value="<?echo $nn;?>">
			<input type="hidden" name="news_ids" value="<?echo $news_ids;?>">
<?
	$oFCKeditor = new FCKeditor('FCKeditor1') ;
	$oFCKeditor->Height = 380;
	$oFCKeditor->BasePath = '../fckeditor/' ;
	$oFCKeditor->Value = $buffer;
	$oFCKeditor->Create() ;
?>
		<br>
			<input type="submit" value="Сохранить" class="blue1">
			<a align="right" href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">Вернуться назад</a>
		</form>
	</td>
</tr>
</table>