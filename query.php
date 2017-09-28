<?
//для безопасного запроса
function codechar($st)
{
	$st=rawurldecode($st);
	if (get_magic_quotes_gpc()){$st=stripslashes($st);}
	if (!is_numeric($st)){$st=mysql_real_escape_string($st);}
	return $st;
}
?>
