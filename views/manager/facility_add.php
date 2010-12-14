<ul>
	<li><a href="<?= $ss_url ?>&amp;method=facility-manager">Back to Facilities</a></li>
</ul>
<br />

<div class="sectionHeader">Adding Facility:</div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=facility-add" method="post">
	
	<div><strong>Facility Information:</strong><hr /></div>
	<div class="label"><strong>Facility Name:</strong></div>
	<div class="value"><input name="company" value="<?= $post_data['company']?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Facility Address:</strong></div>
	<div class="value"><input type="text" name="address_1" value="<?= $post_data['address_1']?>" /><br />
	<input type="text" name="address_2" value="<?= $post_data['address_2']?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>City:</strong></div>
	<div class="value"><input type="text" name="city" value="<?= $post_data['city']?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>State/Province:</strong></div>
	<div class="value">
		<? print state_province_select("full","state_province","","",$post_data['state_province']) ?>
	</div>
    <br style="clear:left" />
	
	<div class="label"><strong>Zip/Postal Code:</strong></div>
	<div class="value"><input type="text" name="zip_postal_code" value="<?= $post_data['zip_postal_code']?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Category:</strong></div>
	<div class="value">
		<select name="category">
			<option value="">-- Select One --</option>
			<option value="Mill">Mill</option>
			<option value="Foundry">Foundry</option>
			<option value="Exporter">Exporter</option>
		</select>
	</div>
    <br style="clear:left" />
	
	<div class="label"><strong>Website:</strong></div>
	<div class="value"><input type="text" name="website" value="<?= $post_data['website']?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Attachment Name (PDF):</strong></div>
	<div class="value"><input type="text" name="attachments" value="<?= $post_data['attachments']?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Broker Exclusive:</strong></div>
	<div class="value"><input type="text" name="broker_exclusive" value="<?= $post_data['broker_exclusive']?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Additional Notes:</strong></div>
	<div class="value"><input type="text" name="notes" value="<?= $post_data['notes']?>" /></div>
    <br style="clear:left" />
    <br style="clear:left" />

	<div><strong>Contact Information:</strong><hr /></div>
	<div class="label"><strong>First Name:</strong></div>
	<div class="value"><input name="first_name" value="<?= $post_data['first_name']?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Last Name:</strong></div>
	<div class="value"><input name="last_name" value="<?= $post_data['last_name']?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Job Title:</strong></div>
	<div class="value"><input name="job_title" value="<?= $post_data['job_title']?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Email Address:</strong></div>
	<div class="value"><input name="email" value="<?= $post_data['email']?>" /></div>
    <br style="clear:left" />

	<div class="label"><strong>Business Phone:</strong></div>
	<div class="value"><input type="text" name="business_phone" value="<?= $post_data['business_phone']?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Mobile Phone:</strong></div>
	<div class="value"><input type="text" name="mobile_phone" value="<?= $post_data['mobile_phone']?>" /></div>
    <br style="clear:left" />
	
	<div class="label"><strong>Fax Number:</strong></div>
	<div class="value"><input type="text" name="home_phone" value="<?= $post_data['home_phone']?>" /></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<div><strong>Accepted Materials:</strong><hr /></div>
	<div class="label"><strong>Select Accepted Materials:</strong></div>
	<div class="value"><select multiple="multiple" name="materials_array[]" >
		<? foreach ($materials as $m) { ?>
		<option value="<?= $m['id']?>"><?= $m['name']?></option>
		<? } ?>
	</select></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<input type="submit" name="submitted" value="Add Facility" />
	</form>
</div>