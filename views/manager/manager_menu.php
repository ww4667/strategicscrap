<? if (isset($message)) { ?>
	<div class="message<? if (isset($error)) { ?> error<? } ?>"><p><strong><?= $message ?></strong></p></div>
<? } ?>
<ul>
	<li><a href="<?=$ss_url?>&method=facility-manager">manage facilities</a></li>
	<li><a href="<?=$ss_url?>&method=material-manager">manage materials</a></li>
	<li><a href="<?=$ss_url?>&method=scrapper-manager">manage scrappers</a></li>
	<li><a href="<?=$ss_url?>&method=broker-manager">manage brokers</a></li>
	<li><a href="<?=$ss_url?>&method=request-manager">manage requests</a></li>
	<li><a href="<?=$ss_url?>&method=pricing">manage regional pricing</a></li>
</ul>
</div> <? // end of sectionBody div ?>
<div class="sectionHeader"><?= $PAGE_TITLE ?></div>
<div class="sectionBody">