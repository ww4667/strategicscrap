
    <style type="text/css">
    .dataTables_scroll{background: #ebebeb;}
    </style>

  <div class="brokerDashboard">
<div class="leftCol">
<div class="lowerArea">
	<div class="twoColMod" id="recentRequests"><div class="moduleTop"><!-- IE hates empty elements --></div>
		<div class="moduleContent clearfix">
	    	<h3 id="reloadRequests">ADVANCED REQUEST MANAGER</h3>
			<div class="more"><a href="[~21~]">back to dashboard</a></div>
			<hr />
			<!-- 
			<div class="filter">
				<div style="float:right">search results: 50 matches</div>
				<div id="filter1" class="cloned">
	                <select name="filter[0][field]">
	                    <option value="">Select Search Item</option>
	                    <option value="request_id">Request ID</option>
	                    <option value="ship_to">Ship To</option>
	                    <option value="material">Material</option>
	                    <option value="delivery_date">Delivery Date</option>
	                    <option value="request_date">Request Date</option>
	                </select>
					<input type="text" name="filter[0][value]" />
				</div>
				<div>
				<a class="add btnAdd" href="#" title="add another filter" style="display:inline-block;margin-top:7px;margin-bottom:-7px">add</a>
				<a class="minus btnRemove" href="#" title="remove filter" style="display:none;margin-top:7px;margin-bottom:-7px">remove</a>
				</div>
				<div style="clear:both;float:none"><!-- IE hates empty elemenets -- ></div>
			</div> -->
			<table id ="data_table_1" class="stripes" style="width: 559px">
			<thead>
			<tr class=""	>
			    <th style="width:100px">EXPIRATION</th>
			    <th style="width:220px">DESCRIPTION</th>
			    <th style="width:100px">REQUEST DATE</th>
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
            
            //require_once($_SERVER['DOCUMENT_ROOT']."/controllers/remote_controller.php");
            
          //  controller_remote(  'getRequests', 
            //          'html', 
              //        null, 
                //      null, 
                  //    $_SESSION['user']['id'], 
                    //  $_controller_remote_included );
            
            ?>
		</tbody></table>
		</div><div class="moduleBottom"><!-- IE hates empty elements --></div>	
	</div>
</div>
</div>
<div class="rightCol">
	<div id="accountStatus" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
		<div class="moduleContent">
			<h3>Account Info</h3>
			<div class="more"><a href="#">update</a></div>
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
	<div id="latestNews" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
		<div class="moduleContent">
			<h3>Strategic News</h3>
			<hr />
			<p><strong>New Logistics Dashboard</strong><br />
			Strategic Scrap has improved your broker experience with the addition of the logistics dashboard.<br />
			<a href="#">More...</a></p>
		</div><div class="moduleBottom"><!-- IE hates empty elements --></div>
	</div>
	<div id="disclaimer" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
		<div class="moduleContent">
			<h3>Disclaimer and Assumptions</h3>
			<hr />
			<p><strong>Delivery Date</strong><br />
			All loads must be delivered within 3 days of deliver date unless noted otherwise</p>
			<p><strong>Pickup/Delivery Times</strong><br />
			Pickup times are to be between 7am-3pm facilty timezone. Delivery times are specific to receiving facility and should be coordinated by the transportaion broker.</p>
			<p><strong>Operations</strong><br />
			Credit-checks are the responsibility of transporation brokers. Strategic Scrap is not responsible for breeched agreements.</p>
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
			<strong>Shipping Date:</strong> <span id="bid_request_shipping_date">05/13/2010</span><br />
			<strong>Delivery Date:</strong> <span id="bid_request_delivery_date">05/13/2010</span><br />
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
				<input type="image" id="submitQuote" alt="Submit Bid Request" name="submitBid" src="resources/images/buttons/submit_quote.png" />
		</div>
    </div>
    <div id="bidResult" style=""></div>
  </div>
</div>

</div>

<script type="text/javascript">


  function activateScrapQuote(){
    $(".scrapQuote").colorbox({ width:"550", inline:true, href:"#quoteForm", 
      onComplete:function(){ current_request = $( this ).attr( "requestCount" ); loadBidForm(); $.colorbox.resize();  } 
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
      request_object = json.request_object[0];
      //console.log("table refreshed");
      /* Got the data - add it to the table */
      for ( var i=0 ; i<json.aaData.length ; i++ ){
        that.oApi._fnAddData( oSettings, json.aaData[i] );
      }
      oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
      that.fnDraw( that );
      that.oApi._fnProcessingDisplay( oSettings, false );
      
      activateScrapQuote();
      sw.recentRequestsrSlider = new sw.app.verticalSlider('#recentRequests', '.dataTables_scrollBody','#data_table_2',{overflow: "hidden", float: "left", width: "541px"}, {position: "relative"} );
               
      /* Callback user function - for event handlers etc */
      if ( typeof fnCallback == 'function' ){
        fnCallback( oSettings );
      }
    });
  }

  var oTable;  
  $(document).ready(function() {  
      
      $("#reloadRequests").click(function(){
      
        oTable.fnReloadAjax("/controllers/remote/?type=data_tables&method=getRequests&buid=<?= $_SESSION['user']['id']  ?>");
      
      });

      
      $.ajax( {
        "dataType": 'json', 
        "type": "GET", 
        "url": "/controllers/remote/?type=data_tables&method=getRequests&buid=<?= $_SESSION['user']['id']  ?>", 
        "success": function (json) {
          request_object = json.request_object[0];
          // console.dir(request_object);
          oTable = $('#data_table_1').dataTable({
            "aaData": json.aaData,
            "sScrollY": "527px",
              "bPaginate": false,
              "bFilter": false,
              "bInfo": false ,
              "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    $(nRow).addClass('scrapQuote');
                    $(nRow).attr('requestId', $(aData[0]).attr("requestId") );
                    $(nRow).attr('id', "request_" + iDisplayIndex );
                    $(nRow).attr('requestCount', iDisplayIndex );
                  return nRow;
                },
              "fnInitComplete": function() {
                activateScrapQuote();
        $(".dataTables_scrollHead").css({width: "559px"});
                sw.recentRequestsrSlider = new sw.app.verticalSlider('#recentRequests', '.dataTables_scrollBody','#data_table_1',{overflow: "hidden", float: "left", width: "541px"}, {position: "relative"} );
                }
            });
          }
        });  
        
		$('.btnAdd').click(function() {
			var num		= $('.cloned').length;	// how many "duplicatable" input fields we currently have
			var newNum	= new Number(num + 1);		// the numeric ID of the new input field being added
			var newElem = $('#filter' + num).clone().attr('id', 'filter' + newNum);

			$('#filter' + num).after(newElem);
 
			$('#filter' + newNum).find('select').attr('name', 'filter[' + num + '][field]')
			.parent().find('input').attr('name', 'filter[' + num + '][value]').val('');

			$('#filter' + newNum).find('select').focus();
			$('.filter').find('a.minus').css("display","inline-block");
			return false;
		});
		$('.btnRemove').click(function() {
			var num		= $('.cloned').length;	// how many "duplicatable" input fields we currently have

			$('#filter' + num).remove(); 

			$('#filter' + num-1).find('select').focus();
			if(num-1==1)$('.filter').find('a.minus').hide();
			return false;
		});
        $(".scrapQuote").colorbox({width:"550", inline:true, href:"#quoteForm"});
    
        //broker_page_setup();
	});

	function broker_page_setup(){
	    
        oTable.fnReloadAjax("/controllers/remote/?type=data_tables&method=getRequests&buid=<?= $_SESSION['user']['id']  ?>");
	}

  var colorboxTimeOut = 0;
//http://demo.strategicscrap.com/controllers/remote/?method=addBid&transport_cost=123.00&material_price=3.00&ship_date=2011-12-03%2003:22:12&arrival_date=2011-12-23%2007:22:12&notes=This%20is%20a%20note&join_request=146&join_transportation_type=154&join_broker=93
  $("#submitQuote").click(function() {
    if ( $("#transport_cost").val() != "" && 
       $("#material_price").val() != "" && 
       $("#ship_date").val() != "" && 
       $("#arrival_date").val() != "" && 
       $("#join_scrapper").val() != "" && 
       $("#join_facility").val() != "" && 
       $("#join_material").val() != "" && 
       $("#notes").val() != "" ) {

        $.post("/controllers/remote/?method=addBid", 
            'transport_cost=' + $("#transport_cost").val() +
            '&material_price=' + $("#material_price").val() +
            '&ship_date=' + $("#ship_date").val() +
            '&arrival_date=' + $("#arrival_date").val() +
            '&join_broker=' + $("#join_broker").val() +
            '&join_transportation_type=' + $("#join_transportation_type").val() +
            '&join_request=' + $("#join_request").val() +
            
            '&join_scrapper=' + $("#join_scrapper").val() +
            '&join_facility=' + $("#join_facility").val() +
            '&join_material=' + $("#join_material").val() +

            '&notes=' + $("#notes").val(),
           function(data){
             $("#transport_cost").val(''); 
           $("#material_price").val(''); 
           $("#ship_date").val(''); 
           $("#arrival_date").val(''); 
           $("#notes").val('');
           $("#join_scrapper").val('');
           $("#join_facility").val('');
           $("#join_material").val('');

           //
           $("#bidForm").hide();
           $("#bidResult").html('<h2>Success!</h2><p>Your bid has been submitted.</p>').show();
           $(".scrapQuote").colorbox.resize();

            getRequests();
           colorboxTimeOut = setTimeout( function(){ clearTimeout(colorboxTimeOut); $(".scrapQuote").colorbox.close(); }, 5000 );
           }, "json");
         
        return false;
    }
    
    return false;
  });
  
    $(".scrapQuote").colorbox({width:"550", inline:true, href:"#quoteForm"});


      var requestInterval = 0, bidInterval = 0, reqObject = {}, current_request = -1, iii = 0;
    
     /* function getRequests(){

          $('#recent_requests').load("/controllers/remote/?method=getRequests&buid=<?=$_SESSION['user']['id'] ?>&type=html", function() {
            // alert('Load was performed.');
            //broker_page_setup();
              //$(".scrapQuote").colorbox({ width:"550", inline:true, href:"#quoteForm", 
               // onComplete:function(){ current_request = $( this ).attr( "requestCount" ); loadBidForm(); $.colorbox.resize();  } 
             // });
         // });
        //requestInterval = setTimeout("getRequests",20000);
      //}
*/

	function loadBidForm(  ){
	
	    $("#bidForm").show();
	    $("#bidResult").hide();
	   var item = request_object[ current_request ]; 
	   
	   var scrapperData = "", facilityData = "";
	   var sItem = item['request_snapshot']['scrapper'];
	   var fItem = item['request_snapshot']['facility'];
	   var mItem = item['request_snapshot']['material'];
	   var rItem = item['request_snapshot']['request'];
			var fromItem =  (item['request_snapshot']['from']) ? item['request_snapshot']['from'] : null ;
	     
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
	     facilityData += fItem['company'] + '<br />';
	   
	   
	   if( fItem && fItem['address_1'] )
	     facilityData += fItem['address_1'] + '<br />';
	   
	   
	   if( fItem && fItem['address_2'] )
	     facilityData += fItem['address_2'] + '<br />';
	   
	   
	   if( fItem && fItem['city'] )
	     facilityData += fItem['city'] + ', ';
	   
	   
	   if( fItem && fItem['state_province'] )
	     facilityData += fItem['state_province'] + ' ';
	   
	   
	   if( fItem && fItem['zip_postal_code'] )
	     facilityData += fItem['zip_postal_code'] + ' ';
	   
	
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
	
	
	   $("#bid_request_quantity").html( item['volume'] );
	   $("#bid_request_shipping_date").html( item['ship_date'] );
	   $("#bid_request_delivery_date").html( item['arrive_date'] );
	   $("#bid_request_preferred_transporation").html( item['transportation_type'] );
	   $("#bid_request_special_instructions").html( item['special_instructions'] );
	   
	 }
      
      $(document).ready(function(){
        $("#bidResult").hide();
        //getRequests();
        //getBids();
          $(".scrapQuote").colorbox({ width:"550", inline:true, href:"#quoteForm", 
            onComplete:function(){ current_request = $( this ).attr( "requestCount" ); loadBidForm(); $.colorbox.resize();  } 
          });
          
      });

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