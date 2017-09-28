<?
session_start();
if($_SESSION['prov']==="OK")
{
	include "config.php";
	include "peremen.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta content="text/html; charset=windows-1251" http-equiv="Content-Type" />
<META HTTP-EQUIV="Content-language" CONTENT="ru-RU">
<title>Admin</title>
<link href="stadm.css" rel="stylesheet" type="text/css" />
</head>
<body topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0">
<script src="script.js" type="text/javascript"></script>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
<!--shapka-->
<tr>
	<td width="4" height="62"><img src="imgadm/sp.gif" width="28" height="1"></td>
	<td background="imgadm/topgray.gif"><?include "shapka.php";?></td>
    <td width="4"><img src="imgadm/sp.gif" width="28" height="1"></td>
</tr>
<!--shapka-->
<tr>
    <td height="6" colspan="3"></td>
</tr>
<tr height="100%">
	<td></td>
	<td>
		<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
		<tr>
		<!--left menu-->
			<td width="200" valign="top">
				<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
			    <tr valign="top">
					<td colspan="3">
						<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="9"><img src="imgadm/mm_top1.gif" width="9" height="26"></td>
							<td height="26" background="imgadm/mm_top2.gif" class="blue1" valign="middle">Меню сайта</td>
							<td width="9"><img src="imgadm/mm_top3.gif" width="9" height="26"></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="9" valign="top" background="imgadm/mm_c1.gif">
						<img src="imgadm/mm_left.gif" width="9" height="40">
					</td>
					<td valign="top" background="imgadm/mm_c2.gif">
						<? require "left_menu_tree.php"; ?>
					</td>
					<td width="9" valign="top" background="imgadm/mm_c3.gif">
						<img src="imgadm/mm_right.gif" width="9" height="40">
					</td>
				</tr>
				<tr>

						<td height="3"><img src="imgadm/mm_bot1.gif" width="9" height="3"></td>
						<td background="imgadm/mm_bot2.gif" width=100%></td>
						<td><img src="imgadm/mm_bot3.gif" width="9" height="3"></td>
				</tr>
				<tr height="100%">
					<td colspan="3" valign="top">
					<? include "left_menu_icons.php"; ?>
					</td>
				</tr>
				</table>
			</td>
		<!--left menu-->
			<td width="9"></td>
		<!--right menu-->
			<td valign="top">
				<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
			    <tr valign="top">
					<td width="9"><img src="imgadm/mm_top1.gif" width="9" height="26"></td>
					<td height="26" background="imgadm/mm_top2.gif" class="blue1" valign="middle"><div class="blue1">
						Раздел: <strong><? echo $razdel; ?></strong></div>
					</td>
					<td width="9"><img src="imgadm/mm_top3.gif" width="9" height="26"></td>
				</tr>
				<tr>
					<td width="9" valign="top" background="imgadm/mm_c1.gif">
						<img src="imgadm/mm_left.gif" width="9" height="40">
					</td>
					<td valign="top" background="imgadm/mm_c2.gif">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<br>
						<tr>
						<td valign="top">
						<?
							if ($main_page==="yes"){require "mains.htm";}
							if ($page==="yes"){require "page/page.php";}
							if ($mails==="yes"){require "mails/mails.php";}
							if ($user==="yes"){require "user/user.php";}
							if ($news==="yes"){require "news/news.php";}
							if ($humor==="yes"){require "humor/humor.php";}
							if ($consts==="yes"){require "constants/cons.php";}
							if ($article==="yes"){require "article/article.php";}
						?>
						</td>
						</tr>
						</table>
					</td>
					<td width="9" valign="top" background="imgadm/mm_c3.gif">
						<img src="imgadm/mm_right.gif" width="9" height="40">
					</td>
				</tr>
				<tr>
					<td height="3"><img src="imgadm/mm_bot1.gif" width="9" height="3"></td>
					<td background="imgadm/mm_bot2.gif"></td>
					<td><img src="imgadm/mm_bot3.gif" width="9" height="3"></td>
				</tr>
				</table>
			</td>
		<!--right menu-->
		</tr>
		</table>
	</td>
	<td></td>
</tr>
<tr>
    <td height="6" colspan="3"></td>
</tr>
<!--footer-->
<tr>
	<td height="62"></td>
    <td background="imgadm/bottgray.gif">
		<? include "footer.php"; ?>
	</td>
    <td></td>
</tr>
<!--footer-->
</table>
</body>
</html>
<?
}
else
{
	print "<META HTTP-EQUIV='REFRESH' content='0; url=index.php'>";
}
?>