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
	
	public function addTransportationType( $transporationType = null ){
		return $this->AddJoin( $transporationType, "join_transportation_type" );
	}
	
	public function getAllBids(){
		$bidArray = $this->GetAllItemsObj();
		
		
		/*
		
		$bidReturnArray = array();
		
		$i = 0;
		while( $i < count($bidArray) ){
			$ba = $bidArray[$i];
			
			$this->GetItemObj( $ba->id );
			
			//$this->ReadJoins( new Request() );
			//$this->ReadJoins( new Broker() );
			$stupidFace = clone $this;
			$bidReturnArray[] = $stupidFace;
			$i++;
			
		}
		*/
		return $bidArray;//$bidReturnArray;
	}
}
?>