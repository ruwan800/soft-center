<?php include("includes/header.php");?>
<script src="javascript/jquery.js"></script>
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
    <div id="sidepane">
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(0)">Accessories</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(1)">Education</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(2)">Games</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(3)">Graphics</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(4)">Internet</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(5)">Office</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(6)">Programming</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(7)">Science</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(8)">Sound & Video</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(9)">System Tools</button></div>
        <div id="sidePaneValue"><button type="button" onclick="getCategoryPage(10)">Universal Access</button></div>
    </div>
    <div id="pkgviewmain">
        <div id="pkgviewResultSet"></div>
        <div id="updown">
            <div id="updown1">
                <button type="button" id="button1" onclick="showPrevious()">Previous</br>Results</button>
            </div>
            <div id="updown2"></div>
            <div id="updown3">
                <button type="button" id="button2" onclick="showMore()">More </br>Results</button>
            </div>
        </div>
    </div>
</div>

<script src="javascript/ajax.js"></script>
<?php require("includes/footer.php") ?>
