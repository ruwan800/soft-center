function loadXMLDoc(){

var this.xmlhttp;
var this.text=document.getElementById('pkg').value;
var this.temp;

this.xmlhttp=new XMLHttpRequest();

this.xmlhttp.onreadystatechange=function(){
  if (this.xmlhttp.readyState==4 && this.xmlhttp.status==200){
    xmlResponse=this.xmlhttp.responseXML;
    try{
        xmlRoot = xmlResponse.documentElement;
    }catch(err){
        Something went wrong;  :(
    }
    pkgNameArray = xmlRoot.getElementsByTagName("name");
    pkgDescArray = xmlRoot.getElementsByTagName("description");
    pkgIDArray = xmlRoot.getElementsByTagName("soft_id");
    modResult(0);
    }
  }
xmlhttp.open("GET","../model/adv_pkg_search.php?pkg="+text,true);
xmlhttp.send();
}


function test(){
    
}

test.prototype = new loadXMLDoc;
