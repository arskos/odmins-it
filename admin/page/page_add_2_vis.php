<?
include_once("../fckeditor/fckeditor.php");
$buffer=$_POST['page_kod'];
$buffer=stripcslashes($buffer);
$razd=$_POST['razd'];
$roditel=$_POST['roditel'];
$page_por=$_POST['page_por'];
$page_name=$_POST['page_name'];
$page_title=$_POST['page_title'];
$page_desc=$_POST['page_desc'];
$page_word=$_POST['page_word'];
$page_ssylka=$_POST['page_ssylka'];
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
			<input type="hidden" name="page_add_2" value="yes">
			<input type="hidden" name="page_post" value="yes">
			<input type="hidden" name="razd" value="<?echo $razd;?>">
			<input type="hidden" name="roditel" value="<?echo $roditel;?>">
			<input type="hidden" name="page_por" value="<?echo $page_por;?>">
			<input type="hidden" name="page_title" value="<?echo $page_title;?>">
			<input type="hidden" name="page_desc" value="<?echo $page_desc;?>">
			<input type="hidden" name="page_word" value="<?echo $page_word;?>">
			<input type="hidden" name="page_name" value="<?echo $page_name;?>">
			<input type="hidden" name="page_ssylka" value="<?echo $page_ssylka;?>">
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