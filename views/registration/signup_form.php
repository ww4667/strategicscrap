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
<ul class="form">
<li><label>Phone:</label><input name="work_phone" type="text" value="<?=$post_data['work_phone']?>" /></li>
</ul>
<ul class="form hii">
<li><label class="firstLabel">State/Province:</label><input name="state_province" type="text" value="<?=$post_data['state_province']?>" /></li>
<li><label>Zip Code:</label><input name="postal_code" type="text" value="<?=$post_data['postal_code']?>" /></li>
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