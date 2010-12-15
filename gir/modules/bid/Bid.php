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
}
?>