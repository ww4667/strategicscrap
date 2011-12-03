<?php
if(!isset($_SESSION)){
	session_start();
}

require_once($_SERVER['DOCUMENT_ROOT']."/gir/index.php");
//$auth = new Auth();

//$KILL = FALSE;
//
//while (!$KILL) {

switch($method){

	/* insert market data form xml **************************************** * /
	case 'insert-data':
		$m = new Market_Data();
		$do_it = (isset($_GET['do_it'])) ? $_GET['do_it'] : null;
		$symbol = (isset($_GET['symbol'])) ? $_GET['symbol'] : null;
		$symbols = array("HG", "LAA", "LAM", "LCU", "LLD", "LNI","LTN","LZZ");
		if ( $symbol ) {
			//foreach($symbols as $symbol){
				$history_data = array();
	//			sample file name: GetHistoricalCommodityRange-LAM.xml
				$filename = $_SERVER['DOCUMENT_ROOT']."/resources/market_data/xml/GetHistoricalCommodityRange-" . $symbol . ".xml";
				$xml = simplexml_load_file($filename) or die("feed not loading");
				$data =  $xml->xpath("FutureQuotes");
				foreach ($xml->Quotes->FutureQuote as $quote) {
					
					$tmp_data = array();
					$quote = (array) $quote;
					$quote = (object) $quote;
					$future = (array) $quote->Future;
					$future = (object) $future;
					
					$tmp_data["symbol"] = $future->Symbol;
					$tmp_data["name"] = $future->Name;
					$tmp_data["month"] = $future->Month;
					$tmp_data["year"] = $future->Year;
					$tmp_data["exchange"] = $future->Exchange;
					$tmp_data["exchange_symbol"] = $future->ExchangeSymbol;
					$tmp_data["type"] = $future->Type;
					$tmp_data["date"] = date("Y-m-d", strtotime($quote->Date));
					$tmp_data["open"] = $quote->Open;
					$tmp_data["high"] = $quote->High;
					$tmp_data["low"] = $quote->Low;
					$tmp_data["last"] = $quote->Last;
					$tmp_data["settle"] = $quote->Settle;
					$tmp_data["volume"] = $quote->Volume;
					$tmp_data["open_interest"] = $quote->OpenInterest;
					$tmp_data["previous_close"] = $quote->PreviousClose;
					$tmp_data["change"] = $quote->Change;
					$tmp_data["percent_change"] = $quote->PercentChange;
					$tmp_data["currency"] = $quote->Currency;
					
					 // echo "QUOTE: <br /><pre>";
					 // print_r($tmp_data);
					 // echo "</pre>";
					$history_data[] = $tmp_data;
				}
	
					$data_count = count($history_data);
					$count = 0;
					$array_chunks = array_chunk($history_data, 1000);
					set_time_limit(30 + (($data_count / 500) * 30));
					foreach($array_chunks as $d){
						$m->CreateItems($d);				
						echo "<br />Process record chunk - "	 . $count;
						$count++;
					}
			//}
		}
		break;
   / *  Closing comment to comnet out insert-data function */
	/* get market history data  **************************************** */
	case 'history-data':
		
		$temp_time_start = microtime(true);
		$m = new Market_Data();
		$symbol = (isset($_GET['symbol'])) ? $_GET['symbol'] : null;
		$begin = (isset($_GET['begin'])) ? $_GET['begin'] : date("Y-m-d");
		$offset = 0;
		
		$today = ($begin)? date("Y-m-d", strtotime($begin)) : date("Y-m-d");
		$start_date =  mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
		if($start_date - strtotime($begin) > 0){
			$offset = ($start_date - strtotime($begin)) / 86400;
		}
		$end_days = array(30,60,90,365,730);
		$end_days_extra = array(37,67,97,372,737);
		$tick_interval = array(5,10,15,60,120);
		$compare_dates = array();
		$tick_dates = array();
		$data_points = array();
		$tick_y = array();
		$count = 0;
		
		error_log(' building query: ' . (microtime(true) - $temp_time_start) . ' seconds so far . . .');
		foreach($end_days as $d){
			$tmp_ticks = array();
			$end_date =  mktime(0, 0, 0, date("m")  , date("d") - $d - $offset, date("Y"));
			$end_date_extra =  mktime(0, 0, 0, date("m")  , date("d") - $end_days_extra[$count] - $offset, date("Y"));
			$compare_dates[] = date("Y-m-d",$end_date_extra);
			// echo "<br /> Start Date  : " . $start_date;
			// echo "<br /> End Date : " . $end_date;
			// echo "<br /> Tick Interval : " . $tick_interval[$count];
			// echo "<br /> Offset : " . $offset;
			
			$i = $start_date - ($offset * 86400);
			while($i >= $end_date ){
				//echo "<br /> " . $i;
				$tmp_ticks[] = date("j-M-y", $i);
				$i = $i - (($tick_interval[$count] ) * 86400);
			}
			$tick_dates[] = array_reverse($tmp_ticks);
			$count++;
		}
		
		//	$m->PTS($compare_dates, "compare dates");
		// 	$m->PTS($tick_dates, "tick dates");
		 
		$query = $m->GetObjectQueryString();
		$query1 = "";
		$count = 0;
		$sql = "SELECT * FROM(" . $query. ") as tb1 WHERE tb1.date > '" . $compare_dates[4] . "' AND tb1.symbol = '" . $symbol . "' ORDER BY tb1.date ASC";
//		echo "<br /><br /><br />" . $sql;
//		die();

		error_log(' query built: ' . (microtime(true) - $temp_time_start) . ' seconds so far . . .');
		$items = $m->getQuery($sql);
		error_log('after query: ' . (microtime(true) - $temp_time_start) . ' seconds so far . . .');
		
		foreach($compare_dates as $c){
			$tmp_points = array();
			$settle_high = 0;
			$settle_low = 100;
			$i_count = 1;
			if($items){
				$history_default = $items[0];
				foreach($items as $h){
					if(strtotime($h["date"]) >= strtotime($c)){
						//echo "<br />before function" . $h["settle"];
//						if($symbol != "HG"){
//							$h["settle"] = ($h["settle"]/2204.62262);
//						//	echo "<br />after function" . $h["settle"];
//						}
						
						switch($count){
							case 3:
								if($i_count%2 == 0)
									$tmp_points[] = array(date("j-M-y", strtotime($h["date"])), number_format($h["settle"], 2) );
								
								break;
							case 4:
								if($i_count%3 == 0)
									$tmp_points[] = array(date("j-M-y", strtotime($h["date"])), number_format($h["settle"], 2) );
								
								break;
							default:
								$tmp_points[] = array(date("j-M-y", strtotime($h["date"])), number_format($h["settle"], 2) );
								break;
						}
						
						if($settle_high < $h["settle"]){
								//echo "<br />High - " . $h["settle"];
							$settle_high = ceil($h["settle"]);
						}
						
						if($settle_low > $h["settle"]){
								//echo "<br />Low - " . $h["settle"];
							$settle_low = floor($h["settle"]);
						}
					}
					
					$i_count++;
				}
			}
			$difference = $settle_high - $settle_low;
			$adjust = $difference / 4;
			
			$data_points[] = $tmp_points;
			$tick_y[] = array($settle_low, $settle_low + $adjust, $settle_low + ($adjust * 2), $settle_low + ($adjust * 3),$settle_high);
			$count++;
		}
		
		 //$m->PTS($data_points, "data points");
		 
		 $json_data = array();
		 $the_json = array();
		 
		 $tmp_json_string = "";
		 for($i = 0; $i < 5; $i++){
		 	$tmp_json = new stdClass;
			$tmp_json->points		= $data_points[$i];
			$tmp_json->xticks		= $tick_dates[$i];
			$tmp_json->yticks		= $tick_y[$i];
		 	array_push($json_data, $tmp_json);
		 }
		//$m->PTS($json_data);
		$the_json["data"] = $json_data;
		//$json_data = (object) $json_data;
		$the_json = json_encode($the_json);
		$the_json = str_replace("[[", "[ [", $the_json);
		$the_json = str_replace("]]", "] ]", $the_json);
		 
		$market_data 			=  $history_default;
		$market_data["json"] 	=  $the_json;
		
		
		$PAGE_BODY = $_SERVER['DOCUMENT_ROOT']."/views/market_data/market_history.php";  	/* which file to pull into the template */
		require($_SERVER['DOCUMENT_ROOT']."/views/layouts/shell.php");
			
		break;

	}
?>