<h1 style="margin:0;padding:0">Materials // Update</h1>
<ul>
	<li><a href="<?= $ss_url ?>&amp;method=material-manager">Back to Materials</a></li>
</ul>
<br />

<div class="sectionHeader">Updating Material ID: <?= $material->id ?></div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=material-update" method="post">
	<input type="hidden" name="material_id" value="<?= $material->id ?>" />
	<div class="label"><strong>Created On:</strong></div>
	<div class="value"><?= $material->created_ts ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Updated On:</strong></div>
	<div class="value"><?= $material->updated_ts ?></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<div><strong>Material Information:</strong><hr /></div>
	<div class="label"><strong>Material Name:</strong></div>
	<div class="value"><input name="name" value="<?= $material->name ?>" /></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<p style="color:#F00">CAUTION: Removing this material will remove all connected records in the database.</p>
	<input type="submit" name="submitted" value="Update Material" />&nbsp;&nbsp;<input type="submit" name="remove" value="Remove Material" />
	</form>
</div>