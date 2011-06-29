

<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery.validate/1.6/jquery.validate.min.js"></script> 
<p>Your Payment Information.</p>
<form action="" class="clearfix" method="post" id="payment_change">
<!-- <input name="id" type="hidden" value="<?=$item->id?>" /> -->
<pre>
<?php //print_r($_SESSION) ;?>
</pre>

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
	The purchase price you have selected above will be billed to your credit card and will automatically renew your subscription at the end of your agreed upon term. 
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