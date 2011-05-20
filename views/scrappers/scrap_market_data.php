<?php ?>
	<h3>Market Data </h3>
	<div class="updated-timestamp">Updated: <?= str_replace(" (delayed)","",$market_data_timestamp)?></div>
		<ul id="tabs-market">
			<li><a href="#tab_cash"><span>CASH</span></a></li>
			<li><a href="#tab_3mo"><span>3MO</span></a></li>
			<li><a href="#tab_15mo"><span>15MO</span></a></li>
		</ul>
	<hr style="margin-bottom:0" />
	<div class="tabBox">
		<div id="tab_cash">
			<table>
				<thead>
					<tr class="row2">
					    <th style = "width: 105px;">USD/LB</th>
					    <th>LAST</th>
					    <th>HIGH/LOW</th>
					    <th>OPEN</th>
					    <th style = "width: 95px;">CHANGE (#/%)</th>
					</tr>
				</thead>
				<?
				$i=0;
				foreach ($market_json->cash as $m) {
					
					$extra_class = ($m->change > 0)? "positive": "negative";
					if ($m->change == 0) $extra_class = "";
				?>
				<tr<?=$i%2?' class="row2"':""?>>
				    <td><?=$m->material ?></td>
				    <td><?=$m->last?></td>
				    <td><?=$m->high?>/<?=$m->low?></td>
				    <td><? echo ($m->symbol == "HG") ? $m->open : $m->previous_close ?></td>
				    <td class = "<?=$extra_class?>"><span class = "change_amount"><?=$m->change?></span><span class = "change_percent" style = "display: none;"><?=$m->change_percent?>%</span></td>
				</tr>
				<?
				$i++;
				}
				?>
			</table>
		</div>
		<div id="tab_3mo">
			<table>
				<thead>
					<tr class="row2">
					    <th style = "width: 105px;">USD/LB</th>
					    <th>LAST</th>
					    <th>HIGH/LOW</th>
					    <th>OPEN</th>
					    <th style = "width: 95px;">CHANGE (#/%)</th>
					</tr>
				</thead>
				<?
				$i=0;
				foreach ($market_json->three_month as $m) {
					$extra_class = ($m->change > 0)? "positive": "negative";
					if ($m->change == 0) $extra_class = "";
				?>
				<tr<?=$i%2?' class="row2"':""?>>
				    <td><?=$m->material ?></td>
				    <td><?=$m->last?></td>
				    <td><?=$m->high?>/<?=$m->low?></td>
				    <td><? echo ($m->symbol == "HG") ? $m->open : $m->previous_close ?></td>
				    <td class = "<?=$extra_class?>"><span class = "change_amount"><?=$m->change?></span><span class = "change_percent" style = "display: none;"><?=$m->change_percent?>%</span></td>
				</tr>
				<?
				$i++;
				}
				?>
			</table>
		</div>
		<div id="tab_15mo">
			<table>
				<thead>
					<tr class="row2">
					    <th style = "width: 105px;">USD/LB</th>
					    <th>LAST</th>
					    <th>HIGH/LOW</th>
					    <th>OPEN</th>
					    <th style = "width: 95px;">CHANGE (#/%)</th>
					</tr>
				</thead>
				<?
				$i=0;
				foreach ($market_json->fifteen_month as $m) {
					$extra_class = ($m->change > 0)? "positive": "negative";
					if ($m->change == 0) $extra_class = "";
				?>
				<tr<?=$i%2?' class="row2"':""?>>
				    <td><?=$m->material ?></td>
				    <td><?=$m->last?></td>
				    <td><?=$m->high?>/<?=$m->low?></td>
				    <td><? echo ($m->symbol == "HG") ? $m->open : $m->previous_close ?></td>
				    <td class = "<?=$extra_class?>"><span class = "change_amount"><?=$m->change?></span><span class = "change_percent" style = "display: none;"><?=$m->change_percent?>%</span></td>
				</tr>
				<?
				$i++;
				}
				?>
			</table>
		</div>
	</div>