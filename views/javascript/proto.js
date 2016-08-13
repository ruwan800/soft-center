
var obj;

function ProcessXML(url) {
	if (window.XMLHttpRequest) {				// native  object
		obj = new XMLHttpRequest();				// obtain new object
		obj.onreadystatechange = processChange;	// set the callback function
		obj.open("GET", url, true);				// we will do a GET with the url; "true" for asynch
		obj.send(null);							// null for GET with native object
	}else if (window.ActiveXObject){			// IE/Windows ActiveX object
		obj = new ActiveXObject("Microsoft.XMLHTTP");
		if (obj) {
			obj.onReadyStateChange = processChange;
			obj.open("GET", url, true);
			obj.send();							// don't send null for ActiveXObject
		}
	} else {
		notify("Your browser does not support AJAX");
	}
}


function processChange() {
    if (obj.readyState == 4) {					// 4 means the response has been returned and ready to be processed
        if (obj.status == 200) {				// 200 means "OK"
			try{		// process the response
				xmlResponse=obj.responseXML;
				xmlRoot = xmlResponse.documentElement;
				resultHandler();
			}catch(e){
				notify(e+"::proto-31");
			}
        } else {								// anything else means a problem
            notify("There was a problem in the returned data::proto-31");
        }
    }
}




function notify(msg){
	document.getElementById("notifier").style.height="60px";
	notifText="<div id='notifierBody'>"+msg+"</div>"+
				"<div id='notifierClose'><button onclick='notifyClear()'>x</button></div>";
    document.getElementById("notifier").innerHTML=notifText;
}

function notifyClear(msg){
	document.getElementById("notifier").innerHTML="";
	document.getElementById("notifier").style.height="0px"
}























/*
function AJAXRequest(targetLink){

    var xmlhttp;
	
			xmlHttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
            xmlResponse=xmlhttp.responseXML;
            try{
                xmlRoot = xmlResponse.documentElement;
            }catch(err){
                notify("Something went wrong;  :(");
            }
    xmlResponse=xmlhttp.responseXML;
    xmlRoot = xmlResponse.documentElement;
    pkgNameArray = xmlRoot.getElementsByTagName("name");
    pkgDescArray = xmlRoot.getElementsByTagName("description");
    pkgIDArray = xmlRoot.getElementsByTagName("soft_id");
    viewResult(0);
            
		}
        
    }
    xmlhttp.open("GET",targetLink,true);
    xmlhttp.send();
}



*/
