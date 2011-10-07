<?php
/**
 * Set the variables below to setup the application
 */
$coreDirectory = "core";
$modulesDirectory = "modules";
$librariesDirectory = $_SERVER["DOCUMENT_ROOT"] . "/lib";
$includesDirectory = $_SERVER["DOCUMENT_ROOT"] . "/inc";
$defaultModule = "facility";

// wbsrvr vars...
//$dbHost = "localhost";
//$dbName = "jlabresh_awesomedb";
//$dbUsername = "jlabresh_mrkelly";
//$dbPassword = "MAY!%2010";

// local vars...
// $dbHost = "localhost";
// $dbName = "awesome";
// $dbUsername = "root";
// $dbPassword = "";

$usa_epay_source_key 	= "m9I9GmBoXwMpKNuNAO7Vb5uo9lMjkZ78";
//$usa_epay_source_key 	= "KewO3jn8Gtqxizo1ATEPbnkOZl2ZJ7S8"; //slash test key for scrap
$usa_epay_pin			= "2580";

// VDC vars...

$DOMAIN_CHECK = explode(".",$_SERVER["HTTP_HOST"]);

if ( in_array("slashwebstudios",$DOMAIN_CHECK) ) {
	$dbUsername = 'stagings_user';
	$dbPassword = 'H=D?98!s{)Xc';
	$dbName = '`stagings_strategi_scrap`';
} else if ( in_array("local",$DOMAIN_CHECK) ) {
	$dbUsername = 'root';
	$dbPassword = 'root';
	$dbName = '`strategi_scrap`';
} else {
	$dbUsername = 'strategi_scrap';
	$dbPassword = 'T,uUUAfOi#T1';
	$dbName = '`strategi_scrap`';
}

$dbHost = "localhost";
$dbTablePrefix = "gir_";

//define( "DATABASE_SERVER", "mysql307.ixwebhosting.com");
//define( "DATABASE_USERNAME", "silvers_scrap" );
//define( "DATABASE_PASSWORD", "20Scrap10" );
//define( "DATABASE_NAME", "silvers_scrap" );
//define( "DATABASE_TABLE_PREFIX", "gir_" );
?>