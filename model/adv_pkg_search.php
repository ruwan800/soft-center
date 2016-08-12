<?php
require_once("../control/includes/includes.php");

$output=null;

function search_result($pkg,$output){
    if(isset($output))
        $output=$output.$pkg;
    else
        $output=$pkg;
    //echo $output."</br>";
}

function search_error($err){
    return ("\t<error>\n\t\t".$err."\t</error>\n");
}

if(isset($_GET["pkg"]))
    $software=$_GET["pkg"];
if(isset($_GET["sm"]))
    $filter=$_GET["sm"];

db_select(SOFT_CENTER);

/*
$query="SELECT soft_id FROM software WHERE package='$software'";
$result = mysql_query($query) or die(search_error(mysql_error()));
$row=mysql_fetch_array( $result );
if($row)
    $output=$output."</br>".apt_link_xml($row[0]);
*/

//echo search_error("not implimented");

$query="SELECT soft_id FROM software WHERE package LIKE '%$software%' LIMIT 200;";
$result = mysql_query($query) or die(search_error(mysql_error()));
while($row=mysql_fetch_array( $result )){
    $output=$output."</br>".apt_link_xml($row[0]);
    //echo apt_link_xml($row[0]);
}
if($output)
    echo $output;
else
    echo search_error("Nothing found related with \"".$software."\".");
?>
