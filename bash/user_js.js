//������� �������������
var hist=[];
var last,count;
var commands=new Array("help","site","humor","article","news","bgcolor","font","size","history_erase","ver","forum","about","clear");
var d_amp=false;
var tstr="";

function out(str){
if (d_amp){
document.getElementById("bash_output").innerHTML+=str+"<br>";d_amp=false;}
else
{document.getElementById("bash_output").innerHTML=str;}
}

//������ ������� �� ���
if (getCookie("hist")!=undefined)	{
hist=eval("("+getCookie("hist")+")");
last=hist.length;
count=last-1;
}

function bash (values, keys)
{
	if (values!="" && keys==13)
	{
		
		//��������� �������
		//history(com[0]);
		
		com=values.split(" ");
		switch (com[0])
		{
			case 'help':
				help_txt="���������� ����������:<br>";
				help_txt+="�������� ������� � -help, ����� ����������� � ������� � ��������� �������<br>";
				help_txt+="������ ����������� �� ������ ������ ������<br>";
				help_txt+="<b>site</b> - ��������� �� �����<br>";
				help_txt+="<b>humor</b> - �������� odmins-it<br>";
				help_txt+="<b>article</b> - ������<br>";
				help_txt+="<b>news</b> - �������<br>";
				help_txt+="<b>forum</b> - ������� �� ����� odmins-it<br>";
				help_txt+="<b>clear</b> - ������� ������<br>";
				help_txt+="<b>size</b> - ��������� ������� ������, ������ size 24<br>";
				help_txt+="<b>font</b> - ��������� ����� ������, ���� �������� 6-�� ������� ������, ��� �����������, ��� ������ ����� � 16-������ ������� ������ �������������� ���������� �����, ������ font 000000, font a00<br>";
				help_txt+="<b>bgcolor</b> - ��������� ����� ����, ���� �������� 6-�� ������� ������, ��� �����������, ��� ������ ����� � 16-������ ������� ������ �������������� ���������� �����, ������ bgcolor 000000, bgcolor a00<br>";
				help_txt+="<b>history_erase</b> - ������� ������ �������<br>";
				help_txt+="<b>&&</b> - ��������� ������� ���������������. ������� ����� �� ����, ����� ������. ������: help && about<br>";
				help_txt+="<b>about</b> - �� ���� � �������������<br>";
				help_txt+="<b>ver</b> - ������<br>";
				
				out(help_txt)
				break;
			case "site":
				if (com[1]!==undefined)
				{
					bashes("site",com[1]);
				}
				else	
					 out("�� ���������� ������ �������<br>�������� ������� � ������ -help ��� ��������� ������� �� ������");
				break;
			case "humor":
				if (com[1]!==undefined)
				{
					bashes("humor",com[1]);
				}
				else	
					out("�� ���������� ������ �������<br>�������� ������� � ������ -help ��� ��������� ������� �� ������");
				break;
			case "article":
				if (com[1]!==undefined)
				{
					bashes("article",com[1]);
				}
				else	
					out("�� ���������� ������ �������<br>�������� ������� � ������ -help ��� ��������� ������� �� ������");
				break;
			case "news":
				if (com[1]!==undefined)
				{
					bashes("news",com[1]);
				}
				else	
					out("�� ���������� ������ �������<br>�������� ������� � ������ -help ��� ��������� ������� �� ������");
				break;

			case "bgcolor":
				if (com[1]!==undefined)
					{
						setupColor('bgcolor',com[1]);
						setCookie("bgcolor",com[1],{expires:946080000});
					}
					else	
						out("�� ���������� ������ �������<br>�������� ������� � ������ -help ��� ��������� ������� �� ������");
				break;
			case "font":
				if (com[1]!==undefined)
					{
						setupColor('fontcolor',com[1]);
						setCookie("fontcolor",com[1],{expires:946080000});
					}
					else	
						out("�� ���������� ������ �������<br>�������� ������� � ������ -help ��� ��������� ������� �� ������");
				break;
			case "size":
				if (com[1]!==undefined)
					{
						setupColor('fontsize',com[1]);
						setCookie("fontsize",com[1],{expires:946080000});
					}
					else	
						out("�� ���������� ������ �������<br>�������� ������� � ������ -help ��� ��������� ������� �� ������");
				break;
			case "history_erase":
				deleteCookie("hist");hist=[];
				break;

			case 'forum':
				parent.window.open("http://forum.odmins-it.ru/","_blank");
				break;
			case 'ver':
				out("������ 1.1");
				break;
			case 'about':
			//��� ���� ������)
				help_txt="�� ����:<br>";
				help_txt+="��� ��������� ������ ����� odmins-it.ru<br>";
				help_txt+="������ ����-������� - <b>bez_nika</b> & <b>ormaturi</b><br>";
				help_txt+="js ������ - <b>Jedi</b> & <b>arskos</b><br>";
				help_txt+="php ������ - <b>arskos</b><br>";
				help_txt+="���� - <b>arskos</b><br>";
				help_txt+="(�) <b>odmins-it</b><br>";
				out(help_txt);
				break;
			case 'clear':
				out("");
				break;
			default:
				out("��� ����� �������");
		}
		tstr=values;
		if (values.indexOf("&&",0)!=-1){
		
		d_amp=true;
		tstr=values.substr(tstr.indexOf("&&",0)+3,tstr.length);
		document.getElementById("bash_output").innerHTML+="<br><br><b>"+tstr.substr(0,(tstr.indexOf("&&",0)==-1?values.length:tstr.indexOf("&&",0)))+"&gt;&nbsp;</b>";
		bash(values.substr(values.indexOf("&&",0)+3,values.length),13);
		
		
		}
		else
		{
		d_amp=false;
		}
		
		
		document.getElementById("bash_input").value = "";
	}
	
	
	
	
	window.scroll(0,document.body.clientHeight+50);//���� ����� �� ���������-��� ������ ����������� ���������, ���� ������ ���������, ������� �� �����
	document.getElementById("bash_input").focus();
	
	if (values!="" && keys==9){
	
	document.getElementById("bash_input").value=getAutoText(values.substr(values.indexOf("&&",0)+3,values.length),commands);
	
	
	
	}
	
	
	
}

function history(keys_,values){
if (values!="" && keys_.keyCode==13)
	{
		//��������� �������
		hist.push(values);//���������� � ������ �������
		setCookie("hist",array2json(hist),{expires:946080000});//��������� ������ � �����
		last=hist.length;
		count=last-1;
		if (last>10) {hist.shift();}//���� ������ ������ 10-���������� ������ �� �������
}		
	
	if (keys_.keyCode==38 && keys_.which==0){
		count-=1;
		if (count>0) {
		if (hist[count]!=undefined){
		document.getElementById("bash_input").value=hist[count];}
		}
		else {count=0;
		if (hist[count]!=undefined){
		document.getElementById("bash_input").value=hist[count];}
		}
	}
	if (keys_.keyCode==40 && keys_.which==0){
		count+=1;
		if (count<=last-1) {
		if (hist[count]!=undefined){
		document.getElementById("bash_input").value=hist[count];}
		}
		else {count=last-1;
		if (hist[count]!=undefined){
		document.getElementById("bash_input").value=hist[count];}
		}
	}
}