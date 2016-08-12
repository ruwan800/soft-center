<html>
<head>
<title>Advance Package Search</title>
</head>
<body>


<!--$query="SELECT package,soft_id FROM software WHERE package LIKE '%$software%'";-->



<?php
require_once("includes/constants.php");
require_once("includes/mysql.php");


if(isset($_GET["pkg"])){
    $software=$_GET["pkg"];
    if(isset($_GET["sm"]))
        $filter=$_GET["sm"];
    else
        $filter=1;
    if($filter==1){
        db_select(SOFT_CENTER);
        $query="SELECT package,soft_id FROM software WHERE package='$software'";
        $result = mysql_query($query) or die("Error DB querying:".mysql_error());
        $row=mysql_fetch_array( $result );
        if($row)
            echo apt_link($row[1]);
        else
            echo "package \"".$software."\" not found";
    }
    else if($filter==2){
        db_select(SOFT_CENTER);
        $query="SELECT package,soft_id FROM software WHERE package LIKE '%$software%'";
        $result = mysql_query($query) or die("Error DB querying:".mysql_error());
        $found=False;
        while($row=mysql_fetch_array( $result )){
            echo apt_link($row[1])."</br>";
            $found=True;
        }
        if(!$found)
            echo "Nothing found related with \"".$software."\".";
    }
    else if($filter==3){
        echo "not implimented";
    }
    else
        echo "bad request";
}
else{
?>
    <form>
    <form name="input" action="adv_pkg_search.php" method="get">
    Enter Package Name:
    <input type="text" name="pkg" />
    <input type="submit" value="Submit" /></br>
    Filter result by:
    <input type="radio" name="sm" value=1 /> Package</>
    <input type="radio" name="sm" value=2 /> Full Text</>
    <input type="radio" name="sm" value=3 /> Keyword</>
    </form>
<?php
}



?>

