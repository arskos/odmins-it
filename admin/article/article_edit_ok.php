<div class=blue1 align=center>
<?
$article_por=$_POST['article_por'];
$article_title=$_POST['article_title'];
$article_anons=$_POST['article_anons'];
$article_temp=$_POST['article_temp'];
$article_full=$_POST['article_full'];
$title=$_POST['title'];
$desc=$_POST['desc'];
$word=$_POST['word'];
$status=$_POST['status'];
//������� ��������� �� ������ �� �������, ���
if ((!empty($article_por)) and (!empty($article_title)))
{
	//���� ������� �� ���������
	if ($article_temp===$article_por)
	{
		if ((mysql_query("UPDATE `admins_article` SET title='$article_title', anons='$article_anons', full='$article_full',title='$title',keywords='$word',description='$desc',status='$status' WHERE id='$article_temp';"))===true)
			{echo "<p>������ ������ �������</p>";
			?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?article=yes&article_show=yes&ids=<?echo $article_por;?>'><?}
		else {echo mysql_error();}
	}
	//���� ��������� �������
	else
	{
	//������� ��� �� ������ ��� ������
		$my=mysql_query("SELECT * FROM `admins_article` WHERE id='$article_por';");
		$main=mysql_fetch_array($my);
		if ($article_por!==$main['id'])
		{
			//������ ������ ������� ������
			if ((mysql_query("UPDATE `admins_article` SET id='$article_por',title='$article_title', anons='$article_anons', full='$article_full',title='$title',keywords='$word',description='$desc',status='$status' WHERE id='$article_temp';"))===true)
			{echo "<p>������ ������ �������</p>".$n;
			?><META HTTP-EQUIV='REFRESH' content='3; url=admin.php?article=yes&article_show=yes&ids=<?echo $article_por;?>'><?}
			else {echo mysql_error();}
		}
		else
		{?>������. ����� ������� ��� ����������<br>
			<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">��������� �����</a><?}
	}
}
else
{?>������. �� ������ ������� ��� �������� ��������<br>
	<a href="javascript:history.go(-1)" mce_href="javascript:history.go(-1)" class="blue1">��������� �����</a><?}
?>
</div>