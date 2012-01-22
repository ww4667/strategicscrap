<? if ( isset( $_SESSION['flash'] ) ) { ?>
	<div class="message<? if ($_SESSION['flashtype'] == 'bad') { ?> error<? } ?>">
		<ul>
		<? if (is_array($_SESSION['flash'])) { ?>
			<? foreach ($_SESSION['flash'] as $m) { ?>
				<li><strong><?= $m ?></strong></li>
			<? } ?>
		<? } else { ?>
			<li><strong><?= $_SESSION['flash'] ?></strong></li>
		<? } ?>
		</ul>
	</div>
<? clear_flash(); ?>
<? } ?>
<ul>
	<li><a href="<?=$ss_url?>&method=facility-manager">manage facilities</a></li>
	<li><a href="<?=$ss_url?>&method=material-manager">manage materials</a></li>
	<li><a href="<?=$ss_url?>&method=scrapper-manager">manage subscribers</a></li>
	<li><a href="<?=$ss_url?>&method=broker-manager">manage transportation brokers</a></li>
	<li><a href="<?=$ss_url?>&method=request-manager">manage requests</a></li>
	<!-- <li><a href="<?=$ss_url?>&method=pricing">manage regional pricing</a></li>  -->
	<li><a href="<?=$ss_url?>&method=regional-data-manager">NEW - manage regional pricing</a></li>
	<li><a href="<?=$ss_url?>&method=category-manager">manage categories</a></li>
	<li><a href="<?=$ss_url?>&method=classified-manager">manage classifieds</a></li>
	<li><a href="<?=$ss_url?>&method=classified-type-manager">manage classifieds type</a></li>
</ul>
</div> <? // end of sectionBody div ?>
<div class="sectionHeader"><?= $PAGE_TITLE ?></div>
<div class="sectionBody">