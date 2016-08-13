//function (){ getElementById("button1").hide(); }
//$("#button1").hide();
//$("#button2").hide();

var pkgset;
var count=0;
function showPrevious(){
    count--;
    viewResult(count);
}

function showCurrent(){
    viewResult(count);
}

function showMore(){
    count++;
    viewResult(count);
}

function loadXMLDoc(){

var text=document.getElementById('pkg').value;
ProcessXML("../models/pakage_search_2.php");
}

function resultHandler(){
    pkgNameArray = xmlRoot.getElementsByTagName("name");
    pkgDescArray = xmlRoot.getElementsByTagName("description");
    pkgIDArray = xmlRoot.getElementsByTagName("soft_id");
    viewResult(0);
}

           
function viewResult(count){
    var html = "";
    if(pkgNameArray.length<=10+10*count){
        document.getElementById("updown3").innerHTML="";
        for (var i=count*10; i<pkgNameArray.length; i++)
            html +=modResult(i);
    }
    else{
        document.getElementById("updown3").innerHTML="<button type='button' onclick='showMore()'>More </br>Results</button>";
        for (i=count*10; i<(10+10*count); i++)
            html +=modResult(i);
    }
    if(0<count)
        document.getElementById("updown1").innerHTML="<button type='button' onclick='showPrevious()'>Previous</br>Results</button>";
    else
        document.getElementById("updown1").innerHTML="";
    document.getElementById("pkgviewResultSet").innerHTML=html;
    document.getElementById("updown2").innerHTML="";
}

function modResult(i){
    text = "<div id='pkgViewMainResult'><div id='pkgViewMainResultContent'><div id='pkgViewMainResultName'>"+
    pkgNameArray.item(i).firstChild.data + 
    "</div><div id='pkgViewMainResultDescription'>"+
    pkgDescArray.item(i).firstChild.data +
    "</div></div><div id='pkgViewMainResultButton'>"+
    "<button type='button' onclick='moreInfo("+
    pkgIDArray.item(i).firstChild.data +
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


