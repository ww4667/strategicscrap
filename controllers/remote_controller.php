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
		
		case 'get-market-data':
			
					$cache_file = $_SERVER['DOCUMENT_ROOT']."/cache/new-market-data.cache";
					$last = filemtime($cache_file);
				    $now = time();
				    $interval = 30; //seconds
				    // check the cache file
    			    $day = date("D",$last);
				    $hour_minute = date("Gi",$last);
    				if ( (!$last || ( $now - $last ) > $interval) && ($day != "Sat" || $day != "Sun") && ($hour_minute >= 740 || $hour_minute <= 1340) ) {
						// cached file is missing or too old, refreshing it
						$sss = new Scrapper();
						$live_market_data = $sss->getMarketData(1,1);
						//print_r($live_market_data);
						// check for good feed
						$test = $live_market_data->cash[0];
						if ( !empty($test) ) {
							$cache_content = json_encode($live_market_data);
					        if ( $cache_content ) {
					            // we got something back
					            $cache_static = fopen($cache_file, 'wb');
					            fwrite($cache_static, $cache_content);
					            fclose($cache_static);
					        }
							
						}
					}
					$market_json = json_decode(file_get_contents($cache_file));
					$market_data_timestamp = date("M d, Y, h:ia",filemtime($cache_file))." CST (delayed)";
					
					include($_SERVER['DOCUMENT_ROOT']."/views/scrappers/scrap_market_data.php");
			
			break;
		
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
			 
			if ( isset( $_POST['ship_date'] ) ) {
				
				$post_data = $_POST;
				// need to do some cleanup and validation first
				// let's drop the data in the db
				$r = new Request();
				$r->CreateItem( $post_data );
				$request = $r->GetItemObj( $r->newId );
				$request->status = "0";
//				$request->expiration_date = (strtotime("+14 days", strtotime($request->created_ts)) > strtotime("-2 days", strtotime($request->ship_date))) ? 
//													date("Y-m-d H:i:s", strtotime("-2 days", strtotime($request->ship_date))) : 
//													date("Y-m-d H:i:s", strtotime("+14 days", strtotime($request->created_ts)));
				$request->expiration_date = (strtotime("+30 days", strtotime($request->created_ts)) > strtotime("0 days", strtotime($request->ship_date))) ? 
													date("Y-m-d H:i:s", strtotime("1 days", strtotime($request->ship_date))) :
													date("Y-m-d H:i:s", strtotime("+30 days", strtotime($request->created_ts)));
				$request->UpdateItem();
				// attach facility, scrapper and material to the request
				$request->addFacility( $post_data['facility_id'] );
				// we have the user id so... technically this is attaching a user id not a scrapper id
				// will have to see how this affects the system
				$request->addScrapper( $post_data['user_id'] );
				$request->addMaterial( $post_data['material_id'] );
				
				// get user, scrapper, material, request
				$json = array();
				$crud = new Crud();				
			
				$fields_from = array("from_address_1", "from_address_2", "from_city", "from_state_province", "from_postal_code", "from_work_phone", "from_fax_number");
				foreach ($fields_from as $f){ 
	        		$from[$f] =  $post_data[$f];
	        	 }
				
				if($post_data["edit_from_information"]) {
				 	$json["from"] = $from;
				}
				
				$fields_to = array("to_company", "to_address_1", "to_address_2", "to_city", "to_state_province", "to_zip_postal_code", "to_country");
				foreach ($fields_to as $f){ 
	        		$to[str_replace("to_", "", $f)] =  $post_data[$f];
	        	}
				
				if($post_data["edit_to_information"]) {
					$json["to"] = $to;
				}
				 
				$json['scrapper'] = $crud->GetItem( $post_data['user_id'] );
				$json['facility'] = (($post_data['facility_id'] == 0) ? $to : $crud->GetItem( $post_data['facility_id'] ));
				$json['material'] = $crud->GetItem( $post_data['material_id'] );
				$json['request'] = $crud->GetItem( $r->newId );
				
				// assemble into json string
				$request->request_snapshot = json_encode( $json );

				// save to the request
				$request->UpdateItem();
				//$crud->PTS($json);
				//$crud->PTS($post_data);
				print '{message:"The request was successful",success:true}';
				
			} else {
				print '{message:"The information for the request is incomplete.",success:false}';
			}
			break;
			
			
		/* add requests */
		case 'addRequestOld':
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
				$request->status = "0";
//				$request->expiration_date = (strtotime("+14 days", strtotime($request->created_ts)) > strtotime("-2 days", strtotime($request->ship_date))) ? 
//													date("Y-m-d H:i:s", strtotime("-2 days", strtotime($request->ship_date))) : 
//													date("Y-m-d H:i:s", strtotime("+14 days", strtotime($request->created_ts)));
				$request->expiration_date = (strtotime("+30 days", strtotime($request->created_ts)) > strtotime("0 days", strtotime($request->ship_date))) ? 
													date("Y-m-d H:i:s", strtotime("1 days", strtotime($request->ship_date))) :
													date("Y-m-d H:i:s", strtotime("+30 days", strtotime($request->created_ts)));
				$request->UpdateItem();
				// attach facility, scrapper and material to the request
				$request->addFacility( $post_data['facility_id'] );
				// we have the user id so... technically this is attaching a user id not a scrapper id
				// will have to see how this affects the system
				$request->addScrapper( $post_data['user_id'] );
				$request->addMaterial( $post_data['material_id'] );
				
				// get user, scrapper, material, request
				$json = array();
				$crud = new Crud();
				$json['scrapper'] = $crud->GetItem( $post_data['user_id'] );
				$json['facility'] = $crud->GetItem( $post_data['facility_id'] );
				$json['material'] = $crud->GetItem( $post_data['material_id'] );
				$json['request'] = $crud->GetItem( $r->newId );
				
				// assemble into json string
				$request->request_snapshot = json_encode( $json );

				// save to the request
				$request->UpdateItem();
				
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
            /* used in output */
			$temp_request = new Request();
			/* if we have a user of scrapper then we will do this... broker is further down */
			if( $scrapperId ){
				$scrapperClass = new Scrapper();
				$scrapperByUserId = $scrapperClass->getScrappersByUserId( $scrapperId );
				
				if( count( $scrapperByUserId ) > 0 ){
					$scrapperClass->GetItemObj( $scrapperByUserId[0]['id'] );
					
					$requestReturnArray = $scrapperClass->getRequests();
					
					// sorting object array by created_ts date DESC
					$dates = array();					
					foreach ( $requestReturnArray as $key => $row ) {
					    $dates[$key] = $row['created_ts'];
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
								
									
	                          
	                          $status_array = $temp_request->getStatusArray();
	                          $status = ( !empty($request->status) ? $status_array[ $request->status ] : $status_array[0] );
	                          
	                          $count_display = ( $request->bid_unread && $request->bid_unread != 0 ? '<strong>' : '' ) . 
	                          					( !empty($request->bid_count) ? '(' . $request->bid_count . ')' : '(0)' ) . 
	                          					( $request->bid_unread && $request->bid_unread != 0 ? '</strong>' : '' );
								
								$output .= 	'<tr class="scrapQuote" id="request_' . $counter. '" requestCount="'.$counter.'" requestId="' . $request->id . '">' . 
											"	<td>" .
											( !empty( $request->expiration_date ) ? date ( 'Y-m-d', strtotime($request->expiration_date) ) : 'not set' ) . '<br />'  .
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
											'<strong>Delivery Date: </strong>' . ( !empty( $request->arrive_date ) ? date ( 'Y-m-d', strtotime($request->arrive_date) ) : 'not set' ) . '<br />' .
											"	</td>" .
											"	<td>" .
											date ( 'Y-m-d', strtotime($request->created_ts) ) . '<br />' .
											"	</td>" .
											
											"	<td>" .
											$status . '<br />' .
											"	</td>" .
											
											"	<td>" .
											$count_display . '<br />' .
											"	</td>" .
											"</tr>";
								$off = !$off;
								$counter++;
							}
							
							/* add output to session */
							$_SESSION['user']['requests'] = $outputArray ;
							
							print $output;
							
						break;      
            case 'data_tables':
		 		$dttmp = array();
                $dttmp["aaData"] = array();
                $count = count($requestReturnArray);
                $status_array = $temp_request->getStatusArray();
				
                    for($i = 0 ; $i < $count; $i++ ){
                          $request = $requestReturnArray[$i];
                          if ($request['archived'] == 1) {
                          $archive = '<span requestId="' . $request['id'] . '" style="display:none">hidden</span>';
                          } else {
                          $archive = '<span requestId="' . $request['id'] . '"><a class="archive" title="archive request">archive</a></span>';
                          }
                          $expires = '<span requestId="' . $request['id'] . '">' . ( !empty( $request['expiration_date'] ) ? date ( 'Y-m-d', strtotime( $request['expiration_date'] ) ) : 'not set' ) . '<br /></span>';
                          $description = (  $request['request_snapshot']['facility'] && 
                                          $request['request_snapshot']['facility'] != '' && 
                                          count( $request['request_snapshot']['facility'] ) > 0 ?
                                            '<strong>Ship to:</strong> ' .$request['request_snapshot']['facility']['company'] . '<br>' : 
                                            '<strong>Ship to:</strong><br>' ) . 
                                          (   $request['request_snapshot']['material'] && 
                                            $request['request_snapshot']['material'] != '' && 
                                            count( $request['request_snapshot']['material'] ) > 0 ?
                                              '<strong>Material:</strong> ' . $request['request_snapshot']['material']['name'] . '<br>' : 
                                              '<strong>Material:</strong><br>' ) . 
                                          '<strong>Volume: </strong>' . ( !empty( $request['volume'] ) ? $request['volume'] : '0' ) . '<br />' .
                                          '<strong>Delivery Date: </strong>' . ( !empty( $request['arrive_date'] ) ? date ( 'Y-m-d', strtotime( $request['arrive_date'] ) ) : 'not set' ) . '<br />';
                                          
                          $created = date ( 'Y-m-d', strtotime( $request['created_ts'] ) ) . '<br />';
                          
                          $status = ( !empty( $request['status'] ) ? $status_array[ $request['status'] ] : $status_array[0] );
                          
                          $count_display = ( $request['bid_unread'] && $request['bid_unread'] != 0 ? '<strong>' : '' ) . 
                          				( !empty( $request['bid_count'] ) ? '(' . $request['bid_count'] . ')' : '(0)' ) . 
                          				( $request['bid_unread'] && $request['bid_unread'] != 0 ? '</strong>' : '' );
                          
                          $ttemp = array();
                          $ttemp[] = $archive;
                          $ttemp[] = $expires;
                          $ttemp[] = $description;
                          $ttemp[] = $created;
                          $ttemp[] = $status;
                          $ttemp[] = $count_display;
                          $dttmp["aaData"][] = $ttemp;
                    }
                   $theJson =  json_encode( $dttmp );                  
             	print $theJson;
				$_SESSION['user']['requests'] = $requestReturnArray ;
             die();            
          break;
					default:
						$_SESSION['user']['requests'] = $requestReturnArray ;
						print json_encode( $requestReturnArray ); 
				}
				
			/* the following is for a broker */
			} elseif( $brokerId ) {
				
				$bidClass = new Bid();
				$requestClass = new Request();
//				$requestReturnArray = $requestClass->getAllRequests();
			
				$brokerClass = new Broker();
				$brokerByUserId = $brokerClass->getBrokersByUserId( $brokerId );
				
				if( count( $brokerByUserId ) > 0 ){
					$brokerClass->GetItemObj( $brokerByUserId[0]['id'] );
					
					// lets get the broker bids first
					$bidReturnArray = $brokerClass->getBids();
					// lets make a custom query to grab unquoted requests
					$requestReturnArray = $brokerClass->getUnbidRequests();
					
//					$counter = 0; 
//					$counter2 = 0;
//					$count = count( $bidReturnArray );
//					$count2 = count( $requestReturnArray );
//					$currentBid = null;
//					$bidId = null;
//					$currentRequest = null;
//					$arrayOfIdsToRemove = array();
//					$arrayOfBids = array();
					
					/* get bids from current user - build temp array */
//					while( $counter < $count ){
//						$currentBid = $bidReturnArray[ $counter ];
//						$arrayOfBids[ $currentBid->join_request[0]['id'] ] = true;
//						$counter++; 
//					}
//					
//					$counter2 = 0;
//					$count2 = count($requestReturnArray);
					
					/* remove items the broker already has bidded on */
//					while( $counter2 < $count2 ){
//						
//						if(isset($requestReturnArray[$counter2])){
//							$currentRequest = $requestReturnArray[$counter2];
//							
//							if( isset($arrayOfBids[ $currentRequest->id ] ) ){
//								unset($requestReturnArray[$counter2]); 
//							}	
//						}
//						$counter2++;
//					}
				}
				 
				// sorting object array by created_ts date DESC
				$dates = array();					
				foreach ( (array) $requestReturnArray as $key => $row ) {
				    $dates[$key] = $row['created_ts'];
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
											( !empty( $request->expiration_date ) ? date ( 'Y-m-d', strtotime($request->expiration_date) ) : 'not set' ) . '<br />'  .
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
											'<strong>Arrival Date: </strong>' . ( !empty( $request->arrive_date ) ? date ( 'Y-m-d', strtotime($request->arrive_date) ) : 'not set' ) . '<br />' .
											"	</td>" .
											"	<td>" .
											date ( 'Y-m-d', strtotime($request->created_ts) ) . '<br />' .
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
            case 'data_tables':
				
            $dttmp = array();
            $dttmp["aaData"] = array();
            $dttmp["request_object"] = array();
            $outputArray = array();
                    $count = count($requestReturnArray);
	                    for($i = 0 ; $i < $count; $i++ ){
							  //$snapshotJSON = '{"to":{"to_address_1":"2050 Center Ave","to_address_2":"Suite 250","to_city":"Fort Lee","to_state_province":"NJ","to_postal_code":"07024"},"from":{"from_address_1":"20456 SW Stonegate Dr","from_address_2":null,"from_city":"Ankeny","from_state_province":"IA","from_postal_code":"50023","from_work_phone":"(515) 344-4367","from_fax_number":""},"scrapper":{"id":"105","created_ts":"2010-11-16 22:45:36","updated_ts":"2011-04-27 10:37:27","object_name_id":"4","join_user":null,"first_name":"Greg","last_name":"Crown","mobile_phone":"(515) 238-8359","home_phone":null,"work_phone":"(515) 344-4367","address_1":"204 SW Stonegate Dr","address_2":null,"city":"Ankeny","state_province":"IA","postal_code":"50023","country":"United States","notes":"my notes are here... I can update","account_settings":null,"fax_number":null,"company":"My Cool Company","status":null,"subscription_start_date":null,"subscription_end_date":"2011-02-09 00:00:00","subscription_type":"paid"},"facility":{"id":"266","created_ts":"2010-12-16 10:54:11","updated_ts":"2010-12-16 11:02:07","object_name_id":"1","company":"CMC Cometals","last_name":"Buzby","first_name":"Seth","email":"opr@cmc.com","job_title":null,"business_phone":"(201) 302-0888","home_phone":null,"mobile_phone":null,"fax_number":"(201) 302-9911","address_1":"2050 Center Ave","address_2":"Suite 250","city":"Fort Lee","state_province":"NJ","zip_postal_code":"07024","region":"NE","country":"United States","website":"http:\/\/www.cmc.com","notes":null,"attachments":null,"category":"Exporter","broker_exclusive":null,"join_material":null,"lat":"40.8530984","lon":"-73.9713408"},"material":{"id":"53","created_ts":"2010-10-27 10:24:15","updated_ts":null,"object_name_id":"2","name":"Iron Ore"},"request":{"id":"819","created_ts":"2011-04-27 10:43:45","updated_ts":"2011-04-27 10:43:45","object_name_id":"6","bid_type":null,"arrive_date":"2011-04-29 00:00:00","ship_date":"2011-04-27 00:00:00","expiration_date":"2011-04-28 00:00:00","transportation_type":null,"volume":"678","special_instructions":"asdfasdf","join_scrapper":null,"join_facility":null,"join_material":null,"locked":null,"bid_count":null,"bid_unread":null,"status":"0","request_snapshot":null,"archived":null}}';
	                          $request = $requestReturnArray[$i];
	                    	 	//$bidClass->PTS($request);
	                          $request['request_snapshot'] = json_decode($request['request_snapshot'], true);
	                          //$request['request_snapshot'] = json_decode($request[$snapshotJSON], true);
	                          $facility = $request['request_snapshot']['facility'];
	                          $material = $request['request_snapshot']['material'];
	                          $outputArray[] = $request;
	                          $expires = '<span id="request_' . $i. '" requestId="' . $request['id'] . '" requestCount="'.$i.'" >' . ( !empty( $request['expiration_date'] ) ? date ( 'Y-m-d', strtotime( $request['expiration_date'] ) ) : 'not set' ) . '<br /></span>';
	                          $description = (  $facility && 
	                        $facility != '' && 
	                        count( $facility ) > 0 ?
	                          '<strong>Ship to:</strong> ' . $facility['company'] . '<br>' : 
	                          '<strong>Ship to:</strong><br>' ) . 
	                      (   $material && 
	                        $material != '' && 
	                        count( $material ) > 0 ?
	                          '<strong>Material:</strong> ' . $material['name'] . '<br>' : 
	                          '<strong>Material:</strong><br>' ) . 
	                      '<strong>Volume: </strong>' . ( !empty( $request['volume'] ) ? $request['volume'] : '0' ) . '<br />' .
	                      '<strong>Arrival Date: </strong>' . ( !empty( $request['arrive_date'] ) ? date ( 'Y-m-d', strtotime( $request['arrive_date'] ) ) : 'not set' ) . '<br />';
	                                          
	                          $created = date ( 'Y-m-d', strtotime( $request['created_ts'] ) ) . '<br />';
	                          
	                          $button = '<a class="quote" href="#" title="quote this request" requestId="' . $request['id'] . '">quote</a>';
	                          
	                          $ttemp = array();
	                          $ttemp[] = $expires;
	                          $ttemp[] = $description;
	                          $ttemp[] = $created;
	                          $ttemp[] = $button;
	                          $dttmp["aaData"][] = $ttemp;
	                          $dttmp["id"][] = $request['id'];
	                      
	                    }	
                   $dttmp["request_object"][] = $outputArray;
                   $theJson =  json_encode( $dttmp );                  
             print $theJson;
             die();            
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
				
					if( isset( $post_data['join_scrapper'] ) ) $requestClass->sendBidAlert( $post_data['join_scrapper'] );
					
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
					
					/* update status property of request*/
					$requestStatus = $requestClass->ReadPropertyByName("status");
					if( isset( $requestStatus['id'] ) ){
						if( !$requestClass->UpdateValueNumber( $post_data['join_request'], $requestStatus['id'], 1  ) ){
							$requestClass->AddValueNumber( $post_data['join_request'], $requestStatus['id'], 1  );
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
				$bid = $b->acceptBid($bidId);
				if ($bid) {
					print '{"success": "true"}';
				} else {
					print '{"success": "false"}';
				}
			}
			break;
			
		/* set request as archived */
		case 'archiveRequest':
			$requestId = !isset( $_controller_remote_request_id ) ? !isset( $_GET['request_id'] ) ? null : $_GET['request_id'] : $_controller_remote_request_id;
			if ($requestId != null) {
				$r = new Request();
				$r->GetItemObj( $requestId );
				$r->archived = 1;
				if ( $r->UpdateItem() ) {
					print '{"success": "true"}';
				} else {
					print '{"success": "false"}';
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
//						$expireTS = strtotime("-2 days", strtotime($val['ship_date']));
						$expireTS = strtotime("1 days", strtotime($val['ship_date']));
						$nowTS = time();
						if (!$expireTS > $nowTS) {
							unset($bids[$key]);
							$bid->status = "expired";
						}
						$bid->read = 1;
						$bid->UpdateItem();
					}
					if (!empty($bids)){
						print json_encode( $bids );
					} else {
						print json_encode( array() );
					}
				} else {
					print json_encode( array() );
				}
			} else {
				print json_encode( array() );
			}
			break; 
			
		/* return all bids */
		case 'getBids': 
	
			$val = $_controller_remote_userId;
			$bidReturnArray = array();
			$bidClass = null;
			$bidSplitArray = array();
			$temp_bid = new Bid();
			
			if($val){
				$brokerClass = new Broker();
				$brokerByUserId = $brokerClass->getBrokersByUserId( $val );
				
				if( count( $brokerByUserId ) > 0 ){
					$brokerClass->GetItemObj( $brokerByUserId[0]['id'] );
					
					$bidReturnArray = $brokerClass->getBids();
					$bids = new Bid();
					$bidSplitArray = $bids->splitBidsByStatus( $bidReturnArray );
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
				case 'tabs':
					
					break;
				case 'html':
						$bidReturnArray = $bidSplitArray['waiting'];
						$counter = 0;
						$count = count( $bidReturnArray );
						$output = "";
						$off = false;
						foreach( $bidReturnArray as $bid ){
							$output .= 	'<tr class="scrapBid" bidId="' . $bid->id . '">' . 
										"	<td>" .
										( !empty( $bid->status ) ? $bid->status : 'waiting' ) . '<br />'  .
										"	</td>" .
										"	<td>" .
										( 	!empty( $bid->join_facility ) && 
											count( $bid->join_facility ) > 0 ?
												'<strong>Ship from:</strong> ' . ( isset($bid->join_facility[0] ) && isset( $bid->join_facility[0]['company'] ) ? $bid->join_facility[0]['company'] : 'no company name' ) . '<br>' : 
												'<strong>Ship from:</strong><br />' ) . 
										( 	$bid->join_scrapper && 
											$bid->join_scrapper != '' && 
											count( $bid->join_scrapper ) > 0 ?
												'<strong>Ship to:</strong> ' . ( isset($bid->join_scrapper[0] ) && isset( $bid->join_scrapper[0]['company'] ) ? $bid->join_scrapper[0]['company'] : 'no company name' ) . '<br>' : 
												'<strong>Ship to:</strong><br />' ) . 
										( 	$bid->join_material && 
											$bid->join_material != '' && 
											count( $bid->join_material ) > 0 ?
												'<strong>Material:</strong> ' . ( isset($bid->join_material[0] ) && isset( $bid->join_material[0]['name'] ) ? $bid->join_material[0]['name'] : 'material name' ) . '<br>' : 
												'<strong>Material:</strong><br />' ) . 
										( 	!empty( $bid->join_request ) && 
											count( $bid->join_request ) > 0 ?										
										'<strong>Volume: </strong>' . ( isset( $bid->join_request[0] ) && isset( $bid->join_request[0]['volume'] ) ? $bid->join_request[0]['volume'] : '0' ) . '<br />' :
										'<strong>Volume: </strong><br />' ) .
										'<strong>Ship Date: </strong>' . ( !empty( $bid->ship_date ) ? date ( 'Y-m-d', strtotime($bid->ship_date) ) : 'not set' ) . '<br />' .
										'<strong>Arrival Date: </strong>' . ( !empty( $bid->arrival_date ) ? date ( 'Y-m-d', strtotime($bid->arrival_date) ) : 'not set' ) . '<br />' .
										"	</td>" .
										"	<td>" .
										date ( 'Y-m-d', strtotime($bid->created_ts) ) . '<br />' .
										"	</td>" .
										"</tr>";
							$off = !$off;
							
						}
						
						$_SESSION['user']['bids'] = $bidReturnArray ;
						
						print $output;
					break;          
				case 'data_tables':
                  $counter = 0;
                  $count = count( $bidReturnArray );
                  $output = "";
                  $off = false;
                  $dttmp = array();
                  $dttmp["aaData"] = array();
                  $dttmp["bid_object"] = array();
                  $outputArray = array();
                  $status_array = $temp_bid->getStatusArray();
                  for($i = 0 ; $i < $count; $i++ ){
                  	
                        $bid = $bidReturnArray[$i];
                        $bid['request_snapshot'] = json_decode($bid['request_snapshot'], true);
                        $outputArray[] = $bid;
                        $facility = $bid['request_snapshot']['facility'];
                        $material = $bid['request_snapshot']['material'];
                        $scrapper = $bid['request_snapshot']['scrapper'];
                        $request = $bid['request_snapshot']['request'];
						
                        $status = '<span bidId="' . $bid['id']  . '" bidCount="'.$i.'" >' . ( !empty($bid['status']) ? $status_array[ $bid['status'] ] : $status_array[0] ) . '</span>';
                        
                        $description = (   !empty( $scrapper ) && 
                                count( $scrapper ) > 0 ?
                                  '<strong>Ship from:</strong> ' . ( isset( $scrapper ) && isset( $scrapper['company'] ) ? $scrapper['company'] : 'no company name' ) . '<br>' : 
                                  '<strong>Ship from:</strong><br>' ) . 
                              (   $facility && 
                                $facility != '' && 
                                count( $facility ) > 0 ?
                                  '<strong>Ship to:</strong> ' . ( isset( $facility ) && isset( $facility['company'] ) ? $facility['company'] : 'no company name' ) . '<br>' : 
                                  '<strong>Ship to:</strong><br>' ) . 
                              (   $material && 
                                $material != '' && 
                                count( $material ) > 0 ?
                                  '<strong>Material:</strong> ' . ( isset( $material ) && isset( $material['name'] ) ? $material['name'] : 'material name' ) . '<br>' : 
                                  '<strong>Material:</strong><br>' ) . 
							( 	!empty( $request ) && 
								count( $request ) > 0 ?										
							'<strong>Volume: </strong>' . ( isset( $request ) && isset( $request['volume'] ) ? $request['volume'] : '0' ) . '<br />' :
							'<strong>Volume: </strong><br />' ) .
                              '<strong>Transport Cost: </strong>' . ( !empty( $bid['transport_cost'] ) ? '$' . $bid['transport_cost'] : 'not set' ) . '<br />' .
                              '<strong>Ship Date: </strong>' . ( !empty( $bid['ship_date'] ) ? date ( 'Y-m-d', strtotime($bid['ship_date']) ) : 'not set' ) . 
                              '&nbsp;&nbsp;<strong>Arrival Date: </strong>' . ( !empty( $bid['arrival_date'] ) ? date ( 'Y-m-d', strtotime($bid['arrival_date']) ) : 'not set' ) . '<br />';
                         
                        $created = $bid['created_ts'];
                        $ttemp = array();
                        $ttemp[] = $status;
                        $ttemp[] = $description;
                        $ttemp[] = $created;
                        $dttmp["aaData"][] = $ttemp;
                    
                  }
                 $dttmp["bid_object"][] = $outputArray;
                 $theJson =  json_encode( $dttmp );
                 $testJson = '{["aaData": ["col1", "col2", "col3"],["col1", "col2", "col3"]]}';
           print $theJson;
           die();            
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
					
					if($request['id'] == $requestId) break;
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
			
		case 'forgotPassword':
		$u = new User();

		if( isset($_GET['email'])) {
			include_once($_SERVER['DOCUMENT_ROOT'].'/models/Mailer.php');
			$post_data = $_GET;
			$clean_data = array();
			foreach($post_data as $key => $val) {
				$clean = trim($val);
				$clean_data[$key] = $clean;
			}
			//check if user exists and send email
			$result = $u->ForgotPassword($clean_data["email"]);

			if($result) {
				$json = '{ "result": { "status" : 1,"message": "Instructions have been sent to your email address, please use the link to reset your password."} }';
				
				//flash($msg, "");
				//$PAGE_BODY = "forgot_password.php";

			} else {
				$json = '{ "result": { "status" : 0,"message": "Your email address is not found in our system - <span class = \'forgot_try_again\'>Try again</span>"} }';
				
				
				//flash($msg, "bad");
				//$PAGE_BODY = "forgot_password.php";
			}
			
			print $json;
			
		} else {
			
			//$PAGE_BODY = "forgot_password.php";
			/* which file to pull into the template */
		}
			//require (thisFullPath . "/views/layouts/shell.php");
			break;
	}
}


?>