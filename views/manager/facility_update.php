<ul>
	<li><a href="<?= $ss_url ?>&amp;method=facility-manager">Back to Facilities</a></li>
</ul>
<br />

<div class="sectionHeader">Updating Facility ID: <?= $facility->id ?></div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=facility-update" method="post">
	<input type="hidden" name="facility_id" value="<?= $facility->id ?>" />
	<div class="label"><strong>Created On:</strong></div>
	<div class="value"><?= $facility->created_ts ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Last Updated:</strong></div>
	<div class="value"><?= $facility->updated_ts ?></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<div><strong>Facility Information:</strong><hr /></div>
	<div class="label"><strong>Facility Name:</strong></div>
	<div class="value"><input name="company" value="<?= $facility->company ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Facility Address:</strong></div>
	<div class="value"><input type="text" name="address_1" value="<?= $facility->address_1 ?>" /><br />
	<input type="text" name="address_2" value="<?= $facility->address_2 ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>City:</strong></div>
	<div class="value"><input type="text" name="city" value="<?= $facility->city ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>State/Province:</strong></div>
	<div class="value"><input type="text" name="state_province" value="<?= $facility->state_province ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Zip/Postal Code:</strong></div>
	<div class="value"><input type="text" name="zip_postal_code" value="<?= $facility->zip_postal_code ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Country:</strong></div>
	<div class="value"><input type="text" name="country" value="<?= $facility->country ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Latitude:</strong></div>
	<div class="value"><input type="text" name="lat" value="<?= $facility->lat ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Longitude:</strong></div>
	<div class="value"><input type="text" name="lon" value="<?= $facility->lon ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Region:</strong></div>
	<div class="value"><input type="text" name="region" value="<?= $facility->region ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Category:</strong></div>
	<div class="value"><input type="text" name="category" value="<?= $facility->category ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Website:</strong></div>
	<div class="value"><input type="text" name="website" value="<?= $facility->website ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Attachments:</strong></div>
	<div class="value"><input type="text" name="attachments" value="<?= $facility->attachments ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Broker Exclusive:</strong></div>
	<div class="value"><input type="text" name="broker_exclusive" value="<?= $facility->broker_exclusive ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Additional Notes:</strong></div>
	<div class="value"><input type="text" name="notes" value="<?= $facility->notes ?>" /></div>
    <br style="clear:left" />
    <br style="clear:left" />

	<div><strong>Contact Information:</strong><hr /></div>
	<div class="label"><strong>First Name:</strong></div>
	<div class="value"><input name="first_name" value="<?= $facility->first_name ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Last Name:</strong></div>
	<div class="value"><input name="last_name" value="<?= $facility->last_name ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Job Title:</strong></div>
	<div class="value"><input name="job_title" value="<?= $facility->job_title ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Email Address:</strong></div>
	<div class="value"><input name="email" value="<?= $facility->email ?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Business Phone:</strong></div>
	<div class="value"><input type="text" name="business_phone" value="<?= $facility->business_phone ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Mobile Phone:</strong></div>
	<div class="value"><input type="text" name="mobile_phone" value="<?= $facility->mobile_phone ?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Fax Number:</strong></div>
	<div class="value"><input type="text" name="home_phone" value="<?= $facility->home_phone ?>" /></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<input type="submit" name="submitted" value="Update Facility" />
	</form>
</div>