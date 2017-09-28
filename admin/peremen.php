<?
function unhtmlentities($string) 
{
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);
    return strtr($string, $trans_tbl);
}
$login=$_SESSION['user_name'];
$ids="";$ids=$_GET['ids'];
//если только пришли
$main_page="";$main_page=$_GET['main_page'];
//конец - если только пришли

//блок пользователей
$user="";$user=$_GET['user'];
if (empty($user)) {$user=$_POST['user_post'];}
$user_show="";$user_show=$_GET['user_show'];
$user_add="";$user_add=$_GET['user_add'];
$user_add_ok="";$user_add_ok=$_POST['user_add_ok'];
$user_edit="";$user_edit=$_GET['user_edit'];
$user_edit_ok="";$user_edit_ok=$_POST['user_edit_ok'];
$user_del="";$user_del=$_GET['user_del'];
$user_del_all="";$user_del_all=$_POST['user_del_all'];
//что пишем в разделе
if ($user_show==="yes") {$razdel="Просмотр и редактирование пользователей";}
if ($user_add==="yes") {$razdel="<a href='admin.php?user=yes&user_show=yes' class='blue1'>Просмотр и редактирование пользователей</a> / Добавление нового пользователя";}
if ($user_add_ok==="yes") {$razdel="<a href='admin.php?user=yes&user_show=yes' class='blue1'>Просмотр и редактирование пользователей</a> / <a href='admin.php?user=yes&user_add=yes' class='blue1'>Добавление нового пользователя</a> / Сохранение";}
if ($user_edit==="yes") {$razdel="<a href='admin.php?user=yes&user_show=yes' class='blue1'>Просмотр и редактирование пользователей</a> / Редактирование пользователя";}
if ($user_edit_ok==="yes") {$razdel="<a href='admin.php?user=yes&user_show=yes' class='blue1'>Просмотр и редактирование пользователей</a> / <a href='admin.php?user=yes&user_add=yes' class='blue1'>Редактирование пользователя</a> / Сохранение";}
//конец блока пользователей

//блок левой части страниц
$ids_razdel="";$ids_razdel=$_GET['ids_razdel'];
//конец блока левой части страниц

//блок страниц
$page="";$page=$_GET['page'];
$page_post="";$page_post=$_POST['page_post'];
if ((empty($page)) and ($page_post==="yes")) {$page="yes";}
$page_show="";$page_show=$_GET['page_show'];
$page_add_1="";$page_add_1=$_GET['page_add_1'];
$page_add_2="";$page_add_2=$_POST['page_add_2'];
$page_add_vis="";$page_add_vis=$_POST['page_add_vis'];
$page_add_ok="";$page_add_ok=$_POST['page_add_ok'];
$page_del_razdel="";$page_del_razdel=$_GET['page_del_razdel'];
$page_del_podrazdel="";$page_del_podrazdel=$_GET['page_del_podrazdel'];
$page_edit="";$page_edit=$_GET['page_edit'];
if (empty($page_edit)) {$page_edit=$_POST['page_edit'];}
$page_edit_vis="";$page_edit_vis=$_POST['page_edit_vis'];
$page_edit_ok="";$page_edit_ok=$_POST['page_edit_ok'];
$page_del_all="";$page_del_all=$_POST['page_del_all'];
$page_sort_razd="";$page_sort_razd=$_GET['page_sort_razd'];
$page_sort_razd_ok="";$page_sort_razd_ok=$_POST['page_sort_razd_ok'];
$page_sort_podrazd="";$page_sort_podrazd=$_GET['page_sort_podrazd'];
$page_sort_podrazd_ok="";$page_sort_podrazd_ok=$_POST['page_sort_podrazd_ok'];
//что пишем в разделе
if ($page_show==="yes") {$razdel="Редактирование меню";}
if (($page_add_1==="yes") or ($page_add_2==="yes")) {$razdel="<a href='admin.php?page=yes&page_show=yes' class='blue1'>Редактирование меню</a> / Создание нового пункта";}
if ($page_add_vis==="yes") {$razdel="<a href='admin.php?page=yes&page_show=yes' class='blue1'>Редактирование меню</a> / <a href='admin.php?page=yes&page_add_1=yes' class='blue1'>Создание нового пункта</a> / Визульный редактор";}
if ($page_add_ok==="yes") {$razdel="<a href='admin.php?page=yes&page_show=yes' class='blue1'>Редактирование меню</a> / <a href='admin.php?page=yes&page_add=yes' class='blue1'>Создание нового пункта</a> / Сохранение";}
if ($page_edit==="yes") {$razdel="<a href='admin.php?page=yes&page_show=yes' class='blue1'>Редактирование меню</a> / Редактирование пункта меню";}
if ($page_edit_vis==="yes") {$razdel="<a href='admin.php?page=yes&page_show=yes' class='blue1'>Редактирование меню</a> / <a href='admin.php?page=yes&page_edit=yes' class='blue1'>Редактирование пункта меню</a> / Визульный редактор";}
if ($page_edit_ok==="yes") {$razdel="<a href='admin.php?page=yes&page_show=yes' class='blue1'>Редактирование меню</a> / <a href='admin.php?page=yes&page_edit=yes' class='blue1'>Редактирование пункта меню</a> / Сохранение";}
if ($page_del_all==="yes") {$razdel="<a href='admin.php?page=yes&page_show=yes' class='blue1'>Редактирование меню</a> / Удаление пунктов меню";}
if ($page_sort_razd==="yes") {$razdel="<a href='admin.php?page=yes&page_show=yes' class='blue1'>Редактирование меню</a> / Сортировка разделов";}
if ($page_sort_razd_ok==="yes") {$razdel="<a href='admin.php?page=yes&page_show=yes' class='blue1'>Редактирование меню</a> / <a href='admin.php?page=yes&page_sort_razd=yes' class='blue1'>Сортировка разделов</a> / Сохранение";}
if ($page_sort_podrazd==="yes") {$razdel="<a href='admin.php?page=yes&page_show=yes' class='blue1'>Редактирование меню</a> / Сортировка подразделов";}
if ($page_sort_podrazd_ok==="yes") {$razdel="<a href='admin.php?page=yes&page_show=yes' class='blue1'>Редактирование меню</a> / <a href='admin.php?page=yes&page_sort_podrazd=yes' class='blue1'>Сортировка подразделов</a> / Сохранение";}
//конец блока страниц

//блок рассылки
if (isset($_GET['mails'])) $mails=$_GET['mails']; else $mails="";
if (isset($_POST['mails_post'])) $mails_post=$_POST['mails_post']; else $mails_post="";
if (empty($mails) && ($mails_post==="yes")){$mails="yes";}
if ($mails==="yes")
{
if (isset($_GET['mails_show'])) $mails_show=$_GET['mails_show']; else $mails_show="";
if (isset($_GET['mails_add'])) $mails_add=$_GET['mails_add']; else $mails_add="";
if (isset($_POST['mails_add_post'])) $mails_add_post=$_POST['mails_add_post']; else $mails_add_post="";
if (empty($mails_add) && ($mails_add_post==="yes")){$mails_add="yes";}
if (isset($_POST['mails_add_vis'])) $mails_add_vis=$_POST['mails_add_vis']; else $mails_add_vis="";
if (isset($_POST['mails_add_ok'])) $mails_add_ok=$_POST['mails_add_ok']; else $mails_add_ok="";
if (isset($_GET['mails_conf'])) $mails_conf=$_GET['mails_conf']; else $mails_conf="";
if (isset($_POST['mails_conf_ok'])) $mails_conf_ok=$_POST['mails_conf_ok']; else $mails_conf_ok="";
if (isset($_GET['mails_edit'])) $mails_edit=$_GET['mails_edit']; else $mails_edit="";
if (isset($_POST['mails_edit_post'])) $mails_edit_post=$_POST['mails_edit_post']; else $mails_edit_post="";
if (empty($mails_edit) && ($mails_edit_post==="yes")){$mails_edit="yes";}
if (isset($_POST['mails_edit_vis'])) $mails_edit_vis=$_POST['mails_edit_vis']; else $mails_edit_vis="";
if (isset($_POST['mails_edit_ok'])) $mails_edit_ok=$_POST['mails_edit_ok']; else $mails_edit_ok="";
if (isset($_GET['mails_del'])) $mails_del=$_GET['mails_del']; else $mails_del="";
if (isset($_POST['mails_del_all'])) $mails_del_all=$_POST['mails_del_all']; else $mails_del_all="";
if (isset($_GET['mails_user_show'])) $mails_user_show=$_GET['mails_user_show']; else $mails_user_show="";
if (isset($_GET['mails_user_add'])) $mails_user_add=$_GET['mails_user_add']; else $mails_user_add="";
if (isset($_POST['mails_user_add_ok'])) $mails_user_add_ok=$_POST['mails_user_add_ok']; else $mails_user_add_ok="";
if (isset($_GET['mails_user_edit'])) $mails_user_edit=$_GET['mails_user_edit']; else $mails_user_edit="";
if (isset($_POST['mails_user_edit_ok'])) $mails_user_edit_ok=$_POST['mails_user_edit_ok']; else $mails_user_edit_ok="";
if (isset($_GET['mails_user_del'])) $mails_user_del=$_GET['mails_user_del']; else $mails_user_del="";
if (isset($_POST['mails_user_del_all'])) $mails_user_del_all=$_POST['mails_user_del_all']; else $mails_user_del_all="";
if (isset($_GET['mails_sends'])) $mails_sends=$_GET['mails_sends']; else $mails_sends="";
if (isset($_POST['mails_sends_ok'])) $mails_sends_ok=$_POST['mails_sends_ok']; else $mails_sends_ok="";
//что пишем в разделе
if ($mails_show==="yes") {$razdel="Просмотр и редактирование рассылок";}
if ($mails_sends==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / Предварительный просмотр рассылки";}
if ($mails_sends_ok==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / Предварительный просмотр рассылки / Отправка рассылки";}
if ($mails_add==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / Добавление новой рассылки";}
if ($mails_add_vis==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / <a href='javascript:history.back(1)' class='blue1'>Добавление новой рассылки</a> / Визуальный редактор";}
if ($mails_add_ok==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / <a href='javascript:history.back(1)' class='blue1'>Добавление новой рассылки</a> / Сохранение";}
if ($mails_conf==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / Настройка рассылки";}
if ($mails_conf_ok==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / <a href='javascript:history.back(1)' class='blue1'>Настройка рассылки</a> / Сохранение";}
if ($mails_edit==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / Редактирование рассылки";}
if ($mails_user_show==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / Просмотр подписчиков";}
if ($mails_user_add==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / <a href='javascript:history.back(1)' class='blue1'>Просмотр подписчиков</a> / Добавление";}
if ($mails_user_add_ok==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / <a href='admin.php?mails=yes&mails_user_show=yes' class=blue1>Просмотр подписчиков</a> / <a href='javascript:history.back(1)' class='blue1'>Добавление</a> / Сохранение";}
if ($mails_user_edit==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / <a href='javascript:history.back(1)' class='blue1'>Просмотр подписчиков</a> / Редактирование";}
if ($mails_user_edit_ok==="yes") {$razdel="<a href='admin.php?mails=yes&mails_show=yes' class='blue1'>Просмотр и редактирование рассылок</a> / <a href='admin.php?mails=yes&mails_user_show=yes' class=blue1>Просмотр подписчиков</a> / <a href='javascript:history.back(1)' class='blue1'>Редактирование</a> / Сохранение";}
}
//конец блока рассылки

//блок новости
$news="";$news=$_GET['news'];
$news_post="";$news_post=$_POST['news_post'];
if ((empty($news)) and ($news_post==="yes")) {$news="yes";}
if ($news==="yes")
{
$news_show="";$news_show=$_GET['news_show'];
$news_del="";$news_del=$_GET['news_del'];
$news_del_all="";$news_del_all=$_POST['news_del_all'];
$news_add_vis="";$news_add_vis=$_POST['news_add_vis'];
$news_edit_vis="";$news_edit_vis=$_POST['news_edit_vis'];
$news_add="";$news_add=$_GET['news_add'];
$news_add_post="";$news_add_post=$_POST['news_add_post'];
$news_add_ok="";$news_add_ok=$_POST['news_add_ok'];
$news_edit_ok="";$news_edit_ok=$_POST['news_edit_ok'];
if ((empty($news_add)) and ($news_add_post==="yes")) {$news_add="yes";}
$news_edit="";$news_edit=$_GET['news_edit'];
$news_edit_post="";$news_edit_post=$_POST['news_edit_post'];
if ((empty($news_edit)) and ($news_edit_post==="yes")) {$news_edit="yes";}
//что пишем в разделе
if ($news_show==="yes") {$razdel="Новости";}
if ($news_add==="yes") {$razdel="<a href='admin.php?news=yes&news_show=yes' class='blue1'>Новости</a> / Добавление новости";}
if ($news_add_vis==="yes") {$razdel="<a href='admin.php?news=yes&news_show=yes' class='blue1'>Новости</a> / <a href='admin.php?news=yes&news_add=yes' class='blue1'>Добавление новости</a> / Визульный редактор";}
if (($news_add_ok==="yes") or ($news_edit_ok==="yes")) {$razdel="<a href='admin.php?news=yes&news_show=yes' class='blue1'>Новости</a> / Сохранение новости";}
if ($news_edit==="yes") {$razdel="<a href='admin.php?news=yes&news_show=yes' class='blue1'>Новости</a> / Редактирование новости";}
if ($news_edit_vis==="yes") {$razdel="<a href='admin.php?news=yes&news_show=yes' class='blue1'>Новости</a> / <a href='admin.php?news=yes&news_edit=yes' class='blue1'>Редактирование новости</a> / Визульный редактор";}
if ($news_del_all==="yes") {$razdel="<a href='admin.php?news=yes&news_show=yes' class='blue1'>Новости</a> / Удаление новостей";}
}
//конец блока новостей

//блок статей
$article="";$article=$_GET['article'];
$article_post="";$article_post=$_POST['article_post'];
if ((empty($article)) and ($article_post==="yes")) {$article="yes";}
$article_show="";$article_show=$_GET['article_show'];
$article_del="";$article_del=$_GET['article_del'];
$article_del_all="";$article_del_all=$_POST['article_del_all'];
$article_add_vis="";$article_add_vis=$_POST['article_add_vis'];
$article_edit_vis="";$article_edit_vis=$_POST['article_edit_vis'];
$article_add="";$article_add=$_GET['article_add'];
$article_add_post="";$article_add_post=$_POST['article_add_post'];
$article_add_ok="";$article_add_ok=$_POST['article_add_ok'];
$article_edit_ok="";$article_edit_ok=$_POST['article_edit_ok'];
if ((empty($article_add)) and ($article_add_post==="yes")) {$article_add="yes";}
$article_edit="";$article_edit=$_GET['article_edit'];
$article_edit_post="";$article_edit_post=$_POST['article_edit_post'];
if ((empty($article_edit)) and ($article_edit_post==="yes")) {$article_edit="yes";}
//что пишем в разделе
if ($article_show==="yes") {$razdel="Статьи";}
if ($article_add==="yes") {$razdel="<a href='admin.php?article=yes&article_show=yes' class='blue1'>Статьи</a> / Добавление статьи";}
if ($article_add_vis==="yes") {$razdel="<a href='admin.php?article=yes&article_show=yes' class='blue1'>Статьи</a> / <a href='admin.php?article=yes&article_add=yes' class='blue1'>Добавление статьи</a> / Визульный редактор";}
if (($article_add_ok==="yes") or ($article_edit_ok==="yes")) {$razdel="<a href='admin.php?article=yes&article_show=yes' class='blue1'>Статьи</a> / Сохранение статьи";}
if ($article_edit==="yes") {$razdel="<a href='admin.php?article=yes&article_show=yes' class='blue1'>Статьи</a> / Редактирование статьи";}
if ($article_edit_vis==="yes") {$razdel="<a href='admin.php?article=yes&article_show=yes' class='blue1'>Статьи</a> / <a href='admin.php?article=yes&article_edit=yes' class='blue1'>Редактирование статьи</a> / Визульный редактор";}
if ($article_del_all==="yes") {$razdel="<a href='admin.php?article=yes&article_show=yes' class='blue1'>Статьи</a> / Удаление новостей";}
//конец блока статей

//блок констант
$my=mysql_query("SELECT * FROM `admins_user` WHERE LOGIN='$login';");
$main=mysql_fetch_array($my);
if ($main['const']==1)
{
$consts="";$consts=$_GET['consts'];
$consts_post="";$consts_post=$_POST['consts_post'];
if (empty($consts)) {$consts=$consts_post;}
$consts_show="";$consts_show=$_GET['consts_show'];
$consts_save="";$consts_save=$_POST['consts_save'];
//что пишем в разделе
if ($consts_show==="yes") {$razdel="Константы";}
if ($consts_save==="yes") {$razdel="<a href='admin.php?consts=yes&consts_show=yes' class=blue1>Константы</a> / Сохранение констант";}
}
//конец блока констант

require "humor/peremen.php";
?>