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
function unhtmlentities($string) 
{
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);
    return strtr($string, $trans_tbl);
}
$vpage_name="";$vpage_name=$_POST['vpage_name'];
$vpage_comment="";$vpage_comment=$_POST['vpage_comment'];
?>
<form name="vpage_add" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="0">
<tr>
	<td>
		<table width="100%"  border="0" cellspacing="2" cellpadding="2">
		<tr>
			<td width="14%" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Название</strong></div></td>
			<td width="86%" valign="middle" bgcolor="F8FAFC">
				<input name="vpage_name" type="text" style="width:100%" class="blue1" value="<?echo $vpage_name;?>">
			</td>
		</tr>
		<tr>
			<td width="14%" valign="top" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Комментарии<br>
				</strong><em>(на сайт не выводятся)</em> </div>
			</td>
			<td width="86%" valign="middle" bgcolor="F8FAFC">
				<textarea name="vpage_comment" rows="3" class="blue1" style="width:100%"><?echo $vpage_comment;?></textarea>
			</td>
		</tr>
		<tr>
			<td height="20" class="blue1"><div align="right"><strong>Ссылка</strong></div></td>
			<td  class="blue1"><em>будет сгенерирована после сохранения </em></td>
		</tr>
		<tr>
			<td valign="top" bgcolor="F8FAFC" class="blue1"><div align="right"><strong>Наполнение</strong></div></td>
			<td bgcolor="F8FAFC" class="blue1"><textarea name="vpage_kod" rows="8" class="fld" style="width:100%" onBlur="mag(document.vpage_add.vpage_kod.value);"><?echo $postedValue;?></textarea>
				<br>
				<table width="100%"  border="0" cellspacing="0" cellpadding="2">
				<tr>
					<td width="5%" height="10"></td>
					<td width="95%"></td>
				</tr>
				<tr>
					<td width="5%"><a href="javascript: document.vpage_add.submit();"><img src="imgadm/b_edit.gif" width="20" height="20" border="0"></a></td>
					<td width="95%"><a href="javascript: document.vpage_add.submit();" class="blue1">Запустить Редактор </a></td>
				</tr>
				</table>
			</td>
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
	</td>
</tr>
		<input type="hidden" name="vpage_add_vis" value="yes">
		<input type="hidden" name="vpage_post" value="yes">
</table>
</form>
<form name="vpage_add_save" action="admin.php" method="post">
	<input type="hidden" name="vpage_add_ok" value="yes">
	<input type="hidden" name="vpage_post" value="yes">
	<input type="hidden" name="vpage_kod">
	<input type="hidden" name="vpage_comment">
	<input type="hidden" name="vpage_name">
</form>