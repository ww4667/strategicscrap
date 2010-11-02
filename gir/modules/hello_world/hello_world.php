<?php
if (isset($_GET['id'])){
	$adb = new Crud( );
	$adb->CreateDbConnection( $_SESSION['_DATABASE_CONNECTION'] );
	$object = $adb->ReadValuesByObjectId($_GET['id']);
	print_r($object);
	die();
}
if (isset($_POST["submit"])) {
	include("process.php");
} else {
	include("forms.php");
}
?>

