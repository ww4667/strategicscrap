<?php
function logger($msg){
    $logging=true;
    if($logging){
        error_log($msg);
    }
}

function isValidEmail($email){
    return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}

function isZip($s){
    if(preg_match('/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/',$s)){
        return true;
    }else{
        return false;
    }
}

function clean_word_formatting($string){
    //converts smart quotes to normal quotes.
    $search = array(chr(145), chr(146), chr(147), chr(148), chr(151));
    $replace = array("'", "'", '"', '"', '-');
    return str_replace($search, $replace, $string);
}

function static_form_field($GET_VAL){
    if(isset($_GET[$GET_VAL])){ return urldecode($_GET[$GET_VAL]); }
}
function static_form_field_session($SES_VAL){
    if(isset($_SESSION[$SES_VAL])){ return urldecode($_GET[$SES_VAL]); }
}
function static_form_field_cookie($VAL){
    if(isset($_COOKIE[$VAL])){ return urldecode($_COOKIE[$VAL]); }
}
function set_static_form_field_cookie_from_post($value,$post){
    setcookie($value, $post[$value], time()+3600);
}

function flash($message,$type='good'){
	$_SESSION['flash'] = $message;
	if($type!='good'){
		$_SESSION['flashtype'] = 'bad';
	}else{
		$_SESSION['flashtype'] = 'good';
	}
}

function clear_flash(){
	unset($_SESSION['flash']);
	unset($_SESSION['flashtype']);
}

// Original PHP code by Chirp Internet: www.chirp.com.au // Please acknowledge use of this code by including this header.
function truncate($string, $limit, $break=".", $pad="...") {
    // return with no change if string is shorter than $limit
    if(strlen($string) <= $limit) return $string;
    // is $break present between $limit and the end of the string?
    if(false !== ($breakpoint = strpos($string, $break, $limit))) { if($breakpoint < strlen($string) - 1) { $string = substr($string, 0, $breakpoint) . $pad; } } return $string;
}

function distanceOfTimeInWords($from_time, $to_time = 0, $include_seconds = false) {
    $distance_in_minutes = round(abs($to_time - $from_time) / 60);
    $distance_in_seconds = round(abs($to_time - $from_time));
    if ($distance_in_minutes >= 0 and $distance_in_minutes <= 1) {
        if (!$include_seconds) {
            return ($distance_in_minutes == 0) ? 'less than a minute' : '1 minute';
        } else {
            if ($distance_in_seconds >= 0 and $distance_in_seconds <= 4) {
                return 'less than 5 seconds';
            } elseif ($distance_in_seconds >= 5 and $distance_in_seconds <= 9) {
                return 'less than 10 seconds';
            } elseif ($distance_in_seconds >= 10 and $distance_in_seconds <= 19) {
                return 'less than 20 seconds';
            } elseif ($distance_in_seconds >= 20 and $distance_in_seconds <= 39) {
                return 'half a minute';
            } elseif ($distance_in_seconds >= 40 and $distance_in_seconds <= 59) {
                return 'less than a minute';
            } else {
                return '1 minute';
            }
        }
    } elseif ($distance_in_minutes >= 2 and $distance_in_minutes <= 44) {
        return $distance_in_minutes . ' minutes';
    } elseif ($distance_in_minutes >= 45 and $distance_in_minutes <= 89) {
        return 'about 1 hour';
    } elseif ($distance_in_minutes >= 90 and $distance_in_minutes <= 1439) {
        return 'about ' . round(floatval($distance_in_minutes) / 60.0) . ' hours';
    } elseif ($distance_in_minutes >= 1440 and $distance_in_minutes <= 2879) {
        return '1 day';
    } elseif ($distance_in_minutes >= 2880 and $distance_in_minutes <= 43199) {
        return 'about ' . round(floatval($distance_in_minutes) / 1440) . ' days';
    } elseif ($distance_in_minutes >= 43200 and $distance_in_minutes <= 86399) {
        return 'about 1 month';
    } elseif ($distance_in_minutes >= 86400 and $distance_in_minutes <= 525599) {
        return round(floatval($distance_in_minutes) / 43200) . ' months';
    } elseif ($distance_in_minutes >= 525600 and $distance_in_minutes <= 1051199) {
        return 'about 1 year';
    } else {
        return 'over ' . round(floatval($distance_in_minutes) / 525600) . ' years';
    }
}
function timeAgoInWords($from_time, $include_seconds = false) {
    return distanceOfTimeInWords($from_time, time(), $include_seconds);
}

function selected_value($val1, $val2){
    if($val1==$val2){
        return "selected='selected'";
    }
}

function days_select($name='date',$id='',$class='',$current_selected=false){
	$start=1;
	$end=31;
    $days = range($start,$end);
    $s = "<select name='$name' id='$id' class='$class'>";
    foreach ($days as $value) {
        if(date('d')==$value && $current_selected==true){
            if(strlen($value)==1){$value = '0'.$value;} //add a beginning zero if we need it
            $s .= '<option value="'.$value.'" selected="selected">'.$value.'</option>';
        }else{
            if(strlen($value)==1){$value = '0'.$value;} //add a beginning zero if we need it
            $s .= '<option value="'.$value.'">'.$value.'</option>';
        }
    }
    $s .= "</select>";
    return $s;
}

function month_select($name='month',$id='',$class=''){
	
//  $months = array("12","11","10","09","08","07","06","05","04","03","02","01");
//  $months = array("01","02","03","04","05","06","07","08","09","10","11","12");
	
	$start=1;
	$end=12;
    $months = range($start,$end);
    $s="<select name='$name' id='$id' class='$class'>";
    foreach ($months as $value) {
        if(date('m')==$value){
            if(strlen($value)==1){$value = '0'.$value;} //add a beginning zero if we need it
            $s .= '<option value="'.$value.'">'.$value.'</option>';
//          $s .= '<option value="'.$value.'" selected="selected">'.$value.'</option>';
        }else{
            if(strlen($value)==1){$value = '0'.$value;} //add a beginning zero if we need it
            $s .= '<option value="'.$value.'">'.$value.'</option>';
        }
    }
    $s .= '</select>';
    return $s;
}

function year_select($start=2000,$end=2050,$name='year',$id='',$class=''){
    $years = range($start,$end);
    $s = "<select name='$name' id='$id' class='$class'>";
    foreach ($years as $value) {
        if(strlen($value)==1){$value = '0'.$value;} //add a beginning zero if we need it
        $s .=  '<option value="'.$value.'">'.$value.'</option>';
    }
    $s .= "</select>";
    return $s;
}

function state_select($display='abbr',$name='state',$id='',$class='',$active=''){
    $states_arr = array('AL'=>"Alabama",'AK'=>"Alaska",'AZ'=>"Arizona",'AR'=>"Arkansas",'CA'=>"California",'CO'=>"Colorado",'CT'=>"Connecticut",'DE'=>"Delaware",'DC'=>"District Of Columbia",'FL'=>"Florida",'GA'=>"Georgia",'HI'=>"Hawaii", 'IA'=>"Iowa", 'ID'=>"Idaho",'IL'=>"Illinois", 'IN'=>"Indiana", 'KS'=>"Kansas",'KY'=>"Kentucky",'LA'=>"Louisiana",'ME'=>"Maine",'MD'=>"Maryland", 'MA'=>"Massachusetts",'MI'=>"Michigan",'MN'=>"Minnesota",'MS'=>"Mississippi",'MO'=>"Missouri",'MT'=>"Montana",'NE'=>"Nebraska",'NV'=>"Nevada",'NH'=>"New Hampshire",'NJ'=>"New Jersey",'NM'=>"New Mexico",'NY'=>"New York",'NC'=>"North Carolina",'ND'=>"North Dakota",'OH'=>"Ohio",'OK'=>"Oklahoma", 'OR'=>"Oregon",'PA'=>"Pennsylvania",'RI'=>"Rhode Island",'SC'=>"South Carolina",'SD'=>"South Dakota",'TN'=>"Tennessee",'TX'=>"Texas",'UT'=>"Utah",'VT'=>"Vermont",'VA'=>"Virginia",'WA'=>"Washington",'WV'=>"West Virginia",'WI'=>"Wisconsin",'WY'=>"Wyoming");
    $string="<select name='$name' id='$id' class='$class'>\n";
	$string .= '<option value="">-- Select a State --</option>'."\n";
	foreach($states_arr as $k => $v){
		$s = ($active == $k)? ' selected="selected"' : '';
		if($display=='abbr'){
			$string .= '<option value="'.$k.'"'.$s.'>'.$k.'</option>'."\n";     
		}else{
			$string .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>'."\n";     
		}
    }
    $string .= '</select>';
	return $string;
}

function state_province_select($display='abbr',$name='state',$id='',$class='',$active=''){
    $us_states_arr = array("US-AL"=>"Alabama","US-AK"=>"Alaska","US-AZ"=>"Arizona","US-AR"=>"Arkansas","US-CA"=>"California","US-CO"=>"Colorado","US-CT"=>"Connecticut","US-DE"=>"Delaware","US-DC"=>"District Of Columbia","US-FL"=>"Florida","US-GA"=>"Georgia","US-HI"=>"Hawaii","US-IA"=>"Iowa","US-ID"=>"Idaho","US-IL"=>"Illinois","US-IN"=>"Indiana","US-KS"=>"Kansas","US-KY"=>"Kentucky","US-LA"=>"Louisiana","US-ME"=>"Maine","US-MD"=>"Maryland","US-MA"=>"Massachusetts","US-MI"=>"Michigan","US-MN"=>"Minnesota","US-MS"=>"Mississippi","US-MO"=>"Missouri","US-MT"=>"Montana","US-NE"=>"Nebraska","US-NV"=>"Nevada","US-NH"=>"New Hampshire","US-NJ"=>"New Jersey","US-NM"=>"New Mexico","US-NY"=>"New York","US-NC"=>"North Carolina","US-ND"=>"North Dakota","US-OH"=>"Ohio","US-OK"=>"Oklahoma","US-OR"=>"Oregon","US-PA"=>"Pennsylvania","US-RI"=>"Rhode Island","US-SC"=>"South Carolina","US-SD"=>"South Dakota","US-TN"=>"Tennessee","US-TX"=>"Texas","US-UT"=>"Utah","US-VT"=>"Vermont","US-VA"=>"Virginia","US-WA"=>"Washington","US-WV"=>"West Virginia","US-WI"=>"Wisconsin","US-WY"=>"Wyoming");
    $mx_states_arr = array("MX-AGU"=>"Aguascalientes","MX-BCN"=>"Baja California","MX-BCS"=>"Baja California Sur","MX-CAM"=>"Campeche","MX-CHP"=>"Chiapas","MX-CHH"=>"Chihuahua","MX-COA"=>"Coahuila","MX-COL"=>"Colima","MX-DIF"=>"Federal District","MX-DUR"=>"Durango","MX-GUA"=>"Guanajuato","MX-GRO"=>"Guerrero","MX-HID"=>"Hidalgo","MX-JAL"=>"Jalisco","MX-MEX"=>"Mexico State","MX-MIC"=>"Michoacán","MX-MOR"=>"Morelos","MX-NAY"=>"Nayarit","MX-NLE"=>"Nuevo León","MX-OAX"=>"Oaxaca","MX-PUE"=>"Puebla","MX-QUE"=>"Querétaro","MX-ROO"=>"Quintana Roo","MX-SLP"=>"San Luis Potosí","MX-SIN"=>"Sinaloa","MX-SON"=>"Sonora","MX-TAB"=>"Tabasco","MX-TAM"=>"Tamaulipas","MX-TLA"=>"Tlaxcala","MX-VER"=>"Veracruz","MX-YUC"=>"Yucatán","MX-ZAC"=>"Zacatecas");
    $ca_states_arr = array("CA-AB"=>"Alberta","CA-BC"=>"British Columbia","CA-MB"=>"Manitoba","CA-NB"=>"New Brunswick","CA-NL"=>"Newfoundland and Labrador","CA-NS"=>"Nova Scotia","CA-ON"=>"Ontario","CA-PE"=>"Prince Edward Island","CA-QC"=>"Quebec","CA-SK"=>"Saskatchewan","CA-NT"=>"Northwest Territories","CA-NU"=>"Nunavut","CA-YT"=>"Yukon Territory");
    $string="<select name='$name' id='$id' class='$class'>\n";
	$string .= '<option value="">-- Select One --</option>'."\n";
	$string .= '<optgroup label="United States">'."\n";     
	foreach($us_states_arr as $k => $v){
		$s = ($active == $k)? ' selected="selected"' : '';
		if($display=='abbr'){
			$string .= '<option value="'.$k.'"'.$s.'>'.$k.'</option>'."\n";     
		}else{
			$string .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>'."\n";     
		}
    }
	$string .= '</optgroup>'."\n";     
	$string .= '<optgroup label="Canada">'."\n";     
	foreach($ca_states_arr as $k => $v){
		$s = ($active == $k)? ' selected="selected"' : '';
		if($display=='abbr'){
			$string .= '<option value="'.$k.'"'.$s.'>'.$k.'</option>'."\n";     
		}else{
			$string .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>'."\n";     
		}
    }
	$string .= '</optgroup>'."\n";     
	$string .= '<optgroup label="Mexico">'."\n";     
	foreach($mx_states_arr as $k => $v){
		$s = ($active == $k)? ' selected="selected"' : '';
		if($display=='abbr'){
			$string .= '<option value="'.$k.'"'.$s.'>'.$k.'</option>'."\n";     
		}else{
			$string .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>'."\n";     
		}
    }
	$string .= '</optgroup>'."\n";     
    $string .= '</select>';
	return $string;
}

function require_ssl(){
    if(isset($_SERVER["HTTPS"])){
    if($_SERVER["HTTPS"] != "on") {
       header("HTTP/1.1 301 Moved Permanently");
       header("Location: https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
       exit();
    }
    }
}

function format_phone($phone){
    $phone = preg_replace("/[^0-9]/", "", $phone);
    if(strlen($phone) == 7)
        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
    elseif(strlen($phone) == 10)
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
    else
        return $phone;
}

function leading_zeros($value, $places){
// Function written by Marcus L. Griswold (vujsa)
// Can be found at http://www.handyphp.com
// Do not remove this header!
$leading = "";
    if(is_numeric($value)){
        for($x = 1; $x <= $places; $x++){
            $ceiling = pow(10, $x);
            if($value < $ceiling){
                $zeros = $places - $x;
                for($y = 1; $y <= $zeros; $y++){
                    $leading .= "0";
                }
            $x = $places + 1;
            }
        }
        $output = $leading . $value;
    }
    else{
        $output = $value;
    }
    return $output;
}

//==== Redirect... Try PHP header redirect, then Javascript redirect, then try http redirect.:
function redirect_to($url){
    if (!headers_sent()){    //If headers not sent yet... then do php redirect
        header('Location: '.$url); exit;
    }else{                    //If headers are sent... do javascript redirect... if java disabled, do html redirect.
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}//==== End -- Redirect
?>