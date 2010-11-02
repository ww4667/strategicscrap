<?php
//define( "DATABASE_SERVER", "localhost");
//define( "DATABASE_USERNAME", "root" );
//define( "DATABASE_PASSWORD", "" );
//define( "DATABASE_NAME", "dbname" );
$_SESSION['_DATABASE_CONNECTION'] = Mysql::getInstance($dbHost, $dbName, $dbUsername, $dbPassword);
?>