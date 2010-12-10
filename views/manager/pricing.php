<? foreach ($regions as $lbl => $val) { ?>
<div class="sectionHeader"><?= $val ?> Region</div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=pricing" method="post">
	<input type="hidden" name="region" value="<?= $lbl ?>" />
	<? foreach ($materials as $m) { ?>
		<? foreach ($pricing as $p) {
			if ($p->join_material == $m['id'] && $p->region == $lbl) $price = $p->price;
		} ?>
	<div class="label"><strong><?= $m['name']?></strong></div>
	<div class="value"><input name="mat[<?= $m['id'] ?>]" value="<?= isset($price)?$price:''?>" /></div>
    <br style="clear:left" />
	<? unset($price); ?>
	<? } ?>
    <br style="clear:left" />
	
	<input type="submit" name="submitted" value="Update <?= $val ?> Regional Pricing" />
	</form>
</div>
<? } ?>