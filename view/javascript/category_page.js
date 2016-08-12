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
/*
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
*/
    
	var html="";
	for (var i=0; i<catNameArray.length; i++){
		html += "<div id=\"cat1\"><div id=\"catA\">"+
			viewCategory(i);
		html +=	"</div><div id=\"catB\">"+
			viewCategory(i+1);
		html +=	"</div></div><div id=\"cat2\"><div id=\"catA\">"+
			viewCategory(i+2);
		html +=	"</div><div id=\"catB\">"+
			viewCategory(i+3)+
			"</div></div>";
		i+=3;
	}

    document.getElementById("pkgviewResultSet").innerHTML=html;
    document.getElementById("updown3").innerHTML="";
    document.getElementById("updown1").innerHTML="";
    document.getElementById("updown2").innerHTML="";
}

function viewCategory(i){
    var text="";
    if(catNameArray.item(i).firstChild.data){
//	text="<div id=\"pkgViewMainResult\"><div id=\"pkgViewMainResultContent\"><div id=\"pkgViewMainResultName\">"+
    //    catNameArray.item(i).firstChild.data +
//        "</div><div id=\"pkgViewMainResultDescription\">"+
    //    catImgArray.item(i).firstChild.data +
//        "</div></div>
        text="<div id=\"catResultButton\">"+
            "<button onclick=\"searchByCategory('"+
            catLinkArray.item(i).firstChild.data +
            "')\"><div height=\"80%\"><img src=\"images/set/"+catImgArray.item(i).firstChild.data+
            ".png\" /></div><div height=\"20%\">"+
            catNameArray.item(i).firstChild.data+
            "</div></button></div>";
//        +"</div>";
    }
    return text;
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
        document.getElementById("updown2").innerHTML="<button type=\"button\" onclick=\"window.location.href='apt://"
        +valueArray.item(0).firstChild.data+"'\"></br>  Install </br></br></button>";
    }
    else{
        document.getElementById("updown2").innerHTML="<button type=\"button\" onclick=requestToUse('"+valueArray.item(0).firstChild.data+"')>Requst </br>  to</br> use</button>";
    }
    document.getElementById("pkgviewResultSet").innerHTML=html;
    document.getElementById("updown3").innerHTML="";
    document.getElementById("updown1").innerHTML="<button type=\"button\"onclick=\"showCurrent()\">Back</br> to  </br>results</button>";
}

function requestToUse(id){
    document.getElementById("pkgviewResultSet").innerHTML="Request Form for '" +id+ "' package" ;
}
