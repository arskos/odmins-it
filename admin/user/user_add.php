<form name="user_add" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="0">
<tr>
	<td width="31%">&nbsp;			</td>
	<td width="69%">&nbsp;</td>
</tr>
<tr>
	<td valign="middle" >
		<div align="right"><span class="blue1"><strong>����� :</strong></span><br>
		</div>
	</td>
	<td valign="top" >
		<input name="user_login" type="text" size="50" class="blue1" value="">
	</td>
</tr>
<tr>
	<td valign="middle" >
		<div align="right"><span class="blue1"><strong>������ :</strong></span><br>
		</div>
	</td>
	<td valign="top" >
		<input name="user_pas" type="text" size="50" class="blue1" value="">
	</td>
</tr>
<tr>
	<td valign="middle" >
		<div align="right"><span class="blue1"><strong>������ ��� :</strong></span><br>
		</div>
	</td>
	<td valign="top" >
		<input name="user_full" type="text" size="50" class="blue1" value="">
	</td>
</tr>
<tr>
	<td valign="middle">
		<div align="right"><span class="blue1"><strong>����� :</strong></span></div>
	</td>
	<td valign="top" ></td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="pages_c" type="checkbox" class="fld" value="" onClick="user_click();">
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>�������������� �������</strong></span>
	</td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="page_c" type="checkbox" class="fld" value="" onClick="user_click();">
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>�������������� ����</strong></span>
	</td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="news_c" type="checkbox" class="fld" value="" onClick="user_click();">
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>�������������� ��������</strong></span>
	</td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="vpage_c" type="checkbox" class="fld" value="" onClick="user_click();">
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>�������������� ������� �������</strong></span>
	</td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="cons_c" type="checkbox" class="fld" value="" onClick="user_click();">
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>�������������� ��������</strong></span>
	</td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="article_c" type="checkbox" class="fld" value="" onClick="user_click();">
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>�������������� ������</strong></span>
	</td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="humor_c" type="checkbox" class="fld" value="" onClick="user_click();">
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>�������������� �����</strong></span>
	</td>
</tr>
</table>
<input type="hidden" name="user_post" value="yes">
<input type="hidden" name="user_add_ok" value="yes">
<input type="hidden" name="user_pages" value="">
<input type="hidden" name="user_page" value="">
<input type="hidden" name="user_news" value="">
<input type="hidden" name="user_vpage" value="">
<input type="hidden" name="user_cons" value="">
<input type="hidden" name="user_article" value="">
<input type="hidden" name="user_humor" value="">
</form>