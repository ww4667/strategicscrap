<style type="text/css">
#subscription_details p {padding: 0;margin-bottom: 1.2em;font-size: 1.5em;line-height: 1.2em;font-family: Georgia,Serif;color: #555;}
h2.sub-title { margin: -10px 0 20px;font-size: 1.5em;line-height: 1.2em;font-family: Georgia,Serif;color: #555;text-transform: none;}
</style>
<h2 class = "sub-title">Special Introductory Rate: $699/year</h2>						

<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery.validate/1.6/jquery.validate.min.js"></script> 
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
<hr style="width:370px;margin:10px 0" />
<ul class="form">
<li><label>First Name:</label><input name="first_name" type="text" value="<?=$post_data['first_name']?>" /></li>
<li><label>Last Name:</label><input name="last_name" type="text" value="<?=$post_data['last_name']?>" /></li>
<li><label>Company Name:</label><input name="company" type="text" value="<?=$post_data['company']?>" /></li>
<li><label>Address 1:</label><input name="address_1" type="text" value="<?=$post_data['address_1']?>" /></li>
<li><label>Address 2:</label><input name="address_2" type="text" value="<?=$post_data['address_2']?>" /></li>
<li><label>City:</label><input name="city" type="text" value="<?=$post_data['city']?>" /></li>
<li><label>State / Province:</label>
<?php print state_province_select("full","state_province","state_select","",""); ?>
</li>
<li><label>Zip / Postal Code:</label><input name="postal_code" type="text" value="<?=$post_data['postal_code']?>" /></li>
<li><label>Phone:</label><input name="work_phone" type="text" value="<?=$post_data['phone']?>" /></li>
</ul>
</fieldset>
<?php // if (isset($_GET['promos'])) { ?>
<fieldset style="padding-bottom:20px">
<legend>Subscription Details:</legend>
<ul class="form hii">
<li><label class="firstLabel">Annual Subscription:</label><span id="subCost">$699</span></li>
<li style="clear:both"><label class="firstLabel">Discount:</label><span id="subDiscount">$0</span></li>
<li id="subAppliedCodeLI" style="clear:both;display:none"><label class="firstLabel">Promo Code:</label><span id="subAppliedCode"></span></li>
<li id="subCodeTitleLI" style="clear:both;display:none"><label class="firstLabel">Promo Details:</label><span id="subCodeTitle"></span></li>
<li id="subCodeLI" style="clear:both"><label class="firstLabel">Promo Code:<br /><a style="text-decoration:underline;" id="applyCode" href="#">apply code</a></label><input name="promo_code" type="text" value="" /></li>
</ul>
</fieldset>
<?php // } ?>
<fieldset>
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
The introductory price of $699 will be billed to your credit card and will automatically renew at the end of your agreed upon term at the current subscription rate. If you are not interested in renewing, please contact us before your subscription renews.
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
<?php // if (isset($_GET['promos'])) { ?>
	$('a#applyCode').click(function(){
        $('#subDiscount').html("please wait...");
		var promoCode = $('input[name=promo_code]').val();
		
		$.getJSON(
        	'/controllers/remote',
        	{	"method":"checkPromoCode",
            	"promo_code": promoCode },
			function(show_discount){
        		if (show_discount !== false) {
        			$('#subDiscount').html("$"+show_discount.promo_discount);
			    	$('#subCodeLI').hide();
			    	$('input[name=promo_code]').val(show_discount.promo_code);
        			$('#subAppliedCode').html(show_discount.promo_code);
        			$('#subCodeTitle').html(show_discount.promo_title);
			    	$('#subAppliedCodeLI').show();
			    	$('#subCodeTitleLI').show();
			    	alert("Your promo code has been applied.");
        		} else {
        			$('#subDiscount').html("$0");
			    	alert("This is not a valid promo code.");
        		}
			}
		);
       return false;
	});
<?php // } ?>
});
	
</script>