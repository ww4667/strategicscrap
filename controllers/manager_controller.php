<?php
// CHECK IF RUNNING IN MODX MANAGER
if (!$modx->config['base_path'])
    die ('Please run from manager');
	
if(!isset($_SESSION)){
	session_start();
}

require_once($_SERVER['DOCUMENT_ROOT']."/gir/index.php");

error_reporting(0);

$manager_theme = $modx->config['manager_theme'];						// used for default MODx manage css
$ss_path = $modx->config['filemanager_path'];
$ss_id = $modID;
$ss_url = 'index.php?a=112&amp;id='.$ss_id;

$controller_action = "facility-manager";

$method = isset($_GET['method'])?$_GET['method']:$controller_action;	// default is show-menu

$MODULE_TITLE = "Strategic Scrap Manager";

$KILL = false;

while (!$KILL) {
	switch($method){
		
		case 'facility-manager':
			
			$PAGE_TITLE 		= "Facility Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Facility List";								/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/facility_manager.php";			/* which file to pull into the template */

			$f = new Facility();
			$facilities = $f->GetAllItems();

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'facility-update':
			
			$PAGE_TITLE 		= "Facility Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Update Facility";								/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/facility_update.php";			/* which file to pull into the template */

			if(isset($_POST['submitted'])){
				$post_data = $_POST;
				$post_data['id'] = $post_data['facility_id'];
				$f = new Facility();
				$f->GetItemObj($post_data['id']);
				if( $f->UpdateItem($post_data) ) {
					// update material join
					$f->getMaterials();
					$joined_materials = $f->join_material;
					// grab current join ids
					$joined_material_ids = array();
					foreach ($joined_materials as $jm) {
						$joined_material_ids[$jm['id']] = $jm['name'];
					}
					// grab posted join ids
					$material_ids = array();
					foreach ($post_data['materials_array'] as $pm) {
						$material_ids[$pm] = $pm;
					}
					// loop the arrays and add/remove
					foreach ($material_ids as $key => $val) {
						if ( !isset($joined_material_ids[$key]) ) $f->addMaterial($key);
					}
					foreach ($joined_material_ids as $key => $val) {
						if ( !isset($material_ids[$key]) ) $f->removeMaterial($key);
					}
					$message = "Facility updated successfully.";
				} else {
					$message = "There was a problem updating the facility.";
					$error = true;	
				}
				$method = "facility-manager";
				break;
			}

			$f = new Facility();
			$facility = $f->GetItemObj($_GET['facility_id']);
			$facility->getMaterials();
			$joined_materials = $facility->join_material;
			$material_ids = array();
			foreach ($joined_materials as $jm) {
				$material_ids[$jm['id']] = $jm['name'];
			}
			$m = new Material();
			$materials = $m->GetAllItems();

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;

		case 'facility-add':
			
			$PAGE_TITLE 		= "Facility Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Add Facility";								/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/facility_add.php";			/* which file to pull into the template */
			
			if(isset($_POST['submitted'])){
				$post_data = $_POST;
				// check for required fields
				$required_fields = array(
											array("company","Company Name cannot be left empty"),
											array("address_1","Address cannot be left empty"),
											array("city","City cannot be left empty"),
											array("state_province","State/Province cannot be left empty"),
											array("zip_postal_code","Zip Code cannot be left empty"),
//											array("country","Country cannot be left empty"),
											array("","")
				);
				// fix data
				// trim first
				foreach ($post_data as $key => $val) {
					$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
				}
				// fix state/province country data
				$state = substr($post_data['state_province'], -2);
				$country = substr($post_data['state_province'], 0, 2);
				$f = new Facility();
				$post_data['region'] = $f->setRegion($state);
				$post_data['state_province'] = $state;
				if ( $country == "US" ) {
					$post_data['country'] = "United States";
				} elseif ( $country == "MX" ) {
					$post_data['country'] = "Mexico";
				} else {
					$post_data['country'] = "Canada";
				}
				// get geo code info				
				if ($post_data['address_1'] != "") {
					$address = $post_data['address_1'];
					$address .= ", ".$post_data['address_2'];
					$address .= ", ".$post_data['city'];
					$address .= ", ".$post_data['state_province'];
					$address .= " ".$post_data['zip_postal_code'];
					$address .= ", ".$post_data['country'];
					$address = urlencode($address);
				} else {
					$address = urlencode("204 SW Stonegate Dr, Ankeny, IA");
				}
				$url = 'http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false';
				$data = file_get_contents( $url );
				$results = json_decode($data);
				$results = $results->results[0];
				$post_data['lat'] = (string) $results->geometry->location->lat;
				$post_data['lon'] = (string) $results->geometry->location->lng;
				// fix phone numbers
				$post_data['business_phone'] = format_phone($post_data['business_phone']);
				$post_data['home_phone'] = format_phone($post_data['home_phone']);
				$post_data['mobile_phone'] = format_phone($post_data['mobile_phone']);
				$post_data['fax_number'] = format_phone($post_data['fax_number']);
				// create the facility
				$f = new Facility();
				$f->CreateItem($post_data);
				foreach ($post_data['materials_array'] as $m) {
					$f->addMaterial($m);
				}
				if( !empty($f->id) ){
					$message = "Facility added successfully.";
				} else {
					$message = "There was a problem adding the facility.";	
					$error = true;	
				}
				$method = "facility-manager";
				break;
			}
			
			$m = new Material();
			$materials = $m->GetAllItems();

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;

		case 'pricing':
			
			$PAGE_TITLE 		= "Regional Pricing Manager";						/* Title text for this page */
			$SECTION_HEADER 	= "Update Regional Pricing";						/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/pricing.php";				/* which file to pull into the template */
			
			if (isset($_POST['submitted'])) {
				$post_data = $_POST;
				// unset empty vars from the (mat) array
				foreach ($post_data['mat'] as $lbl => $val) {
					if (empty($val)) unset($post_data['mat'][$lbl]);
				}
				$materials = $post_data['mat'];
				if (!empty($materials)) {
					// remove all the regional pricing from the DB
					$p = new Pricing();
					$del = $p->getPricingByRegion($post_data['region']);
					foreach ($del as $d) {
						$p->RemoveItem($d['id']);
					}
					foreach ($materials as $lbl => $val) {
						$post_data['price'] = number_format($val,2);
						$p = new Pricing();
						$pricing = $p->CreateItem($post_data);
						$pricing->addMaterial($lbl);
					}
					if (isset($pricing)) {
						$message = $post_data['region']." pricing has been updated successfully.";
					} else {
						$message = "There was a problem updating the pricing.";
						$error = true;	
					}
					unset($_POST);
				} else {
					$message = "There was nothing to update.";
				}
				break;
			}
			
			$regions =  array("NE"=>"Northeast","SE"=>"Southeast","C"=>"Central","S"=>"South","W"=>"West");
			
			$p = new Pricing();
			$pricing = $p->getAllPricing();
			
			foreach ($pricing as $indx => $p) {
				$p->getMaterials();
				$p->join_material = $p->join_material[0]['id'];
				$pricing[$indx] = $p;
			}
			
			$m = new Material();
			$materials = $m->GetAllItems();

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'material-manager':
			
			$PAGE_TITLE 		= "Material Manager";					/* Title text for this page */
			$SECTION_HEADER 	= "Material List";									/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/material_manager.php";			/* which file to pull into the template */

			$m = new Material();
			$materials = $m->GetAllItems();

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'material-update':
			
			$PAGE_TITLE 		= "Material Manager";							/* Title text for this page */
			$SECTION_HEADER 	= "Update Material";									/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/material_update.php";			/* which file to pull into the template */
			
			if(isset($_POST['submitted'])){
				$post_data = $_POST;
				$post_data['id'] = $post_data['material_id'];
				$m = new Material();
				$m->GetItemObj($post_data['id']);
				if( $m->UpdateItem($post_data) ) {
					$message = "Material updated successfully.";
				} else {
					$message = "There was a problem updating the material.";
					$error = true;
				}
				$method = "material-manager";
				break;
			}

			$m = new Material();
			$material = $m->GetItemObj($_GET['material_id']);

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'material-add':
			
			$PAGE_TITLE 		= "Material Manager";					/* Title text for this page */
			$SECTION_HEADER 	= "Add Material";								/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/material_add.php";			/* which file to pull into the template */
			
			if(isset($_POST['submitted'])){
				$post_data = $_POST;
				// check for required fields
				$required_fields = array(
											array("name","Material Name cannot be left empty")
				);
				// fix data
				// trim first
				foreach ($post_data as $key => $val) {
					$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
				}
				// create the material
				$m = new Material();
				$m->CreateItem($post_data);
				if( !empty($m->id) ){
					$message = "Material added successfully.";
				} else {
					$message = "There was a problem adding the material.";
					$error = true;
				}
				$method = "material-manager";
				break;
			}

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;

		case 'scrappers':
			
			$PAGE_TITLE 		= "Scrapper Manager";						/* Title text for this page */
			$SECTION_HEADER 	= "Scrappers List";									/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/scrappers.php";			/* which file to pull into the template */

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		default:
			die('No method found');
		break;
	}
}
?>