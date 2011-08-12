<? foreach ($regions as $lbl => $val) { ?>
<div class="sectionHeader"><?= $val ?> Region</div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=pricing" method="post">
	<input type="hidden" name="region" value="<?= $lbl ?>" />
	<div class="label">&nbsp;</div>
	<div class="value"><strong style="display:inline-block;width:80px">Transported:</strong> <strong style="display:inline-block;width:80px">Brokered:</strong></div>
    <br style="clear:left" />
    <br style="clear:left" />
	<? foreach ($materials as $m) { ?>
		<? foreach ($pricing as $p) {
			if ($p->join_material == $m['id'] && $p->region == $lbl) $price = $p;
		} ?>
	<div class="label"><strong><?= $m['name']?></strong></div>
	<div class="value"><input name="mat[<?= $m['id'] ?>][price]" value="<?= isset($price)?$price->price:''?>" style="display:inline-block;width:80px" /> <input name="mat[<?= $m['id'] ?>][broker_price]" value="<?= isset($price)?$price->broker_price:''?>" style="display:inline-block;width:80px" /></div>
    <br style="clear:left" />
	<? unset($price); ?>
	<? } ?>
    <br style="clear:left" />
	
	<input type="submit" name="submitted" value="Update <?= $val ?> Regional Pricing" />
	</form>
</div>
<? } ?>