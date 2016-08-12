<?php
//header('Content-Type: text/xml');
//echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"';


require_once("../control/includes/includes.php");
echo '<response>';
echo categoryPage();
echo '</response>';

function categoryPage(){

    if(isset($_GET["cat"]))
        $cat=$_GET["cat"];
    $output=null;
//var category=["accessories","education","games","graphics","internet","office","programming","science","sound & video","system tools","universal access"];
    $category[0] = array("java","perl","python","php","ruby","web","devel","editors");
    $category_img[0] = array("java","perl","python","php","ruby","web","devel","editors");
    $category_section[0] = array("java","perl","python","php","ruby","web","devel","editors");

    $category[$cat].length=8;
    for($i=0;$i<$category[$cat].length;$i++){
        $output.="<category><cat_name>".$category[$cat][$i]."</cat_name>";
        $output.="<cat_section>".$category_img[$cat][$i]."</cat_section>";
        $output.="<cat_link>".$category_section[$cat][$i]."</cat_link></category>";
    }
    return $output;
}
    
?>
