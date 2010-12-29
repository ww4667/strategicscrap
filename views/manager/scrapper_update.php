<h1 style="margin:0;padding:0">Scrappers // Update</h1>
<ul>
	<li><a href="<?= $ss_url ?>&amp;method=scrapper-manager">Back to Scrappers</a></li>
</ul>
<br />

<<<<<<< HEAD
<div class="sectionHeader">Updating Scrapper ID: <?= $scrapper->id ?> (<?= ($scrapper->join_user[0]['logged_in'] == 1) ? "currently" : "not" ?> logged-in)</div>
=======
<div class="sectionHeader">Updating Scrapper ID: <?= $scrapper->id ?> (<?= ($scrapper->join_user[0]->logged_in == 1) ? "currently" : "not" ?> logged-in)</div>
>>>>>>> 62f6ce139870fe8dc504e8659e9ab277961a0c58
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=scrapper-update" method="post">
	<input type="hidden" name="scrapper_id" value="<?= $scrapper->id ?>" />
	<input type="hidden" name="user_id" value="<?= $scrapper->join_user[0]['id'] ?>" />
	<div class="label"><strong>Created On:</strong></div>
	<div class="value"><?= $scrapper->created_ts ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Updated On:</strong></div>
	<div class="value"><?= $scrapper->updated_ts ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Last Logged-in:</strong></div>
	<div class="value"><?= $scrapper->join_user[0]['last_login_ts'] ?></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<div><strong>Company Information:</strong><hr /></div>
	<div class="label"><strong>Company Name:</strong></div>
	<div class="value"><input name="company" value="<?= $scrapper->company ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Address:</strong></div>
	<div class="value"><input type="text" name="address_1" value="<?= $scrapper->address_1 ?>" /><br />
	<input type="text" name="address_2" value="<?= $scrapper->address_2 ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>City:</strong></div>
	<div class="value"><input type="text" name="city" value="<?= $scrapper->city ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>State/Province:</strong></div>
	<div class="value"><input type="text" name="state_province" value="<?= $scrapper->state_province ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Zip/Postal Code:</strong></div>
	<div class="value"><input type="text" name="postal_code" value="<?= $scrapper->postal_code ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Country:</strong></div>
	<div class="value"><input type="text" name="country" value="<?= $scrapper->country ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Notes:</strong></div>
	<div class="value"><textarea name="notes"><?= $scrapper->notes ?></textarea></div>
    <br style="clear:left" />

	<div><strong>Contact Information:</strong><hr /></div>
	<div class="label"><strong>Email (Username):</strong></div>
	<div class="value"><input name="email" value="<?= $scrapper->join_user[0]['email'] ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>First Name:</strong></div>
	<div class="value"><input name="first_name" value="<?= $scrapper->first_name ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Last Name:</strong></div>
	<div class="value"><input name="last_name" value="<?= $scrapper->last_name ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Work Phone:</strong></div>
	<div class="value"><input type="text" name="work_phone" value="<?= $scrapper->work_phone ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Mobile Phone:</strong></div>
	<div class="value"><input type="text" name="mobile_phone" value="<?= $scrapper->mobile_phone ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Home Phone:</strong></div>
	<div class="value"><input type="text" name="home_phone" value="<?= $scrapper->home_phone ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Fax Number:</strong></div>
	<div class="value"><input type="text" name="fax_number" value="<?= $scrapper->fax_number ?>" /></div>
    <br style="clear:left" />
    <br style="clear:left" />

	
	<input type="submit" name="submitted" value="Update Scrapper" />
	</form>
</div>