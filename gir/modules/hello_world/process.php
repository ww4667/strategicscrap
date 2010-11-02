<?php

$adb = new Crud( );
$adb->CreateDbConnection( $_SESSION['_DATABASE_CONNECTION'] );

$method = $_POST["method"];
		print "<pre>";
		print_r( $_POST );
		print "</pre>";
switch ($method){
	
	case "defineObject":
$newProperties = "";
	foreach (array_keys($_POST["newProperty"]) as $id) {
	 $newProperties .= $_POST["newProperty"][$id] . ", ";	
	}
	
		print "<hr><h3>DefineObject</h3>";
		$newObject = $adb->CreateObjectDefinition($_POST["label"], $_POST["newProperty"] );
		print '<blockquote>$newObject = $adb->DefineObject("' . $_POST["label"] . '", array("' . $newProperties . '"));</blockquote>';
		print "<pre>";
		print_r( $newObject );
		print "</pre>";
		break;
	case "newObject":
		print_r($_POST);
		$objectId = $_POST["objectId"];
		$property = $_POST["property"];
		$propertyValue = $_POST["propertyValue"];
		
		print "<hr><h3>AddObject</h3>";
		$newObjectId = $adb->CreateObject( $objectId );
		print '<blockquote>$newObject = $adb->CreateObject( '. $objectId .');</blockquote>';
		print "<pre>";
		print_r( $newObjectId );
		print "</pre>";
		
			for ($i = 0; $i < count($property); $i++)  {
			
		    	if( $_POST["newProperty"][$i] == 'date' ){
		    		
					print "<hr><h3>AddValueDate</h3>";
					$newObject = $adb->AddValueDate( $newObjectId, $property[$i], $propertyValue[$i] );
					print '<blockquote>$newObject = $adb->AddValueDate( '. $newObjectId .', '. $property[$i] .', "'. $propertyValue[$i] .'" );</blockquote>';
					print "<pre>";
					print_r( $newObject );
					print "</pre>";
					
		    	} else if( $_POST["newProperty"][i] == 'number' ){
		    		
					print "<hr><h3>AddValueInt</h3>";
					print '<blockquote>$newObject = $adb->AddValueNumber( '. $newObjectId .', '. $property[$i] .', "'. $propertyValue[$i] .'" );</blockquote>';
					
					$newObject = $adb->AddValueNumber( $newObjectId, $property[$i], $propertyValue[$i] );
					print "<pre>";
					print_r( $newObject );
					print "</pre>";
					
		    	} else if( $_POST["newProperty"][i] == 'text' ){
		    		
					print "<hr><h3>AddValueText</h3>";
					$newObject = $adb->AddValueText( $newObjectId, $property[$i], $propertyValue[$i] );
					print '<blockquote>$newObject = $adb->AddValueText( '. $newObjectId .', '. $property[$i] .', "'. $propertyValue[$i] .'" );</blockquote>';
					print "<pre>";
					print_r( $newObject );
					print "</pre>";
					
		    	} else {
					print "<hr><h3>WHAT TYPE IS THAT?!</h3>";
				}
				
	
			}
		break;
}

?>

