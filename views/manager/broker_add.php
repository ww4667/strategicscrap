<h1 style="margin:0;padding:0">Brokers // Add</h1>
<ul>
	<li><a href="<?= $ss_url ?>&amp;method=broker-manager">Back to Brokers</a></li>
</ul>
<br />

<div class="sectionHeader">Adding Broker:</div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=broker-add" method="post">
	
	<div><strong>Company Information:</strong><hr /></div>
	<div class="label"><strong>Company Name:</strong></div>
	<div class="value"><input name="company" value="<?= $post_data['company'] ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Address:</strong></div>
	<div class="value"><input type="text" name="address_1" value="<?= $post_data['address_1'] ?>" /><br />
	<input type="text" name="address_2" value="<?= $post_data['address_2'] ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>City:</strong></div>
	<div class="value"><input type="text" name="city" value="<?= $post_data['city'] ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>State/Province:</strong></div>
	<div class="value">
		<? print state_province_select("full","state_province","","",$post_data['state_province']) ?>
	</div>
    <br style="clear:left" />
	
	<div class="label"><strong>Zip/Postal Code:</strong></div>
	<div class="value"><input type="text" name="postal_code" value="<?= $post_data['postal_code'] ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Notes:</strong></div>
	<div class="value"><textarea name="notes"><?= $post_data['notes'] ?></textarea></div>
    <br style="clear:left" />
    <br style="clear:left" />

	<div><strong>Contact Information:</strong><hr /></div>
	<div class="label"><strong>Email (Username):</strong></div>
	<div class="value"><input name="email" value="<?= $post_data['email'] ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Password:</strong></div>
	<div class="value"><input type="password" name="password" value="" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Password Verify:</strong></div>
	<div class="value"><input type="password" name="verify_password" value="" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>First Name:</strong></div>
	<div class="value"><input name="first_name" value="<?= $post_data['first_name'] ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Last Name:</strong></div>
	<div class="value"><input name="last_name" value="<?= $post_data['last_name'] ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Work Phone:</strong></div>
	<div class="value"><input type="text" name="work_phone" value="<?= $post_data['work_phone'] ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Mobile Phone:</strong></div>
	<div class="value"><input type="text" name="mobile_phone" value="<?= $post_data['mobile_phone'] ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Home Phone:</strong></div>
	<div class="value"><input type="text" name="home_phone" value="<?= $post_data['home_phone'] ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Fax Number:</strong></div>
	<div class="value"><input type="text" name="fax_number" value="<?= $post_data['fax_number'] ?>" /></div>
    <br style="clear:left" />
    <br style="clear:left" />

	
	<input type="submit" name="submitted" value="Add Broker" />
	</form>
</div>