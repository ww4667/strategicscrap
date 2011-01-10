<?php 
/**
 * 
 * @author undead
 *
 */
class Bid extends Crud {
	 
	protected $_OBJECT_NAME = "bid";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(
											array("type"=>"text","label"=>"Transport Cost","field"=>"transport_cost"),
											array("type"=>"text","label"=>"Material Cost","field"=>"material_price"),
											array("type"=>"date","label"=>"Ship Date","field"=>"ship_date"),
											array("type"=>"date","label"=>"Arrival Date","field"=>"arrival_date"),
											array("type"=>"text","label"=>"notes","field"=>"notes"),
											array("type"=>"number","label"=>"Status","field"=>"status"),
											array("type"=>"number","label"=>"Archived","field"=>"archived"),
											array("type"=>"number","label"=>"Read","field"=>"read"),
											array("type"=>"join","label"=>"Request Join","field"=>"join_request"),
											/**
											 * NOTE
											 * TODO: make the request faster so that we can just pull the data from the request join 
											 */
											array("type"=>"join","label"=>"Scrapper Join","field"=>"join_scrapper"),
											array("type"=>"join","label"=>"Facility Join","field"=>"join_facility"),
											array("type"=>"join","label"=>"Material Join","field"=>"join_material"),
											/* END NOTE */
											array("type"=>"join","label"=>"Transportation Type","field"=>"join_transportation_type"),
											array("type"=>"join","label"=>"Broker Join","field"=>"join_broker")
										);	
	
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
	public function addRequest( $requestId = null ){
		return $this->AddJoin( $requestId, "join_request" );
	}
	
	public function addBroker( $brokerId = null ){
		return $this->AddJoin( $brokerId, "join_broker" );
	}
	
	public function addScrapper( $scrapperId = null ){
		return $this->AddJoin( $scrapperId, "join_scrapper" );
	}
	
	public function addFacility( $facilityId = null ){
		return $this->AddJoin( $facilityId, "join_facility" );
	}
	
	public function addMaterial( $materialId = null ){
		return $this->AddJoin( $materialId, "join_material" );
	}
	
	public function addTransportationType( $transporationType = null ){
		return $this->AddJoin( $transporationType, "join_transportation_type" );
	}
	
	public function getAllBids(){
		$bidArray = $this->GetAllItemsObj();
		
		$bidReturnArray = array();
		
		$i = 0;
		while( $i < count($bidArray) ){
			$ba = $bidArray[$i];
			
			$this->GetItemObj( $ba->id );
			$this->ReadJoins( new Request() );
			$this->ReadJoins( new Broker() );
			$this->ReadJoins( new Scrapper() );
			$this->ReadJoins( new Facility() );
			$this->ReadJoins( new Material() );
			$stupidFace = clone $this;
			$bidReturnArray[] = $stupidFace;
			$i++;
			
		}
		
		return $bidReturnArray;
	}
	
	public function updateStatus( $statusId ) {
		return $this->_updateStatus( $statusId );
	}
	
	public function getStatusArray() {
		return $this->_getStatusArray();
	}
	
	public function splitBidsByStatus( $bids_array ) {
		return $this->_splitBidsByStatus( $bids_array );
	}
	
	public function acceptBid( $bidId = null ) {
		 return $this->_acceptBid( $bidId );	
	}
	
	public function getUser( $bidId = null ){

		// get related request
		if ( is_null($bidId) ) {
			$bid_id = $this->id;
		} else {
			$bid_id = $bidId;
		}
		// get this bid using the id
		$bidObj = new Bid();
		$bid = $bidObj->GetItemObj( $bid_id );
		$brokerObj = new Broker();
		$broker_array = $bid->ReadJoins( $brokerObj );
		$brokerObj->GetItemObj($broker_array[0]['id']);
		$user = new User();
		$user_array = $brokerObj->ReadJoins( $user );
		return $user->GetItemObj($user_array[0]['id']);
	}
	
	public function getBroker( $bidId = null ){
		// get related request
		if ( is_null($bidId) ) {
			$bid_id = $this->id;
		} else {
			$bid_id = $bidId;
		}
		// get this bid using the id
		$bidObj = new Bid();
		$bid = $bidObj->GetItemObj( $bid_id );
		$brokerObj = new Broker();
		$broker_array = $bid->ReadJoins( $brokerObj );
		return $brokerObj->GetItemObj($broker_array[0]['id']);
	}
		
	public function expired() {
		$this->status = 3;
		$this->UpdateItem();
	}
	
	private function _acceptBid( $bidId = null ) {
		// get related request
		if ( is_null($bidId) ) {
			$bid_id = $this->id;
		} else {
			$bid_id = $bidId;
		}
		// get this bid using the id
		$accepted_bid = $this->GetItemObj( $bid_id );
		// get the request via ReadJoins
		$requestClass = new Request();
		$requests = $accepted_bid->ReadJoins( $requestClass );
		$accepted_bid->join_request = ''; // so update doesn't blow up!
		// make it all happen if we have a request!
		if ( count($requests) == 1 ) {
			$request = $requestClass->GetItemObj( $requests[0]['id'] );
			// set request as locked
			$request->status = "2";
			$request->locked = "1";
			$request->UpdateItem();
			// get related bids
			$related_bids = $request->GetBids();
			// set this bid as accepted
			$accepted_bid->updateStatus( 1 );
			// set others as rejected
			foreach ($related_bids as $rb) {
				if ($rb['id'] != $bid_id) {
					$bidClass = new Bid();
					$bidObj = $bidClass->GetItemObj($rb['id']);
					$bidObj->updateStatus( 2 );
				}
			}
			// email the broker that a bid has been accepted!
			include_once($_SERVER['DOCUMENT_ROOT'].'/models/Mailer.php');
			$user = $accepted_bid->getUser();
			$broker = $accepted_bid->getBroker();
			$object['fname'] = $broker->first_name;
			$object['lname'] = $broker->last_name;
			$object['email'] = $user->email;
			Mailer::accepted_bid_alert($object);
			return true;	
		}
		return false;
	}
	
	private function _splitBidsByStatus( $bids_array ) {
		$split_array = array();
		$status_array = $this->_getStatusArray();
		foreach ($status_array as $key => $val) {
			$split_array[$val] = array();
			foreach ( $bids_array as $item ) {
				$bid = (array) $item;
				if ( intval($bid['status']) == $key ) {
					$split_array[$val][] = $bid;
				}
			}
		}
		return $split_array;
	}
	
	private function _getStatusArray() {
		$status_array = array(	"0" => "waiting",
								"1" => "accepted",
								"2" => "rejected",
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
}
?>