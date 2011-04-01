<style type="text/css">
#subscription_details p {padding: 0;margin-bottom: 1.2em;font-size: 1.5em;line-height: 1.2em;font-family: Georgia,Serif;color: #555;}
</style>

<?php
if (!$_GET['pay']){ 
?>
<p>Fill out your registration below to get started.</p>
<form action"" class="clearfix" method="post">
<fieldset>
<legend>Personal Information:</legend>							
<ul class="form">
<li><label>First Name:</label><input name="first_name" type="text" value="<?=$post_data['first_name']?>" /></li>
<li><label>Last Name:</label><input name="last_name" type="text" value="<?=$post_data['last_name']?>" /></li>
<li><label>Email:</label><input name="email" type="text" value="<?=$post_data['email']?>" /></li>
</ul>
<ul class="form hii">
<li><label class="firstLabel">Password:</label><input name="password" type="password" /></li>
<li><label class="firstLabel">Verify Password:</label><input name="verify_password" type="password" /></li>
</ul>
<div class="submitButton">
<input id="submitRegistration" alt="Submit Registration" name="submitReg" src="resources/images/buttons/submit_registration.png" type="image" />
</div>
</fieldset>
<fieldset>
<legend>Payment Information:</legend>
<li>You are signing up for a trial account. Pay Later!</li>
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
<p>Fill out your registration below to get started.</p>
<form action"" class="clearfix" method="post">
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
<legend>Subscription Details:</legend>
<div id="subscription_details">
<p>Details go here!</p>
<p>$699 for one year!</p>
</div>
<hr style="width:370px;margin:20px 0" />
<legend>Credit Card Information:</legend>
<ul class="form">
<li><label>Card Type:</label>
<select name="creditcardtype" class="required valid">
								<option value="visa">Visa</option>
								<option value="mastercard">MasterCard</option>
								<option value="discover">Discover</option>
							</select>
</li>
<li><label>Card Number:</label><input name="card_number" type="text" value="<?=$post_data['card_number']?>" /></li>
</ul>
<ul class="form hii">
<li><label class="firstLabel">Verification Code:</label><input name="verification_code" type="text" value="<?=$post_data['verification_code']?>" /></li>
<li><label class="firstLabel">Expiration Date:</label>
<?php print month_select("expire_month"); ?>
<?php print year_select(date("Y"),date("Y")+10,"expire_year"); ?>
</ul>
<div class="submitButton">
<input id="submitRegistration" alt="Submit Registration" name="submitReg" src="resources/images/buttons/submit_registration.png" type="image" />
</div>
</fieldset>
</form>
<script type="text/javascript">
	$('#submitRegistration').hover(function(){ 
	       $(this).attr('src', '/resources/images/buttons/submit_registration_hover.png'); 
	}, function(){ 
	       $(this).attr('src', '/resources/images/buttons/submit_registration.png'); 
	}); 
</script>
<?php } ?>