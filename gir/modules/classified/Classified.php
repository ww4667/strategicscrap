<?php 
/**
 *
 * @author undead
 *
 */
 
class Classified extends Crud {

	protected $_OBJECT_NAME = "classified";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"Title","field"=>"title"),
											array("type"=>"text","label"=>"Description","field"=>"description"),
											array("type"=>"text","label"=>"Image","field"=>"image"),
											array("type"=>"number","label"=>"Featured","field"=>"featured"),
											array("type"=>"number","label"=>"Paid","field"=>"paid"),
											array("type"=>"number","label"=>"Approved","field"=>"approved"),
											array("type"=>"text","label"=>"Parent Object","field"=>"parent_object"),
											array("type"=>"date","label"=>"End Date","field"=>"end_date"),
											array("type"=>"join","label"=>"Join Scrapper","field"=>"join_scrapper"),
											array("type"=>"join","label"=>"Join Category Parent","field"=>"join_category_parent")
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
	
	public function getExpiredClassifieds( $compare_date, $days_out='0' ) {
		return $this->_getExpiredClassifieds( $compare_date, $days_out );
	}

	public function addCategory( $categoryId = null ){
		$item = $this->GetCurrentItem();
		$category = $this->GetItem( $categoryId );
		$this->SetCurrentItem($item); // need to reset Current item back to the request
		if(count( $category )>0){
			$join_category_parent = null;
			$arr = $this->_OBJECT_PROPERTIES;
			$c = count($this->_OBJECT_PROPERTIES);
			$i = 0;
			while($i<$c){
				if( $arr[$i]['field'] == "join_category_parent" ){
					$join_category_parent = $arr[$i]['property_name_id'];
					break;
				}
				$i++;
			}
			$this->UpdateValueJoin( $item['id'], $join_category_parent, $categoryId );
		}
	}
	
	public function removeCategory( $categoryId = null ){
		$category = $this->ReadObjectById( $categoryId );
		if(count( $category )>0){
			$item = $this->GetCurrentItem();
			$this->RemoveValueJoin( $item['id'], $categoryId );
		}
	}
	
	public function getCategory( $itemId = null ) {
		// get materials by "itemId" and join type "material_join"
		$item = $this->GetCurrentItem();
		$itemId = isset($itemId) ? $itemId : $item['id'];
		$category = new Category();
		$joins = $this->ReadJoins( $category );
		$this->join_category_parent = $joins;
	}
	
	public function addScrapper( $scrapperId = null ){
		$item = $this->GetCurrentItem();
		$scrapper = $this->GetItem($scrapperId);
		$this->SetCurrentItem($item); // need to reset Current item back to the request
		
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
			$this->UpdateValueJoin($item['id'], $scrapper_join_property, $scrapperId);
		}
	}

	public function removeScrapper( $scrapperId = null ){
		$scrapper = $this->ReadObjectById($scrapperId);
		if(count($category)>0){
			$item = $this->GetCurrentItem();
			$this->RemoveValueJoin($item['id'], $scrapperId);
		}
	}
	
	public function getScrapper( $itemId = null ) {
		// get materials by "itemId" and join type "material_join"
		$item = $this->GetCurrentItem();
		$itemId = isset($itemId) ? $itemId : $item['id'];
		$scrapper = new Scrapper();
		$joins = $this->ReadJoins( $scrapper );
		$this->join_scrapper = $joins;
	}

	public function setDefaults(  ){
		$item = $this->GetCurrentItem();
		$this->SetCurrentItem($item); // need to reset Current item back to the request
		
		if(count($scrapper)>0){
			$scrapper_join_property = null;
			$arr = $this->_OBJECT_PROPERTIES;
			$c = count($this->_OBJECT_PROPERTIES);
			$i = 0;
			while($i<$c){
				if( $arr[$i]['field'] == "approved" ){
					$approved_property = $arr[$i]['property_name_id'];
					break;
				}
				if( $arr[$i]['field'] == "featured" ){
					$featured_property = $arr[$i]['property_name_id'];
					break;
				}
				$i++;
			}
			$this->UpdateValueNumber($item['id'], $approved_property, 0);
			$this->UpdateValueNumber($item['id'], $featured_property, 0);
		}
	}
	
	
	public function getAllWithUserDetails( $classifiedId = null, $approved = null, $featured = null, $categoryId = null ) {
		$classifieds_query = $this->GetObjectQueryString();
		
		$s = new Scrapper();
		$scrapper_query = $s->GetObjectQueryString();
		
		$cat = new Category();
		$category_query = $cat->GetObjectQueryString();
		
		$u = new User();
		$user_query = $u->GetObjectQueryString();
		
		$join_table = $this->_TABLE_PREFIX . constant('Crud::_VALUES_TABLE_JOINS');
		$query = "SELECT ";
		/**
		 * ,COALESCE(c.approved, 0) as approved
		 * ,COALESCE will check for a null and 0 and will return 0 - this is a super fast function!
		 */
		$query .= " c.*,COALESCE(c.approved, 0) as approved,COALESCE(c.featured, 0) as featured,cat.id as category_id,cat.name as category_name,s.id as scrapper_id,s.last_name as scrapper_last_name,s.first_name as scrapper_first_name,u.email,u.logged_in,u.last_login_ts ";
		$query .= " FROM ";
		$query .= " ($user_query) AS u,";
		$query .= " ($classifieds_query) AS c,";
		$query .= " ($category_query) AS cat,";
		$query .= " ($scrapper_query) AS s,";
		$query .= " $join_table AS j,";
		$query .= " $join_table AS j2,";
		$query .= " $join_table AS j3";
		$query .= " WHERE ";
		$query .= "     s.id = j.item_id AND u.id = j.value ";
		$query .= " AND c.id = j2.item_id AND s.id = j2.value ";
		$query .= " AND c.id = j3.item_id AND cat.id = j3.value ";
		if( $classifiedId ) $query .= " AND c.id = ($classifiedId) ";
		if( $categoryId ) $query .= " AND cat.id = ($categoryId) ";
		if( $approved === TRUE ) $query .= " AND c.approved = 1 ";
		if( $approved === FALSE ) $query .= " AND COALESCE(c.approved, 0) = 0 ";
		if( $featured === TRUE ) $query .= " AND c.approved = 1 ";
		if( $featured === FALSE ) $query .= " AND COALESCE(c.featured, 0) = 0 ";
		
		return $this->Query( $query, true );
	}
	
	
	/*
	 * PRIVATE FUNCTIONS
	 */
    
	private function _getExpiredClassifieds( $compare_date, $days_out ) {
		$classifieds_array = array();
		
		$query_date = date("Y-m-d 00:00:00",strtotime("+" . $days_out . " days",strtotime($compare_date)));
		
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
		$query .= " JOIN " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_DEFINITIONS') . " as od on od.object_name_id = o.object_name_id";
		$query .= " JOIN " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') . " as pn on pn.id = od.property_name_id";
		$query .= " JOIN 	(SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES') . " UNION SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS') . " UNION SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT') . ") as v on v.property_name_id = od.property_name_id AND v.item_id = o.id";
		$query .= " WHERE o.object_name_id = $objectNameId";
		$query .= " GROUP BY o.id) as tbl";
		$query .= " WHERE end_date <= '$query_date'";
		$query .= " AND (status = '' OR status = 'active')";
		
		//echo $query;
		$classifieds_array = $this->Query( $query, true );
		
		$output_array = array();
		foreach ( $classifieds_array as $classified ) {
			$c = new Classified();
			$c->GetItemObj( $classified[ 'id' ] );
			$user = new User();
			$users = $c->ReadJoins( $user );
			$c->join_user = '';
			$c->email = $users[0]['email'];
			$output_array[] = $c;
		}
		
		return $output_array;
	}
	
}
?>