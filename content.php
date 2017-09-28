<?if (($name==="news") and (empty($ids))){require "news_all.php";}
elseif (($name==="news") and (!empty($ids))){require "news_one.php";}
elseif (($name==="article") and (empty($ids))){require "article_all.php";}
elseif (($name==="article") and (!empty($ids))){require "article_one.php";}
elseif ($name==="article_add"){require "article_add.php";}
elseif (($name==="humor") and (empty($ids))){require "humor_all.php";}
elseif ($name==="humor_add"){require "humor_add.php";}
elseif ($name==="name"){require "name.php";}
elseif ($name==='email'){require"email.php";}
elseif (($name==="logs") and (empty($ids))){require "log_new.php";}
elseif (!empty($vname)) {require "vname.php";}
elseif ($name==="book"){require "books.php";}
elseif ($name==="disc"){require "disk.php";}
else {require "pages.php";}
?>
