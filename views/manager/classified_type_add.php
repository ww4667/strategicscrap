<h1 style="margin:0;padding:0">Classified Type // Add</h1>
<ul>
	<li><a href="<?= $ss_url ?>&amp;method=classified-type-manager">Back to Classified Types</a></li>
</ul>
<br />

<div class="sectionHeader">Adding Classified Type:</div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=classified-type-add" method="post">
	
	<div><strong>Classified Type Information:</strong><hr /></div>
	<div class="label"><strong>Classified Type Name:</strong></div>
	<div class="value"><input name="name" value="<?= $post_data['name']?>" /></div>
    <br style="clear:left" />
	<div class="label"><strong>Hidden?:</strong><br />(check box if you want it hidden)</div>
	<div class="value"><input type="checkbox" name="hidden" value="<?= $post_data['hidden']?>" /></div>

    <br style="clear:left" />
	<div class="label"><strong>Form Fields:</strong><br />(check the boxes you want to add to this classified type)</div>
	<div class="value">

		<? 
		$contactFields = new Contact();
		print $contactFields->GetPropertiesAsInputsTable();
		?>
	</div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<input type="submit" name="submitted" value="Add Classified Type" />
	</form>
</div>