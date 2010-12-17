<h1 style="margin:0;padding:0">Materials // Add</h1>
<ul>
	<li><a href="<?= $ss_url ?>&amp;method=material-manager">Back to Materials</a></li>
</ul>
<br />

<div class="sectionHeader">Adding Material:</div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=material-add" method="post">
	
	<div><strong>Material Information:</strong><hr /></div>
	<div class="label"><strong>Material Name:</strong></div>
	<div class="value"><input name="name" value="<?= $post_data['name']?>" /></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<input type="submit" name="submitted" value="Add Material" />
	</form>
</div>