<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr valign="top">
	<td height="24" style="padding-left:17px;" valign="top" ><h1>������� �������</h1></td>
</tr>
<tr>
	<td>
		<span class="txt">�� ���� �������������� ��� � ����� ��������� ������� ��������-��������. ����� �� ������� �����������/�������� ����� �� ������������ ��������. ����� ������� �� ���������, ����� ��� ���� ����� ���������������.<br><em>���� � ��� �� ������������ ������, �� ������ ����� � ��� ������� ad-block</em>
		</span>
		</div>
	</td>
</tr>
<tr>
	<td height="13px" background="/img/dots.gif"></td>
</tr>
<?
if (empty($ids))
{?>
<tr>
	<td><div align="left">
<?require "books_cat.php";?></div>
</td></tr><?
}else{?>
<tr valign="top">
			<td valign="top" class="txt">
<script charset="windows-1251" type="text/javascript" src="http://www.ozon.ru/PartnerTwinerNew.aspx?revident=<?echo$ids;?>" ></script></td>
</tr>
<?}?>
</table>
