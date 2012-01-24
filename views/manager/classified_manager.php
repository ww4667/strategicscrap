<?

$c = new Classified();
$classifieds = $c->getAllWithUserDetails(array('approved'=>FALSE,'expired'=>FALSE,'showContacts'=>true,'classifiedType'=>true));

$classifiedsApproved = $c->getAllWithUserDetails(array('approved'=>TRUE,'expired'=>FALSE,'showContacts'=>true,'classifiedType'=>true));

$classifiedsExpired = $c->getAllWithUserDetails(array('expired'=>TRUE,'showContacts'=>true,'classifiedType'=>true));

//$c->PTS($classifiedsApproved,'$classifiedsApproved');

?>







<h1 style="margin:0;padding:0">Classifieds - Waiting for Approval</h1>
<ul><li><a href="<?=$ss_url?>&method=classified-add">[+] add a classified</a></li></ul>
<br />

<?php if (count($classifieds) >= 1) { ?>

<div style="clear:both;"></div>
	<table id="classified_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="40">&nbsp;</th>
			<th width="">Classified Type</th>
			<th width="">Classified Title</th>
			<th width="">Category</th>
			<th width="">Category Path</th>
			<th width="">Contact Info</th>
			<th width="65">Created</th>
			<th width="65">Updated</th>
		</tr></thead>
		<tbody>
			
	    <?php 
	    
	    foreach ($classifieds as $classified) { 
	    

			$fieldsInputArray = explode(",", $classified['classifiedType_fields']);
			$contactOutput = "";
			foreach( $fieldsInputArray as $k2 => $v2 ){
				// !22|Contact
				$temp = explode("|",$v2);
				
				$contactOutput .= '<strong>' . $temp[1] . '</strong>:&nbsp;' . $classified[ 'contact_' . $temp[ 2 ] ] . '<br />';
						
			}


	
    	?>

		<tr style="cursor:pointer;" class='classified_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'" onclick="location.href='<?php echo $ss_url; ?>&amp;method=classified-update&amp;classified_id=<?php echo $classified['id']; ?>'">
			<td valign="top"><a href="<?php echo $ss_url; ?>&amp;method=classified-update&amp;classified_id=<? echo $classified['id']; ?>">update</a></td>
			<td valign="top"><?php echo $classified['classifiedType_name']; ?></td>
			<td valign="top"><?php echo $classified['title']; ?></td>
			<td valign="top"><?php echo $classified['category_name']; ?></td>
			<td valign="top"><?php echo $classified['slug']; ?></td>
			<td valign="top"><?php echo $contactOutput ?></td>
			<td valign="top"><?php echo date("Y-m-d", strtotime($classified['created_ts'])) ?></td>
			<td valign="top"><?php echo !is_null($classified['updated_ts']) ? date("Y-m-d", strtotime($classified['updated_ts'])) : date("Y-m-d", strtotime($classified['created_ts'])) ?></td>
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



<h1 style="margin:0;padding:0">Classifieds - Approved</h1>
<br />

<?php if (count($classifiedsApproved) >= 1) { ?>

<div style="clear:both;"></div>
	<table id="classifieds_approved_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="40">&nbsp;</th>
			<th width="">Classified Type</th>
			<th width="">Classified Title</th>
			<th width="">Category Path</th>
			<th width="">Contact Info</th>
			<th width="65">Created</th>
			<th width="65">Updated</th>
		</tr></thead>
		<tbody>
			
	    <?php 
	    
	    foreach ($classifiedsApproved as $classified) { 
	    

			$fieldsInputArray = explode(",", $classified['classifiedType_fields']);
			$contactOutput = "";
			foreach( $fieldsInputArray as $k2 => $v2 ){
				// !22|Contact
				$temp = explode("|",$v2);
				
				$contactOutput .= '<strong>' . $temp[1] . '</strong>:&nbsp;' . $classified[ 'contact_' . $temp[ 2 ] ] . '<br />';
						
			}

			
    	?>

		<tr style="cursor:pointer;" class='classified_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'" onclick="location.href='<?php echo $ss_url; ?>&amp;method=classified-update&amp;classified_id=<?php echo $classified['id']; ?>'">
			<td valign="top"><a href="<?php echo $ss_url; ?>&amp;method=classified-update&amp;classified_id=<? echo $classified['id']; ?>">update</a></td>
			<td valign="top"><?php echo $classified['classifiedType_name']; ?></td>
			<td valign="top"><?php echo $classified['title']; ?></td>
			<td valign="top"><?php echo $classified['slug']; ?></td>
			<td valign="top"><?php echo $contactOutput ?></td>
			<td valign="top"><?php echo date("Y-m-d", strtotime($classified['created_ts'])) ?></td>
			<td valign="top"><?php echo !is_null($classified['updated_ts']) ? date("Y-m-d", strtotime($classified['updated_ts'])) : date("Y-m-d", strtotime($classified['created_ts'])) ?></td>
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




<h1 style="margin:0;padding:0">Classifieds - Expired</h1>
<br />
<?php if (count($classifiedsExpired) >= 1) { ?>

<div style="clear:both;"></div>
	<table id="classified_table_expired" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="40">&nbsp;</th>
			<th width="">Classified Type</th>
			<th width="">Classified Title</th>
			<th width="">Category Path</th>
			<th width="">Contact Info</th>
			<th width="65">Created</th>
			<th width="65">Updated</th>
		</tr></thead>
		<tbody>
			
	    <?php 
	    
	    foreach ($classifiedsExpired as $classified) { 
	    

			$fieldsInputArray = explode(",", $classified['classifiedType_fields']);
			$contactOutput = "";
			foreach( $fieldsInputArray as $k2 => $v2 ){
				// !22|Contact
				$temp = explode("|",$v2);
				
				$contactOutput .= '<strong>' . $temp[1] . '</strong>:&nbsp;' . $classified[ 'contact_' . $temp[ 2 ] ] . '<br />';
						
			}


	
    	?>
		
		<tr style="cursor:pointer;" class='classified_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'" onclick="location.href='<?php echo $ss_url; ?>&amp;method=classified-update&amp;classified_id=<?php echo $classified['id']; ?>'">
			<td valign="top"><a href="<?php echo $ss_url; ?>&amp;method=classified-update&amp;classified_id=<? echo $classified['id']; ?>">update</a></td>
			<td valign="top"><?php echo $classified['classifiedType_name']; ?></td>
			<td valign="top"><?php echo $classified['title']; ?></td>
			<td valign="top"><?php echo $classified['category_name']; ?></td>
			<td valign="top"><?php echo $classified['slug']; ?></td>
			<td valign="top"><?php echo $contactOutput ?></td>
			<td valign="top"><?php echo date("Y-m-d", strtotime($classified['created_ts'])) ?></td>
			<td valign="top"><?php echo !is_null($classified['updated_ts']) ? date("Y-m-d", strtotime($classified['updated_ts'])) : date("Y-m-d", strtotime($classified['created_ts'])) ?></td>
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
			$('#classified_table_expired').dataTable( {
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
