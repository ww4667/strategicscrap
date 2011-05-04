<?php 
/**
 * 
 * @author undead
 *
 */
class Request extends Crud {
	 
	protected $_OBJECT_NAME = "request";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"date","label"=>"Arrive Date","field"=>"arrive_date"),
											array("type"=>"date","label"=>"Ship Date","field"=>"ship_date"),
											array("type"=>"date","label"=>"Expiration Date","field"=>"expiration_date"),
											array("type"=>"text","label"=>"Transportation Type","field"=>"transportation_type"),
											array("type"=>"text","label"=>"Volume","field"=>"volume"),
											array("type"=>"text","label"=>"Special Instructions","field"=>"special_instructions"),
//											array("type"=>"text","label"=>"Scrapper Join","field"=>"join_scrapper"),
//											array("type"=>"text","label"=>"Facility Join","field"=>"join_facility"),
//											array("type"=>"text","label"=>"Material Join","field"=>"join_material"),
											array("type"=>"join","label"=>"Scrapper Join","field"=>"join_scrapper"),
											array("type"=>"join","label"=>"Facility Join","field"=>"join_facility"),
											array("type"=>"join","label"=>"Material Join","field"=>"join_material"),
											array("type"=>"text","label"=>"Request Snapshot","field"=>"request_snapshot"),
											array("type"=>"number","label"=>"Locked","field"=>"locked"),
											array("type"=>"number","label"=>"Archived","field"=>"archived"),
											array("type"=>"number","label"=>"Status","field"=>"status"),
											array("type"=>"number","label"=>"Bid Count","field"=>"bid_count"),
											array("type"=>"number","label"=>"Bid Unread","field"=>"bid_unread")
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
				if( $arr[$i]['field'] == "join_material" ){
					$material_join_property = $arr[$i]['property_name_id'];
					break;
				}
				$i++;
			}
			$this->AddValueJoin($item['id'], $material_join_property, $materialId);
		}
	}
	
	public function addFacility( $facilityId = null ){
		$item = $this->GetCurrentItem();
		$facility = $this->GetItem($facilityId);
		$this->SetCurrentItem($item); // need to reset Current item back to the facility
		if(count($facility)>0){
			$facility_join_property = null;
			$arr = $this->_OBJECT_PROPERTIES;
			$c = count($this->_OBJECT_PROPERTIES);
			$i = 0;
			while($i<$c){
				if( $arr[$i]['field'] == "join_facility" ){
					$facility_join_property = $arr[$i]['property_name_id'];
					break;
				}
				$i++;
			}
			$this->AddValueJoin($item['id'], $facility_join_property, $facilityId);
		}
	}
	
	public function addScrapper( $scrapperId = null ){
		$item = $this->GetCurrentItem();
		$scrapper = $this->GetItem($scrapperId);
		$this->SetCurrentItem($item); // need to reset Current item back to the facility
		if(count($scrapper)>0){
			$scrapper_join_property = null;
			$arr = $this->_OBJECT_PROPERTIES;
			$c = count($this->_OBJECT_PROPERTIES);
			$i = 0;
			while($i<$c){
				if( $arr[$i]['field'] == "join_scrapper" ){
					$scrapper_join_property = $arr[$i]['property_name_id'];
					break;
				}
				$i++;
			}
			$this->AddValueJoin($item['id'], $scrapper_join_property, $scrapperId);
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
		$this->material_join = $joins;
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
	
	public function getAllRequests(){
		$requestArray = $this->GetAllItemsObj();
		$requestReturnArray = array();
		
		$i = 0;
		while( $i < count($requestArray) ){
			$ra = $requestArray[$i];
			$ra->request_snapshot = json_decode($ra->request_snapshot);
//			$this->GetItemObj( $ra->id );
//			$this->ReadJoins( new Material() );
//			$this->ReadJoins( new Scrapper() );
//			$this->ReadJoins( new Facility() );
			$stupidFace = clone $ra;
			
			$requestReturnArray[] = $stupidFace;
			$i++;
		}
		return $requestReturnArray;
	}
	
	public function GetBids(){
		return $this->_getBids();
	}
	
	public function IsExpired(){
		return $this->_isExpired();
	}
		
	public function updateStatus( $statusId ) {
		return $this->_updateStatus( $statusId );
	}
	
	public function getStatusArray() {
		return $this->_getStatusArray();
	}
	
	public function sendScrapBrokerEmail() {
		return $this->_sendScrapBrokerEmail();
	}
	
	public function sendBidAlert( $scrapperId = null ) {
		include_once($_SERVER['DOCUMENT_ROOT'].'/models/Mailer.php');
		// get related request
		if ( is_null($scrapperId) ) {
			$scrapper_id = $this->id;
		} else {
			$scrapper_id = $scrapperId;
		}
		// get this request using the id
		$s = new Scrapper();
		$scrapper = $s->GetItemObj( $scrapper_id );
		$scrapper->getUsers();
		// email the scrapper that a bid has been added!
		$object['fname'] = $scrapper->first_name;
		$object['lname'] = $scrapper->last_name;
		$object['email'] = $scrapper->join_user[0]['email'];
		Mailer::added_bid_alert($object);
	}
	
	public function getRequestsReadyToExpire( $date ) {
		return $this->_getRequestsReadyToExpire( $date );
	}
	
	public function expired() {
		$this->locked = 1;
		$this->status = 3;
		$this->UpdateItem();
	}
	
	private function _getRequestsReadyToExpire( $date ) {
		$request_array = array();
		
		$query_date = date("Y-m-d 00:00:00",strtotime($date));
		
		$objectNameId = $this->_OBJECT_NAME_ID;
		
		$properties = $this->_OBJECT_PROPERTIES;
		$fields = ""; 
		foreach ($properties as $p) {
			if ($fields == "") {
				$fields .= " MAX(IF(pn.label='".$p['field']."', v.value, '')) AS `".$p['field']."`";
			} else {
				$fields .= ", MAX(IF(pn.label='".$p['field']."', v.value, '')) AS `".$p['field']."`";
			}
		}
		$query = "SELECT * FROM (SELECT o.id, o.created_ts, o.updated_ts, o.object_name_id,";
		$query .= $fields;
		$query .= " FROM " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " as o";
		$query .= " LEFT JOIN " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_DEFINITIONS') . " as od on od.object_name_id = o.object_name_id";
		$query .= " LEFT JOIN " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') . " as pn on pn.id = od.property_name_id";
		$query .= " LEFT JOIN 	(SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES') . " UNION SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS') . " UNION SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT') . ") as v on v.property_name_id = od.property_name_id AND v.item_id = o.id";
		$query .= " WHERE o.object_name_id = $objectNameId";
		$query .= " GROUP BY o.id) as tbl";
		$query .= " WHERE expiration_date <= '$query_date'";
		$query .= " AND (status <> '3' AND status <> '2') ";
		
		$request_array = $this->Query( $query, true );
		
		$output_array = array();
		foreach ($request_array as $request) {
			$requestObj = new Request();
			$requestObj->GetItemObj($request['id']);
			$output_array[] = $requestObj;
		}
		
		return $output_array;
	}
	
	private function _getBids(){
		$foreignObj = new Bid();
		return $foreignObj->ReadForeignJoins( $this );
	}
	
	private function _isExpired(){
		$createdTS = strtotime($this->created_ts);
		$shipTS = strtotime($this->ship_date);
//		$expiration = strtotime("+30 days",$createdTS);
		$expiration = strtotime($this->expiration_date);
		$nowTS = time();
//		if ( $expiration > $nowTS && $shipTS < $nowTS ) {
		if ( $nowTS < $expiration ) {
			return false; 
		} else {
			$this->locked = 1;
			$this->status = 3;
			$this->UpdateItem();
			return true;
		}	
	}
	
	private function _getStatusArray() {
		$status_array = array(	"0" => "waiting",
								"1" => "active",
								"2" => "complete",
								"3" => "expired"
		);
		return $status_array;
	}

	private function _updateStatus( $statusId ) {
		$status_array = $this->_getStatusArray();
		if ( isset($status_array[$statusId]) ) {
			$this->status = $statusId;
			$this->UpdateItem();
		}
	}

	private function _sendScrapBrokerEmail() {
		// email the scrap broker that a bid request has been created.
		include_once($_SERVER['DOCUMENT_ROOT'].'/models/Mailer.php');
		$request = $this;
		$request->request_snapshot = json_decode( $this->request_snapshot, true );
		$s = new Scrapper();
		$s->GetItemObj( $request->request_snapshot['scrapper']['id'] );
		$s->getUsers();
		$request->user = $s->join_user[0];
		$object = $request;
		Mailer::scrap_broker_request($object);
		return true;
	}
}
?>