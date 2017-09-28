<?
include_once("../fckeditor/fckeditor.php");
$buffer=$_POST['article_full'];
$buffer=stripcslashes($buffer);
$dd=$_POST['article_por'];
$mm=$_POST['article_title'];
$yy=$_POST['article_anons'];
$title=$_POST['title'];
$desc=$_POST['desc'];
$word=$_POST['word'];
$article_status=$_POST['article_status'];
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
			<input type="hidden" name="article_add_post" value="yes">
			<input type="hidden" name="article_post" value="yes">
			<input type="hidden" name="article_por" value="<?echo $dd;?>">
			<input type="hidden" name="article_title" value="<?echo $mm;?>">
			<input type="hidden" name="article_anons" value="<?echo $yy;?>">
			<input type="hidden" name="title" value="<?echo $title;?>">
			<input type="hidden" name="desc" value="<?echo $desc;?>">
			<input type="hidden" name="word" value="<?echo $word;?>">
			<input type="text" name="article_status" value="<?echo $article_status;?>">
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