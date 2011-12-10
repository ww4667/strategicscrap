<?php
if(!isset($_SESSION)){
	session_start();
}

//if ($_GET['zip']) {
//	$postal_code = $_GET['zip'];
//	$request_url = "http://weather.yahooapis.com/forecastrss?p=" . $postal_code . "&u=f";
//	$xml = simplexml_load_file($request_url) or die("feed not loading");
//
//	$channel_yweather = $xml->channel->children("http://xml.weather.yahoo.com/ns/rss/1.0");
//
//	foreach($channel_yweather as $x => $channel_item) 
//		foreach($channel_item->attributes() as $k => $attr) 
//			$yw_channel[$x][$k] = $attr;
//	
//	$item_yweather = $xml->channel->item->children("http://xml.weather.yahoo.com/ns/rss/1.0");
//
//	foreach($item_yweather as $x => $yw_item) {
//		foreach($yw_item->attributes() as $k => $attr) {
//			if($k == 'day') $day = $attr;
//			if($x == 'forecast') { $yw_forecast[$x][$day . ''][$k] = $attr;	} 
//			else { $yw_forecast[$x][$k] = $attr; }
//		}
//	}
//	
//	$weather_location = $yw_channel['location']['city'][0] . ", " . $yw_channel['location']['region'][0] . " (" . $postal_code . ")";
//	
//	// see the output!
//	echo "<pre>";
//	echo $weather_location;
//	echo "<br />";
//	echo "<br />";
//	print_r($yw_channel);
//	print_r($yw_forecast);
//	echo "</pre>";
//}

//if ($_GET['symbol']) {
//	$symbol = $_GET['symbol'];
//	//			sample file name: GetHistoricalCommodityRange-LAM.xml
//				$filename = "resources/market_data/xml/GetHistoricalCommodityRange-" . $symbol . ".xml";
//				$xml = simplexml_load_file($filename) or die("feed not loading");
//				$data =  $xml->xpath("FutureQuotes");
//				foreach ($xml->Quotes->FutureQuote as $quote) {
//					echo "QUOTE: <br />";
//					print_r($quote);
//				}
//				// sort out the data
//				
//	//			while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
//	//				($count == 0 ) ? $field_names = $data : $the_data[] = $data;
//	//				$count++;
//	//			}
//	//			for ($i = 0; $i <= (count($the_data) - 1); $i++){
//	//				for ($x = 0; $x <= (count($the_data[$i]) - 1); $x++){
//	//			        $clean = trim($the_data[$i][$x]);
//	//			        $clean_data[$field_names[$x]] = $clean;
//	//			      }
//	//				//$r->PTS($clean_data);
//	//				
//	//				$clean_data['report_id'] = preg_replace('/[A-Za-z]*/', '', $clean_data['order_number']);
//	//				$item_data[] = $clean_data;
//	//				$data_count++;
//	//				
//	//				$clean_data = "";
//	//			}
//	//			
//	//				//$r->PTS($item_data[]);
//	//				
//	//				$array_chunks = array_chunk($item_data, 5000);
//	//				set_time_limit(30 + (($data_count / 5000) * 30));
//	//				foreach($array_chunks as $data){
//	//					$r->CreateItems($data);					
//	//				}
//				
//				
//				
//				// lets build a nice little query now...
//				
//				
//				die();
//				$quotes = $xml->xpath("Quotes");
//}

//if ($_GET['market_data_test']) {
//	include('gir/index.php');
//	$startDate = isset($_GET['startDate']) ? date('m/d/Y', strtotime($_GET['startDate'])) : date('m/d/Y') ; 
//	$endDate = isset($_GET['endDate']) ? date('m/d/Y', strtotime($_GET['endDate'])) : date('m/d/Y') ;
//	$md = new Market_Data();
//	$results = $md->getHistoryBySymbolAndRange($_GET['symbol'],$startDate,$endDate);
//	if (isset($_GET['go'])) {
//		$md->addMarketData($results);
//	} else {
//		echo "<pre>";
//		print_r($results);
//		echo "</pre>";
//	}
//}

if ($_GET['update_market_data']) {
	include('gir/index.php');
	$md = new Market_Data();
	echo $md->updateHistoryBySymbol($_GET['symbol']);
}
?>