<?php
require_once("includes/constants.php");
require_once("includes/mysql.php");



    db_select(SOFT_CENTER);
    $query="SELECT package,soft_id,version FROM software";
    $result = mysql_query($query) or die("Error DB querying:".mysql_error());
    while($row = mysql_fetch_array( $result )){
        $old_package[]=$row[0];
        $old_soft_id[]=$row[1];
        $old_version[]=$row[2];
    }
    if($key = array_search($package, $old_package)){
        if($old_version[$key]!=$version){
            //update;
        }
        else{
            //none
        }
    }
    else{
        //insert;
    }
    
        
        



?>
