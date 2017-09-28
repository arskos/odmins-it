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
<script type='text/javascript' src='func_js.js'></script>
<script type='text/javascript' src='../bash/main_js.js'></script>
<script type='text/javascript' src='../bash/user_js.js'></script>
</head>
<body onLoad="javascript: bash_input.focus();getSettings();">
<script type="text/javascript"> 
    (function () {//веселая функция, запрещающая прокрутку стрелками
        var prevent = function ( e ) {
            if ( e.keyCode ==38 && e.keyCode ==40 ) {
                (e = e || window.event).preventDefault ? e.preventDefault() : (e.returnValue = false);
            }
        }
        if ( document.addEventListener ) {
            document.addEventListener( 'keypress', prevent, false );
        } else if ( document.attachEvent ) {
            document.attachEvent( 'onkeypress', prevent );
        } else {
            document.onkeypress = prevent;
        }
    })();
    setInterval(function () {
       document.body.scrollTop = 0;
    }, 30);
    
window.onresize=function(){window.scroll(0,document.body.clientHeight+50);}//а если меняется размер этого окна при ресайзе главного-делаем скроллинг. потому что если так не сделать длинный текст будет виден в середине, а инпута видно не будет

</script>
<div id="bash_output"></div>
root@odmins-it.ru:~#
<!--рисуем строку ввода-->
<input type="text" id="bash_input" name="bash_input" size="100%" style="border:none;"  onkeypress="history(event,this.value);bash('clear && '+this.value,event.keyCode);" onblur="bash_input.focus();" class="bash_main">
<div id="down"></div>
</body>
</html>