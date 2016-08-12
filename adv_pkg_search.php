
<result>\n
<?php
require_once("includes/constants.php");
require_once("includes/mysql.php");

function search_result($pkg){
    if(isset($result))
        $result=$result.$pkg;
    else
        $result=$pkg;
}

function search_error($err){
    return ("\t<error>\n\t\t".$err."\t</error>\n");
}

if(isset($_GET["pkg"]))
    $software=$_GET["pkg"];
if(isset($_GET["sm"]))
    $filter=$_GET["sm"];

db_select(SOFT_CENTER);
$query="SELECT soft_id FROM software WHERE package='$software'";
$result = mysql_query($query) or die(search_error(mysql_error()));
$row=mysql_fetch_array( $result );
if($row)
    search_result(apt_link_xml($row[0]));

//echo search_error("not implimented");

$query="SELECT soft_id FROM software WHERE package LIKE '%$software%' LIMIT 200;";
$result = mysql_query($query) or die(search_error(mysql_error()));
while($row=mysql_fetch_array( $result )){
    search_result(apt_link_xml($row[0]));
}
if($result)
    echo $result;
else
    echo search_error("Nothing found related with \"".$software."\".");
?>
</result>
