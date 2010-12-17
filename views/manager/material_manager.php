<h1 style="margin:0;padding:0">Materials</h1>
<ul><li><a href="<?=$ss_url?>&method=material-add">[+] add a material</a></li></ul>
<br />
<?php if (count($materials) >= 1) { ?>
<div style="clear:both;"></div>
	<table id="material_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="40">&nbsp;</th>
			<th width="">Material Name</th>
			<th width="65">Created</th>
			<th width="65">Updated</th>
		</tr></thead>
		<tbody>
	    <?php foreach ($materials as $material) { ?>
		<tr style="cursor:pointer;" class='material_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'" onclick="location.href='<?php echo $ss_url; ?>&amp;method=material-update&amp;material_id=<?php echo $material['id']; ?>'">
	    	<td><a href="<?php echo $ss_url; ?>&amp;method=material-update&amp;material_id=<? echo $material['id']; ?>">update</a></td>
	    	<td><?php echo $material['name']; ?></td>
			<td><?php echo date("Y-m-d", strtotime($material['created_ts'])) ?></td>
			<td><?php echo !is_null($material['updated_ts']) ? date("Y-m-d", strtotime($material['updated_ts'])) : date("Y-m-d", strtotime($material['created_ts'])) ?></td>
		</tr>
		<?php } ?>
				
		</tbody>
	</table>
<div style="clear:both;"></div>
<?php } else { ?>
<div class="message error"><p>No records to show. Try revising your search.</p></div>
<?php } ?>
<script type="text/javascript"> 
	jQuery.noConflict();
	(function($) { 
	  $(function() {
		$(document).ready(function () {
			$('#material_table').dataTable( {
				"aoColumnDefs": [
					{ "bSortable": false, "aTargets": [ 0 ] },
					{ "bSearchable": false, "aTargets": [ 0 ] }
			] } );
		});
	  });
	})(jQuery);
</script>