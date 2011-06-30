<style type="text/css">
#subscription_details p {padding: 0;margin-bottom: 1.2em;font-size: 1.5em;line-height: 1.2em;font-family: Georgia,Serif;color: #555;}
.mainCol h1 { display:none; }
.mainCol h1.payment { display:block; }
h2.sub-title { margin: 0px 0 20px;font-size: 1.5em;line-height: 1.2em;font-family: Georgia,Serif;color: #555;text-transform: none;}
</style>
<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery.validate/1.6/jquery.validate.min.js"></script> 
<?php 
$payment_status = (isset($_GET["payment_message"]))? $_GET["payment_message"] : $item->payment_method_status;

	switch ($payment_status){
		
		case 0:
			$payment_message = '<h1 class="payment">Activate Your Paid Subscription</h1>
								<div id="subscription_details">
								<h2 class="sub-title">Your special introductory offer is $699/year.</h2> 
								</div>';
			$disclaimer = 'The introductory price of $699 will be billed to your credit card and will automatically renew at the end of your agreed upon term at the current subscription rate. If you are not interested in renewing, please contact us before your subscription expires.';
			
			break;
		case 1:
			$payment_message = '<h1 class="payment">Update Your Payment Information</h1>
								<div id="subscription_details">
								<h2 class="sub-title">Use the form below to update your payment information.</h2>
								</div>';
			$disclaimer = 'Updating your payment information will not affect the terms of your current subscription.';
			
			break;
		case 2:
			$payment_message = '<h1 class="payment">Your Credit Card Has Expired!</h1>
								<div id="subscription_details">
								<h2 class="sub-title">Update your payment information below to continue your subscription to Strategic Scrap.</h2> 
								</div>';
			$disclaimer = 'Your credit card will automatically renew at the end of your agreed upon term at the current subscription rate. If you are not interested in renewing, please contact us before your subscription expires.';
			
			break;
	}
?>
<?= $payment_message ?>

<form action="" class="clearfix" method="post" id="payment_change">

<input type="hidden" name = "changing_payment_method" id="changing_payment_method" value = "false" />

<fieldset>
<? if( $epay_info != null ) {
	$payment_css = "display: none;";?>
	<legend>Payment Information:</legend>
	<label>Current Payment Method</label>
	<input type="hidden" name = "epay_payment_id" id="epay_payment_id" value = "<?= $epay_info->PaymentMethods[0]->MethodID ?>" />
	<span style="padding-left:10px">
		<?= $epay_info->PaymentMethods[0]->CardNumber ?> <span class = "faux_link" id = "change_payment_method">Change</span><span class = "faux_link" id = "change_payment_method_cancel" style="display: none;">Cancel</span>
	</span><br />	
<? } ?>

	<div id="payment_container" class="open_payment_div" style="<?= $payment_css ?>">
	<legend>
<?= ($epay_info != null ) ? "Update Your " : "Enter Your " ?>Credit Card Information:</legend>
	<ul class="form">
	<li><label>Card Type:</label>
	<select name="creditcardtype" class="" id = "credit_card_type">
		<option value="visa">Visa</option>
		<option value="mastercard">MasterCard</option>
		<option value="discover">Discover</option>
	</select>
	</li>
	<li><label>Cardhoder Name:</label><input id = "card_holder_name" name="card_holder_name" type="text" value="<?=$post_data['card_holder_name']?>" /></li>
	<li><label>Card Number:</label><input id = "card_number" name="card_number" type="text" value="<?=$post_data['card_number']?>" /></li>
	</ul>
	<ul class="form hii">
	<li><label class="firstLabel">Verification Code:</label><input id = "card_code" name="card_code" type="text" value="<?=$post_data['card_code']?>" class="required" /></li>
	<li style='clear: both;'><label>Expiration Date:</label>
	<?= month_select('ccmonth','ccmonth','ccmonth') ?> <?= year_select(date('y'),(date('y')+10),'ccyear','ccyear') ?></li>
	<?php //print month_select("expire_month"); ?>
	<?php //print year_select(date("Y"),date("Y")+10,"expire_year"); ?>
	</ul>
	<hr style="width:370px;margin:20px 0" />
	<ul class="form">
	<li	style="font-size:10px">
	<?= $disclaimer ?> 
	</li>
	<li>
	<input style="width:20px" type="checkbox" name="agree" class="required" /> I have read and agree to the <a style="text-decoration:underline" href="/terms-and-conditions" target="blank">Terms and Conditions</a>.
	</li>
	</ul>
	<div class="submitButton">
	<input name="PaymentUpdate" type="hidden" />
	<input id="submitAccountUpdate" alt="Update My Account" name="submitAccountUpdate" src="resources/images/buttons/account_update.png" type="image" />
	</div>
	</div>
</fieldset>

<script type="text/javascript">
$('document').ready(function(){
	$("#payment_change").validate({
		rules: {
			card_number: { required: true },
			card_holder_name: { required: true },
			credit_card_type: { required: true }
			}		
	});

	$("#change_payment_method").click(function(){		
	 	$('#card_number').addClass('required');
	 	$('#card_holder_name').addClass('required');
		$('.open_payment_div').slideUp({duration:500, easing: 'swing'});
		$('#payment_container').slideDown();
	 	$('.open_payment_div').removeClass('open_payment_div');
	 	$('#terms_agreement_changed').addClass('required');
		$('#payment').addClass("open_payment_div");
		$("#change_payment_method").hide();
		$("#change_payment_method_cancel").show();
		$("#changing_payment_method").val("true");
	 	
	});
	
	
	$("#change_payment_method_cancel").click(function(){			
	 	$('#cardnum').removeClass('required');
	 	$('#cardname').removeClass('required');
		$('#payment_container').slideUp({duration:500, easing: 'swing'});
		$('.open_payment_div').removeClass('open_payment_div');
	 	$('#terms_agreement_changed').removeClass('required');
		$("#change_payment_method_cancel").hide();
		$("#change_payment_method").show();
		$("#changing_payment_method").val("false");
	 	
	});


});
</script>
</form>
<script type="text/javascript">
	$('#submitAccountUpdate').hover(function(){ 
	       $(this).attr('src', '/resources/images/buttons/account_update_hover.png'); 
	}, function(){ 
	       $(this).attr('src', '/resources/images/buttons/account_update.png'); 
	}); 
</script>