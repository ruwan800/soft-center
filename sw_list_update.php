<?php
require_once("includes/constants.php");
require_once("includes/mysql.php");
ini_set('memory_limit', '-1');

function sw_list_update($link){

    db_select(SOFT_CENTER);
    $query="SELECT package,soft_id,version FROM software";
    $result = mysql_query($query) or die("Error DB querying:".mysql_error());
    while($row = mysql_fetch_array( $result )){
        $old_package[]=$row[0];
        $old_soft_id[]=$row[1];
        $old_version[]=$row[2];
    }

    $more_info=null;
    $sw_count0=0;
    $sw_count1=0;
    $sw_count2=0;
    $sw_char0=null;
    $sw_char1=null;

    $lines = gzfile(REPOSITORY.$link);
    foreach ($lines as $line) {
        if(!strncmp ($line, " ",1 ))
            if(!strncmp ($line, " .",2 ))
                $description=$description."</br>";
            else
                $description=$description.$line;
        else if(strlen($line)==1){
            ####$description = nl2br($description);
            if($key = array_search($package, $old_package)){
                if($old_version[$key]!=$version){
                    $query="UPDATE software SET `package`='$package',`filename`='$filename',`version`='$version' WHERE 'soft_id'='$old_soft_id[$key]'";
                    mysql_query($query) or die("Error DB querying:".mysql_error());
                    $sw_count1++;
                    $sw_char0="$sw_char0, $package";
                }
                else{
                    $sw_count0++;
                }
            }
            else{
                $query="INSERT INTO software (package,filename,version) VALUES ('$package', '$filename','$version')";
                mysql_query($query) or die("Error DB querying:".mysql_error());
                $sw_count2++;
                $sw_char1="$sw_char1, $package";
            }
            $more_info=null;
        }
        else if(!strncmp ($line, "Package:",8 ))
            $package=substr($line, 9,-1);
        else if(!strncmp ($line, "Filename:",9 ))
            $filename=substr($line, 10,-1);
        else if(!strncmp ($line, "Priority:",9 ))
            $priority=substr($line, 9);
        else if(!strncmp ($line, "Section:",8 ))
            $section=substr($line, 8);
        else if(!strncmp ($line, "Installed-Size:",15 ))
            $installed_size=substr($line, 15);
        else if(!strncmp ($line, "Maintainer:",11 ))
            $maintainer=substr($line, 11);
        else if(!strncmp ($line, "Architecture:",13 ))
            $architecture=substr($line, 13);
        else if(!strncmp ($line, "Version:",8 ))
            $version=substr($line, 9,-1);
        else if(!strncmp ($line, "Size:",5 ))
            $size=substr($line, 5);
        else if(!strncmp ($line, "MD5sum:",7 ))
            $MD5sum=substr($line, 7);
        else if(!strncmp ($line, "SHA1:",5 ))
            $SHA1=substr($line, 5);
        else if(!strncmp ($line, "SHA256:",7 ))
            $SHA256=substr($line, 7);
        else if(!strncmp ($line, "Tag:",4 ))
            $tag=substr($line, 4);
        else if(!strncmp ($line, "Depends:",8 ))
            $depends=substr($line, 8);
        else if(!strncmp ($line, "Homepage:",9 ))
            $homepage=substr($line, 9);
        else if(!strncmp ($line, "Suggests:",9 ))
            $suggests=substr($line, 9);
        else if(!strncmp ($line, "Recommends:",11 ))
            $recommends=substr($line,11 );
        else if(!strncmp ($line, "Source:",7 ))
            $source=substr($line,7 );
        else if(!strncmp ($line, "Description:",12 ))
            $description=substr($line, 12);
    /*    
        else if(!strncmp ($line, "Provides:",9 )) //??????????????????
            $provides=substr($line,9 );
        else if(!strncmp ($line, "Replaces:",9 ))  //??????????????????
            $replaces=substr($line,9 );
        else if(!strncmp ($line, "Conflicts:",10 ))  //??????????????????
            $conflicts=substr($line,10 );
        else if(!strncmp ($line, "Enhances:",9 ))  //??????????????????
            $enhances=substr($line,9 );
        else if(!strncmp ($line, "Breaks:",7 ))  //??????????????????
            $breaks=substr($line,7 );
        else if(!strncmp ($line, "Task:",5 ))  //??????????????????
            $task=substr($line,5 );
        else if(!strncmp ($line, "Python-Version:",15 ))  //??????????????????
            $python_version=substr($line,15 );
    */
        else
            $more_info=$more_info."\n".$line;
    }
    echo "</br></br>".$sw_count1." packages were updated:</br></br>";
    if($sw_char1)
        echo "Following";
    echo $sw_count2." packages were newly added:</br>";
    echo $sw_char1;
}
/*
Section:
Installed-Size:
Maintainer:
Architecture:
Version:
Size:
MD5sum:
SHA1:
SHA256:
Tag:
Depends:
Homepage:
Suggests:
Provides:
Recommends:
Source:
Replaces:
Conflicts: 
Enhances:
Breaks:
Task:
Python-Version:

*/

?>
