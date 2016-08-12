function loadXMLDoc()
{
var xmlhttp;
var text=document.getElementById('pkg').value;

xmlhttp=new XMLHttpRequest();

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
     tell=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","adv_pkg_search.php?pkg="+text+"&sm=2",true);
xmlhttp.send();
return tell;
}

function searchResults(){
    var temp=loadXMLDoc();
    document.getElementById("myDiv").innerHTML=temp;
}

