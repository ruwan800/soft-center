<?php
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';


require_once("../control/includes/includes.php");
echo '<response>';
echo categoryPage();
echo '</response>';

function search_error($err){
    return ("<error>".$err."</error>");
}

function categoryPage(){

    if(isset($_GET["cat"]))
        $cat=$_GET["cat"];
    $output=null;
//var category=["accessories","education","games","graphics","internet","office","programming","science","sound & video","system tools","universal access"];
//    $category = array("java","perl","python","php","ruby","web","devel","editors");
//    $category_img = array("java","perl","python","php","ruby","web","devel","editors");
//    $category_section = array("java","perl","python","php","ruby","web","devel","editors");

    db_select(SOFT_CENTER);


    $query="SELECT * FROM category WHERE cat_type = $cat;";
    $result = mysql_query($query) or die(search_error(mysql_error()));
    while($row=mysql_fetch_array( $result )){
        $output.="<category><cat_name>".$row[2]."</cat_name>";
        $output.="<cat_img>".$row[3]."</cat_img>";
        $output.="<cat_link>".$row[4]."</cat_link></category>";
    }
    return $output;
}
    
?>
