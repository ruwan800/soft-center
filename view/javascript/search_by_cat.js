var pkgset;
var count=0;
function showPrevious(){
    count--;
    viewResult(count);
}

function searchByCategory(cat){

var xmlhttp;

xmlhttp=new XMLHttpRequest();

xmlhttp.onreadystatechange=function(){
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    xmlResponse=xmlhttp.responseXML;
    xmlRoot = xmlResponse.documentElement;
    pkgNameArray = xmlRoot.getElementsByTagName("name");
    pkgDescArray = xmlRoot.getElementsByTagName("description");
    pkgIDArray = xmlRoot.getElementsByTagName("soft_id");
    viewResult(0);
    }
  }
xmlhttp.open("GET","../model/search_by_cat.php?cat="+cat,true);
xmlhttp.send();
}

           
function viewResult(count){
    var html = "";
    if(pkgNameArray.length<=10+10*count){
        document.getElementById("updown3").innerHTML="";
        for (var i=count*10; i<pkgNameArray.length; i++)
            html +=modResult(i);
    }
    else{
        document.getElementById("updown3").innerHTML="<button type=\"button\" onclick=\"showMore()\">More </br>Results</button>";
        for (var i=count*10; i<(10+10*count); i++)
            html +=modResult(i);
    }
    if(0<count)
        document.getElementById("updown1").innerHTML="<button type=\"button\" onclick=\"showPrevious()\">Previous</br>Results</button>";
    else
        document.getElementById("updown1").innerHTML="";
    document.getElementById("pkgviewResultSet").innerHTML=html;
}

function modResult(i){
    text = "<div id=\"pkgViewMainResult\"><div id=\"pkgViewMainResultContent\"><div id=\"pkgViewMainResultName\">"+
    pkgNameArray.item(i).firstChild.data + 
    "</div><div id=\"pkgViewMainResultDescription\">"+
    pkgDescArray.item(i).firstChild.data +
    "</div></div><div id=\"pkgViewMainResultButton\">"+
    "<button type=\"button\" onclick=\"moreInfo("+
    pkgIDArray.item(i).firstChild.data +
    ")\">More info >></button>"+
    "</div></div>"
    return text;
}
