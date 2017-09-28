//немного инициализации
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

//грузим историю из кук
if (getCookie("hist")!=undefined)	{
hist=eval("("+getCookie("hist")+")");
last=hist.length;
count=last-1;
}

function bash (values, keys)
{
	if (values!="" && keys==13)
	{
		
		//разбираем команду
		//history(com[0]);
		
		com=values.split(" ");
		switch (com[0])
		{
			case 'help':
				help_txt="Справочная информация:<br>";
				help_txt+="Наберите команду и -help, чтобы ознакомится с ключами и действием команды<br>";
				help_txt+="Список сущетвующих на данный момент команд<br>";
				help_txt+="<b>site</b> - навигация по сайту<br>";
				help_txt+="<b>humor</b> - цитатник odmins-it<br>";
				help_txt+="<b>article</b> - статьи<br>";
				help_txt+="<b>news</b> - новости<br>";
				help_txt+="<b>forum</b> - переход на форум odmins-it<br>";
				help_txt+="<b>clear</b> - очистка экрана<br>";
				help_txt+="<b>size</b> - изменение размера шрифта, пример size 24<br>";
				help_txt+="<b>font</b> - изменение цвета шрифта, цвет задается 6-ти значным числом, или трехзначным, где каждая цифра в 16-ричном формате задает соответственно компоненту цвета, пример font 000000, font a00<br>";
				help_txt+="<b>bgcolor</b> - изменение цвета фона, цвет задается 6-ти значным числом, или трехзначным, где каждая цифра в 16-ричном формате задает соответственно компоненту цвета, пример bgcolor 000000, bgcolor a00<br>";
				help_txt+="<b>history_erase</b> - очистка списка истории<br>";
				help_txt+="<b>&&</b> - выполняет команды последовательно. Сначала слева от себя, затем справа. Пример: help && about<br>";
				help_txt+="<b>about</b> - об ЭТОМ и благодарности<br>";
				help_txt+="<b>ver</b> - версия<br>";
				
				out(help_txt)
				break;
			case "site":
				if (com[1]!==undefined)
				{
					bashes("site",com[1]);
				}
				else	
					 out("Не правильный формат команды<br>Наберите команду с ключом -help для просмотра справки по ключам");
				break;
			case "humor":
				if (com[1]!==undefined)
				{
					bashes("humor",com[1]);
				}
				else	
					out("Не правильный формат команды<br>Наберите команду с ключом -help для просмотра справки по ключам");
				break;
			case "article":
				if (com[1]!==undefined)
				{
					bashes("article",com[1]);
				}
				else	
					out("Не правильный формат команды<br>Наберите команду с ключом -help для просмотра справки по ключам");
				break;
			case "news":
				if (com[1]!==undefined)
				{
					bashes("news",com[1]);
				}
				else	
					out("Не правильный формат команды<br>Наберите команду с ключом -help для просмотра справки по ключам");
				break;

			case "bgcolor":
				if (com[1]!==undefined)
					{
						setupColor('bgcolor',com[1]);
						setCookie("bgcolor",com[1],{expires:946080000});
					}
					else	
						out("Не правильный формат команды<br>Наберите команду с ключом -help для просмотра справки по ключам");
				break;
			case "font":
				if (com[1]!==undefined)
					{
						setupColor('fontcolor',com[1]);
						setCookie("fontcolor",com[1],{expires:946080000});
					}
					else	
						out("Не правильный формат команды<br>Наберите команду с ключом -help для просмотра справки по ключам");
				break;
			case "size":
				if (com[1]!==undefined)
					{
						setupColor('fontsize',com[1]);
						setCookie("fontsize",com[1],{expires:946080000});
					}
					else	
						out("Не правильный формат команды<br>Наберите команду с ключом -help для просмотра справки по ключам");
				break;
			case "history_erase":
				deleteCookie("hist");hist=[];
				break;

			case 'forum':
				parent.window.open("http://forum.odmins-it.ru/","_blank");
				break;
			case 'ver':
				out("Версия 1.1");
				break;
			case 'about':
			//так кода меньше)
				help_txt="Об ЭТОМ:<br>";
				help_txt+="Это командная версия сайта odmins-it.ru<br>";
				help_txt+="Первые бета-тестеры - <b>bez_nika</b> & <b>ormaturi</b><br>";
				help_txt+="js кодинг - <b>Jedi</b> & <b>arskos</b><br>";
				help_txt+="php кодинг - <b>arskos</b><br>";
				help_txt+="идея - <b>arskos</b><br>";
				help_txt+="(с) <b>odmins-it</b><br>";
				out(help_txt);
				break;
			case 'clear':
				out("");
				break;
			default:
				out("Нет такой команды");
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
	
	
	
	
	window.scroll(0,document.body.clientHeight+50);//если здесь не поставить-при выводе стандартных сообщений, если окошко маленькое, скролла не будет
	document.getElementById("bash_input").focus();
	
	if (values!="" && keys==9){
	
	document.getElementById("bash_input").value=getAutoText(values.substr(values.indexOf("&&",0)+3,values.length),commands);
	
	
	
	}
	
	
	
}

function history(keys_,values){
if (values!="" && keys_.keyCode==13)
	{
		//разбираем команду
		hist.push(values);//запихиваем в массив команду
		setCookie("hist",array2json(hist),{expires:946080000});//сохраняем массив в куках
		last=hist.length;
		count=last-1;
		if (last>10) {hist.shift();}//если команд больше 10-выпихиваем первую из массива
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