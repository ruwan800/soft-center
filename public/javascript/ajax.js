//function (){ getElementById("button1").hide(); }
//$("#button1").hide();
//$("#button2").hide();

var textF="";
var count=0;

function showMore(){
    count+=20;
    getXML();
}

function loadXMLDoc(){

	count=0;
	textF=document.getElementById('pkg').value;
	getXML()

}

function getXML(){

	ProcessXML("http://localhost/softcenter/softcenter/sc.php?action=ps&pkg="+textF+"&lm="+count);

}

function resultHandler(){
    pkgNameArray = xmlRoot.getElementsByTagName("name");
    pkgDescArray = xmlRoot.getElementsByTagName("description");
    viewResult(0);
}

           
function viewResult(){
    var resultSet = "";
    for (var i=0; i<pkgNameArray.length; i++){
            resultSet +=modResult(i);
    }
    if(count>0){
		oldResultSet = oldResultSet+resultSet;
    }
    else{
    	oldResultSet = resultSet;
    }
    document.getElementById("pkgviewResultSet").innerHTML=oldResultSet;
    if(pkgNameArray.length == 20){
    	buttonText = "<div id='moreResultsButton'>"+
    				 "<button onclick='showMore()'>More Results >></button></div>";
    	document.getElementById("moreResults").innerHTML = buttonText;
    }
    else{
    	document.getElementById("moreResults").innerHTML = "";
    }
}

function modResult(i){
    text = "<div id='pkgViewMainResult'><div id='pkgViewMainResultContent'><div id='pkgViewMainResultName'>"+
    pkgNameArray.item(i).firstChild.data + 
    "</div><div id='pkgViewMainResultDescription'>"+
    pkgDescArray.item(i).firstChild.data +
    "</div></div><div id='pkgViewMainResultButton'>"+
    "<button type='button' onclick='moreInfo("+
    pkgNameArray.item(i).firstChild.data + 
    ")'>More info >></button>"+
    "</div></div>"
    return text;
}

function searchPakages(){
	msgText="<div id='searchbar'>Search Software</div>"+
	"<div id='searchbox'><input type='text' id='pkg'/>"+
	"<button id='searchButton' onclick='loadXMLDoc()'></button></div>"
//	"<div id='searchimg'><!-- <img src='images/loader.gif'/> -->"+
	"</div></div>";
	notify(msgText);
}

function loginPage(){

	ProcessXML("http://localhost/softcenter/softcenter/sc.php?action=login");

}
