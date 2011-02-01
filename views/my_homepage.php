					
    <style type="text/css">
    .dataTables_scroll{background: #ebebeb;}
    </style>

				<div class="leftCol">
					<div class="lowerArea">
						<div id="marketData" class="twoColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
							<div class="moduleContent">
								<h3>Market Data</h3>
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
								<p>All prices are shown in US dollars per gross ton(GT) or (2,240lbs) of material delivered to the consumer unless otherwise noted.</p>
								<table>
									<tr class="row2">
									    <th>SCRAP TYPE</th>
									    <th>COST/GT</th>
									</tr>
									<? if( $region == "c" ) { ?>
										<? $i = 0; ?>
										<? foreach ($pricing as $p) { ?>
									<tr<?=$i%2?' class="row2"':""?>>
									    <td><?= $p->join_material[0]['name'] ?></td>
									    <td><?= $p->price ?></td>
									</tr>
										<? $i++; ?>
										<? } ?>
									<? } else { ?>
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
									<? } ?>
								</table>
							</div><div class="moduleBottom"><!-- IE hates empty elements --></div>
						</div>
					</div>
					<div class="upperRightCol">
						<div id="transportAverages" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
							<div class="moduleContent clearfix">
								<h3>Strategic News</h3>
								<hr />
								<div id ="twitter-wrapper">
  								<div id="twitter-pane">
  								   <div id="twitterFeed">
                     </div>
  								</div>
								</div>
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
							<div class="moduleContent clearfix">
								<h3>Transportation Requests</h3>
						      <div class="more">
						        <div class="refreshBtn"><a id="reloadRequests">refresh</a></div>
						      </div>
								<hr style="margin-bottom:0" />
								<table id = "data_table_1" style = "width: 559px;">
									<thead>
										<tr class="row2">
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
							 <div id="pane1">
								 <div id="content1">
								  <!-- IE hates empty elements -->
							   </div>
							 </div>
							</div>
							<div id="tab2">
               <div id="pane2">
  								<div id="content2">
  									<!-- IE hates empty elements -->
  								</div>
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
					<iframe src="https://www.surveygizmo.com/s3/iframe/373002/c8fa27b63ff8" frameborder="0" width="260" height="280" style="overflow:hidden" scrolling="no"></iframe>
					  	</div>
					</div><div class="moduleBottom"><!-- IE hates empty elements --></div>
					</div>
				</div>

<script type="text/javascript">
var scrapQuoteTimeout = null;


function activateScrapQuote(){

$(".scrapQuote").colorbox({ width:"550", inline:true, href:"#quoteForm", 
	onClosed:function(){if( scrapQuoteTimeout ) clearTimeout( scrapQuoteTimeout );},
    onComplete:function(){ 
    	current_request = $( this ).attr( "requestid" ); 
    	$("#request_loading").show();
    	$("#request_data").hide();
    	$("#request_success").hide();
    	$("#request_error").hide();
    	$.colorbox.resize();
    	$.getJSON(
    	    	'/controllers/remote_controller.php',
    	    	{	"method":"getRequestsFromSession",
        	    	"session_id":"<?=session_id();?>",
					"request_id": current_request },
				function(get_requests_data){
						
						var from = 	get_requests_data.join_scrapper[0].address_1 + '<br />' + 
						( get_requests_data.join_scrapper[0].address_2 != '' ? get_requests_data.join_scrapper[0].address_2 + '<br />' : '' ) + 
						get_requests_data.join_scrapper[0].city + ', ' + 
						get_requests_data.join_scrapper[0].state_province + ' ' + 
						get_requests_data.join_scrapper[0].postal_code;
						$("#bid_request_ship_from").html( from );
						
						var to = 	get_requests_data.join_facility[0].address_1 + '<br />' + 
						( get_requests_data.join_facility[0].address_2 != '' ? get_requests_data.join_facility[0].address_2 + '<br />' : '' ) + 
						get_requests_data.join_facility[0].city + ', ' + 
						get_requests_data.join_facility[0].state_province + ' ' + 
						get_requests_data.join_facility[0].postal_code;
						$("#bid_request_ship_to").html( to );
						
						var material = 	get_requests_data.join_material[0].name;
						$("#bid_request_material").html( material );
						
						var volume = 	get_requests_data.volume;
						$("#bid_request_quantity").html( volume );
						
						var delivery_date = 	get_requests_data.arrive_date;
						$("#bid_request_delivery_date").html( delivery_date );
						
						var transportation = 	get_requests_data.transportation_type;
						$("#bid_request_preferred_transporation").html( transportation );

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

												
												bid_op = ( get_requests_data.status < 2 ?  
																'<div class="bid" style="display:table;padding:5px 5px 5px 10px;border:3px solid #ccc;cursor:pointer;">' +
																'	<div style="float:left;width:329px;">' : 
																'<div class="bid" style="display:table;padding:5px 5px 5px 10px;border:3px solid #ccc;">' +
																'	<div style="float:left;width:429px;">' ) +
															'		<strong>Cost:</strong> '+transport_cost+'<br />' + 
															'		<strong>Material Price:</strong>'+material_price+' <br />'+
															'		<strong>Ship Date:</strong>'+ship_date+' <br />'+
															'		<strong>Arrival Date:</strong>'+arrival_date+' <br />'+
															'		<strong>Notes:</strong>'+notes+' <br />'+
															'	</div>' + 
															( get_requests_data.status < 2 ? 
																'	<div style="float:left;width:100px;" id="bidButtons_'+bid_id+'" >' + 
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
								    	$("#request_data").show(500, function(){ $.colorbox.resize();  });
								});
						
				}); 
	} 
});
}

  
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
      sw.recentRequestsrSlider = new sw.app.verticalSlider('#transportRequest', '.dataTables_scrollBody','#data_table_1',{overflow: "hidden", float: "left", width: "541px"}, {position: "relative"} );
            
    });
}
    $(document).ready(function(){   
      
      $("#reloadRequests").click(function(){
      
    	  reloadRequests();
      });
      
             
      $.ajax( {
        "dataType": 'json', 
        "type": "GET", 
        "url": "/controllers/remote_controller.php?type=data_tables&method=getRequests&uid=<?= $_SESSION['user']['id']  ?>&session_id=<?=session_id();?>",
        "session_id":"<?=session_id();?>", 
        "success": function (json) {
          //request_object = json.request_object[0];
          //console.dir(request_object);
          oTable = $('#data_table_1').dataTable({
            "aaData": json.aaData,
            "sScrollY": "380px",
              "bPaginate": false,
              "bFilter": false,
              "bInfo": false ,
              "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    $(nRow).addClass('scrapQuote');
                    $(nRow).attr('requestId', $(aData[0]).attr("requestId") );
                  return nRow;
                },
              "fnInitComplete": function() {
                activateScrapQuote();
                 sw.quoteManagerSlider = new sw.app.verticalSlider('#transportRequest', '.dataTables_scrollBody','#data_table_1',{overflow: "hidden", float: "left", width: "541px"}, {position: "relative"} );
              }
            });
          }
        }); 
         
       
        $('#latestNews').tabs();
      });
</script>
				
<div style="display:none">
  <div id="quoteForm" style="padding:20px; background:#fff;">
    <div id="bidForm">
      <h2>REQUEST</h2>
      <hr />
      <div id="request_data">
		<strong>Ship from:</strong><br /><span id="bid_request_ship_from" style="display:block;padding: 0 0 0 10px;"><!--  --></span> <br />
		<strong>Ship to:</strong><br /><span id="bid_request_ship_to" style="display:block;padding: 0 0 0 10px;"><!--  --></span><br />
		<strong>Material:</strong> <span id="bid_request_material"><!--  --></span><br />
		<strong>Volume (tons):</strong> <span id="bid_request_quantity"><!--  --></span><br />
		<strong>Delivery Date:</strong> <span id="bid_request_delivery_date"><!--  --></span><br />
		<strong>Preferred Transporation:</strong> <span id="bid_request_preferred_transporation"><!--  --></span>
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
