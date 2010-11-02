<style type="text/css">
h3{color: #ff6600}
.fullCol{width:833px}
.fullCol .oneColMod{width:833px}
.fullCol .moduleTop, .fullCol .moduleBottom{width:833px;height:6px}
.fullCol .moduleTop{background:url(/resources/images/bg/module_full_top.png)}
.fullCol .moduleBottom{background:url(/resources/images/bg/module_full_bottom.png)}
.fullCol #scroll-pane1,
.fullCol #scroll-pane2{width:831px;height:500px}
.fullCol #tabs-scrapClass .first{margin-left:20px}
a.quote{width:22px;height:22px;display:block;background:url(/resources/images/buttons/dashboard_action.png) 66px 0px;text-indent:-5000px}
a.quote:hover{background-position: 66px -22px;}
tr.details div{display:none;padding:5px 80px}
tr.details td{padding:0}
.fullCol .moduleContent td:first-child{font-weight:normal;}
#map_container{width:auto; height: 480px; margin:10px}
#geo_progress{background-color:#ff6600;}
</style>

<script type="text/javascript">
	$(document).ready(function() {
            $('#scrapExchangeListings').tabs();
            $('#scroll-pane1').jScrollPane();
            // $(".scrapDesc1").colorbox({width:"550", inline:true, href:"#listingDescription1"});
			$('a.quote').click(function(){
				$(this).parent().parent().next('tr').find('div').slideToggle('fast',function(){
					$('#scroll-pane1').jScrollPane();
				});
				return false;
			});
			$("#maptab").click(function(){
				$("#geo_progress").css('background-color','#FF6600');
				if( !initLoad ) loadMarkers();
			});

			$("#mapForm input:checkbox").click(function(item){
				if( !addingItems && !removingItems ) updateMarkers();
			});
	});
</script>

<!-- START JEREMIAH -->	
	
		
		<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA5orusEsORwp3TpDfY4mHghRo1yugqLkC8EOUpvf1E4JGwrqUFxTZkUlXKDqUJWMKrySTaiPKtyYvRA&amp;sensor=true" type="text/javascript"></script>
				
		<script type="text/javascript" src="http://gmaps-utility-library.googlecode.com/svn/trunk/progressbarcontrol/1.0/src/progressbarcontrol.js"></script>


		<script type="text/javascript">
		//<![CDATA[


		//A few constants identical client-side and server-side
		var oConstant = {
			'RGB_MODE' : 0,//color check based on RGB coords
			'HSL_MODE' : 1,//color check based on HSL coords
			'RGB_PRECISION' : 30,//0..255 - max distance in the RGB space
			'HSL_PRECISION' : 0.1,//0..1 - max distance in the HSL space
		};
		//Current color check mode
		var COLOR_CHECK_MODE = oConstant.RGB_MODE;
		var googleMap = null;
		var copyrightCollection = null;
		var backgroundTileLayer = null;
		var existingPaletteColors = new Array();
		var originalColors = '';		
		var progressBar;
		var markerOptions;

        var baseIcon;
		
		$(function($){//Call when page is loaded

			
			$(window).unload(function(){//Code called when page closed
				if (google.maps.BrowserIsCompatible()){
					google.maps.Unload();
				}
			});//unload

			var lat = 37.857507;
			var lon = -96.767578;
			
			if (google.maps.BrowserIsCompatible()) {


		        var baseIcon = new GIcon(G_DEFAULT_ICON);
			        baseIcon.shadow = "";
			        baseIcon.iconSize = new GSize(15, 15);
			        baseIcon.shadowSize = new GSize(0, 0);
			        baseIcon.iconAnchor = new GPoint(0, 0);
			        baseIcon.infoWindowAnchor = new GPoint(0, 0);
			        baseIcon.image = "http://demo.strategicscrap.com/lib/map/orange_dot.png";
				
				googleMap = new google.maps.Map2(document.getElementById("map_container"));
				//googleMap.enableGoogleBar();
				googleMap.addControl(new GLargeMapControl3D());
	//			googleMap.enableContinuousZoom();
//				googleMap.enableScrollWheelZoom();//KO
				var sizeZero = new google.maps.Size(0, 0);
				  progressBar = new ProgressbarControl(googleMap, {width:150}); 
				  
				  //Greg's Stuff
				        // ====== Restricting the range of Zoom Levels =====
					      // Get the list of map types      
					      var mt = googleMap.getMapTypes();
					      // Overwrite the getMinimumResolution() and getMaximumResolution() methods
for (var i=0; i<mt.length; i++) {
					        mt[i].getMinimumResolution = function() {return 7;}
					        mt[i].getMaximumResolution = function() {return 11;}
					      }
						  
						  //bounds test
						        // Add a move listener to restrict the bounds range
							      GEvent.addListener(googleMap, "move", function() {
							        checkBounds();
							      });
							 
							      // The allowed region which the whole map must be within
							      var allowedBounds = new GLatLngBounds(new GLatLng(16.6,-126), new GLatLng(53.4,-54));
							      
							      // If the map position is out of range, move it back
							      function checkBounds() {
							        // Perform the check and return if OK
							        if (allowedBounds.contains(googleMap.getCenter())) {
							          return;
							        }
							        // It`s not OK, so find the nearest allowed point and move there
							        var C = googleMap.getCenter();
							        var X = C.lng();
							        var Y = C.lat();
							 
							        var AmaxX = allowedBounds.getNorthEast().lng();
							        var AmaxY = allowedBounds.getNorthEast().lat();
							        var AminX = allowedBounds.getSouthWest().lng();
							        var AminY = allowedBounds.getSouthWest().lat();
							 
							        if (X < AminX) {X = AminX;}
							        if (X > AmaxX) {X = AmaxX;}
							        if (Y < AminY) {Y = AminY;}
							        if (Y > AmaxY) {Y = AmaxY;}
							        //alert ("Restricting "+Y+" "+X);
							        googleMap.setCenter(new GLatLng(Y,X));
							      }
						  
				  //End Greg's Stuff

		
		
		// Set up our GMarkerOptions object
		markerOptions = { icon:baseIcon };

				pos = new google.maps.ControlPosition(0, new google.maps.Size(75, 10));

				copyrightCollection = new google.maps.CopyrightCollection('&copy;2010');
				var latLngBounds = new google.maps.LatLngBounds(new google.maps.LatLng(lat,lon), new google.maps.LatLng(lat,lon));
				var copyright = new google.maps.Copyright(
					Math.round(Math.random()*100),//random id
					latLngBounds, 
					0,
					'GMapify');
				copyrightCollection.addCopyright(copyright);
				
				//not using this setCenter
//				googleMap.setCenter(new google.maps.LatLng(lat,lon), 9);
				
				//First submission but no set filter: only to get standard tiles.
				fSubmitFilter();
				//$("#log").html("Map loaded!");
				
				// using this one after fSubmit... because minRes.. maxRes.. have been set in that function.
				// so setCenter will work with the zoom limits set
				googleMap.setCenter(new google.maps.LatLng(lat,lon), 0);
			}

			//Show/Hide traffic overlay
			//We do not use the google.maps.TrafficOverlay object because it does not contain France so we request the same tiles than maps.google.com
			$("#withIT").removeAttr("Checked");
			$("#withIT").change(function(){
				if($(this).is(':checked')){//Checked checkbox 
					var tileLayerTraffic = new google.maps.TileLayer(copyrightCollection, 1, 19, {
						//Get Google tiles directly
						tileUrlTemplate: 'http://mt' + Math.floor((Math.random()*4)) + '.google.com/vt?lyrs=traffic&x={X}&y={Y}&z={Z}&style=15',//m@126,
						isPng:true,
						opacity:1.0});
						// Create a new map type with the current background layer + traffic
						var mapType = new google.maps.MapType([backgroundTileLayer, tileLayerTraffic], G_NORMAL_MAP.getProjection(), "WithTraffic",{'textColor':'#ffffff'});
						fEmptyTiles();
						googleMap.addMapType(mapType);
						googleMap.setMapType(mapType);
				}else{
					fEmptyTiles();
					//Remove traffic layer
					var mapType = new google.maps.MapType([backgroundTileLayer], G_NORMAL_MAP.getProjection(), "WithoutTraffic",{'textColor':'#ffffff'});
					googleMap.addMapType(mapType);
					googleMap.setMapType(mapType);
				}
			});//change
		});//onload

		//////////////////
		// FUNCTIONS //
		//////////////////

		//Filter submission: set up the new tile layer
		function fSubmitFilter(){
			fEmptyTiles();
			//Set up url template
			var filterName = $("#filter_selector").val();
			var mapType = $("input[name=mapType]:checked").val();
			var tileUrlTemplate = 'http://demo.strategicscrap.com/lib/map/tile.php?x={X}&y={Y}&zoom={Z}&f=Grayscale&m=' + mapType + '&args=';
			//All filters parameters are in the 'args' url parameter separated by a comma
			if("Swap_Color" == filterName){
				$(".color").each(function(i){
					if(0 != $(this).attr("new").length){
						tileUrlTemplate += $(this).attr("original") + ',' + $(this).attr("new") + ',';
					}
				});
			}else{
				$(".arg").each(function(i){
					tileUrlTemplate += $(this).val() + ',';
				});
			}
			backgroundTileLayer = new google.maps.TileLayer(copyrightCollection, 1, 19, {
				tileUrlTemplate: tileUrlTemplate,
				isPng:true,
				opacity:1.0});
			//New background layer
			var mapType = new google.maps.MapType([backgroundTileLayer], G_NORMAL_MAP.getProjection(), "ProcessedTiles",{'textColor':'#ffffff'});
			googleMap.addMapType(mapType);
			googleMap.setMapType(mapType);
			
									  mapType.getMinimumResolution = function() {return 4;};
						  mapType.getMaximumResolution = function() {return 12;};
			
		};//fSubmitFilter

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Remove all map types
		function fEmptyTiles(){
			$.each(googleMap.getMapTypes(), function(key, value){
				googleMap.removeMapType(value);
			});	 
		};//fEmptyTiles

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
var markersArray = [];
var modData = [];
var maxNum = modData.length;
var num = 0;
var initLoad = false;
var updateFilters = false;
var removingItems = false;
var addingItems = false;

function updateMarkers(){
	$("#mapForm input:checkbox").attr('disabled','disabled');
//	var i = 0, len = _d.length;
	modData = [];
	var checkedItems = $("#mapForm input:checkbox:checked");
    var val_string = "||";
	$.each(checkedItems, function() {
		val_string += $(this).val() + "||";
	});
//	for( var j = 0; j<checkedItems.length; j++){
//		chkd_item = checkedItems[j];
//	}

	$.getJSON("/controllers/remote_controller.php?method=filter-material&val=" + val_string, function(json) { 
		if (json.Locations.length>0) { 
		  for (i=0; i<json.Locations.length; i++) { 
		    var location = json.Locations[i]; 
		  }
		    modData = json.Locations;
		} else {
		    modData = []; 
		}
		updatePageData(json);
	});
	
	if(checkedItems.length < 1) {
		modData = [];
		updatePageData();
		$("#mapForm input:checkbox").removeAttr('disabled');
		$('.moduleContent h3 span:first').text(modData.length);
	}

}

function updatePageData( json ){
	if(!json) return false; 
	updateFilters = true;
	removeMarkers();
	$("#mapForm input:checkbox").removeAttr('disabled');
	$('.moduleContent h3 span:first').text(modData.length);

	var pageData = "", i = 0, l = json.Locations.length,cur = null;
	for(i;i<l;i++){
		cur = json.Locations[i];
		pageData += '<tr class="row2" >';
		pageData += '	<td style="width:30px"><a class="scrapQuote quote" href="#" title="view details">details</a></td>';
		pageData += '	<td style="width:130px">'+cur.company+'</td>';
		pageData += '	<td style="width:60px">'+cur.category+'</td>';
		pageData += '	<td style="width:200px">'+cur.address_1+ (cur.address_2 != '' ? '<br />' + cur.address_2 : '') + '<br />' + cur.city+', ' +cur.state_province+' '+ cur.zip_postal_code+'</td>';
		pageData += '	<td style="width:60px">'+cur.state_province+'</td>';
		pageData += '	<td style="width:110px">'+cur.first_name+' '+cur.last_name+'</td>';
		pageData += '	<td><a href="#">shipping quote</a></td>';
		pageData += '</tr>';
		pageData += '<tr class="details facilty_1 row2 ">';
		pageData += '	<td colspan="7"><div>details go here</div></td>';
		pageData += '</tr>';
	}
	$("#scrollData").html(pageData);
    $('#scroll-pane1').jScrollPane();
}

function loadMarkers(){ 
	num = 0; 
	maxNum = modData.length;
	progressBar.start(maxNum);  
	addingItems = true;
	setTimeout('createMarker()', 10);
}

function addClickevent(marker) {
	GEvent.addListener(marker, "click", function() {
		marker.openInfoWindowHtml(marker.da.content);
	});
}




function createMarker(latlng, number) {
    var marker = new GMarker(latlng);
    marker.value = number;
    GEvent.addListener(marker,"click", function() {
      var myHtml = "<b>#" + number + "</b><br/>" + message[number -1];
      map.openInfoWindowHtml(latlng, myHtml);
    });
    return marker;
}

function createMarker(){  
//	num++;
	if (num < maxNum) {  
		var latlng = new GLatLng(modData[num].lat, modData[num].lon); 
		//{"address":"P.O. Box 14667","city":"Phoenix","state":"arizona","zip":85063,"name":"Verco Decking Inc","phone":"602-272-1347","url":"http://www.vercodeck.com/","fax":"","lat":"33.45","lon":"-112.07","title":"Verco Decking Inc","type":"Mills","types":{"mat_30":true}},
      
        
		var marker = new GMarker(latlng,markerOptions);  
		marker.value = num;

		 GEvent.addListener(marker, "click", function() {  
			var tfff = modData[num].company + "<br />" + 
	        modData[num].address_1 + "<br />" + 
	        ( modData[num].address_2  ? modData[num].address_2 + "<br />" : "" ) + 
	        modData[num].city + ", " + 
	        modData[num].state_province + ' ' + 
	        modData[num].zip_postal_code + 
	        "<hr />" + 
	        ( modData[num].home_phone != "" ? "<br />Home Phone:" + modData[num].home_phone : "" ) + 
	        ( modData[num].mobile_phone != "" ? "<br />Mobile Phone:" + modData[num].mobile_phone : "" ) + 
	        ( modData[num].fax_number != "" ? "<br />Fax:" + modData[num].fax_number : "" ) + 
	        "<hr /><a href='" + modData[num].website + "'>" + modData[num].website + "</a>";
		  marker.openInfoWindowHtml(tfff);
		 });
		 
		googleMap.addOverlay(marker);
		 
		markersArray.push(marker);  
			
		setTimeout('createMarker()', 10);  
		if(num+1 < maxNum)progressBar.updateLoader(1);  
	} else {
		onMarkersCreated();
	}
	num++;
}

function onMarkersCreated(){
	progressBar.remove();    
	num = 0;
	initLoad = true;
	addingItems = false;
}

function removeMarkers(){  
	removingItems = true;
		progressBar.start(markersArray.length);  
		setTimeout("removeMarker()", 10);
}

function removeMarker(){ 
	if (markersArray.length > 0) {
		progressBar.updateLoader(1);  
		googleMap.removeOverlay(markersArray.pop());  
		    setTimeout("removeMarker()", 10);  
	} else {
		onMarkersRemoved();
	}
}

function onMarkersRemoved(){
	progressBar.remove();
	removingItems = false;
	if( updateFilters ) {
		updateFilters = false;
		loadMarkers();
	}
}

//////////////////////////
</script>
	
<!-- DONE JEREMIAH -->

<div id="mapForm" style="padding:20px 6px">
	<h3>Iron and Steel Types (Materials)</h3>
	<div>
		<? $perCol = ceil(count($materials)/4); ?>
		<? $i=$perCol ?>
		<? $ii=1 ?>
		<? foreach ($materials as $mat) { ?>
		<? if ($perCol == $i) { ?>
		<div style="width:200px;float:left;">
		<? } ?>
			<input type="checkbox" id="mat_<?=$mat->id?>" value="<?=$mat->id?>" /><span><?= $mat->name ?></span><br />
		<? if ($i == 1 || $ii == count($materials)) { ?>
		</div>
		<? } ?>
		<? $i = ($i == 1) ? $perCol : $i-1; ?>
		<? $ii++; ?>
		<? } ?>
	</div>
		<br style="clear:both;" />
		<br />
		<br style="clear:both;" />
		
		<div class="fullCol">
			<div class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
				<div class="moduleContent">
					<h3><span>0</span> Search Results</h3>
					<hr />
					
<div id="scrapExchangeListings" class="classifiedListing">
					  	
	<ul id="tabs-scrapClass">
		<li class="first"><a href="#tab1"><span>List View</span></a></li>
		<li><a href="#tab2" id="maptab"><span>Map View</span></a></li>
	</ul>
	
	<div class="tabBox">
		<div id="tab1">
				<table>
					<thead>
						<tr class="row2">
						    <th style="width:30px">&nbsp;</th>
						    <th style="width:130px">COMPANY NAME</th>
						    <th style="width:60px">TYPE</th>
						    <th style="width:200px">ADDRESS</th>
						    <th style="width:60px">STATE</th>
						    <th style="width:110px">CONTACT</th>
						    <th>&nbsp;</th>
						</tr>
					</thead>
				</table>
			<div id="scroll-pane1">
				<table>
					<tbody id="scrollData">
						<tr><td>Please select a check box.</td></tr>
					</tbody>
				</table>
			</div><!-- scroll-pane1 -->
		</div><!-- tab1 -->
		
		<div id="tab2">
			<div id="scroll-pane2">
				
				<div id="map_container">
				</div>
												
			</div><!-- scroll-pane2 -->
		</div><!-- tab2 -->
			
	</div><!-- tabBox -->
</div>

					
				</div><div class="moduleBottom"><!-- IE hates empty elements --></div>	
			</div>
		</div>

<div id="map" style="padding-bottom:20px">
<!-- empty--> 
</div>
</div>
<!-- This contains the hidden content for inline calls --> 
<div style='display:none'> 
 
	<div id='inline_example1' style='padding:10px; background:#fff;'> 
		<div style="margin:auto; border: 1px solid #000; display:block; width:500px;"> 
			<h2 id="item_name" style="margin: 10px 10px 5px;"></h2> 
			<p id="show_item_address" style="border:1px solid #000; border-width: 1px 0;padding: 10px"> 
				<strong>Address:</strong><br /> 
				<span id="item_address"></span> 
			</p> 
			<div style="border:1px solid #000; border-width: 1px 0;padding: 10px; display: block;"> 
				<p id="show_item_phone">Phone: <span id="item_phone"></span></p> 
				<p id="show_item_fax">Fax: <span id="item_phone"></span></p> 
				<p id="show_item_url">Website: <span id="item_url"></span></p> 
			</div> 
		</div> 
	</div> 
</div>