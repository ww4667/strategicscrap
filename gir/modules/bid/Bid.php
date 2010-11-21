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
											array("type"=>"text","label"=>"Transportation Type","field"=>"transportation_type"),
											array("type"=>"text","label"=>"Cost","field"=>"cost"),
											array("type"=>"number","label"=>"Status","field"=>"status"),
											array("type"=>"number","label"=>"Archived","field"=>"archived"),
											array("type"=>"join","label"=>"Request Join","field"=>"join_request"),
											array("type"=>"join","label"=>"Broker Join","field"=>"join_broker")
										);	
	
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
	public function addRequest( $requestId = null ){
		$item = $this->GetCurrentItem();
		$request = $this->GetItem($requestId);
		$this->SetCurrentItem($item); // need to reset Current item back to the request
		if(count($request)>0){
			$request_join_property = null;
			$arr = $this->_OBJECT_PROPERTIES;
			$c = count($this->_OBJECT_PROPERTIES);
			$i = 0;
			while($i<$c){
				if( $arr[$i]['field'] == "join_request" ){
					$request_join_property = $arr[$i]['property_name_id'];
					break;
				}
				$i++;
			}
			$this->AddValueJoin($item['id'], $request_join_property, $requestId);
		}
	}
	
	public function addBroker( $brokerId = null ){
		$item = $this->GetCurrentItem();
		$broker = $this->GetItem($brokerId);
		$this->SetCurrentItem($item); // need to reset Current item back to the broker
		if(count($broker)>0){
			$broker_join_property = null;
			$arr = $this->_OBJECT_PROPERTIES;
			$c = count($this->_OBJECT_PROPERTIES);
			$i = 0;
			while($i<$c){
				if( $arr[$i]['field'] == "join_broker" ){
					$broker_join_property = $arr[$i]['property_name_id'];
					break;
				}
				$i++;
			}
			$this->AddValueJoin($item['id'], $broker_join_property, $brokerId);
		}
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
			$stupidFace = clone $this;
			$bidReturnArray[] = $stupidFace;
			$i++;
			
		}
		return $bidReturnArray;
	}
}
?>