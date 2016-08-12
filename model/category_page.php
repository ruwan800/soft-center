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

    db_select(SOFT_CENTER);
//var category=["accessories","education","games","graphics","internet","office","programming","science","sound & video","system tools","universal access"];
    foreach $category[$cat]
    foreach (array(1, 2, 3, 4) as &$value){
    #TODO
    } 
    
?>
