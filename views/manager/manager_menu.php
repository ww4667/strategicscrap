<?
/*
<ul>
	<li><a href="<?=$sb_url?>&method=manage-providers">manage providers</a></li>
	<li><a href="<?=$sb_url?>&method=manage-members">manage members</a></li>
	<li><a href="<?=$sb_url?>&method=view-reports">view reports</a></li>
</ul>
<br />
*/
?>
<? if (isset($message)) { ?>
	<div class="message<? if (isset($error)) { ?> error<? } ?>"><p><strong><?= $message ?></strong></p></div>
<? } ?>