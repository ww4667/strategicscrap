Scrap Classifieds!
<?php 

	if( !session_id() ) {
		require_once($_SERVER['DOCUMENT_ROOT']."/gir/core/models/crud/Crud.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/gir/modules/classified/Classified.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/gir/modules/category/Category.php");
		
		if( !empty($_GET['session_id']) ) session_id($_GET['session_id']);
		if(!isset($_SESSION)) session_start();
		
		require_once($_SERVER['DOCUMENT_ROOT']."/gir/index.php");
	} 
	
	$categoryOne = new Category();
	$classifiedOne = new Classified();
	
	$categoryOne->PTS( $categoryOne, "Category One" );
	$classifiedOne->PTS( $classifiedOne, "Classified One" );
	
	print "howdy";
?>

