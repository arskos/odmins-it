var m=0; 
function F(x){ 
var e=x.elements; for(i=0; i<e.length; i++){if(e[i].type=='checkbox') e[i].checked=(m==0) ? true : false} 
m=(m==0) ? 1 : 0}
function mag(tx){ 
document.getElementById("asd").innerHTML = tx;
}
function mag1(tx){ 
document.getElementById("asd1").innerHTML = tx;
}
function htmlspecialchars(html) { 
      // ������� ���������� �������� & 
      html = html.replace(/&/g, "&amp;"); 
      // � ����� �� ��������� � ����� ������������������ 
      html = html.replace(/</g, "&lt;"); 
      html = html.replace(/>/g, "&gt;"); 
      html = html.replace(/"/g, "&quot;"); 
      // ���������� ���������� �������� 
      return html; 
}
function up_mag_n(tx){
tx="index.php?page_up="+tx;
document.getElementById("up_page_ssylka").innerHTML = htmlspecialchars(tx);
ads_up_page.up_page_ssylka.value = tx;
}
function validate(field) {
var valid = "0123456789"
var ok = "yes";
var temp;
for (var i=0; i<field.value.length; i++) {
temp = "" + field.value.substring(i, i+1);
if (valid.indexOf(temp) == "-1") ok = "no";
}
if (field.value.length==0){
alert("���� ������ ���� ���������");
field.focus();
field.select();
}
if (ok == "no") {
alert("���������� ������� ������ �����");
field.focus();
field.select();
}
}
function name_fold(field) {
var valid = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM_.1234567890"
var ok = "yes";
var temp;
for (var i=0; i<field.value.length; i++) {
temp = "" + field.value.substring(i, i+1);
if (valid.indexOf(temp) == "-1") ok = "no";
}
if (field.value.length==0){
alert("���� ������ ���� ���������");
field.focus();
field.select();
}
if (ok == "no") {
alert("���������� ������� ������ ����� ����������� �������� ��� ����� � ���� �������������");
field.focus();
field.select();
}
}
function sel_all(theField)
{
theField.select();
}
function if_null(theField)
{
n=theField.value.length;
if (n==0)
{
alert("�� ����� �������� ���� ������");
theField.focus();
theField.select();
}
}
function mag_form(){
document.news_add_save.days.value=document.news_add.news_day.value;
document.news_add_save.mounth.value=document.news_add.news_mounth.value;
document.news_add_save.years.value=document.news_add.news_year.value;
document.news_add_save.news_anons.value=document.news_add.news_anons.value;
document.news_add_save.news_full.value=document.news_add.text_edit.value;
}

//�������� ���������� �������
function querys_page(){
if (confirm("�������, ��� ������ ������� ��������� �������/����������?")) {
    document.page_show.submit();
    }
}
//�������� ���������� �������������
function querys_user(){
if (confirm("�������, ��� ������ ������� ��������� �������������?")) {
    document.user_show.submit();
    }
}
//�������� ���������� ��������
function querys_mails(){
if (confirm("�������, ��� ������ ������� ��������� ��������?")) {
    document.mails_show.submit();
    }
}
//�������� ���������� ������������� ��������
function querys_mails_user(){
if (confirm("�������, ��� ������ ������� ��������� ������������� ��������?")) {
    document.mails_user_show.submit();
    }
}
//�������� ���������� ��������
function querys_news(){
if (confirm("�������, ��� ������ ������� ��������� �������?")) {
    document.news_show.submit();
    }
}
//�������� ���������� ������
function querys_article(){
if (confirm("�������, ��� ������ ������� ��������� ������?")) {
    document.article_show.submit();
    }
}
//�������� ���������� �����
function querys_humor(){
if (confirm("�������, ��� ������ ������� ��������� ������?")) {
    document.humor_show.submit();
    }
}
//�������� ������ �������
function answer_page_razdel(id){
if (confirm("��� ���������� ������� ������� ����� �������. �������, ��� ������ ������� ������ ������?"))
window.location.href = "admin.php?page=yes&page_del_razdel=yes&ids="+id;
}
//�������� ������� �������
function answer_news(id){
if (confirm("�������, ��� ������ ������� ������ �������?"))
window.location.href = "admin.php?news=yes&news_del=yes&ids="+id;
}
//�������� ������ ����������
function answer_page_podrazdel(id_r,id_p){
if (confirm("�������, ��� ������ ������� ������ ���������?"))
window.location.href = "admin.php?page=yes&page_del_podrazdel=yes&ids_razdel="+id_r+"&ids_podrazdel="+id_p;
}
//�������� ������ �����
function answer_user(id){
if (confirm("�������, ��� ������ ������� ������� ������������?"))
window.location.href = "admin.php?user=yes&user_del=yes&ids="+id;
}
//�������� ����� ��������
function answer_mails(id){
if (confirm("�������, ��� ������ ������� ������ ��������?"))
window.location.href = "admin.php?mails=yes&mails_del=yes&ids="+id;
}
//�������� ������ ������������ ��������
function answer_mails_user(id){
if (confirm("�������, ��� ������ ������� ������� ������������ ��������?"))
window.location.href = "admin.php?mails=yes&mails_user_del=yes&ids="+id;
}
//�������� ����� ������
function answer_article(id){
if (confirm("�������, ��� ������ ������� ������ ������?"))
window.location.href = "admin.php?article=yes&article_del=yes&ids="+id;
}
//�������� ����� ������
function answer_humor(id){
if (confirm("�������, ��� ������ ������� ������ ������?"))
window.location.href = "admin.php?humor=yes&humor_del=yes&ids="+id;
}
function mails_mag(){
document.mails_add_save.days.value=document.mails_add.mails_day.value;
document.mails_add_save.mounth.value=document.mails_add.mails_mounth.value;
document.mails_add_save.years.value=document.mails_add.mails_year.value;
document.mails_add_save.mails_title.value=document.mails_add.mails_title.value;
document.mails_add_save.mails_full.value=document.mails_add.text_edit.value;
}
function humor_mag(){
document.humor_add_save.days.value=document.humor_add.humor_day.value;
document.humor_add_save.mounth.value=document.humor_add.humor_mounth.value;
document.humor_add_save.years.value=document.humor_add.humor_year.value;
document.humor_add_save.humor_full.value=document.humor_add.text_edit.value;
document.humor_add_save.status.value=document.humor_add.humor_status.value;
}
function user_click() {
alert ('sdf');
if (document.user_add.pages_c.checked)document.user_add.user_pages.value=1; else document.user_add.user_pages.value=0;
if (document.user_add.page_c.checked)document.user_add.user_page.value=1; else document.user_add.user_page.value=0;
if (document.user_add.news_c.checked)document.user_add.user_news.value=1; else document.user_add.user_news.value=0;
if (document.user_add.vpage_c.checked)document.user_add.user_vpage.value=1; else document.user_add.user_vpage.value=0;
if (document.user_add.cons_c.checked)document.user_add.user_cons.value=1; else document.user_add.user_cons.value=0;
if (document.user_add.article_c.checked)document.user_add.user_article.value=1; else document.user_add.user_article.value=0;
if (document.user_add.humor_c.checked)document.user_add.user_humor.value=1; else document.user_add.user_humor.value=0;
}
function article_check() {
if (document.article_add.status.checked)document.article_add.article_status.value=1; else document.article_add.article_status.value=0;
}
function humor_check() {
if (document.humor_add.status.checked)document.humor_add.humor_status.value=1; else document.humor_add.humor_status.value=0;
}
function file_up(){
window.location.reload();
}
