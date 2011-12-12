<h1 style="margin:0;padding:0">Scrappers</h1>
<br />
<?php if (count($scrappers) >= 1) { ?>
<div style="clear:both;"></div>
	<table id="scrapper_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="40">&nbsp;</th>
			<th width="">Company</th>
			<th width="">Contact</th>
			<th width="">Email (Username)</th>
			<th width="">Phone</th>
			<th width="">Address</th>
			<th width="">City</th>
			<th width="">State/Province</th>
			<th width="">Subscription Type</th>
			<th width="65">Last Login</th>
			<th width="65">Created</th>
			<th width="65">Updated</th>
		</tr></thead>
		<tbody>
	    <?php foreach ($scrappers as $scrapper) { ?>
		<tr style="cursor:pointer;" class='scrapper_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'" onclick="location.href='<?php echo $ss_url; ?>&amp;method=scrapper-update&amp;scrapper_id=<?php echo $scrapper['id']; ?>'">
	    	<td><a href="<?php echo $ss_url; ?>&amp;method=scrapper-update&amp;scrapper_id=<? echo $scrapper['id']; ?>">update</a></td>
	    	<td><?php echo $scrapper['company']; ?></td>
			<td><?php echo ucwords($scrapper['first_name'] . ' ' . $scrapper['last_name']); ?></td>
			<td><a href="mailto:<?php echo $scrapper['email']; ?>"><?php echo $scrapper['email']; ?></a></td>
			<td><?php echo $scrapper['work_phone']; ?></td>
			<td><?php echo ucwords($scrapper['address_1']); ?><br /><?php echo ucwords($scrapper['address_2']); ?></td>
			<td><?php echo ucwords($scrapper['city']); ?></td>
			<td><?php echo strtoupper($scrapper['state_province']); ?></td>
			<td><?php echo $scrapper['subscription_type']; ?></td>
			<td><?php echo ( empty($scrapper['last_login_ts']) ) ? "never" : date("Y-m-d", strtotime($scrapper['last_login_ts']))."<br />".date("H:i:s", strtotime($scrapper['last_login_ts'])) ?></td>
			<td><?php echo date("Y-m-d", strtotime($scrapper['created_ts'])) ?><br /><?php echo date("H:i:s", strtotime($scrapper['created_ts'])) ?></td>
			<td><?php echo ( !empty($broker['updated_ts']) ) ? date("Y-m-d", strtotime($scrapper['updated_ts']))."<br />".date("H:i:s", strtotime($scrapper['updated_ts'])) : date("Y-m-d", strtotime($scrapper['created_ts']))."<br />".date("H:i:s", strtotime($scrapper['created_ts'])) ?></td>
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
			$('#scrapper_table').dataTable( {
				"aoColumnDefs": [
					{ "bSortable": false, "aTargets": [ 0 ] },
					{ "bSearchable": false, "aTargets": [ 0 ] }
			] } );
		});
	  });
	})(jQuery);
</script>