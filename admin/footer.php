<?
$quer=mysql_query("SELECT * FROM last_visit WHERE l_n='last'");
$mains = mysql_fetch_array($quer);
$ip=$mains['IP'];
$user=$mains['user'];
//����������� ����� ���������� ���������
$dates=$mains['date'];
$times=substr($dates,11);
//����������� ���� �� ���� ����-��-�� � ��-��-����
$years_y=substr($dates,0,4);
$years_m=substr($dates,5,2);
$years_d=substr($dates,8,2);
$years=$years_d."-".$years_m."-".$years_y;
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10" valign="top"><img src="imgadm/cor3.gif" width="10" height="3"></td>
    <td class="grey1">������ PHP:<strong><? echo phpversion();?></strong><br>
    ��������� ����� �� �������: <strong><? echo (int)((disk_free_space("/home/belov/data/www/odmins-it.ru/admin/"))/1024/1024); ?> Mb</strong><br>
    ��������� ������: <strong><? echo "������������ ".$user." � ".$times." ".$years." c IP ".$ip; ?></strong></td>
    <td width="1"><img src="imgadm/sp.gif" width="1" height="62"></td>
    <td><div align="right"><span class="grey1">���������� <a href="http://bionic.org.ua" class="grey1" target="_blank">BionicStudio</a><br>
    ������ ������ 15.09.2009</span><br>
    </div></td>
    <td width="10" valign="top"><img src="imgadm/cor4.gif" width="10" height="3"></td>
</tr>
</table>