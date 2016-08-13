<?php
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';


require_once("../control/includes/includes.php");
echo '<response>';
echo getResult();
echo '</response>';





function search_result($pkg,$output){
    if(isset($output))
        $output=$output.$pkg;
    else
        $output=$pkg;
}

function search_error($err){
    return ("<error>".$err."</error>");
}

function getResult(){

    $output=null;
    if(isset($_GET["pkg"]))
        $software=$_GET["pkg"];

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
        $output=$output.apt_link_xml($row[0]);
        //echo apt_link_xml($row[0]);
    }
if($output)
    return $output;
else
    return search_error("Nothing found related with \"".$software."\".");
}
?>
