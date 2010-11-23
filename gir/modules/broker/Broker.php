<?php 
/**
 *
 * @author undead
 *
 */
 
class Broker extends User {

	protected $_OBJECT_NAME = "broker";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"join","label"=>"User Join","field"=>"join_user"),
											array("type"=>"text","label"=>"First Name","field"=>"first_name"),
											array("type"=>"text","label"=>"Last Name","field"=>"last_name"),
											array("type"=>"text","label"=>"Mobile Phone","field"=>"mobile_phone"),
											array("type"=>"text","label"=>"Home Phone","field"=>"home_phone"),
											array("type"=>"text","label"=>"Work Phone","field"=>"work_phone"),
											array("type"=>"text","label"=>"Address 1","field"=>"address_1"),
											array("type"=>"text","label"=>"Address 2","field"=>"address_2"),
											array("type"=>"text","label"=>"City","field"=>"city"),
											array("type"=>"text","label"=>"State/Province","field"=>"state_province"),
											array("type"=>"text","label"=>"Postal Code","field"=>"postal_code"),
											array("type"=>"text","label"=>"Country","field"=>"country"),
											array("type"=>"text","label"=>"Notes","field"=>"notes"),
											array("type"=>"text","label"=>"Account Settings","field"=>"account_settings")
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
		$user = $this->GetItem($userId);
		$this->SetCurrentItem($item); // need to reset Current item back to the facility
		if(count($user)>0){
			$user_join_property = null;
			$arr = $this->_OBJECT_PROPERTIES;
			$c = count($this->_OBJECT_PROPERTIES);
			$i = 0;
			while($i<$c){
				if( $arr[$i]['field'] == "join_user" ){
					$user_join_property = $arr[$i]['property_name_id'];
					break;
				}
				$i++;
			}
			$this->AddValueJoin($item['id'], $user_join_property, $userId);
		}
	}
	
	public function removeUser( $userId = null ){
		$user = $this->ReadObjectById($userId);
		if(count($user)>0){
			$item = $this->GetCurrentItem();
			$this->RemoveValueJoin($item['id'], $userId);
		}
	}
    
	/*
	 * PRIVATE FUNCTIONS
	 */
    private function _privateFunction() {
    }
}
?>