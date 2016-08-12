<?php
require_once("../includes/includes.php");


db_select(SOFT_CENTER);
$query="DROP TABLE IF EXISTS software";
mysql_query($query) or die(mysql_error());
$query="CREATE TABLE software(
        package     varchar(70) NOT NULL,
        soft_id     int(11) NOT NULL AUTO_INCREMENT,
        installed_size int(11),
        size        int(11),
        date        int(8),
        version     text,
        priority    text,
        section     text,
        maintainer  text,
        homepage    text,
        source      text,
        description text,
        architecture text,
        filename    text,
        tag         text,
        depends     text,
        suggests    text,
        recommends  text,
        desc_more   text,
        provides    text,
        replaces    text,
        conflicts   text,
        more_info   text,
        PRIMARY KEY (soft_id),
        INDEX USING BTREE (package)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
mysql_query($query) or die(mysql_error());
/*

$query="CREATE TABLE IF NOT EXISTS software(
        soft_id     int(11)
        
$query="";

*/
?>
:)
