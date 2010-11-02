<?php
/*
*DISCLAIMER
* 
*THIS SOFTWARE IS PROVIDED BY THE AUTHOR 'AS IS' AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES *OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, *INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF *USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT *(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*
*	@author: Olivier G. <olbibigo_AT_gmail_DOT_com>
*	@version: 1.1
*	@history:
*		1.0	creation
		1.1	disclaimer added
*/
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Scrap Map</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style type="text/css">
			html, body{
				height: 100%;
				width: 100%;
			}
			body{
				margin: 10px 10px 10px 10px;
			}
			img{
				border:0;
				vertical-align:bottom;
			}
			#map_container{
				width:100%;
				height:90%;
				border-width: 0px;
				background-color:white;
			}
			#status {
				background-color: #eeeeee;
				padding: 3px 5px 3px 5px;
				opacity: .9;
			}
			#filter_params{
				width:100%;
				overflow:auto;
				margin-bottom: 20px;
			}
			.arg{
				background-color: #ffffcc;
			}
			.color{
				width:15px;
				height:15px;
				border:1px solid black;
				cursor:pointer
			}
		</style>
	</head>
	<body>
		<div id="map_container"></div>
		<script type="text/javascript" src="http://www.google.com/jsapi?autoload=%7B%22modules%22:%5B%7B%22name%22:%22maps%22,%22version%22:%222.X%22%7D,%7B%22name%22:%22jquery%22,%22version%22:%221.4.2%22%7D%5D%7D&key=ABQIAAAA3nfHFCGk7Q1r0eoNchKe7xSEU21qudtORCmq5vknEgnOEf4cfhSrJPKEa6ljh_o7Z2nwuW6EC-EAbg"></script>		


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
			
		$(function($){//Call when page is loaded
			$(window).unload(function(){//Code called when page closed
				if (google.maps.BrowserIsCompatible()){
					google.maps.Unload();
				}
			});//unload
			
			if (google.maps.BrowserIsCompatible()) {
				setInterval("fLoadCookies();", 2000);
				googleMap = new google.maps.Map2(document.getElementById("map_container"), {googleBarOptions : { style : "new", adsOptions: {client: "partner-pub-3340295472790203", adsafe: "high",language: "en"}}});
				googleMap.enableGoogleBar();
				googleMap.addControl(new GLargeMapControl3D());
				googleMap.enableContinuousZoom();
				//googleMap.enableScrollWheelZoom();//KO
				var sizeZero = new google.maps.Size(0, 0);
				$.each(['G_ANCHOR_TOP_LEFT', 'G_ANCHOR_TOP_RIGHT', 'G_ANCHOR_BOTTOM_LEFT', 'G_ANCHOR_BOTTOM_RIGHT'], function(i, cornerName){
					//Little trick: image id = enum GControlAnchor so we can use 'CornerName' twice.
					var pos = new google.maps.ControlPosition(eval(cornerName), sizeZero);
					var target = $("#" + cornerName).get(0);
					pos.apply(target);
					googleMap.getContainer().appendChild(target);
				});//each
				pos = new google.maps.ControlPosition(G_ANCHOR_TOP_LEFT, new google.maps.Size(75, 10));
				pos.apply($("#status").get(0));
				googleMap.getContainer().appendChild($("#status").get(0));

				copyrightCollection = new google.maps.CopyrightCollection('©2010');
				var latLngBounds = new google.maps.LatLngBounds(new google.maps.LatLng(-90,-180), new google.maps.LatLng(90,180));
				var copyright = new google.maps.Copyright(
					Math.round(Math.random()*100),//random id
					latLngBounds, 
					0,
					'GMapify');
				copyrightCollection.addCopyright(copyright);
				
				googleMap.setCenter(new google.maps.LatLng(48.0, 2.0), 6);
				
				//Fill the filter list
				var filtersList = '';
				$.each(imageFilters, function(key, value){
					filtersList += '<option value="' + key + '">' + key + '</option>'; 
				});
				$('#filter_selector').html(filtersList);
				
				//Code executed on filter change to update the parameter form
				$('#filter_selector').change(function(){
					var filterName = $(this).val();
					//If no parameter, direct submissision
					if(0 == imageFilters[filterName].length){
						$("#filter_params").html('');
						fSubmitFilter();
					}else{
						//Build the parameter form
						var filterParams = '';
						if("Swap_Color" == filterName){
							//Special processing
							filterParams = 'Colors:<br/>' + originalColors + '<br/><span style="font-size:0.7em"><a href="#" id="colorReseter">Reset</a>&nbsp;&nbsp;<a href="#" id="oneColorSetter" title="Switch not changed colors to a unique one">Unique color</a>&nbsp;&nbsp;<a href="#" id="colorGraySetter" title="Switch not changed colors to grayscale ones">Grayscale</a>&nbsp;&nbsp;<a href="#" id="colorNegateSetter" title="Switch not changed colors to negative ones">Negative</a></span>';
						}else if("Convolate" == filterName){
							//Special processing to get a 3 x 3 matrix
							filterParams = 'Convolution matrix:<br/>';
							for(i =0; i<= 2; ++i){
								for(j =0; j<= 2; ++j){
									filterParams += '<input type="text" size="5" value="1" class="arg"/>&nbsp;';
								}
								filterParams += '<br/>';
							}
							filterParams += 'Color offset:&nbsp;<input type="text" size="5" value="0" class="arg"/>'
						}else{
							//Standard processing
							$.each(imageFilters[filterName], function(key, value){
								filterParams += value + ':&nbsp;<input type="text" size="5" value="" class="arg"/>&nbsp;&nbsp;&nbsp;';
							});
						}
						//Append the Submit button
						$("#filter_params").html(filterParams + '&nbsp;&nbsp;<input type="button" value="Change tiles" onclick="fSubmitFilter();"/>');
						
						//jQuery plugin to add a color selector to all 'span'
						$('.color').ColorPicker({
							onSubmit: function(hsb, hex, rgb, el) {
								//new color is stored in a 'new' attribute of the 'span'
								$(el).attr("new", hex);
								$(el).css("background-color", "#"+hex);
								$(el).ColorPickerHide();
							}
						});
						//Change all colors not already changed into one unique color
						//jQuery plugin to add a color selector
						$('#oneColorSetter').ColorPicker({
							onSubmit: function(hsb, hex, rgb, el) {
								//Loop through all colors
								$(".color").each(function(i){
									//A colors has not been swapped if 'new' value is empty
									if(0 == $(this).attr("new").length){
										$(this).attr("new", hex);
										$(this).css("background-color", "#" + hex);
									}
								});
								$(el).ColorPickerHide();
							}
						});
						//Reset all colors to their original one
						$('#colorReseter').click(function(){
							//Loop through all colors
							$(".color").each(function(i){
								//A colors has been swapped if 'new' value is not empty
								if(0 != $(this).attr("new").length){
									$(this).attr("new", "");
									//Original color is stored in 'original' attribute of the 'span'
									$(this).css("background-color", "#" + $(this).attr("original"));
								}
							});
						});
						//Change all colors not already changed into grayscale
						$('#colorGraySetter').click(function(){
							//Loop through all colors
							$(".color").each(function(i){
								//A colors has not been swapped if 'new' value is empty
								if(0 == $(this).attr("new").length){
									var original = $(this).attr("original");
									//Convert form HEX to RGB
									var r = parseInt(original.substring(0,2),16);
									var g = parseInt(original.substring(2,4),16);
									var b = parseInt(original.substring(4,6),16);
									//grayscale value (as used in the GIMP)
									var gray = Math.round(0.3 * r + 0.59 * g + 0.11 * b);
									gray = Math.max(0,gray);
									gray = Math.min(gray,255);
									//Convert form RGB to HEX
									var monoHex = "0123456789ABCDEF".charAt((gray-gray%16)/16) + "0123456789ABCDEF".charAt(gray%16);
									//Apply same value to all color channels
									var hex = monoHex + monoHex + monoHex;
									$(this).attr("new", hex);
									$(this).css("background-color", "#" + hex);
								}
							});
						});
						//Change all colors not already changed into negative one
						$('#colorNegateSetter').click(function(){
							//Loop through all colors
							$(".color").each(function(i){
								//A colors has not been swapped if 'new' value is empty
								if(0 == $(this).attr("new").length){
									var original = $(this).attr("original");
									//Convert form HEX to RGB
									var r = 255 - parseInt(original.substring(0,2),16);
									var g = 255 - parseInt(original.substring(2,4),16);
									var b = 255 - parseInt(original.substring(4,6),16);
									//negative value
									var hexR = "0123456789ABCDEF".charAt((r-r%16)/16) + "0123456789ABCDEF".charAt(r%16);
									var hexG = "0123456789ABCDEF".charAt((g-g%16)/16) + "0123456789ABCDEF".charAt(g%16);
									var hexB = "0123456789ABCDEF".charAt((b-b%16)/16) + "0123456789ABCDEF".charAt(b%16);
									var hex = hexR + hexG + hexB;
									eval('var hex = 0xFFFFFF - 0x'+original);
									$(this).attr("new", hex);
									$(this).css("background-color", "#" + hex);
								}
							});
						});
					}
				});//click
				var mapTypesSelector = $("input:radio[name=mapType]");
				mapTypesSelector.filter('[value=0]').attr('checked', true);
				mapTypesSelector.change(function(){
					//Reset already stored original colors.
					existingPaletteColors = new Array();
					originalColors = '';
					fSubmitFilter();
				});
				//First submission but no set filter: only to get standard tiles.
				fSubmitFilter();
				$("#log").html("Map loaded!");
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
			var tileUrlTemplate = '/map/tile.php?x={X}&y={Y}&zoom={Z}&f=Sepia&m=' + mapType + '&args=';
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
		};//fSubmitFilter

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Remove all map types
		function fEmptyTiles(){
			$.each(googleMap.getMapTypes(), function(key, value){
				googleMap.removeMapType(value);
			});	 
		};//fEmptyTiles

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Used only by COLOR_SWAP filter. Color components of the standard tiles
		//are sent by the server via cookies.
		function fLoadCookies(){
			var cookie_date = new Date();
			cookie_date.setTime (cookie_date.getTime()-1);
			var cookies = document.cookie.split(';') ;
			$.each(cookies, function(i, cookie){
				//Find tile metadata in cookies
				if (cookie.substr(1,1) == 'T'){
					var delim = cookie.indexOf("=");
					var cookieName = cookie.substr(1, delim-1);
					//Delete cookie by setting an expiration delay at 0
					document.cookie = cookieName + "=; expires=" + cookie_date.toGMTString();
					//Get data by parsing cookie string
					var cookieStuff = unescape(cookie.substr(delim + 1, cookie.length - delim ));
					var colors = cookieStuff.split('#');
					//loop through received colors
					$.each(colors, function(key, color){
						//Color check to remove doublons on a global scope (all tiles)
						//Note: it is the same operation server-side but on a local scope (current tile only)
						if((color.length!=0) && (fIsNewColor(color))){
							originalColors += '&nbsp;&nbsp;<input type="text" value="" readonly="readonly" style="background-color:#' + color + ';" original="' + color + '" new="" class="color"/>&nbsp;&nbsp;';
						}
					});
				}
			});//each	
		};

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Check if a color is 'new' so is not too close from an other one.
		function fIsNewColor(colorHEX){
			//Convert from HEX to RGB
			var colorRGB = {'r':parseInt(colorHEX.substring(0,2),16),
				'g': parseInt(colorHEX.substring(2,4),16),
				'b': parseInt(colorHEX.substring(4,6),16)};
			var l = existingPaletteColors.length;
			if(COLOR_CHECK_MODE == oConstant.RGB_MODE){//Distance computation is performed in RGB color space
				for(i=0; i < l; ++i){
					if( (colorRGB.r >= (existingPaletteColors[i].r - oConstant.RGB_PRECISION)) && (colorRGB.r <= (existingPaletteColors[i].r + oConstant.RGB_PRECISION))
					&& (colorRGB.g >= (existingPaletteColors[i].g - oConstant.RGB_PRECISION)) && (colorRGB.g <= (existingPaletteColors[i].g + oConstant.RGB_PRECISION))
					&& (colorRGB.b >= (existingPaletteColors[i].b - oConstant.RGB_PRECISION)) && (colorRGB.b <= (existingPaletteColors[i].b +   oConstant.RGB_PRECISION)) ){
						return false;
					}
				}
			}else if(COLOR_CHECK_MODE == oConstant.HSL_MODE){//Distance computation is performed in HSL color space
				var colorHSL = fRgb2hsl(colorRGB);
				for(i=0; i < l; ++i){
					var existingPaletteColorHSL = fRgb2hsl(existingPaletteColors[i]);
					if( (colorHSL.h >= (existingPaletteColorHSL.h - oConstant.HSL_PRECISION)) && (colorHSL.h <= (existingPaletteColorHSL.h + oConstant.HSL_PRECISION))
						&& (colorHSL.s >= (existingPaletteColorHSL.s - oConstant.HSL_PRECISION)) && (colorHSL.s <= (existingPaletteColorHSL.s + oConstant.HSL_PRECISION))
						&& (colorHSL.l >= (existingPaletteColorHSL.l - oConstant.HSL_PRECISION)) && (colorHSL.l <= (existingPaletteColorHSL.l + oConstant.HSL_PRECISION)) ){
						return false;
					}
				}
			}
			//Append current color to existing ones
			existingPaletteColors.push(colorRGB);
			return true;
		};//fIsNewColor
		
		//Convert a color from RGB color space to HSL one
		function fRgb2hsl(colorRGB){
			var r = colorRGB.r / 255;
			var g = colorRGB.g / 255;
			var b = colorRGB.b / 255;
			var max = Math.max(r, g, b)
			var min = Math.min(r, g, b);
			var h, s, l = (max + min) / 2;
			if(max == min){
				h = s = 0; // achromatic
			}else{
				var d = max - min;
				s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
				switch(max){
					case r: h = (g - b) / d + (g < b ? 6 : 0); break;
					case g: h = (b - r) / d + 2; break;
					case b: h = (r - g) / d + 4; break;
				}
				h /= 6;
			}
			return {'h':h, 's':s, 'l':l};
		};//fRgb2hsl
		//]]>
		</script>
	</body>
</html>

