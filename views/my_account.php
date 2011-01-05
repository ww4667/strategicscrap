<p>Update your account information below.</p>
<form action"" class="clearfix" method="post">
<!-- <input name="id" type="hidden" value="<?=$item->id?>" /> -->
<fieldset>
<legend>Personal Information:</legend>							
<ul class="form">
<li><label>First Name:</label><input name="first_name" type="text" value="<?=$item->first_name?>" /></li>
<li><label>Last Name:</label><input name="last_name" type="text" value="<?=$item->last_name?>" /></li>
<li><hr style="width:369px" /></li>
<li><label>Work Phone:</label><input name="work_phone" type="text" value="<?=$item->work_phone?>" /></li>
<li><label>Mobile Phone:</label><input name="mobile_phone" type="text" value="<?=$item->mobile_phone?>" /></li>
<li><label>Home Phone:</label><input name="home_phone" type="text" value="<?=$item->home_phone?>" /></li>
<li><label>Fax Number:</label><input name="fax_number" type="text" value="<?=$item->fax_number?>" /></li>
<li><hr style="width:369px" /></li>
<li><label>Company:</label><input name="company" type="text" value="<?=$item->company?>" /></li>
<li><label>Address 1:</label><input name="address_1" type="text" value="<?=$item->address_1?>" /></li>
<li><label>Address 2:</label><input name="address_2" type="text" value="<?=$item->address_2?>" /></li>
<li><label>City:</label><input name="city" type="text" value="<?=$item->city?>" /></li>
</ul>
<ul class="form hii">
<li><label class="firstLabel">State/Province:</label><input name="state_province" type="text" value="<?=$item->state_province?>" /></li>
<li><label>Zip Code:</label><input name="postal_code" type="text" value="<?=$item->postal_code?>" /></li>
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
<li><label class="firstLabel">Password:</label><input name="password" type="password" /></li>
<li><label class="firstLabel">Verify Password:</label><input name="verify_password" type="password" /></li>
</ul>
</fieldset>
</form>