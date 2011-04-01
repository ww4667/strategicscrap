<h1 style="margin:0;padding:0">Facilities</h1>
<ul><li><a href="<?=$ss_url?>&method=facility-add">[+] add a facility</a></li></ul>
<br />
<?php if (count($facilities) >= 1) { ?>
<div style="clear:both;"></div>
	<table id="facility_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="40">&nbsp;</th>
			<th width="">Company</th>
			<th width="">Contact</th>
			<th width="">Phone</th>
			<th width="">Address</th>
			<th width="">City</th>
			<th width="">State/Province</th>
			<th width="">Region</th>
			<th width="">Material Count</th>
			<th width="65">Created</th>
			<th width="65">Updated</th>
		</tr></thead>
		<tbody>
	    <?php foreach ($facilities as $facility) { ?>
		<tr style="cursor:pointer;" class='facility_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'" onclick="location.href='<?php echo $ss_url; ?>&amp;method=facility-update&amp;facility_id=<?php echo $facility['id']; ?>'">
	    	<td><a href="<?php echo $ss_url; ?>&amp;method=facility-update&amp;facility_id=<? echo $facility['id']; ?>">update</a></td>
	    	<td><?php echo $facility['company']; ?></td>
			<td><?php echo ucwords($facility['first_name'] . ' ' . $facility['last_name']); ?></td>
			<td><?php echo $facility['business_phone']; ?></td>
			<td><?php echo ucwords($facility['address_1']); ?><br /><?php echo ucwords($facility['address_2']); ?></td>
			<td><?php echo ucwords($facility['city']); ?></td>
			<td><?php echo strtoupper($facility['state_province']); ?></td>
			<td><?php echo strtoupper($facility['region']); ?></td>
			<td><?php echo $facility['join_material']; ?></td>
			<td><?php echo date("Y-m-d", strtotime($facility['created_ts'])) ?></td>
			<td><?php echo !is_null($facility['updated_ts']) ? date("Y-m-d", strtotime($facility['updated_ts'])) : date("Y-m-d", strtotime($facility['created_ts'])) ?></td>
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
			$('#facility_table').dataTable( {
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