<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<style type="text/css">
	#register_now{display:none;}
	.brokerPricing label{font-weight:700}
	.brokerPricing .materials .w1 input{width:50px}
	.brokerPricing .materials .w2 input{width:110px}
	.brokerPricing .materials .w3 input{width:150px}
	.brokerPricing .materials .w1{width:70px}
	.brokerPricing .materials .w2{width:130px}
	.brokerPricing .materials .w3{width:160px}
	.brokerPricing li{float:left;display:block}
	.brokerPricing li label{width:100px}
	/*
.brokerPricing li input,
	.brokerPricing li select{clear:left}
*/
	.brokerPricing a{text-decoration:underline;}
	.brokerPricing .submitButton{text-align:left;}
	.brokerPricing .form.user li{margin-right:20px;}
	.brokerPricing label.error{clear:left; color:#F00}
	.brokerPricing input.required,
	.brokerPricing select.required{color:#000}
	.brokerPricing .message{padding:10px;width:100%;color:#0C0;font-weight:bold;font-size:15px;}
	.brokerPricing .message.error{color:#F00}
</style>
<div class="brokerPricing">
<?php if (isset($message)) { ?>
	<div class="message<?=isset($error)?' error':''?>"><?=$message;?></div>
<?php } ?>
	<p>All pricing contributions shall remain strictly confidential.</p>
	<form method="post" id="price_form">
		<ul class="form user">
			<li><strong>Jonathan Broker:</strong><input type="hidden" name="name" /><br />Broker Company<input type="hidden" name="company" /></li>
		</ul>
		<hr />
		
		
		<ul class="form user">
			<li class="w3">
				<select name="facility">
					<option value="">Select a Facility</option>	
					<option value="Facility_1" selected="selected">Facility One - Detroit, MI</option>	
					<option value="Facility_2">Facility Two - Columbus, OH</option>	
					<option value="Facility_3">Facility Three - Pittsburg, PA</option>	
					<option value="Facility_4">Facility Four - St Louis, MO</option>	
					<option value="Facility_5">Facility Five - Omaha, NE</option>	
				</select>
			</li>
			<li>555 N 5th Street<br />Detroit, MI 55555</li>
		</ul>
		<hr />
		<ul class="form materials">
			<li><label>#1 HMS:</label><input type="hidden" name="1_hms" /><input class="w1" type="text" name="qty" /></li>
			<li><label>#2 HMS:</label><input type="hidden" name="1_hms" /><input class="w1" type="text" name="qty" /></li>
			<li><label>MST:</label><input type="hidden" name="1_hms" /><input class="w1" type="text" name="qty" /></li>
			<li><label>Shredded:</label><input type="hidden" name="1_hms" /><input class="w1" type="text" name="qty" /></li>
			<li><label>#2 Bundles:</label><input type="hidden" name="1_hms" /><input class="w1" type="text" name="qty" /></li>
		</ul>
		<br />
		<input id="btnAdd" type="button" value="Add Material" />
		<hr />
		<ul class="form">
			<li>By contributing pricing to StrategicScrap.com, I agree that the pricing information I am providing on this form is accurate and representative of market conditions at the time of my reporting.</li>
			<li><input id="fromZip" style="width: 20px;" name="agree" type="checkbox" class="required" /><strong>*</strong>  I agree</li>
		</ul>
		<div class="submitButton">
			<input id="submitBid" alt="Submit Pricing o" name="submitPrice" src="resources/images/buttons/submit_pricing.png" type="image" />
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $("#price_form").validate();
		
		$('#btnAdd').click(function() {
			var num		= $('.clonedInput').length;	// how many "duplicatable" input fields we currently have
			var newNum	= new Number(num + 1);		// the numeric ID of the new input field being added
			var newElem = $('#item' + num).clone().attr('id', 'item' + newNum);

			$('#item' + num).after(newElem);
 
			$('#item' + newNum).find('select:first').attr('name', 'entry[' + num + '][material]')
			.parent().parent().next().find('input').attr('name', 'entry[' + num + '][quantity]')
			.parent().next().find('input').attr('name', 'entry[' + num + '][price]')
			.parent().next().find('input').attr('name', 'entry[' + num + '][facility]')
			.parent().next().find('input').attr('name', 'entry[' + num + '][city]')
			.parent().next().find('select').attr('name', 'entry[' + num + '][state]')
			.parent().next().find('input').attr('name', 'entry[' + num + '][notes]');

			$('#item' + newNum).find('select:first').focus();
		});
	});
</script>
