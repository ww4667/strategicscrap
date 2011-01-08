<?php

ini_set('display_errors', 1); 
ini_set('log_errors', 1);
 
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ALL);


require_once($_SERVER['DOCUMENT_ROOT']."/gir/core/models/crud/Crud.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gir/modules/request/Request.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gir/modules/bid/Bid.php");


if( !empty($_GET['session_id']) ) session_id($_GET['session_id']);
if(!isset($_SESSION)) session_start();

require_once($_SERVER['DOCUMENT_ROOT']."/gir/index.php");
// Check if called from the application or not
//if ($_SESSION['app'] != "app name") {
//	return false;
//}

/**
 * If you are loading this via a url, pass the parameters via GET
 * If you are loading this through an include, then set the $_controller_remote_included to true,
 * 	set the other paramters needed through the variables listed below and include this file
 */
if( empty( $_controller_remote_included ) ) controller_remote();

function controller_remote( $_controller_remote_method = null, 
							$_controller_remote_type = null, 
							$_controller_remote_materialArray = null, 
							$_controller_remote_userId = null, 
							$_controller_remote_brokerId = null, 
							$_controller_remote_included = null ){
								
	if( empty( $_controller_remote_included ) ){
	
		$_controller_remote_method = isset( $_GET['method'] ) ? trim( $_GET['method'] ) : null;
		$_controller_remote_type = isset( $_GET['type'] ) ? trim( $_GET['type'] ) : 'json';
		$_controller_remote_materialArray = ( isset($_GET['mats']) ) ? $_GET['mats'] : null;
		$_controller_remote_userId = ( isset( $_GET['uid'] ) ) ? $_GET['uid'] : null;
		$_controller_remote_brokerId = ( isset( $_GET['buid'] ) ) ? $_GET['buid'] : null;
	
	}
	
	//$key = $_GET['key'];
	//$_SESSION[$key]
	/**
	 * TODO: Add Keys for these cases so people cant access them outside without proper permissions
	 */
	switch($_controller_remote_method){
		
		/* SCRAP EXCHANGE DATA CALL **************************************** */
		case 'filter-material':
			if( $_controller_remote_materialArray ){
				if( $_controller_remote_materialArray == '||' ) {
					print json_encode(array("locations"=>array())); 
				} else {
					$vals = explode( '||', trim( $_controller_remote_materialArray, "||" ) );
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
														'notes' =>$f['notes'], 
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
					
					print json_encode(array("locations"=>$op)); 
				}
				exit; 
			}
			
			break;
			
			
		/* add requests */
		case 'addRequest':
			/**\
			 * TODO: add error handling
			 */
			if ( isset( $_POST['ship_date'] ) ) {
				
				$post_data = $_POST;
				// need to do some cleanup and validation first
				// let's drop the data in the db
				$r = new Request();
				$r->CreateItem( $post_data );
				$request = $r->GetItemObj( $r->newId );
				$request->expiration_date = (strtotime("+14 days", strtotime($request->created_ts)) > strtotime("-2 days", strtotime($request->ship_date))) ? date("Y-m-d H:i:s", strtotime("-2 days", strtotime($request->ship_date))) : date("Y-m-d H:i:s", strtotime("+14 days", strtotime($request->created_ts)));
				$request->UpdateItem();
				// attach facility, scrapper and material to the request
				$request->addFacility( $post_data['facility_id'] );
				// we have the user id so... technically this is attaching a user id not a scrapper id
				// will have to see how this affects the system
				$request->addScrapper( $post_data['user_id'] );
				$request->addMaterial( $post_data['material_id'] );
				
				print '{message:"The request was successful",success:true}';
				
			} else {
				print '{message:"The information for the request is incomplete.",success:false}';
			}
			
			break;
			
		/* returns requests */
		case 'getRequests':
			/* determines if the user is for a user or not */
			$scrapperId = $_controller_remote_userId;
			
			/* determines if the user is for a broker or not */
			$brokerId = $_controller_remote_brokerId;
			/*  */
			/* request return array */
			$requestReturnArray = array();
			$requestClass = null;
			
			/* if we have a user of scrapper then we will do this... broker is further down */
			if( $scrapperId ){
				$scrapperClass = new Scrapper();
				$scrapperByUserId = $scrapperClass->getScrappersByUserId( $scrapperId );
				
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
				
				switch( $_controller_remote_type ) {
					case 'html':
							$counter = 0;
							$count = count( $requestReturnArray );
							$output = "";
							$off = false;
							$outputArray = array();
							foreach( $requestReturnArray as $request ){
								$outputArray[] = $request;
								$output .= 	'<tr class="scrapQuote" id="request_' . $counter. '" requestCount="'.$counter.'" requestId="' . $request->id . '">' . 
											"	<td>" .
											( !empty( $request->expiration_date ) ? $request->expiration_date : 'not set' ) . '<br />'  .
											"	</td>" .
											"	<td>" .
											( 	$request->join_facility && 
												$request->join_facility != '' && 
												count( $request->join_facility ) > 0 ?
													'<strong>Ship to:</strong> ' . $request->join_facility[0]['company'] . '<br>' : 
													'<strong>Ship to:</strong><br>' ) . 
											( 	$request->join_material && 
												$request->join_material != '' && 
												count( $request->join_material ) > 0 ?
													'<strong>Material:</strong> ' . $request->join_material[0]['name'] . '<br>' : 
													'<strong>Material:</strong><br>' ) . 
											'<strong>Volume: </strong>' . ( !empty( $request->volume ) ? $request->volume : '0' ) . '<br />' .
											'<strong>Delivery Date: </strong>' . ( !empty( $request->arrive_date ) ? $request->arrive_date : 'not set' ) . '<br />' .
											"	</td>" .
											"	<td>" .
											$request->created_ts . '<br />' .
											"	</td>" .
											( $request->bid_unread && $request->bid_unread != 0 ? '<td style="font-weight: 900;">' : '<td>' ) . 
											'	' . ( !empty($request->bid_count) ? '(' . $request->bid_count . ')' : 'waiting' ) . 
											"	</td>" .
											"</tr>";
								$off = !$off;
								$counter++;
							}
							
							/* add output to session */
							$_SESSION['user']['requests'] = $outputArray ;
							
							print $output;
							
						break;
					default:
						$_SESSION['user']['requests'] = $requestReturnArray ;
						print json_encode( $requestReturnArray ); 
				}
				
			/* the following is for a broker */
			} elseif( $brokerId ) {
				
				$requestClass = new Request();
				$requestReturnArray = $requestClass->getAllRequests();
			
				$brokerClass = new Broker();
				$brokerByUserId = $brokerClass->getBrokersByUserId( $brokerId );
				
				if( count( $brokerByUserId ) > 0 ){
					$brokerClass->GetItemObj( $brokerByUserId[0]['id'] );
					
					$bidReturnArray = $brokerClass->getBids();
					
					$counter = 0; 
					$counter2 = 0;
					$count = count( $bidReturnArray );
					$count2 = count( $requestReturnArray );
					$currentBid = null;
					$bidId = null;
					$currentRequest = null;
					$arrayOfIdsToRemove = array();
					$arrayOfBids = array();
					
					/* get bids from current user - build temp array */
					while( $counter < $count ){
						$currentBid = $bidReturnArray[ $counter ];
						$arrayOfBids[ $currentBid->join_request[0]['id'] ] = true;
						$counter++; 
					}
					
					$counter2 = 0;
					$count2 = count($requestReturnArray);
					
					/* remove items the broker already has bidded on */
					while( $counter2 < $count2 ){
						
						if(isset($requestReturnArray[$counter2])){
							$currentRequest = $requestReturnArray[$counter2];
							
							if( isset($arrayOfBids[ $currentRequest->id ] ) ){
								unset($requestReturnArray[$counter2]); 
							}	
						}
						$counter2++;
					}
				}
				 
				// sorting object array by created_ts date DESC
				$dates = array();					
				foreach ( (array) $requestReturnArray as $key => $row ) {
				    $dates[$key] = $row->created_ts;
				}
				
				array_multisort($dates, SORT_DESC, $requestReturnArray);
				
				switch( $_controller_remote_type ) {
					case 'html':
							$counter = 0;
							$count = count( $requestReturnArray );
							$output = "";
							$off = false;
							$outputArray = array();
							foreach( $requestReturnArray as $request ){
								$outputArray[] = $request;
								$output .= 	'<tr class="scrapQuote" id="request_' . $counter. '" requestCount="'.$counter.'" requestId="' . $request->id . '">' . 
											"	<td>" .
											( !empty( $request->expiration_date ) ? $request->expiration_date : 'not set' ) . '<br />'  .
											"	</td>" .
											"	<td>" .
											( 	$request->join_facility && 
												$request->join_facility != '' && 
												count( $request->join_facility ) > 0 ?
													'<strong>Ship to:</strong> ' . $request->join_facility[0]['company'] . '<br>' : 
													'<strong>Ship to:</strong><br>' ) . 
											( 	$request->join_material && 
												$request->join_material != '' && 
												count( $request->join_material ) > 0 ?
													'<strong>Material:</strong> ' . $request->join_material[0]['name'] . '<br>' : 
													'<strong>Material:</strong><br>' ) . 
											'<strong>Volume: </strong>' . ( !empty( $request->volume ) ? $request->volume : '0' ) . '<br />' .
											'<strong>Arrival Date: </strong>' . ( !empty( $request->arrive_date ) ? $request->arrive_date : 'not set' ) . '<br />' .
											"	</td>" .
											"	<td>" .
											$request->created_ts . '<br />' .
											"	</td>" .
											"	<td>" .
											'		<a class="quote" href="#" title="quote this request" requestId="' . $request->id . '">quote</a>' .
											"	</td>" .
											"</tr>";
								$off = !$off;
								$counter++;
							}
							$output .= '<script type="text/javascript"> var request_object = ' . json_encode( $outputArray ) . ';</script>';
							
							$_SESSION['user']['requests'] = $outputArray ;
							
							print $output;
						break;
					default:
						$_SESSION['user']['requests'] = $requestReturnArray ;
						print json_encode( $requestReturnArray ); 
				}
					
				
			}
			
			break;
		
		case 'addBid':
			
			$post_data = $_POST;
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
			/**
			 * VALIDATE BROKER
			 * TODO: make sure we do not have duplicate quotes
			 */
			if(isset($post_data['join_broker'])){
				$join_broker = $post_data['join_broker'];
				$brokerClass = new Broker();
				$brokerArray = $brokerClass->getBrokersByUserId($join_broker);
				if( count($brokerArray) > 0 && isset($brokerArray[0]['id']) ){
					$post_data['join_broker'] = $brokerArray[0]['id'];
					$bidClass = new Bid();
					$newBid = $bidClass->CreateItem($post_data);
					/**
					 * Associate Request 
					 * TODO: need to validate if this is a duplicate 
					 */
					
					$requestClass = new Request();
					
					$bidCountProperty = $requestClass->ReadPropertyByName("bid_count");

					$bidCount = (int) $requestClass->GetValueNumber( $post_data['join_request'], $bidCountProperty['id'] );

					if( isset( $bidCountProperty['id'] ) ){
						if( !$requestClass->UpdateValueNumber( $post_data['join_request'], $bidCountProperty['id'], $bidCount+1  ) ){
							$requestClass->AddValueNumber( $post_data['join_request'], $bidCountProperty['id'], $bidCount+1  );
						}
					}
					
					$bidUnreadProperty = $requestClass->ReadPropertyByName("bid_unread");
					if( isset( $bidUnreadProperty['id'] ) ){
						if( !$requestClass->UpdateValueNumber( $post_data['join_request'], $bidUnreadProperty['id'], 1  ) ){
							$requestClass->AddValueNumber( $post_data['join_request'], $bidUnreadProperty['id'], 1  );
						}
					}
				}
			}
			
			break;
			
		/* set bid as accepted */
		case 'acceptBid':
			$bidId = !isset( $_controller_remote_bid_id ) ? !isset( $_GET['bid_id'] ) ? null : $_GET['bid_id'] : $_controller_remote_bid_id;
			if ($bidId != null) {
				$b = new Bid();
				$bid = $b->GetItemObj($bidId);
				// check for expiration of request
				if ( $request->expiration_date > date("Y-m-d H:i:s") ) {
					// set bid status to accepted
					
					// set all other bids to rejected
				} else {
					// lock request since it was expired
				}
			}
			break;
			
		/* return bids by request id */
		case 'getBidsByRequestId':
			$requestId = !isset( $_controller_remote_request_id ) ? !isset( $_GET['request_id'] ) ? null : $_GET['request_id'] : $_controller_remote_request_id;
			if ($requestId != null) {
				$r = new Request();
				$request = $r->GetItemObj($requestId);
				$request->bid_unread = 0;
				$request->UpdateItem();
				// check for expiration of request
				if ( !$request->IsExpired() ) {
					$bids = $request->getBids();
					// weed out expired bids due to ship date
					foreach ($bids as $key => $val) {
						$b = new Bid();
						$bid = $b->GetItemObj($val['id']);
						$expireTS = strtotime("-2 days", strtotime($val['ship_date']));
						$nowTS = time();
						if (!$expireTS > $nowTS) {
							unset($bids[$key]);
							$bid->status = "expired";
						}
						$bid->read = 1;
						$bid->UpdateItem();
					}
					if (!empty($bids))
						print json_encode( $bids );
				}
			}
			break; 
			
		/* return all bids */
		case 'getBids': 
	
			$val = $_controller_remote_userId;
			$bidReturnArray = array();
			$bidClass = null;
			
			if($val){
				$brokerClass = new Broker();
				$brokerByUserId = $brokerClass->getBrokersByUserId( $val );
				
				if( count( $brokerByUserId ) > 0 ){
					$brokerClass->GetItemObj( $brokerByUserId[0]['id'] );
					
					$bidReturnArray = $brokerClass->getBids();
					/*
					// sorting object array by created_ts date DESC
					$dates = array();					
					foreach ( (array) $bidReturnArray as $key => $row ) {
					    $dates[$key] = $row->created_ts;
					}
					
					array_multisort($dates, SORT_DESC, $bidReturnArray);*/
				}
				
			} else {
				$bidClass = new Bid();
				$bidReturnArray = $bidClass->getAllBids();
			}
			
			switch( $_controller_remote_type ) {
				case 'html':
						$counter = 0;
						$count = count( $bidReturnArray );
						$output = "";
						$off = false;
						foreach( $bidReturnArray as $bid ){
							$output .= 	'<tr class="scrapBid" requestId="' . $bid->id . '">' . 
										"	<td>" .
										( !empty( $bid->status ) ? $bid->status : 'waiting' ) . '<br />'  .
										"	</td>" .
										"	<td>" .
										( 	!empty( $bid->join_facility ) && 
											count( $bid->join_facility ) > 0 ?
												'<strong>Ship from:</strong> ' . ( isset($bid->join_facility[0] ) && isset( $bid->join_facility[0]['company'] ) ? $bid->join_facility[0]['company'] : 'no company name' ) . '<br>' : 
												'<strong>Ship from:</strong><br>' ) . 
										( 	$bid->join_scrapper && 
											$bid->join_scrapper != '' && 
											count( $bid->join_scrapper ) > 0 ?
												'<strong>Ship to:</strong> ' . ( isset($bid->join_scrapper[0] ) && isset( $bid->join_scrapper[0]['company'] ) ? $bid->join_scrapper[0]['company'] : 'no company name' ) . '<br>' : 
												'<strong>Ship to:</strong><br>' ) . 
										( 	$bid->join_material && 
											$bid->join_material != '' && 
											count( $bid->join_material ) > 0 ?
												'<strong>Material:</strong> ' . ( isset($bid->join_material[0] ) && isset( $bid->join_material[0]['name'] ) ? $bid->join_material[0]['name'] : 'material name' ) . '<br>' : 
												'<strong>Material:</strong><br>' ) . 
										'<strong>Volume: </strong>' . ( !empty( $bid->volume ) ? $bid->volume : '0' ) . '<br />' .
										'<strong>Ship Date: </strong>' . ( !empty( $bid->ship_date ) ? $bid->ship_date : 'not set' ) . '<br />' .
										'<strong>Arrival Date: </strong>' . ( !empty( $bid->arrive_date ) ? $bid->arrive_date : 'not set' ) . '<br />' .
										"	</td>" .
										"	<td>" .
										$bid->created_ts . '<br />' .
										"	</td>" .
										"</tr>";
							$off = !$off;
							
						}
						
						$_SESSION['user']['bids'] = $bidReturnArray ;
						
						print $output;
					break;
				default:
					$_SESSION['user']['bids'] = $bidReturnArray ;
					print json_encode( $bidReturnArray ); 
			}
			break;
		case 'sessionDump':
			print session_id();
			print "<pre>";
			print_r( $_SESSION );
			print "</pre>";
			break;
		case 'getRequestsFromSession':
			$requestId = empty( $_controller_remote_request_id ) ? empty( $_GET['request_id'] ) ? null : $_GET['request_id'] : $_controller_remote_request_id;

			if(!empty($requestId)){
				foreach( $_SESSION['user']['requests'] as $request ){
					
					if($request->id == $requestId) break;
				}
				print json_encode( $request );
			} else { 
				print json_encode( $_SESSION['user']['requests'] );
			} 
			break;
		case 'getBidsFromSession':
			$bidId = empty( $_controller_remote_bid_id ) ? empty( $_GET['bid_id'] ) ? null : $_GET['bid_id'] : $_controller_remote_bid_id;
			
			if(!empty($bidId)){
				foreach( $_SESSION['user']['bids'] as $bid ){
					
					if($bid->id == $bidId) break;
				}
				print json_encode( $bid );
			} else { 
				print json_encode( $_SESSION['user']['bids'] );
			} 
			break;
	}
}


?>