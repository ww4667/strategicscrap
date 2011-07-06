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
			if ($_location > 0) {
				$f = new Facility();
				$f->GetItemObj( $_location );
				$f->ReadJoins( new Material() );
				$facility = (array) $f;
				$isFacility = $facility['object_name_id'] == 1 ? true : false;
				$message = '';
				if($isFacility){
					$message = 'This is not a Facility.';	
				}
			} else {
				$m = new Material();
				$material_info = $m->GetItemObj( $_material_id );
				$facility = "";
			}
			
			$u = new Scrapper();
			$user = $u->getScrappersByUserId( $_SESSION['user']['id'] );
			$user = $user[0];
			
			
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
				<? 	if ($facility){
						if ($facility['category'] == "Broker" || $facility['category'] == "Exporter" ){ ?>
						<h2>TRANSPORTATION AND SCRAP REQUEST</h2>
						<hr />
						<p>This request form will be sent to our transportation network for shipping quotes. <br/>
						A pricing request will also be sent to the scrap broker listed below via email. Scrap brokers will contact you at their discretion.</p>	
						<?php  $send_broker_email = true; ?>
				<? 		} else { ?>
						<h2>TRANSPORTATION REQUEST</h2>
						<hr />
						<p>This request form will be sent to our transportation network for shipping quotes. 
				<?php 	
//						<p>Fill out the form below to receive bids from our national database of logistics experts.</p>
				} 
					} else { ?>
						<h2>TRANSPORTATION REQUEST</h2>
						<hr />
						<p>This request form will be sent to our transportation network for shipping quotes. 
					
					<?php }?>
				<div style="float: left; margin: 3px 0; padding: 5px; background:#ccc;width:490px;font-size:11px;" class = "custom_form">
					<div style="width:220px; float:left; margin:3px;">
						<strong>Shipper:</strong><br />
						<div style="padding:10px;">
							<strong>Company:</strong> <?=isset($user['company']) ? $user['company'] : ''?><br />
							<strong>Name:</strong> <?=isset($user['first_name']) && isset($user['last_name']) ? $user['first_name']. ' ' . $user['last_name'] : ''?><br />
							<hr />
							<strong>Shippers Address:</strong>
							<br />
							<input type = "hidden" id = "send_broker_email" name = "send_broker_email" value = "<?php echo ($send_broker_email) ? "true" : "false" ?> ?>" />
							<input type = "checkbox" class = "enable_fields" data-fieldset="from_information" />Change Information<br />
							<input type = "hidden" id = "edit_from_information" name = "edit_from_info" value = "false" />
							<div id = "from_information">
								<label>Address:</label> <input type ="text" id = "from_address_1" name = "address_1" disabled="true" value = "<?=isset($user['address_1']) ? $user['address_1'] : ''?>"  data-old = "<?=isset($user['address_1']) ? $user['address_1'] : ''?>" /><br />
								<?php if(isset($user['address_2']) && $user['address_2'] != ''){ ?>
								<label>Address2:</label>  <input type ="text" id = "from_address_2" name = "address_2" disabled="true" value = "<?=isset($user['address_2']) ? $user['address_2'] : ''?>"  data-old = "<?=isset($user['address_2']) ? $user['address_2'] : ''?>" /><br />
								<?php }?>
								<label>City:</label>  <input type ="text" id = "from_city" name = "city" disabled="true" value = "<?=isset($user['city']) ? $user['city'] : ''?>"  data-old = "<?=isset($user['city']) ? $user['city'] : ''?>" /><br />
								<label>State:</label>  <input type ="text" id = "from_state_province" class = "state_field" name = "state_province" disabled="true" value = "<?=$user['state_province'] ? $user['state_province'] : ''?>" data-old = "<?=$user['state_province'] ? $user['state_province'] : ''?>" />
								<label class = "zip_label">Zip</label>  <input type ="text" id = "from_postal_code" class = "zip_field" name = "postal_code" disabled="true" value = "<?=isset( $user['postal_code'] ) ? $user['postal_code'] : ''?>" data-old = "<?=isset( $user['postal_code'] ) ? $user['postal_code'] : ''?>" /><br />
								<label>Phone:</label>  <input type ="text" id = "from_work_phone" name = "work_phone" disabled="true" value = "<?=$user['work_phone'] ? $user['work_phone'] : ''?>" data-old = "<?=$user['work_phone'] ? $user['work_phone'] : ''?>" /><br />
								<label>Fax:</label>  <input type ="text" id = "from_fax_number" name = "fax_number" disabled="true" value = "<?=$user['fax_number'] ? $user['fax_number'] : ''?>" data-old = "<?=$user['fax_number'] ? $user['fax_number'] : ''?>" /><br />
								<label>Email:</label>  <?=$_SESSION['user']['username']?><br />
							</div>
						</div>
					</div>
					<script>
						$('document').ready(function(){
						
							$(".enable_fields").click(function(){
								
								fieldset = $(this).attr('data-fieldset');
								
								editing = $("#edit_" + fieldset).val();
								
								//console.log("fields: " + fieldset + " editing: " + editing );
								
								if(editing == "true"){													
									$("#" + fieldset + " input").attr("disabled", true);
									$("#" + fieldset + " input").each(function(i,e){
										el = $(e);
										el.val(el.attr("data-old"));
									});
						
									$("#edit_" + fieldset).val("false")
								} else {										
									$("#" +  fieldset + " input").attr("disabled", false);
									$("#edit_" + fieldset).val("true")
								}
							});
						});
					</script>
						<div style="width:220px; float:left; margin:3px;">
							<strong>Ship To:</strong><br />
							<div style="padding:10px;">
							<? if($_location == 0) {?>
								<div id = "to_information">
									<label>Company:</label>
										<input type ="text" id = "to_company"  name = "to_company"/><br />
									<hr />
									<strong>Facility Address:</strong>
									<div id = "to_information">
										<label>Address:</label> <input type ="text" id = "to_address_1"  name = "facility_address_1"  /><br />
										<label>Address2:</label>  <input type ="text" id = "to_address_2" name = "facility_address_2"/><br />
										<label>City:</label>  <input type ="text" id = "to_city" name = "city"/><br />
										<label>State:</label>  <input type ="text" class = "state_field" id = "to_state_province" name = "facility_state_province" />
										<label class = "zip_label">Zip:</label>  <input type ="text" class = "zip_field" id = "to_zip_postal_code" name = "facility_postal_code" /><br />
										<label>Country:</label>  <input type ="text" id = "to_country" name = "facility_postal_code" /><br />
									</div>
								</div>
							<? } else {?>
								<strong>Company:</strong> <?= $facility['company'] ?><br />					
								<hr />
								<strong>Address:</strong> <?=isset($facility['address_1']) ? $facility['address_1'] : ''?><br />
								<?php if(isset($facility['address_2']) && $facility['address_2'] != ''){ ?>
								<strong>Address 2: </strong> <?=isset($facility['address_2']) ? $facility['address_2'] : ''?><br />
								<?php } ?>
								<strong>City:</strong> <?=isset($facility['city']) ? $facility['city'] : ''?><br />
								<strong>State:</strong> <?=$facility['state_province'] ? $facility['state_province'] : ''?><br />
								<strong>Zip Code:</strong> <?=$facility['zip_postal_code'] ? $facility['zip_postal_code'] : ''?><br />
							<?php
							}
							/*
							<hr />
							<strong>Facility Address:</strong><input type = "checkbox" class = "enable_fields" data-fieldset="to_information" />Change Information<br />
							<input type = "hidden" id = "edit_to_information" name = "edit_to_info" value = "false" />
							<div id = "to_information">
								<strong>Address:</strong> <input type ="text" id = "to_address_1"  name = "facility_address_1" disabled="true" value = "<?=isset($facility['address_1']) ? $facility['address_1'] : ''?>"  data-old = "<?=isset($facility['address_1']) ? $facility['address_1'] : ''?>" /><br />
								<?php if(isset($facility['address_2']) && $facility['address_2'] != ''){ ?>
								<strong>Address2:</strong>  <input type ="text" id = "to_address_2" name = "facility_address_2" disabled="true" value = "<?=isset($facility['address_2']) ? $facility['address_2'] : ''?>"  data-old = "<?=isset($facility['address_2']) ? $facility['address_2'] : ''?>" /><br />
								<?php }?>
								<strong>City:</strong>  <input type ="text" id = "to_city" name = "city" disabled="true" value = "<?=isset($facility['city']) ? $facility['city'] : ''?>"  data-old = "<?=isset($facility['city']) ? $facility['city'] : ''?>" /><br />
								<strong>State:</strong>  <input type ="text" id = "to_state_province" name = "facility_state_province" disabled="true" value = "<?=$facility['state_province'] ? $facility['state_province'] : ''?>" data-old = "<?=$facility['state_province'] ? $facility['state_province'] : ''?>" /><br />
								<strong>Zip Code:</strong>  <input type ="text" id = "to_postal_code" name = "facility_postal_code" disabled="true" value = "<?=isset( $facility['zip_postal_code'] ) ? $facility['zip_postal_code'] : ''?>" data-old = "<?=isset( $facility['zip_postal_code'] ) ? $facility['zip_postal_code'] : ''?>" /><br />
							</div>
							<strong>Name:</strong> <?=isset($facility['first_name']) && isset($facility['last_name']) ? $facility['first_name']. ' ' . $facility['last_name'] : ''?><br />
							*/
							?>	
					</div>
					</div>
				</div>
	
					<input type="hidden" id="user_id" name="user_id" value="<?=isset($user['id']) ? $user['id'] : ''?>" /> 
					<input type="hidden" id="facility_id" name="facility_id" value="<?=isset($facility['id']) ? $facility['id'] : $_location ?>" />
				
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
					
					if(isset($material_info)){
						print '<input type="hidden" id="material_id" name="material_id" value="'. $material_info->id .'" />';
						$materialName = $material_info->name;
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
							<div style="width:200px;float:left;font-weight: 900;">Ship on or before this date:</div>
							<label style="color:#000;float:left;font-weight:0;"><input type="text"  id="ship_date" name="ship_date" class="date-pick" /></label></div>
					
						<div style="color: #000;clear:both;margin:3px 0;display:block;height: 20px;">
							<div style="width:200px;float:left;font-weight: 900;">Deliver on or before this date:</div>
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
//	  							$('#arrive_date').dpSetStartDate(d.addDays(1).asString());
	  							$('#arrive_date').dpSetStartDate(d.addDays(0).asString());
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
<?
					$field_list  = "";
					$fields_to_post = array("send_broker_email", "transportation_type", "edit_from_information", "edit_to_information", "volume", "user_id", "facility_id", "material_id", "transportation_id", "ship_date", "arrive_date", "special_instructions", "edit_from_information", "edit_to_information", "from_address_1", "from_address_2", "from_city", "from_state_province", "from_postal_code", "from_work_phone", "from_fax_number", "to_company", "to_address_1", "to_address_2", "to_city", "to_state_province", "to_zip_postal_code", "to_country");
					?>
						            	
					$.post("/controllers/remote/?method=addRequest&", 
				            {	
			            	<? 
			            	foreach ($fields_to_post as $f){ 
			            		$field_list .= $f .' : $("#' . $f . '").val(), ';
			            	}	
			            		print trim($field_list, ", "); 
			            	?>
			            	},			            	
			                	
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