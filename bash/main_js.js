
function displayLeftMenu(sText) 
{
	//var arra=sText.split(",,,,,");
	out(sText);
	window.scroll(0,document.body.clientHeight+50);
//alert (sText);
}

function setupColor(name,value){
	if (name=='bgcolor'){
		parent.document.body.style.backgroundColor = "#"+value;
		document.body.style.backgroundColor = "#"+value;
		document.getElementById("bash_input").style.backgroundColor="#"+value;
	}
	if (name=='fontcolor'){
		parent.document.body.style.color = "#"+value;
		document.body.style.color = "#"+value;
		document.getElementById("bash_input").style.color="#"+value;
	}
	if (name=='fontsize'){
		parent.document.body.style.fontSize = value+"px";
		document.body.style.fontSize = value+"px";
		document.getElementById("bash_input").style.fontSize=value+"px";
	}
}

function getSettings(){
	if (getCookie("bgcolor")!=undefined)	{
	setupColor('bgcolor',getCookie("bgcolor"));
	}
	if (getCookie("fontcolor")!=undefined)	{
	setupColor('fontcolor',getCookie("fontcolor"));
	}
	if (getCookie("fontsize")!=undefined)	{
	setupColor('fontsize',getCookie("fontsize"));
	}
}



//функция показа меню слева
function bashes(com,key) 
{
	var oXmlHttp = createXMLHttp();
	//alert("/bash/"+com+".php?id="+key);
	oXmlHttp.open("GET","/bash/"+com+".php?id="+key,true);
	oXmlHttp.onreadystatechange = function() 
	{
		if(oXmlHttp.readyState == 4) 
		{
			if(oXmlHttp.status == 200) 
			{
			d_amp=true;
				displayLeftMenu(oXmlHttp.responseText);
			}
			else 
			{
			d_amp=true;
				displayLeftMenu("Ошибка: " + oXmlHttp.statusText);
			}
		}
	};
	oXmlHttp.send(null);
}