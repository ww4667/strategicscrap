<?php

ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ALL);

if(!isset($_SESSION)) session_start();

require_once($_SERVER['DOCUMENT_ROOT']."/gir/index.php");

// Check if called from the application or not
//if ($_SESSION['app'] != "app name") {
//	return false;
//}

$method = trim($_GET['method']);
//$key = $_GET['key'];
//$_SESSION[$key]

	switch($method){
		
		/* SCRAP EXCHANGE DATA CALL **************************************** */
		case 'filter-material':
			$val = ( isset($_GET['val']) ) ? $_GET['val'] : null;
			$vals = explode('||', trim($val,"||"));
			$tmp = array();
			foreach ($vals as $v) {
				$f = new Facility();
//				 get Facilities that have material $val
				$facilities = $f->getFacilitiesByMaterialId( $v );
				foreach ($facilities as $f) {
					$tmp[] = serialize(array('name' =>$f['company'], 'lat' =>$f['lat'], 'lon' =>$f['lon'], 'id' =>$f['id'])); 
				}
			}
			if( count($tmp) < 1) {
				echo json_encode(array("Locations"=>array()));
				exit;
			}
			$tmp = array_unique($tmp);
			$op = array();
			foreach ($tmp as $o) {
				$op[] = unserialize($o);
			}
			foreach ($op as $key => $row) {
			    $names[$key]  = $row['name']; 
			    // of course, replace 0 with whatever is the date field's index
			}
			
			array_multisort($names, SORT_ASC, $op);
			
			echo json_encode(array("Locations"=>$op)); 
			exit; 
		break;

	}
?>