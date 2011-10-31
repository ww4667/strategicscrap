<?php 
/**
 * 
 * @author undead
 *
 */
class Market_Data extends Crud {
	
	protected $_OBJECT_NAME = "market_data";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"number","label"=>"Material","field"=>"material"),
											array("type"=>"date","label"=>"Date","field"=>"date")
											);
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
	public function getHistory($months = "1", $years = "0") {
		escape;
	}
}
?>