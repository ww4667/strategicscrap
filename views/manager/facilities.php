<ul>
	<li><a href="<?=$ss_url?>&method=scrappers">manager scrappers</a></li>
	<li><a href="<?=$ss_url?>&method=pricing">manager regional pricing</a></li>
</ul>
<br />
<ul><li><a href="<?=$ss_url?>&method=facility-add">[+] add a facility</a></li></ul>
<br />
<?php if (count($facilities) >= 1) { ?>

<p>You can sort the table by clicking on the column headers.</p>

<h1 style="margin:0;padding:0">Facilities</h1>
<ul class="pagination" id="facility_table_paginator"></ul>
<div style="clear:both;"></div>
	<table id="facility_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#707070" class="sortabletable" width="100%">
		<thead><tr>
			<th class="nosort" width="">&nbsp;</th>
			<th width="140">Company</th>
			<th width="">Contact</th>
			<th width="">Phone</th>
			<th width="">Address</th>
			<th width="10">City</th>
			<th width="">State/Province</th>
			<th width="">Region</th>
			<th width="">Created</th>
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
			<td><?php echo date("Y-m-d", strtotime($facility['created_ts'])) ?></td>
		</tr>
		<?php } ?>
				
		</tbody>
	</table>
<?php } else { ?>
<div class="message error"><p>No records to show. Try revising your search.</p></div>
<?php } ?>
<script type="text/javascript">
	window.addEvent('domready', function(){
	    new SortingTable('facility_table', {
		    zebra: true,                        // Stripe the table, also on initialize
	        paginator: new PaginatingTable('facility_table', 'facility_table_paginator', {
	            per_page: 15
	        })
	    });
	});
</script>