<?if (isset($_GET['act'])) $act=$_GET['act'];?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr valign="top">
	<td height="24" style="padding-left:17px;" valign="top" ><h1>������� �� �����������</h1></td>
</tr>
<tr>
	<td>
		<span class="txt">�� ���� �������������� ��� � ����� ��������� ��������-��������. ����� �� ������� �����������/�������� ������, ����������� � ���������� ��. ��� ������ ������� �� ���������, ����� ��� ���� ����� ���������������.<br><span style="font-weight:bold;">����� ���������� ������� � ������� �� �������� <a href="https://www.linuxcenter.ru/profile/cart/" target="_blank">�������� �����</a></span>
		</span>
		</div>
	</td>
</tr>
<?
if (empty($act))
{?>
<tr>
	<td height="13px" background="/img/dots.gif"></td>
</tr>
<tr>
	<td><div align="left">
<?require "disk_main_cat.php";?></div>
</td></tr>
<?}elseif ($act==="cat"){?>
<tr>
	<td height="13px" background="/img/dots.gif"></td>
</tr>
<tr>
	<td><div align="left">
<?require "disk_cat.php";?></div>
</td></tr>
<?}elseif ($act==="item"){?>
<tr>
	<td height="13px" background="/img/dots.gif"></td>
</tr>
<tr>
	<td><div align="left">
<?require "disk_item.php";?></div>
</td></tr>
<?}?>
</table>