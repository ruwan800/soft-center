<?php include("includes/header.php");?>
<script src="javascript/ajax.js"></script>
<script src="javascript/search_by_cat.js"></script>
<script src="javascript/category_page.js"></script>
<div id="searchbar">
    <div id="searchbardir">
        Search Software
    </div>
    <div id="searchbox">
        <input type="text" id="pkg" onkeyup="loadXMLDoc()"/>
    </div>
    <div id="searchimg">
        <!-- <img src="images/loader.gif" height=20px width=20px /> -->
    </div>
</div>
<div id="pkgview">
    <div class="ssPane" id="sidepane">
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(1)">Programming</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(2)">System Tools</button></div>
        <div id="sidePaneValue"><button type="button" onclick="searchByCategory('graphics')">Graphics</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(3)">Internet</button></div>
        <div id="sidePaneValue"><button type="button" onclick="searchByCategory('games')">Games</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(4)">Office</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(5)">Education</button></div>
        <div id="sidePaneValue"><button type="button" onclick="searchByCategory('misc')">Accessories</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(6)">Sound & Video</button></div>
    </div>
    <div id="pkgviewmain">
        <div class="ssMain" id="pkgviewResultSet"></div>
        <div id="updown">
            <div id="updown1">
                <!-- <button type="button" id="button1" onclick="showPrevious()">Previous</br>Results</button> -->
            </div>
            <div id="updown2"></div>
            <div id="updown3">
                <!-- <button type="button" id="button2" onclick="showMore()">More </br>Results</button> -->
            </div>
        </div>
    </div>
</div>


<?php require("includes/footer.php") ?>
