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
$radiobutton="";$radiobutton=$_POST['radiobutton'];
if (!empty($radiobutton))
{
	if ($radiobutton==="razd") {$razd="Раздел";}
	elseif ($radiobutton==="podrazd") {$razd="Подраздел";}
	$postedValue="";
}
else{$razd="";$razd=$_POST['razd'];}
$roditel="";$roditel=$_POST['roditel'];
if (!empty($roditel))
	{$name_roditel=mysql_result(mysql_query("SELECT * FROM `admins_page` WHERE ids_razdel='$roditel';"),0,2);}
$page_por=$_POST['page_por'];
$page_name=$_POST['page_name'];
$page_title=$_POST['page_title'];
$page_desc=$_POST['page_desc'];
$page_word=$_POST['page_word'];
$page_ssylka=$_POST['page_ssylka'];
?>
<form name="page_add_2" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="2">
<tr>
	<td width="14%" height="25" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Тип</strong></div></td>
	<td width="86%" valign="middle" bgcolor="F8FAFC" class="blue1"><?echo $razd;?></td>
	<input type="hidden" name="razd" value="<?echo $razd;?>">
</tr>
<tr>
	<td height="25" class="blue1"><div align="right"><strong>Родитель</strong></div></td>
	<td  class="blue1"><?if ($razd==="Подраздел") {echo $name_roditel;}?></td>
	<input type="hidden" name="roditel" value="<?echo $roditel;?>">
</tr>
<?
//	if ($razd==="Раздел") {require "page_add_2_razdel.php";}
//	elseif ($razd==="Подраздел") {require "page_add_2_podrazdel.php";}
?>
<tr>
	<td height="25" class="blue1"><div align="right"><strong>Порядок</strong></div></td>
	<td  class="blue1"><input name="page_por" type="text" class="blue1" size="4" maxlength="4" onBlur="validate(this);" value="<? echo $page_por;?>">
		&nbsp;<em>Влияет на последовательность </em></td>
</tr>
<tr>
	<td height="25" class="blue1"><div align="right"><strong>Название</strong></div></td>
	<td  class="blue1"><input name="page_name" type="text" style="width:100%" class="blue1" value="<? echo $page_name;?>"></td>
</tr>
<tr>
	<td height="25" class="blue1"><div align="right"><strong>ЧПУ</strong></div></td>
	<td  class="blue1"><input name="page_ssylka" type="text" style="width:100%" class="blue1" value="<? echo $page_ssylka;?>"></td>
</tr>
<tr class="blue1">
	<td valign="top" class="blue1"><div align="right"><strong>Title</strong></div></td>
	<td><textarea name="page_title" rows="2" class="fld" style="width:100%"><?echo $page_title;?></textarea></td>
</tr>
<tr class="blue1" bgcolor="F8FAFC">
	<td valign="top" class="blue1"><div align="right"><strong>Description</strong></div></td>
	<td><textarea name="page_desc" rows="2" class="fld" style="width:100%"><?echo $page_desc;?></textarea></td>
</tr>
<tr class="blue1">
	<td valign="top" class="blue1"><div align="right"><strong>Keywords</strong></div></td>
	<td><textarea name="page_word" rows="2" class="fld" style="width:100%"><?echo $page_word;?></textarea></td>
</tr>
<tr>
	<td valign="top" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Наполнение</strong></div></td>
	<td bgcolor="F8FAFC" class="blue1"><textarea name="page_kod" rows="8" class="fld" style="width:100%" onBlur="mag(document.page_add_2.page_kod.value);"><?echo $postedValue;?></textarea>
	<br>
		<table width="100%"  border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td width="5%" height="10"></td>
			<td width="95%"></td>
		</tr>
		<tr>
			<td width="5%"><a href="javascript: document.page_add_2.submit();"><img src="imgadm/b_edit.gif" width="20" height="20" border="0"></a></td>
			<td width="95%"><a href="javascript: document.page_add_2.submit();" class="blue1">Запустить Редактор </a></td>
		</tr>
		</table>
	</td>
</tr>
<script language="Javascript">
function page_mag(){
document.page_add_save.page_kod.value=document.page_add_2.page_kod.value;
document.page_add_save.page_por.value=document.page_add_2.page_por.value;
document.page_add_save.page_name.value=document.page_add_2.page_name.value;
document.page_add_save.page_title.value=document.page_add_2.page_title.value;
document.page_add_save.page_desc.value=document.page_add_2.page_desc.value;
document.page_add_save.page_word.value=document.page_add_2.page_word.value;
document.page_add_save.page_ssylka.value=document.page_add_2.page_ssylka.value;
}
</script>
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
		<input type="hidden" name="page_add_vis" value="yes">
		<input type="hidden" name="page_post" value="yes">
</form>
<form name="page_add_save" action="admin.php" method="post">
	<input type="hidden" name="page_add_ok" value="yes">
	<input type="hidden" name="page_post" value="yes">
	<input type="hidden" name="page_kod">
	<input type="hidden" name="page_por">
	<input type="hidden" name="page_title">
	<input type="hidden" name="page_desc">
	<input type="hidden" name="page_word">
	<input type="hidden" name="page_ssylka">
	<input type="hidden" name="razd" value="<?echo $razd;?>">
	<input type="hidden" name="roditel" value="<?echo $roditel;?>">
	<input type="hidden" name="page_name">
</form>