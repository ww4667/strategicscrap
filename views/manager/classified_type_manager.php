<h1 style="margin:0;padding:0">Classified Types</h1>
<ul><li><a href="<?=$ss_url?>&method=classified-type-add">[+] add a classified type</a></li></ul>
<br />
<?php if (count($classifiedTypeDisplayItems) >= 1) { ?>
<div style="clear:both;"></div>
	<table id="classified_type_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="40">&nbsp;</th>
			<th width="">Classified Type</th>
			<th width="">Displayed?</th>
			<th width="65">Created</th>
			<th width="65">Updated</th>
		</tr></thead>
		<tbody>
	    <?php foreach ($classifiedTypeDisplayItems as $classifiedType) { ?>
		<tr style="cursor:pointer;" class='classified_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'" onclick="location.href='<?php echo $ss_url; ?>&amp;method=classified-type-update&amp;classified_type_id=<?php echo $classifiedType['id']; ?>'">
	    	<td><a href="<?php echo $ss_url; ?>&amp;method=classified-type-update&amp;classified_type_id=<? echo $classifiedType['id']; ?>">update</a></td>
	    	<td><?php echo $classifiedType['name']; ?></td>
	    	<td><?php echo empty( $classifiedType['hidden'] ) ? 'displayed' : 'hidden' ; ?></td>
			<td><?php echo date("Y-m-d", strtotime($clasifiedType['created_ts'])) ?></td>
			<td><?php echo !is_null($classifiedType['updated_ts']) ? date("Y-m-d", strtotime($classifiedType['updated_ts'])) : date("Y-m-d", strtotime($classifiedType['created_ts'])) ?></td>
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
			$('#classified_type_table').dataTable( {
				"aoColumnDefs": [
					{ "bSortable": false, "aTargets": [ 0 ] },
					{ "bSearchable": false, "aTargets": [ 0 ] }
				],
				"iDisplayLength": 100,
				"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
    		 } );
		});
	  });
	})(jQuery);
</script>