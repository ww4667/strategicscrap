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

			if(isset($_POST['remove'])){
				$method = "facility-remove";
				break;
			}
			
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
					flash($message);
				} else {
					$message = "There was a problem updating the facility.";
					flash($message,"bad");
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
			// alphabetize the materials array
			$name_array = array();
			foreach ($materials as $val) {
				$name_array[] = $val['name'];
			}
			array_multisort($name_array,$materials);

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;

		case 'facility-add':
			
			$PAGE_TITLE 		= "Facility Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Add Facility";									/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/facility_add.php";		/* which file to pull into the template */
			
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
					flash($message);
				} else {
					$message = "There was a problem adding the facility.";	
					flash($message,"bad");
				}
				$method = "facility-manager";
				break;
			} else {
				$f = new Facility();
				foreach($f as $key => $val) {
					$post_data[$key] = "";
				}
			}
			
			$m = new Material();
			$materials = $m->GetAllItems();
			// alphabetize the materials array
			$name_array = array();
			foreach ($materials as $val) {
				$name_array[] = $val['name'];
			}
			array_multisort($name_array,$materials);

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'facility-remove':
			$method = "facility-manager";
			if ( isset($_REQUEST['facility_id']) ) {
				$facilityId = (int) $_REQUEST['facility_id'];
				$f = new Facility();
				$f->GetItemObj($facilityId);
				if ( !empty($f->id) ) {
					$f->RemoveItem($facilityId);
					$message = "The facility was removed successfully.";
					flash($message);
					break;
				}
			}
			$message = "There was a problem removing the facility.";
			flash($message,"bad");
		break;


/** 
 * START scrap-category-type
 */

		case 'category-type-manager':
			
			$PAGE_TITLE 		= "Category Type Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Category Type List";								/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/category_type_manager.php";			/* which file to pull into the template */

			$ct = new CategoryType();
			$categoryTypes = $ct->GetAllItems();
			
			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'category-type-update':
			
			$PAGE_TITLE 		= "Category Type Manager";							/* Title text for this page */
			$SECTION_HEADER 	= "Update Category Type";									/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/category_type_update.php";			/* which file to pull into the template */
	
			if(isset($_POST['remove'])){
				$method = "category-type-remove";
				break;
			}
			
			if(isset($_POST['submitted'])){
				$post_data = $_POST;
				$post_data['id'] = $post_data['category_type_id'];
				$m = new CategoryType();
				$m->GetItemObj($post_data['id']);
				if( $m->UpdateItem($post_data) ) {
					$message = "Category Type updated successfully.";
					flash($message);
				} else {
					$message = "There was a problem updating the category type.";
					flash($message,"bad");
				}
				$method = "category-type-manager";
				break;
			}

			$ct = new CategoryType();
			$categoryType = $ct->GetItemObj($_GET['category_type_id']);

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'category-type-add':
			
			$PAGE_TITLE 		= "Category Type Manager";					/* Title text for this page */
			$SECTION_HEADER 	= "Add Category Type";								/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/category_type_add.php";			/* which file to pull into the template */
			
			if(isset($_POST['submitted'])){
				$post_data = $_POST;
				// check for required fields
				$required_fields = array(
											array("name","Category Type Name cannot be left empty")
				);
				// fix data
				// trim first
				foreach ($post_data as $key => $val) {
					$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
				}
				// create the material
				$ct = new CategoryType();
				$ct->CreateItem($post_data);
				if( !empty($ct->id) ){
					$message = "Category Type added successfully.";
					flash($message);
				} else {
					$message = "There was a problem adding the category type.";
					flash($message,"bad");
				}
				$method = "category-type-manager";
				break;
			} else {
				$ct = new CategoryType();
				foreach($ct as $key => $val) {
					$post_data[$key] = "";
				}
			}

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
				
		case 'category-type-remove':
			$method = "category-type-manager";
			if ( isset($_REQUEST['category_type_id']) ) {
				$categoryTypeId = (int) $_REQUEST['category_type_id'];
				$ct = new CategoryType();
				$ct->GetItemObj($categoryTypeId);
				if ( !empty($ct->id) ) {
					$ct->RemoveItem($categoryTypeId);
					$message = "The category type was removed successfully.";
					flash($message);
					break;
				}
			}
			$message = "There was a problem removing the category type.";
			flash($message,"bad");
		break;
 
/** 
 * END scrap-category-type
 */



/** 
 * START scrap-category
 */

		case 'category-manager':
			
			$PAGE_TITLE 		= "Category Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Category List";								/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/category_manager.php";			/* which file to pull into the template */

			$c = new Category();
			$categories = $c->GetAllItems();
			
			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'category-update':
			
			$PAGE_TITLE 		= "Category Manager";							/* Title text for this page */
			$SECTION_HEADER 	= "Update Category";									/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/category_update.php";			/* which file to pull into the template */
	
			if(isset($_POST['remove'])){
				$method = "category-remove";
				break;
			}
			
			if(isset($_POST['submitted'])){
				$post_data = $_POST;
				$post_data['id'] = $post_data['category_id'];
				$c = new Category();
				$c->GetItemObj($post_data['id']);
				if( $c->UpdateItem($post_data) ) {
					$message = "Category updated successfully.";
					flash($message);
				} else {
					$message = "There was a problem updating the category.";
					flash($message,"bad");
				}
				$method = "category-manager";
				break;
			}

			$c = new Category();
			$category = $c->GetItemObj($_GET['category_id']);

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'category-add':
			
			$PAGE_TITLE 		= "Category Manager";					/* Title text for this page */
			$SECTION_HEADER 	= "Add Category";								/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/category_add.php";			/* which file to pull into the template */
			
			if(isset($_POST['submitted'])){
				$post_data = $_POST;
				// check for required fields
				$required_fields = array(
											array("name","Category Name cannot be left empty")
				);
				// fix data
				// trim first
				foreach ($post_data as $key => $val) {
					$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
				}
				// create the material
				$c = new Category();
				$c->CreateItem($post_data);
				if( !empty($c->id) ){
					$message = "Category added successfully.";
					flash($message);
				} else {
					$message = "There was a problem adding the category.";
					flash($message,"bad");
				}
				$method = "category-manager";
				break;
			} else {
				$c = new Category();
				foreach($c as $key => $val) {
					$post_data[$key] = "";
				}
			}

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
				
		case 'category-remove':
			$method = "category-manager";
			if ( isset($_REQUEST['category_id']) ) {
				$categoryId = (int) $_REQUEST['category_id'];
				$c = new Category();
				$c->GetItemObj($categoryId);
				if ( !empty($c->id) ) {
					$ct->RemoveItem($categoryId);
					$message = "The category was removed successfully.";
					flash($message);
					break;
				}
			}
			$message = "There was a problem removing the category.";
			flash($message,"bad");
		break;
 
/** 
 * END scrap-category
 */



/** 
 * START classifieds
 */

		case 'classified-manager':
			
			$PAGE_TITLE 		= "Classifieds Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Classifieds List";								/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/classified_manager.php";			/* which file to pull into the template */

			
			
			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'classified-update':
			
			$PAGE_TITLE 		= "Classifieds Manager";							/* Title text for this page */
			$SECTION_HEADER 	= "Update Classifieds";									/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/classified_update.php";			/* which file to pull into the template */
			
			$updatedClassified = new Classified();
						
			if(isset($_POST['remove'])){
				$method = "classified-remove";
				break;
			}
			
			if(isset($_POST['submitted'])){
				
				$post_data = $_POST;
				$post_data['id'] = $post_data['classified_id'];
				
				$updatedClassified->GetItemObj( $post_data[ 'id' ] );
				$post_data['featured'] = isset( $post_data['featured'] ) ? 1 : 0;
				$post_data['approved'] = isset( $post_data['approved'] ) ? 1 : 0;
				 
				$required_fields = array(
					array("title","Classified Title cannot be left empty"),
					array("description","Classified Description cannot be left empty"),
					array("join_scrapper","Classified Description cannot be left empty"),
					/*array("image","Classified Title cannot be left empty"),*/
					array("join_category_parent","Classified Category Parent cannot be left empty")
				);
				 
				if( $updatedClassified->UpdateItem( $post_data ) ) {
					
					// update category join
					$updatedClassified->getCategory();
					$joined_category = $updatedClassified->join_category_parent;
				
					$joined_category_id = $joined_category[0]['id'];
				
					// grab posted join ids
					$category_id = $post_data['join_category_parent'];
									
					// loop the arrays and add/remove
					if ( !isset( $joined_category_id ) ) $updatedClassified->addCategory( $category_id );
					if ( !isset( $category_id ) ) $updatedClassified->removeMaterial( $joined_category_id );
					
					
						
					$message = "Classified updated successfully.";
					flash($message);
				} else {
					$message = "There was a problem updating the classified.";
					flash($message,"bad");
				}
				
				$method = "classified-manager";
				break;
			}


			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'classified-add':
			
			$PAGE_TITLE 		= "Classified Manager";					/* Title text for this page */
			$SECTION_HEADER 	= "Add Classified";								/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/classified_add.php";			/* which file to pull into the template */
						
			if(isset($_POST['submitted'])){
				$post_data = $_POST;
				// check for required fields
				$required_fields = array(
					array("title","Classified Title cannot be left empty"),
					array("description","Classified Description cannot be left empty"),
					array("join_scrapper","Classified Description cannot be left empty"),
					/*array("image","Classified Title cannot be left empty"),*/
					array("join_category_parent","Classified Category Parent cannot be left empty")
				);
				
				// fix data
				// trim first
				foreach ($post_data as $key => $val) {
					$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
				}
				
				 
				
				// create the material
				$c = new Classified();
				$c->CreateItem($post_data);
				if( !empty($c->id) ){
					
					$c->addScrapper($post_data['join_scrapper']);
					$c->addCategory($post_data['join_category_parent']);
					
					$message = "Classified added successfully.";
					flash($message);
				} else {
					$message = "There was a problem adding the classified.";
					flash($message,"bad");
				}
				$method = "classified-manager";
				break;
			} else {
				$c = new Classified();
				foreach($c as $key => $val) {
					$post_data[$key] = "";
				}
			}

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
				
		case 'classified-remove':
			$method = "classified-manager";
			if ( isset($_REQUEST['classified_id']) ) {
				$classifiedId = (int) $_REQUEST['classified_id'];
				$classifiedToRemove = new Classified();
				$classifiedToRemove->GetItemObj($classifiedId);
				if ( !empty($classifiedToRemove->id) ) {
					$classifiedToRemove->RemoveItem($classifiedId);
					$message = "The classified was removed successfully.";
					flash($message);
					break;
				}
			}
			$message = "There was a problem removing the classified.";

		break;
 
/** 
 * END classifieds
 */
 
 		case 'pricing':
			
			$PAGE_TITLE 		= "Regional Pricing Manager";						/* Title text for this page */
			$SECTION_HEADER 	= "Update Regional Pricing";						/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/pricing.php";				/* which file to pull into the template */
			
			/*
			 * 
			 * What needs to happen is regional data should be stored in a json string. This way any change to the Materials
			 * won't affect the pricing history.
			 * 
			 * On update this is what will happen...
			 * 1 - If there is a current json for the region then toggle that entry's active field to "0"
			 * 2 - Save the existing array of materials and prices: Material Name, Price... as a json array
			 * 3 - Insert new json string into db for that region with active set to "1"
			 * 
			 * Need to...
			 * 1 - copy current prices somewhere safe
			 * 2 - wipe out current prices entries
			 * 3 - change pricing model to reflect new schema
			 * 4 - enter the saved prices as the first entry
			 * 
			 * Form modification...
			 * 1 - have a button for "save as update" and "save as new"
			 * 
			 */
			
			if (isset($_POST['submitted'])) {
				$post_data = $_POST;
				// unset empty vars from the (mat) array
				foreach ($post_data['mat'] as $lbl => $val) {
					if (empty($val['price']) && empty($val['broker_price'])) unset($post_data['mat'][$lbl]);
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
						$post_data['price'] = number_format($val['price'],2);
						$post_data['broker_price'] = number_format($val['broker_price'],2);
						$p = new Pricing();
						$pricing = $p->CreateItem($post_data);
						$pricing->addMaterial($lbl);
					}
					if (isset($pricing)) {
						$message = $post_data['region']." pricing has been updated successfully.";
						flash($message);
					} else {
						$message = "There was a problem updating the pricing.";
						flash($message,"bad");	
					}
					unset($_POST);
				} else {
					$message = "There was nothing to update.";
					flash($message);
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
			// alphabetize the materials array
			$name_array = array();
			foreach ($materials as $val) {
				$name_array[] = $val['name'];
			}
			array_multisort($name_array,$materials);

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'regional-data-manager':
			$PAGE_TITLE 		= "Regional Pricing Manager";						/* Title text for this page */
			$SECTION_HEADER 	= "Update Regional Pricing";						/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/regional_data_manage.php";				/* which file to pull into the template */
			
			$r = new Regional_Data();
			
			$region = (isset($_REQUEST["region"])) ? $_REQUEST["region"] : null;
			$region_grouped = $r->GetRegionalDataGrouped();
			echo "in regional data manager2";
			
			$regions =  array("NE"=>"Northeast","SE"=>"Southeast","C"=>"Central","S"=>"South","W"=>"West");
			
			$region_data = array();
			
			foreach ($region_grouped as $val){
				error_log('building regional data: ' . (microtime(true) - $temp_time_start) . ' seconds so far . . .');
				$tmp_data 	= array();
				
				$tmp_data["month"] 	= $val->month;
				$tmp_data["year"] 	= $val->year;
				
				$region_data[$val->region][] = $tmp_data;
				
			}
			
			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		
		case 'regional-data-add':
			//echo "Hello";
			$PAGE_TITLE 		= "Regional Pricing Manager";						/* Title text for this page */
			$SECTION_HEADER 	= "Update Regional Pricing";						/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/regional_data_add.php";				/* which file to pull into the template */
			//echo $PAGE_BODY;
			$region = (isset($_REQUEST["region"])) ? $_REQUEST["region"] : null;
			
			if (isset($_POST['submitted'])) {
				$post_data = $_POST;
				// unset empty vars from the (mat) array
				foreach ($post_data['mat'] as $lbl => $val) {
					if (empty($val['price']) && empty($val['broker_price']) && empty($val['export_price'])) unset($post_data['mat'][$lbl]);
				}
				$materials = $post_data['mat'];
				if (!empty($materials)) {
					// remove all the regional pricing from the DB
					$p = new Regional_Data();
					foreach ($materials as $lbl => $val) {
						$post_data['price'] = number_format($val['price'],2);
						$post_data['broker_price'] = number_format($val['broker_price'],2);
						$post_data['export_price'] = number_format($val['export_price'],2);
						$p = new Regional_Data();
						$pricing = $p->CreateItem($post_data);
						$pricing->addMaterial($lbl);
					}
					if (isset($pricing)) {
						$message = $post_data['region']." pricing has been updated successfully.";
						flash($message);
					} else {
						$message = "There was a problem updating the pricing.";
						flash($message,"bad");	
					}
					unset($_POST);
				} else {
					$message = "There was nothing to update.";
					flash($message);
				}
				redirect_to("index.php?a=112&id=2&method=regional-data-manager");
				break;
			}
			
			$regions =  array("NE"=>"Northeast","SE"=>"Southeast","C"=>"Central","S"=>"South","W"=>"West");
		
			$m = new Material();
			$materials = $m->GetAllItems();
			// alphabetize the materials array
			$name_array = array();
			foreach ($materials as $val) {
				$name_array[] = $val['name'];
			}
			array_multisort($name_array,$materials);

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'regional-data-edit':
			//echo "Hello";
			$PAGE_TITLE 		= "Regional Pricing Manager";						/* Title text for this page */
			$SECTION_HEADER 	= "Update Regional Pricing";						/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/regional_data_edit.php";				/* which file to pull into the template */
			//echo $PAGE_BODY;
			$region = (isset($_REQUEST["region"])) ? $_REQUEST["region"] : null;
			$month = (isset($_REQUEST["month"])) ? $_REQUEST["month"] : null;
			$year = (isset($_REQUEST["year"])) ? $_REQUEST["year"] : null;
			
			if (isset($_POST['submitted'])) {
				$post_data = $_POST;
				// unset empty vars from the (mat) array and remove them from the DB
				$rp = new Regional_Data();
				foreach ($post_data['mat'] as $lbl => $val) {
					if (empty($val['price']) && empty($val['broker_price']) && empty($val['export_price'])) {
						if ( !empty($val['id']) ) {
							$rp->RemoveItem($val['id']);
						}
						unset($post_data['mat'][$lbl]);
					}
				}
				$materials = $post_data['mat'];
				if (!empty($materials)) {
					foreach ($materials as $lbl => $val) {
						$post_data['price'] = ( empty($val['price']) )
							? $val['price']
							: number_format($val['price'],2);
						$post_data['broker_price'] = ( empty($val['broker_price']) )
							? $val['broker_price']
							: number_format($val['broker_price'],2);
						$post_data['export_price'] = ( empty($val['export_price']) )
							? $val['export_price']
							: number_format($val['export_price'],2);
						$post_data['id'] = $val['id'];
						
						$p = new Regional_Data();
						
						if($post_data['id']){
							$p->GetItemObj($post_data['id']);
							if( $p->UpdateItem($post_data) ) {
								$message = "Regional data updated successfully.";
								flash($message);
							} else {
								$message = "There was a problem updating the regional data.";
								flash($message,"bad");
							}
						} else {
							$pricing = $p->CreateItem($post_data);
							$pricing->addMaterial($lbl);
						}
					}
					unset($_POST);
				} else {
					$message = "Regional data was removed successfully.";
					flash($message);
					$method = "regional-data-manager";
					break;
				}
			}
			
			
			$regions =  array("NE"=>"Northeast","SE"=>"Southeast","C"=>"Central","S"=>"South","W"=>"West");
			
			$p = new Regional_Data();
			
			$pricing = $p->getRegionalDataByMonthYear($region, $month, $year);
			$material = new Material();
			foreach ($pricing as $indx => $p) {
					$p->ReadJoinsNew( $material );
					$p->join_material = $p->join_material[0]["id"];
					//$material->PTS($p);
				$pricing[$indx] = $p;
			}
			
			$m = new Material();
			$materials = $m->GetAllItems();
			// alphabetize the materials array
			$name_array = array();
			foreach ($materials as $val) {
				$name_array[] = $val['name'];
			}
			array_multisort($name_array,$materials);

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
	
			if(isset($_POST['remove'])){
				$method = "material-remove";
				break;
			}
			
			if(isset($_POST['submitted'])){
				$post_data = $_POST;
				$post_data['id'] = $post_data['material_id'];
				$m = new Material();
				$m->GetItemObj($post_data['id']);
				if( $m->UpdateItem($post_data) ) {
					$message = "Material updated successfully.";
					flash($message);
				} else {
					$message = "There was a problem updating the material.";
					flash($message,"bad");
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
					flash($message);
				} else {
					$message = "There was a problem adding the material.";
					flash($message,"bad");
				}
				$method = "material-manager";
				break;
			} else {
				$m = new Material();
				foreach($m as $key => $val) {
					$post_data[$key] = "";
				}
			}

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
				
		case 'material-remove':
			$method = "material-manager";
			if ( isset($_REQUEST['material_id']) ) {
				$materialId = (int) $_REQUEST['material_id'];
				$m = new Material();
				$m->GetItemObj($materialId);
				if ( !empty($m->id) ) {
					$m->RemoveItem($materialId);
					$message = "The material was removed successfully.";
					flash($message);
					break;
				}
			}
			$message = "There was a problem removing the material.";
			flash($message,"bad");
		break;

		case 'scrapper-manager':
			
			$PAGE_TITLE 		= "Subscriber Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Subscriber List";									/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/scrapper_manager.php";	/* which file to pull into the template */
			
			$s = new Scrapper();
			$scrappers = $s->getAllWithUserDetails();

			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'scrapper-update':
			
			$PAGE_TITLE 		= "Subscriber Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Update Subscriber";								/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/scrapper_update.php";		/* which file to pull into the template */
			
			if(isset($_POST['submitted'])){
				$error_messages = array();
				$post_data = $_POST;

				// clean the data
				foreach ($post_data as $key => $val) {
					$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
					if ( strpos($key, "phone") !== false || strpos($key, "fax") !== false )
						$post_data[$key] = format_phone( $post_data[$key] );
				}
				
				// update scrapper
				$s = new Scrapper();
				$scrapper = $s->GetItemObj($post_data['scrapper_id']);
				
				// update scrapper's user
				$u = new User();
				$user = $u->GetItemObj($post_data['user_id']);
				
				// check user data: email & password are good to go
				$post_data['email'] = strtolower($post_data['email']);
				if ( $user->email != $post_data['email'] ) {
					$users = $u->GetItemsObjByPropertyValue( 'email', $post_data['email'] );
					if( $post_data['email'] == "" )
						$error_messages[] = "Email field cannot be left empty.";
					elseif( !isValidEmail($post_data['email']) )
						$error_messages[] = "Email field must contain a valid email address.";
					elseif( count($users) > 0 )
						$error_messages[] = "Email is already being used.";
				}
				if( count($error_messages) > 0 ){
					flash($error_messages,"bad");
					unset($_POST); // so we don't loop forever...
					$_GET['scrapper_id'] = $post_data['scrapper_id'];
					$method = "scrapper-update";
					break;
				}
				if( $user->UpdateItem($post_data) && $scrapper->UpdateItem($post_data) ) {
					$message = "Scrapper updated successfully.";
					flash($message);
				} else {
					$message = "There was a problem updating the scrapper.";
					flash($message,"bad");
				}
				$method = "scrapper-manager";
				break;
			}
			
			$s = new Scrapper();
			$scrapper = $s->GetItemObj($_GET['scrapper_id']);
			$scrapper->getUsers();
			
			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;

		case 'broker-manager':
			
			$PAGE_TITLE 		= "Transportation Broker Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Transportation Broker List";								/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/broker_manager.php";	/* which file to pull into the template */
			
			$b = new Broker();
			$brokers = $b->getAllItemsObj();
			
			// make array of objects to useful simple array
			$broker_array = array();
			
			foreach ($brokers as $obj) {
				$obj->getUsers();
				$obj->email = $obj->join_user[0]['email'];
				$obj->logged_in = $obj->join_user[0]['logged_in'];
				$obj->last_login_ts = $obj->join_user[0]['last_login_ts'];
				$broker_array[] = (array) $obj;
			}
			
			$brokers = $broker_array;
			
			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'broker-update':
			
			$PAGE_TITLE 		= "Transportation Broker Manager";									/* Title text for this page */
			$SECTION_HEADER 	= "Update Transportation Broker";									/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/broker_update.php";		/* which file to pull into the template */
			
			if(isset($_POST['submitted'])){
				$error_messages = array();
				$post_data = $_POST;

				// clean the data
				foreach ($post_data as $key => $val) {
					$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
					if ( strpos($key, "phone") !== false || strpos($key, "fax") !== false )
						$post_data[$key] = format_phone( $post_data[$key] );
				}
				
				// update broker
				$b = new Broker();
				$broker = $b->GetItemObj($post_data['broker_id']);
				
				// update broker's user
				$u = new User();
				$user = $u->GetItemObj($post_data['user_id']);
				
				// check user data: email & password are good to go
				$post_data['email'] = strtolower($post_data['email']);
				if ( $user->email != $post_data['email'] ) {
					$users = $u->GetItemsObjByPropertyValue( 'email', $post_data['email'] );
					if( $post_data['email'] == "" )
						$error_messages[] = "Email field cannot be left empty.";
					elseif( !isValidEmail($post_data['email']) )
						$error_messages[] = "Email field must contain a valid email address.";
					elseif( count($users) > 0 )
						$error_messages[] = "Email is already being used.";
				}
				if( count($error_messages) > 0 ){
					flash($error_messages,"bad");
					unset($_POST); // so we don't loop forever...
					$_GET['broker_id'] = $post_data['broker_id'];
					$method = "broker-update";
					break;
				}
				if( $user->UpdateItem($post_data) && $broker->UpdateItem($post_data) ) {
					$message = "Broker updated successfully.";
					flash($message);
				} else {
					$message = "There was a problem updating the broker.";
					flash($message,"bad");	
				}
				$method = "broker-manager";
				break;
			}
			
			$b = new Broker();
			$broker = $b->GetItemObj($_GET['broker_id']);
			$broker->getUsers();
			
			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
		
		case 'broker-add':
			
			$PAGE_TITLE 		= "Transportation Broker Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Add Transportation Broker";									/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/broker_add.php";		/* which file to pull into the template */
			
			if(isset($_POST['submitted'])){
				$post_data = $_POST;
				$error_messages = array();
				
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
				
				// clean the data
				foreach ($post_data as $key => $val) {
					$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
					if ( strpos($key, "phone") !== false || strpos($key, "fax") !== false )
						$post_data[$key] = format_phone( $post_data[$key] );
				}
				
				// check for valid email/password before going on
				$post_data['email'] = strtolower($post_data['email']);
				$u = new User();
				$users = $u->GetItemsObjByPropertyValue( 'email', $post_data['email'] );
				if( $post_data['email'] == "" )
					$error_messages[] = "Email field cannot be left empty.";
				elseif( !isValidEmail($post_data['email']) )
					$error_messages[] = "Email field must contain a valid email address.";
				elseif( count($users) > 0 )
					$error_messages[] = "Email is already being used. Enter a different email address.";
				if( $post_data['password'] == "" )
					$error_messages[] = "Password field cannot be left empty.";
				if( $post_data['verify_password'] != $post_data['password'] )
					$error_messages[] = "Verify Password does not match Password field.";
				
				if ( !empty($error_messages) ) {
					flash($error_messages,"bad");
					unset($_POST); // so we don't loop forever...
					$method = "broker-add";
					break;
				} else {
					// fix state/province country data
					$state = substr($post_data['state_province'], -2);
					$country = substr($post_data['state_province'], 0, 2);
					$post_data['state_province'] = $state;
					if ( $country == "US" ) {
						$post_data['country'] = "United States";
					} elseif ( $country == "MX" ) {
						$post_data['country'] = "Mexico";
					} else {
						$post_data['country'] = "Canada";
					}
					$post_data['salt'] = $u->GetSalt($post_data['email']);
					$post_data['password'] = $u->SetPassword($post_data['password'], $post_data['salt']);
					// create the user
					$user = $u->CreateItem($post_data);
					// create the broker
					$b = new Broker();
					$broker = $b->CreateItem($post_data);
					// join the user to the broker
					$broker->addUser($user->id);
					
					if ( empty($user->id) || empty($broker->id) ) {
						$message = "There was a problem adding the broker.";
						flash($message,"bad");
					} else {
						$message = "Broker added succesfully.";
						flash($message);
					}
					$method = "broker-manager";
					break;
				}
				
			} elseif( !isset($post_data) ) {
				$b = new Broker();
				foreach($b as $key => $val) {
					$post_data[$key] = "";
				}
				$post_data['email'] = "";
			}
			
			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;

		case 'request-manager':
			
			$PAGE_TITLE 		= "Request Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Request List";									/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/request_manager.php";		/* which file to pull into the template */
			
			$r = new Request();
			$requests = $r->getAllItemsObj();
			
			// make array of objects to useful simple array
			$request_array = array();
			
			foreach ( $requests as $obj ) {
				if ( empty( $obj->request_snapshot ) ) {
					$joinObject = new Facility();
					$obj->join_facility = $obj->ReadJoins($joinObject);
					$joinObject = new Scrapper();
					$obj->join_scrapper = $obj->ReadJoins($joinObject);
					$joinObject = new Material();
					$obj->join_material = $obj->ReadJoins($joinObject);
					$request_array[] = (array) $obj;
				} else {
					$data = json_decode( $obj->request_snapshot, true );
					$data['request']['bid_count'] = $obj->bid_count;
					$request_array[] = $data;
				}
			}
			
			$requests = $request_array;
			
			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;

		case 'request-details':
			
			$PAGE_TITLE 		= "Request Manager";								/* Title text for this page */
			$SECTION_HEADER 	= "Request Details";									/* Header text for this page */
			$PAGE_BODY 			= $ss_path."views/manager/request_details.php";		/* which file to pull into the template */
			
			if (isset($_GET['request_id'])) {
				$itemId = $_GET['request_id'];
				// retrieved request object
				$r = new Request();
				$request = $r->GetItemObj($itemId);
				$snapshot = json_decode($request->request_snapshot,true);
//				$request->join_scrapper = $request->ReadJoins( new Scrapper() );
//				$request->join_facility = $request->ReadJoins( new Facility() );
//				$request->join_material = $request->ReadJoins( new Material() );
				// retrieve bid objects in an array
				$bids = $request->GetBids();
				$bids_array = array();
				foreach ($bids as $key => $val) {
					$b = new Bid();
					$bid = $b->GetItemObj($val['id']);
					$bid->join_broker = $b->ReadJoins( new Broker() );
					$bids_array[] = $bid;
				}
				
				$bids = $bids_array;
			} else {
				$message = "Your request id was not found in the system.";
				flash($message,"bad");
				$method = "request-manager";
				break;
			}
			
			//the layout file
			require($ss_path."views/layouts/manager_shell.php");
			$KILL = true;
		break;
			
		case 'request-remove':
			// get request object
			// get bid objects
			// remove joins
			// remove request
			if (isset($_GET['request_id'])) {
				$itemId = $_GET['request_id'];
				// retrieved request object
				$r = new Request();
				$request = $r->GetItemObj($itemId);
				$bids = $request->getBids(); // array of bids
				// clear the join table for this request
				$table = "gir_property_values_joins";
				$query = "DELETE tb FROM $table as tb WHERE tb.item_id = $itemId OR tb.value = $itemId;";
				$gir->crud->Query($query);
				$gir->crud->RemoveItem($itemId);
				if ( count($bids) > 0 ) {
					foreach ($bids as $bid) {
						$itemId = $bid['id'];
						$query = "DELETE tb FROM $table as tb WHERE tb.item_id = $itemId OR tb.value = $itemId;";
						$gir->crud->Query($query);
						$gir->crud->RemoveItem($itemId);
					}
				}
				flash( array( "Request #" . $request->id . " was removed successfully." ) );
				$method = "request-manager";
				break;
			}
			flash( array( "The request could not be found." ), "bad" );
			$method = "request-manager";
			break;
		break;
		
		default:
			die('No method found');
		break;
	}
}
?>