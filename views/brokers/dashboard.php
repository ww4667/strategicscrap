<?php 
  $use_ui = $_GET["use_ui"];
?>

    <script type="text/javascript"><!--
      var requestInterval = 0, bidInterval = 0, reqObject = {}, current_request = -1, iii = 0;
    
      function getRequests(){

          $('#recent_requests').load("/controllers/remote/?method=getRequests&buid=<?=$_SESSION['user']['id'] ?>&type=html", function() {
//              alert('Load was performed.');
            $('#scroll-pane2').jScrollPane();
              $(".scrapQuote").colorbox({ width:"550", inline:true, href:"#quoteForm",
                onClosed:function(){clearTimeout(colorboxTimeOut);}, 
                onComplete:function(){ current_request = $( this ).attr( "requestCount" ); loadBidForm(); $.colorbox.resize();  } 
              });
          });
        //requestInterval = setTimeout("getRequests",20000);
      }


      
      function getBids(){
        
        $('#recent_bids').load("/controllers/remote/?method=getBids&uid=<?=$_SESSION['user']['id'] ?>&type=html", function() {
            $('#scroll-pane1').jScrollPane();
        });
        //bidInterval = setTimeout("getBids();",20000);
      }

	      function loadBidForm(  ){
			
	        $("#bidForm").show();
	        $("#bidResult").hide();
	        var item = request_object[ current_request ]; 

			//console.dir(item);
	        
	        var scrapperData = "", facilityData = "";
	        var sItem = item['request_snapshot']['scrapper'];
	        var fItem = item['request_snapshot']['facility'];
	        var mItem = item['request_snapshot']['material'];
	        var rItem = item['request_snapshot']['request'];
			var fromItem =  (item['request_snapshot']['from']) ? item['request_snapshot']['from'] : null ;
			var toItem =  (item['request_snapshot']['to']) ? item['request_snapshot']['to'] : null ;
	        
	        if( sItem ){ 
	          $("#join_scrapper").val( sItem['id'] );
	        } 
	
	        if( sItem && sItem['company'] ){ 
	            scrapperData += sItem['company'] + '<br />';
	        } 
	        
	        if( sItem && sItem['address_1'] ){ 
	            scrapperData += (( fromItem && fromItem['from_address_1'] != null)? fromItem['from_address_1'] : sItem['address_1']) + '<br />';
	        } 
	        
	        if( sItem && sItem['address_2'] ){ 
	            scrapperData += (( fromItem && fromItem['from_address_2'] != null)? fromItem['from_address_2'] :sItem['address_2']) + '<br />';
	        } 
	        
	        if( sItem && sItem['city'] ){ 
	            scrapperData += (( fromItem && fromItem['from_city'] != null)? fromItem['from_city'] : sItem['city']) +  ', ';
	        } 
	        
	        if( sItem && sItem['state_province'] ){ 
	            scrapperData += (( fromItem && fromItem['from_state_province'] != null)? fromItem['from_state_province'] : sItem['state_province']) + ' ';
	        } 
	        
	        if( sItem && sItem['postal_code'] ){ 
	            scrapperData += (( fromItem && fromItem['from_postal_code'] != null)? fromItem['from_postal_code'] : sItem['postal_code']) + ' ';
	        } 
	
	        if( scrapperData.length > 0 ){
	          $("#bid_request_ship_from").html( scrapperData );
	        } else {
	          alert("This bid cannot happen because there is no Scrapper.");
	        }
	
	
	        if( item['id'] ) 
	          $("#join_request").val(item['id']);
	        
	
	        if( fItem ) 
	          $("#join_facility").val( fItem['id'] != null ? fItem['id'] : 0 );
	        
	
	        if( fItem && fItem['company'] )
	          facilityData += (( toItem && toItem['to_company'] != null)? toItem['to_company'] : fItem['company']) + '<br />';
	        
	        
	        if( fItem && fItem['address_1'] )
	          facilityData += (( toItem && toItem['to_address_1'] != null)? toItem['to_address_1'] : fItem['address_1']) + '<br />';
	        
	        
	        if( fItem && fItem['address_2'] )
	          facilityData += (( toItem && toItem['to_address_2'] != null)? toItem['to_address_2'] : fItem['address_2']) + '<br />';
	        
	        
	        if( fItem && fItem['city'] )
	          facilityData += (( toItem && toItem['to_city'] != null)? toItem['to_city'] : fItem['city']) + ', ';
	        
	        
	        if( fItem && fItem['state_province'] )
	          facilityData += (( toItem && toItem['to_state_province'] != null)? toItem['to_state_province'] : fItem['state_province']) + ' ';
	        
	        
	        if( fItem && fItem['zip_postal_code'] )
	          facilityData += (( toItem && toItem['to_postal_code'] != null)? toItem['to_zip_postal_code'] : fItem['zip_postal_code']) + ' ';
	        
	
	        if( facilityData.length > 0 ){
	          $("#bid_request_ship_to").html( facilityData );
	        } else {
	          alert("This bid cannot happen because there is no Facility.");
	        }
	
	        if( mItem ){
	          $("#bid_request_material").html( mItem['name'] );
	          $("#join_material").val( mItem['id'] != null ? mItem['id'] : 0 );
	        } else {
	          alert("This bid cannot happen because there is no Material.");
	        }
	
	        $("#bid_request_quantity").html( item['volume'] );
	        $("#bid_request_shipping_date").html( item['ship_date'] );
	        $("#bid_request_delivery_date").html( item['arrive_date'] );
	        $("#bid_request_preferred_transporation").html( item['transportation_type'] );
	        $("#bid_request_special_instructions").html( item['special_instructions'] );
	        
	      }

	      function loadBidDetails(  ){
	
	         $("#quoteDetails").show();
	        var item = bid_object[ current_bid ]; 
	        
	        var scrapperData = "", facilityData = "";
	        var sItem = item['request_snapshot']['scrapper'];
	        var fItem = item['request_snapshot']['facility'];
	        var mItem = item['request_snapshot']['material'];
	        var rItem = item['request_snapshot']['request'];
			var fromItem =  (item['request_snapshot']['from']) ? item['request_snapshot']['from'] : null ;
			var toItem =  (item['request_snapshot']['to']) ? item['request_snapshot']['to'] : null ;
	        
	        if( sItem ){ 
	          $("#join_scrapper").val( sItem['id'] );
	        } 
	
	        if( sItem && sItem['company'] ){ 
	            scrapperData += sItem['company'] + '<br />';
	        } 
	        		        
	        if( sItem && sItem['address_1'] ){ 
	            scrapperData += (( fromItem && fromItem['from_address_1'] != null)? fromItem['from_address_1'] : sItem['address_1']) + '<br />';
	        } 
	        
	        if( sItem && sItem['address_2'] ){ 
	            scrapperData += (( fromItem && fromItem['from_address_2'] != null)? fromItem['from_address_2'] :sItem['address_2']) + '<br />';
	        } 
	        
	        if( sItem && sItem['city'] ){ 
	            scrapperData += (( fromItem && fromItem['from_city'] != null)? fromItem['from_city'] : sItem['city']) +  ', ';
	        } 
	        
	        if( sItem && sItem['state_province'] ){ 
	            scrapperData += (( fromItem && fromItem['from_state_province'] != null)? fromItem['from_state_province'] : sItem['state_province']) + ' ';
	        } 
	        
	        if( sItem && sItem['postal_code'] ){ 
	            scrapperData += (( fromItem && fromItem['from_postal_code'] != null)? fromItem['from_postal_code'] : sItem['postal_code']) + ' ';
	        } 

	        if( scrapperData.length > 0 ){
	          $("#bid_request_ship_from").html( scrapperData );
	        } else {
	          alert("This bid cannot happen because there is no Scrapper.");
	        }
	
	
	        if( item['id'] ) 
	          $("#join_request").val(item['id']);
	        
	
	        if( fItem ) 
	          $("#join_facility").val( fItem['id'] );
	       
	        if( fItem && fItem['company'] )
	          facilityData += (( toItem && toItem['to_company'] != null)? toItem['to_company'] : fItem['company']) + '<br />';
	        
	        
	        if( fItem && fItem['address_1'] )
	          facilityData += (( toItem && toItem['to_address_1'] != null)? toItem['to_address_1'] : fItem['address_1']) + '<br />';
	        
	        
	        if( fItem && fItem['address_2'] )
	          facilityData += (( toItem && toItem['to_address_2'] != null)? toItem['to_address_2'] : fItem['address_2']) + '<br />';
	        
	        
	        if( fItem && fItem['city'] )
	          facilityData += (( toItem && toItem['to_city'] != null)? toItem['to_city'] : fItem['city']) + ', ';
	        
	        
	        if( fItem && fItem['state_province'] )
	          facilityData += (( toItem && toItem['to_state_province'] != null)? toItem['to_state_province'] : fItem['state_province']) + ' ';
	        
	        
	        if( fItem && fItem['zip_postal_code'] )
	          facilityData += (( toItem && toItem['to_zip_postal_code'] != null)? toItem['to_zip_postal_code'] : fItem['zip_postal_code']) + ' ';
	        
	
	        if( facilityData.length > 0 ){
	          $("#bid_request_ship_to").html( facilityData );
	        } else {
	          alert("This bid cannot happen because there is no Facility.");
	        }
	
	        if( mItem ){
	          $("#bid_request_material").html( mItem['name'] );
	          $("#join_material").val( mItem['id'] );
	        } else {
	          alert("This bid cannot happen because there is no Material.");
	        }
	
	        $("#bid_request_quantity").html( rItem['volume'] );
	        $("#bid_request_ship_date").html( item['ship_date'] );
	        $("#bid_request_delivery_date").html( item['arrival_date'] );
	        $("#bid_request_preferred_transporation").html( rItem['transportation_type'] );
	        $("#bid_request_transporation_cost").html( "$" + item['transport_cost'] );
	        $("#bid_request_special_instructions").html( rItem['special_instructions'] );
	        $("#bid_request_broker_notes").html( item['notes'] );
	        $("#bid_request_scrapper_name").html( sItem['first_name'] + " " + sItem['last_name'] );
	        $("#bid_request_scrapper_phone").html( sItem['work_phone'] );
	        
	      }
      
      $(document).ready(function(){
        $("#bidResult").hide();
        //getRequests();

          // $(".scrapQuote").colorbox({ width:"550", inline:true, href:"#quoteForm", 
          // onComplete:function(){ current_request = $( this ).attr( "requestCount" ); loadBidForm(); $.colorbox.resize();  } 
          // });
          
      });
    --></script>
    
    <style type="text/css">
    .dataTables_scroll{background: #ebebeb;}
    </style>

<div class="brokerDashboard">
<div class="leftCol">
<div class="lowerArea">
  <div class="twoColMod" id="recentResponses">
    <div class="moduleTop"><!-- IE hates empty elements --></div>
    <div class="moduleContent clearfix">    
      
        <h3>QUOTE MANAGER</h3>
        <div class="more">
			<div class="refreshBtn"><a id="reloadRequestsMD">refresh</a></div>
        </div>
	      <div class="more">
	         <a href="[~27~]">advanced</a>
	      </div>
        <hr />
        <div class="filter">
          <div><input type="checkbox" name="filter_accepted" checked="checked" value="accepted" /> accepted</div>
          <div><input type="checkbox" name="filter_expired" checked="checked" value="expired" /> expired</div>
          <div><input type="checkbox" name="filter_rejected" checked="checked" value="rejected" /> rejected</div>
          <div><input type="checkbox" name="filter_waiting" checked="checked" value="waiting" /> waiting</div>
          <div style="clear:both;float:none"><!-- IE hates empty elemenets --></div>
        </div>
        <table id="data_table_1" style = "width: 541px;" >
          <thead>
            <tr class="row2">
                <th style="width:100px">STATUS</th>
                <th style="">DESCRIPTION</th>
                <th style="width:100px">QUOTE DATE</th>
            </tr>
          </thead>  
          <tbody id="recent_bids">
            <?php 
            /*
            $recent_bids = file_get_contents($pageURL."/controllers/remote/?method=getBids&uid=".$_SESSION['user']['id'] ."&type=html");
                    
            if ($recent_bids !== false) {
               print $recent_bids;
            } else {
               print "Error loading bid data.";
            }*/
            
            
            // $_controller_remote_included = true;
            // 
            // require_once($_SERVER['DOCUMENT_ROOT']."/controllers/remote_controller.php");
            // 
            //  controller_remote(  'getBids', 
            //            'html', 
            //            null, 
            //            $_SESSION['user']['id'], 
            //            null, 
            //            $_controller_remote_included );
            
             
             
            ?>
          </tbody>
      </table>
    
    </div>
    <div class="moduleBottom"><!-- IE hates empty elements --></div>  
  </div>
  <div class="twoColMod" id="recentRequests">
    <div class="moduleTop"><!-- IE hates empty elements --></div>
    <div class="moduleContent clearfix">
        <h3>Recent Requests</h3>
      <div class="more">
		<div class="refreshBtn"><a id="reloadRequestsMD">refresh</a></div>
      </div>
      <div class="more">
         <a href="[~22~]">advanced</a>
      </div>
      <hr />
      <table id="data_table_2" style = "width: 559px;" >
        <thead>
          <tr class="row2">
              <th style="width:100px">EXPIRATION</th>
              <th style="width:220px">DESCRIPTION</th>
              <th style="width:100px">CREATED</th>
              <th></th>
          </tr>
        </thead>
          <tbody id="recent_requests">
            <?php 
            /*$recent_requests = file_get_contents( $pageURL."/controllers/remote/?method=getRequests&buid=".$_SESSION['user']['id']."&type=html" );
    
            if ($recent_requests !== false) {
               print $recent_requests;
            } else {
               print "Error loading requests data.";
            }*/
            
             // $_controller_remote_included = true;
             // 
             // require_once($_SERVER['DOCUMENT_ROOT']."/controllers/remote_controller.php");
             // 
             // controller_remote(  'getRequests', 
             //           'html', 
             //           null, 
             //           null, 
             //           $_SESSION['user']['id'], 
             //           $_controller_remote_included );
             // 
            ?>
            
          </tbody>
        </table>
      </div>
    <div class="moduleBottom"><!-- IE hates empty elements --></div>  
  </div>
</div>
</div>
<div class="rightCol">
  <div id="accountStatus" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
    <div class="moduleContent">
      <h3>Account Info</h3>
      <div class="more"><a href="/my-account">update</a></div>
      <hr />
      <div style="padding:10px">
        <p><strong>Quote Summary:</strong></p>
        <p>Accepted: <?= count($splitBids['accepted']) ?><br />
        Rejected: <?= count($splitBids['rejected']) ?><br />
        Waiting: <?= count($splitBids['waiting']) ?><br />
        Expired: <?= count($splitBids['expired']) ?></p>
        <p>&nbsp;</p>
<!--
        <p><strong>Alert Status:</strong></p>
        <p>Hourly</p>
-->
      </div>
    </div><div class="moduleBottom"><!-- IE hates empty elements --></div>
  </div>
  <?php
  /*
  <div id="latestNews" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
    <div class="moduleContent">
      <h3>Strategic News</h3>
      <hr />
      <p><strong>New Logistics Dashboard</strong><br />
      Strategic Scrap has improved your broker experience with the addition of the logistics dashboard.<br />
      <a href="#">More...</a></p>
    </div><div class="moduleBottom"><!-- IE hates empty elements --></div>
  </div>
  */
  ?>
  <div id="disclaimer" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
    <div class="moduleContent">
      <h3>Take Note</h3>
      <hr />
      <p><strong>Pickup/Delivery Times</strong><br />
      Pickup times are to be between 7am-3pm facilty timezone. Delivery times are specific to receiving facility and should be coordinated by the transportaion broker.</p>
      <p><strong>Operations</strong><br />
      Credit-checks are the responsibility of transporation brokers. Strategic Scrap is not responsible for breeched agreements.</p>
      <p><strong>Quote Manager</strong><br />
      Click on quotes for more details.<br />
      Contact information and additional notes live in these details.</p>
      <p><strong>Accepted Bids</strong><br />
      After the bid is accepted, it is the responsibility of the Transportation Broker to arrange final details.<br />
      Do not move loads without first contacting the Scrap Dealer.</p>
    </div><div class="moduleBottom"><!-- IE hates empty elements --></div>
  </div>
</div>
<div style="display:none">
  <div id="quoteForm" style="padding:20px; background:#fff;">
    <div id="bidForm">
      <h2>QUOTE THIS REQUEST</h2>
      <hr />
		<div style="float: left; margin: 3px 0; padding: 5px; background:#ccc;width:490px;font-size:11px;">
			<div style="width: 220px; float: left; margin: 3px;">
				<strong>Ship From:</strong><br>
				<div style="padding: 10px;" id="bid_request_ship_from">
					<!-- empty -->
				</div>
			</div>
			<div style="width: 220px; float: left; margin: 3px;">
				<strong>Ship To:</strong><br>
				<div style="padding: 10px;" id="bid_request_ship_to">
					<!-- empty -->
				</div>
			</div>
		</div>

		<div style="float: left; margin: 3px 0; padding: 5px; background:#ccc;width:490px;font-size:11px;">
			<strong>Material:</strong> <span id="bid_request_material">No. 1 Machinery Cast</span><br />
			<strong>Volume in Tons:</strong> <span id="bid_request_quantity">550</span><br />
			<strong>Ship on or before:</strong> <span id="bid_request_shipping_date">05/13/2010</span><br />
			<strong>Deliver on or before:</strong> <span id="bid_request_delivery_date">05/13/2010</span><br />
			<strong>Preferred Transporation:</strong> <span id="bid_request_preferred_transporation">Flat Bed</span><br />
			<strong>Special Instructions:</strong> <span id="bid_request_special_instructions">special instructions.</span>
		</div>

		<fieldset style="width:475px;  padding:10px; margin:5px 0;">
		
			<div style="color: #000;clear:both;margin:3px 0;display:block;height: 20px;">
				<div style="width:200px;float:left;font-weight: 900;">Transport Cost:</div>
				<label style="color:#000;float:left;font-weight:0;"><input type="text"  id="transport_cost" name="transport_cost" /></label></div>
	                                    
		
			<div style="color: #000;clear:both;margin:3px 0;display:block;height: 20px;">
				<div style="width:200px;float:left;font-weight: 900;">Price (per/GT):</div>
				<label style="color:#000;float:left;font-weight:0;"><input type="text"  id="material_price" name="material_price" /></label></div>
		
			<div style="color: #000;clear:both;margin:3px 0;display:block;height: 20px;">
				<div style="width:200px;float:left;font-weight: 900;">Ship Date:</div>
				<label style="color:#000;float:left;font-weight:0;"><input type="text"  id="ship_date" name="ship_date" class=date-pick /></label></div>
		
			<div style="color: #000;clear:both;margin:3px 0;display:block;height: 20px;">
				<div style="width:200px;float:left;font-weight: 900;">Arrival Date:</div>
				<label style="color:#000;float:left;font-weight:0;"><input type="text"  id="arrival_date" name="arrival_date" class="date-pick" /></label></div>
		
			<div style="color: #000;clear:both;margin:3px 0;display:block;height: 20px;">
				<div style="width:200px;float:left;font-weight: 900;">Additional Notes:</div>
				<label style="color:#000;float:left;font-weight:0;"><textarea id="notes" name="notes" style="width:200px;"></textarea></label></div>

		</fieldset>

        <input name="join_broker" id="join_broker" type="hidden" value="<?=$_SESSION['user']['id']?>" />
        <input name="join_transportation_type" id="join_transportation_type" type="hidden" value="" />
        <input name="join_request" id="join_request" type="hidden" value="" />

        <input name="join_scrapper" id="join_scrapper" type="hidden" value="" />
        <input name="join_facility" id="join_facility" type="hidden" value="" />
        <input name="join_material" id="join_material" type="hidden" value="" />
		
		<div class="submitButton" style="clear:both;" >
				<input type="image" id="submitQuote" alt="Submit Bid Request" name="submitQuote" src="/resources/images/buttons/submit_quote.png" />
		</div>
    </div>
    <div id="bidResult" style=""></div>
  </div>
	<div id="quoteDetails" style="padding:20px; background:#fff;">
      <h2>QUOTE DETAILS</h2>
      <hr />
		<div style="float: left; margin: 3px 0; padding: 5px; background:#ccc;width:490px;font-size:11px;">
			<div style="width: 220px; float: left; margin: 3px;">
				<strong>Ship From:</strong><br>
				<div style="padding: 10px;" id="bid_request_ship_from">
					<!-- empty -->
				</div>
			</div>
			<div style="width: 220px; float: left; margin: 3px;">
				<strong>Ship To:</strong><br>
				<div style="padding: 10px;" id="bid_request_ship_to">
					<!-- empty -->
				</div>
			</div>
		</div>

		<div style="float: left; margin: 3px 0; padding: 5px; background:#ccc;width:490px;font-size:11px;">
			<strong>Material:</strong> <span id="bid_request_material">No. 1 Machinery Cast</span><br />
			<strong>Volume in Tons:</strong> <span id="bid_request_quantity">550</span><br />
			<strong>Ship on or before:</strong> <span id="bid_request_ship_date">05/13/2010</span><br />
			<strong>Deliver on or before:</strong> <span id="bid_request_delivery_date">05/13/2010</span><br /><br />
			<strong>Preferred Transporation Type:</strong> <span id="bid_request_preferred_transporation">Flat Bed</span><br />
			<strong>Transporation Cost:</strong> <span id="bid_request_transporation_cost">$1000</span><br /><br />
			<strong>Instructions:</strong> <span id="bid_request_special_instructions">none</span><br />
			<strong>Broker Notes:</strong> <span id="bid_request_broker_notes">none</span><br /><br />
			<strong>Contact Name:</strong> <span id="bid_request_scrapper_name">name</span><br />
			<strong>Contact Phone:</strong> <span id="bid_request_scrapper_phone">phone</span><br />
		</div>

		<div style="clear:both"><!-- empty --></div>
	</div>
</div>
</div>

<script type="text/javascript">
	
	$('#submitQuote').hover(function(){ 
	       $(this).attr('src', '/resources/images/buttons/submit_quote_hover.png'); 
	}, function(){ 
	       $(this).attr('src', '/resources/images/buttons/submit_quote.png'); 
	});
	
var request_object;
var bid_object;

  var colorboxTimeOut = 0;
  
//http://demo.strategicscrap.com/controllers/remote/?method=addBid&transport_cost=123.00&material_price=3.00&ship_date=2011-12-03%2003:22:12&arrival_date=2011-12-23%2007:22:12&notes=This%20is%20a%20note&join_request=146&join_transportation_type=154&join_broker=93

	function reloadRequestsTable(){

        oTable.fnReloadAjax("/controllers/remote/?type=data_tables&method=getRequests&buid=<?= $_SESSION['user']['id']  ?>", function(json){        

          request_object = json.request_object[0];
          sw.recentRequestsrSlider = new sw.app.verticalSlider('#recentRequests', '.dataTables_scrollBody','#data_table_2',{overflow: "hidden", float: "left", width: "541px"}, {position: "relative"} );

          activateScrapQuote();
        });
	}

	function reloadQuotesTable(){

        qTable.fnReloadAjax("/controllers/remote/?type=data_tables&method=getBids&uid=<?= $_SESSION['user']['id']  ?>", function(json){
			
          bid_object = json.bid_object[0];
          sw.quoteManagerSlider = new sw.app.verticalSlider('#recentResponses', '.dataTables_scrollBody','#data_table_1',{overflow: "hidden", float: "left", width: "541px"}, {position: "relative"} );
          
        });
	}
  
  function activateScrapQuote(){
    $(".scrapQuote").colorbox({ width:"550", inline:true, href:"#quoteForm", 
        onClosed:function(){clearTimeout(colorboxTimeOut);}, 
      onComplete:function(){ current_request = $( this ).attr( "requestCount" ); loadBidForm(); $.colorbox.resize();  } 
    });
  }
  
  function activateQuoteDetails(){
    $(".quoteDetails").colorbox({ width:"550", inline:true, href:"#quoteDetails", 
        onClosed:function(){clearTimeout(colorboxTimeOut);}, 
      onComplete:function(){ current_bid = $( this ).attr( "bidCount" ); loadBidDetails(); $.colorbox.resize();  } 
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
  var qTable;  


    $(document).ready(function(){

    	// START code for request filter
    	
    	$(".filter input").change( function () {
    		/* Filter on the column (the index) of this element */
    		var status_filter = "empty";
    		var checked = $(".filter input:checked");
    		$.each(checked, function(key, item) {
    			if (key == 0) status_filter = "";
    			if (key + 1 == checked.length) {
    				status_filter += item.value; 
    			} else {
    				status_filter += item.value + "|"; 
    			}
    		});
//    		console.log(status_filter);
    		qTable.fnFilter( status_filter, 0, 1 );
    	} );
    	
    	// END code for request filter

      $("#reloadRequests").click(function(){
    	  reloadRequestsTable();
      
      });
      
      $("#reloadQuotes").click(function(json){
    	  reloadQuotesTable();
      
      });
      
      $.ajax( {
        "dataType": 'json', 
        "type": "GET", 
        "url": "/controllers/remote/?type=data_tables&method=getBids&uid=<?= $_SESSION['user']['id']  ?>", 
        "success": function (json) {
          bid_object = json.bid_object[0];
          qTable = $('#data_table_1').dataTable({
            "aaData": json.aaData,
            "sScrollY": "200px",
              "bPaginate": false,
              "bFilter": true,
              "bInfo": false ,
              "sDom": '<t>',
	          "aoColumns": [
	              {"sWidth": "80px"} ,
	              {"sWidth": "350px"},
	              {"sWidth": "120px"}
              ],
              "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
					$(nRow).addClass('quoteDetails');
					$(nRow).attr('bidId', $(aData[0]).attr("bidId") );
                    $(nRow).attr('bidCount', $(aData[0]).attr("bidCount") );
					return nRow;
                },
              "fnInitComplete": function() {
					activateQuoteDetails();
		          sw.quoteManagerSlider = new sw.app.verticalSlider('#recentResponses', '.dataTables_scrollBody','#data_table_1',{overflow: "hidden", float: "left", width: "541px"}, {position: "relative"} );
                }
            });
          }
        });
      
      $.ajax( {
        "dataType": 'json', 
        "type": "GET", 
        "url": "/controllers/remote/?type=data_tables&method=getRequests&buid=<?= $_SESSION['user']['id']  ?>", 
        "success": function (json) {
          request_object = json.request_object[0];
          //console.dir(request_object);
          oTable = $('#data_table_2').dataTable({
            "aaData": json.aaData,
            "sScrollY": "227px",
              "bPaginate": false,
              "bFilter": false,
              "bInfo": false ,
              "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    $(nRow).addClass('scrapQuote');
                    $(nRow).attr('requestId', $(aData[0]).attr("requestId") );
                    $(nRow).attr('id', $(aData[0]).attr("id") );
                    $(nRow).attr('requestCount', $(aData[0]).attr("requestCount") );
                  return nRow;
                },
              "fnInitComplete": function() {
                activateScrapQuote();
                sw.recentRequestsrSlider = new sw.app.verticalSlider('#recentRequests', '.dataTables_scrollBody','#data_table_2',{overflow: "hidden", float: "left", width: "541px"}, {position: "relative"} );
                }
            });
          }
        });

      $("#submitQuote").click(function() {

          // console.log("submitQuote");
    	    if ( $("#transport_cost").val() != "" && 
    	       $("#material_price").val() != "" && 
    	       $("#ship_date").val() != "" && 
    	       $("#arrival_date").val() != "" && 
    	       $("#join_scrapper").val() != "" && 
    	       $("#join_facility").val() != "" && 
    	       $("#join_material").val() != "" ) { 
    	       // $("#notes").val() != "" ) {

    	        $.post("/controllers/remote/?method=addBid", 
    	            {transport_cost : $("#transport_cost").val(),
    	             material_price : $("#material_price").val(),
    	             ship_date : $("#ship_date").val(),
    	             arrival_date : $("#arrival_date").val(),
    	             join_broker : $("#join_broker").val(),
    	             join_transportation_type : $("#join_transportation_type").val(),
    	             join_request : $("#join_request").val(),
    	             join_scrapper : $("#join_scrapper").val(),
    	             join_facility : $("#join_facility").val(),
    	             join_material : $("#join_material").val(),
    	             notes : $("#notes").val()
    	            },
					function(data){
						// console.log('i am back!');
						$("#transport_cost").val(''); 
						$("#material_price").val(''); 
						$("#ship_date").val(''); 
						$("#arrival_date").val(''); 
						$("#notes").val('');
						$("#join_scrapper").val('');
						$("#join_facility").val('');
						$("#join_material").val('');

						$("#bidForm").hide();
						$("#bidResult").html('<h2>Success!</h2><p>Your bid has been submitted.</p>').show();
						$(".scrapQuote").colorbox.resize();
						
						reloadQuotesTable();
						reloadRequestsTable();

						colorboxTimeOut = setTimeout( function(){ clearTimeout(colorboxTimeOut); $(".scrapQuote").colorbox.close(); }, 5000 );
    	           });
    	         
    	        return false;
    	    }
    	    
    	    return false;
    	  });
      });
      
    //$(".scrapQuote").colorbox({width:"550", inline:true, href:"#quoteForm"});

		$(function() {
		  				
			$('.date-pick')
			.datePicker({createButton:false})
			.bind(
				'focus',
				function(event, message)
				{
					if (message == $.dpConst.DP_INTERNAL_FOCUS) {
						return true;
					}
					var dp = this;
					var $dp = $(this);
					$dp.dpDisplay();
					$('*').bind(
						'focus.datePicker',
						function(event)
						{
							var $focused = $(this);
							if (!$focused.is('.dp-applied')) // don't close the focused date picker if we just opened a new one!
							{
								// if the newly focused element isn't inside the date picker and isn't the original element which triggered
								// the opening of the date picker

								if ($focused.parents('#dp-popup').length == 0 && this != dp && !($.browser.msie && this == document.body)) {
									$('*').unbind('focus.datePicker');
									$dp.dpClose();
								}
							}
						}
					);
					return false;
				}
			);

			
			$('#ship_date').bind(
				'dpClosed',
				function(e, selectedDates)
				{
					var d = selectedDates[0];
					if (d) {
						d = new Date(d);
						$('#arrival_date').dpSetStartDate(d.addDays(0).asString());
					}
					$('*').unbind('focus.datePicker');
				}
			);
			
			$('#arrival_date').bind(
				'dpClosed',
				function(e, selectedDates)
				{
					var d = selectedDates[0];
					if (d) {
						d = new Date(d);
						$('#ship_date').dpSetEndDate(d.addDays(-1).asString());
					}
					$('*').unbind('focus.datePicker');
				}
			);
			
		});
</script>