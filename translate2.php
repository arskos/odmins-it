<?
$text="Языки синхронно, но если нет данных то не выводить пункт. Всякие комментарии выводятся ВСЕ во всех языках.";
?>
<html>
  <head>
    <script type="text/javascript" src="http://www.google.com/jsapi">
    </script>
    <script type="text/javascript">

    google.load("language", "1");

    function initialize() {
	sText= document.getElementById("vvod_text").value;
	alert(sText.length);
google.language.translate(sText, "ru", "en", function(result) {
  if (!result.error) {
    var container = document.getElementById("translation");
    container.innerHTML = result.translation;
  }
});
    }

    </script>
  </head>
  <body>
  <textarea id="vvod_text" rows="6" style="width:90%;"></textarea><br>
<a href="#" onClick="javascript: initialize('<?echo $text;?>');">Щелкни сюда</a>
    <div id="translation"></div>
  </body>
</html>