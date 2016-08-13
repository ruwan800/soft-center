<?php
header('Content-Type: text/xml');									//let return result as XML
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';		//XML related info


require_once("../controller/includes/includes.php");
require_once("includes/mysql.php");
echo '<response>';
echo getResult();
echo '</response>';




/*try to generate XML of result set*/
function search_result($pkg,$output){
    if(isset($output))
        $output=$output.$pkg;
    else
        $output=$pkg;
}

/*if something went wrong*/
function search_error($err){
    return ("<error>".$err."</error>");
}

function getResult(){

    $output=null;
    if(isset($_GET["pkg"]))											//user request value
        $software=$_GET["pkg"];

    db_select(SOFT_CENTER);											//connect to database


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
