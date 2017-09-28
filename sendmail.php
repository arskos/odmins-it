<?php
$to="info@evolan.ru";
$subject="from site";
$message = "

Name: ".$_POST['ename']."
Email: ".$_POST['eemail']."
Text: ".$_POST['etext']."
";

$from=".org.ua";
mail($to,$subject,$message,"From: ".$from." <".$from.">");
header("Location: sent.php");
?>
