//function (){ getElementById("button1").hide(); }
$("#button1").hide();
$("#button2").hide();

    //
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

function loadXMLDoc()
{

var xmlhttp;
var text=document.getElementById('pkg').value;
var temp;

$("#button1").hide();
$("#button2").hide();


xmlhttp=new XMLHttpRequest();

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
     temp=xmlhttp.responseText;
     pkgset = temp.split("</br>");
     
     viewResult(0)
     //viewResult(temp);
    }
  }
xmlhttp.open("GET","../model/adv_pkg_search.php?pkg="+text+"&sm=2",true);
xmlhttp.send();
}

           
function viewResult(i){
    if(10 < pkgset.length-10*i)
        var temp1=pkgset.slice(i*10, i*10+10);
    else
        var temp1=pkgset.slice(i*10, pkgset.length);
    var temp2=temp1.join("</br>");
    document.getElementById("pkgviewmain").innerHTML=temp2;
    if(pkgset.length<10+10*i)
        $("#button2").hide();
    else
        $("#button2").show();
    if(0<i)
        $("#button1").show();
    else
        $("#button1").hide();
}
