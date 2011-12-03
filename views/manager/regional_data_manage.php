<h2>Add new data</h2>
<table>
	<tr>
	<? foreach($regions as $key=> $val){?>
	<td style = "width: 120px">
		<a href = "<?=$ss_url?>&amp;method=regional-data-add&amp;region=<?= $key ?>"><?= $val?></a>
	</td>
	<? }?>
	</tr>
</table>

<hr />

<h2>Edit existing data</h2>
<table>
	<tr>
<? foreach($regions as $key=> $val){?>
		<td style = "vertical-align:top; width: 120px;">
			<h3><?= $val ?></h3>
			<ul>
				<? foreach($region_data[$key] as $r){?>
				<li>
					<a href = "<?=$ss_url?>&amp;method=regional-data-edit&amp;year=<?= $r["year"]?>&amp;month=<?= $r["month"]?>&amp;region=<?= $key ?>"><?= date("F Y", strtotime($r["year"] . "-" . $r["month"] . "-01"))?></a>
				</li>
				<? } ?>
			</ul>
		</td>
<? }?>
	</tr>
</table>