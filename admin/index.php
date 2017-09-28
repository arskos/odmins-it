<?session_start();
	$log=$_POST["Login"];
	$pas=$_POST["Password"];
	$er="";
	include "config.php";
	if (!empty($log))
	{
		$_SESSION["user_name"]=$log;
		$my=mysql_query("select * from `admins_user` where login='$log';");
			$my = mysql_fetch_array($my);
			if (($my['login']==$log) and ($my['pas']==md5($pas)))
			{
				$_SESSION['prov']="OK";
				$_SESSION['lang']="uk";
				//header("Location: admin.php");
				//меняем старое посещение на новое
				print "<META HTTP-EQUIV='REFRESH' content='0; url=admin.php?main_page=yes'>";
				$last=mysql_query("SELECT * FROM last_visit WHERE l_n='new'");
				$mains = mysql_fetch_array($last);
				$l_ip=$mains['IP'];
				$l_user=$mains['user'];
				$l_date=$mains['date'];
				mysql_query("UPDATE last_visit SET IP='".$l_ip."',date='".$l_date."', user='".$l_user."' WHERE l_n='last'");
				$ip = $_SERVER['REMOTE_ADDR'];
				$dates=date('Y-m-d H:i:s');
				mysql_query("UPDATE last_visit SET IP='".$ip."',date='".$dates."', user='".$log."' WHERE l_n='new'");
				exit;
			}
			else {$er="yes";}
	}
	$ex=$_GET['ex'];
	if (!empty($ex)) { session_destroy(); }
?>
<html>
<head>
<title>Административная зона управления сайтом</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="stadm.css" type="text/css">
</head>
<body>
<br><br><br><br><br><br><br><br>
<form method = "post" action="index.php">
  <table width="33%" border="0" cellspacing="0" cellpadding="0" align="center" style="border-left: #333333 1px solid; border-right: #134069 1px solid; border-top: #134069 1px solid; border-bottom: #333333 1px solid;">
    <tr>
      <td><img src="imgadm/login-header.jpg" width="453" height="59"></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2" bgcolor="#000000" height="1" align="center"></td>
          </tr>
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="7">
            <tr>
              <td colspan="2"><b class="mmsel">Вход в закрытую зону сайта:</b></td>
            </tr>
            <?
	if ($er==="yes")
	{
?>
            <tr>
              <td colspan="2" bgcolor="red" height="1" align="center" class="mm""><font color="#ffffff"><b><br>
                Вы неправильно ввели логин или пароль. Попробуете ещё раз.<br>
                <br>
              </b></font> </td>
            </tr>
            <?
	}
?>
            <tr>
              <td width="45%" class="grey1"><div align="right"><strong>Логин:</strong></div></td>
              <td width="55%"><input name="Login" type="text" class="pmm">
              </td>
            </tr>
            <tr>
              <td width="45%" class="grey1"><div align="right"><strong>Пароль:</strong></div></td>
              <td width="55%"><input name="Password" type="password" class="pmm">
              </td>
            </tr>
            <tr>
              <td colspan="2"><div align="center">
                  <input type="submit" value="Вход">
              </div></td>
            </tr>
        </table></td>
    </tr>
  </table>
</form>
</body>
</html>


