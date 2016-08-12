
<?php
require_once("includes/constants.php");

// 2. Select a database to use 

function db_select($_db){
    $connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
    if (!$connection) 
	    die("Database connection failed: " . mysql_error());
    $db_select = mysql_select_db("soft_center",$connection);
    if (!$db_select) 
    	die("Database selection failed: " . mysql_error());
}

function pkg_link($software_id) {

    db_select(SOFT_CENTER);
    $query="SELECT package,filename FROM software WHERE soft_id='$software_id'";
    $result = mysql_query($query) or die("Error DB querying:".mysql_error());
    $row=mysql_fetch_array( $result );
    $temp="<a href=".REPOSITORY.$row[1].">Install ".$row[0]."</a>";
    return ($temp);
}

function pkg_search($software){
    db_select(SOFT_CENTER);
    $query="SELECT package,soft_id FROM software WHERE package='$software'";
    $result = mysql_query($query) or die("Error DB querying:".mysql_error());
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
    $result = mysql_query($query) or die("Error DB querying:".mysql_error());
    $row=mysql_fetch_array( $result );
    $temp="<a href=apt://".$row[0].">Install ".$row[0]."</a>";
    return ($temp);
}

function adv_pkg_search($software){
    db_select(SOFT_CENTER);
    $query="SELECT package,soft_id FROM software WHERE package='$software'";
    $result = mysql_query($query) or die("Error DB querying:".mysql_error());
    $row=mysql_fetch_array( $result );
    if($row){
        echo apt_link($row[1]);
    }
    else
        echo $software." not found";

}

?>

