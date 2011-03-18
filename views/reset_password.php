<p>Use the form below to reset your password.</p>
<form action"" class="clearfix" method="post">
<fieldset>							
<ul class="form">
<li><label>Email:</label><input name="username" type="text" value="<?=$post_data['username']?>" /></li>
<li><label>New Password:</label><input name="password" type="password" value="" /></li>
<li><label>Verify Password:</label><input name="verify_password" type="password" value="" /></li>
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