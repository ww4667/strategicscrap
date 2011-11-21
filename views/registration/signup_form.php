<style type="text/css">
#subscription_details p {padding: 0;margin-bottom: 1.2em;font-size: 1.5em;line-height: 1.2em;font-family: Georgia,Serif;color: #555;}
</style>

<?php
if (!$_GET['pay']){ 
?>
<p>Fill out your registration below to get started.</p>
<form action"" class="clearfix" method="post">
<fieldset>
<legend>Required Information:</legend>							
<ul class="form">
<li><label>First Name:</label><input name="first_name" type="text" value="<?=$post_data['first_name']?>" /></li>
<li><label>Last Name:</label><input name="last_name" type="text" value="<?=$post_data['last_name']?>" /></li>
<li><label>Email:</label><input name="email" type="text" value="<?=$post_data['email']?>" /></li>
</ul>
<ul class="form hii">
<li><label class="firstLabel">Password:</label><input name="password" type="password" /></li>
<li><label class="firstLabel">Verify Password:</label><input name="verify_password" type="password" /></li>
</ul>
<ul class="form">
<li><label>Company Name:</label><input name="company" type="text" value="<?=$post_data['company']?>" /></li>
<li><label>Address 1:</label><input name="address_1" type="text" value="<?=$post_data['address_1']?>" /></li>
<li><label>Address 2 (optional):</label><input name="address_2" type="text" value="<?=$post_data['address_2']?>" /></li>
<li><label>City:</label><input name="city" type="text" value="<?=$post_data['city']?>" /></li>
<li><label>State/Province:</label><?php print state_province_select("full","state_province","state_province","","") ?></li>
<li><label>Postal Code:</label><input name="postal_code" type="text" value="<?=$post_data['postal_code']?>" /></li>
<li><label>Work Phone:</label><input name="work_phone" type="text" value="<?=$post_data['work_phone']?>" /></li>
</ul>
<div class="submitButton">
<input id="submitRegistration" alt="Submit Registration" name="submitReg" src="resources/images/buttons/submit_registration.png" type="image" />
</div>
</fieldset>
<fieldset>
<legend>Payment Information:</legend>
<ul class="form">
<li>You are signing up for a trial account. Pay Later!</li>
</ul>
</fieldset>
</form>
<script type="text/javascript">
	$('#submitRegistration').hover(function(){ 
	       $(this).attr('src', '/resources/images/buttons/submit_registration_hover.png'); 
	}, function(){ 
	       $(this).attr('src', '/resources/images/buttons/submit_registration.png'); 
	}); 
</script>
<?php } else { ?>

<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery.validate/1.6/jquery.validate.min.js"></script> 
<p>Fill out your registration below to get started.</p>
<form action"" class="clearfix" method="post" id = "scrap_sign_up">
<fieldset>
<legend>Account Information:</legend>							
<ul class="form">
<li><label>Email:</label><input name="email" type="text" value="<?=$post_data['email']?>" /></li>
</ul>
<ul class="form hii">
<li><label class="firstLabel">Password:</label><input name="password" type="password" /></li>
<li><label class="firstLabel">Verify Password:</label><input name="verify_password" type="password" /></li>
</ul>
<hr style="width:370px;margin:20px 0" />
<legend>Billing Information:</legend>
<ul class="form">
<li><label>First Name:</label><input name="first_name" type="text" value="<?=$post_data['first_name']?>" /></li>
<li><label>Last Name:</label><input name="last_name" type="text" value="<?=$post_data['last_name']?>" /></li>
<li><label>Phone:</label><input name="phone" type="text" value="<?=$post_data['phone']?>" /></li>
<li><label>Address:</label><input name="address_1" type="text" value="<?=$post_data['address_1']?>" /></li>
<li><label>Address 2:</label><input name="address_2" type="text" value="<?=$post_data['address_2']?>" /></li>
<li><label>City:</label><input name="city" type="text" value="<?=$post_data['city']?>" /></li>
<li><label>State:</label>
<?php print state_select("full","state","state_select","",""); ?>
</li>
<li><label>Zip:</label><input name="zip" type="text" value="<?=$post_data['zip']?>" /></li>
</ul>
</fieldset>
<fieldset>
<legend>Become a Member:</legend>
<div id="subscription_details">
<p>Sign up now for this special introductory offer of $699/year.</p>
</div>
<hr style="width:370px;margin:20px 0" />
<legend>Credit Card Information:</legend>
<ul class="form">
<li><label>Card Type:</label>
<select name="creditcardtype" class="" id = "credit_card_type">
								<option value="visa">Visa</option>
								<option value="mastercard">MasterCard</option>
								<option value="discover">Discover</option>
							</select>
</li>
<li><label>Cardhoder Name:</label><input name="card_holder_name" id="card_holder_name" type="text" value="<?=$post_data['card_holder_name']?>" /></li>
<li><label>Card Number:</label><input name="card_number" id="card_number" type="text" value="<?=$post_data['card_number']?>" /></li>
</ul>
<ul class="form hii">
<li><label class="firstLabel">Verification Code:</label><input name="card_code" type="text" value="<?=$post_data['card_code']?>" /></li>
<li style='clear: both;'><label>Expiration Date:</label>
<?= month_select('ccmonth','ccmonth','ccmonth') ?> <?= year_select(date('y'),(date('y')+10),'ccyear','ccyear') ?></li>
<?php //print month_select("expire_month"); ?>
<?php //print year_select(date("Y"),date("Y")+10,"expire_year"); ?>
</ul>
<hr style="width:370px;margin:20px 0" />
<ul class="form">
<li	style="font-size:10px">
The purchase price you have selected above will be billed to your credit card and will automatically renew your subscription at the end of your agreed upon term. 
</li>
<li>
<input style="width:20px" type="checkbox" name="agree" /> I have read and agree to the <a style="text-decoration:underline" href="/terms-and-conditions" target="blank">Terms and Conditions</a>.
</li>
</ul>
<div class="submitButton">
<input id="submitRegistration" alt="Submit Registration" name="submitReg" src="resources/images/buttons/purchase_btn.png" type="image" />
</div>
</fieldset>
</form>
<script type="text/javascript">
	$('#submitRegistration').hover(function(){ 
	       $(this).attr('src', '/resources/images/buttons/purchase_btn_hover.png'); 
	}, function(){ 
	       $(this).attr('src', '/resources/images/buttons/purchase_btn.png'); 
	}); 
$('document').ready(function(){

	$("#scrap_sign_up").validate({
		rules: {
			card_number: { required: true },
			card_holder_name: { required: true },
			credit_card_type: { required: true }
			}		
	});
});
	
</script>
<?php } ?>