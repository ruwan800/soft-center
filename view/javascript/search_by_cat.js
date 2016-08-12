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
    modResult(0);
    }
  }
xmlhttp.open("GET","../model/search_by_cat.php?cat="+cat,true);
xmlhttp.send();
}

           
function viewResult(i){
    
    xmlDocumentElement = "eouou".documentElement;
    //pkgDetail = xmlDocumentElement.firstChild.data;
    
    document.getElementById("pkgviewResultSet").innerHTML="hchthdtdt";
    //if(pkgset.length<10+10*i)
    //    $("#button2").hide();
    //else
        $("#button2").show();
    if(0<i)
        $("#button1").show();
    else
        $("#button1").hide();
}

function modResult(count){
    var html = "";
    // iterate through the arrays and create an HTML structure
    for (var i=0; i<10; i++)
    html += "<div id=\"pkgViewMainResult\"><div id=\"pkgViewMainResultContent\"><div id=\"pkgViewMainResultName\">"+
    pkgNameArray.item(i).firstChild.data + 
    "</div><div id=\"pkgViewMainResultDescription\">"+
    pkgDescArray.item(i).firstChild.data +
    "</div></div><div id=\"pkgViewMainResultButton\">"+
    "<button type=\"button\" onclick=\"moreInfo("+
    pkgIDArray.item(i).firstChild.data +
    ")\">More info >></button>"+
    "</div></div>"
    document.getElementById("pkgviewResultSet").innerHTML=html;


      
}

