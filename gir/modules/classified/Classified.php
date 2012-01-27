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
											array("type"=>"text","label"=>"Contact Form","field"=>"contact_form"),
											array("type"=>"text","label"=>"Image","field"=>"image"),
											array("type"=>"number","label"=>"Featured","field"=>"featured"),
											array("type"=>"number","label"=>"Paid","field"=>"paid"),
											array("type"=>"number","label"=>"Approved","field"=>"approved"),
											array("type"=>"number","label"=>"Sale or Wanted","field"=>"sale_or_wanted"),/* 0 for sale and 1 for wanted */
											array("type"=>"text","label"=>"Parent Object","field"=>"parent_object"),
											array("type"=>"text","label"=>"Slug","field"=>"slug"),
											array("type"=>"date","label"=>"End Date","field"=>"end_date"),
											array("type"=>"join","label"=>"Join Classified Type","field"=>"join_classified_type"),
											array("type"=>"join","label"=>"Join Contact","field"=>"join_contact"),
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
	
	public function findSlugsBySlug( $slug = '' ){
		$classified_query = $this->GetObjectQueryString();
		
		$join_table = $this->_TABLE_PREFIX . constant('Crud::_VALUES_TABLE_JOINS');
		$query = "SELECT ";
		$query .= " c.* ";
		$query .= " FROM ";
		$query .= " ($classified_query) AS c ";
		$query .= " WHERE c.slug = '$slug' ";
		
		return $this->Query( $query, trued );
	}
	
	public function getExpiredClassifieds( $compare_date, $days_out='0' ) {
		return $this->_getExpiredClassifieds( $compare_date, $days_out );
	}

	public function addCategory( $categoryId = null, $process = false ){

		$currentClassified = $this->GetCurrentItem();
		$category = new Category();
		$parentCategory = $category->GetItem( $categoryId );
		
		$this->SetCurrentItem( $currentClassified ); // need to reset Current item back to the request
		
		$join_category_parent = $this->ReadPropertyByName( 'join_category_parent' );
		$slug = $this->ReadPropertyByName( 'slug' );
		
		$cleanName = cleanSlug( $currentClassified['name'] );
		
		/**
		 * MAKE A FUNCTION that cleans up the name
		 */
		$slug_op = ( !empty( $parentCategory['slug'] ) ? $parentCategory['slug'] : '' ) . '/' . $cleanName;
		
		if( $process ){		
			if( count( $join_category_parent ) ){
				$this->UpdateValueJoin( $currentClassified['id'], $join_category_parent['id'], $categoryId );
			} else {
				$this->AddValueJoin( $currentClassified['id'], $join_category_parent['id'], $categoryId );
				}
			
			if( !empty( $currentCategory['slug'] ) ){
				$this->UpdateValueText( $currentClassified['id'], $slug['id'], $slug_op );
			} else {
				$this->AddValueText( $currentClassified['id'], $slug['id'], $slug_op );
			}
		} else {
			return $slug_op;
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
	
	
	public function addClassifiedType( $itemId = null ){
		$this->AddJoin( $itemId, "join_classified_type" );
	}
	
	public function removeClassifiedType( $itemId = null ){
		$classifiedType = $this->ReadObjectById( $itemId );
		if(count( $classifiedType )>0){
			$item = $this->GetCurrentItem();
			$this->RemoveValueJoin( $item['id'], $itemId );
		}
	}
	
	public function getClassifiedType( $itemId = null ) {
		// get materials by "itemId" and join type "material_join"
		$item = $this->GetCurrentItem();
		$itemId = isset($itemId) ? $itemId : $item['id'];
		$classifiedType = new ClassifiedType();
		$joins = $this->ReadJoins( $classifiedType );
		$this->join_classified_type = $joins;
	}
	
	public function addContact( $itemId = null ){
		$this->AddJoin( $itemId, "join_contact" );
	}
	
	public function getContact( $itemId = null ) {
		// get materials by "itemId" and join type "material_join"
		$item = $this->GetCurrentItem();
		$itemId = isset($itemId) ? $itemId : $item['id'];
		$contact = new Contact();
		$joins = $this->ReadJoins( $contact );
		$this->join_contact = $joins;
	}
	/**
	 * 
	 * $properties array	$defaultProperties = array(
			"classifiedId" => null, 
			"approved" => null, 
			"featured" => null, 
			"categoryIds" => null, 
			"sale_or_wanted" => null,
			"showContacts" => null,
			"classifiedType" => null
		); 
	 */
	public function getAllWithUserDetails( $properties = null ) {
	
		$defaultProperties = array(
			"classifiedId" => null, 
			"approved" => null, 
			"featured" => null, 
			"expired" => null, 
			"categoryIds" => null, 
			"sale_or_wanted" => null,
			"showContacts" => null,
			"classifiedType" => null
		);	

		if( is_null( $properties ) ) $properties = $defaultProperties;
		
		foreach ( $defaultProperties as $k => &$v ) {
		    if( isset( $properties[ $k ] ) ) $v = $properties[ $k ]; 
		}
	
		//$this->PTS( $defaultProperties, 'default props' );
		
		$classifieds_query = $this->GetObjectQueryString();
		
		$cat = new Category();
		$category_query = $cat->GetObjectQueryString();
		
		$contact = new Contact();
		$contact_query = $contact->GetObjectQueryString();
		$contact_select = $contact->GetSQLSelectForClass();
		
		$classifiedType = new ClassifiedType();
		$classifiedType_query = $classifiedType->GetObjectQueryString();
		
		$join_table = $this->_TABLE_PREFIX . constant('Crud::_VALUES_TABLE_JOINS');
		
		$query = "SELECT ";
		$query .= " c.*,";
		$query .= "	COALESCE(c.approved, 0) as approved,";
		$query .= "	COALESCE(c.featured, 0) as featured,";
		$query .= "	COALESCE(c.sale_or_wanted, 0) as sale_or_wanted,";
		$query .= "	cat.id as category_id,";
		$query .= "	cat.name as category_name" ; 
		$query .= ( !is_null( $defaultProperties['showContacts'] ) ? ", $contact_select, " : "" ); 
		$query .= ( !is_null( $defaultProperties['classifiedType'] ) ? 
					" classifiedType.id as classifiedType_id, classifiedType.name as classifiedType_name, classifiedType.fields as classifiedType_fields " : "" ); 
		
		$query .= " FROM ";
		$query .= " ($classifieds_query) AS c,";
		$query .= " ($category_query) AS cat,";
		$query .= ( !is_null( $defaultProperties['showContacts'] ) ? " ($contact_query) AS contact," : "" );
		$query .= ( !is_null( $defaultProperties['classifiedType'] ) ? " ($classifiedType_query) AS classifiedType," : "" );
		
		$query .= " $join_table AS j";
		$query .= ( !is_null( $defaultProperties['showContacts'] ) ? ", $join_table AS j2" : "" );
		$query .= ( !is_null( $defaultProperties['classifiedType'] ) ? ",  $join_table AS j3" : "" );
		$query .= " WHERE ";
		
		$query .= " c.id = j.item_id AND cat.id = j.value ";
		$query .= ( !is_null( $defaultProperties['showContacts'] ) ? 
			" AND c.id = j2.item_id AND contact.id = j2.value " : 
			"" );
		$query .= ( !is_null( $defaultProperties['classifiedType'] ) ? 
			" AND c.id = j3.item_id AND classifiedType.id = j3.value " : 
			"" );
		

		if( $defaultProperties['classifiedId'] ) $query .= " AND c.id = ".$defaultProperties['classifiedId']." ";
		if( $defaultProperties['categoryIds'] ) $query .= " AND cat.id IN ( ".$defaultProperties['categoryIds']." ) ";
		if( $defaultProperties['approved'] === TRUE ) $query .= " AND c.approved = 1 ";
		if( $defaultProperties['approved'] === FALSE ) $query .= " AND COALESCE(c.approved, 0) = 0 ";
		if( $defaultProperties['featured'] === TRUE ) $query .= " AND c.featured = 1 ";
		if( $defaultProperties['featured'] === FALSE ) $query .= " AND COALESCE(c.featured, 0) = 0 ";
		if( $defaultProperties['sale_or_wanted'] === TRUE ) $query .= " AND c.sale_or_wanted = 1 ";
		if( $defaultProperties['sale_or_wanted'] === FALSE ) $query .= " AND COALESCE(c.sale_or_wanted, 0) = 0 ";
		if( is_int($defaultProperties['classifiedType']) === TRUE ) $query .= " AND c.classifiedType_id =  " . $defaultProperties['classifiedType'] . " ";
		if( $defaultProperties['expired'] === TRUE ) $query .= " AND UNIX_TIMESTAMP(c.end_date) >  UNIX_TIMESTAMP('" . date("Y-m-d", strtotime("+30 day")) . "') ";
		if( $defaultProperties['expired'] === FALSE ) $query .= " AND UNIX_TIMESTAMP(c.end_date) <=  UNIX_TIMESTAMP('" . date("Y-m-d", strtotime("+30 day")) . "') ";
		
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