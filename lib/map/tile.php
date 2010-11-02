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
	require_once('colorsUtility.php');

	define('RGB_MODE', 0);
	define('HSL_MODE', 1);
	define('COLOR_CHECK_MODE', RGB_MODE);
	
	define('TILE_SIZE',256);
	define('RGB_PRECISION', 30);//0..255
	define('HSL_PRECISION', 0.1);//0..1

	//Check if parameters are set
	if(isset($_GET['x']))
		$X = (int)$_GET['x'];
	else
		exit("x missing");
	if(isset($_GET['y']))
		$Y = (int)$_GET['y'];
	else
		exit("y missing");
	if(isset($_GET['zoom']))
		$zoom = (int)$_GET['zoom'];
	else
		exit("zoom missing");
	if(isset($_GET['f']))
		$filter = strtoupper($_GET['f']);
	else
		exit("filter missing");
	if(isset($_GET['m']))
		$mapType = strtoupper($_GET['m']);
	else
		exit("mapType missing");

	//HTTP headers for tile request
	$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
	$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
	$header[] = "Cache-Control: max-age=0";
	$header[] = "Connection: keep-alive";
	$header[] = "Keep-Alive: 300";
	$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$header[] = "Accept-Language: en-us,en;q=0.5";
	$header[] = "Pragma: "; // browsers keep this blank. 

	//Select url template
	switch($mapType){
		case 1://G_SATELLITE_MAP 
			$tileUrl = 'http://khm'.rand(0,3).'.google.com/kh/v=60&x='.$X.'&y='.$Y.'&z='.$zoom;
			break;
		case 2://G_PHYSICAL_MAP 
			$tileUrl = 'http://mt'.rand(0,3).'.google.com/vt/lyrs=t@125&x='.$X.'&y='.$Y.'&z='.$zoom;	
			break;
		default://G_NORMAL_MAP 
			$tileUrl = 'http://mt'.rand(0,3).'.google.com/vt/x='.$X.'&y='.$Y.'&z='.$zoom;		
	}
	//Request tile with Curl library
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11");
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $tileUrl);
	$rawTile = curl_exec($ch);
	//Build tile image from http answer
	$tile = imagecreatefromstring($rawTile);
	if(imageistruecolor($tile)){
		//Convert to palette color
		$colors_handle = imageCreateTrueColor(TILE_SIZE,TILE_SIZE);
		imageCopyMerge($colors_handle, $tile, 0, 0, 0, 0, TILE_SIZE, TILE_SIZE, 100);
		imagetruecolortopalette($tile, true, 255);
		imageColorMatch($colors_handle, $tile);
		imageDestroy($colors_handle);
	}
	if(isset($_GET['args'])){
		$args = explode(',', $_GET['args']);
		array_pop($args);//Clean up by removing last empty cell
	}

	switch($filter){
		case 'NONE'://No real filter is set
			//Return palette colors within a cookie with current tile. Used by SWAP_COLOR filter.
			$nbColors = imagecolorstotal($tile);
			$paletteColors = '';
			$existingPaletteColors = array();
			for($i=0; $i<$nbColors; ++$i){
				$paletteColor = imagecolorsforindex($tile, $i);
				//Color filtering to remove close colors (on current tile only)
				if(true === fIsNewColor($paletteColor, $existingPaletteColors, true)){
					$paletteColors .= ColorsUtility::rgb2hex($paletteColor);
				}
			}
			setCookie('T'.$X.'_'.$Y.'_'.$zoom, $paletteColors);
			break;
		case 'SWAP_COLOR'://Swap original colors with new one
			$changedColors = array();
			//args format is originalColor1,newColor1,originalColor2,newColor2,...
			$l = count($args)-1;
			for($i=0; $i < $l; $i=$i+2){
				$changedColors[] = fFormatArgColors($args[$i], $args[$i+1]);//original color & new color 
			}
			$nbColors = imagecolorstotal($tile);
			for($i=0; $i<$nbColors; ++$i){//Loop through palette colors
				$paletteColor = imagecolorsforindex($tile, $i);
				if(true !== ($similarColor = fIsNewColor($paletteColor, $changedColors, false))){
					//Swap colors
					imagecolorset($tile, $i, $similarColor['new']['red'], $similarColor['new']['green'], $similarColor['new']['blue']);
				}
			}
			break;
		case 'CONVOLATE'://Apply a 3x3 convolution matrix
			$matrix = array(array($args[0], $args[1], $args[2]), array($args[3], $args[4], $args[5]), array($args[6], $args[7], $args[8]));
			imageconvolution($tile, $matrix, array_sum(array_slice($args, 0, 9, true)), $args[9]);
			break;
		case 'NEGATE'://Swap with 'negative' colors. Better than image filter provided with imagefilter()
			$nbColors = imagecolorstotal($tile);
			for($i=0; $i<$nbColors; ++$i){//Loop through palette colors
				$paletteColor = imagecolorsforindex($tile, $i);
				imagecolorset($tile, $i, 255-$paletteColor['red'], 255-$paletteColor['green'], 255-$paletteColor['blue']);
			}
			break;
		case 'GRAYSCALE'://Swap with 'grayscale' colors. Better than image filter provided with imagefilter()
			$nbColors = imagecolorstotal($tile);
			for($i=0; $i<$nbColors; ++$i){//Loop through palette colors
				$paletteColor = imagecolorsforindex($tile, $i);
				$gray = 0.33 * $paletteColor['red'] + 0.5 * $paletteColor['green'] + 0.16 * $paletteColor['blue'];
				//Same value for all color components
				imagecolorset($tile, $i, $gray, $gray, $gray);
			}
			break;
		case'CHANNEL'://Extract a color channel
			$nbColors = imagecolorstotal($tile);
			for($i=0; $i<$nbColors; ++$i){//Loop through palette colors
				$paletteColor = imagecolorsforindex($tile, $i);
				switch($args[0]){
					case 'r'://Extract red color channel
						imagecolorset($tile, $i, $paletteColor['red'], 0, 0);
						break;
					case 'g'://Extract green color channel
						imagecolorset($tile, $i, 0, $paletteColor['red'], 0);
						break;
					case 'b'://Extract blue color channel
						imagecolorset($tile, $i, 0, 0,$paletteColor['blue']);
						break;
					default:
						exit(-1);
				}
			}
			break;
		case 'THRESHOLD'://Apply a binary filter on color value
			if( (empty($args[1])) || ('rgb' == strtolower($args[1])) ){
				//no channel is set so we use grayscale
				imagefilter($tile, IMG_FILTER_GRAYSCALE);
				$nbColors = imagecolorstotal($tile);
				for($i=0; $i<$nbColors; ++$i){//Loop through palette colors
					$paletteColor = imagecolorsforindex($tile, $i);
					$gray = 0.33 * $paletteColor['red'] + 0.5 * $paletteColor['green'] + 0.16 * $paletteColor['blue'];
					if($gray < (int)$args[0]){
						imagecolorset($tile, $i, 0, 0, 0);//black
					}else{
						imagecolorset($tile, $i, 255, 255, 255);//white
					}
				}
			}else{//A color channel is set
				switch($args[1]){
					case 'r'://Extract red color channel
						$channel= 'red';
						$targetColor = array(255,0,0);//pure red
						break;
					case 'g'://Extract green color channel
						$channel= 'green';
						$targetColor = array(0,255,0);//pure green
						break;
					case 'b':////Extract blue color channel
						$channel= 'blue';
						$targetColor = array(0,0,255);//pure blue
						break;
					default:
						exit(-1);
				}
				$nbColors = imagecolorstotal($tile);
				for($i=0; $i<$nbColors; ++$i){//Loop through palette colors
					$paletteColor = imagecolorsforindex($tile, $i);
					if($paletteColor[$channel] < (int)$args[0]){
						imagecolorset($tile, $i, 0, 0, 0);//black
					}else{
						imagecolorset($tile, $i, $targetColor[0], $targetColor[1], $targetColor[2]);//pure color
					}
				}
			}
			break;
		case 'SEPIA'://Apply a sepia tone (old picture)
			$nbColors = imagecolorstotal($tile);
			for($i=0; $i<$nbColors; ++$i){//Loop through palette colors
				$paletteColor = imagecolorsforindex($tile, $i);
				$red = ( $paletteColor["red"] * 0.393 + $paletteColor["green"] * 0.769 + $paletteColor["blue"] * 0.189 ) / 1.351;
				$green = ( $paletteColor["red"] * 0.349 + $paletteColor["green"] * 0.686 + $paletteColor["blue"] * 0.168 ) / 1.203;
				$blue = ( $paletteColor["red"] * 0.272 + $paletteColor["green"] * 0.534 + $paletteColor["blue"] * 0.131 ) / 2.140;
				imagecolorset($tile, $i, $red, $green, $blue);
			}
			break;
		case 'RGB_ADJUST'://Better than image filter provided with imagefilter()
			$nbColors = imagecolorstotal($tile);
			$ratioR = empty($args[0]) ? 1 : (1 + (int)$args[0]/100);
			$ratioG = empty($args[1]) ? 1 : (1 + (int)$args[1]/100);
			$ratioB = empty($args[2]) ? 1 : (1 + (int)$args[2]/100);
			for($i=0; $i<$nbColors; ++$i){//Loop through palette colors
				$paletteColor = imagecolorsforindex($tile, $i);
				imagecolorset($tile, $i, min(255, max(0, floor($paletteColor["red"] * $ratioR))), min(255, max(0, floor($paletteColor["green"] * $ratioG))), min(255, max(0, floor($paletteColor["blue"] * $ratioB))));
			}
			break;
		case 'HSL_ADJUST'://Better than image filter provided with imagefilter()
			$nbColors = imagecolorstotal($tile);
			$ratioH = empty($args[0]) ? 1 : (1 + (int)$args[0]/100);
			$ratioS = empty($args[1]) ? 1 : (1 + (int)$args[1]/100);
			$ratioL = empty($args[2]) ? 1 : (1 + (int)$args[2]/100);
			for($i=0; $i<$nbColors; ++$i){//Loop through palette colors
				$paletteColorHSL = ColorsUtility::rgb2hsl(imagecolorsforindex($tile, $i));
				$paletteColorHSL['hue'] = min(1, max(0, $paletteColorHSL['hue'] * $ratioH));
				$paletteColorHSL['saturation'] = min(1, max(0, $paletteColorHSL['saturation'] * $ratioS));
				$paletteColorHSL['lightness'] = min(1, max(0, $paletteColorHSL['lightness'] * $ratioL));
				$paletteColor = ColorsUtility::hsl2rgb($paletteColorHSL);
				imagecolorset($tile, $i, $paletteColor['red'], $paletteColor['green'], $paletteColor['blue']);
			}
			break;
		default://Apply a filter provided by GD imagefilter()
			eval('$filter = IMG_FILTER_'.$filter.';');
			switch(count($args)){
				case 3://Colorize
					imagefilter($tile, $filter, (int)$args[0], (int)$args[1], (int)$args[2]);
					break;
				case 2://Colorize
					imagefilter($tile, $filter, (int)$args[0], (int)$args[1]);
					break;
				case 1://Colorize, Smooth, Pixelate
					imagefilter($tile, $filter, (int)$args[0]);
					break;
				case 0://EdgaDetect, Emboss, Gaussian_Blur, Mean_Removal
					imagefilter($tile, $filter);
					break;
				default://Colorize
					imagefilter($tile, $filter, (int)$args[0], (int)$args[1], (int)$args[2], (int)$args[3]);
			}
	}
	//Output image
	header('Content-type: image/png');
	imagepng($tile);
	imagedestroy($tile);
	unset($tile);
	
	//////////////////
	// FUNCTIONS //
	//////////////////
	
	//Check if a color is 'new' so is not too close from an other one.
	function fIsNewColor($needleColor, &$haystackColors, $isAddedIfNew){//always RGB
		if(RGB_MODE == COLOR_CHECK_MODE){//Distance computation is performed in RGB color space
			foreach($haystackColors as $haystackColor){
				if( ($needleColor['red'] >= ($haystackColor['red'] - RGB_PRECISION)) && ($needleColor['red'] <= ($haystackColor['red'] + RGB_PRECISION))
				&& ($needleColor['green'] >= ($haystackColor['green'] - RGB_PRECISION)) && ($needleColor['green'] <= ($haystackColor['green'] + RGB_PRECISION))
				&& ($needleColor['blue'] >= ($haystackColor['blue'] - RGB_PRECISION)) && ($needleColor['blue'] <= ($haystackColor['blue'] + RGB_PRECISION)) ){
					return $haystackColor;
				}
			}
		}elseif(HSL_MODE == COLOR_CHECK_MODE){//Distance computation is performed in HSL color space
			$needleColorHSL = ColorsUtility::rgb2hsl($needleColor);
			foreach($haystackColors as $haystackColor){
				$haystackColorHSL = ColorsUtility::rgb2hsl($haystackColor);
				if( ($needleColorHSL['hue'] >= ($haystackColorHSL['hue'] - HSL_PRECISION)) && ($needleColorHSL['hue'] <= ($haystackColorHSL['hue'] + HSL_PRECISION)) 
				&& ($needleColorHSL['saturation'] >= ($haystackColorHSL['saturation'] - HSL_PRECISION)) && ($needleColorHSL['saturation'] <= ($haystackColorHSL['saturation'] + HSL_PRECISION)) && ($needleColorHSL['lightness'] >= ($haystackColorHSL['lightness'] - HSL_PRECISION)) && ($needleColorHSL['lightness'] <= ($haystackColorHSL['lightness'] + HSL_PRECISION)) ){
					return $haystackColor;
				}
			}
		}
		if(true === $isAddedIfNew){
			//Append current color to existing ones
			$haystackColors[] = $needleColor;//RGB
		}
		return true;
	}//fIsNewColor

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Format to a structure used to swap colors
	function fFormatArgColors($oldColorHex, $newColorHex){
		$oldColorRGB = ColorsUtility::hex2rgb($oldColorHex);
		return array('red'=>$oldColorRGB['red'],'green'=>$oldColorRGB['green'],'blue'=>$oldColorRGB['blue'], 'new'=> ColorsUtility::hex2rgb($newColorHex));
	};//fFormatArgColors
?>