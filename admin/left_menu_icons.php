<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<?
$login=$_SESSION['user_name'];
$my=mysql_query("SELECT * FROM `admins_user` WHERE LOGIN='$login';");
$main=mysql_fetch_array($my);
?>
<tr>
	<td valign="top"><div align="center">
<?if ($main['structura']==1){?>
	<a href="admin.php?page=yes&page_show=yes"><img src="imgadm/ico_menu.gif" width="64" height="58" border="0"></a><br><a href="admin.php?page=yes&page_show=yes" class="blue1">Редактирование<br>меню</a></div>
<?}else{?>
	<img src="imgadm/ico_menu_no.gif" width="64" height="58" border="0"><br><div class="blue1_no">Редактирование<br>меню</div>
<?}?>
	</td>
	<td valign="top"><div align="center">
<?if ($main['mail']==1){?>
	<a href="admin.php?mails=yes&mails_show=yes"><img src="imgadm/ico_mail.gif" width="64" height="58" border="0"></a><br><a href="admin.php?mails=yes&mails_show=yes" class="blue1">Рассылка</a></div>
<?}else{?>
	<img src="imgadm/ico_mail_no.gif" width="64" height="58" border="0"><br><div class="blue1_no">Рассылка</div>
<?}?>
	</td>
</tr>
<tr>
	<td height="10"></td>
	<td></td>
</tr>
<tr>
	<td valign="top"><div align="center">
<?if ($main['news']==1){?>
	<a href="admin.php?news=yes&news_show=yes"><img src="imgadm/ico_news.gif" width="64" height="58" border="0"></a><br><a href="admin.php?news=yes&news_show=yes" class="blue1">Новости</a></div>
<?}else{?>
	<img src="imgadm/ico_news_no.gif" width="64" height="58" border="0"><br><div class="blue1_no">Новости</div>
<?}?>
	</td>
	<td valign="top"><div align="center">
<?if ($main['const']==1){?>
	<a href="admin.php?consts=yes&consts_show=yes"><img src="imgadm/ico_constants.gif" width="64" height="58" border="0"></a><br><a href="admin.php?consts=yes&consts_show=yes" class="blue1">Константы</a></div>
<?}else{?>
	<img src="imgadm/ico_constants_no.gif" width="64" height="58" border="0"><br><div class="blue1_no">Константы</div>
<?}?>
	</td>
</tr>
<tr>
	<td height="10"></td>
	<td></td>
</tr>
<tr>
	<td valign="top"><div align="center">
<?if ($main['user']==1){?>
	<a href="admin.php?user=yes&user_show=yes"><img src="imgadm/ico_user.gif" width="64" height="58" border="0"></a><br><a href="admin.php?user=yes&user_show=yes" class="blue1">Пользователи</a></div>
<?}else{?>
	<img src="imgadm/ico_user_no.gif" width="64" height="58" border="0"><br><div class="blue1_no">Пользователи</div>
<?}?>
	</td>
</tr>
</table>