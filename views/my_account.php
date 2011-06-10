<p>Update your account information below.</p>
<form action"" class="clearfix" method="post">
<!-- <input name="id" type="hidden" value="<?=$item->id?>" /> -->
<fieldset>
<legend>Personal Information:</legend>							
<ul class="form">
<li><label>First Name:</label><input name="first_name" type="text" value="<?=$item->first_name?>" /></li>
<li><label>Last Name:</label><input name="last_name" type="text" value="<?=$item->last_name?>" /></li>
<li><hr style="width:369px" /></li>
<li><label><strong>Work Phone:</strong></label><input name="work_phone" type="text" value="<?=$item->work_phone?>" /></li>
<li><label>Mobile Phone:</label><input name="mobile_phone" type="text" value="<?=$item->mobile_phone?>" /></li>
<li><label>Home Phone:</label><input name="home_phone" type="text" value="<?=$item->home_phone?>" /></li>
<li><label>Fax Number:</label><input name="fax_number" type="text" value="<?=$item->fax_number?>" /></li>
<li><hr style="width:369px" /></li>
<li><label><strong>Company:</strong></label><input name="company" type="text" value="<?=$item->company?>" /></li>
<li><label><strong>Address 1:</strong></label><input name="address_1" type="text" value="<?=$item->address_1?>" /></li>
<li><label>Address 2:</label><input name="address_2" type="text" value="<?=$item->address_2?>" /></li>
<li><label><strong>City:</strong></label><input name="city" type="text" value="<?=$item->city?>" /></li>
</ul>
<ul class="form hii">
<li><label class="firstLabel"><strong>State/Province:</strong></label><input name="state_province" type="text" value="<?=$item->state_province?>" /></li>
<li><label><strong>Zip Code:</strong></label><input name="postal_code" type="text" value="<?=$item->postal_code?>" /></li>
</ul>
<ul class="form">
<li><label>Country:</label><input name="country" type="text" value="<?=$item->country?>" /></li>
<li><hr style="width:369px" /></li>
<li><label>Notes:</label><textarea name="notes" cols="30" rows="5" style="width:273px"><?=$item->notes?></textarea></li>
</ul>
<div class="submitButton">
<input name="AccountUpdate" type="hidden" />
<input id="submitAccountUpdate" alt="Update My Account" name="submitAccountUpdate" src="resources/images/buttons/account_update.png" type="image" />
</div>
</fieldset>
<fieldset>
<legend>Account Settings:</legend>
<ul class="form">
<li><label>Email:</label><input name="email" type="text" value="<?=$user->email?>" /></li>
</ul>
<ul class="form hii">
<li><label class="firstLabel">New Password:</label><input name="password" type="password" /></li>
<li><label class="firstLabel">Verify Password:</label><input name="verify_password" type="password" /></li>
</ul>
</fieldset>
<?php if($_GET["test"]) {?>
<pre>
<?php print_r($_SESSION) ;?>
</pre>
	<input type="hidden" name = "changing_payment_method" id="changing_payment_method" value = "false" />
<? if( $epay_info != null && ($_SESSION["merchant"]->merchtype == 0 || $_SESSION["merchant"]->merchtype == 3)) {?>
	<label>Payment Method</label>
	<input type="hidden" name = "usa_epay_id" value = "<?= $_SESSION["merchant"]->usa_epay_id ?>"/>
	<input type="hidden" name = "epay_payment_id" id="epay_payment_id" value = "<?= $epay_info->PaymentMethods[0]->MethodID ?>" />
	<span style="padding-left:10px">
		<?= $epay_info->PaymentMethods[0]->CreditCardData->CardNumber ?> <span class = "faux_link" id = "change_payment_method">Change</span><span class = "faux_link" id = "change_payment_method_cancel" style="display: none;">Cancel</span>
	</span><br />
<? } ?>	

<fieldset>
<legend>Payment Information:</legend>
<ul class="form">
<li><label>Email:</label><input name="email" type="text" value="<?=$user->email?>" /></li>
</ul>
<ul class="form hii">
<li><label class="firstLabel">New Password:</label><input name="password" type="password" /></li>
<li><label class="firstLabel">Verify Password:</label><input name="verify_password" type="password" /></li>
</ul>
</fieldset>

<script type="text/javascript">
$('document').ready(function(){

	$("#change_payment_method").click(function(){		
	 	$('#cardnum_changed').addClass('required');
	 	$('#cardname_changed').addClass('required');
		$('.open_payment_div').slideUp({duration:500, easing: 'swing'});
		$('#payment_change').slideDown();
	 	$('.open_payment_div').removeClass('open_payment_div');
	 	$('#terms_agreement_changed').addClass('required');
		$('#payment_changed').addClass("open_payment_div");
		$("#change_payment_method").hide();
		$("#change_payment_method_cancel").show();
		$("#changing_payment_method").val("true");
	 	
	});
	
	
	$("#change_payment_method_cancel").click(function(){			
	 	$('#cardnum_changed').removeClass('required');
	 	$('#cardname_changed').removeClass('required');
		$('#payment_change').slideUp({duration:500, easing: 'swing'});
		$('.open_payment_div').removeClass('open_payment_div');
	 	$('#terms_agreement_changed').removeClass('required');
		$("#change_payment_method_cancel").hide();
		$("#change_payment_method").show();
		$("#changing_payment_method").val("false");
	 	
	});


});
</script>
<?php } ?>
</form>
<script type="text/javascript">
	$('#submitAccountUpdate').hover(function(){ 
	       $(this).attr('src', '/resources/images/buttons/account_update_hover.png'); 
	}, function(){ 
	       $(this).attr('src', '/resources/images/buttons/account_update.png'); 
	}); 
</script>