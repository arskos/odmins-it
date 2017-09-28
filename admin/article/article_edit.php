<?
if ( isset( $_POST ) )
   $postArray = &$_POST ;			// 4.1.0 or later, use $_POST
else
   $postArray = &$HTTP_POST_VARS ;	// prior to 4.1.0, use HTTP_POST_VARS

foreach ( $postArray as $sForm => $value )
{
	if ( get_magic_quotes_gpc() )
		$postedValue = htmlspecialchars( stripslashes( $value ) ) ;
	else
		$postedValue = htmlspecialchars( $value ) ;
}
if (isset($_GET['article_ids']))
{
	$my=mysql_query("SELECT * FROM `admins_article` WHERE id='".$_GET['article_ids']."';");
	$main=mysql_fetch_array($my);
	$article_por=$main['id'];
	$article_title=$main['name'];
	$article_anons=$main['anons'];
	$article_full=$main['full'];
	$title=$main['title'];
	$desc=$main['description'];
	$word=$main['keywords'];
	$article_status=$main['status'];
	$article_temp=$article_por;
}
else
{
	$article_por=$_POST['article_por'];
	$article_title=$_POST['article_title'];
	$article_anons=$_POST['article_anons'];
	$article_temp=$_POST['article_temp'];
	$title=$_POST['title'];
	$desc=$_POST['desc'];
	$word=$_POST['word'];
	$article_status=$_POST['article_status'];
}
?>
<form name="article_add" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="2">
<tr>
	<td width="14%" class="blue1"><div align="right"><strong>Порядок</strong></div></td>
	<td width="86%" valign="middle"><input name="article_por" type="text" class="blue1" size="4" maxlength="4" onBlur="validate(this);" value="<? echo $article_por;?>"></td>
</tr>
<tr>
	<td width="14%" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Заголовок</strong></div></td>
	<td width="86%" valign="middle" bgcolor="F8FAFC"><input name="article_title" type="text" class="blue1" style="width:100%" value="<? echo $article_title;?>"></td>
</tr>
<tr>
	<td valign="top" class="blue1"><div align="right"><strong>Анонс</strong></div></td>
	<td  class="blue1"><textarea name="article_anons" class="fld" style="width:100%"><? if (!empty($article_anons)) {echo $article_anons;}?></textarea></td>
</tr>
<tr class="blue1">
	<td valign="top" class="blue1"><div align="right"><strong>Title</strong></div></td>
	<td><textarea name="title" rows="2" class="fld" style="width:100%"><?echo $title;?></textarea></td>
</tr>
<tr class="blue1" bgcolor="F8FAFC">
	<td valign="top" class="blue1"><div align="right"><strong>Description</strong></div></td>
	<td><textarea name="desc" rows="2" class="fld" style="width:100%"><?echo $desc;?></textarea></td>
</tr>
<tr class="blue1">
	<td valign="top" class="blue1"><div align="right"><strong>Keywords</strong></div></td>
	<td><textarea name="word" rows="2" class="fld" style="width:100%"><?echo $word;?></textarea></td>
</tr>
<tr>
	<td valign="top" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Полный текст</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1">
		<textarea name="article_full" rows="8" class="fld" style="width:100%" onBlur="mag(document.article_add.article_full.value);"><?if (empty($article_full)){echo unhtmlentities($postedValue);}else{echo $article_full;}?></textarea>
		<br>
		<input type="hidden" name="article_temp" value="<?echo $article_temp;?>">
		<input type="hidden" name="article_edit_vis" value="yes">
		<input type="hidden" name="article_post" value="yes">
		<table width="100%"  border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td width="5%" height="10"></td>
			<td width="95%"></td>
		</tr>
		</table>
	</td>
</tr>
<script language="Javascript">
function article_mag(){
document.article_add_save.article_por.value=document.article_add.article_por.value;
document.article_add_save.article_title.value=document.article_add.article_title.value;
document.article_add_save.article_anons.value=document.article_add.article_anons.value;
document.article_add_save.article_full.value=document.article_add.article_full.value;
document.article_add_save.title.value=document.article_add.title.value;
document.article_add_save.desc.value=document.article_add.desc.value;
document.article_add_save.word.value=document.article_add.word.value;
document.article_add_save.status.value=document.article_add.article_status.value;
}
</script>
<tr>
	<td width="5%" align="right"><a href="javascript: document.article_add.submit();"><img src="imgadm/b_edit.gif" width="20" height="20" border="0"></a></td>
	<td width="95%"><a href="javascript: document.article_add.submit();" class="blue1">Запустить Редактор </a></td>
</tr>
<tr>
	<td valign="top" class="blue1" bgcolor="F8FAFC"><div align="right"><strong>Опубликовано:</strong></div></td>
	<td bgcolor="F8FAFC"><input name="status" type="checkbox" class="fld" value="yes" onClick="article_check();" <?if ($article_status==1) echo "Checked"; ?>></td>
</tr>
<tr>
	<td valign="top" class="blue1"><div align="right"><strong>Общий вид:</strong></div></td>
	<td class="blue1">
		<div id="asd">
		<?
		$text = unhtmlentities($postedValue);
		echo $text;
		?>
		</div>
	</td>
</tr>
</table>
<input type="hidden" name="article_status" value="<?echo  $article_status;?>">
</form>
<form name="article_add_save" action="admin.php" method="post">
	<input type="hidden" name="article_edit_ok" value="yes">
	<input type="hidden" name="article_post" value="yes">
	<input type="hidden" name="article_por">
	<input type="hidden" name="article_title">
	<input type="hidden" name="article_anons">
	<input type="hidden" name="article_full">
	<input type="hidden" name="title">
	<input type="hidden" name="desc">
	<input type="hidden" name="word">
	<input type="hidden" name="status">
	<input type="hidden" name="article_temp" value="<?echo $article_temp;?>">
</form>
