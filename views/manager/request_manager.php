<h1 style="margin:0;padding:0">Requests</h1>
<br />
<?php if (count($requests) >= 1) { ?>
<div style="clear:both;"></div>
	<table id="request_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="40">&nbsp;</th>
			<th width="">Scrapper</th>
			<th width="">Facility</th>
			<th width="">Material</th>
			<th width="">Volume</th>
			<th width="">Transport Type</th>
			<th width="">Bids</th>
			<th width="">Expiration</th>
			<th width="65">Created</th>
		</tr></thead>
		<tbody>
	    <?php foreach ($requests as $request) { ?>
		<tr style="cursor:pointer;" class='request_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'" onclick="location.href='<?php echo $ss_url; ?>&amp;method=request-details&amp;request_id=<?php echo $request['id']; ?>'">
	    	<td><a href="<?php echo $ss_url; ?>&amp;method=request-details&amp;request_id=<? echo $request['id']; ?>">details</a></td>
			<td><?php echo $request['join_scrapper'][0]['first_name'] . ' ' . $request['join_scrapper'][0]['last_name']; ?></td>
			<td><?php echo $request['join_facility'][0]['company']; ?></td>
			<td><?php echo $request['join_material'][0]['name']; ?></td>
			<td><?php echo $request['volume']; ?></td>
			<td><?php echo $request['transportation_type']; ?></td>
			<td><?php echo (empty($request['bid_count'])) ? '0' : $request['bid_count'] ?></td>
			<td><?php echo date("Y-m-d", strtotime($request['created_ts'])) ?><br /><?php echo date("H:i:s", strtotime($request['created_ts'])) ?></td>
			<td><?php echo date("Y-m-d", strtotime($request['created_ts'])) ?><br /><?php echo date("H:i:s", strtotime($request['created_ts'])) ?></td>
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
			$('#request_table').dataTable( {
				"aoColumnDefs": [
					{ "bSortable": false, "aTargets": [ 0 ] },
					{ "bSearchable": false, "aTargets": [ 0 ] }
			] } );
		});
	  });
	})(jQuery);
</script>