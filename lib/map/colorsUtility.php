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
	class ColorsUtility {
		public static function rgb2hsl($rgb){//each component between 0..255
			if( (!is_array($rgb)) || (!isset($rgb['red'])) || (!isset($rgb['green'])) || (!isset($rgb['blue']))) { 
				return array('hue' => 0, 'saturation' => 0, 'lightness' => 0);
			}
			$var_R=($rgb['red']/255);
			$var_G=($rgb['green']/255);
			$var_B=($rgb['blue']/255);
			$var_Min=min($var_R,$var_G,$var_B);
			$var_Max=max($var_R,$var_G,$var_B);
			$del_Max=$var_Max-$var_Min;
			$l=($var_Max+$var_Min)/2;
			if ($del_Max==0) {
				$h=0;
				$s=0;
			}else{
				if ($l<0.5){
					$s=$del_Max/($var_Max+$var_Min);
				}else{
					$s=$del_Max/(2-$var_Max-$var_Min);
				}
				$del_R=((($var_Max-$var_R)/6)+($del_Max/2))/$del_Max;
				$del_G=((($var_Max-$var_G)/6)+($del_Max/2))/$del_Max;
				$del_B=((($var_Max-$var_B)/6)+($del_Max/2))/$del_Max;

				if ($var_R==$var_Max){
					$h=$del_B-$del_G;
				}elseif ($var_G==$var_Max){
					$h=(1/3)+$del_R-$del_B;
				}elseif ($var_B==$var_Max){
					$h=(2/3)+$del_G-$del_R;
				}
				if ($h<0){
					$h+=1;
				}
				if ($h>1){
					$h-=1;
				}
			}
			return array('hue' => $h, 'saturation' => $s, 'lightness' => $l); //each component between 0..1
		}
		
		public static function hsl2rgb($hsl){//each component between 0..1
			if( (!is_array($hsl)) || (!isset($hsl['hue'])) || (!isset($hsl['saturation'])) || (!isset($hsl['lightness']))) { 
				return array('red' => 0, 'green' => 0, 'blue' => 0);
			}
			$h=$hsl['hue']-floor($hsl['hue']);
			$s=$hsl['saturation']-floor($hsl['saturation']);
			$l=$hsl['lightness']-floor($hsl['lightness']);
			if ($s==0) {
				$r=$l*255;
				$g=$l*255;
				$b=$l*255;
			}
			else {
				if ($l<0.5){
					$var_2=$l*($l+$s);
				}else{
					$var_2=($l+$s)-($s*$l);
				}
				$var_1=2*$l-$var_2;
				$r=255*ColorsUtility::_hue_rgb($var_1,$var_2,$h+(1/3));
				$g=255*ColorsUtility::_hue_rgb($var_1,$var_2,$h);
				$b=255*ColorsUtility::_hue_rgb($var_1,$var_2,$h-(1/3));
			}
			return array('red' => max(0, min(255, floor($r))), 'green' => max(0, min(255, floor($g))), 'blue' => max(0, min(255, floor($b))));//each component between 0..255
		}
		
		public static function rgb2hex($rgb){
			if( (!is_array($rgb)) || (!isset($rgb['red'])) || (!isset($rgb['green'])) || (!isset($rgb['blue']))) { 
				return '#000000'; 
			}
			$r = dechex($rgb['red']);
			$g = dechex($rgb['green']);
			$b = dechex($rgb['blue']);
			return '#'.((strlen($r) >= 2)? $r : '0'.$r).((strlen($g) >= 2)? $g : '0'.$g).((strlen($b) >= 2)? $b : '0'.$b); 
		}
		
		public static function hex2rgb($hex){
			if(!ereg("[0-9a-fA-F]{6}", $hex)) { 
				return array('red' => 0, 'green' => 0, 'blue' => 0);
			}
			$int = hexdec($hex);
			return array('red' => 0xFF & ($int >> 0x10), 'green' => 0xFF & ($int >> 0x8), 'blue' => 0xFF & $int);
		}
		
		public static function hsl2hex($hsl){
			return ColorsUtility::rgb2hex(ColorsUtility::hsl2rgb($hsl));
		}
		
		public static function hex2hsl($hex){
			return ColorsUtility::rgb2hsl(ColorsUtility::hex2rgb($hex));
		}
		
		private static function _hue_rgb($v1,$v2,$vH) {
			if($vH<0){
				++$vH;
			}
			if($vH>1){
				--$vH;
			}
			if(($vH*6)<1){
				return ($v1+($v2-$v1)*6*$vH);
			}
			if(($vH*2)<1){
				return $v2;
			}
			if(($vH*3)<2){
				return ($v1+($v2-$v1)*((2/3)-$vH)*6);
			}
			return $v1;
		}
	}
?>