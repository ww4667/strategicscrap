<?php
if(!isset($_SESSION)){
	session_start();
}

require_once($_SERVER['DOCUMENT_ROOT']."/gir/index.php");
//$auth = new Auth();

	switch($controller_action){
		
		/* HOMEPAGE FOR SCRAPPERS **************************************** */
		case 'my-homepage':
			// page 'template variables'
			$PAGE_BODY = "views/my_homepage.php";  	/* which file to pull into the template */
			
			$content = "my homepage poop";
			
			//get lme_comex data from feed
			$request_url = "resources/xml/lme_comex.xml";
			$xml = simplexml_load_file($request_url) or die("feed not loading");
			//set LME with metal name
			foreach ($xml->MetalsData->children() as $name => $data) {
				$data->LME->metal = $name;
			}
			$lme = $xml->xpath('//LME');
			$comex = $xml->xpath('//COMEX');
			
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
//					unset($_SESSION['user']);
					$u = new User();
					$users = $u->Login('jlabresh1@gmail.com', 'ihategit');
					print_r($_SESSION);
					$u->Logout();
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
		
		/* CLIENT LOGIN **************************************** */
		case 'client-login':
			// page 'template variables'
			$PAGE_BODY = "views/client_login.php";  	/* which file to pull into the template */
			
			$error_messages = array();
			
			if (isset($_GET['logout']) || isset($_GET['logged_out'])) {
				if (isset($_GET['logout'])) {
					Client::log_out();
					header('Location: /client-login.html?logged_out=1');
				}
				array_push($error_messages, "You have been logged out.");
			}

			if (isset($_POST['password'])) {
				$lookup = Client::email_exists($_POST['email']);
				if ($lookup->password == sha1($_POST['password'])) {
					$lookup->session_refresh();
					if ($lookup->service_type == 'doc prep') {
						header('Location: /services/my-account-document-preparation.html');
 					} else {
						header('Location: /services/my-account-uncontested-divorce.html');
 					}
				} else {
					array_push($error_messages, "You could not be logged in. Check your email address and password and try again.");
				}
			} elseif (Client::is_logged_in()) {
				$client = unserialize($_SESSION['hd_client']);
				if ($client->service_type == 'doc prep') {
					header('Location: /services/my-account-document-preparation.html');
				} else {
					header('Location: /services/my-account-uncontested-divorce.html');
				}
			}

			//the layout file  -  THIS PART NEEDS TO BE LAST
			require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
		break;
		
		/* 250 CLIENT SERVICES **************************************** */
		case '250-client-services':

			if (!Client::is_logged_in()) {
				// page 'template variables'
				$error_messages = array();
				array_push($error_messages, "You must be logged in to view this page.");
				header('Location: /client-login.html');
			}
			
		break;
		
		/* 500 CLIENT SERVICES **************************************** */
		case '500-client-services':

			if (!Client::is_logged_in()) {
				// page 'template variables'
				$error_messages = array();
				array_push($error_messages, "You must be logged in to view this page.");
				header('Location: /client-login.html');
			}
			
		break;
		
		/* client logout **************************************** */
		case 'client-logout':

			Client::log_out();
			header('Location: /client-login.html');
			
		break;

	}
?>