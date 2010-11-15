<?php 

$_location = $_GET['id'];
$f = new Facility();
$f->GetItemObj($_location);
$f->ReadJoins( new Material() );
$facility = (array) $f;

$isFacility = $facility['object_name_id'] == 1 ? true : false;
$message = '';
if($isFacility){
	$message = 'This is not a Facility.';	
}
?>

<p>Fill out the form below to receive bids from our national database of logistics experts.</p>
<form class="clearfix" action="#">
<fieldset>
<legend>Ship From:</legend>							
<ul class="form">
<li><label>Name:</label><input id="fromName" name="fromName" type="text" /></li>
<li><label>Address:</label><input id="fromAddy" name="fromAddy" type="text" /></li>
<li><label>City:</label><input id="fromCity" name="fromCity" type="text" /></li>
</ul>
<ul class="form hii">
<li><label class="firstLabel">State:</label><input id="fromState" name="fromState" type="text" /></li>
<li><label>Zip Code:</label><input id="fromZip" name="fromZip" type="text" /></li>
</ul>
<ul class="form">
<li><label>Phone:</label><input id="fromPhone" name="fromPhone" type="text" /></li>
<li><label>Phone 2:</label><input id="fromPhone2" name="fromPhone2" type="text" /></li>
<li><label>Fax:</label><input id="fromFax" name="fromFax" type="text" /></li>
<li><label>Email:</label><input id="fromEmail" name="fromEmail" type="text" /></li>
<li><label>Special Instruction:</label><textarea id="specialInstructions" name="specialInstructions"></textarea></li>
</ul>
</fieldset>
<fieldset>
<legend>Ship To:</legend>
<ul class="form">
<li><label>Name:</label><input id="toName" name="toName" type="text" disabled="disabled" value="<?=isset($facility['first_name']) || isset($facility['last_name']) ? $facility['first_name']. ' ' . $facility['last_name'] : ''?>" /></li>
<li><label>Address:</label><input id="toAddress1" name="toAddy1" type="text" disabled="disabled" value="<?=isset($facility['address_1']) ? $facility['address_1'] : ''?>" /></li>
<?php if($facility['address_2'] != ''){ ?>
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
		if( isset( $facility['material_join'] ) && count($facility['material_join']) > 0 ){
			$i = 0; $l = count( $facility['material_join'] );
			$op = '<option>--SELECT ONE--</option>';
			while($i<$l){ $op .= '<option value="'.$facility['material_join'][$i]['id'].'">'.$facility['material_join'][$i]['name'].'</option>'; $i++; }
		}
		print '<select id="materials" name="materials">'.$op.'</select>';
		?>
	
</li>
</ul>
<ul class="form hii">
<li><label class="firstLabel">Volume:</label><select id="volume" name="volume"><option></option></select></li>
<li><label>Preferred Transportation:</label><select id="transportation" name="transportation">
	<option value="">Select Transport Type</option>
    <option value="">Van</option>
    <option value="">Flat Bed</option>
    <option value="">Drop Deck</option>
    <option value="">Step Deck</option>
    <option value="">Gondola/Open Top</option>
    <option value="">Export Containers</option>
    <option value="">End Dumps</option>
	</select></li>
<li class="cb"><label class="firstLabel">Ship Date:</label><select id="shipDate" name="shipDate"><option></option></select></li>
<li><label>Arrive Date:</label><select id="arriveDate" name="arriveDate"><option></option></select></li>
<li class="cb"><label class="firstLabel">Bid type:</label><select id="bidType"><option></option></select></li>
</ul>
<div class="submitButton">
<input id="submitBid" alt="Submit Bid Request" name="submitBid" src="resources/images/buttons/submit_bid.png" type="image" />
</div>
</fieldset>
</form>