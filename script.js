// JavaScript Document
function checkData()  {
  var re1 = /^([\w\-\_]+\.)*[\w\-\_]+@([\w-]+\.)+[A-Za-z]{2,4}$/i;
  var re2 = /^[\d\-\ \.]+$/i;
  if (document.send_mes.tname.value == "") {
        alert('����������, ������� ���'); return false
  }
  if (document.send_mes.temail.value == "") {
        alert('����������, ������� email'); return false
  }
  if (!re1.test(document.send_mes.temail.value) && document.send_mes.temail.value != "") {
        alert('������� ���������� email'); return false
  }
  if (document.send_mes.ttxt.value == "") {
        alert('����������, ������� ����� ������'); return false
  }
   if (document.send_mes.tt_pass.value == "") {
        alert('����������, ������� ������� �� ��������'); return false
  }
   return true;
}
function checkData2()  {
  var re1 = /^([\w\-\_]+\.)*[\w\-\_]+@([\w-]+\.)+[A-Za-z]{2,4}$/i;
  var re2 = /^[\d\-\ \.]+$/i;
  if (document.send_mes.tname.value == "") {
        alert('����������, ������� ���'); return false
  }
  if (document.send_mes.temail.value == "") {
        alert('����������, ������� email'); return false
  }
  if (!re1.test(document.send_mes.temail.value) && document.send_mes.temail.value != "") {
        alert('������� ���������� email'); return false
  }
  if (document.send_mes.ttema.value == "") {
        alert('����������, ������� ���� ������'); return false
  }
  if (document.send_mes.tanons.value == "") {
        alert('����������, ������� ����� ������'); return false
  }
  if (document.send_mes.ttxt.value == "") {
        alert('����������, ������� ����� ������'); return false
  }
   if (document.send_mes.tt_pass.value == "") {
        alert('����������, ������� ������� �� ��������'); return false
  }
   return true;
}