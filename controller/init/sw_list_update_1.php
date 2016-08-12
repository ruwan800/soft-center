   Please wait...! This takes time. </br>

<?php
require_once("../includes/includes.php");
$desc_more=null;
$homepage=null;
$maintainer=null;
$source=null;
$description=null;
$architecture=null;
$tag=null;
$depends=null;
$suggests=null;
$recommends=null;
$desc_more=null;
$provides=null;
$replaces=null;
$conflicts=null;
$more_info=null;

db_select(SOFT_CENTER);

$query="DROP TABLE IF EXISTS sc_temp";//TODO
mysql_query($query) or die(mysql_error());
$query="CREATE /*TEMPORARY*/ TABLE IF NOT EXISTS sc_temp LIKE software";//TODO*2
mysql_query($query) or die(mysql_error());

$lines = gzfile(REPOSITORY."Packages.gz");
db_select(SOFT_CENTER);
foreach ($lines as $line) {
    if(!strncmp ($line, " ",1 ))
        if(!strncmp ($line, " .",2 ))
            $desc_more=$desc_more."\n";
        else
            $desc_more=$desc_more.$line;
    else if(strlen($line)==1){
        //$desc_more = nl2br($desc_more);
        $desc_more = addslashes($desc_more);
        $description = addslashes($description);
        $maintainer = addslashes($maintainer);        
        $query="INSERT INTO sc_temp SET
        package='$package',
        soft_id=DEFAULT,
        installed_size=$installed_size,
        size= $size,
        date= CURDATE()+0,
        version= '$version',
        priority= '$priority',
        section= '$section',
        maintainer= '$maintainer',
        homepage= '$homepage',
        source = '$source',
        description = '$description',
        architecture = '$architecture',
        filename = '$filename',
        tag = '$tag',
        depends = '$depends',
        suggests = '$suggests',
        recommends = '$recommends',
        desc_more = '$desc_more',
        provides = '$provides',
        replaces = '$replaces',
        conflicts = '$conflicts',
        more_info = '$more_info'";
        mysql_query($query) or die(mysql_error());
        $more_info=null;
        $desc_more=null;
    }
    else if(!strncmp ($line, "Package:",8 ))
        $package=substr($line, 9,-1);
    else if(!strncmp ($line, "Filename:",9 ))
        $filename=substr($line, 10,-1);
    else if(!strncmp ($line, "Priority:",9 ))
        $priority=substr($line, 10, -1);
    else if(!strncmp ($line, "Section:",8 ))
        $section=substr($line, 9, -1);
    else if(!strncmp ($line, "Installed-Size:",15 ))
        $installed_size=substr($line, 16, -1);
    else if(!strncmp ($line, "Maintainer:",11 ))
        $maintainer=substr($line, 12, -1);
    else if(!strncmp ($line, "Architecture:",13 ))
        $architecture=substr($line, 14, -1);
    else if(!strncmp ($line, "Version:",8 ))
        $version=substr($line, 9, -1);
    else if(!strncmp ($line, "Size:",5 ))
        $size=substr($line, 6, -1);
    else if(!strncmp ($line, "MD5sum:",7 ))
        $MD5sum=substr($line, 8, -1);
    else if(!strncmp ($line, "SHA1:",5 ))
        $SHA1=substr($line, 6, -1);
    else if(!strncmp ($line, "SHA256:",7 ))
        $SHA256=substr($line, 8, -1);
    else if(!strncmp ($line, "Tag:",4 ))
        $tag=substr($line, 4, -1);              //First space not removed
    else if(!strncmp ($line, "Depends:",8 ))
        $depends=substr($line, 9, -1);
    else if(!strncmp ($line, "Homepage:",9 ))
        $homepage=substr($line, 10, -1);
    else if(!strncmp ($line, "Suggests:",9 ))
        $suggests=substr($line, 10, -1);
    else if(!strncmp ($line, "Recommends:",11 ))
        $recommends=substr($line,12 , -1);
    else if(!strncmp ($line, "Source:",7 ))
        $source=substr($line,8 , -1);
    else if(!strncmp ($line, "Description:",12 ))
        $description=substr($line, 13, -1);
    else if(!strncmp ($line, "Provides:",9 ))
        $provides=substr($line,10 -1);
    else if(!strncmp ($line, "Replaces:",9 ))
        $replaces=substr($line,10 -1);
    else if(!strncmp ($line, "Conflicts:",10 ))
        $conflicts=substr($line,11 -1);
/*    
    else if(!strncmp ($line, "Enhances:",9 ))
        $enhances=substr($line,10 -1);
    else if(!strncmp ($line, "Breaks:",7 ))
        $breaks=substr($line,8 -1);
    else if(!strncmp ($line, "Task:",5 ))
        $task=substr($line,6 -1);
    else if(!strncmp ($line, "Python-Version:",15 ))
        $python_version=substr($line,16 -1);
*/
    else
        $more_info=$more_info."\n".$line;
}
//TODO release .gzfile;
unset($lines);
unset($line);
/*
$query="SELECT soft_id FROM software
        WHERE package NOT IN (SELECT package FROM sc_temp)";
*/

        // *
$query="SELECT software.soft_id FROM 
        software LEFT OUTER JOIN sc_temp
        ON software.package = sc_temp.package 
        WHERE sc_temp.package IS null";
$result = mysql_query($query) or die(mysql_error());
while($row=mysql_fetch_array( $result )){
//TODO set as an abandoned package
}

/*
$query="SELECT package FROM sc_temp
        WHERE package NOT IN (SELECT package FROM software)";
        */

$query="SELECT sc_temp.package 
        FROM sc_temp LEFT OUTER JOIN software 
        ON software.package = sc_temp.package 
        WHERE software.package IS null";
$result = mysql_query($query) or die(mysql_error());

/*
$query="INSERT IGNORE INTO software SELECT * FROM sc_temp";//TODO
        */

$query="INSERT INTO software SELECT sc_temp.* 
        FROM sc_temp LEFT OUTER JOIN software 
        ON software.package = sc_temp.package 
        WHERE software.package IS null";
mysql_query($query) or die(mysql_error());
while($row=mysql_fetch_array( $result )){
//TODO set as a new package
}
$query="SELECT sc_temp.soft_id 
        FROM sc_temp LEFT OUTER JOIN software 
        ON (sc_temp.package,sc_temp.version) =(software.package,software.version) 
        WHERE software.package IS null";
$result = mysql_query($query) or die(mysql_error());
/*        
$query="REPLACE INTO software SELECT * FROM sc_temp
        WHERE package NOT IN (SELECT package FROM software
        WHERE (package,version) IN (SELECT package,version FROM sc_temp) )";
        */

$query="REPLACE INTO software SELECT sc_temp.*
        FROM sc_temp LEFT OUTER JOIN software 
        ON (sc_temp.package,sc_temp.version) =(software.package,software.version) 
        WHERE software.package IS null";
mysql_query($query) or die(mysql_error());
while($row=mysql_fetch_array( $result )){
//TODO set as an updated package
}

        //*/
$query="DROP /*TEMPORARY*/ TABLE sc_temp";//TODO
mysql_query($query) or die(mysql_error());

?>
</br>
DONE :)

