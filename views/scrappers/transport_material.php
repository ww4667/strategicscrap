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
			$_material_id = $_GET['material_id'];
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
				<div style="float: left; margin: 3px 0; padding: 5px; background:#ccc;width:490px;font-size:11px;">
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
							<strong>Zip Code:</strong> <?=isset( $user['postal_code'] ) ? $user['postal_code'] : ''?><br />
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
<?php
/*
							<strong>Name:</strong> <?=isset($facility['first_name']) && isset($facility['last_name']) ? $facility['first_name']. ' ' . $facility['last_name'] : ''?><br />
*/
?>							
							<hr />
							<strong>Address:</strong> <?=isset($facility['address_1']) ? $facility['address_1'] : ''?><br />
							<?php if(isset($facility['address_2']) && $facility['address_2'] != ''){ ?>
							<strong>Address 2: </strong> <?=isset($facility['address_2']) ? $facility['address_2'] : ''?><br />
							<?php } ?>
							<strong>City:</strong> <?=isset($facility['city']) ? $facility['city'] : ''?><br />
							<strong>State:</strong> <?=$facility['state_province'] ? $facility['state_province'] : ''?><br />
							<strong>Zip Code:</strong> <?=$facility['zip_postal_code'] ? $facility['zip_postal_code'] : ''?><br />
<?php
/*
							<hr />
							<strong>Phone:</strong> <?=$facility['business_phone'] ? $facility['business_phone'] : ''?><br />
							<strong>Fax:</strong> <?=$facility['fax_number'] ? $facility['fax_number'] : ''?><br />
 */
?>							
							
						</div>
					</div>
				</div>
	
					<input type="hidden" id="user_id" name="user_id" value="<?=isset($user['id']) ? $user['id'] : ''?>" /> 
					<input type="hidden" id="facility_id" name="facility_id" value="<?=isset($facility['id']) ? $facility['id'] : ''?>" />
				
					<?
					$materialName = "";
					if( isset( $facility['join_material'] ) && count($facility['join_material']) > 0 ){
						$i = 0; $l = count( $facility['join_material'] );
						while($i<$l){ 
							if( $facility['join_material'][$i]['id'] == $_material_id ) {
								print '<input type="hidden" id="material_id" name="material_id" value="'.$facility['join_material'][$i]['id'].'" />';
								$materialName = $facility['join_material'][$i]['name'];
								break;
							} 
							$i++; 
						}
					}
					?>
					<fieldset style="width:475px; border:1px solid #ccc; padding:10px; margin:5px 0;">
					
						<div style="color: #000;clear:both;margin:3px 0;display:block;height: 20px;">
							<div style="width:200px;float:left;font-weight: 900;">Shipping Material:</div>
							<label style="color:#000;float:left;font-weight:0;"><?=$materialName?></label></div>
					
						<div style="color: #000;clear:both;margin:3px 0;display:block;height: 20px;">
							<div style="width:200px;float:left;font-weight: 900;">Volume in Tons:</div>
							<label style="color:#000;float:left;font-weight:0;"><input type="text"  id="volume" name="volume" /></label></div>
	                                    
						<div style="color: #000;clear:both;margin:3px 0;display:block;height: 20px;">
							<div style="width:200px;float:left;font-weight: 900;">Preferred Transportation:</div>
							<label style="color:#000;float:left;font-weight:0;">
								<select id="transportation_type" name="transportation_type">
									<option value="">Select Transport Type</option>
								    <option value="van">Van</option>
								    <option value="flat_bed">Flat Bed</option>
								    <option value="drop_deck">Drop Deck</option>
								    <option value="step_deck">Step Deck</option>
								    <option value="gondola_open_top">Gondola/Open Top</option>
								    <option value="export_containers">Export Container</option>
								    <option value="end_dumps">End Dump</option>
								</select>
							</label>
						</div>
					
					
						<div style="color: #000;clear:both;margin:3px 0;display:block;height: 20px;">
							<div style="width:200px;float:left;font-weight: 900;">Ship Date:</div>
							<label style="color:#000;float:left;font-weight:0;"><input type="text"  id="ship_date" name="ship_date" class="date-pick" /></label></div>
					
						<div style="color: #000;clear:both;margin:3px 0;display:block;height: 20px;">
							<div style="width:200px;float:left;font-weight: 900;">Arrive Date:</div>
							<label style="color:#000;float:left;font-weight:0;"><input type="text"  id="arrive_date" name="arrive_date" class="date-pick" /></label></div>
					
						<div style="color: #000;clear:both;margin:3px 0;display:block;height: 20px;">
							<div style="width:200px;float:left;font-weight: 900;">Special Instructions:</div>
							<label style="color:#000;float:left;font-weight:0;"><textarea id="special_instructions" name="special_instructions" style="width:200px;"></textarea></label></div>
					
					</fieldset>
					<div style="text-align:center"><input style="height:46px;width:228px" id="submitRequest" alt="Submit Bid Request" name="submitBid" src="resources/images/buttons/submit_bid.png" type="image" /></div>
				</div>
				<div id="transport_request_response"></div>
				
  				<script type="text/javascript">
  				$(function() {
					
					$('#submitRequest').hover(function(){ 
					       $(this).attr('src', '/resources/images/buttons/submit_bid_hover.png'); 
					}, function(){ 
					       $(this).attr('src', '/resources/images/buttons/submit_bid.png'); 
					});
	  			  				
  					$('.date-pick')
  					.datePicker({createButton:false})
  					.bind(
  						'focus',
  						function(event, message)
  						{
  							if (message == $.dpConst.DP_INTERNAL_FOCUS) {
  								return true;
  							}
  							var dp = this;
  							var $dp = $(this);
  							$dp.dpDisplay();
  							$('*').bind(
  								'focus.datePicker',
  								function(event)
  								{
  									var $focused = $(this);
  									if (!$focused.is('.dp-applied')) // don't close the focused date picker if we just opened a new one!
  									{
  										// if the newly focused element isn't inside the date picker and isn't the original element which triggered
  										// the opening of the date picker

  										if ($focused.parents('#dp-popup').length == 0 && this != dp && !($.browser.msie && this == document.body)) {
  											$('*').unbind('focus.datePicker');
  											$dp.dpClose();
  										}
  									}
  								}
  							);
  							return false;
  						}
  					);

	  				
	  				$('#ship_date').bind(
	  					'dpClosed',
	  					function(e, selectedDates)
	  					{
	  						var d = selectedDates[0];
	  						if (d) {
	  							d = new Date(d);
	  							$('#arrive_date').dpSetStartDate(d.addDays(1).asString());
	  						}
  							$('*').unbind('focus.datePicker');
	  					}
	  				);
	  				
	  				$('#arrive_date').bind(
	  					'dpClosed',
	  					function(e, selectedDates)
	  					{
	  						var d = selectedDates[0];
	  						if (d) {
	  							d = new Date(d);
	  							$('#ship_date').dpSetEndDate(d.addDays(-1).asString());
	  						}
  							$('*').unbind('focus.datePicker');
	  					}
	  				);
	  				
	  			});

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