<?php include("includes/header.php");?>
<script src="javascript/jquery.js"></script>
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
        <div id="sidePaneValue"><a href="url">Link text</a></div>
        <div id="sidePaneValue"><a href="url">Link text</a></div>
        <div id="sidePaneValue"><a href="url">Link text</a></div>
        <div id="sidePaneValue"><a href="url">Link text</a></div>
        <div id="sidePaneValue"><a href="url">Link text</a></div>
        <div id="sidePaneValue"><a href="url">Link text</a></div>
        <div id="sidePaneValue"><a href="url">Link text</a></div>
        <div id="sidePaneValue"><a href="url">Link text</a></div>
        <div id="sidePaneValue"><a href="url">Link text</a></div>
        <div id="sidePaneValue"><a href="url">Link text</a></div>
        <div id="sidePaneValue"><a href="url">Link text</a></div>
        <div id="sidePaneValue"><a href="url">Link text</a></div>
    </div>
    <div id="pkgviewmain"></div>
    <div id="updown">
        <div id="updown1">
            <button type="button" id="button1" onclick="showPrevious()">Previous</button>
        </div>
        <div id="updown2"></div>
        <div id="updown3">
            <button type="button" id="button2" onclick="showMore()">More Results</button>
        </div>
    </div>
</div>

<script src="javascript/ajax.js"></script>
<?php require("includes/footer.php") ?>
