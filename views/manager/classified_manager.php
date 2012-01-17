<?
$c = new Classified();
/*$classifieds = $c->GetAllItems();*/
$classifieds = $c->getAllWithUserDetails(null,false);
$classifiedsApproved = $c->getAllWithUserDetails(null,true);
$classifiedsBogus = $c->getAllWithUserDetails(null);

?>







<h1 style="margin:0;padding:0">Classified Manager - Waiting for Approval</h1>
<ul><li><a href="<?=$ss_url?>&method=classified-add">[+] add a classified</a></li></ul>
<br />

<?php if (count($classifieds) >= 1) { ?>

<div style="clear:both;"></div>
	<table id="classified_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="40">&nbsp;</th>
			<th width="">Classified Title</th>
			<th width="">Category</th>
			<th width="">Path</th>
			<th width="">Email</th>
			<th width="">First Name</th>
			<th width="">Last Name</th>
			<th width="65">Created</th>
			<th width="65">Updated</th>
		</tr></thead>
		<tbody>
			
	    <?php 
	    
	    foreach ($classifieds as $classified) { ?>

		<tr style="cursor:pointer;" class='classified_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'" onclick="location.href='<?php echo $ss_url; ?>&amp;method=classified-update&amp;classified_id=<?php echo $classified['id']; ?>'">
			<td><a href="<?php echo $ss_url; ?>&amp;method=classified-update&amp;classified_id=<? echo $classified['id']; ?>">update</a></td>
			<td><?php echo $classified['title']; ?></td>
			<td><?php echo $classified['category_name']; ?></td>
			<td><?php echo $classified['slug']; ?></td>
			<td><?php echo $classified['email']; ?></td>
			<td><?php echo $classified['scrapper_first_name']; ?></td>
			<td><?php echo $classified['scrapper_last_name']; ?></td>
			<td><?php echo date("Y-m-d", strtotime($classified['created_ts'])) ?></td>
			<td><?php echo !is_null($classified['updated_ts']) ? date("Y-m-d", strtotime($classified['updated_ts'])) : date("Y-m-d", strtotime($classified['created_ts'])) ?></td>
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
			$('#classified_table').dataTable( {
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



<h1 style="margin:0;padding:0">Classified Manager - Approved</h1>
<br />

<?php if (count($classifiedsApproved) >= 1) { ?>

<div style="clear:both;"></div>
	<table id="classifieds_approved_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="40">&nbsp;</th>
			<th width="">Classified Title</th>
			<th width="">Category</th>
			<th width="">Email</th>
			<th width="">First Name</th>
			<th width="">Last Name</th>
			<th width="65">Created</th>
			<th width="65">Updated</th>
		</tr></thead>
		<tbody>
			
	    <?php 
	    
	    foreach ($classifiedsApproved as $classified) { ?>

		<tr style="cursor:pointer;" class='classified_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'" onclick="location.href='<?php echo $ss_url; ?>&amp;method=classified-update&amp;classified_id=<?php echo $classified['id']; ?>'">
			<td><a href="<?php echo $ss_url; ?>&amp;method=classified-update&amp;classified_id=<? echo $classified['id']; ?>">update</a></td>
			<td><?php echo $classified['title']; ?></td>
			<td><?php echo $classified['category_name']; ?></td>
			<td><?php echo $classified['email']; ?></td>
			<td><?php echo $classified['scrapper_first_name']; ?></td>
			<td><?php echo $classified['scrapper_last_name']; ?></td>
			<td><?php echo date("Y-m-d", strtotime($classified['created_ts'])) ?></td>
			<td><?php echo !is_null($classified['updated_ts']) ? date("Y-m-d", strtotime($classified['updated_ts'])) : date("Y-m-d", strtotime($classified['created_ts'])) ?></td>
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
			$('#classifieds_approved_table').dataTable( {
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

