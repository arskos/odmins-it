<?
session_start();
echo '<a href="'. $_SERVER['PHP_SELF'] .'">Попробуйте еще раз</a>';
if ($_REQUEST['tt_pass'])
{
	if ($_REQUEST['tt_pass']==$_SESSION['tt_pass'])
		echo "ok";
	else
		echo "no";
exit(0);
}
print '<form action="'.$_SERVER['PHP_SELF'].'"method="post">';
?>
<img src="cap_image.php"><br>
Letters: <input name="tt_pass" type="text" size="10" maxlength="10">
<input type="submit">
</form>