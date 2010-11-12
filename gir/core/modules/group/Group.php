<?php 
/**
 *
 * @author undead
 *
 */
 
class Group extends Crud {

    private $_GROUP_ID = null;
    private $_NAME = null;
	
	protected $_OBJECT_NAME = "gir_group";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"Group Name","field"=>"name"),
											array("type"=>"text","label"=>"Description","field"=>"description"),
											array("type"=>"text","label"=>"User Join","field"=>"user_join")
										);
	
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
	/*
	 * PUBLIC FUNCTIONS
	 */
	public function addUser( $userId = null ){
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
	
	public function removeUser( $userId = null ){
		$material = $this->ReadObjectById($materialId);
		if(count($material)>0){
			$item = $this->GetCurrentItem();
			$this->RemoveValueJoin($item['id'], $materialId);
		}
		
	}
    
	/*
	 * PRIVATE FUNCTIONS
	 */
    private function _privateFunction() {
    }
}
?>