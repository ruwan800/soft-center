<?php include("public/includes/header.php");?>
<script src="public/javascript/ajax.js"></script>
<script src="public/javascript/proto.js"></script>
<!--<script src="public/javascript/search_by_category.js"></script>
<script src="public/javascript/category_page.js"></script>-->
<div id="pkgview">
    <div id="sidepane">
        <div class='sidePaneValue'><button type='button' onclick='searchPakages()'>Search Pakages</button></div>
        <div class='sidePaneValue'><button type='button' onclick='loginPage()'>login</button></div>
        <div class='sidePaneValue'><button type='button' onclick='getCategoryPage(2)'>System Tools</button></div>
        <div class='sidePaneValue'><button type='button' onclick='searchByCategory('graphics')'>Graphics</button></div>
        <div class='sidePaneValue'><button type='button' onclick='getCategoryPage(3)'>Internet</button></div>
        <div class='sidePaneValue'><button type='button' onclick='searchByCategory('games')'>Games</button></div>
        <div class='sidePaneValue'><button type='button' onclick='getCategoryPage(4)'>Office</button></div>
        <div class='sidePaneValue'><button type='button' onclick='getCategoryPage(5)'>Education</button></div>
        <div class='sidePaneValue'><button type='button' onclick='searchByCategory('misc')'>Accessories</button></div>
        <div class='sidePaneValue'><button type='button' onclick='getCategoryPage(6)'>Sound & Video</button></div>
    </div>
    <div id='pkgviewmain'>
        <div id='notifier'></div>
        <div id='pkgviewResultSet'></div>
        <div id='moreResults'></div>
    </div>
</div>


<?php require("public/includes/footer.php") ?>
