function getCategoryPage(cat){

var xmlhttp;

xmlhttp=new XMLHttpRequest();

xmlhttp.onreadystatechange=function(){
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    xmlResponse=xmlhttp.responseXML;
    xmlRoot = xmlResponse.documentElement;
    
    catName = xmlRoot.getElementsByTagName("name");
    catSearchNameArray = xmlRoot.getElementsByTagName("cat_name");
    catImgArray = xmlRoot.getElementsByTagName("img_link");
    viewCategoryPage();
    }
  }
xmlhttp.open("GET","../model/category_page.php?cat="+cat,true);
xmlhttp.send();
}

function viewCategoryPage(){
    var html = "";
    // iterate through the arrays and create an HTML structure
    for (var i=0; i<10; i++)
    html += "<div id=\"pkgViewMainResult\"><div id=\"pkgViewMainResultContent\"><div id=\"pkgViewMainResultName\">"+
    catNameArray.item(i).firstChild.data + 
    "</div><div id=\"pkgViewMainResultDescription\">"+
    catSearchNameArray.item(i).firstChild.data +
    "</div></div><div id=\"pkgViewMainResultButton\">"+
    "<button type=\"button\" onclick=\"moreInfo("+
    catImgArray.item(i).firstChild.data +
    ")\">More info >></button>"+
    "</div></div>"
    document.getElementById("pkgviewResultSet").innerHTML=html;
}

function moreInfo(id){

var xmlhttp;

xmlhttp=new XMLHttpRequest();

xmlhttp.onreadystatechange=function(){
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    xmlResponse=xmlhttp.responseXML;
    xmlRoot = xmlResponse.documentElement;
    
    keyArray = xmlRoot.getElementsByTagName("key");
    valueArray = xmlRoot.getElementsByTagName("value");
    viewMoreInfo();
    }
  }
xmlhttp.open("GET","../model/more_info.php?id="+id,true);
xmlhttp.send();
    
}



function viewMoreInfo(){
    
    var html = "<b>"+valueArray.item(0).firstChild.data+"</b></br></br>"+
    valueArray.item(1).firstChild.data+"<></br></br>"+
    valueArray.item(2).firstChild.data+"<></br></br>";
    for (var i=3; i<10; i++){
        try{
            html += keyArray.item(i).firstChild.data+": "+valueArray.item(i).firstChild.data+"</br>";
        }catch(e){}
    }
    document.getElementById("pkgviewResultSet").innerHTML=html;
}
