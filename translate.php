<?
function translate($s_text, $s_lang, $d_lang){
//$url = "http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=".urlencode($s_text)."&langpair=".urlencode($s_lang)."%7C".urlencode($d_lang);
//$url = "http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=Hello&langpair=en%7Cru";
$url = "http://ajax.googleapis.com/ajax/services/language/translate";
$string_q=http_build_query($s_text);
echo $string_q;
$c = curl_init();
curl_setopt($c, CURLOPT_POST, 1);
curl_setopt($c, CURLOPT_POSTFIELD, $string_q);
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_HEADER, false);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_REFERER, "http://odmins-it.ru");
$b = curl_exec($c);
curl_close($c);
return $b;
}
function json2array($json){
   if(get_magic_quotes_gpc()){
      $json = stripslashes($json);
   }
   $json = substr($json, 1, -1);
   $json = str_replace(array(":", "{", "[", "}", "]"), array("=>", "array(", "array(", ")", ")"), $json);
   @eval("\$json_array = array({$json});");
   return $json_array;
}
$text="   -  Росшепер! - Сказал  полицмейстер. - Я  тебе друг?  Я";
$mas=array("v"=>"1.0", "q"=>"world", "langpair"=>"en|ru");
print_r($mas);
$ret=(translate($mas,"en","ru"));
print($ret);
$js_de=json2array($ret);
if ($js_de['responseStatus'] == 200) print ($js_de['responseData']['translatedText']);
?>