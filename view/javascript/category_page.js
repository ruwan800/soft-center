function getCategoryPage(cat){

var xmlhttp;

xmlhttp=new XMLHttpRequest();

xmlhttp.onreadystatechange=function(){
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    xmlResponse=xmlhttp.responseXML;
    xmlRoot = xmlResponse.documentElement;
    
    catNameArray = xmlRoot.getElementsByTagName("cat_name");
    catImgArray = xmlRoot.getElementsByTagName("cat_img");
    catLinkArray = xmlRoot.getElementsByTagName("cat_link");
    viewCategoryPage();
    }
  }
xmlhttp.open("GET","../model/category_page.php?cat="+cat,true);
xmlhttp.send();
}

function viewCategoryPage(){
    var html = "";
    // iterate through the arrays and create an HTML structure
    for (var i=0; i<catNameArray.length; i++)
    html += "<div id=\"pkgViewMainResult\"><div id=\"pkgViewMainResultContent\"><div id=\"pkgViewMainResultName\">"+
//    catNameArray.item(i).firstChild.data +
    "</div><div id=\"pkgViewMainResultDescription\">"+
//    catImgArray.item(i).firstChild.data +
    "</div></div><div id=\"pkgViewMainResultButton\">"+
    "<button type=\"button\" onclick=\"searchByCategory('"+
    catLinkArray.item(i).firstChild.data +
    "')\">"+catNameArray.item(i).firstChild.data+"</button>"+
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
    valueArray.item(1).firstChild.data+"</br></br>"+
    valueArray.item(2).firstChild.data+"</br></br>";
    html += keyArray.item(3).firstChild.data+": "+valueArray.item(3).firstChild.data+" Kbytes</br>";
    html += keyArray.item(4).firstChild.data+": "+valueArray.item(4).firstChild.data+" Bytes</br>";
    html += keyArray.item(5).firstChild.data+": "+valueArray.item(5).firstChild.data+"</br>";
    try{
    html += keyArray.item(6).firstChild.data+": "+valueArray.item(6).firstChild.data+"</br>";
    }catch(e){}
    try{
    html += "<A href='"+valueArray.item(7).firstChild.data+"'>Developer website</A></br>";
    }catch(e){}
    try{
    html += keyArray.item(8).firstChild.data+": "+valueArray.item(8).firstChild.data+"</br>";
    }catch(e){}
    if(valueArray.item(9).firstChild.data=="allowed"){
        html +="       <button type=\"button\" onclick=\"window.location.href='apt://"
        +valueArray.item(0).firstChild.data+"'\">INSTALL</button>";
    }
    else{
        html +="       <button type=\"button\" onclick=requestToUse("+id+")>Requst to use</button>";
    }
    document.getElementById("pkgviewResultSet").innerHTML=html;
}

function requestToUse(id){
    document.getElementById("pkgviewResultSet").innerHTML="requesting"+id;
}
