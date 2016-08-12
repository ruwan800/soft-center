<?php
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';

require_once("../control/includes/includes.php");

echo '<response>';
echo moreInfo();
echo '</response>';


function moreInfo(){
    $output=null;
    if(isset($_GET["id"]))
        $soft_id=$_GET["id"];
    db_select(SOFT_CENTER);
    $query="SELECT * FROM software WHERE soft_id = '$soft_id'";
    $result = mysql_query($query) or die(search_error(mysql_error()));
    $row=mysql_fetch_array( $result );
    $arr = array(0,11,18,2,3,5,8,9,10);
    foreach ($arr as &$i){
        if($row[$i]){
            $output = $output."<key>".mysql_field_name($result, $i)."</key><value>".htmlspecialchars($row[$i])."</value>";
        }
        else{
        	$output = $output."<key></key><value></value>";
        }
    }
    $output .= "<key>allowedSoftware</key><value>".allowedSoftware($soft_id)."</value>";
    return $output;
}

function allowedSoftware($soft_id){
    //TODO allowing software
    return "allowed";
    //return "notallowed";
}
