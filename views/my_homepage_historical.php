					
    <style type="text/css">
    .dataTables_scroll{background: #ebebeb;}
	button.acceptButton{background:url(/resources/images/buttons/accept_bid.png);width:130px;height:32px;text-indent:-5000px;border:none;}
	button.sureButton{background:url(/resources/images/buttons/confirm.png);width:130px;height:32px;text-indent:-5000px;border:none;}
	button.cancelButton{background:url(/resources/images/buttons/cancel.png);width:130px;height:32px;text-indent:-5000px;border:none;margin-top:5px}
	button.acceptButton:hover{background:url(/resources/images/buttons/accept_bid_hover.png)}
	button.sureButton:hover{background:url(/resources/images/buttons/confirm_hover.png)}
	button.cancelButton:hover{background:url(/resources/images/buttons/cancel_hover.png)}
	.updated-timestamp{position:relative;left:30px;top:12px;float:left}
	.myhome div.dataTables_info{float:right}
	.myhome a.archive{width:22px;height:22px;display:block;background:url(/resources/images/buttons/dashboard_action.png) 0px 0px;text-indent:-5000px}
	.myhome a.archive:hover{background-position: 0px -22px}

    </style>

				<div class="leftCol">
					<div class="lowerArea">
						<div id="marketData" class="twoColMod" style="position:relative;"><div class="moduleTop"><!-- IE hates empty elements --></div>
						<? if (isset($subscription_type) && $subscription_type == "paid") { 
								// $market_json = json_decode('{"cash":[{"material":"LME Copper","last":"4.23","high":"4.23","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Aluminum","last":"4.21","high":"4.23","low":"4.19","open":"4.22","change":"-.01","change_percent":"-0.23%"},{"material":"LME Nickel","last":"4.22","high":"4.22","low":"4.19","open":"4.22","change":".00","change_percent":"0.00%"},{"material":"LME Zinc","last":"4.23","high":"4.23","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Lead","last":"4.23","high":"4.23","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Tin","last":"4.23","high":"4.23","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"COMEX Copper ","last":"4.23","high":"4.23","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"}],"three_month":[{"material":"LME Copper","last":"4.28","high":"4.28","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Aluminum","last":"4.28","high":"4.28","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Nickel","last":"4.28","high":"4.28","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Zinc","last":"4.28","high":"4.28","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Lead","last":"4.28","high":"4.28","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Tin","last":"4.28","high":"4.28","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"COMEX Copper ","last":"4.28","high":"4.28","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"}],"fifteen_month":[{"material":"LME Copper","last":"4.34","high":"4.34","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Aluminum","last":"4.34","high":"4.34","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Nickel","last":"4.34","high":"4.34","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Zinc","last":"4.34","high":"4.34","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Lead","last":"4.34","high":"4.34","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"LME Tin","last":"4.34","high":"4.34","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"},{"material":"COMEX Copper ","last":"4.34","high":"4.34","low":"4.19","open":"4.22","change":".01","change_percent":"0.23%"}]}');
?>

<style>

#marketData .ui-tabs-nav {
    list-style: none;
    margin: 0;
    padding: 0 0 0 0px;
	border-bottom: none;
	width:95px;
	float: right;
}
#marketData .ui-tabs-nav:after { /* clearing without presentational markup, IE gets extra treatment */
    display: block;
    clear: both;
    content: " ";
}
#marketData .ui-tabs-nav li {
    float: left;
    margin: 0 5px 0 0;
    min-width: 40px; /* be nice to Opera */
}
#marketData .ui-tabs-nav a, #marketData .ui-tabs-nav a span {
    display: block;
    background: none;
}
#marketData .ui-tabs-nav a {
    position: relative;
    top: 1px;
    z-index: 2;
    padding-left: 0;
    font-size: 12px;
    font-weight: bold;
    line-height: 40px;
    text-align: center;
    text-decoration: none;
    white-space: nowrap; /* required in IE 6 */    
}

#marketData .ui-tabs-nav a:visited{color:#fa6c15;}

#marketData .ui-tabs-nav .ui-tabs-selected a {
    color: #fa6c15;
}
#marketData .ui-tabs-nav .ui-tabs-selected a, #marketData .ui-tabs-nav a:hover, #marketData .ui-tabs-nav a:focus, #marketData .ui-tabs-nav a:active {
    background-position: 100% -99px;
    outline: 0; /* prevent dotted border in Firefox */
	text-decoration:none;
}
#marketData .ui-tabs-nav a, #marketData .ui-tabs-nav .ui-tabs-disabled a:hover, #marketData .ui-tabs-nav .ui-tabs-disabled a:focus, #marketData .ui-tabs-nav .ui-tabs-disabled a:active {
    background-position: 100% -82px;
	color:#999;
}
#marketData .ui-tabs-nav a span {
    width: 40px; /* IE 6 treats width as min-width */
    min-width: 40px;
    height: 41px; /* IE 6 treats height as min-height */
    min-height: 35px;
    padding-right: 0;
}
#marketData *>.ui-tabs-nav a span { /* hide from IE 6 */
    width: auto;
    height: auto;
}
#marketData .ui-tabs-nav .ui-tabs-selected a span {}
#marketData .ui-tabs-nav .ui-tabs-selected a span,#marketData  .ui-tabs-nav a:hover span,#marketData  .ui-tabs-nav a:focus span,#marketData  .ui-tabs-nav a:active span {
    background-position: 0 -40px;
    color: #000;
}
#marketData .ui-tabs-nav a span, #marketData .ui-tabs-nav .ui-tabs-disabled a:hover span,#marketData .ui-tabs-nav .ui-tabs-disabled a:focus span,#marketData  .ui-tabs-nav .ui-tabs-disabled a:active span {
    background-position: 0 0;
}
#marketData .ui-tabs-nav .ui-tabs-selected a:link, #marketData .ui-tabs-nav .ui-tabs-selected a:visited, #marketData .ui-tabs-nav .ui-tabs-disabled a:link, #marketData .ui-tabs-nav .ui-tabs-disabled a:visited { /* @ Opera, use pseudo classes otherwise it confuses cursor... */
    cursor: text;
}
#marketData .ui-tabs-nav a:hover, .ui-tabs-nav a:focus, .ui-tabs-nav a:active { /* @ Opera, we need to be explicit again here now... */
    cursor: pointer;
}
#marketData .ui-tabs-nav .ui-tabs-disabled {
    opacity: .4;
}
#marketData .ui-tabs-container {
    border-top: none;
    padding: 1em 8px;
    background: #fff; /* declare background color for container to avoid distorted fonts in IE while fading */
}
#marketData .ui-tabs-loading em {
    padding: 0 0 0 20px;
    background: none;
}

ul#regional_data{margin:0;padding:0;list-style:none;}
ul#regional_data li{margin:0;padding:0;list-style:none;}
.hide {display: none;}

.history_button{cursor: pointer}
.history_button:hover{color: #F86C13;}
.regional_button {
color: #F86C13;
font-weight: bold;
cursor: pointer;
font-size: 24px;
bottom: -2px;
position: relative;
padding: 0 4px;
}
.disabled{color:#999; cursor: default;}

#regional_data_period{width: 100px; text-align: center; display: inline-block;}

</style>
						<script type='text/javascript'><!--//<![CDATA[
							<?php if ($last == null) $last = time(); ?>
							var last = (<?= $last ?> * 1000);
							var next = last + default_interval;
							var now = +new Date();
							var interval = next - now;
							var default_interval = 120000;
							
							interval = (interval > 0 ) ? interval : default_interval;
							var update_interval = null;
							//console.log (interval);
							function startRequests( interval_delay ){				
								update_interval = setInterval(function(){
								var v = +new Date();
								
									$.ajax({
									  url: '/controllers/remote/?method=get-market-data-historical&v=' + v,
									  beforeSend: function(){
									  	$('#refreshing-overlay').show();
									  },
									  success: function(data) {	
									  
									  	
									  	$('#refreshing-overlay').hide();
									  	$("#market-data-div").html(data);
									  	$("#market-data-div").addClass("updated");
										$(".change_amount").click(function(){
											$(".change_amount").hide();
											$(".change_percent").show();
										})
									
										$(".change_percent").click(function(){
											$(".change_amount").show();
											$(".change_percent").hide();
										})
										
										
										$(".history_button").click(function(){
											var symbol = $(this).attr("data-symbol");
											symbol = (symbol == "HG")? symbol : "L" + symbol;
											var the_url = "/controllers/market_data_controller.php?method=history-data&symbol=" + symbol
											the_url = the_url + "&chart_title=" + $(this).attr("data-chart-title");
											the_url = the_url + "&change_cost=" + $(this).attr("data-change-cost");
											the_url = the_url + "&change_amount=" + $(this).attr("data-change-amount");
											the_url = the_url + "&change_percent=" + $(this).attr("data-change-percent");
											the_url = the_url + "&change_class=" + $(this).attr("data-change-class");
											//$.colorbox({iframe: true, href:"/market-data-history?symbol=" + $(this).attr("data-symbol"), innerWidth: "470px", innerHeight: "300px"});
											$.colorbox({iframe: true,href: the_url, innerWidth: "510px", innerHeight: "340px"});
										})
							 	
	        							$('#marketData').tabs("destroy");
	        							$('#marketData').tabs();
									  	}
									});
							    	if (interval_delay != default_interval){
								  		interval = default_interval;
								  		stopInterval(interval);
								  	}
								},interval_delay); 
								
							}
							
							function stopInterval(interval_delay){
								//console.log("kill it");
								clearInterval(update_interval);
								if (interval_delay > 0){
									startRequests(interval_delay);
								}
							}
										
							//console.log(interval);
							startRequests(interval);


							sw.regional_data  = {};
							sw.regional_data.current_page  = 0;
							
							function update_region_data(el){
							//	console.dir(el);
								$("#regional_data_period").html(el.attr("data-period"));
								$("#regional_data_timestamp").html(el.attr("data-timestamp"));
								
							}
								
							$('document').ready(function(){

								$(".history_button").click(function(){
									var symbol = $(this).attr("data-symbol");
									symbol = (symbol == "HG")? symbol : "L" + symbol;
									var the_url = "/controllers/market_data_controller.php?method=history-data&symbol=" + symbol
									the_url = the_url + "&chart_title=" + $(this).attr("data-chart-title");
									the_url = the_url + "&change_cost=" + $(this).attr("data-change-cost");
									the_url = the_url + "&change_amount=" + $(this).attr("data-change-amount");
									the_url = the_url + "&change_percent=" + $(this).attr("data-change-percent");
									the_url = the_url + "&change_class=" + $(this).attr("data-change-class");
									//console.log("/controllers/market_data_controller.php?method=history-data&symbol=" + symbol);
									//$.colorbox({iframe: true, href:"/market-data-history?symbol=" + $(this).attr("data-symbol"), innerWidth: "470px", innerHeight: "300px"});
									$.colorbox({iframe: true, href: the_url , innerWidth: "510px", innerHeight: "340px"});
								})
							
								$(".change_amount").click(function(){
									$(".change_amount").hide();
									$(".change_percent").show();
									//$(".change_percent", $(this).parent()).show();
									//$(this).hide();
								})
							
								$(".change_percent").click(function(){
									//$( ".change_amount", $(this).parent()).show();
									//$(this).hide();
									$(".change_amount").show();
									$(".change_percent").hide();
								})

					        	$(".regional_data_page").hide();
								$(".regional_data_page").first().show();
								
								update_region_data($(".regional_data_page").first());
								
								sw.regionalMarketDataSlider = new sw.app.verticalSlider('#marketData-wrapper', '#marketData-pane', '#marketData-content', {overflow: "hidden", float: "left", height: "132px", width: "541px"}, {position: "relative", width: "541px"} );
								sw.regional_data.page_count = $(".regional_data_page").length - 1 ;
									
								$("#regional_data_prev").click(function() {
									var is_disabled = $(this).hasClass("disabled");

									if(!is_disabled){
										
								      //   console.log(sw.regional_data.current_page);
								    	$(".regional_data_page:eq(" +  sw.regional_data.current_page + ")").hide();;
								    	sw.regional_data.current_page = sw.regional_data.current_page - 1;
								    	
								    	if(sw.regional_data.current_page < 1){
								    		$("#regional_data_next").removeClass("disabled");
								    		$("#regional_data_prev").addClass("disabled");
								    		sw.regional_data.current_page = 0;
								    	} else {
								    		$("#regional_data_prev").removeClass("disabled");
								    		$("#regional_data_next").removeClass("disabled");
								    	}
								         
								        //	slide the item
								    	$(".regional_data_page:eq(" +  sw.regional_data.current_page  + ")").show();
								    	update_region_data($(".regional_data_page:eq(" +  sw.regional_data.current_page  + ")"));
								    	sw.regionalMarketDataSlider = new sw.app.verticalSlider('#marketData-wrapper', '#marketData-pane', '#marketData-content', {overflow: "hidden", float: "left", height: "135px", width: "541px"}, {position: "relative", width: "541px"} );
									}
							    });
								 
							    //if user clicked on next button
							    $("#regional_data_next").click(function() {
									var is_disabled = $(this).hasClass("disabled");

									if(!is_disabled){
								    	$(".regional_data_page:eq(" +  sw.regional_data.current_page+ ")").hide();
								    	sw.regional_data.current_page = sw.regional_data.current_page +1;
								        //console.log(sw.regional_data.current_page);
								    	if(sw.regional_data.current_page >= sw.regional_data.page_count  ){
									    	//console.log(sw.regional_data.page_count);
								    		$("#regional_data_prev").removeClass("disabled");
								    		$("#regional_data_next").addClass("disabled");
								    		sw.regional_data.current_page = sw.regional_data.page_count ;
								    	} else {
								    		//console.log("else");
								    		$("#regional_data_next").removeClass("disabled");    
								    		$("#regional_data_prev").removeClass("disabled");	
								    	}
								      //   console.log(sw.regional_data.current_page);
								    	$(".regional_data_page:eq(" +  sw.regional_data.current_page + ")").show();
								    	update_region_data($(".regional_data_page:eq(" +  sw.regional_data.current_page  + ")"));
								    	sw.regionalMarketDataSlider = new sw.app.verticalSlider('#marketData-wrapper', '#marketData-pane', '#marketData-content', {overflow: "hidden", float: "left", height: "135px", width: "541px"}, {position: "relative", width: "541px"} );
									}
							    }); 
								
							});
							
							//]]>--></script>

							<div id = "market-data-div" class="moduleContent">
								<? require_once($_SERVER['DOCUMENT_ROOT']."/views/scrappers/scrap_market_data_historical.php"); ?>
							</div>
							<div id = "refreshing-overlay" style = "display:none;color: #fff;background: #000;position: absolute;top:52px; left:0;opacity:0.5;filter:alpha(opacity=50);width: 559px;">
								<div style='width: 135px; margin:0 auto; padding: 91px 0;'><img src = '/resources/images/loading.gif' style='float: left; margin-right: 8px;' />
									<b style = 'line-height: 32px;'>refreshing...</b>
									<br class = 'clearAll' /></div>
							</div>

						<? } else { ?>
							<div class="moduleContent">
								<h3>Market Data</h3>
								<div class="updated-timestamp">Updated: <?=$market_data_timestamp?></div>
								<div class="more">
									<div class="refreshBtn"><a id="reloadRequestsMD">refresh</a></div>
								</div>
								<hr style="margin-bottom:0" />
								<table>
								<tr class="row2">
								    <th>USD/LB</th>
								    <th>CASH</th>
								    <th>3 MONTH</th>
								    <th>15 MONTH</th>
								</tr>
								<?
								$i=0;
								if(!empty($market_data)){
									foreach ($market_data as $lbl => $val) {
									?>
									<tr<?=$i%2?' class="row2"':""?>>
									    <td><?=$lbl?></td>
									    <td><?=$val['cash']?></td>
									    <td><?=$val['3 month']?></td>
									    <td><?=$val['15 month']?></td>
									</tr>
									<?
									$i++;
									}
								} else {
								?>
									<tr><td colspan = "4" style ="padding-top: 80px; text-align: center;">There was an error loading the data</td></tr>
								<?
								}
								?>
								</table>
							</div>
							<? } ?>
							<div class="moduleBottom"><!-- IE hates empty elements --></div>	
						</div>
					</div>
					<div class="upperLeftCol">
						<div id="regionalPricing" class="twoColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
							<div class="moduleContent" style = "height: auto;">
							<?php $region_array = array("c"=>"Central","s"=>"South","w"=>"West","ne"=>"Northeast","se"=>"Southeast")?>
								<h3><?= $region_array[$region] ?> Ferrous Pricing</h3>
								<p style="padding-bottom:5px; padding-top:10px; border-top:1px solid #999; line-height: 22px;">
									Pricing for 
										<span id = "regional_data_next" class = " regional_button">&laquo;</span>
										<b><span id = "regional_data_period"></span></b>
										<span id = "regional_data_prev" class = "disabled regional_button">&raquo;</span>
									<span id = "regional_data_timestamp"></span>
								</p>
								<hr style="margin-bottom: 0" />
								<div id="marketData-wrapper" style="position: relative">
								<div id="marketData-pane" style="position: relative; margin-bottom: 10px">
								<div id="marketData-content">
								<? // if( $region == "c" ) { ?>
								<? if( $region != "ADSFKASDJLFALKSDJF" ) { ?>
									<ul id = "regional_data">
										<? 
										$count = 0;
										if(!empty($pricing_data)){
											foreach($pricing_data as $d){ ?>
											<li class = "regional_data_page hide" data-period="<?= date( "F Y", strtotime($d["year"] . "-" .$d["month"] . "-01")) ?>" data-timestamp="<?= ($count == 0) ? ' | Updated: ' . $d["timestamp"] : '' ?>">
												<table>
													<tr class="row2">
													    <th style = "width: 446px;">SCRAP TYPE</th>
													    <th>COST/GT</th>
													</tr>
													
													<? $i = 0; ?>
													<? foreach ($d["pricing"] as $p) { 
														$p = (object) $p; ?>
														<? if( !empty($p->price) && $p->price > 0) { ?>
															<tr<?=$i%2?' class="row2"':""?>>
															    <td><?= $p->join_material[0]['name'] ?></td>
															    <td><?= $p->price ?></td>
															</tr>
														<? $i++; ?>
														<? } ?>
														<? if( !empty($p->broker_price)  && $p->broker_price > 0) { ?>
															<tr<?=$i%2?' class="row2"':""?>>
															    <td><?= $p->join_material[0]['name'] ?></td>
															    <td>*<?= $p->broker_price ?></td>
															</tr>
														<? $i++; ?>
														<? } ?>
													<? } ?>
												</table>
											</li>
											<?
											$count++;
											}
										} ?>
									</ul>
										<? } else { ?>
									<p style="padding-bottom:10px; padding-top:10px">Updated: demo data </p>	
									<table>
										<tr class="row2">
										    <th>SCRAP TYPE</th>
										    <th>COST/GT</th>
										</tr>
										<tr>
										    <td>80% No.1 HMS / 20% No.2 HMS</td>
										    <td>362.00</td>
										</tr>
										<tr class="row2">
										    <td>No. 1 HMS</td>
										    <td>352.00</td>
										</tr>
										<tr>
										    <td>No. 2 HMS</td>
										    <td>462.00</td>
										</tr>
										<tr class="row2">
										    <td>No. 1 Bundles</td>
										    <td>274.00</td>
										</tr>
										<tr>
										    <td>No. 1 1/2 Bundles</td>
										    <td>466.00</td>
										</tr>
										<tr class="row2">
										    <td>No. 2 Bundles</td>
										    <td>385.00</td>
										</tr>
										<tr>
										    <td>No. 1 Busheling</td>
										    <td>281.00</td>
										</tr>
										<tr class="row2">
										    <td>Shredded Scrap</td>
										    <td>291.00</td>
										</tr>
										<tr>
										    <td>Machine Shop Turnings</td>
										    <td>374.00</td>
										</tr>
										<tr class="row2">
										    <td>Cast Iron Borings</td>
										    <td>620.00</td>
										</tr>
										<tr>
										    <td>Plate and Structural, < 2ft.</td>
										    <td>416.00</td>
										</tr>
										<tr class="row2">
										    <td>Plate and Structural, < 5ft.</td>
										    <td>416.00</td>
										</tr>
										<tr>
										    <td>No. 1 Machinery Cast</td>
										    <td>415.00</td>
										</tr>
										<tr class="row2">
										    <td>Rails Scrap, < 2ft.</td>
										    <td>351.00</td>
										</tr>
										<tr>
										    <td>Cupola Cast</td>
										    <td>296.00</td>
										</tr>
									</table>
								<? } ?>
								</div>
								</div>
								</div>
								<p class = "clear_both">All prices are shown in US dollars per gross ton(GT) or (2,240lbs) of material delivered to the consumer unless otherwise noted.<br />
								* denotes broker buying prices</p>
							</div><div class="moduleBottom"><!-- IE hates empty elements --></div>
						</div>
					</div>
					<div class="lowerArea" style="clear:both">
						<div class="twoColMod" id="transportRequest"><div class="moduleTop"><!-- IE hates empty elements --></div>
							<div class="moduleContent clearfix">
								<h3>Scrap Exchange Requests</h3>
						      <div class="more">
						        <div class="refreshBtn"><a id="reloadRequests">refresh</a></div>
						      </div>
								<hr style="margin-bottom:0" />
								<?php
								/*
						        <div class="filter">
						          <div><input type="checkbox" name="filter_complete" checked="checked" value="complete" /> complete</div>
						          <div><input type="checkbox" name="filter_expired" checked="checked" value="expired" /> expired</div>
						          <div><input type="checkbox" name="filter_waiting" checked="checked" value="waiting" /> waiting</div>
						          <div><input type="checkbox" name="filter_archived" value="archived" /> archived</div>
						          <div style="clear:both;float:none"><!-- IE hates empty elemenets --></div>
						        </div>
						        */
						        ?>
								<table id = "data_table_1" style = "width: 559px; position: relative;">
									<thead>
										<tr class="row2">
										    <th>&nbsp;</th>
										    <th>EXPIRATION</th>
										    <th>DESCRIPTION</th>
										    <th>CREATED</th>
										    <th>STATUS</th>
										    <th>BIDS</th>
										</tr>
									</thead>
									<tbody id="requests_table">
										<?php
										//$recent_requests = file_get_contents( $pageURL."/controllers/remote/?method=getRequests&uid=".$_SESSION['user']['id']."&type=html&sessionid=" . session_id() );
										//$_controller_remote_included = true;

										//require_once($_SERVER['DOCUMENT_ROOT']."/controllers/remote_controller.php");

//										controller_remote( 	'getRequests', 
	//														'html', 
		//													null, 
			//												$_SESSION['user']['id'], 
				//											null, 
					//										$_controller_remote_included );

										/*if ($recent_requests !== false) {
										   print $recent_requests;
										} else {
										   print "Error loading requests data.";
										}*/
										?>

									</tbody>
								</table>
								</div>
							<div class="moduleBottom"><!-- IE hates empty elements --></div>	
						</div>
					</div>
					
				</div>
				<div class="rightCol">
					<div id="rightAd1" class="rcAd">
					
					<!--/* OpenX Javascript Tag v2.4.5 */-->

<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://strategicscrap.com/openads/www/delivery/ajs.php':'http://strategicscrap.com/openads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=5");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script><noscript><a href='http://strategicscrap.com/openads/www/delivery/ck.php?n=a64c18ab&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='https://strategicscrap.com/openads/www/delivery/avw.php?zoneid=5&amp;n=a64c18ab' border='0' alt='' /></a></noscript>
					
						<? //<a href="http://alineironandmetals.com" title="A-Line Iron & Metals"><img src="resources/images/ad/a-line.png" /></a> ?>
					</div>
					<div id="latestNews" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
						<div class="moduleContent clearfix">
						<h3>Latest News</h3>
						<hr />
					  	<ul id="tabs-news">
							<li><a href="#tab1"><span>Scrap</span></a></li>
							<li><a href="#tab2"><span>Business</span></a></li>
						</ul>
						<div class="tabBox">
							<div id="tab1">
							 <div id="pane1" style = "position: relative;">
								 <div id="content1">
								  <!-- IE hates empty elements -->
							   </div>
							 </div>
							</div>
							<div id="tab2">
               <div id="pane2" style = "position: relative;">
  								<div id="content2">
  									<!-- IE hates empty elements -->
  								</div>
								</div>
							</div>
						</div>
					</div><div class="moduleBottom"><!-- IE hates empty elements --></div>
					</div>
				</div>

<script type="text/javascript">
var scrapQuoteTimeout = null;

function activateScrapQuote(){

	$('a.archive').click(function(){
		var requestId = $(this).parent().attr('requestid');
		
		$.getJSON(
    	    	'/controllers/remote',
    	    	{	"method":"archiveRequest",
        	    	"session_id":"<?=session_id();?>",
					"request_id": requestId },
				function(archive_request_response){
						// console.log('accept_bid_response: ' + accept_bid_response);
					if( archive_request_response.success == 'true' ){
				    	reloadRequests();
					}
				});
	});

$(".scrapQuote td").not("td:has(a)").colorbox({ width:"550", inline:true, href:"#quoteForm", 
	onClosed:function(){if( scrapQuoteTimeout ) clearTimeout( scrapQuoteTimeout );},
    onComplete:function(){ 
    	current_request = $( this ).parent().attr( "requestid" ); 
    	$("#request_loading").show();
    	$("#request_data").hide();
    	$("#scrap_bid_request_data").hide();
    	$("#request_success").hide();
    	$("#request_error").hide();
    	$.colorbox.resize();
    	$.getJSON(
    	    	'/controllers/remote_controller.php',
    	    	{	"method":"getRequestsFromSession",
        	    	"session_id":"<?=session_id();?>",
					"request_id": current_request },
				function(get_requests_data){
						var scrapper = get_requests_data['request_snapshot']['scrapper'];
						var facility = get_requests_data['request_snapshot']['facility'];
						var r_material = get_requests_data['request_snapshot']['material'];
		
						var fromItem =  (get_requests_data['request_snapshot']['from']) ? get_requests_data['request_snapshot']['from'] : null ;
						var toItem =  (get_requests_data['request_snapshot']['to']) ? get_requests_data['request_snapshot']['to'] : null ;

						var from = ((  fromItem && fromItem['from_address_1'] != null)? fromItem['from_address_1'] : scrapper['address_1']) + '<br />' + 
						( ((scrapper['address_2'] != '' && scrapper['address_2'] != null) || ( fromItem && fromItem['from_address_2'] != '' && fromItem['from_address_2'] != null)) ? (( fromItem['from_address_2'] != null)? fromItem['from_address_2'] : scrapper['address_2']) + '<br />' : '' ) + 
						((  fromItem && fromItem['from_city'] != null)? fromItem['from_city'] : scrapper['city']) + ', ' + 
						((  fromItem && fromItem['from_state_province'] != null)? fromItem['from_state_province'] : scrapper['state_province']) + ' ' + 
						((  fromItem && fromItem['from_postal_code'] != null)? fromItem['from_postal_code'] : scrapper['postal_code']);
						$("#bid_request_ship_from").html( from );
						
						var to = ((  toItem != null && toItem['to_company'] != null)? toItem['to_company'] : facility['company']) + '<br />' + 
						((  toItem != null && toItem['to_address_1'] != null)? toItem['to_address_1'] : facility['address_1']) + '<br />' + 
						( (facility['address_2'] != '' && facility['address_2'] != null) ? facility['address_2'] + '<br />' : '' ) + 
						(( toItem != null && toItem['to_city'] != null)? toItem['to_city'] : facility['city']) + ', ' + 
						(( toItem != null && toItem['to_state_province'] != null)? toItem['to_state_province'] : facility['state_province']) + ' ' + 
						(( toItem != null && toItem['to_zip_postal_code'] != null)? toItem['to_zip_postal_code'] : facility['zip_postal_code']);
						// checking for category exporter,broker to toggle different details view
						var broker_view = false;
						var facility_category = facility['category'];
						if (facility_category == 'Broker') broker_view = true;
						if (facility_category == 'Exporter') broker_view = true;
						$("#bid_request_ship_to").html( to );
						$("#scrap_bid_request_ship_to").html( to );

						var material = 	r_material['name'];
						$("#bid_request_material").html( material );
						$("#scrap_bid_request_material").html( material );
						
						var volume = 	get_requests_data['volume'];
						$("#bid_request_quantity").html( volume );
						$("#scrap_bid_request_quantity").html( volume );
						
						var delivery_date = 	get_requests_data['arrive_date'];
						$("#bid_request_delivery_date").html( delivery_date );
						
						var transportation = 	get_requests_data['transportation_type'];
						$("#bid_request_preferred_transporation").html( transportation );
						
						var special_instructions = 	get_requests_data['special_instructions'];
						$("#bid_request_notes").html( special_instructions );
						$("#scrap_bid_request_notes").html( special_instructions );

						$("#bid_data").html('');
						
						$.getJSON(
				    	    	'/controllers/remote',
				    	    	{	"method":"getBidsByRequestId",
				        	    	"session_id":"<?=session_id();?>",
									"request_id": current_request },
								function(bid_data){
										var transport_cost, material_price, ship_date, arrival_date, notes, status, 
											complete = false, bid_output = '', bid_selected_output = '', bid_op = '', i=0;

										if( bid_data ){
											if( bid_data.length < 1 ){

												bid_output = '<div class="bid" style="display:table;padding:5px 5px 5px 10px;">' + 
																	'	<div style="float:left;width:429px;">' + 
																	'		<strong>There are no bids at this time.</strong>' + 
																	'	</div>' + 
																	'</div>';
											}

											if( get_requests_data.status > 1 ) complete = true;
											
											for( i; i<bid_data.length; i++ ){

												bid_id 			=	bid_data[i].id;
												transport_cost 	=	bid_data[i].transport_cost;
												material_price 	=	bid_data[i].material_price;
												ship_date 		=	bid_data[i].ship_date;
												arrival_date 	=	bid_data[i].arrival_date;
												notes 			=	bid_data[i].notes;
												status 			=	bid_data[i].status;
												company			=	bid_data[i].join_broker[0]['company'];

												
												bid_op = ( get_requests_data.status < 2 ?  
																'<div class="bid" style="display:table;padding:5px 5px 5px 10px;border:3px solid #ccc;cursor:pointer;">' +
																'	<div style="float:left;width:329px;">' : 
																'<div class="bid" style="display:table;padding:5px 5px 5px 10px;border:3px solid #ccc;">' +
																'	<div style="float:left;width:429px;">' ) +
															'		<strong>Broker:</strong> '+company+'<br />' + 
															'		<strong>Cost:</strong> '+transport_cost+'<br />' + 
															'		<strong>Material Price:</strong>'+material_price+' <br />'+
															'		<strong>Ship Date:</strong>'+ship_date+' <br />'+
															'		<strong>Arrival Date:</strong>'+arrival_date+' <br />'+
															'		<strong>Notes:</strong>'+notes+' <br />'+
															'	</div>' + 
															( get_requests_data.status < 2 ? 
																'	<div style="float:left;width:140px;" id="bidButtons_'+bid_id+'" >' + 
																'		<button type="button" class="acceptButton" id="accept_'+bid_id+'" bidid='+bid_id+' >Accept this Bid</button>' + 
																'		<button type="button" class="sureButton" id="sure_'+bid_id+'" bidid='+bid_id+' >Click to Accept</button>' + 
																'		<button type="button" class="cancelButton" id="cancel_'+bid_id+'" bidid='+bid_id+' >Click to Cancel</button>' + 
																'	</div>' : 
																'' ) + 
															'</div>';
												if( complete && status == 1 ){
													bid_selected_output = '<strong>Selected Bid</strong><br />' + bid_op + '<hr /><br />' + '<strong>Not Selected</strong><br />';
												} else {
													bid_output += bid_op;
												}
											}
											// console.log(bid_selected_output + bid_output);
											$("#bid_data").html( bid_selected_output + bid_output );
	
											$('.acceptButton').click(function(){
												var bidId = $(this).attr('bidid');
												$('#accept_'+bidId).hide();
												$('#sure_'+bidId).show();
												$('#cancel_'+bidId).show(0, function(){ $.colorbox.resize();  });}); 
											
											$('.sureButton').click(function(){
												var bidId = $(this).attr('bidid');
												
												// console.log('msg: before getJSON for: ' + bidId);
												$.getJSON(
										    	    	'/controllers/remote',
										    	    	{	"method":"acceptBid",
										        	    	"session_id":"<?=session_id();?>",
															"bid_id": bidId },
														function(accept_bid_response){
																// console.log('accept_bid_response: ' + accept_bid_response);
															if( accept_bid_response.success == 'true' ){

														    	$("#request_loading").hide();
														    	$("#request_data").hide();
														    	$("#request_error").hide();
														    	$("#request_success").show(500, function(){ $.colorbox.resize(); scrapQuoteTimeout = setTimeout(function(){ clearTimeout( scrapQuoteTimeout );$.colorbox.close();},5000); });
														    	reloadRequests();
															} else {
														    	$("#request_loading").hide();
														    	$("#request_data").hide();
														    	$("#request_success").hide();
														    	$("#request_error").show(500, function(){ $.colorbox.resize();  });
															}
														});
											}).hide();
											
											$('.cancelButton').click(function(){
												var bidId = $(this).attr('bidid');
												$('#accept_'+bidId).show();
												$('#sure_'+bidId).hide();
												$('#cancel_'+bidId).hide(0, function(){ $.colorbox.resize();  }); }).hide();
										
										}

								    	$("#request_loading").hide();
								    	if (broker_view) {
								    		$("#scrap_bid_request_data").show(500, function(){ $.colorbox.resize();  });
								    	} else {
								    		$("#request_data").show(500, function(){ $.colorbox.resize();  });
								    	}
								});
						
				}); 
	} 
}); // end colorbox function
} // end activateScrapQuote

  
  $.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback ){
    
      //console.log("table refreshing");
    if ( typeof sNewSource != 'undefined' ){
      oSettings.sAjaxSource = sNewSource;
    }
    this.oApi._fnProcessingDisplay( oSettings, true );
    var that = this;
    
    oSettings.fnServerData( oSettings.sAjaxSource, null, function(json) {
      /* Clear the old information from the table */
      that.oApi._fnClearTable( oSettings );
      //console.dir(json);
      //console.log("table refreshed");
      /* Got the data - add it to the table */
      for ( var i=0 ; i<json.aaData.length ; i++ ){
        that.oApi._fnAddData( oSettings, json.aaData[i] );
      }
      oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
      that.fnDraw( that );
      that.oApi._fnProcessingDisplay( oSettings, false );
             
      /* Callback user function - for event handlers etc */
      if ( typeof fnCallback == 'function' ){
        fnCallback( oSettings );
      }
    });
  }

  var oTable;
function reloadRequests(){

    oTable.fnReloadAjax("/controllers/remote/?type=data_tables&method=getRequests&uid=<?= $_SESSION['user']['id']  ?>&session_id=<?=session_id();?>", function(json){        
    
      //request_object = json.request_object[0];
      activateScrapQuote();
      sw.recentRequestsrSlider = new sw.app.verticalSlider('#transportRequest', '.dataTables_scrollBody','#data_table_1',{overflow: "hidden", float: "left", width: "541px", position: "relative"}, {position: "relative"} );
            
    });
}
    $(document).ready(function(){
      
      $("#reloadRequests").click(function(){
    	  reloadRequests();
      });
      
             
      $.ajax( {
        "dataType": 'json', 
        "type": "GET", 
        "url": "/controllers/remote/?type=data_tables&method=getRequests&uid=<?= $_SESSION['user']['id']  ?>&session_id=<?=session_id();?>", 
        "session_id":"<?=session_id();?>", 
        "success": function (json) {
          //request_object = json.request_object[0];
          //console.dir(request_object);
          oTable = $('#data_table_1').dataTable({
            "aaData": json.aaData,
            "aoColumnDefs": [
				{ "sWidth": "65px", "aTargets": [ 1, 3 ] }
			],
            "sScrollY": "232px",
              "bPaginate": false,
//              "bFilter": false,
              "bInfo": true ,
              "sDom": '<"filter clearfix"<"checks">i><t>',
	      		"oLanguage": {
	      			"sLengthMenu": "Display _MENU_ records per page",
	      			// "sZeroRecords": "Nothing found - sorry",
	      			"sZeroRecords": "No matching records.",
	      			// "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
	      			"sInfo": "_TOTAL_ records",
	      			// "sInfoEmpty": "Showing 0 to 0 of 0 records",
	      			"sInfoEmpty": "0 records",
	      			// "sInfoFiltered": "(filtered from _MAX_ total records)"
	      			"sInfoFiltered": ""
	      		},
              "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    $(nRow).addClass('scrapQuote');
                    $(nRow).attr('requestId', $(aData[0]).attr("requestId") );
                  return nRow;
                },
              "fnInitComplete": function() {
                activateScrapQuote();
                 sw.quoteManagerSlider = new sw.app.verticalSlider('#transportRequest', '.dataTables_scrollBody','#data_table_1',{overflow: "hidden", float: "left", width: "541px", position: "relative"}, {position: "relative"} );
              }
				,"fnDrawCallback": function() {
					sw.quoteManagerSlider = new sw.app.verticalSlider('#transportRequest', '.dataTables_scrollBody','#data_table_1',{overflow: "hidden", float: "left", width: "541px", position: "relative"}, {position: "relative"} );
              	}
            });

          // ADD the checkboxes to the filter bar
          
          var filter_html = '<div><input type="checkbox" name="filter_complete" checked="checked" value="complete" /> complete</div>'
      				    + '<div><input type="checkbox" name="filter_expired" checked="checked" value="expired" /> expired</div>'
      				    + '<div><input type="checkbox" name="filter_active" checked="checked" value="active" /> active</div>'
      				    + '<div><input type="checkbox" name="filter_waiting" checked="checked" value="waiting" /> waiting</div>'
      				    + '<div><input type="checkbox" name="filter_archived" value="archived" /> archived</div>'
      				    + '<div style="clear:both;float:none"><!-- IE hates empty elemenets --></div>';

          $("div.checks").html(filter_html);
          $("div.filter").append('<div style="clear:both;float:none"><!-- IE hates empty elemenets --></div>');
          
        	// START code for request filter

        	oTable.fnFilter("archive", 0);
        	
        	$(".filter input").change( function () {
        		/* Filter on the column (the index) of this element */
        		var status_filter = "empty";
        		var archive_filter = "archive";
        		var checked = $(".filter input:checked");
        		$.each(checked, function(key, item) {
        			if (key == 0) status_filter = "";
        			if (key + 1 == checked.length) {
        				status_filter += item.value; 
        			} else {
        				status_filter += item.value + "|"; 
        			}
        			if (item.value == "archived") {
        				archive_filter = "hidden";
        			}
        		});
        		oTable.fnFilter( status_filter, 4, 1 );
        		oTable.fnFilter( archive_filter, 0, 1 );
                activateScrapQuote();
        	} );
        	
        	// END code for request filter
          
          }
        });
       
        $('#latestNews').tabs();
	<? if (isset($subscription_type) && $subscription_type == "paid") { ?>
        $('#marketData').tabs();
	<? } ?>

      });
</script>
				
<div style="display:none">
  <div id="quoteForm" style="padding:20px; background:#fff;">
    <div id="bidForm">
      <h2>REQUEST</h2>
      <hr />
      <div id="scrap_bid_request_data" style="display:none">
		<strong>Request sent to:</strong><br /><span id="scrap_bid_request_ship_to" style="display:block;padding: 0 0 0 10px;"><!--  --></span><br />
		<strong>Material:</strong> <span id="scrap_bid_request_material"><!--  --></span><br />
		<strong>Volume (tons):</strong> <span id="scrap_bid_request_quantity"><!--  --></span><br />
		<strong>Special Instructions:</strong> <span id="scrap_bid_request_notes"><!--  --></span><br />
		<br />
      	<hr />
		<h2>BIDS</h2>
		<div>
			Your scrap pricing request has been sent to this company. You should be contacted directly with bids. 
		</div>
      </div>
      <div id="request_data">
		<strong>Ship from:</strong><br /><span id="bid_request_ship_from" style="display:block;padding: 0 0 0 10px;"><!--  --></span> <br />
		<strong>Ship to:</strong><br /><span id="bid_request_ship_to" style="display:block;padding: 0 0 0 10px;"><!--  --></span><br />
		<strong>Material:</strong> <span id="bid_request_material"><!--  --></span><br />
		<strong>Volume (tons):</strong> <span id="bid_request_quantity"><!--  --></span><br />
		<strong>Delivery Date:</strong> <span id="bid_request_delivery_date"><!--  --></span><br />
		<strong>Preferred Transporation:</strong> <span id="bid_request_preferred_transporation"><!--  --></span><br />
		<strong>Special Instructions:</strong> <span id="bid_request_notes"><!--  --></span><br />
		<br />
      	<hr />
		<h2>BIDS</h2>
		<div id="bid_data">
			
		</div>
      </div>
      <div id="request_loading">Loading Request</div>
      <div id="request_success">The bid was accepted.</div>
      <div id="request_error">There was an error.</div>
      <hr />
      
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#grid-sample").colorbox();
	});
</script>