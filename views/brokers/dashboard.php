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
        
        
        var scrapperData = "", facilityData = "";
          
        if( item['join_scrapper'] && item['join_scrapper'][0] ){ 
          $("#join_scrapper").val( item['join_scrapper'][0]['id'] );
        } 

        if( item['join_scrapper'] && item['join_scrapper'][0]['company'] ){ 
            scrapperData += item['join_scrapper'][0]['company'] + '<br />';
        } 
        
        if( item['join_scrapper'] && item['join_scrapper'][0]['address_1'] ){ 
            scrapperData += item['join_scrapper'][0]['address_1'] + '<br />';
        } 
        
        if( item['join_scrapper'] && item['join_scrapper'][0]['address_2'] ){ 
            scrapperData += item['join_scrapper'][0]['address_2'] + '<br />';
        } 
        
        if( item['join_scrapper'] && item['join_scrapper'][0]['city'] ){ 
            scrapperData += item['join_scrapper'][0]['city'] + ', ';
        } 
        
        if( item['join_scrapper'] && item['join_scrapper'][0]['state_province'] ){ 
            scrapperData += item['join_scrapper'][0]['state_province'] + ' ';
        } 
        
        if( item['join_scrapper'] && item['join_scrapper'][0]['zip_postal_code'] ){ 
            scrapperData += item['join_scrapper'][0]['zip_postal_code'] + ' ';
        } 

        if( scrapperData.length > 0 ){
          $("#bid_request_ship_from").html( scrapperData );
        } else {
          alert("This bid cannot happen because there is no Scrapper.");
        }


        if( item['id'] ) 
          $("#join_request").val(item['id']);
        

        if( item['join_facility'] && item['join_facility'][0] ) 
          $("#join_facility").val( item['join_facility'][0]['id'] );
        

        if( item['join_facility'] && item['join_facility'][0]['company'] )
          facilityData += item['join_facility'][0]['company'] + '<br />';
        
        
        if( item['join_facility'] && item['join_facility'][0]['address_1'] )
          facilityData += item['join_facility'][0]['address_1'] + '<br />';
        
        
        if( item['join_facility'] && item['join_facility'][0]['address_2'] )
          facilityData += item['join_facility'][0]['address_2'] + '<br />';
        
        
        if( item['join_facility'] && item['join_facility'][0]['city'] )
          facilityData += item['join_facility'][0]['city'] + ', ';
        
        
        if( item['join_facility'] && item['join_facility'][0]['state_province'] )
          facilityData += item['join_facility'][0]['state_province'] + ' ';
        
        
        if( item['join_facility'] && item['join_facility'][0]['zip_postal_code'] )
          facilityData += item['join_facility'][0]['zip_postal_code'] + ' ';
        

        if( facilityData.length > 0 ){
          $("#bid_request_ship_to").html( facilityData );
        } else {
          alert("This bid cannot happen because there is no Facility.");
        }

        if( item['join_material'] && item['join_material'][0] ){
          $("#bid_request_material").html( item['join_material'][0]['name'] );
          $("#join_material").val( item['join_material'][0]['id'] );
        } else {
          alert("This bid cannot happen because there is no Material.");
        }


        $("#bid_request_quantity").html( item['volume'] );
        $("#bid_request_delivery_date").html( item['arrive_date'] );
        $("#bid_request_preferred_transporation").html( item['transportation_type'] );
        
      }
      
      $(document).ready(function(){
        $("#bidResult").hide();
        //getRequests();
        //getBids();
          $(".scrapQuote").colorbox({ width:"550", inline:true, href:"#quoteForm", 
            onComplete:function(){ current_request = $( this ).attr( "requestCount" ); loadBidForm(); $.colorbox.resize();  } 
          });
          
      });
    --></script>

<div class="brokerDashboard">
<div class="leftCol">
<div class="lowerArea">
  <div class="twoColMod" id="recentResponses">
    <div class="moduleTop"><!-- IE hates empty elements --></div>
    <div class="moduleContent clearfix">
    <? if ($use_ui == "true"){ ?>
    
    <style type="text/css">
      #scroll-pane { float:left;overflow: auto; width: 535px; height:300px;position:relative;border:1px solid gray;margin-left:0;margin-bottom:0;display:inline}
      #scroll-content {position:absolute;top:0;left:0}
      .scroll-content-item {background-color:#fcfcfc;color:#003366;width:100px;height:100px;float:left;margin:10px;font-size:3em;line-height:96px;text-align:center;border:1px solid gray;display:inline;}
      #slider-wrap{float:right;background-color:#ccc;width:16px;border:none;}
      #slider-vertical{position:relative;height:100%; width: 16px;}
      .ui-slider-handle{width:16px;height:10px;margin:0 auto;background-color:#0d0d0d;display:block;position:absolute}


    </style>
      
        <h3>QUOTE MANAGER - using UI</h3>
        <div class="more"><a href="[~27~]">advanced</a></div>
        <hr />
        <div class="filter">
          <div><input type="checkbox" name="filter_accepted" checked="checked" value="accepted" /> accepted</div>
          <div><input type="checkbox" name="filter_expired" checked="checked" value="expired" /> expired</div>
          <div><input type="checkbox" name="filter_rejected" checked="checked" value="rejected" /> rejected</div>
          <div><input type="checkbox" name="filter_waiting" checked="checked" value="waiting" /> waiting</div>
          <div style="clear:both;float:none"><!-- IE hates empty elemenets --></div>
        </div>
        <table id="data_table_1">
          <thead>
            <tr class="row2">
                <th style="width:100px">STATUS</th>
                <th style="width:220px">DESCRIPTION</th>
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
            
            $_controller_remote_included = true;
            
            require_once($_SERVER['DOCUMENT_ROOT']."/controllers/remote_controller.php");
            
            controller_remote(  'getBids', 
                      'html', 
                      null, 
                      $_SESSION['user']['id'], 
                      null, 
                      $_controller_remote_included );
            
            ?>
          </tbody>
              </table>
    <? } else {?>

        <h3>QUOTE MANAGER</h3>
      <div class="more"><a href="[~27~]">advanced</a></div>
      <hr />
      <div class="filter">
        <div><input type="checkbox" name="filter_accepted" checked="checked" value="accepted" /> accepted</div>
        <div><input type="checkbox" name="filter_expired" checked="checked" value="expired" /> expired</div>
        <div><input type="checkbox" name="filter_rejected" checked="checked" value="rejected" /> rejected</div>
        <div><input type="checkbox" name="filter_waiting" checked="checked" value="waiting" /> waiting</div>
        <div style="clear:both;float:none"><!-- IE hates empty elemenets --></div>
      </div>
      <table>
        <tbody>
          <tr class="row2">
              <th style="width:100px">STATUS</th>
              <th style="width:220px">DESCRIPTION</th>
              <th style="width:100px">QUOTE DATE</th>
              <th>&nbsp;</th>
          </tr>
        </tbody>
      </table>
      <div id="scroll-pane1" class="jScrollPaneContainer" tabindex="0">
        <table class="stripes">
          <tbody id="recent_bids">
            <?php 
     /*
            $recent_bids = file_get_contents($pageURL."/controllers/remote/?method=getBids&uid=".$_SESSION['user']['id'] ."&type=html");
                    
            if ($recent_bids !== false) {
               print $recent_bids;
            } else {
               print "Error loading bid data.";
            }*/
            
            $_controller_remote_included = true;
            
            require_once($_SERVER['DOCUMENT_ROOT']."/controllers/remote_controller.php");
            
            controller_remote(  'getBids', 
                      'html', 
                      null, 
                      $_SESSION['user']['id'], 
                      null, 
                      $_controller_remote_included );
            
            ?>
          </tbody>
        </table>
      </div>
    <?} //end use_ui ?>
    </div>
    <div class="moduleBottom"><!-- IE hates empty elements --></div>  
  </div>
  <div class="twoColMod" id="recentRequests">
    <div class="moduleTop"><!-- IE hates empty elements --></div>
    <div class="moduleContent">
        <h3>Recent Requests</h3>
      <div class="more"><a href="[~22~]">advanced</a></div>
      <hr />
      <table>
        <tbody>
          <tr class="row2"  >
              <th style="width:100px">EXPIRATION DATE</th>
              <th style="width:220px">DESCRIPTION</th>
              <th style="width:100px">REQUEST DATE</th>
          </tr>
        </tbody>
      </table>
      <div id="scroll-pane2" class="jScrollPaneContainer" tabindex="0">
        <table class="stripes">
          <tbody id="recent_requests">
            <?php 
            /*$recent_requests = file_get_contents( $pageURL."/controllers/remote/?method=getRequests&buid=".$_SESSION['user']['id']."&type=html" );
    
            if ($recent_requests !== false) {
               print $recent_requests;
            } else {
               print "Error loading requests data.";
            }*/
            
            $_controller_remote_included = true;
            
            require_once($_SERVER['DOCUMENT_ROOT']."/controllers/remote_controller.php");
            
            controller_remote(  'getRequests', 
                      'html', 
                      null, 
                      null, 
                      $_SESSION['user']['id'], 
                      $_controller_remote_included );
            
            ?>
            
          </tbody>
        </table>
      </div>
    </div>
    <div class="moduleBottom"><!-- IE hates empty elements --></div>  
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
        <p>Accepted: 1<br />
        Rejected: 1<br />
        Waiting: 4<br />
        Expired: 2</p>
        <p>&nbsp;</p>
        <p><strong>Alert Status:</strong></p>
        <p>Hourly</p>
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
      All loads must be delivered within 3 days of deliver date unless noted otherwise.</p>
      <p><strong>Pickup/Delivery Times</strong><br />
      Pickup times are to be between 7am-3pm facilty timezone. Delivery times are specific to receiving facility and should be coordinated by the transportaion broker.</p>
      <p><strong>Opperations</strong><br />
      Credit-checks are the responsibility of transporation brokers. Strategic Scrap is not responsible for breeched agreements.</p>
    </div><div class="moduleBottom"><!-- IE hates empty elements --></div>
  </div>
</div>
<div style="display:none">
  <div id="quoteForm" style="padding:20px; background:#fff;">
    <div id="bidForm">
      <h2>QUOTE THIS REQUEST</h2>
      <hr />
      <strong>Ship from:</strong> <span id="bid_request_ship_from">Demo Scrap, 123 N 1st, City, State Zip</span> <br />
      <strong>Ship to:</strong> <span id="bid_request_ship_to">Demo Scrap, 123 N 1st, City, State Zip</span><br />
      <strong>Material:</strong> <span id="bid_request_material">No. 1 Machinery Cast</span><br />
      <strong>Volume (tons):</strong> <span id="bid_request_quantity">550</span><br />
      <strong>Delivery Date:</strong> <span id="bid_request_delivery_date">05/13/2010</span><br />
      <strong>Preferred Transporation:</strong> <span id="bid_request_preferred_transporation">Flat Bed</span>
      <hr />
      <form id="quoteForm">
        <input name="join_broker" id="join_broker" type="hidden" value="<?=$_SESSION['user']['id']?>" />
        <input name="join_transportation_type" id="join_transportation_type" type="hidden" value="" />
        <input name="join_request" id="join_request" type="hidden" value="" />
        
        <input name="join_scrapper" id="join_scrapper" type="hidden" value="" />
        <input name="join_facility" id="join_facility" type="hidden" value="" />
        <input name="join_material" id="join_material" type="hidden" value="" />
          
        <ul class="form">
          <li>
            <label><strong>Transport Cost:</strong></label>
            <input name="transport_cost" id="transport_cost" type="text" />
          </li>
          <li>
            <label><strong>Price (per/GT):</strong></label>
            <input name="material_price" id="material_price" type="text" />
          </li>
          <li>
            <label><strong>Ship Date:</strong></label>
            <input name="ship_date" id="ship_date" type="text" />
          </li>
          <li>
            <label><strong>Arrival Date:</strong></label>
            <input name="arrival_date" id="arrival_date" type="text" />
          </li>
          <li>
            <label><strong>Additional Notes:</strong></label>
            <textarea name="notes" id="notes" style="width:273px; height:40px;"></textarea>
          </li>
        </ul>
        <div class="submitButton" id="submitQuote" style="cursor: pointer; text-align:left; background: #fff url(resources/images/buttons/submit_quote.png) no-repeat; padding: 3px; width:177px; height: 46px;"><!--  --></div>
      </form>
    </div>
    <div id="bidResult" style=""></div>
  </div>
</div>
</div>
<script type="text/javascript">

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
            getBids();
           colorboxTimeOut = setTimeout( function(){ clearTimeout(colorboxTimeOut); $(".scrapQuote").colorbox.close(); }, 5000 );
           }, "json");
         
        return false;
    }
    
    return false;
  });

  <? if($use_ui == "true"){ ?> 
  
  function verticalSlider(pane, content){
  $(function() {
    //change the main div to overflow-hidden as we can use the slider now
    $(pane).css({overflow: 'hidden',
                                      float: 'left',
                                      width: '541px'});
    $(content).css('position', 'relative');
    
    //calculate the height that the scrollbar handle should be
    var difference = $(content).height()-$(pane).height();//eg it's 200px longer 
    
    if(difference>0)//if the scrollbar is needed, set it up...
    {
       var proportion = difference / $(content).height();//eg 200px/500px
       var handleHeight = Math.round((1-proportion)*$(pane).height());//set the proportional height - round it to make sure everything adds up correctly later on
       handleHeight -= handleHeight%2; //ensure the handle height is exactly divisible by two
    
       $(pane).after('<\div id="slider-wrap"><\div id="slider-vertical"><\/div><\/div>');//append the necessary divs so they're only there if needed
       $("#slider-wrap").height($(pane).height());//set the height of the slider bar to that of the scroll pane
    
    
       //set up the slider 
       $('#slider-vertical').slider({
          orientation: 'vertical',
          range: 'max',
          min: 0,
          max: 100,
          value: 100,
          slide: function(event, ui) {
             var topValue = -((100-ui.value)*difference/100);
             $(content).css({top:topValue});//move the top up (negative value) by the percentage the slider has been moved times the difference in height
          }
       });
    
       //set the handle height and bottom margin so the middle of the handle is in line with the slider
       $(".ui-slider-handle").css({height:handleHeight,'margin-bottom':-0.5*handleHeight});
      
       var origSliderHeight = $("#slider-vertical").height();//read the original slider height
       var sliderHeight = origSliderHeight - handleHeight ;//the height through which the handle can move needs to be the original height minus the handle height
       var sliderMargin =  (origSliderHeight - sliderHeight)*0.5;//so the slider needs to have both top and bottom margins equal to half the difference
       $(".ui-slider").css({height:sliderHeight,'margin-top':sliderMargin});//set the slider height and margins
    }//end if
    });
  
  }
  
      $(document).ready(function(){   
        $('#data_table_1').dataTable( {
          "sScrollY": "200px",
          "bPaginate": false,
          "bFilter": false,
          "bInfo": false

        } );
        
   
        verticalSlider('.dataTables_scrollBody','#data_table_1');
        });
      
  <?}?>
    $(".scrapQuote").colorbox({width:"550", inline:true, href:"#quoteForm"});

</script>

