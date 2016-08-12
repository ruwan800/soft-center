//function (){ getElementById("button1").hide(); }
$("#button1").hide();
$("#button2").hide();

var pkgset;
var count=0;
function showPrevious(){
    count--;
    viewResult(count);
}

function showMore(){
    count++;
    viewResult(count);
}

function loadXMLDoc(){

var xmlhttp;
var text=document.getElementById('pkg').value;
var temp;

xmlhttp=new XMLHttpRequest();

xmlhttp.onreadystatechange=function(){
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    xmlResponse=xmlhttp.responseXML;
    viewResult(0)
    }
  }
xmlhttp.open("GET","../model/adv_pkg_search.php?pkg="+text,true);
xmlhttp.send();
}

           
function viewResult(i){
    
    xmlDocumentElement = "eouou".documentElement;
    //pkgDetail = xmlDocumentElement.firstChild.data;
    
    document.getElementById("pkgviewmain").innerHTML="hchthdtdt";
    //if(pkgset.length<10+10*i)
    //    $("#button2").hide();
    //else
        $("#button2").show();
    if(0<i)
        $("#button1").show();
    else
        $("#button1").hide();
}

function modResult(temp3){
    return temp3;    
}

/*
if(10 < pkgset.length-10*i)
        var temp1=pkgset.slice(i*10, i*10+10);
    else{
        var temp1=pkgset.slice(i*10, pkgset.length);
    var temp2=temp1.join("</br>");
    //modResult(temp2);
    }
*/

