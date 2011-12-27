
<?

	$val  = $regions[$region];

?>

<div class="sectionHeader"><?= $val ?> Region</div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=regional-data-add" method="post">
	<input type="hidden" name="region" value="<?= $region ?>" />
	
	<div class="label">&nbsp;</div>
	<div class="value"><strong style="display:inline-block;width:80px">Month:</strong> <strong style="display:inline-block;width:80px">Year:</strong></div>
    <br style="clear:left" />
	<div class="label"><strong>&nbsp;</strong></div>
	<div class="value"><input name="month" value="" style="display:inline-block;width:80px" /> <input name="year" value="<?= isset($price)?$price->broker_price:''?>" style="display:inline-block;width:80px" /></div>
    <br style="clear:left" />
    
	<div class="label">&nbsp;</div>
	<div class="value"><strong style="display:inline-block;width:86px">Mill/Foundry Delivered:</strong> <strong style="display:inline-block;width:86px">Broker Buying:</strong> <strong style="display:inline-block;width:86px">Export - Delivered Port:</strong></div>
    <br style="clear:left" />
    <br style="clear:left" />
	<? foreach ($materials as $m) { ?>
	<div class="label"><strong><?= $m['name']?></strong></div>
	<div class="value"><input name="mat[<?= $m['id'] ?>][price]" value="" style="display:inline-block;width:80px" /> <input name="mat[<?= $m['id'] ?>][broker_price]" value="" style="display:inline-block;width:80px" /> <input name="mat[<?= $m['id'] ?>][export_price]" value="" style="display:inline-block;width:80px" /></div>
    <br style="clear:left" />
	<? unset($price); ?>
	<? } ?>
    <br style="clear:left" />
	
	<input type="hidden" name="region" value="<?= $region ?>" />
	<input type="submit" name="submitted" value="Update <?= $val ?> Regional Pricing" />
	</form>
</div>
