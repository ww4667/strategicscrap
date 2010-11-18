<form action="" method="post">
<? foreach ($attributes as $key => $val) { ?>
<div>
	<label><?=$key?></label>
	<input type="text" name="<?=$key?>" />
</div>
<? } ?>
<div>
<input type="submit" value="Create New Material" name="submit_add_material" />
</div>
</form>