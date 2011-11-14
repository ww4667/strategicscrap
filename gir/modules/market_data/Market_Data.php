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
											array("type"=>"text","label"=>"Currency","field"=>"currency")
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
	
	public function addFromXML($symbol = null, $local = false) {
		return $this->_addFromXML($symbol, $local);
	}
	
	/*
	 * private functions
	 */
	
	private function _getBySymbol($symbol, $months) {
//		return data 
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
}
?>