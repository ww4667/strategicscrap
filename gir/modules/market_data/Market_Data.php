<?php 
/**
 * 
 * @author undead
 *
 */
class Market_Data extends Crud {
	
	protected $_OBJECT_NAME = "market_data";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"Symbol","field"=>"symbol"),
											array("type"=>"text","label"=>"Name","field"=>"name"),
											array("type"=>"text","label"=>"Month","field"=>"month"),
											array("type"=>"text","label"=>"Year","field"=>"year"),
											array("type"=>"text","label"=>"Exchange","field"=>"exchange"),
											array("type"=>"text","label"=>"Exchange Symbol","field"=>"exchange_symbol"),
											array("type"=>"text","label"=>"Type","field"=>"type"),
											array("type"=>"date","label"=>"Date","field"=>"date"),
											array("type"=>"text","label"=>"Open","field"=>"open"),
											array("type"=>"text","label"=>"High","field"=>"high"),
											array("type"=>"text","label"=>"Low","field"=>"low"),
											array("type"=>"text","label"=>"Last","field"=>"last"),
											array("type"=>"text","label"=>"Settle","field"=>"settle"),
											array("type"=>"text","label"=>"Volume","field"=>"volume"),
											array("type"=>"text","label"=>"Open Interest","field"=>"open_interest"),
											array("type"=>"text","label"=>"Previous Close","field"=>"previous_close"),
											array("type"=>"text","label"=>"Change","field"=>"change"),
											array("type"=>"text","label"=>"Percent Change","field"=>"percent_change"),
											array("type"=>"text","label"=>"Currency","field"=>"currency"),
											array("type"=>"text","label"=>"Raw Data","field"=>"raw_data")
											);
											
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
	/*
	 * public functions
	 */ 
	
	public function getBySymbol($symbol = null, $months = 1) {
		return $this->_getBySymbol($symbol, $months);
	}
	
	public function getLatestBySymbol($symbol = null) {
		return $this->_getLatestBySymbol($symbol);
	}
	
	public function addFromXML($symbol = null, $local = false) {
		return $this->_addFromXML($symbol, $local);
	}
	
	public function GetQuery( $query  ) {
		return $this->_getQuery( $query );
	}
	
	public function getHistoryBySymbolAndRange($symbol, $startDate = false, $endDate = false) {
		return $this->_getHistoryBySymbolAndRange( $symbol, $startDate, $endDate );
	}
	
	public function updateHistoryBySymbol($symbol = false) {
		return $this->_updateHistoryBySymbol($symbol);
	}

	public function addMarketData($data_array) {
		return $this->_addMarketData($data_array);
	}
	
	/*
	 * private functions
	 */
	
	private function _getBySymbol($symbol, $months) {
//		return data 
	}

	private function _getLatestBySymbol($symbol) {
//		return data 
 
		$query = $this->GetObjectQueryString();
		$sql = "SELECT * FROM(" . $query. ") as tb1 WHERE tb1.symbol = '" . $symbol . "' ORDER BY tb1.date DESC LIMIT 1";

		$items = $this->getQuery($sql);
		
		if($items){
			return $items;
		} else {
			return false;
		}
		
	}
	private function _addFromXML($symbol, $local) {
		if($local){
//			sample file name: GetHistoricalCommodityRange-LAM.xml
			$filename = "resources/market_data/xml/GetHistoricalCommodityRange-" . $symbol . ".xml";
			$xml = simplexml_load_file($filename) or die("feed not loading");
			$this->PTS($xml,"XML DATA: ");
			$quotes = $xml->xpath("Quotes");
			$this->CreateItem();
//			something from a local file based on symbol
		} else {
//			something from the remote call
		}
	}

	private function _getHistoryBySymbolAndRange($symbol, $startDate = false, $endDate = false) {
		$startDate = ($startDate) ? date('m/d/Y', strtotime($startDate)) : date('m/d/Y') ; 
		$endDate = ($endDate) ? date('m/d/Y', strtotime($endDate)) : date('m/d/Y') ; 

//		http://xignite.com/xFutures.asmx/GetHistoricalCommodityRange?Symbol=LLD&StartDate=11/06/2011&EndDate=11/30/2011
		
		// define the SOAP client using the url for the service
//		$xignite_header = new SoapHeader('http://www.xignite.com/services/', 'Header', array("Username" => "FDFDBEAF9B004b2eBB2D7A9D1D39F24F"));
		$xignite_header = new SoapHeader('http://www.xignite.com/services/', 'Header', array("Username" => "greg@slashwebstudios.com"));
		$client = new soapclient('http://www.xignite.com/xFutures.asmx?WSDL', array('trace' => 1));
		$client->__setSoapHeaders(array($xignite_header));
		
		// create an array of parameters 
		$param = array(
		               'Symbol' => $symbol,
		               'StartDate' => $startDate,
		               'EndDate' => $endDate);
		
		// call the service, passing the parameters and the name of the operation 
		$result = $client->GetHistoricalCommodityRange($param);
		// assess the results 
		if ( is_soap_fault($result) || $result->GetHistoricalCommodityRangeResult->Outcome != "Success" ) {
//		     echo '<h2>Fault</h2><pre>';
//		     print_r($result);
//		     echo '</pre>';
			return false;
		} else {
//		     echo '<h2>Result</h2><pre>';
//		     print_r($result);
//		     print_r($result->GetHistoricalCommodityRangeResult->Quotes->FutureQuote);
//		     echo '</pre>';
			$data = $result->GetHistoricalCommodityRangeResult->Quotes->FutureQuote;
			$output = array();
			is_array($data) ? $output = $data : $output[] = $data; 
			return $output;
		}
		// print the SOAP request 
//		echo '<h2>Request</h2><pre>' . htmlspecialchars($client->__getLastRequest(), ENT_QUOTES) . '</pre>';
		// print the SOAP request Headers 
//		echo '<h2>Request Headers</h2><pre>' . htmlspecialchars($client->__getLastRequestHeaders(), ENT_QUOTES) . '</pre>';
		// print the SOAP response 
//		echo '<h2>Response</h2><pre>' . htmlspecialchars($client->__getLastResponse(), ENT_QUOTES) . '</pre>';
	}
	
	private function _updateHistoryBySymbol($symbol = false) {
		if (!$symbol) {
			return false;
		}
		// check last record for given symbol -- it must be in the DB
		$query = $this->GetObjectQueryString();
		$query .= " ORDER BY o.id desc";
		$query = "SELECT `date` FROM (" . $query . ") t" .
			" WHERE symbol = '" . $symbol . "'" .
			" LIMIT 1";
		$results = $this->Query($query, true);
		$last_date = $results[0]['date'];
		// lets grab more than enough data -- remember the "ZEROS" fiasco...
		$startDate = date('m/d/Y',strtotime($last_date . "-14 days"));
		$market_data = $this->_getHistoryBySymbolAndRange($symbol,$startDate);
		if (empty($market_data)) {
			return "nothing to update";
		}
		$data_array = array();
		foreach($market_data as $d) {
			if ( strtotime($last_date) < strtotime($d->Date) ) {
				$data_array[] = $d;
			}
		}
		if (empty($data_array)) {
			return "nothing updated";
		}
		return $this->_addMarketData($data_array);
	}
	
	private function _addMarketData($data_array = false) {
		if( !$data_array || !is_array($data_array) ) {
			return false;
		}
		$data_array = array_reverse($data_array);
		$history_data = array();
		foreach ($data_array as $quote) {
			
			$raw = json_encode($quote, true);
			
			$tmp_data = array();
			$quote = (array) $quote;
			$quote = (object) $quote;
			$future = (array) $quote->Future;
			$future = (object) $future;
			
			// detect exchange for conversion to lbs from metric tons
			$lme = false;
			if($future->Exchange == "LME") {
				$lme = true;
				$conversion_factor = 2204.62262;
			}
			
			$tmp_data["symbol"] = $future->Symbol;
			$tmp_data["name"] = $future->Name;
			$tmp_data["month"] = $future->Month;
			$tmp_data["year"] = $future->Year;
			$tmp_data["exchange"] = $future->Exchange;
			$tmp_data["exchange_symbol"] = $future->ExchangeSymbol;
			$tmp_data["type"] = $future->Type;
			$tmp_data["date"] = date("Y-m-d", strtotime($quote->Date));
			$tmp_data["open"] = ($lme && $quote->Open != 0)
				? (float) number_format($quote->Open/$conversion_factor, 4)
				: $quote->Open;
			$tmp_data["high"] = ($lme && $quote->High != 0)
				? (float) number_format($quote->High/$conversion_factor, 4)
				: $quote->High;
			$tmp_data["low"] = ($lme && $quote->Low != 0)
				? (float) number_format($quote->Low/$conversion_factor, 4)
				: $quote->Low;
			$tmp_data["last"] = ($lme && $quote->Last != 0)
				? (float) number_format($quote->Last/$conversion_factor, 4)
				: $quote->Last;
			$tmp_data["settle"] = ($lme && $quote->Settle != 0)
				? (float) number_format($quote->Settle/$conversion_factor, 4)
				: $quote->Settle;
			$tmp_data["volume"] = $quote->Volume;
			$tmp_data["open_interest"] = $quote->OpenInterest;
			$tmp_data["previous_close"] = ($lme && $quote->PreviousClose != 0)
				? (float) number_format($quote->PreviousClose/$conversion_factor, 4)
				: $quote->PreviousClose;
			$tmp_data["change"] = ($lme && $quote->Change != 0)
				? (float) number_format($quote->Change/$conversion_factor, 4)
				: $quote->Change;
			$tmp_data["percent_change"] = $quote->PercentChange;
			$tmp_data["currency"] = $quote->Currency;
			$tmp_data["raw_data"] = $raw;
			
			if ( $quote->PreviousClose > 0 ) {
				$history_data[] = $tmp_data;
			}
		}
		$data_count = count($history_data);
		$count = 0;
		$array_chunks = array_chunk($history_data, 1000);
		set_time_limit(30 + (($data_count / 500) * 30));
		if (empty($history_data)){
			return false;
		}
		foreach($array_chunks as $d){
			$this->CreateItems($d);				
//			echo "<br />Process record chunk - "	 . $count;
			$count++;
		}
		return $data_count;
	}
	
    private function _getQuery( $query ) {
        	
			$arr1 = $this->Query($query, true);
			
		if (empty($arr1))
			return false;
		return $arr1;
    }
}
?>