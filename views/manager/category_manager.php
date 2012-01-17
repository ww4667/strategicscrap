<h1 style="margin:0;padding:0">Category Manager</h1>
<ul><li><a href="<?=$ss_url?>&method=category-add">[+] add a category</a></li></ul>
<br />




<?php if (count($categoryByHierarchy) >= 1) { ?>

<div style="clear:both;"></div>
	<table id="category_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="40">&nbsp;</th>
			<th width="">Category</th>
			<th width="">Category Path</th>
			<th width="65">Created</th>
			<th width="65">Updated</th>
		</tr></thead>
		<tbody>
	    <?php foreach ($categoryByHierarchy as $category) { ?>

		<tr style="cursor:pointer;" class='category_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'" onclick="location.href='<?php echo $ss_url; ?>&amp;method=category-update&amp;category_id=<?php echo $category['id']; ?>'">
			<td><a href="<?php echo $ss_url; ?>&amp;method=category-update&amp;category_type_id=<? echo $category['id']; ?>">update</a></td>
			<td><?php echo $category['name']; ?></td>
			<td><?php echo urldecode( $category['slug'] ); ?></td>
			<td><?php echo date("Y-m-d", strtotime($category['created_ts'])) ?></td>
			<td><?php echo !is_null($category['updated_ts']) ? date("Y-m-d", strtotime($category['updated_ts'])) : date("Y-m-d", strtotime($category['created_ts'])) ?></td>
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
			$('#category_table').dataTable( {
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