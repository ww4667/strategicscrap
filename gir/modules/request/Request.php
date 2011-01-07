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
											array("type"=>"text","label"=>"Scrapper Join","field"=>"join_scrapper"),
											array("type"=>"text","label"=>"Facility Join","field"=>"join_facility"),
											array("type"=>"text","label"=>"Material Join","field"=>"join_material"),
											array("type"=>"number","label"=>"Locked","field"=>"locked"),
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
			
			$this->GetItemObj( $ra->id );
			$this->ReadJoins( new Material() );
			$this->ReadJoins( new Scrapper() );
			$this->ReadJoins( new Facility() );
			$stupidFace = clone $this;
			
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
	
	private function _getBids(){
		$foreignObj = new Bid();
		return $foreignObj->ReadForeignJoins( $this );
	}
	
	private function _isExpired(){
		$createdTS = strtotime($this->created_ts);
		$shipTS = strtotime($this->ship_date);
		$expiration = strtotime("+14 days",$createdTS);
		$nowTS = time();
		if ( $expiration > $nowTS && $shipTS > $nowTS ) {
			return true; 
		} else {
			$this->locked = 1;
			$this->UpdateItem();
			return false;
		}
	}
}
?>