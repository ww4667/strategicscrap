<?php 
/**
 * 
 * @author undead
 *
 */
class Regional_Data extends Crud {
	 
	protected $_OBJECT_NAME = "regional_data";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(
											array("type"=>"text","label"=>"Region","field"=>"region"),
											array("type"=>"text","label"=>"Price","field"=>"price"),
											array("type"=>"text","label"=>"Broker Price","field"=>"broker_price"),
											array("type"=>"text","label"=>"Export Price","field"=>"export_price"),
											array("type"=>"number","label"=>"Month","field"=>"month"),
											array("type"=>"number","label"=>"year","field"=>"year"),
											array("type"=>"join","label"=>"Material Join","field"=>"join_material")
										);
	
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
	public function addMaterial( $materialId = null ){
		return $this->AddJoin( $materialId, "join_material" );
	}
	
	
	public function getAllRegionalData(){
		return $this->GetAllItemsObj();
	}
		
	public function getMaterials( $itemId = null ) {
		// get materials by "itemId" and join type "join_material"
		$item = $this->GetCurrentItem();
		$itemId = isset($itemId) ? $itemId : $item['id'];
		$material = new Material();
		$joins = $this->ReadJoins( $material );
		$this->join_material = $joins;
	}
	
	public function getRegionalDataByMonthYear($region, $month, $year){
		return $this->_getRegionalDataByMonthYear($region, $month, $year);
	}

	public function getRegionalDataByRegion( $region = null ){
		return $this->_getRegionalDataByRegion( $region);
	}
	public function getRegionalDataGrouped(){
		return $this->_getRegionalDataGrouped();
	}
	
	/**** Private Functions ***/
	
	private function _getRegionalDataByMonthYear($region, $month, $year){
		$items = $this->QueryObjectItems(" ( region = '" . $region  . "' AND month = '" . $month . "' AND year = '" . $year . "' ) " );
		return $items;
	}
	
	private function _getRegionalDataByRegion( $region ){
		$items = $this->QueryObjectItems(" region = '" . $region  . "' ORDER BY year DESC, month DESC " );
		return $items;
	}
	

	private function _getRegionalDataGrouped( ){
		$items = $this->QueryObjectItems(" id > 0 GROUP BY region, year, month  ORDER BY year DESC, month DESC " );
		return $items;
	}
	
}
?>