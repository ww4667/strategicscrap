<?php 

if( !session_id() ) {
	require_once($_SERVER['DOCUMENT_ROOT']."/gir/core/models/crud/Crud.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/gir/modules/request/Request.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/gir/modules/bid/Bid.php");
	
	if( !empty($_GET['session_id']) ) session_id($_GET['session_id']);
	if(!isset($_SESSION)) session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/gir/index.php");
}


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
			?>
			
			<script type="text/javascript">
			$(function() {
				
				
				$( "#shipDate, #arriveDate" ).datepicker({
					showOtherMonths: true,
					selectOtherMonths: true
						
				});
				
			});
			</script>
			<div id="transport_request_form">
			<p>Fill out the form below to receive bids from our national database of logistics experts.</p>
			<div style="float:left; margin:3px; padding: 5px; border: 1px solic #ccc; background: #efefef">
				<div style="width:220px; float:left; margin:3px;">
					<strong>Ship From:</strong><br />
					<div style="padding:10px;">
						<strong>Company:</strong> <?=isset($user['company']) ? $user['company'] : ''?><br />
						<strong>Name:</strong> <?=isset($user['first_name']) && isset($user['last_name']) ? $user['first_name']. ' ' . $user['last_name'] : ''?><br />
						<hr />
						<strong>Address:</strong> <?=isset($user['address_1']) ? $user['address_1'] : ''?><br />
						<?php if(isset($user['address_2']) && $user['address_2'] != ''){ ?>
						<strong>Address2:</strong> <?=isset($user['address_2']) ? $user['address_2'] : ''?><br />
						<?php }?>
						<strong>City:</strong> <?=isset($user['city']) ? $user['city'] : ''?><br />
						<strong>State:</strong> <?=$user['state_province'] ? $user['state_province'] : ''?><br />
						<strong>Zip Code:</strong> <?=isset( $user['zip_postal_code'] ) ? $user['zip_postal_code'] : ''?><br />
						<hr />
						<strong>Phone:</strong> <?=$user['work_phone'] ? $user['work_phone'] : ''?><br />
						<strong>Fax:</strong> <?=$user['fax_number'] ? $user['fax_number'] : ''?><br />
						<strong>Email:</strong> <?=$_SESSION['user']['username']?><br />
					</div>
				</div>
				<div style="width:220px; float:left; margin:3px;">
					<strong>Ship To:</strong><br />
					<div style="padding:10px;">
	
						<strong>Company:</strong> <?= $facility['company'] ?><br />
						<strong>Name:</strong> <?=isset($facility['first_name']) && isset($facility['last_name']) ? $facility['first_name']. ' ' . $facility['last_name'] : ''?><br />
						<hr />
						<strong>Address:</strong> <?=isset($facility['address_1']) ? $facility['address_1'] : ''?><br />
						<?php if(isset($facility['address_2']) && $facility['address_2'] != ''){ ?>
						<strong>Address 2: </strong> <?=isset($facility['address_2']) ? $facility['address_2'] : ''?><br />
						<?php } ?>
						<strong>City:</strong> <?=isset($facility['city']) ? $facility['city'] : ''?><br />
						<strong>State:</strong> <?=$facility['state_province'] ? $facility['state_province'] : ''?><br />
						<strong>Zip Code:</strong> <?=$facility['zip_postal_code'] ? $facility['zip_postal_code'] : ''?><br />
						<hr />
						<strong>Phone:</strong> <?=$facility['business_phone'] ? $facility['business_phone'] : ''?><br />
						<strong>Fax:</strong> <?=$facility['fax_number'] ? $facility['fax_number'] : ''?><br />
						
					</div>
				</div>
			</div>

				<input type="hidden" id="user_id" name="user_id" value="<?=isset($user['id']) ? $user['id'] : ''?>" /> 
				<input type="hidden" id="facility_id" name="facility_id" value="<?=isset($facility['id']) ? $facility['id'] : ''?>" />
				<fieldset>
				<ul class="form hii">
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
				<li><label class="firstLabel">Volume:</label><input type="text"  id="volume" name="volume" /></li>
				<li><label>Preferred Transportation:</label>
					<select id="transportation_type" name="transportation_type">
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
				<li><label>Special Instruction:</label><textarea id="special_instructions" name="special_instructions"></textarea></li>
				</ul>
				<div class="submitButton">
				<input id="submitRequest" alt="Submit Bid Request" name="submitBid" src="resources/images/buttons/submit_bid.png" type="image" />
				</div>
				</fieldset>
				</div>
				<div id="transport_request_response"></div>
				<script type="text/javascript">

				$("#submitRequest").click(function() {
				    if ($("#volume").val() != "" && 
						$("#transportation_type option:selected").val() != "" && 
						$("#material_id").val() != "" && 
						$("#user_id").val() != "" && 
						$("#facility_id").val() != "" && 
						$("#ship_date").val() != "" && 
						$("#arrive_date").val() != "" ) {

				        $.post("/controllers/remote/?method=addRequest&", 
				            {	volume: $("#volume").val(),
				            	user_id :  $("#user_id").val(),
				            	facility_id : $("#facility_id").val(),
				            	material_id : $("#material_id").val(),
				            	transportation_type : $("#transportation_type").val(),
				            	ship_date : $("#ship_date").val(),
				            	arrive_date : $("#arrive_date").val(),
				            	special_instructions : $("#special_instructions").val() },
				           function( data ){

								$("#volume").val(''); 
								$("#material_id").val('');
								$("#user_id").val('');
								$("#facility_id").val('');
								$("#transportation_type").val('');
								$("#ship_date").val(''); 
								$("#arrive_date").val(''); 
								$("#special_instructions").val('');
								$("#transport_request_form").hide();
								$("#transport_request_response").html('<h2>Success!</h2><p>Your transport request has been submitted and added to your dashboard. You can close this window, or it will be scrapped.</p>').show();
								$.colorbox.resize();
								colorboxTimeOut = setTimeout( function(){ clearTimeout(colorboxTimeOut); $.colorbox.close(); }, 5000 );
				           });
				         
				        return false;
				    }
				    
				    return false;
				  });
				</script>
		<?php } ?>
	<?php } ?>
<?php } ?>