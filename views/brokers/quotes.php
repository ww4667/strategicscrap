
    <style type="text/css">
    .dataTables_scroll{background: #ebebeb;}
    </style>

<div class="brokerDashboard">
<div class="leftCol">
<div class="lowerArea">
	<div class="twoColMod" id="recentResponses"><div class="moduleTop"><!-- IE hates empty elements --></div>
		<div class="moduleContent clearfix">
	    	<h3 id = "reloadQuotes">ADVANCED QUOTE MANAGER</h3>
			<div class="more"><a href="[~21~]">back to dashboard</a></div>
			<hr />
			<!-- <div class="filter">
				<div style="float:right">search results: 50 matches</div>
				<div id="filter1" class="cloned">
	                <select name="filter[0][field]">
	                    <option value="">Select Search Item</option>
	                    <option value="status">Status</option>
	                    <option value="ship_to">Ship To</option>
	                    <option value="material">Material</option>
	                    <option value="delivery_date">Delivery Date</option>
	                    <option value="quote_date">Quote Date</option>
	                </select>
					<input type="text" name="filter[0][value]" />
				</div>
				<div>
				<a class="add btnAdd" href="#" title="add another filter" style="display:inline-block;margin-top:7px;margin-bottom:-7px">add</a>
				<a class="minus btnRemove" href="#" title="remove filter" style="display:none;margin-top:7px;margin-bottom:-7px">remove</a>
				</div>
				<div style="clear:both;float:none"><!-- IE hates empty elemenets -- ></div>
			</div> -->
			<table id="data_table_1" class="quotes stripes" style ="width: 559px;">
			<thead><tr class="">
			    <th style="width:124px">STATUS</th>
			    <th style="width:191px">DESCRIPTION</th>
			    <th style="width:183px">QUOTE DATE</th>
			</tr>
			</thead>
			<tbody>
            <?php 
            /*
            $recent_bids = file_get_contents($pageURL."/controllers/remote/?metdod=getBids&uid=".$_SESSION['user']['id'] ."&type=html");
                    
            if ($recent_bids !== false) {
               print $recent_bids;
            } else {
               print "Error loading bid data.";
            }
            
            $_controller_remote_included = true;
            
            require_once($_SERVER['DOCUMENT_ROOT']."/controllers/remote_controller.php");
            
            controller_remote(  'getBids', 
                      'html', 
                      null, 
                      $_SESSION['user']['id'], 
                      null, 
                      $_controller_remote_included );
            */
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
			All loads must be delivered within 3 days of deliver date unless noted otherwise</p>
			<p><strong>Pickup/Delivery Times</strong><br />
			Pickup times are to be between 7am-3pm facilty timezone. Delivery times are specific to receiving facility and should be coordinated by the transportaion broker.</p>
			<p><strong>Opperations</strong><br />
			Credit-checks are the responsibility of transporation brokers. Strategic Scrap is not responsible for breeched agreements.</p>
		</div><div class="moduleBottom"><!-- IE hates empty elements --></div>
	</div>
</div>
</div>
<script type="text/javascript">


  
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
  
  var qTable;
	$(document).ready(function() {
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
		
      $("#reloadQuotes").click(function(){
      
          qTable.fnReloadAjax("/controllers/remote/?type=data_tables&method=getBids&uid=<?= $_SESSION['user']['id']  ?>", function(){
          
          //console.log("reloading quotes");
          sw.quoteManagerSlider = new sw.app.verticalSlider('#recentResponses', '.dataTables_scrollBody','#data_table_1',{overflow: "hidden", float: "left", width: "541px"}, {position: "relative"} );
          //console.log("after slider");
        });
      
      });
      
      qTable = $('#data_table_1').dataTable( {
        "sScrollY": "527px",
        "bPaginate": false,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": false,
        "aoColumns": [
                      {"sWidth": "124px"} ,
                      {"sWidth": "191px"},
                      {"sWidth": "183px"}
                      ],
        "aaSorting": [ [0,'asc'] ],
        "fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
          $("#data_tables_info").remove();
          var info = "<span id='data_tables_info' style='float: right; margin-right: 10px;'>Found " + iEnd +" of "+ iMax + "</span>";
          $("#data_table_1_filter").append(info); 
          },
        "sAjaxSource": "/controllers/remote/?type=data_tables&method=getBids&uid=<?= $_SESSION['user']['id']  ?>",
        "fnInitComplete": function() {
        $(".dataTables_scrollHead").css({width: "559px"});
          sw.quoteManagerSlider = new sw.app.verticalSlider('#recentResponses', '.dataTables_scrollBody','#data_table_1',{overflow: "hidden", float: "left", width: "541px"}, {position: "relative"} );
 
        }
      }); 
      qTable.fnSort( [ [2,'asc'] ]);
     
	});
</script>
