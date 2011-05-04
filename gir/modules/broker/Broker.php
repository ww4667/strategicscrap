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
											array("type"=>"text","label"=>"Company","field"=>"company"),
											array("type"=>"text","label"=>"First Name","field"=>"first_name"),
											array("type"=>"text","label"=>"Last Name","field"=>"last_name"),
											array("type"=>"text","label"=>"Mobile Phone","field"=>"mobile_phone"),
											array("type"=>"text","label"=>"Home Phone","field"=>"home_phone"),
											array("type"=>"text","label"=>"Work Phone","field"=>"work_phone"),
											array("type"=>"text","label"=>"Fax Number","field"=>"fax_number"),
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
		
	public function getUsers( $itemId = null ) {
		// get materials by "itemId" and join type "material_join"
		$item = $this->GetCurrentItem();
		$itemId = $item['id'];
		$user = new User();
		$joins = $this->ReadJoins( $user );
		$this->join_user = $joins;
	}
	
	public function getBrokersByUserId( $userId ) {
		$u = new User();
		$user = $u->GetItemObj( $userId );
		if($user){
			$items = $this->ReadForeignJoins( $user );
			return $items;
		} else {
			return array();
		}
	}
	
	public function getBids( ){
		$broker_query = $this->GetObjectQueryString();
		$r = new Request();
		$b = new Bid();
		$bid_query = $b->GetObjectQueryString();
		$request_query = $r->GetObjectQueryString();
		$join_table = $this->_TABLE_PREFIX . constant('Crud::_VALUES_TABLE_JOINS');
		$query .= " SELECT r.request_snapshot,bd.*";
		$query .= " FROM";
		$query .= " ($request_query) AS r,";
		$query .= " ($broker_query) AS br,";
		$query .= " ($bid_query) AS bd,";
		$query .= " $join_table AS j1,";
		$query .= " $join_table AS j2";
		$query .= " WHERE bd.id = j1.item_id AND br.id = j1.value";
		$query .= " AND bd.id = j2.item_id AND r.id = j2.value";
		$query .= " AND br.id = " . $this->id;
		return $this->Query( $query, true );
	}
		
	public function getSimpleBids(){
		$foreignObj = new Bid();
		return $foreignObj->ReadForeignJoins( $this );
	}
	
	public function getUnbidRequests() {
		$broker_query = $this->GetObjectQueryString();
		$today = date("Y-m-d 00:00:00");
		$r = new Request();
		$b = new Bid();
		$bid_query = $b->GetObjectQueryString();
		$request_query = $r->GetObjectQueryString();
		$join_table = $this->_TABLE_PREFIX . constant('Crud::_VALUES_TABLE_JOINS');
		$query = "SELECT nr.*";
		$query .= " FROM";
		$query .= " ($request_query) AS nr";
		$query .= " LEFT JOIN";
		$query .= " (SELECT r.*";
		$query .= " FROM";
		$query .= " ($request_query) AS r,";
		$query .= " ($broker_query) AS br,";
		$query .= " ($bid_query) AS bd,";
		$query .= " $join_table AS j1,";
		$query .= " $join_table AS j2";
		$query .= " WHERE bd.id = j1.item_id AND br.id = j1.value";
		$query .= " AND bd.id = j2.item_id AND r.id = j2.value";
		$query .= " AND br.id = " . $this->id;
		$query .= " ) as q on q.id = nr.id";
		$query .= " WHERE q.id IS NULL AND nr.expiration_date > '$today' AND nr.locked IS NULL";
		return $this->Query( $query, true );
	}
    
	/*
	 * PRIVATE FUNCTIONS
	 */
    private function _privateFunction() {
    }
}
?>