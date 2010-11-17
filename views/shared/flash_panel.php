<? if (isset($_SESSION['flash'])) { ?>
<div id="flash_panel" class="<?=isset($_SESSION['flashtype'])?$_SESSION['flashtype']:''?>">
	<ul>
		<? foreach ($_SESSION['flash'] as $msg) { ?>
		<li><?=$msg?></li>
		<? } ?>
	</ul>
</div>
<?
clear_flash();
} ?>