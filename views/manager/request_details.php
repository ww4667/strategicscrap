<h1 style="margin:0;padding:0">Requests // Details</h1>
<ul>
	<li><a href="<?= $ss_url ?>&amp;method=request-manager">Back to Requests</a></li>
</ul>
<br />
<div class="sectionHeader">Viewing Request ID: <?= $request->id ?></div>
<div class="sectionBody order_details">
	<div class="label"><strong>Created On:</strong></div>
	<div class="value"><?= $request->created_ts ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Expiration Date:</strong></div>
	<div class="value"><?= $request->expiration_date ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Ship Date:</strong></div>
	<div class="value"><?= $request->ship_date ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Arrive Date:</strong></div>
	<div class="value"><?= $request->arrive_date ?></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<div><strong>Request Data:</strong><hr /></div>
	<div class="label"><strong>Material:</strong></div>
	<div class="value"><?= $request->join_material[0]['name'] ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Volume:</strong></div>
	<div class="value"><?= $request->volume ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Transportation Type:</strong></div>
	<div class="value"><?= $request->transportation_type ?></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<div><strong>Scrapper Information:</strong><hr /></div>
	<div class="label"><strong>Name:</strong></div>
	<div class="value"><?= $request->join_scrapper[0]['first_name'] . " " . $request->join_scrapper[0]['last_name'] ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Originating Address:</strong></div>
	<div class="value"><?= $request->join_scrapper[0]['address_1'] ?><br />
	<?= $request->join_scrapper[0]['address_2'] ?><br />
	<?= $request->join_scrapper[0]['city'] ?>, <?= $request->join_scrapper[0]['state_province'] ?> <?= $request->join_scrapper[0]['postal_code'] ?><br />
	<?= $request->join_scrapper[0]['country'] ?></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<div><strong>Receiving Facility Information:</strong><hr /></div>
	<div class="label"><strong>Facility Name:</strong></div>
	<div class="value"><?= $request->join_facility[0]['company'] ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Destination Address:</strong></div>
	<div class="value"><?= $request->join_facility[0]['address_1'] ?><br />
	<?= $request->join_facility[0]['address_2'] ?><br />
	<?= $request->join_facility[0]['city'] ?>, <?= $request->join_facility[0]['state_province'] ?> <?= $request->join_facility[0]['zip_postal_code'] ?><br />
	<?= $request->join_facility[0]['country'] ?></div>
    <br style="clear:left" />
</div>
<div class="sectionHeader">Submitted Bids: <?= count($bids) ?></div>
<div class="sectionBody order_details">
<?php if (count($bids) >= 1) { ?>
<div style="clear:both;"></div>
	<table id="bid_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th width="">Broker</th>
			<th width="">Transport Cost</th>
			<th width="">Price/GT</th>
			<th width="">Ship Date</th>
			<th width="">Arrival Date</th>
			<th width="">Additional Notes</th>
			<th width="65">Created</th>
		</tr></thead>
		<tbody>
	    <?php foreach ($bids as $bid) { ?>
		<tr style="cursor:pointer;" class='bid_row' onmouseover="this.style.color='#999'" onmouseout="this.style.color='#333'">
			<td><?php echo $bid->join_broker[0]['first_name'] . ' ' . $bid->join_broker[0]['last_name']; ?></td>
			<td><?php echo $bid->transport_cost; ?></td>
			<td><?php echo $bid->material_price; ?></td>
			<td><?php echo date("Y-m-d", strtotime($bid->ship_date)); ?></td>
			<td><?php echo date("Y-m-d", strtotime($bid->arrival_date)); ?></td>
			<td><?php echo $bid->notes; ?></td>
			<td><?php echo date("Y-m-d", strtotime($bid->created_ts)) ?><br /><?php echo date("H:i:s", strtotime($bid->created_ts)) ?></td>
		</tr>
		<?php } ?>
				
		</tbody>
	</table>
<div style="clear:both;"></div>
<?php } else { ?>
<div class="message error"><p>There are no bids for this request.</p></div>
<?php } ?>
<script type="text/javascript"> 
	jQuery.noConflict();
	(function($) { 
	  $(function() {
		$(document).ready(function () {
			$('#bid_table').dataTable( {
				"aoColumnDefs": [
					{ "bSortable": false, "aTargets": [ 0 ] },
					{ "bSearchable": false, "aTargets": [ 0 ] }
			] } );
		});
	  });
	})(jQuery);
</script>
	
</div>