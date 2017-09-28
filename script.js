// JavaScript Document
function checkData()  {
  var re1 = /^([\w\-\_]+\.)*[\w\-\_]+@([\w-]+\.)+[A-Za-z]{2,4}$/i;
  var re2 = /^[\d\-\ \.]+$/i;
  if (document.send_mes.tname.value == "") {
        alert('Пожалуйста, введите ФИО'); return false
  }
  if (document.send_mes.temail.value == "") {
        alert('Пожалуйста, введите email'); return false
  }
  if (!re1.test(document.send_mes.temail.value) && document.send_mes.temail.value != "") {
        alert('Введите корректный email'); return false
  }
  if (document.send_mes.ttxt.value == "") {
        alert('Пожалуйста, введите текст письма'); return false
  }
   if (document.send_mes.tt_pass.value == "") {
        alert('Пожалуйста, введите символы на картинке'); return false
  }
   return true;
}
function checkData2()  {
  var re1 = /^([\w\-\_]+\.)*[\w\-\_]+@([\w-]+\.)+[A-Za-z]{2,4}$/i;
  var re2 = /^[\d\-\ \.]+$/i;
  if (document.send_mes.tname.value == "") {
        alert('Пожалуйста, введите ФИО'); return false
  }
  if (document.send_mes.temail.value == "") {
        alert('Пожалуйста, введите email'); return false
  }
  if (!re1.test(document.send_mes.temail.value) && document.send_mes.temail.value != "") {
        alert('Введите корректный email'); return false
  }
  if (document.send_mes.ttema.value == "") {
        alert('Пожалуйста, введите тему статьи'); return false
  }
  if (document.send_mes.tanons.value == "") {
        alert('Пожалуйста, введите анонс статьи'); return false
  }
  if (document.send_mes.ttxt.value == "") {
        alert('Пожалуйста, введите текст статьи'); return false
  }
   if (document.send_mes.tt_pass.value == "") {
        alert('Пожалуйста, введите символы на картинке'); return false
  }
   return true;
}