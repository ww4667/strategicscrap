<?php 
if(!$gir->auth->authenticate()){
	?>
	<p>You are not logged in. Please login or register to use this feature.</p>
	<?
} else {
	if( $_SESSION['user']['group'] != 'scrapper' ){
		print "This feature is reserved.";
	} else {
		if(!isset($_GET['id'])){
			print "You need a location for this feature to work. Please select a location from <a href='/scrap-exchange'>Scrap Exchange</a>.";
		} else {
			$_location = $_GET['id'];
			$f = new Facility();
			$f->GetItemObj( $_location );
			$f->ReadJoins( new Material() );
			$facility = (array) $f;
			
			$u = new Scrapper();
			$user = $u->getScrappersByUserId( $_SESSION['user']['id'] );
			$user = $user[0];
			
			$isFacility = $facility['object_name_id'] == 1 ? true : false;
			$message = '';
			if($isFacility){
				$message = 'This is not a Facility.';	
			}
			if ( isset($_POST['ship_date']) ) {
				$post_data = $_POST;
				// need to do some cleanup and validation first
				// let's drop the data in the db
				$r = new Request();
				$itemId = $r->CreateItem($post_data);
				$request = $r->GetItemObj($itemId);
				// attach facility, scrapper and material to the request
				$request->addFacility($post_data['facility_id']);
				// we have the user id so... technically this is attaching a user id not a scrapper id
				// will have to see how this affects the system
				$request->addScrapper($post_data['user_id']);
				$request->addMaterial($post_data['material_id']);
				// if all creates/adds worked then
				// redirect to the default homepage
				$message = array();
				$message[] = "Request has been submitted.";
				flash($message);
				$url = "/regions/northeast";
				redirect_to($url);
			}
			?>
			
			<script >
			$(function() {
				
				
				$( "#shipDate, #arriveDate" ).datepicker({
					showOtherMonths: true,
					selectOtherMonths: true
						
				});
				
			});
			</script>

			<p>Fill out the form below to receive bids from our national database of logistics experts.</p>
			<form class="clearfix" action="" method="post">
				<input type="hidden" name="user_id" value="<?=isset($user['id']) ? $user['id'] : ''?>" /> 
				<input type="hidden" name="facility_id" value="<?=isset($facility['id']) ? $facility['id'] : ''?>" />
				<fieldset>
				<legend>Ship From:</legend>							
				<ul class="form">
				<li><label>Name:</label><input id="fromName" name="fromName" type="text" disabled="disabled" value="<?=isset($user['first_name']) && isset($user['last_name']) ? $user['first_name']. ' ' . $user['last_name'] : ''?>" /></li>
				<li><label>Address:</label><input id="fromAddy" name="fromAddy" type="text" disabled="disabled" value="<?=isset($user['address_1']) ? $user['address_1'] : ''?>" /></li>
				<?php if(isset($user['address_2']) && $user['address_2'] != ''){ ?>
				<li><label>Address2:</label><input id="fromAddy" name="fromAddy" type="text" disabled="disabled" value="<?=isset($user['address_2']) ? $user['address_2'] : ''?>" /></li>
				<?php }?>
				<li><label>City:</label><input id="fromCity" name="fromCity" type="text" disabled="disabled" value="<?=isset($user['city']) ? $user['city'] : ''?>" /></li>
				</ul>
				<ul class="form hii">
				<li><label class="firstLabel">State:</label><input id="fromState" name="fromState" type="text" disabled="disabled" value="<?=$user['state_province'] ? $user['state_province'] : ''?>" /></li>
				<li><label>Zip Code:</label><input id="fromZip" name="fromZip" type="text" disabled="disabled" value="<?=$user['zip_postal_code'] ? $user['zip_postal_code'] : ''?>" /></li>
				</ul>
				<ul class="form">
				<li><label>Phone:</label><input id="fromPhone" name="fromPhone" type="text" disabled="disabled" value="<?=$user['work_phone'] ? $user['work_phone'] : ''?>" /></li>
				<li><label>Fax:</label><input id="fromFax" name="fromFax" type="text" disabled="disabled" value="<?=$user['fax_number'] ? $user['fax_number'] : ''?>" /></li>
				<li><label>Email:</label><input id="fromEmail" name="fromEmail" type="text" disabled="disabled" value="<?=$_SESSION['user']['username']?>" /></li>
				<li><label>Special Instruction:</label><textarea id="special_instructions" name="special_instructions"></textarea></li>
				</ul>
				</fieldset>
				<fieldset>
				<legend>Ship To:</legend>
				<ul class="form">
				<li><label>Company:</label><input id="companyName" name="companyName" type="text" disabled="disabled" value="<?= $facility['company'] ?>" /></li>
				<li><label>Name:</label><input id="toName" name="toName" type="text" disabled="disabled" value="<?=isset($facility['first_name']) && isset($facility['last_name']) ? $facility['first_name']. ' ' . $facility['last_name'] : ''?>" /></li>
				<li><label>Address:</label><input id="toAddress1" name="toAddy1" type="text" disabled="disabled" value="<?=isset($facility['address_1']) ? $facility['address_1'] : ''?>" /></li>
				<?php if(isset($facility['address_2']) && $facility['address_2'] != ''){ ?>
				<li><label> </label><input id="toAddress2" name="toAddy2" type="text" disabled="disabled" value="<?=isset($facility['address_2']) ? $facility['address_2'] : ''?>" /></li>
				<?php } ?>
				<li><label>City:</label><input id="toCity" name="toCity" type="text" disabled="disabled" value="<?=isset($facility['city']) ? $facility['city'] : ''?>" /></li>
				</ul>
				<ul class="form hii">
				<li><label class="firstLabel">State:</label><input id="toState" name="toState" type="text" disabled="disabled" value="<?=$facility['state_province'] ? $facility['state_province'] : ''?>" /></li>
				<li><label>Zip Code:</label><input id="toZip" name="toZip" type="text" disabled="disabled" value="<?=$facility['zip_postal_code'] ? $facility['zip_postal_code'] : ''?>" /></li>
				</ul>
				<ul class="form">
				<li><label>Phone:</label><input id="toPhone" name="toPhone" type="text" disabled="disabled" value="<?=$facility['business_phone'] ? $facility['business_phone'] : ''?>" /></li>
				<li><label>Fax:</label><input id="toFax" name="toFax" type="text" disabled="disabled" value="<?=$facility['fax_number'] ? $facility['fax_number'] : ''?>" /></li>
				<li><label>Material:</label>
						<?
						$op = '<option>No Materials</option>';
						if( isset( $facility['join_material'] ) && count($facility['join_material']) > 0 ){
							$i = 0; $l = count( $facility['join_material'] );
							$op = '<option value="">--SELECT ONE--</option>';
							while($i<$l){ $op .= '<option value="'.$facility['join_material'][$i]['id'].'">'.$facility['join_material'][$i]['name'].'</option>'; $i++; }
						}
						print '<select id="material_id" name="material_id">'.$op.'</select>';
						?>
				</li>
				</ul>
				<ul class="form hii">
				<li><label class="firstLabel">Volume:</label><input type="text"  id="volume" name="volume" /></li>
				<li><label>Preferred Transportation:</label><select id="transportation_type" name="transportation_type">
					<option value="">Select Transport Type</option>
				    <option value="van">Van</option>
				    <option value="flat_bed">Flat Bed</option>
				    <option value="drop_deck">Drop Deck</option>
				    <option value="step_deck">Step Deck</option>
				    <option value="gondola_open_top">Gondola/Open Top</option>
				    <option value="export_containers">Export Containers</option>
				    <option value="end_dumps">End Dumps</option>
					</select></li>
				<li class="cb"><label class="firstLabel">Ship Date:</label><input type="text"  id="ship_date" name="ship_date" /></li>
				<li><label>Arrive Date:</label><input type="text" id="arrive_date" name="arrive_date" /></li>
				<li class="cb"><label class="firstLabel">Bid type:</label><select id="bid_type"><option></option></select></li>
				</ul>
				<div class="submitButton">
				<input id="submitBid" alt="Submit Bid Request" name="submitBid" src="resources/images/buttons/submit_bid.png" type="image" />
				</div>
				</fieldset>
			</form>
		<?php } ?>
	<?php } ?>
<?php } ?>