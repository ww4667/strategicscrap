<h1 style="margin:0;padding:0">Classified Type // Update</h1>
<ul>
	<li><a href="<?= $ss_url ?>&amp;method=classified-type-manager">Back to Classified Types</a></li>
</ul>
<br />

<div class="sectionHeader">Updating Classified Type ID: <?= $classifiedTypeUpdate->id ?></div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=classified-type-update" method="post">
	<input type="hidden" name="classified_type_id" value="<?= $classifiedTypeUpdate->id ?>" />
	<div class="label"><strong>Created On:</strong></div>
	<div class="value"><?= $classifiedTypeUpdate->created_ts ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Updated On:</strong></div>
	<div class="value"><?= $classifiedTypeUpdate->updated_ts ?></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<div><strong>Classified Type Information:</strong><hr /></div>
	<div class="label"><strong>Classified Type Name:</strong></div>
	<div class="value"><input name="name" value="<?= $classifiedTypeUpdate->name ?>" /></div>
    <br style="clear:left" />
	<div class="label"><strong>Hidden?:</strong><br />(check box if you want it hidden)</div>
	<div class="value"><input type="checkbox" name="hidden" value="<?= $classifiedTypeUpdate->hidden ?>" <?=!empty($classifiedTypeUpdate->hidden) ? 'checked="checked"' : ""?> /></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<p style="color:#F00">CAUTION: Removing this classified type will remove all connected records in the database.</p>
	<input type="submit" name="submitted" value="Update Classified Type" />&nbsp;&nbsp;<!--<input type="submit" name="remove" value="Remove Classified Type" />-->
	</form>
</div>