<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/inc/util.php');

$FORCE_SSL = true;

if($FORCE_SSL==true){
if($_SERVER["HTTPS"] != "on") {
//	$newurl = "https://98.131.204.40" . $_SERVER["REQUEST_URI"];
	$newurl = "https://strategicscrap.com" . $_SERVER["REQUEST_URI"];
	redirect_to($newurl);
	exit();
	}
}
?>