<?
require "../bash/config.php";
$base_path=realpath('');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<title>odmins-it on bash</title>
<meta name="description" content="Сайт odmins-it.ru для любителей терминала."/>
<meta name="keywords" content="odmins-it, admins@c.j.r., bash"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<meta http-equiv="Content-language" content="ru"/>
<link rel="stylesheet" href="../bash/bash.css" type="text/css"/>
</head>
<body onload="resize();" onmouseout="resize();">
odmins-it.ru в новом виде, для любителей терминала.<br>
Для начала ознакомьтесь со справочной информацией по команде help<br><br><br><br>
<div id="if_div" name="if_div" width="100%" > 
<iframe src="../bash/content.php"  width="100%" height="400px" align="left" style="border:none" name="bash_iframe" id="bash_iframe">Ваш браузер не поддерживает плавающие фрэймы</iframe>
</div>

<script type="text/javascript">
function resize(){
var height = document.documentElement.clientHeight;
height -= document.getElementById('if_div').offsetTop;
	
document.getElementById("if_div").height =height-40;
document.getElementById("bash_iframe").height = document.getElementById("if_div").height +"px";

}

window.onresize=function(){resize();}//если делаем ресайз-вызываем функцию ресайза
</script>
</body>
</html>