<style type="text/css">
#subscription_details p {padding: 0;margin-bottom: 1.2em;font-size: 1.5em;line-height: 1.2em;font-family: Georgia,Serif;color: #555;}
</style>

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