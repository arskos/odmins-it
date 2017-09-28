<?session_start();
function send_mime_mail($name_from, // имя отправителя
                        $email_from, // email отправителя
                        $name_to, // имя получателя
                        $email_to, // email получателя
                        $data_charset, // кодировка переданных данных
                        $send_charset, // кодировка письма
                        $subject, // тема письма
                        $body // текст письма
                        ) {
  $to = mime_header_encode($name_to, $data_charset, $send_charset)
                 . ' <' . $email_to . '>';
  $subject = mime_header_encode($subject, $data_charset, $send_charset);
  $from =  mime_header_encode($name_from, $data_charset, $send_charset)
                     .' <' . $email_from . '>';
  if($data_charset != $send_charset) {
    $body = iconv($data_charset, $send_charset, $body);
  }
  $headers = "From: $from\r\n";
  $headers .= "Content-type: text/html; charset=$send_charset\r\n";

  return mail($to, $subject, $body, $headers);
}

function mime_header_encode($str, $data_charset, $send_charset) {
  if($data_charset != $send_charset) {
    $str = iconv($data_charset, $send_charset, $str);
  }
  return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}


$err="";
$action=$_POST['action'];
$ok="";
if (!empty($action))
{
if (isset($_POST['tt_pass']))
{
	if ($_POST['tt_pass']!==$_SESSION['tt_pass'])
	{$err="<li height='20' class='lnk2'><div align='center'><strong>Не правильно введены символы с картинки</strong></div></li>";}
}
else {$err="<li height='20' class='lnk2'><div align='center'><strong>Не правильно введены символы с картинки</strong></div></li>";}
/* 	$tname="";$tname=$_POST['tname'];
	$temail="";$temail=$_POST['temail'];
	$ttema="";$ttema=$_POST['ttema'];
	$tanons="";$tanons=$_POST['tanons']; */
	$ttxt="";$ttxt=$_POST['ttxt'];
	if (empty($err))
	{
/* 		$tname = substr($_POST["tname"],0,32);
		$tname = htmlspecialchars(stripslashes($tname)); // обрабатываем имя
		$temail = substr($_POST["temail"],0,32);
		$temail = htmlspecialchars(stripslashes($temail)); // обрабатываем e-mail
		$ttema = substr($_POST["ttema"],0,1024);
		$ttema = htmlspecialchars(stripslashes($ttema)); // обрабатываем тему
		$tanons = substr($_POST["tanons"],0,1024);
		$tanons = htmlspecialchars(stripslashes($tanons)); // обрабатываем анонс */
		$ttxt = substr($_POST["ttxt"],0,1024);
		$ttxt = htmlspecialchars(stripslashes($ttxt)); // обрабатываем сообщение
		$my=mysql_query("SELECT * FROM `admins_constants`");
		$main=mysql_fetch_array($my);
		$e_mail=$main['email'];
		$tl="Цитата<br>Текст: ".$ttxt."\n";
		send_mime_mail($tname,
               '',
               '',
               '',
               'windows-1251',  // кодировка, в которой находятся передаваемые строки
               'windows-1251', // кодировка, в которой будет отправлено письмо
               'С сайта. Цитаты',
               $tl);
		$ok="yes";
		$max=mysql_result((mysql_query("SELECT MAX(id) FROM `admins_humor`;")),0);
		$max=$max+10;
		$date_ok=date("Y")."-".date("n")."-".date("j");
		mysql_query("INSERT INTO `admins_humor` VALUES ('$max','$date_ok','$ttxt','0');");
	}
}
$my=mysql_query("SELECT * FROM `admins_page` WHERE soderganie='humor_add';");
$main=mysql_fetch_array($my);
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="24" style="padding-left:17px;"><h1><?echo $main['name'];?></h1></td>
</tr>
<tr>
	<td><span class="txt"><?echo html_entity_decode($main['kod']);?></span></td>
</tr>
</table>
<br><br>
<?

if (!empty($err))
{
	echo "<ul height='20' class='lnk2'><div align='center'><strong>ОШИБКА</strong></div></ul>";
	echo $err;
	$_SESSION['tt_pass']="";
}
if (($ok==="yes") && (empty($err)))
{
	echo "<span class='txt'><strong>Ваше цитата отправлена на рассмотрениии</strong></span>";
	$_SESSION['tt_pass']="";
	$tt_pass="dd";
	$tname="";
	$temail="";
	$ttxt="";
}
if (!empty($err) or ($ok!=="yes"))
{
?>
<form name="send_mes" method="post" action="/humor_add/" onSubmit="return checkData2();">
<table width="100%"  border="0" cellpadding="3" cellspacing="3" class="txt">
<tr>
	<td width="10%" ></td>
	<td width="90%" class="ntxt"><em>* Все поля обязательны для заполнения </em></td>
</tr>
<tr>
	<td height="25"><div align="right"></div></td>
	<td></td>
</tr>
<tr>
	<td valign="top"><div align="right">Текст</div></td>
	<td><textarea name="ttxt" cols="45" rows="9" class="txt" id="ttxt" style="width:90%"><?if (!empty($ttxt)){echo $ttxt;}?></textarea></td>
</tr>
<tr>
	<td></td>
	<td>
		<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="txt">
		<tr>
			<td colspan="2"><img src="/cap/cap_image.php"></td>
		</tr>
		<tr>
			<td width="200px">Введите символы с картинки: </td>
			<td><input name="tt_pass" type="text" size="10" maxlength="10" class="txt"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td></td>
	<td><input type="image" name="Ok" value="Submit" src="/img/but_send.gif" width="100" height="24"></td>
</tr>
</table>
	<input type="hidden" name="action" value="yes">
	</form>
<?}?>