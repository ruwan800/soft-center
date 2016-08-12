<?php
require_once("constants.php");

// 2. Select a database to use 

function db_select($_db){
    $connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
    if (!$connection) 
	    die(mysql_error());
    $db_select = mysql_select_db("soft_center",$connection);
    if (!$db_select) 
    	die(mysql_error());
}

function pkg_link($software_id) {

    db_select(SOFT_CENTER);
    $query="SELECT package,filename FROM software WHERE soft_id='$software_id'";
    $result = mysql_query($query) or die(mysql_error());
    $row=mysql_fetch_array( $result );
    $temp="<a href=".REPOSITORY.$row[1].">Install ".$row[0]."</a>";
    return ($temp);
}

function pkg_search($software){
    db_select(SOFT_CENTER);
    $query="SELECT package,soft_id FROM software WHERE package='$software'";
    $result = mysql_query($query) or die(mysql_error());
    $row=mysql_fetch_array( $result );
    if($row){
        echo apt_link($row[1]);
    }
    else
        echo $software." not found";

}

function apt_link($software_id) {

    db_select(SOFT_CENTER);
    $query="SELECT package FROM software WHERE soft_id='$software_id'";
    $result = mysql_query($query) or die(mysql_error());
    $row=mysql_fetch_array( $result );
    $temp="<a href=apt://".$row[0].">Install ".$row[0]."</a>";
    return ($temp);
}

function apt_link_xml($soft_id){
    $query="SELECT package,description FROM software WHERE soft_id='$soft_id'";
    $result = mysql_query($query) or die(mysql_error());
    $row=mysql_fetch_array( $result );
    return '<package><name>'.$row[0].'</name><description>'.$row[1].'</description><soft_id>'.$soft_id.'</soft_id></package>';

}

?>

