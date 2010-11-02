<?php 
/**
 * 
 * @author undead
 *
 */
class Facility extends Crud {
	 
	protected $_OBJECT_NAME = "facility";
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
											array("type"=>"text","label"=>"Material Join","field"=>"material_join")
										);
	
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
	public function addMaterial( $materialId = null ){
		$item = $this->GetCurrentItem();
		$material = $this->GetItem($materialId);
		$this->SetCurrentItem($item); // need to reset Current item back to the facility
		if(count($material)>0){
			$material_join_property = null;
			$arr = $this->_OBJECT_PROPERTIES;
			$c = count($this->_OBJECT_PROPERTIES);
			$i = 0;
			while($i<$c){
				if( $arr[$i]['field'] == "material_join" ){
					$material_join_property = $arr[$i]['property_name_id'];
					break;
				}
				$i++;
			}
			$this->AddValueJoin($item['id'], $material_join_property, $materialId);
		}
		
	}
	
	public function removeMaterial( $materialId = null ){
		$material = $this->ReadObjectById($materialId);
		if(count($material)>0){
			$item = $this->GetCurrentItem();
			$this->RemoveValueJoin($item['id'], $materialId);
		}
		
	}
	
	public function getMaterials( $itemId = null ) {
		// get materials by "itemId" and join type "material_join"
		$item = $this->GetCurrentItem();
		$itemId = $item['id'];
		$material = new Material();
		$joins = $this->ReadJoins( $material );
//		if (count($joins) > 0) {
//			$objs = array();
//			foreach ($joins as $item) {
//				$obj = clone $material;
//				foreach ($item as $key => $val) {
//					$obj->$key = $val;
//				}
//				$objs[] = $obj;
//			}
//			$this->material_join = $objs;
//		} else {
//			return FALSE;
//		}
		$this->material_join = $joins;
	}
	
	public function getFacilitiesByMaterialId( $materialId ) {
		// get facilities by materialId and join type "material_join"
		$m = new Material();
		$material = $m->GetItemObj( $materialId );
		$items = $this->ReadForeignJoins( $material );
		return $items;
	}
}
?>