<?php
     // начало программы
     include "rss2.php";           // это собственно класс
     include "conn.php";           // переменные для открытия базы


   $Rss= new CRss();

   $Rss->Title="Новости odmins-it.ru";
   $Rss->Link=htmlspecialchars("http://www.odmins-it.ru/");
   $Rss->Copyright="© Copyright by odmins-it.ru, 2009-2010";
   $Rss->Description="Новостная лента";
   $Rss->Category = "Новости";
   $Rss->Language="ru";
   $Rss->ManagingEditor=htmlspecialchars("info@odmins-it.ru (odmins-it.ru)");
   $Rss->WebMaster=htmlspecialchars("info@odmins-it.ru(odmins-it.ru)");
   $Rss->Query="SELECT
                admins_news.news_anons,
                admins_news.data,
				admins_news.id
	FROM admins_news
     ORDER by data desc Limit 0,20";

    $Rss->Open($Server,$DataBase,$Login,$Password);
	mysql_query("SET NAMES 'latin1'");
    $Rss->LastBuildDate=date("r");
      // получаем последнюю дату публикации
     $query = "select admins_news.data
                        FROM admins_news
          ORDER by admins_news.data desc Limit 0,1";

      $result1 = mysql_query($query)
              or die("FROM blog failed");

      $line = mysql_fetch_array($result1);

      $Date =date("r",strtotime($line[0]));
       mysql_free_result($result1);

      $Rss->LastBuildDate=$Date;
      $Rss->PubDate=$Rss->LastBuildDate;

     echo $Rss->PrintHeader();
     $Rss->Query();

     while ($line = mysql_fetch_array($Rss->Result))
     {   // для каждой записи выведем
               $Title = "Новости odmins-it.ru";
               $Description = $line[0];
               $Link=htmlspecialchars("http://www.odmins-it.ru/news/").$line[2]."/";
			   $temp=explode("-",$line[1]);
			   #$temp="0,0,0,12,12,2009";
			   $temp_date=mktime(0,0,0,$temp[1],$temp[2],$temp[0]);
               $PubDate=date("D, d M Y", $temp_date);
			   $PubDate.=" 00:00:00 +0300";
               //$Category=$line[4];
               $Rss->PrintBody($Title,$Link,$Description,$Category,$PubDate);
    }
    $Rss->PrintFooter();
    $Rss->Close();
?>









