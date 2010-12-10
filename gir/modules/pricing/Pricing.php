<?php 
/**
 * 
 * @author undead
 *
 */
class Pricing extends Crud {
	 
	protected $_OBJECT_NAME = "pricing";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(
											array("type"=>"text","label"=>"Region","field"=>"region"),
											array("type"=>"text","label"=>"Price","field"=>"price"),
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
	
	public function getPricingByRegion( $region = null ){
		return $this->GetItemsByPropertyValue("region", $region);
	}
	
	public function getAllPricing(){
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
}
?>