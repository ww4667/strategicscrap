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
.facility_details{display:none;}
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

			$("#mapForm input:radio").click(function(item){
				if( !addingItems && !removingItems ) updateMarkers();
			});
	});
</script>

<!-- START JEREMIAH -->	
	
		
		<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA5orusEsORwp3TpDfY4mHghRo1yugqLkC8EOUpvf1E4JGwrqUFxTZkUlXKDqUJWMKrySTaiPKtyYvRA&amp;sensor=true" type="text/javascript"></script>
				
		<script type="text/javascript" src="http://gmaps-utility-library.googlecode.com/svn/trunk/progressbarcontrol/1.0/src/progressbarcontrol.js"></script>


		<script type="text/javascript"><!--
		/* <![CDATA[ */


		//A few constants identical client-side and server-side
		var oConstant = {
			'RGB_MODE' : 0,//color check based on RGB coords
			'HSL_MODE' : 1,//color check based on HSL coords
			'RGB_PRECISION' : 30,//0..255 - max distance in the RGB space
			'HSL_PRECISION' : 0.1//0..1 - max distance in the HSL space
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
			        baseIcon.image = "/lib/map/orange_dot.png";
				
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
			var tileUrlTemplate = '/lib/map/tile.php?x={X}&y={Y}&zoom={Z}&f=Grayscale&m=' + mapType + '&args=';
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
var gmarkers = [];
var points = [];


function updateMarkers(){
	
	
	$("#mapForm input:radio").attr('disabled','disabled');

	
	modData = [];
	var checkedItems = $("#mapForm input:radio:checked");
    var val_string = "||";
	
	$.each(checkedItems, function() {
		val_string += $(this).val() + "||";
	});

	
	$.getJSON("/controllers/remote/?method=filter-material&mats=" + val_string, function(json) { 
		
		if (json.locations.length>0) { 
		  for (i=0; i<json.locations.length; i++) { 
		    var location = json.locations[i]; 
		  }
		  modData = json.locations;
		} else {
		    modData = []; 
		}
		
		updatePageData(modData);
	});
	
	if(checkedItems.length < 1) {
		modData = [];
		updatePageData();
		$("#mapForm input:radio").removeAttr('disabled');
		$('.moduleContent h3 span:first').text(modData.length);
	}

}

function updatePageData( json ){
	
	
	if(!json) return false; 
	updateFilters = true;
	removeMarkers();
	$("#mapForm input:radio").removeAttr('disabled');
	$('.moduleContent h3 span:first').text(modData.length);

	var pageData = "", i = 0, l = json.length,cur = null, highlight = true;
	
	for(i;i<l;i++){
		cur = json[i];
		pageData += '<tr class="' + ( highlight ? 'row1' : 'row2' ) + ' scrapRow" rowId="facility_'+i+'" >';
		pageData += '	<td style="width:30px"><a class="scrapQuote quote" title="view details">details</a></td>';
		pageData += '	<td style="width:130px">'+cur.company+'</td>';
		pageData += '	<td style="width:60px">'+cur.category+'</td>';
		pageData += '	<td style="width:200px">'+cur.address_1+ (cur.address_2 != '' ? '<br />' + cur.address_2 : '') + '<br />' + cur.city+', ' +cur.state_province+' '+ cur.zip_postal_code+'</td>';
		pageData += '	<td style="width:60px">'+cur.state_province+'</td>';
		pageData += '	<td style="width:110px">'+cur.first_name+' '+cur.last_name+'';
		pageData += '	'+(cur.business_phone != '' ? 'Business: ' + cur.business_phone : '')+'</td>';
		pageData += '	<td><a trans_id="'+cur.id+'" class="ship_quote_button">shipping quote</a></td>';
		pageData += '</tr>';
		pageData += '<tr id="facility_'+i+'" class="facility_details ' + ( highlight ? 'row1' : 'row2' ) + ' ">';
		pageData += '	<td colspan="7">';
		pageData += '	'+( cur.home_phone != '' ? 'Home: ' + cur.home_phone + '<br />' : '' );
		pageData += '	'+( cur.fax_number != '' ? 'Fax: ' + cur.fax_number + '<br />' : '' );
		pageData += '	'+( cur.website != '' ? 'Website: <a href="' + cur.website + '" target="_blank">' + cur.website + '</a><br />' : '' );
		pageData += '	'+( cur.attachments != '' ? 'Attachment: <a href="' + cur.attachments + '" target="_blank">' + cur.attachments + '</a><br />' : '' );
		pageData += '	'+( cur.notes != '' ? 'Notes: <blockquote>'+cur.notes+'<blockquote><br />' : '' );
		pageData += '	</td>';
		pageData += '</tr>';
		highlight = !highlight;
	}
	highlight = true;
	$("#scrollData").html(pageData);
    $('#scroll-pane1').jScrollPane();
	
	$('.scrapRow').click(function(){
		var rowId = $(this).attr("rowId");
		$('#' + rowId).slideToggle();
	});
	
	$('.ship_quote_button').click(function(){
		var trans_id = $(this).attr("trans_id");
		$('#transport_form').load('/views/scrappers/transport_material.php?id=' + trans_id);
	});
}

function loadMarkers(){ 
	
	num = 0; 
	maxNum = modData.length;
	addingItems = true;
	createMarkers();
}

function addIcon(icon) {
	icon.shadow = "";
	icon.iconSize = new GSize(15, 15);
	icon.shadowSize = new GSize(0, 0);
	icon.iconAnchor = new GPoint(0, 0);
	icon.infoWindowAnchor = new GPoint(0, 0);
	icon.image = "/lib/map/orange_dot.png";
}


function createMarkers(){
	var data = modData;

	var icon = new GIcon();
	icon.image = "/lib/map/orange_dot.png";
	addIcon(icon);

	for(var i = 0; i < data.length; i++) {
		points[i] = new GLatLng(parseFloat(data[i].lat), parseFloat(data[i].lon));
		gmarkers[i] = new GMarker(points[i], icon);
		
		// Store data attributes as property of gmarkers
		var html = "<div class='infowindow'>" +data[i].company + "<br />" + 
		data[i].address_1 + "<br />" + 
        ( data[i].address_2  ? data[i].address_2 + "<br />" : "" ) + 
        data[i].city + ", " + 
        data[i].state_province + ' ' + 
        data[i].zip_postal_code + 
        "<hr />" + 
        ( data[i].business_phone != "" ? "Business Phone: " + data[i].business_phone + "<br />" : "" ) + 
        ( data[i].home_phone != "" ? "Home Phone: " + data[i].home_phone + "<br />" : "" ) + 
        ( data[i].mobile_phone != "" ? "Mobile Phone: " + data[i].mobile_phone + "<br />" : "" ) + 
        ( data[i].fax_number != "" ? "Fax: " + data[i].fax_number + "<br />" : "" ) + 
        "<hr />Website: <a href='" + data[i].website + "' target='_blank'>click here</a>" +
        "<hr />Get Quote: <a trans_id='"+data[i].id+"' class='ship_quote_button'>click here</a>" +
       	( data[i].attachments != "" ?
        "<hr />Attachment: <a href='"+data[i].attachments+"'>"+data[i].attachments+"</a>" : "" ) +
       	( data[i].notes != "" ?
        "<hr />Notes: <blockquote>"+data[i].notes+"</blockquote>" : "" ) +
        "<\/div>";
        
		gmarkers[i].content = html;
		gmarkers[i].nr = i;
		addClickevent( gmarkers[i] );
		googleMap.addOverlay( gmarkers[i] );
	}
	
	onMarkersCreated();
	
}

function addClickevent( marker ) { 
	
	
	GEvent.addListener(marker, "click", function() {
		marker.openInfoWindowHtml(marker.content);
		count = marker.nr;
		stopClick = true;
	});
	 
	return marker;
}


function onMarkersCreated(){
	
	progressBar.remove();    
	num = 0;
	initLoad = true;
	addingItems = false;
	
	$('.ship_quote_button').click(function(){
		var trans_id = $(this).attr("trans_id");
		$('#transport_form').load('/views/scrappers/transport_material.php?id=' + trans_id+'&session_id=<?=session_id();?>');
	});
}

function removeMarkers(){  
	
	removingItems = true;
	var i = 0; l = gmarkers.length;
	for( i; i<l; i++ ) googleMap.removeOverlay( gmarkers[i] ); 
	onMarkersRemoved();
}

function onMarkersRemoved(){
	
	progressBar.remove();
	removingItems = false;
	if( updateFilters ) {
		updateFilters = false;
		loadMarkers();
	}
}
/* ]]> */
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
			<input type="radio" name="material" id="mat_<?=$mat->id?>" value="<?=$mat->id?>" /><span><?= $mat->name ?></span><br />
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
<?=session_id();?>
<div id="transport_form"></div>