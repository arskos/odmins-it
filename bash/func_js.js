function createXMLHttp()
{
   if(typeof XMLHttpRequest != "undefined")
   {
		return new XMLHttpRequest();
   }
   else if(window.ActiveXObject)
   {
		var aVersions = ["MSXML2.XMLHttp.5.0", "MSXML2.XMLHttp.4.0",
		"MSXML2.XMLHttp.3.0", "MSXML2.XMLHttp",
		"Microsoft.XMLHttp"
         ];
		for (var i = 0; i < aVersions.length; i++)
		{
			try
			{
				var oXmlHttp = new ActiveXObject(aVersions[i])
				return oXmlHttp;
			}
			catch (oError)
			{
			}
		}
		throw new Error("Невозможно создать объект XMLHttp.");
   }
}


function getCookie(name) {
	    var matches = document.cookie.match(new RegExp(
	      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	    ))
	    return matches ? decodeURIComponent(matches[1]) : undefined 
}
	 
	// уcтанавливает cookie
function setCookie(name, value, props) {
    props = props || {}
    var exp = props.expires
    if (typeof exp == "number" && exp) {
        var d = new Date()
        d.setTime(d.getTime() + exp*1000)
        exp = props.expires = d
    }
    if(exp && exp.toUTCString) { props.expires = exp.toUTCString() }
  value = encodeURIComponent(value)
    var updatedCookie = name + "=" + value
    for(var propName in props){
        updatedCookie += "; " + propName
        var propValue = props[propName]
        if(propValue !== true){ updatedCookie += "=" + propValue }
    }
    document.cookie = updatedCookie
 
}
 
// удаляет cookie
function deleteCookie(name) {
    setCookie(name, null, { expires: -1 })
}
function array2json(arr) { 
    var parts = []; 
    var is_list = (Object.prototype.toString.apply(arr) === '[object Array]'); 
for(var key in arr) { 
        var value = arr[key]; 
        if(typeof value == "object") { //Custom handling for arrays 
            if(is_list) parts.push(array2json(value)); /* :RECURSION: */
            else parts[key] = array2json(value); /* :RECURSION: */
        } else { 
            var str = ""; 
            if(!is_list) str = '"' + key + '":'; 
            //Custom handling for multiple data types 
            if(typeof value == "number") str += value; //Numbers 
            else if(value === false) str += 'false'; //The booleans 
            else if(value === true) str += 'true'; 
            else str += '"' + value + '"'; //All other things 
            // :TODO: Is there any more datatype we should be in the lookout for? (Functions?) 
  
            parts.push(str); 
        } 
    } 
    var json = parts.join(","); 
      
    if(is_list) return '[' + json + ']';//Return numerical JSON 
    return '{' + json + '}';//Return associative JSON 
}

//simple autocomplete
var sug = "";
var sug_disp = "";

function getAutoText(element,arr) {
  var input = element;
  var len = input.length;
  sug_disp = ""; sug = "";
  
  

  if (input.length) {

    for (ele in arr)
    {
      if (arr[ele].substr(0,len).toLowerCase() == input.toLowerCase())
      {
        sug_disp = input + arr[ele].substr(len);
        sug = arr[ele];
		break;
      }
    }
  }
  return sug_disp;
}


