<script type="text/javascript" src="/resources/js/map/JavaScriptFlashGateway.js"></script>
<script type="text/javascript" src="/resources/js/map/Exception.js"></script>
<script type="text/javascript" src="/resources/js/map/FlashTag.js"></script>
<script type="text/javascript" src="/resources/js/map/FlashSerializer.js"></script>
<script type="text/javascript" src="/resources/js/map/FlashProxy.js"></script>

<style type="text/css">
h3{color: #ff6600}
</style>

					<script type="text/javascript"> 
						var objMap = objMap || {};
						objMap.uid = new Date().getTime();
						objMap.flashProxy = new FlashProxy(objMap.uid, '/resources/js/map/JavaScriptFlashGateway.swf');
						
						$(document).ready(function() {
							$(".scrapDesc1").colorbox({width:"50%", inline:true, href:"#listingDescription1"});
							$('#filterMills').click( loadDataToMap );
							$('#filterFoundries').click( loadDataToMap );
							$('#type_1').click( loadDataToMap );
							$('#type_2').click( loadDataToMap );
							$('#type_3').click( loadDataToMap );
							$('#zoomOut').click( function(){ objMap.flashProxy.call('zoomOut'); } );
							$('#map').html( buildFlashObject( loadDataToMap( true ) ) );
						});
						
						function buildFlashObject( dataPath ){
							return '<object id="widget" name="widget" width="845" height="550" type="application/x-shockwave-flash"data="/resources/flash/map/us.swf?data_file='+dataPath+'"><param name="allowFullScreen" value="false" /><param name="allowNetworking" value="all" /><param name="allowScriptAccess" value="always" /><param name="wmode" value="transparent" /><param name="flashvars" value="lcId='+objMap.uid+'" /></object>';
						}
						
						function loadMapData( path ){
							objMap.flashProxy.call( 'refreshData', path );
						}
						
						function loadDataToMap( justString ){

							var fm = $( "#filterMills" );
							var ff = $( "#filterFoundries" );
							var t1 = $( "#type_1" );
							var t2 = $( "#type_2" );
							var t3 = $( "#type_3" );
							var gt = "";

							gt += "fm-" + ( fm.attr( 'checked' ) ? "1" : "0" ) + "_";
							gt += "ff-" + ( ff.attr( 'checked' ) ? "1" : "0" ) + "_";
							gt += "t1-" + ( t1.attr( 'checked' ) ? "1" : "0" ) + "_";
							gt += "t2-" + ( t2.attr( 'checked' ) ? "1" : "0" ) + "_";
							gt += "t3-" + ( t3.attr( 'checked' ) ? "1" : "0" ) + "_";

							var op = '/mapdata/' + gt;

							if( justString === true ){
								return op;
							} else {
								loadMapData(op);
							}


						}
						
						function showData ( json ){
							/* reference: */
							var s  = "";
								s += "Name:" + json.name + "\n";
								s += "Address:" + json.address + "\n";
								s += "City:" + json.city + "\n";
								s += "State:" + json.state + "\n";
								s += "Phone:" + json.phone + "\n";
								s += "Fax:" + json.fax + "\n";
								s += "Website:" + json.url + "\n";
							var address = json.address + "<br />" + json.city + ", " + json.state + " " + json.zip;
							$("#item_name").html( json.name );
							if( json.address != '' ){
								$("#show_item_address").show();
								
								$("#item_address").html( address );
							} else {
								$("#show_item_address").hide();
							}
							if( json.phone != '' ){
								$("#show_item_phone").show();
								$("#item_phone").html( json.phone );
							} else {
								$("#show_item_phone").hide();
							}
							if( json.fax != '' ){
								$("#show_item_fax").show();
								$("#item_fax").html( json.fax );
							} else {
								$("#show_item_fax").hide();
							}
							if( json.url != '' ){
								$("#show_item_url").show();
								$("#item_url").html( "<a href='" + json.url + "' target='_blank'>" + json.url + "</a>" );
							} else {
								$("#show_item_url").hide();
							}
							
							$.fn.colorbox({inline:true, href:"#inline_example1"});
 
						}
					</script> 

<div id="mapForm" style="padding:20px 80px">
	<h3>Facilities</h3>
	<div>
		<div style="width:220px; float: left;"><input type="checkbox" id="filterMills" checked="checked" /><span>Mills</span></div>
		<div style="width:220px; float: left;"><input type="checkbox" id="filterFoundries" checked="checked" /><span>Foundries</span></div>
		<div style="width:220px; float: left;"><input type="checkbox" id="filterExporters" checked="checked" /><span>Exporters</span></div>
	</div>
	<br style="clear:both;" />
	<br style="clear:both;" />
	<h3>Iron and Steel Types</h3>
	<div>
		<div style="width:220px; float: left;">
			<input type="checkbox" id="type_1" checked="checked" /><span>80% No.1 HMS / 20% No.2 HMS</span><br />
			<input type="checkbox" id="" checked="checked" disabled="disabled" /><span class="diabled">No. 1 HMS</span><br />
			<input type="checkbox" id="" checked="checked" disabled="disabled" /><span class="diabled">No. 2 HMS</span><br />
			<input type="checkbox" id="" checked="checked" disabled="disabled" /><span class="diabled">No. 1 Bundles</span><br />
			<input type="checkbox" id="" checked="checked" disabled="disabled" /><span class="diabled">No. 1 1/2 Bundles</span><br />
		</div>
		<div style="width:220px; float: left;">
			<input type="checkbox" id="type_2" checked="checked" /><span>No. 2 Bundles</span><br />
			<input type="checkbox" id="" checked="checked" disabled="disabled" /><span class="diabled">No. 1 Bushelling</span><br />
			<input type="checkbox" id="" checked="checked" disabled="disabled" /><span class="diabled">Shredded Scrap</span><br />
			<input type="checkbox" id="" checked="checked" disabled="disabled" /><span class="diabled">Machine Shop Turnings</span><br />
			<input type="checkbox" id="" checked="checked" disabled="disabled" /><span class="diabled">Cast Iron Borings</span><br />
		</div>
		<div style="width:220px; float: left;">
			<input type="checkbox" id="type_3" checked="checked" /><span>Plate and Structures, 2 ft. and under</span><br />
			<input type="checkbox" id="" checked="checked" disabled="disabled" /><span class="diabled">Plate and Structures, 5 ft. and under</span><br />
			<input type="checkbox" id="" checked="checked" disabled="disabled" /><span class="diabled">No. 1 Machinery Cast</span><br />
			<input type="checkbox" id="" checked="checked" disabled="disabled" /><span class="diabled">Rails, 2 ft. and under</span><br />
			<input type="checkbox" id="" checked="checked" disabled="disabled" /><span class="diabled">Cupola Cast</span><br />
		</div>
	</div>
		<br style="clear:both;" />
		<br />
		<br style="clear:both;" />

<div class="full_width_centered">
    <a id="zoomOut"><img src="/resources/images/buttons/zoom_out.png" alt="Zoom Out" /></a>
</div><!-- full_width_centered -->

</div>

<div id="map" style="padding-bottom:20px">
<!-- empty--> 
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