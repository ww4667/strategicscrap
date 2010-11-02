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
	.brokerPricing li{float:left;display:block;width:auto}
	.brokerPricing li label{float:left}
	.brokerPricing li input,
	.brokerPricing li select{clear:left}
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
			<li><label><strong>*</strong> Name</label><input type="text" name="name" class="required" /></li>
			<li><label><strong>*</strong> Company</label><input type="text" name="company" class="required" /></li>
		</ul>
		<hr />
		<div class="array">
			<div id="item1" class="clonedInput">
				<ul class="form materials">
					<li class="w3"><label>&nbsp;<br />Material</label>
						<select name="entry[0][material]">
							<option value="">Select a Material</option>	
							<option value="80_20">80/20 mix (80% No.1 HMS / 20% No.2 HMS)</option>	
							<option value="no_1_hms">No. 1 HMS</option>	
							<option value="no_2_hms">No. 2 HMS</option>	
							<option value="no_1_db">No. 1 Dealer Bundles</option>	
							<option value="no_1_half_db">No. 1 1/2 Bundles</option>	
							<option value="no_2_db">No. 2 Bundles</option>	
							<option value="no_1_bush">No. 1 Busheling</option>	
							<option value="shredded">Shredded Scrap</option>	
							<option value="mach_shop">Machine Shop Turnings</option>	
							<option value="borings">Cast Iron Borings</option>	
							<option value="plate_2">Plate and Structural, 2 ft and under</option>
							<option value="plate_5">Plate and Structural, 5 ft. and under</option>	
							<option value="no_1_mach_cast">No. 1 Machinery Cast</option>	
							<option value="rails">Rails Scrap, 2 ft. and under</option>	
							<option value="cupola">Cupola Cast</option>
						</select>
					</li>
				</ul>
				<ul class="form materials">
					<li class="w1"><label>&nbsp;<br />Qty/GT</label><input type="text" name="entry[0][quantity]" /></li>
					<li class="w1"><label>Delivered<br />Price/GT</label><input type="text" name="entry[0][price]" /></li>
					<li class="w2"><label>Mill/Foundry Name</label><input type="text" name="entry[0][facility]" /></li>
					<li class="w2"><label>&nbsp;<br />City</label><input type="text" name="entry[0][city]" /></li>
					<li class="w3"><label>&nbsp;<br />State</label>
						<select name="entry[0][state]" class="required"> 
							<option value="" selected="selected">Select a State</option> 
							<option value="AL">Alabama</option> 
							<option value="AK">Alaska</option> 
							<option value="AZ">Arizona</option> 
							<option value="AR">Arkansas</option> 
							<option value="CA">California</option> 
							<option value="CO">Colorado</option> 
							<option value="CT">Connecticut</option> 
							<option value="DE">Delaware</option> 
							<option value="DC">District Of Columbia</option> 
							<option value="FL">Florida</option> 
							<option value="GA">Georgia</option> 
							<option value="HI">Hawaii</option> 
							<option value="ID">Idaho</option> 
							<option value="IL">Illinois</option> 
							<option value="IN">Indiana</option> 
							<option value="IA">Iowa</option> 
							<option value="KS">Kansas</option> 
							<option value="KY">Kentucky</option> 
							<option value="LA">Louisiana</option> 
							<option value="ME">Maine</option> 
							<option value="MD">Maryland</option> 
							<option value="MA">Massachusetts</option> 
							<option value="MI">Michigan</option> 
							<option value="MN">Minnesota</option> 
							<option value="MS">Mississippi</option> 
							<option value="MO">Missouri</option> 
							<option value="MT">Montana</option> 
							<option value="NE">Nebraska</option> 
							<option value="NV">Nevada</option> 
							<option value="NH">New Hampshire</option> 
							<option value="NJ">New Jersey</option> 
							<option value="NM">New Mexico</option> 
							<option value="NY">New York</option> 
							<option value="NC">North Carolina</option> 
							<option value="ND">North Dakota</option> 
							<option value="OH">Ohio</option> 
							<option value="OK">Oklahoma</option> 
							<option value="OR">Oregon</option> 
							<option value="PA">Pennsylvania</option> 
							<option value="RI">Rhode Island</option> 
							<option value="SC">South Carolina</option> 
							<option value="SD">South Dakota</option> 
							<option value="TN">Tennessee</option> 
							<option value="TX">Texas</option> 
							<option value="UT">Utah</option> 
							<option value="VT">Vermont</option> 
							<option value="VA">Virginia</option> 
							<option value="WA">Washington</option> 
							<option value="WV">West Virginia</option> 
							<option value="WI">Wisconsin</option> 
							<option value="WY">Wyoming</option>
						</select>
					</li>
					<li class="w3"><label>&nbsp;<br />Notes</label><input type="text" name="entry[0][notes]" /></li>
				</ul>
			</div>
		</div>
		<br />
		<input id="btnAdd" type="button" value="Add Another Entry" />
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
