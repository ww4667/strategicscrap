<h1 style="margin:0;padding:0">Transportation Brokers</h1>
<ul><li><a href="<?=$ss_url?>&method=broker-add">[+] add a transportation broker</a></li></ul>
<br />
<?php if (count($brokers) >= 1) { ?>
<div style="clear:both;"></div>
	<table id="broker_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="40">&nbsp;</th>
			<th width="">Company</th>
			<th width="">Contact</th>
			<th width="">Email (Username)</th>
			<th width="">Phone</th>
			<th width="">Address</th>
			<th width="">City</th>
			<th width="">State/Province</th>
			<th width="65">Last Login</th>
			<th width="65">Created</th>
			<th width="65">Updated</th>
		</tr></thead>
		<tbody>
	    <?php foreach ($brokers as $broker) { ?>
		<tr style="cursor:pointer;" class='broker_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'" onclick="location.href='<?php echo $ss_url; ?>&amp;method=broker-update&amp;broker_id=<?php echo $broker['id']; ?>'">
	    	<td><a href="<?php echo $ss_url; ?>&amp;method=broker-update&amp;broker_id=<? echo $broker['id']; ?>">update</a></td>
	    	<td><?php echo $broker['company']; ?></td>
			<td><?php echo ucwords($broker['first_name'] . ' ' . $broker['last_name']); ?></td>
			<td><a href="mailto:<?php echo $broker['email']; ?>"><?php echo $broker['email']; ?></a></td>
			<td><?php echo $broker['work_phone']; ?></td>
			<td><?php echo ucwords($broker['address_1']); ?><br /><?php echo ucwords($broker['address_2']); ?></td>
			<td><?php echo ucwords($broker['city']); ?></td>
			<td><?php echo strtoupper($broker['state_province']); ?></td>
			<td><?php echo ( empty($broker['last_login_ts']) ) ? "never" : date("Y-m-d", strtotime($broker['last_login_ts']))."<br />".date("H:i:s", strtotime($broker['last_login_ts'])) ?></td>
			<td><?php echo date("Y-m-d", strtotime($broker['created_ts'])) ?><br /><?php echo date("H:i:s", strtotime($broker['created_ts'])) ?></td>
			<td><?php echo ( !empty($broker['updated_ts']) ) ? date("Y-m-d", strtotime($broker['updated_ts']))."<br />".date("H:i:s", strtotime($broker['updated_ts'])) : date("Y-m-d", strtotime($broker['created_ts']))."<br />".date("H:i:s", strtotime($broker['created_ts'])) ?></td>
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
			$('#broker_table').dataTable( {
				"aoColumnDefs": [
					{ "bSortable": false, "aTargets": [ 0 ] },
					{ "bSearchable": false, "aTargets": [ 0 ] }
			] } );
		});
	  });
	})(jQuery);
</script>