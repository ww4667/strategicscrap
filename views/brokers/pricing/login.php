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
	.brokerPricing #login_form label{width:100%}
</style>
<div class="brokerPricing">
<?php if (isset($message)) { ?>
	<div class="message<?=isset($error)?' error':''?>"><?=$message;?></div>
<?php } ?>
	<p>Use your email address that you signed up with and your password to login.</p>
	<form method="post" id="login_form">
		<ul class="form user">
			<li><label style="width:200px"><strong>*</strong> Email Address</label><input type="text" name="email" class="email required" /></li>
			<li><label style="width:200px"><strong>*</strong> Password</label><input type="password" name="password" class="required" /></li>
		</ul>
		<div class="submitButton">
			<input id="submitBid" alt="Submit Pricing o" name="submitLogin" src="resources/images/buttons/submit_login.png" type="image" />
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $("#login_form").validate();
	});
</script>