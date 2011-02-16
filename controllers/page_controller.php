<?php
if(!isset($_SESSION)){
	session_start();
}

require_once($_SERVER['DOCUMENT_ROOT']."/gir/index.php");
//$auth = new Auth();

//$KILL = FALSE;
//
//while (!$KILL) {

	switch($controller_action){
		
		/* HOMEPAGE FOR SCRAPPERS **************************************** */
		case 'my-homepage':
			require_ssl();
			
			// page 'template variables'
			$PAGE_BODY = "views/my_homepage.php";  	/* which file to pull into the template */
			
			$content = "my homepage poop";
			
	/*
	 * 
	 * symbols being used
	 * CU AM NI ZZ LD TN || HG
	 * 
	 */		
			
			function getComexData($symbol,$type = null) {
				$xignite_header = new SoapHeader('http://www.xignite.com/services/', 'Header', array("Username" => "greg@slashwebstudios.com"));
				$client = new soapclient('http://www.xignite.com/xFutures.asmx?WSDL', array('trace' => 1));
				$client->__setSoapHeaders(array($xignite_header));
				
				switch ($type) {
					case 'strip':
						// create an array of parameters 
						$param = array(
						               'Symbol' => $symbol,
						               'StripType' => "EighteenMonth"
									   );
						// call the service, passing the parameters and the name of the operation 
						$result = $client->GetDelayedFutureStrip($param);
						// assess the results 
						if (is_soap_fault($result) && isset($_GET['xml'])) {
						     echo '<h2>Fault</h2><pre>';
						     print_r($result);
						     echo '</pre>';
						} elseif (isset($_GET['xml'])) {
							print_r($result);
							$comex = array("cash"=>number_format($result->GetDelayedFutureResult->Last,2));
							print_r($comex);
						}
					break;
					
					default:
						// create an array of parameters 
						$param = array(
						               'Symbol' => $symbol,
						               'Day' => "0",
						               'Month' => "0",
						               'Year' => date('Y')
									   );
						// call the service, passing the parameters and the name of the operation 
						$result = $client->GetDelayedFuture($param);
						// assess the results 
						if (is_soap_fault($result) && isset($_GET['xml'])) {
						     echo '<h2>Fault</h2><pre>';
						     print_r($result);
						     echo '</pre>';
						} else {
							$comex = array("cash"=>number_format($result->GetDelayedFutureResult->Last,2));
							return $comex;
						}
					break;
				}
			}
			
			function getLmeData($symbol,$type = null) {
				$xignite_header = new SoapHeader('http://www.xignite.com/services/', 'Header', array("Username" => "FDFDBEAF9B004b2eBB2D7A9D1D39F24F"));
				$client = new soapclient('http://lmemetals.xignite.com/xLMEMetals.asmx?WSDL', array('trace' => 1));
				$client->__setSoapHeaders(array($xignite_header));
				
				switch ($type) {
					case 'strip':
						// create an array of parameters 
						$param = array(
						               'Symbol' => $symbol,
						               'CurrencyType' => "USD",
						               'StripTypes' => "EighteenMonth"
									   );
						// call the service, passing the parameters and the name of the operation 
						$result = $client->GetDelayedFutureStripForMetal($param);
						// assess the results 
						if (is_soap_fault($result) && isset($_GET['xml'])) {
						     echo '<h2>Fault</h2><pre>';
						     print_r($result);
						     echo '</pre>';
						} else {
							$result = (array) $result->GetDelayedFutureStripForMetalResult->FutureQuote;
							$lme = array(	"cash"=>number_format($result[0]->Last/2204.62262,2),
											"3 month"=>number_format($result[2]->Last/2204.62262,2),
											"15 month"=>number_format($result[14]->Last/2204.62262,2)
							);
							return $lme;
						}
					break;
					
					default:
						// create an array of parameters 
						$param = array(
						               'Symbol' => $symbol,
						               'CurrencyType' => "USD",
						               'Day' => date('d'),			// can't be zero
						               'Month' => date('m'),			// can't be zero
						               'Year' => date('Y')			// can't be zero
									   );
						// call the service, passing the parameters and the name of the operation 
						$result = $client->GetDelayedFuture($param);
						// assess the results 
						if (is_soap_fault($result) && isset($_GET['xml'])) {
						     echo '<h2>Fault</h2><pre>';
						     print_r($result);
						     echo '</pre>';
						} else {
							$lme = array("cash"=>$result->GetDelayedFutureResult->Last);
							return $lme;
						}
					break;
				}
			}
			
//			$market_data = array(
//				"LME Copper" => getLmeData("CU","strip"),
//				"LME Aluminium" => getLmeData("AM","strip"),
//				"LME Nickel" => getLmeData("NI","strip"),
//				"LME Zinc" => getLmeData("ZZ","strip"),
//				"LME Lead" => getLmeData("LD","strip"),
//				"LME Tin" => getLmeData("TN","strip"),
//				"COMEX Copper" => getComexData("HG")
//			);
$cache_file = $_SERVER['DOCUMENT_ROOT']."/cache/static-market-data.cache";
$feed_url = "http://strategicscrap.com/static-market-data";
$test_market_data = get_cached_file($cache_file, 900, $feed_url);

$market_data = json_decode($test_market_data,true);
$market_data_timestamp = date("M d, Y, h:ia",filemtime($cache_file))." CST";

//			$market_data = array(
//				"LME Copper" => array("cash" => "4.23","3 month" => "4.25","15 month" => "4.13"),
//				"LME Aluminium" => array("cash" => "1.07","3 month" => "1.09","15 month" => "1.11"),
//				"LME Nickel" => array("cash" => "11.54","3 month" => "11.69","15 month" => "11.25"),
//				"LME Zinc" => array("cash" => "1.04","3 month" => "1.05","15 month" => "1.06"),
//				"LME Lead" => array("cash" => "1.13","3 month" => "1.10","15 month" => "1.08"),
//				"LME Tin" => array("cash" => "12.15","3 month" => "12.24","15 month" => "11.88"),
//				"COMEX Copper" => array("cash" => "4.26","3 month" => "4.28","15 month" => "4.21")
//			);
			
//			if (isset($_GET['xml'])) {
//				echo '<h2>Market Data</h2><pre>';
//				print_r($market_data);
//				echo '</pre>';
//			}
			
			// region setup
			if ( $region == "ne" ) {
				$zipcode = 10292; // New York
			} elseif ( $region == "c" ) {
				$zipcode = 60601; // Chicago
			} elseif ( $region == "w" ) {
				$zipcode = 92101; // San Diego
			} elseif ( $region == "s" ) {
				$zipcode = 77299; // Houston
			} elseif ( $region == "se" ) {
				$zipcode = 39901; // Atlanta
			}
			if ( $region == "c") {
				$p = new Pricing();
				$pricing_array = $p->getPricingByRegion(strtoupper($region));
				$pricing = array();
				foreach ($pricing_array as $val) {
					$p = new Pricing();
					$price = $p->GetItemObj($val['id']);
					$price->getMaterials();
					$pricing[] = $price;
				}
				$pricing_timestamp = date("M d, Y, h:ia",strtotime($price->created_ts))." CST";
//				print "<pre>";
//				var_dump($pricing);
//				print "</pre>";
			}
			// ping feedburner
			$url1 = 'http://feedburner.google.com/fb/a/pingSubmit?bloglink=http://feeds.feedburner.com/StrategicScrapRssBusinessNews';
			$data1 = file_get_contents( $url1,null,null,null,10 );
			$url2 = 'http://feedburner.google.com/fb/a/pingSubmit?bloglink=http://feeds.feedburner.com/StrategicScrapRssMetalNews';
			$data2 = file_get_contents( $url2,null,null,null,10 );
			// grab weather data
			$request_url = "http://xoap.weather.com/weather/local/$zipcode?cc=*&dayf=5&link=xoap&prod=xoap&par=1182592015&key=bd35fd8b6e181b8a";
			$xml = simplexml_load_file($request_url) or die("feed not loading");
			$weather = $xml->xpath('//weather');
			$weather = $weather[0];
			
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
//			die();
		break;
		
		/* Scrap Classifieds */
		case 'scrap-classifieds':
			// page 'template variables'
			$PAGE_BODY = "views/scrap_classifieds.php";  	/* which file to pull into the template */			
			
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;


		/* Equipment Classifieds */
		case 'equipment-classifieds':
			// page 'template variables'
			$PAGE_BODY = "views/equipment_classifieds.php";  	/* which file to pull into the template */			
			
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Regions */
		case 'regions':
			require_ssl();
			// page 'template variables'
			$PAGE_BODY = "views/regions.php";  	/* which file to pull into the template */			
			
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Scrap Exchange */
		case 'scrap-exchange':
			require_ssl();
			if(!$gir->auth->authenticate()){
				$message = array();
				$message[] = "You are not logged in. Please login or register to use this feature.";
				flash($message,'bad');
//				$url = "/scrap-exchange";
//				redirect_to($url);
				print "<p>You are not logged in. Please login or register to use this feature.</p>";
			} else {
	//			$auth->setApplication('strategicscrap');
	//			$auth->setUserGroup('scrapper');
				// page 'template variables'
//				if($_GET['fix']) {
//				} else {
//				}
//					$PAGE_BODY = "views/scrappers/scrap_exchange_new.php";  	/* which file to pull into the template */
				$PAGE_BODY = "views/scrappers/scrap_exchange_fix.php";  	/* which file to pull into the template */
				$f = new Facility();
				$facilities = $f->GetAllItemsObj();
				$m = new Material();
				$materials = $m->GetAllItemsObj();
				// alphabetize the materials array
				$name_array = array();
				foreach ($materials as $val) {
					$name_array[] = $val->name;
				}
				array_multisort($name_array,$materials);
				if(isset($_GET['gir'])) { // use for testing stuff
					if ( isset( $_GET['edit'] ) && isset( $_GET['fid'] ) ) {
						if ( isset( $_POST['fac_save_btn'] ) ) {
							$f->UpdateItem($_POST);
							echo "updated record " . $_POST['id'];
						}
						$facility = $f->GetItem( $_GET['fid'] );
						?><form action="" method="post"><ul><?
						foreach ($facility as $key => $val) { ?>
						<li>
							<label><?=$key?></label>
							<input type="text" name="<?=$key?>" value="<?=$val?>" />
						</li>
						<? }
						?><li><input name="fac_save_btn" type="submit" value="Update" /></li></ul></form><?
					} elseif ( isset($_GET['add_material']) ) {
						$m = new Material();
						if ( isset($_POST['submit_add_material']) ) {
							$post_data = $_POST;
							foreach ($post_data as $key => $val) {
								$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
							}
							$itemId = $m->CreateItem($post_data);
							if($itemId)
								echo "success!";
							else
								echo "material not added...";
						}
						$attributes = $m;
						print_r($attributes);
						$PAGE_BODY = "views/materials/add_material.php";  	/* which file to pull into the template */
					} elseif ( isset($_GET['add_transportation_type']) ) {
						$m = new Transportation_Type();
						if ( isset($_POST['submit_add_transportation_type']) ) {
							$post_data = $_POST;
							foreach ($post_data as $key => $val) {
								$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
							}
							$itemId = $m->CreateItem($post_data);
							if($itemId)
								echo "success!";
							else
								echo "transportation not added...";
						}
						$attributes = $m;
						print_r($attributes);
						$PAGE_BODY = "views/transportation_type/add_transportation_type.php";  	/* which file to pull into the template */
					} elseif ( isset($_GET['add_facility']) ) {
						if ($_POST['address_1'] != "") {
							$address = $_POST['address_1'];
							$address .= ", ".$_POST['address_2'];
							$address .= ", ".$_POST['city'];
							$address .= ", ".$_POST['state_province'];
							$address .= " ".$_POST['zip_postal_code'];
							$address .= ", ".$_POST['country'];
							$address = urlencode($address);
						} else {
							$address = urlencode("204 SW Stonegate Dr, Ankeny, IA");
						}
						$url = 'http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false';
						$data = file_get_contents( $url );
						$results = json_decode($data);
						$results = $results->results[0];
						echo "<pre>";
						print_r($results->geometry->location);
						echo "</pre>";
						if ($_POST['address_1']) {
							$post_data = $_POST;
							$post_data['lat'] = $results->geometry->location->lat;
							$post_data['lon'] = $results->geometry->location->lng;
							// fix data
							// trim first
							foreach ($post_data as $key => $val) {
								$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
							}
							// fix phone numbers
							$post_data['business_phone'] = format_phone($post_data['business_phone']);
							$post_data['home_phone'] = format_phone($post_data['home_phone']);
							$post_data['mobile_phone'] = format_phone($post_data['mobile_phone']);
							$post_data['fax_number'] = format_phone($post_data['fax_number']);
							// create the facility
							$itemId = $f->CreateItem($post_data);
							$facility = $f->GetItemObj($itemId);
							foreach ($post_data['materials_array'] as $m) {
								$facility->addMaterial($m);
							}
							echo "success!";
						}
						$attributes = $f;
						$PAGE_BODY = "views/facilities/add_facility.php";  	/* which file to pull into the template */
						if ( isset($_POST['submit_add_facility']) ) {
							print_r($post_data);
						}
					}
				}
				//the layout file  -  THIS PART NEEDS TO BE LAST
				require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
			}
		break;

		/* Transport Material */
		case 'transport-material':
			require_ssl();
			// page 'template variables'
			$PAGE_BODY = "views/scrappers/transport_material.php";  	/* which file to pull into the template */			
			
			
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Registration (home) */
		case 'register':
			require_ssl();
			//include_once($_SERVER['DOCUMENT_ROOT'].'/models/Mailer.php');

			// page 'template variables'
			$PAGE_BODY = "views/reg_form.php";  	/* which file to pull into the template */
						
			if(isset($_POST['email'])) {
				// CLEAN DATA
				$fields['name'] = $_POST['name'];
				$fields['company'] = $_POST['company'];
				$fields['email'] = $_POST['email'];
				$fields['created_ts'] = date("Y-m-d H:i￼:s");
				// COMMIT DATA TO DB
				$intotable = 'scrap_registration';
				$modx->db->insert($fields, $intotable);
				// SET THANK YOU PAGE
				$PAGE_BODY = "views/reg_thanks.php";  	/* which file to pull into the template */
			}
			
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Introduction (home) */
		case 'intro':
			// page 'template variables'
//			$PAGE_BODY = "views/intro_screen.php";  	/* which file to pull into the template */
//			if(isset($_GET['new']))
			$PAGE_BODY = "views/intro_screen_newer.php";  	/* which file to pull into the template */
			
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Broker Dashboard */
		case 'broker-dashboard':
			require_ssl();
			if( !$gir->auth->authenticate() || $_SESSION['user']['group'] != "broker" ){
				$message = array();
				$message[] = "You need to be logged in as a broker to use this feature.";
				flash($message,'bad');
			} else {
				$brokerClass = new Broker();
				$brokerByUserId = $brokerClass->getBrokersByUserId( $_SESSION['user']['id'] );
				if( count( $brokerByUserId ) > 0 ){
					$brokerClass->GetItemObj( $brokerByUserId[0]['id'] );
					$bidsArray = $brokerClass->getSimpleBids();
					$bidClass = new Bid();
					$splitBids = array();
					$splitBids = $bidClass->splitBidsByStatus($bidsArray);
				}
				// page 'template variables'
				$PAGE_BODY = "views/brokers/dashboard.php";  	/* which file to pull into the template */
				//the layout file  -  THIS PART NEEDS TO BE LAST
				require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
			}
		break;

		/* Broker Dashboard :: quote manager */
		case 'broker-quote-manager':
			require_ssl();
			$brokerClass = new Broker();
			$brokerByUserId = $brokerClass->getBrokersByUserId( $_SESSION['user']['id'] );
			if( count( $brokerByUserId ) > 0 ){
				$brokerClass->GetItemObj( $brokerByUserId[0]['id'] );
				$bidsArray = $brokerClass->getSimpleBids();
				$bidClass = new Bid();
				$splitBids = array();
				$splitBids = $bidClass->splitBidsByStatus($bidsArray);
			}
			// page 'template variables'
			$PAGE_BODY = "views/brokers/quotes.php";  	/* which file to pull into the template */
						
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Broker Dashboard :: request manager */
		case 'broker-request-manager':
			require_ssl();
			$brokerClass = new Broker();
			$brokerByUserId = $brokerClass->getBrokersByUserId( $_SESSION['user']['id'] );
			if( count( $brokerByUserId ) > 0 ){
				$brokerClass->GetItemObj( $brokerByUserId[0]['id'] );
				$bidsArray = $brokerClass->getSimpleBids();
				$bidClass = new Bid();
				$splitBids = array();
				$splitBids = $bidClass->splitBidsByStatus($bidsArray);
			}
			// page 'template variables'
			$PAGE_BODY = "views/brokers/requests.php";  	/* which file to pull into the template */
						
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Pricing Form */
		case 'pricing-form':
			require_ssl();
			// include any models that might be needed
			include_once('models/Price.php');
			// page 'template variables'
			$PAGE_BODY = "views/brokers/pricing.php";  	/* which file to pull into the template */
			// the below line was for live testing only
//			if(isset($_GET['test'])&&isset($_POST['agree'])){ // use this for the live "testing" form: send "test" in the get
			if(isset($_POST['agree'])){ // use this for the live form
				foreach ($_POST['entry'] as $key => $val) {
					$_POST['entry'][$key]['name']=$_POST['name'];
					$_POST['entry'][$key]['company']=$_POST['company'];
					$_POST['entry'][$key]['region']=Price::set_region($_POST['entry'][$key]['state']);
					if(Price::create($_POST['entry'][$key])){
						$message="Your entry was added successfully!";
					}else{
						$error=true;
						$message="There were problems completing your request.";
					}
				}
			}

		/* Broker Pricing Form */
		case 'broker-pricing-form':
			require_ssl();
			// include any models that might be needed
			include_once('models/Price.php');
			include_once('models/pricing/Broker.php');
			include_once('models/pricing/Material.php');
			include_once('models/pricing/Facility.php');
			include_once('models/pricing/Entry.php');
			// page 'template variables'
//			$PAGE_BODY = "views/brokers/pricing/form_mock.php";  	/* which file to pull into the template */
//			if(isset($_GET['nnn']))
			$PAGE_BODY = "views/brokers/pricing/login.php";  	/* which file to pull into the template */			

			if(isset($_GET['logout'])){
				unset($_SESSION['broker']);
				redirect_to('/broker-pricing-form');
			}

			if(isset($_SESSION['broker'])) {
				$PAGE_BODY = "views/brokers/pricing/form.php";  	/* which file to pull into the template */
							
				$broker = unserialize($_SESSION['broker']);
				
				$facilities = PricingFacility::getByBrokerId($broker->id);
				//bolt on materials to facility objects
				foreach ($facilities as $f) {
					$materials = PricingMaterial::getRecentMaterialsByFacilityIdAndBrokerId($f->id, $broker->id);
					if (!$materials)
						$materials = PricingMaterial::getMaterialsByFacilityId($f->id);
					$f->materials = $materials;
				}
				$materials = PricingMaterial::retrieve_all();
			}
			
			if(isset($_POST['password'])){
				// see if this is a valid login
				$email = trim(strtolower($_POST['email']));
				$password = $_POST['password'];
				$broker = PricingBroker::login($email,$password);
				if($broker){
					$_SESSION['broker'] = serialize($broker);
					redirect_to('/broker-pricing-form');
				} else {
					$error=true;
					$message="Your email/password combination could not be found. Try again.";
				}
			}

			if(isset($_SESSION['broker'])&&isset($_POST['agree'])){
				// setup POST data for db entry
				$data = array();
				$data['facility_id'] = $_POST['facility']['id'];
				$data['broker_id'] = $_POST['broker']['id'];
				$data['entry_timestamp'] = date("Y-m-d H:i￼:s");
				$entries = $_POST['entry']['facility_'.$data['facility_id']];
				foreach ($entries as $key=>$val) {
					if(trim($val) != ""){
						$data['material_id'] = $key;
						$data['price'] = $val;
						if(PricingEntry::create($data)){
							$message="Your entry was added successfully!";
						}else{
							$error=true;
							$message="There were problems completing your request.";
						}
					}
				}
			}
						
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;
		
		/* SCRAP LOGIN **************************************** */
		case 'scrap-login':
			require_ssl();
			$error_messages = array();
			
			if ( (isset($_POST['username']) && $_POST['username'] != "") && (isset($_POST['password']) && $_POST['password'] != "") ) {
				$username = trim($_POST['username']);
				$password = trim($_POST['password']);
				// snag matching user(s)
				$u = new User();
				$users = $u->GetItemsObjByPropertyValue('email', $username);
				if ( !empty($users) ) {
					$user = $users[0];
					// get joins for users
					$groups = array("Scrapper","Broker");
					foreach ( $groups as $g ) {
						$obj = new $g();
						$joins = $obj->ReadForeignJoins( $user );
						print_r($joins);
						if( count($joins) > 0 ) {
							$obj->Login( $username, $password );
							break;
						}
					}
					// send to page based on obj type
					switch ($_SESSION['user']['group']) {
						case 'scrapper':
//							$error_messages[] = "Welcome!";
//							flash($error_messages);
							redirect_to('/regions');
						break;
						
						case 'broker':
//							$error_messages[] = "Welcome!";
//							flash($error_messages);
							redirect_to('/broker-admin/dashboard');
						break;
						
						default:
							$error_messages[] = "Wrong username or password.";
							$_SESSION['sign-in-error'] = true;
							redirect_to('/');
						break;
					}
				}
			}
			
			$error_messages[] = "Wrong username or password.";
			$_SESSION['sign-in-error'] = true;
			redirect_to('/');
			
			//the layout file  -  THIS PART NEEDS TO BE LAST
//			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;
		
		/* SCRAP LOGOUT **************************************** */
		case 'scrap-logout':
			$error_messages = array();
			if ($gir->auth->authenticate()) {
				$u = new User();
				if ( $u->Logout() ) {
					$error_messages[] = "You have been logged out successfully.";
//					flash($error_messages);
				}
			}
			redirect_to('/');

			//the layout file  -  THIS PART NEEDS TO BE LAST
//			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;
		
		/* REGISTER **************************************** */
		case 'scrap-registration':
			require_ssl();
			include_once($_SERVER['DOCUMENT_ROOT'].'/models/Mailer.php');
			//include_once($_SERVER['DOCUMENT_ROOT'].'/models/Mailer.php');
			$SUBSCRIPTION_DURATION = "+1 year";
			$PROMOTION = "+60 days";
			$PAGE_BODY = "views/registration/signup_form.php";  	/* which file to pull into the template */
			if(isset($_SESSION['post_data_'.$controller_action])) {
				$post_data = $_SESSION['post_data_'.$controller_action];
				unset($_SESSION['post_data_'.$controller_action]);
			} else {
				$post_data = isset($_POST['email']) ? $_POST : "";
			}
			if ( isset($_POST['try_it']) ) {
				if (trim($_POST['name']) != "") {
					if ( preg_match('/\s/',trim($_POST['name'])) > 0 ) {
						$name_array = preg_split("/[\s,]+/",$_POST['name']);
						$post_data['first_name'] = $name_array[0];
						$post_data['last_name'] = $name_array[1];
					} else {
						$post_data['first_name'] = trim($_POST['name']);
					}
				}
			} else if ( isset($_POST['email']) && !isset($_POST['try_it']) ) {
				$error_messages = array();
				foreach ($_POST as $key => $val) {
					$post_data[$key] = trim($val);
				}
				// let's validate this data first!
				// all fields should have data in them so we need only check for email dups and format_phone($phone)
				if( $post_data['first_name'] == "" )
					$error_messages[] = "First Name field cannot be left empty.";
				if( $post_data['last_name'] == "" )
					$error_messages[] = "Last Name field cannot be left empty.";
				$post_data['email'] = strtolower($post_data['email']);
				$u = new User();
				$users = $u->GetItemsObjByPropertyValue( 'email', $post_data['email'] );
				if( $post_data['email'] == "" )
					$error_messages[] = "Email field cannot be left empty.";
				elseif( !isValidEmail($post_data['email']) )
					$error_messages[] = "Email field must contain a valid email address.";
				elseif( count($users) > 0 )
					$error_messages[] = "Email is already being used.";
				if( $post_data['password'] == "" )
					$error_messages[] = "Password field cannot be left empty.";
				if( $post_data['verify_password'] != $post_data['password'] )
					$error_messages[] = "Verify Password does not match Password field.";
//				$post_data['work_phone'] = format_phone($post_data['work_phone']);
//				if( strlen($post_data['work_phone']) != 14 )
//					$error_messages[] = "Phone field must have 10 digits.";
//				if( $post_data['state_province'] == "" )
//					$error_messages[] = "State/Province selection missing.";
//				if( !isZip($post_data['postal_code']) )
//					$error_messages[] = "Zip Code cannot be empty.";
				// setup the new user!
				if(count($error_messages) == 0) {
					$post_data['salt'] = $u->GetSalt($post_data['email']);
					$post_data['password'] = $u->SetPassword($post_data['password'], $post_data['salt']);
					$u = new User();
					$newUser = $u->CreateItem($post_data); 
					if ( $newUser && !isset($_GET['broker']) ) {
						$post_data['subscription_start_date'] = date("Y-m-d 00:00:00",strtotime("+1 day",time()));
						// promotion check
						if ( isset($PROMOTION) && !empty($PROMOTION) ) {
							$post_data['subscription_type'] = $PROMOTION;
							$post_data['subscription_end_date'] = date("Y-m-d 00:00:00",strtotime($PROMOTION,strtotime($post_data['subscription_start_date'])));
						} else {
							$post_data['subscription_type'] = $SUBSCRIPTION_DURATION;
							$post_data['subscription_end_date'] = date("Y-m-d 00:00:00",strtotime($SUBSCRIPTION_DURATION,strtotime($post_data['subscription_start_date'])));
						}
						$post_date['status'] = 'ACTIVE';
						// setup the new scrapper!
						$s = new Scrapper();
						$newScrapper = $s->CreateItem($post_data);
						$scrapper = $s->GetItemObj($newScrapper->newId);
						$scrapper->addUser($newUser->newId);
						// send welcome email to user
						$object['fname'] = $scrapper->first_name;
						$object['lname'] = $scrapper->last_name;
						$object['email'] = $newUser->email;
						Mailer::welcome_email($object);
//						flash("Welcome to Strategic Scrap! You have successfully been registered. Use the sign-in form above to get started.");
						redirect_to('/');
//						die(print_r($scrapper));
					} else {
						// setup the new broker!
						$b = new Broker();
						$newBroker = $b->CreateItem($post_data);
						$broker = $b->GetItemObj($newBroker->newId);
						$broker->addUser($newUser->newId);
//						flash("Welcome to Strategic Scrap! You have successfully been registered. Use the sign-in form above to get started.");
						redirect_to('/');
//						die(print_r($broker));
					}
				} else {
					flash($error_messages,'bad');
					$_SESSION['post_data_'.$controller_action] = $post_data;
					redirect_to('/scrap-registration');
//					die("Hmmmm. something didn't work right.");
				}
			}
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;
		
		/* MY ACCOUNT SETTINGS **************************************** */
		case 'my-account':
			require_ssl();
			if(!$gir->auth->authenticate()){
				$message = array();
				$message[] = "You need to login to update your account settings.";
				flash($message,'bad');
			} else {
				$PAGE_BODY = "views/my_account.php";  	/* which file to pull into the template */
				// grab user object
				$user = new User();
				$user->GetItemObj( $_SESSION['user']['id'] );
				// get the correct user type object
				$group = ucfirst( $_SESSION['user']['group'] );
				$item = new $group();
				$joins = $item->ReadForeignJoins( $user );
				$item->GetItemObj( $joins[0]['id'] );
				
				if ($group == 'Scrapper') {
					$redirect_url = "/scrap-exchange";
				} else {
					$redirect_url = "/broker-admin";
				}
				
				// check for update submit
				if ( isset($_POST['AccountUpdate']) ) {
					$error_messages = array();
					$post_data = $_POST;
					// clean post data
					foreach ($post_data as $key => $val) {
						$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
						if ( strpos($key, "phone") || strpos($key, "fax") )
							$post_data[$key] = format_phone( $post_data[$key] );
					}
					// check user data: email & password are good to go
					$post_data['email'] = strtolower($post_data['email']);
					if ( $user->email != $post_data['email'] ) {
						$u = new User();
						$users = $u->GetItemsObjByPropertyValue( 'email', $post_data['email'] );
						if( $post_data['email'] == "" )
							$error_messages[] = "Email field cannot be left empty.";
						elseif( !isValidEmail($post_data['email']) )
							$error_messages[] = "Email field must contain a valid email address.";
						elseif( count($users) > 0 )
							$error_messages[] = "Email is already being used.";
					} else {
						unset($post_data['email']);
					}
					if ( $post_data['password'] != "" ) {
						if( $post_data['password'] == "" )
							$error_messages[] = "Password field cannot be left empty.";
						if( $post_data['verify_password'] != $post_data['password'] )
							$error_messages[] = "Verify Password does not match Password field.";
						$salt = $user->salt;
						$post_data['password'] = $user->SetPassword($post_data['password'], $salt);
					} else {
						unset($post_data['password']);
					}
					if ( count($error_messages) > 0 ) {
						flash( $error_messages, "bad" );
						redirect_to('/my-account');
					}
					if ( $item->UpdateItem( $post_data ) && $user->UpdateItem( $post_data ) ) {
						flash( array("Your Account has been updated successfully.") );
						redirect_to($redirect_url);
					} else {
						flash( array("There was a problem updating your account."), "bad" );
						redirect_to('/my-account');
					}
				}
				//the layout file  -  THIS PART NEEDS TO BE LAST
				require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
			}
		break;

		/* SPEC DOWNLOADER FOR FACILITIES **************************************** */
		case 'spec-downloader':
			if (isset($_GET['facility_id'])) {
				$f = new Facility();
				$facility = $f->GetItemObj($_GET['facility_id']);
				if ( !empty($facility->attachments) ) {
					if ( !$facility->downloadAttachment() ) {
						flash( array("The download you requested is no longer available."), "bad" );
						redirect_to('/scrap-exchange');
					}
				} else {
					flash( array("The download you requested is no longer available."), "bad" );
					redirect_to('/scrap-exchange');
				}
			} else {
				flash( array("The download you requested is no longer available."), "bad" );
				redirect_to('/scrap-exchange');
			}		
		break;
	}
//} // END WHILE $KILL
?>