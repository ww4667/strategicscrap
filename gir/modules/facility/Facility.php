<?php 
/**
 * 
 * @author undead
 *
 */
class Facility extends Crud {
	 
	protected $_OBJECT_NAME = "facility";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"Company","field"=>"company"),
											array("type"=>"text","label"=>"Last Name","field"=>"last_name"),
											array("type"=>"text","label"=>"First Name","field"=>"first_name"),
											array("type"=>"text","label"=>"E-mail","field"=>"email"),
											array("type"=>"text","label"=>"Job Title","field"=>"job_title"),
											array("type"=>"text","label"=>"Business Phone","field"=>"business_phone"),
											array("type"=>"text","label"=>"Home Phone","field"=>"home_phone"),
											array("type"=>"text","label"=>"Mobile Phone","field"=>"mobile_phone"),
											array("type"=>"text","label"=>"Fax Number","field"=>"fax_number"),
											array("type"=>"text","label"=>"Address 1","field"=>"address_1"),
											array("type"=>"text","label"=>"Address 2","field"=>"address_2"),
											array("type"=>"text","label"=>"City","field"=>"city"),
											array("type"=>"text","label"=>"State/Province","field"=>"state_province"),
											array("type"=>"text","label"=>"Zip/Postal Code","field"=>"zip_postal_code"),
											array("type"=>"text","label"=>"Region","field"=>"region"),
											array("type"=>"text","label"=>"Country","field"=>"country"),
											array("type"=>"text","label"=>"Latitude","field"=>"lat"),
											array("type"=>"text","label"=>"Longitude","field"=>"lon"),
											array("type"=>"text","label"=>"Website","field"=>"website"),
											array("type"=>"text","label"=>"Notes","field"=>"notes"),
											array("type"=>"text","label"=>"Attachments","field"=>"attachments"),
											array("type"=>"text","label"=>"Category","field"=>"category"),
											array("type"=>"text","label"=>"Broker Exclusive","field"=>"broker_exclusive"),
											array("type"=>"join","label"=>"Join Material","field"=>"join_material")
										);
	
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
	public function addMaterial( $materialId = null ){
		$this->AddJoin( $materialId, "join_material" );
	}
	
	public function removeMaterial( $materialId = null ){
		$this->RemoveJoin( $materialId, "join_material" );
	}
	
	public function getMaterials( $itemId = null ) {
		// get materials by "itemId" and join type "material_join"
		$item = $this->GetCurrentItem();
		$itemId = isset($itemId) ? $itemId : $item['id'];
		$material = new Material();
		$joins = $this->ReadJoins( $material );
		$this->join_material = $joins;
	}
	
	public function getFacilitiesByMaterialId( $materialId ) {
		// get facilities by materialId and join type "material_join"
		$m = new Material();
		$material = $m->GetItemObj( $materialId );
		$items = $this->ReadForeignJoins( $material );
		return $items;
	}
		
	/** 
	* return a region based on state abreviation
	*/
	public function setRegion( $state ) {
		$south = array("TX","OK","AR","LA","MS");
		$central = array("IA","MN","KS","IL","MO","SD","ND","WI","NE");
		$northeast = array();
		$southeast = array("TN","FL","NC","SC","AL","GA");
		$west = array("CA","NM","AZ","ID","MT","NV","OR","WA","WY","UT","CO");
		$region = "";
		if(in_array($i_state, $south))$region = "S";
		if(in_array($i_state, $west))$region = "W";
		if(in_array($i_state, $central))$region = "C";
		if(in_array($i_state, $southeast))$region = "SE";
		if($region == "")$region = "NE";
		
		return $region;
	}
}
?>