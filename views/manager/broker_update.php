<h1 style="margin:0;padding:0">Transportation Brokers // Update</h1>
<ul>
	<li><a href="<?= $ss_url ?>&amp;method=broker-manager">Back to Transportation Brokers</a></li>
</ul>
<br />

<div class="sectionHeader">Updating Broker ID: <?= $broker->id ?> (<?= ($broker->join_user[0]['logged_in'] == 1) ? "currently" : "not" ?> logged-in)</div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=broker-update" method="post">
	<input type="hidden" name="broker_id" value="<?= $broker->id ?>" />
	<input type="hidden" name="user_id" value="<?= $broker->join_user[0]['id'] ?>" />
	<div class="label"><strong>Created On:</strong></div>
	<div class="value"><?= $broker->created_ts ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Updated On:</strong></div>
	<div class="value"><?= $broker->updated_ts ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Last Logged-in:</strong></div>
	<div class="value"><?= $broker->join_user[0]['last_login_ts'] ?></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<div><strong>Company Information:</strong><hr /></div>
	<div class="label"><strong>Company Name:</strong></div>
	<div class="value"><input name="company" value="<?= $broker->company ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Address:</strong></div>
	<div class="value"><input type="text" name="address_1" value="<?= $broker->address_1 ?>" /><br />
	<input type="text" name="address_2" value="<?= $broker->address_2 ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>City:</strong></div>
	<div class="value"><input type="text" name="city" value="<?= $broker->city ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>State/Province:</strong></div>
	<div class="value"><input type="text" name="state_province" value="<?= $broker->state_province ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Zip/Postal Code:</strong></div>
	<div class="value"><input type="text" name="postal_code" value="<?= $broker->postal_code ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Country:</strong></div>
	<div class="value"><input type="text" name="country" value="<?= $broker->country ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Notes:</strong></div>
	<div class="value"><textarea name="notes"><?= $broker->notes ?></textarea></div>
    <br style="clear:left" />
    <br style="clear:left" />

	<div><strong>Contact Information:</strong><hr /></div>
	<div class="label"><strong>Email (Username):</strong></div>
	<div class="value"><input name="email" value="<?= $broker->join_user[0]['email'] ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>First Name:</strong></div>
	<div class="value"><input name="first_name" value="<?= $broker->first_name ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Last Name:</strong></div>
	<div class="value"><input name="last_name" value="<?= $broker->last_name ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Work Phone:</strong></div>
	<div class="value"><input type="text" name="work_phone" value="<?= $broker->work_phone ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Mobile Phone:</strong></div>
	<div class="value"><input type="text" name="mobile_phone" value="<?= $broker->mobile_phone ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Home Phone:</strong></div>
	<div class="value"><input type="text" name="home_phone" value="<?= $broker->home_phone ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Fax Number:</strong></div>
	<div class="value"><input type="text" name="fax_number" value="<?= $broker->fax_number ?>" /></div>
    <br style="clear:left" />
    <br style="clear:left" />

	
	<input type="submit" name="submitted" value="Update Broker" />
	</form>
</div>