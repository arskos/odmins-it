<?
if ($name==="news")
{echo "�������";}
elseif ($name==="humor")
{echo "����";}
elseif ($name==="book")
{echo "admins@.c.j.r., �����, ������, �������";}
elseif ($name==="disc")
{echo "admins@.c.j.r., ���, ������, �����, ��������, ������, �������";}
elseif ($name==="logs")
{echo "����, �����������, admins@c.j.r";}
elseif ($name==="humor_add")
{
	$my=mysql_query("SELECT * FROM `admins_page` WHERE soderganie='humor_add';");
}
elseif ($name==="page")
{
{$my=mysql_query("SELECT * FROM `admins_page` WHERE soderganie='$ids';");}
}
elseif ($name==="article")
{
	if (empty($ids))
	{$my=mysql_query("SELECT * FROM `admins_page` WHERE soderganie='article';");}
	else
	{$my=mysql_query("SELECT * FROM `admins_article` WHERE id='$ids';");}
}
elseif ($name==="article_add")
{
	if (empty($ids))
	{$my=mysql_query("SELECT * FROM `admins_page` WHERE soderganie='article_add';");}
	else
	{$my=mysql_query("SELECT * FROM `admins_article` WHERE id='$ids';");}
}
elseif ($name==="email")
{
	if (empty($ids))
	{$my=mysql_query("SELECT * FROM `admins_page` WHERE soderganie='email';");}
	else
	{$my=mysql_query("SELECT * FROM `admins_article` WHERE id='$ids';");}
}
if (($name!=="news") and ($name!=="humor") and ($name!=="logs") and ($name!=="book") and ($name!=="disc"))
{
	$main=mysql_fetch_array($my);
	echo $main['keywords'];
}
?>