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
			if($val=='||') {
				echo json_encode(array("locations"=>array())); 
			} else {
				$vals = explode('||', trim($val,"||"));
				$tmp = array();
				foreach ($vals as $v) {
					$f = new Facility();
	//				 get Facilities that have material $val
					$facilities = $f->getFacilitiesByMaterialId( $v );
					foreach ($facilities as $f) {
						$tmp[] = serialize(array(	'company' =>$f['company'], 
													'first_name' =>$f['first_name'], 
													'last_name' =>$f['last_name'], 
													'email' =>$f['email'], 
													'job_title' =>$f['job_title'], 
													'business_phone' =>$f['business_phone'], 
													'home_phone' =>$f['home_phone'], 
													'mobile_phone' =>$f['mobile_phone'], 
													'fax_number' =>$f['fax_number'], 
													'address_1' =>$f['address_1'], 
													'address_2' =>$f['address_2'], 
													'city' =>$f['city'], 
													'state_province' =>$f['state_province'], 
													'zip_postal_code' =>$f['zip_postal_code'], 
													'region' =>$f['region'], 
													'country' =>$f['country'], 
													'website' =>$f['website'], 
													'attachments' =>$f['attachments'], 
													'broker_exclusive' =>$f['broker_exclusive'], 					
													'category' =>$f['category'], 					
													'lat' =>$f['lat'], 
													'lon' =>$f['lon'], 
													'id' =>$f['id'])); 
					}
				}
	
				if( count($tmp) < 1) {
					echo json_encode(array("locations"=>array()));
					exit;
				}
				$tmp = array_unique($tmp);
				$op = array();
				foreach ($tmp as $o) {
					$op[] = unserialize($o);
				}
				foreach ( $op as $key => $row ) {
				    $names[$key]  = $row['company']; 
				    // of course, replace 0 with whatever is the date field's index
				}
				
				array_multisort($names, SORT_ASC, $op);
				
				echo json_encode(array("locations"=>$op)); 
			}
			exit; 
			
			break;
		
		case 'getRequests':
			$val = ( isset($_GET['uid']) ) ? $_GET['uid'] : null;
			$requestReturnArray = array();
			$requestClass = null;
			
			if($val){
				$scrapperClass = new Scrapper();
				$scrapperByUserId = $scrapperClass->getScrappersByUserId( $val );
				
				if( count( $scrapperByUserId ) > 0 ){
					$scrapperClass->GetItemObj( $scrapperByUserId[0]['id'] );
					
					$requestReturnArray = $scrapperClass->getRequests();
					
					// sorting object array by created_ts date DESC
					$dates = array();					
					foreach ( (array) $requestReturnArray as $key => $row ) {
					    $dates[$key] = $row->created_ts;
					}
					
					array_multisort($dates, SORT_DESC, $requestReturnArray);
				}
				
				print json_encode( $requestReturnArray ); 
			} else {
				$requestClass = new Request();
				$requestReturnArray = $requestClass->getAllRequests();
				print json_encode( $requestReturnArray ); 
			}
			
			break;
		
		case 'addBid':
			
			$post_data = $_GET;
			/*
			 * transport_cost=123.00&material_price=3.00&ship_date=2011-12-03 03:22:12&arrival_date=2011-12-03 03:22:12&notes=This is a note&join_request=123&join_transportation_type=123&join_broker=123
			 */
//			$transport_cost = $post_data['transport_cost'];
//			$material_price = $post_data['material_price'];
//			$ship_date = $post_data['ship_date'];
//			$arrival_date = $post_data['arrival_date'];
//			$notes = $post_data['notes'];
			//$join_request = $post_data['join_request'];
			//$join_transportation_type = $post_data['join_transportation_type'];
			//$join_broker = $post_data['join_broker'];
			$b = new Bid();
			$hi = $b->CreateItem($post_data);
			
			break;
	}
?>