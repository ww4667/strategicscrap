<? if (isset($_SESSION['flash'])) { ?>
<div id="flash_panel" class="<?=isset($_SESSION['flashtype'])?$_SESSION['flashtype']:''?>">
	<ul>
	<? if (is_array($_SESSION['flash'])) { ?>
		<? foreach ($_SESSION['flash'] as $msg) { ?>
		<li><?= $msg ?></li>
		<? } ?>
	<? } else { ?>
		<li><?= $_SESSION['flash'] ?></li>
	<? } ?>
	</ul>
</div>
<?
clear_flash();
} ?>