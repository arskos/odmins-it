<?
$user_ids="";$user_ids=$_GET['user_ids'];
$my=mysql_query("SELECT * FROM `admins_user` WHERE id='$user_ids';");
$main=mysql_fetch_array($my);
?>
<form name="user_add" action="admin.php" method="post">
<table width="100%"  border="0" cellspacing="2" cellpadding="0">
<tr>
	<td width="31%">&nbsp;			</td>
	<td width="69%">&nbsp;</td>
</tr>
<tr>
	<td valign="middle" >
		<div align="right"><span class="blue1"><strong>Логин :</strong></span><br>
		</div>
	</td>
	<td valign="top" >
		<input name="user_login" type="text" size="50" class="blue1" value="<?echo $main['login'];?>">
	</td>
</tr>
<tr>
	<td valign="middle" >
		<div align="right"><span class="blue1"><strong>Пароль :</strong></span><br>
		</div>
	</td>
	<td valign="top" >
		<input name="user_pas" type="text" size="50" class="blue1" value="">
	</td>
</tr>
<tr>
	<td valign="middle" >
		<div align="right"><span class="blue1"><strong>Полное имя :</strong></span><br>
		</div>
	</td>
	<td valign="top" >
		<input name="user_full" type="text" size="50" class="blue1" value="<?echo $main['full_name'];?>">
	</td>
</tr>
<?if ($main['role']!=='admin'){?>
<tr>
	<td valign="middle">
		<div align="right"><span class="blue1"><strong>Права :</strong></span></div>
	</td>
	<td valign="top" ></td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="pages_c" type="checkbox" class="fld" value="" onClick="user_click();" <?if ($main['page']==1) echo "checked";?>>
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>Редактирование страниц</strong></span>
	</td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="page_c" type="checkbox" class="fld" value="" onClick="user_click();" <?if ($main['structura']==1) echo "checked";?>>
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>Редактирование меню</strong></span>
	</td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="news_c" type="checkbox" class="fld" value="" onClick="user_click();" <?if ($main['news']==1) echo "checked";?>>
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>Редактирование новостей</strong></span>
	</td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="vpage_c" type="checkbox" class="fld" value="" onClick="user_click();" <?if ($main['vpage']==1) echo "checked";?>>
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>Редактирование висячих страниц</strong></span>
	</td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="article_c" type="checkbox" class="fld" value="" onClick="user_click();">
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>Редактирование статей</strong></span>
	</td>
</tr>
<tr>
	<td valign="top" align="right">
		<input name="humor_c" type="checkbox" class="fld" value="" onClick="user_click();">
	</td>
	<td valign="middle" >
		<span class="blue1"><strong>Редактирование юмора</strong></span>
	</td>
</tr>
<?}?>
</table>
<input type="hidden" name="user_ids" value="<?echo $user_ids;?>">
<input type="hidden" name="user_post" value="yes">
<input type="hidden" name="user_edit_ok" value="yes">
<input type="text" name="user_pages" value="">
<input type="text" name="user_page" value="">
<input type="text" name="user_news" value="">
<input type="text" name="user_vpage" value="">
<input type="text" name="user_cons" value="">
<input type="text" name="user_article" value="">
<input type="text" name="user_humor" value="">
</form>