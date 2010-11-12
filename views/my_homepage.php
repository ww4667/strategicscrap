				<div class="leftCol">
					<div class="lowerArea">
						<div id="marketData" class="twoColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
							<div class="moduleContent">
								<h3>Market Data</h3>
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
								foreach ($lme as $data) {
								?>
								<tr<?=$i%2?' class="row2"':""?>>
								    <td>LME <?=$data->metal?></td>
								    <td><?=number_format($data->Quote[0]->Last/2204.62262,2)?></td>
								    <td><?=number_format($data->Quote[1]->Last/2204.62262,2)?></td>
								    <td><?=number_format($data->Quote[2]->Bid/2204.62262,2)?></td>
								</tr>
								<?
								$i++;
								}
								?>
								<?
								$i=(count($lme)%2)?1:0;
//								foreach ($comex as $data) {
								?>
								<tr<?=$i%2?' class="row2"':""?>>
								    <td>COMEX Copper</td>
								    <td><?=number_format($comex['cash'],2)?></td>
								    <td><?=""?></td>
								    <td><?=""?></td>
								</tr>
								<?
								$i++;
//								}
								?>
								</table>
							</div><div class="moduleBottom"><!-- IE hates empty elements --></div>	
						</div>
					</div>
					<div class="upperLeftCol">
						<div id="regionalPricing" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
							<div class="moduleContent">
								<h3>Regional Ferrous Pricing</h3>
								<hr />
								<p>Our pricing is based on averages of actual transactions reported to us by mills, foundries, brokers &amp; exporters.</p>
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
								<p class="note">All prices are shown in US dollars per gross ton(GT) or (2,240lbs) of material delivered to the consumer unless otherwise noted.</p>
							</div><div class="moduleBottom"><!-- IE hates empty elements --></div>
						</div>
					</div>
					<div class="upperRightCol">
						<div id="transportAverages" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
							<div class="moduleContent">
								<h3>Strategic News</h3>
								<hr />
								<div id="twitterFeed"></div>
							</div><div class="moduleBottom"><!-- IE hates empty elements --></div>
						</div>
						
						<div id="localWeather" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
							<div class="moduleContent">
								<div style="padding:10px 10px 10px;">
								<strong><?=$weather->loc->dnam?> Weather</strong><br />
								Updated: <?=date('M d, Y, g:ia T',strtotime($weather->cc->lsup))?><br />
								<img src="/resources/images/weather/icons/93x93/<?=$weather->cc->icon?>.png" alt="<?=$weather->cc->t?>" style="float:left;" /><div style="color:#999;font-size:60px;margin:10px;float:left"><?=$weather->cc->tmp?>&deg;<span style="font-size:30px">F</span></div>
								<div style="clear:both;">
								<strong><a href="#" style="text-decoration:underline;">Details</a></strong><br /><br />
								<p class="note">Weather data provided by <a href="http://www.weather.com/">The Weather Channel</a> and <a href="http://www.weather.com/">weather.com</a></p>
								</div>
								</div>
							</div><div class="moduleBottom"><!-- IE hates empty elements --></div>	
						</div>
					</div>
					<div class="lowerArea" style="clear:both">
						<div class="twoColMod" id="transportRequest"><div class="moduleTop"><!-- IE hates empty elements --></div>
							<div class="moduleContent">
								<h3>Transportation Requests</h3>
								<hr style="margin-bottom:0" />
								<table>
								<tbody><tr class="row2">
								    <th>EXPIRATION</th>
								    <th>DESCRIPTION</th>
								    <th>REQUEST DATE</th>
								    <th>STATUS</th>
								</tr>
								<tr>
								    <td>05/15/2010</td>
								    <td><strong>Ship to:</strong> Demo Steel Company<br><strong>Material:</strong> No. 1 Machinery Cast<br><strong>Quantity (tons):</strong> 550<br><strong>Delivery Date:</strong> 05/13/2010</td>
								    <td>04/30/2010</td>
								    <td><span style="text-decoration:underline;">view bids (4)</span></td>
								</tr>
								<tr class="row2">
								    <td>06/10/2010</td>
								    <td><strong>Ship to:</strong> Demo Steel Company<br><strong>Material:</strong> No. 1 Machinery Cast<br><strong>Quantity (tons):</strong> 550<br><strong>Delivery Date:</strong> 05/10/2010</td>
								    <td>05/03/2010</td>
								    <td><span style="text-decoration:underline;">view bids (1)</span></td>
								</tr>
								<tr>
								    <td>06/08/2010</td>
								    <td><strong>Ship to:</strong> Demo Steel Company<br><strong>Material:</strong> No. 1 Machinery Cast<br><strong>Quantity (tons):</strong> 550<br><strong>Delivery Date:</strong> 05/10/2010</td>
								    <td>05/04/2010</td>
								    <td>waiting</td>
								</tr>
							</tbody></table>
							</div><div class="moduleBottom"><!-- IE hates empty elements --></div>	
						</div>
					</div>
					
				</div>
				<div class="rightCol">
					<div id="rightAd1" class="rcAd">
					
					<!--/* OpenX Javascript Tag v2.4.5 */-->

<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://www.strategicscrap.com/openads/www/delivery/ajs.php':'http://www.strategicscrap.com/openads/www/delivery/ajs.php');
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
//]]>--></script><noscript><a href='http://www.strategicscrap.com/openads/www/delivery/ck.php?n=a64c18ab&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://www.strategicscrap.com/openads/www/delivery/avw.php?zoneid=5&amp;n=a64c18ab' border='0' alt='' /></a></noscript>
					
						<? //<a href="http://alineironandmetals.com" title="A-Line Iron & Metals"><img src="resources/images/ad/a-line.png" /></a> ?>
					</div>
					
					<div id="latestNews" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
						<div class="moduleContent">
						<h3>Latest News</h3>
						<hr />
					  	<ul id="tabs-news">
							<li><a href="#tab1"><span>Scrap</span></a></li>
							<li><a href="#tab2"><span>Business</span></a></li>
						</ul>
						<div class="tabBox">
							<div id="tab1">
								<div id="scroll-pane1">
									<!-- IE hates empty elements -->
								</div>
							</div>
							<div id="tab2">
								<div id="scroll-pane2">
									<!-- IE hates empty elements -->
								</div>
							</div>
						</div>
					</div><div class="moduleBottom"><!-- IE hates empty elements --></div>
					</div>
					<div id="latestNews" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
						<div class="moduleContent">
						<h3>Quick Vote</h3>
						<hr />
					  	<div id="scrapPoll">
					<iframe src="http://www.surveygizmo.com/s3/iframe/373002/0a8278693451" frameborder="0" width="260" height="280" style="overflow:hidden" scrolling="no"></iframe>
					  	</div>
					</div><div class="moduleBottom"><!-- IE hates empty elements --></div>
					</div>
				</div>