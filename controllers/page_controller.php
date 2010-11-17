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
			// page 'template variables'
			$PAGE_BODY = "views/my_homepage.php";  	/* which file to pull into the template */
			
			$content = "my homepage poop";
			
			// START XIGNITE COMEX FEED
			
			// define the SOAP client using the url for the service
			$key = "FDFDBEAF9B004b2eBB2D7A9D1D39F24F";
			$client = new soapclient('http://www.xignite.com/xFutures.asmx?WSDL', array('trace' => 1));
			
			// create an array of parameters 
			$param = array(
			               'Symbol' => "HG",
			               'Month' => "0",
			               'Year' => "0");
			
			// call the service, passing the parameters and the name of the operation 
			$result = $client->GetDelayedFuture($param);
			// assess the results 
			if (is_soap_fault($result) && isset($_GET['xml'])) {
			     echo '<h2>Fault</h2><pre>';
			     print_r($result);
			     echo '</pre>';
			} else {
//			     echo '<h2>Result</h2><pre>';
//			     print_r($result);
//			     echo '</pre>';
				$comex_data = $result;
				$comex = array("cash"=>$comex_data->GetDelayedFutureResult->Last);
			}
//			// print the SOAP request 
//			echo '<h2>Request</h2><pre>' . htmlspecialchars($client->__getLastRequest(), ENT_QUOTES) . '</pre>';
//			// print the SOAP request Headers 
//			echo '<h2>Request Headers</h2><pre>' . htmlspecialchars($client->__getLastRequestHeaders(), ENT_QUOTES) . '</pre>';
//			// print the SOAP response 
//			echo '<h2>Response</h2><pre>' . htmlspecialchars($client->__getLastResponse(), ENT_QUOTES) . '</pre>';
			
			// END XIGNITE COMEX FEED
			
			//get lme_comex data from feed
			$request_url = "resources/xml/lme_comex.xml";
			$xml = simplexml_load_file($request_url) or die("feed not loading");
			//set LME with metal name
			foreach ($xml->MetalsData->children() as $name => $data) {
				$data->LME->metal = $name;
			}
			$lme = $xml->xpath('//LME');
//			$comex = $xml->xpath('//COMEX');
			
			//get business feed from wordpress blog
//			$request_url = "http://www.strategicscrap.com/blog/wordpress/?feed=rss2&cat=4";
//			$ctx = stream_context_create(array( 
//				    'http' => array( 
//				        'timeout' => 1 
//			        ) 
//			    ) 
//			); 
//file_get_contents("http://example.com/", 0, $ctx); 
//			$xml = file_get_contents($request_url, 0, $ctx);
//			$xml = simplexml_load_file($request_url) or die("feed not loading");
//			$xml = preg_replace('/&[^; ]{0,6}.?/e', "((substr('\\0',-1) == ';') ? '\\0' : '&amp;'.substr('\\0',1))", $xml); 
//			$xml = simplexml_load_string($xml) or die("feed not loading");
//			$business_feed = $xml->xpath('//item');

			//get metal feed from wordpress blog
//			$request_url = "http://www.strategicscrap.com/blog/wordpress/?feed=rss2&cat=527";
//			$request_url = "resources/xml/metal_news.xml";
//			$ctx = stream_context_create(array( 
//				    'http' => array( 
//				        'timeout' => 1 
//			        ) 
//			    ) 
//			); 
//file_get_contents("http://example.com/", 0, $ctx); 
//			$xml = file_get_contents($request_url, 0, $ctx);
//			$xml = simplexml_load_file($request_url) or die("feed not loading");
//			$xml = preg_replace('/&[^; ]{0,6}.?/e', "((substr('\\0',-1) == ';') ? '\\0' : '&amp;'.substr('\\0',1))", $xml); 
//			$xml = simplexml_load_string($xml) or die("feed not loading");
//			$metal_feed = $xml->xpath('//item');
			
			//get zip based on IP address
			$ip_addy = $_SERVER['REMOTE_ADDR'];
			$request_url = "http://ipinfodb.com/ip_query.php?ip=173.18.191.29&timezone=true";
//			$request_url = "http://ipinfodb.com/ip_query.php?ip=$ip_addy&timezone=true";
			$xml = simplexml_load_file($request_url) or die("feed not loading");
			$zipcode = $xml->xpath('//ZipPostalCode');
//			$zipcode = $zipcode[0];
			$zipcode = 92101; // San Diego
//			$request_url = "http://www.google.com/ig/api?weather=$zipcode";
			$request_url = "http://xoap.weather.com/weather/local/$zipcode?cc=*&dayf=5&link=xoap&prod=xoap&par=1182592015&key=bd35fd8b6e181b8a";
			$xml = simplexml_load_file($request_url) or die("feed not loading");
			$weather = $xml->xpath('//weather');
			$weather = $weather[0];
			
//			echo "<pre>";
//			var_dump($xml);
//			echo "</pre>";
//			die();

//			foreach ($xml->xpath('//item') as $item) {
//				echo $item->title."<br />";
//				print_r($item);
//			}
			
			
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
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
			// page 'template variables'
			$PAGE_BODY = "views/regions.php";  	/* which file to pull into the template */			
			
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Scrap Exchange */
		case 'scrap-exchange':
//			$auth->setApplication('strategicscrap');
//			$auth->setUserGroup('scrapper');
			// page 'template variables'
			$PAGE_BODY = "views/scrappers/scrap_exchange_new.php";  	/* which file to pull into the template */
			$controller = "facility"; // controller for gir app -- not being used yet
			$f = new Facility();
			$facilities = $f->GetAllItemsObj();
			$m = new Material();
			$materials = $m->GetAllItemsObj();
			if(isset($_GET['gir'])) { // use for testing stuff
				$controller = "facility";
				$method = "view";
				if ( isset( $_GET['user'] ) ) {
//					// create a user
//					$userData = array(
//					"email" => "greg@greg.com",
//					"password" => "yellow",
//					"validation" => 1
//					);
					$groups = array("Scrapper","Broker");
					foreach ($groups as $g) {
						if(!isset($_SESSION['user'])) {
							$u = new $g();
							$user = $u->Login('ww4667@gmail.com', 'blue');
						}
					}
					print_r($_SESSION);
					if(isset($_SESSION['user'])) {
						$u = new User();
						$u->Logout();
					}
					print_r($_SESSION);
//					$users = $u->GetAllItems();
//					print_r($_SESSION['user']);
					
//					$u->CreateItem($userData);
//					$userData = array(
//					"email" => "jlabresh1@gmail.com",
//					"password" => "ihategit",
//					"validation" => 1
//					);
//					$u->CreateItem($userData);
//					$a = new Auth();
//					$users = $u->GetAllItems();
//					print_r($users);
//					$a->
				}
				
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
				}
				die();
				
				
// ID	Company	Last Name	First Name	E-mail Address	Job Title	Business Phone	Address	City	State/Province	ZIP/Postal Code	Country	Web Page	Notes	Category	Broker Exclusive"),
$newFacilities = array(
array(
	"id" => "24",
	"company" => "ArcelorMittal - Burns Harbor",
	"last_name" => "Harreld",
	"first_name" => "Mike",
	"email" => "mike.harreld@arcelormittal.com",
	"job_title" => "",
	"business_phone" => "(219) 787-2120",
	"home_phone" => "",
	"mobile_phone" => "",
	"fax" => "",
	"address_1" => "250 W Us Highway 12",
	"address_2" => "",
	"Burns Harbor",
	"Indiana",
	"46304",
	"",
	"United States",
	"",
	"",
	"http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/#",
	"Gary Loyld 219-391-2932",
	"Mill",
	""
	),
array(
	"25",
	"ArcelorMittal - Cleveland",
	"Harreld",
	"Mike",
	"mike.harreld@arcelormittal.com",
	"",
	"(216) 429-6000",
	"",
	"",
	"",
	"3060 Eggers Ave",
	"",
	"Cleveland",
	"Ohio",
	"44105",
	"",
	"United States",
	"",
	"",
	"http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/cleveland.asp#",
	"",
	"Mill",
	""
	),
array(
	"26",
	"ArcelorMittal - Indiana Harbor",
	"Harreld",
	"Mike",
	"mike.harreld@arcelormittal.com",
	"",
	"(773) 375-6200",
	"",
	"",
	"",
	"3210 Watling St",
	"",
	"East Chicago",
	"Indiana",
	"46312",
	"",
	"United States",
	"",
	"",
	"http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/indiana+harbor.asp#",
	"",
	"Mill",
	""
	),
array(
	"23",
	"ArcelorMittal - Riverdale",
	"Harreld",
	"Mike",
	"mike.harreld@arcelormittal.com",
	"",
	"708-849-8803",
	"",
	"",
	"",
	"13500 South Perry Avenue",
	"",
	"Riverdale",
	"Illinois",
	"60827",
	"",
	"United States",
	"",
	"",
	"http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/riverdale.asp#",
	"",
	"Mill",
	""
	),
array(
	"22",
	"ArcelorMittal - Indiana Harbor Long Carbon Div.",
	"Harreld",
	"Mike",
	"mike.harreld@arcelormittal.com",
	"",
	"(219) 399-3333‎",
	"",
	"",
	"",
	"3210 Watling St",
	"",
	"East Chicago",
	"Indiana",
	"46312",
	"",
	"United States",
	"",
	"",
	"http://www.mittalsteel.com",
	"219-399-3109 John Hamherhan(sp?)",
	"Mill",
	""
	)
);
				
				
//				require_once($_SERVER['DOCUMENT_ROOT']."/gir/index.php");
			}
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Transport Material */
		case 'transport-material':
			// page 'template variables'
			$PAGE_BODY = "views/scrappers/transport_material.php";  	/* which file to pull into the template */			
			
			
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Registration (home) */
		case 'register':
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
			$PAGE_BODY = "views/intro_screen_new.php";  	/* which file to pull into the template */			
						
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Broker Dashboard */
		case 'broker-dashboard':
			// page 'template variables'
			$PAGE_BODY = "views/brokers/dashboard.php";  	/* which file to pull into the template */
						
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Broker Dashboard :: quote manager */
		case 'broker-quote-manager':
			// page 'template variables'
			$PAGE_BODY = "views/brokers/quotes.php";  	/* which file to pull into the template */
						
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Broker Dashboard :: request manager */
		case 'broker-request-manager':
			// page 'template variables'
			$PAGE_BODY = "views/brokers/requests.php";  	/* which file to pull into the template */
						
			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;

		/* Pricing Form */
		case 'pricing-form':
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
				header('Location: /broker-pricing-form');
			}

			if(isset($_SESSION['broker'])) {
				$PAGE_BODY = "views/brokers/pricing/form.php";  	/* which file to pull into the template */
							
				$broker = unserialize($_SESSION['broker']);
				
				$facilities = PricingFacility::getByBrokerId($broker->id);
				$facilities = PricingFacility::getByBrokerId($broker->id);
				//bolt on materials to facility objects
				foreach ($facilities as $f) {
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
					header('Location: /broker-pricing-form');
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
			$error_messages = array();
			
			if ( (isset($_POST['username']) && $_POST['username'] != "") && (isset($_POST['password']) && $_POST['password'] != "") ) {
				$username = trim($_POST['username']);
				$password = trim($_POST['password']);
				// snag matching user(s)
				$u = new User();
				$users = $u->GetItemsObjByPropertyValue('email', $username);
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
						$error_messages[] = "Welcome!";
						flash($error_messages);
						header('Location: /regions/northeast');
					break;
					
					case 'broker':
						$error_messages[] = "Welcome!";
						flash($error_messages);
						header('Location: /broker-admin/dashboard');
					break;
					
					default:
						$error_messages[] = "Wrong username or password.";
						$_SESSION['sign-in-error'] = true;
						header('Location: /');
					break;
				}
			} else {
						$error_messages[] = "Wrong username or password.";
						$_SESSION['sign-in-error'] = true;
						header('Location: /');
			}
			//the layout file  -  THIS PART NEEDS TO BE LAST
//			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;
		
		/* SCRAP LOGOUT **************************************** */
		case 'scrap-logout':
			$error_messages = array();
			$u = new User();
			if ( $u->Logout() ) {
				$error_messages[] = "You have been logged out successfully.";
			}
			header('Location: /');

			//the layout file  -  THIS PART NEEDS TO BE LAST
//			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;
		
		/* REGISTER **************************************** */
		case 'scrap-registration':
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
				$post_data['work_phone'] = format_phone($post_data['work_phone']);
				if( strlen($post_data['work_phone']) != 14 )
					$error_messages[] = "Phone field must have 10 digits.";
				if( $post_data['state_province'] == "" )
					$error_messages[] = "State/Province selection missing.";
				if( !isZip($post_data['postal_code']) )
					$error_messages[] = "Zip Code cannot be empty.";
				// setup the new user!
				if(count($error_messages) == 0) {
					$u = new User();
					$userId = $u->CreateItem($post_data); 
					if ( $userId && !isset($_GET['broker']) ) {
						// setup the new scrapper!
						$s = new Scrapper();
						$scrapperId = $s->CreateItem($post_data);
						$scrapper = $s->GetItemObj($scrapperId);
						$scrapper->addUser($userId);
						die(print_r($scrapper));
					} else {
						// setup the new broker!
						$b = new Broker();
						$brokerId = $b->CreateItem($post_data);
						$broker = $b->GetItemObj($brokerId);
						$broker->addUser($userId);
						die(print_r($broker));
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
	}
//} // END WHILE $KILL
?>