<form action="" method="post">
<? foreach ($attributes as $key => $val) { ?>
<div>
	<label><?=$key?></label>
	<input type="text" name="<?=$key?>" />
</div>
<? } ?>
<div>
<label>Attach materials</label>
<select multiple="multiple" name="materials_array[]">
<? foreach ($materials as $m) { ?>
	<option value="<?=$m->id?>"><?=$m->name?></option>
<? } ?>
</select>
</div>
<div>
<input type="submit" value="Create New Facility" name="submit_add_facility" />
</div>
</form>