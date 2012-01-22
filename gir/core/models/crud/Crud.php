<?
/**
 * @DESC Basic core of gir
 */
class Crud {
	
	
	/*** DEFINE PROTECTED ***/
	/* database table name to contain objects: Objects are defined pieces of information. For example a user with a username and password that is defined. */
	protected $_TABLE_PREFIX = "";
	
	protected $_OBJECT_NAME = "";

	protected $_OBJECT_NAME_ID = "";

	protected $_OBJECT_PROPERTIES = array();
	
	
	/* private variables start */
	private $_CURRENT_ITEM = null;
	
	private $database_connection;
	
	public $newId = null;
	
	
	/*** DEFINE CONST ***/
	/* database table name to contain items: Items are defined pieces of information. For example a user with a username and password that is defined. */
	const _ITEMS = "items";
	
	/* database table name to contain object definition names: So that we do not duplicate names of objects, we will add them here. For example a user object would be called "user", this would get stored once. */
	const _OBJECT_NAMES = "object_names";
	
	/* database table name to contain object defintions: */
	const _OBJECT_DEFINITIONS = "object_definitions";
	
	/* database table name to contain property names: Property names are names of . For example a user with a username and password that is defined. */
	const _PROPERTY_NAMES = "property_names";
	
	/* database table name to contain property names: Property names are names of . For example a user with a username and password that is defined. */
	const _VALUES_TABLE_DATES = "property_values_dates";
	/* database table name to contain property names: Property names are names of . For example a user with a username and password that is defined. */
	const _VALUES_TABLE_TEXT = "property_values_text";
	/* database table name to contain property names: Property names are names of . For example a user with a username and password that is defined. */
	const _VALUES_TABLE_NUMBERS = "property_values_numbers";
	/* database table name to contain property names: Property names are names of . For example a user with a username and password that is defined. */
	const _VALUES_TABLE_JOINS = "property_values_joins";

	/*** DEFINE CONSTRUCTOR ***/
	/**
	 * 
	 * @param object $tablePrefix [optional]
	 * @return 
	 */
	function __construct ($tablePrefix = "gir_") {
		$this->CreateDbConnection( $_SESSION['_DATABASE_CONNECTION'] );
		$this->_TABLE_PREFIX = $tablePrefix;
		if ( $this->_OBJECT_NAME != "" ) {
			$this->_OBJECT_PROPERTIES = $this->CreateObjectDefinition($this->_OBJECT_NAME,	$this->_OBJECT_PROPERTIES);
			$object = $this->_GetDataByName( $this->_OBJECT_NAME, $this->_TABLE_PREFIX.constant('Crud::_OBJECT_NAMES') );
			$this->_OBJECT_NAME_ID = $object['id'];
		}
	}

	/***
	 * PUBLIC 
	 ***/
    
    
    /**
     * CreateObjectDefinition: Creates an object
     * @param string $label - the name of the object you are creating
     * @param array $propertyArray = Array(	array("type"=>"text","label"=>"Company","field"=>"company"),
											array("type"=>"text","label"=>"Last Name","field"=>"last_name"),
											array("type"=>"text","label"=>"First Name","field"=>"first_name"));
     */
    public function CreateObjectDefinition( $label, $propertyArray ) {

    	$structureLabelTmp = array();
    	$structureArray = array();
    	$structureArray = $propertyArray;
    	$structureArrayTmp = array();

    	$labelId = null;
    	$labelArray = array();

    	$relation = array();

    	$labelArray = $this->_CheckIfObjectNameExists( $label );
    	
		if( isset($labelArray[ 'id' ]) ){
			$labelId = $labelArray[ 'id' ];
		} else {
			$labelId = $this->_CreateObjectName( $label );
		}

		if( is_array( $structureArray ) ){
			$i = 0; $c = count( $structureArray );
			for( $i; $i < $c; $i++ ){
    			$structureLabelTmp = $this->_CheckIfPropertyNameExists( $structureArray[$i]['field'] );
				if( isset($structureLabelTmp[ 'id' ]) ){
					$structureArrayTmp[$i] = $structureLabelTmp[ 'id' ];
				} else {
					$structureArrayTmp[$i] = $this->_CreatePropertyName( $structureArray[ $i ]['field'] );
				}
				$relation = $this->_CheckIfObjectAndPropertyRelationExists( $labelId, $structureArrayTmp[ $i ] );
				if( isset($relation[ 'id' ]) ){
					/* we are done */
				} else {
					$relation = $this->_CreateObjectAndPropertyRelationship( $labelId, $structureArrayTmp[ $i ] );
				}
				$structureArray[$i]['property_name_id'] =  $structureArrayTmp[$i];
			}
		}
		return $structureArray;
    }

    public function CreateItem( $itemData ){
    	$objectArray = $this->_GetDataByName( $this->_OBJECT_NAME, $this->_TABLE_PREFIX.constant('Crud::_OBJECT_NAMES') );
		$objectNameId = $objectArray['id'];
		$itemId = $this->_CreateItem($objectNameId);
		$objectProperties = $this->_OBJECT_PROPERTIES;
		foreach ($objectProperties as $property) {
			if(!isset($itemData[$property["field"]])){
				$itemData[$property["field"]] = "";
			}
			
			if( !empty( $itemData[$property["field"]] ) ) $this->_SetPropertyValue($itemId, $property["property_name_id"], $property["type"], $itemData[$property["field"]]);
		}
		$item = $this->_GetValuesByObjectId( $itemId );
		$this->_BuildObject( $item );
		$this->newId = $itemId;
		return $this;
    }
    
    public function CreateItems( $itemsData ){
    	$objectNameId = $this->_OBJECT_NAME_ID;
    	$itemIds = $this->_CreateItems( $objectNameId, count( $itemsData ) );
    	$idsArray = array();
    	foreach ($itemIds as $row) {
    		$idsArray[] = $row['id'];
    	}
    	if ( $this->_InsertPropertyValues( $idsArray, $itemsData ) )
    		return true;
    	return false;
    }
	
	public function GetItem( $itemId, $detail = false ){
		$item = $this->_GetValuesByObjectId( $itemId );
		$op = $this->_BuildItem( $item );
		$this->_CURRENT_ITEM = $op;
		if(!$detail)
			return $op;
		return $item;
	}
	
	public function GetItemObj( $itemId ){
		$item = $this->_GetValuesByObjectId( $itemId );
		$this->_BuildObject( $item );
		return $this;
	}
	
	public function GetItemsByPropertyValue( $propertyName, $value ){
		$objectNameId = $this->_OBJECT_NAME_ID;
		$items = array();
		foreach ($this->_OBJECT_PROPERTIES as $p) {
			if ( $p['field'] == $propertyName ) {
				$propertyNameId = $p['property_name_id'];
				$propertyType = $p['type'];
				$items = $this->_GetItemsByObjectPropertyValue( $objectNameId, $propertyName, $propertyType, $value );
			}
		}
		return $items;
	}
	
	public function GetSQLSelectForClass( $prefix = null ){
		$properties = $this->_OBJECT_PROPERTIES;
		$objectName = $this->_OBJECT_NAME;
		if( is_null( $prefix ) ) {
			$prefix = $objectName;
		} 
		$op  = "";
		$op .= "". $objectName .".id as ".$prefix."_id";
		$op .= ",". $objectName .".updated_ts as ".$prefix."_updated_ts";
		$op .= ",". $objectName .".created_ts as ".$prefix."_created_ts";
		foreach ($properties as $p) {
			$op .= ",". $objectName .".".$p['field']." as ".$prefix."_".$p['field']."";
		}
				
		return $op;
	}
	
	public function GetItemsObjByPropertyValue( $propertyName, $value ){
		$objectNameId = $this->_OBJECT_NAME_ID;
		$items = array();
		foreach ($this->_OBJECT_PROPERTIES as $p) {
			if ( $p['field'] == $propertyName ) {
				$propertyNameId = $p['property_name_id'];
				$propertyType = $p['type'];
				$items = $this->_GetItemsByObjectPropertyValue( $objectNameId, $propertyName, $propertyType, $value );
				if (count($items) > 0) {
					$objs = array();
					foreach ($items as $item) {
						$obj = clone $this;
						foreach ($item as $key => $val) {
							$obj->$key = $val;
						}
						$objs[] = $obj;
					}
					return $objs; // array objects
				}
			}
		}
		return $items; // empty array
	}
	
	public function SetCurrentItem( $item ) {
		$this->_CURRENT_ITEM = $item;
	}
	
	public function GetObjectQueryString(){
		$objectNameId = $this->_OBJECT_NAME_ID;
		return $this->_GetAllItemsByObjectNameId( $objectNameId, true );
	}
	
	public function GetObjectJoinQueryString( $join_object ){
		return $this->_GetJoins( $join_object, true );
	}
	
	public function GetAllItems( $detail = false ){
		$objectName = $this->_OBJECT_NAME;
		$objectNameId = $this->_OBJECT_NAME_ID;
		$items = $this->_GetAllItemsByObjectNameId( $objectNameId );
		return $items;
	}
	
	public function GetAllItemsObj( $detail = false ){
		$objectName = $this->_OBJECT_NAME;
		$objectNameId = $this->_OBJECT_NAME_ID;
		$items = $this->_GetAllItemsByObjectNameId( $objectNameId );
		if (count($items) > 0) {
			$objs = array();
			foreach ($items as $item) {
				$obj = clone $this;
				foreach ($item as $key => $val) {
					$obj->$key = $val;
				}
				$objs[] = $obj;
			}
			return $objs;
		} else {
			return FALSE;
		}
	}
	
	public function UpdateItem( $itemData = null ) {
		if ( is_null($itemData) )
			$itemData = (array) $this;
		if ( !isset($itemData['id']) ) {
			$itemId = $this->id;
		} else {
			$itemId = $itemData['id'];
		}
		$objectProperties = $this->_OBJECT_PROPERTIES;
		$properties = $this->_GetValuesByObjectId( $itemId );
		if ( count($properties) > 0) {
			foreach ($objectProperties as $property) {
				if( isset($itemData[$property["field"]]) && trim($itemData[$property["field"]]) != "" ){
					$results = $this->_SetPropertyValue($itemId, $property["property_name_id"], $property["type"], $itemData[$property["field"]], true);
					if(!$results)
						$results = $this->_SetPropertyValue($itemId, $property["property_name_id"], $property["type"], $itemData[$property["field"]]);
				} elseif ( isset($itemData[$property["field"]]) && $property["type"] != 'join' ) {
					$this->_DeletePropertyValue($itemId, $property["property_name_id"], $property["type"]);
				}
			}
			$updated_ts = date("Y-m-d H:i:s"); // set updated timestamp
			$query = "UPDATE " . $this->_TABLE_PREFIX.constant("Crud::_ITEMS") . " SET updated_ts='$updated_ts' WHERE id='$itemId'";
			$this->_RunQuery($query);

			return $itemId;
		} else {
			return false;
		}
	}
	
	public function RemoveItem( $itemId ) {
		return $this->_DeleteItem( $itemId );
	}

    public function AddValueDate( $itemId, $propertyId, $date = "" ){
    	return $this->_SetPropertyValue( $itemId, $propertyId, "date", $date );
    }

    public function AddValueText( $itemId, $propertyId, $text = "" ){
    	return $this->_SetPropertyValue( $itemId, $propertyId, "text", $text );
    }

    public function AddValueNumber( $itemId, $propertyId, $number = "" ){
    	return $this->_SetPropertyValue( $itemId, $propertyId, "number", $number );
    }

    public function AddValueJoin( $itemId, $propertyId, $number = "" ){
    	return $this->_SetPropertyValue( $itemId, $propertyId, "join", $number );
    }
    
    public function AddJoin( $joinItemId, $joinName ){
    	return $this->_SetJoinValue( $joinItemId, $joinName );
    }

    public function UpdateValueDate( $itemId, $propertyId, $date = "" ){
    	return $this->_SetPropertyValue( $itemId, $propertyId, "date", $date, true );
    }

    public function UpdateValueText( $itemId, $propertyId, $text = "" ){
    	return $this->_SetPropertyValue( $itemId, $propertyId, "text", $text, true );
    }

    public function UpdateValueNumber( $itemId, $propertyId, $number = "" ){
    	return $this->_SetPropertyValue( $itemId, $propertyId, "number", $number, true );
    }

    public function UpdateValueJoin( $itemId, $propertyId, $number = "" ){
    	return $this->_SetPropertyValue( $itemId, $propertyId, "join", $number, true );
    }

    public function GetValueDate( $itemId, $propertyId ){
    	return $this->_GetPropertyValue( $itemId, $propertyId, "date" );
    }

    public function GetValueText( $itemId, $propertyId ){
    	return $this->_GetPropertyValue( $itemId, $propertyId, "text" );
    }

    public function GetValueNumber( $itemId, $propertyId ){
    	return $this->_GetPropertyValue( $itemId, $propertyId, "number" );
    }

    public function GetValueJoin( $itemId, $propertyId  ){
    	return $this->_GetPropertyValue( $itemId, $propertyId, "join");
    }

    /*     READ     */
    public function ReadAllProperties() {
		return $this->_GetAllData( "SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') );
    }

    public function ReadAllObjects() {
		return $this->_GetAllData( "SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_NAMES') );
    }

    public function ReadAllRelationships() {
		return $this->_GetAllData( "SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_DEFINITIONS') );
    }

    public function ReadAllRelationshipsByObjectID( $id ) {
		$query = "SELECT od.property_name_id, pn.label";
		$query .= " FROM " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_DEFINITIONS') . " as od";
		$query .= " LEFT JOIN " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') . " pn ON od.property_name_id = pn.id";
		$query .= " WHERE od.object_name_id = $id";
		return $this->_GetAllData( $query );
    }
	
	public function GetCurrentItem(){
		return $this->_CURRENT_ITEM;
	}
	
    public function ReadPropertyByName( $label ) {
		return $this->_GetDataByName( $label );
    }

    public function ReadValuesByObjectId( $id ) {
		return $this->_GetValuesByObjectId( $id );
    }

    public function ReadPropertyById( $id ) {
		return $this->_GetDataById( $id );
    }

    public function ReadObjectByName( $label ) {
		return $this->_GetDataByName( $label, $this->_TABLE_PREFIX.constant('Crud::_OBJECT_NAMES') );
    }

    public function ReadObjectById( $id ) {
		return $this->_GetDataById( $id, $this->_TABLE_PREFIX.constant('Crud::_OBJECT_NAMES') );
    }

    public function ReadItemsByObjectNameId( $id ){
        return $this->_GetItemsByObjectNameId( $id );
    }

    public function ReadJoin( $itemId, $foreignItemId ){
        return $this->_GetJoin( $itemId, $foreignItemId );
    }

    public function ReadJoins( $joinObject, $return_sql = false ){
        return $this->_GetJoinsNew( $joinObject, $return_sql );
    }

    public function ReadJoinsNew( $joinObject, $return_sql = false ){
        return $this->_GetJoinsNew( $joinObject, $return_sql );
    }

    public function ReadForeignJoins( $joinObject ){
        return $this->_GetForeignJoins( $joinObject );
    }

    /* remove */
    public function RemoveValueDate( $propertyId ){
    	return $this->_DeletePropertyValue( $propertyId, "date" );
    }

    public function RemoveValueText( $propertyId ){
    	return $this->_DeletePropertyValue( $propertyId, "text" );
    }

    public function RemoveValueNumber( $propertyId ){
    	return $this->_DeletePropertyValue( $propertyId, "number" );
    }

    public function RemoveValueJoin( $propertyId ){
    	return $this->_DeletePropertyValue( $propertyId, "join" );
    }

	public function RemoveJoin( $joinItemId, $joinName ) {
		return $this->_DeleteJoinValue( $joinItemId, $joinName );
	}
    
    public function Query( $query, $asArray = false, $openConnection = true ){
    	return $this->_RunQuery( $query, $asArray, $openConnection );
    }
    
    public function PTS( $value, $title = null ){
    	if( $title ) print "<h3>$title</h3>";
    	print "<pre>";
    	print_r( $value );
    	print "</pre>";
    }


	public function QueryObjectItems( $whereStatement, $return_sql = false ) {
		$items = $this->_QueryObjectItems( $whereStatement, $return_sql );
		if ($return_sql){
			return $items;
		} else {	
			if (count($items) > 0) {
				$objs = array();
				foreach ($items as $item) {
					$obj = clone $this;
					foreach ($item as $key => $val) {
						$obj->$key = $val;
					}
					$objs[] = $obj;
				}
				return $objs;
			} else {
				return FALSE;
			}
		}
	}
    /* PRIVATE */

	/**
	 * Creates a database connection
	 * @param Mysql $instance_reference
	 */
    private function CreateDbConnection( Mysql $instance_reference ) {
		$this->database_connection = $instance_reference;
    }
	
	private function _BuildObject( $item ) {
		if( count( $item ) > 0 ){
			$op = array();
			$op['id'] = $item[0]['id'];
			$this->id = $item[0]['id'];
			$op['created_ts'] = $item[0]['created_ts'];
			$this->created_ts = $item[0]['created_ts'];
			$op['updated_ts'] = $item[0]['updated_ts'];
			$this->updated_ts = $item[0]['updated_ts'];
			$op['object_name_id'] = $item[0]['object_name_id'];
			$this->object_name_id = $item[0]['object_name_id'];
			foreach ($item as $detail) {
				$op[$detail['label']] = $detail['value'];
				$this->{$detail['label']} = $detail['value'];
			}
			$this->_CURRENT_ITEM = $op;
		}
		return $this;
	}
	
	private function _BuildItem( $item ) {
		$op = array();
		if( count( $item ) > 0 ){
			$op = array();
			$op['id'] = $item[0]['id'];
			$op['created_ts'] = $item[0]['created_ts'];
			$op['updated_ts'] = $item[0]['updated_ts'];
			$op['object_name_id'] = $item[0]['object_name_id'];
			foreach ($item as $detail) {
				$op[$detail['label']] = $detail['value']; 
			}
		}
		return $op;
	}
    
    /*     SET     */
    private function _CreateItem( $objectNameId ){
    	$op = array();
    	if( count( $this->_GetDataById( $objectNameId, $this->_TABLE_PREFIX.constant('Crud::_OBJECT_NAMES') ) ) > 0 ){
			$this->database_connection->Open();
			$created_ts = date("Y-m-d H:i:s"); // set created timestamp
			$query = "INSERT INTO " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " ( object_name_id, created_ts ) VALUES ( $objectNameId, '$created_ts' );";
			$result = $this->database_connection->Query( $query );
			$query = "SELECT LAST_INSERT_ID() as id;";
			$result = $this->database_connection->Query( $query );
			$arr1 = $this->database_connection->FetchArray( $result );
			
			$this->database_connection->Close();
			$op = $arr1['id'];
    	}
		return $op;
    }
    
    private function _CreateItems( $objectNameId, $count ){
    	if(!isset($count)) $count = 1;
    	$op = array();
    	if( count( $this->_GetDataById( $objectNameId, $this->_TABLE_PREFIX.constant('Crud::_OBJECT_NAMES') ) ) > 0 ){
			$created_ts = date("Y-m-d H:i:s"); // set created timestamp
			// build crazy awesome query poop
			$query = "LOCK TABLE " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " WRITE;";
			$this->_RunQuery( $query );
			$query = " INSERT INTO " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " ( object_name_id, created_ts ) VALUES ";
			for ($index = 0; $index < $count; $index++) {
				$query .= " ( $objectNameId, '$created_ts' ),";
			}
			
			//print "QUERY BEFORE TRIM " . $query . "<br /><br />";
			$query = trim( $query, "," );
			$query .= ";";
			//print "QUERY AFTER TRIM " . $query . "<br /><br />";
			if($this->_RunQuery( $query )) {
				// build query that grabs ids that were just created
				$query = "SELECT id FROM " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " WHERE created_ts = '$created_ts' AND object_name_id = $objectNameId";
				$op = $this->_RunQuery( $query, true );
			}

			$query = "UNLOCK TABLES;";
			$this->_RunQuery( $query );
    	}
		return $op;
    }

    /*
     * SetPropertyValue( $objectId, $propertyId, $type );
     * 	Check if property exists and type.
     * 		If Type does not match, then return error
     * 		Else check if set matches
     * 			If set matches, update
     * 			Else create set
     * 		Return id of affected row and type
     *
     * GetPropertiesByObjectNameId( objectId, objectNameId );
     * 	Checks ObjectId
     * 	If ObjectId is passed, return values otherwise just structure
     * 	Checks ObjectNameId
     * 	Checks Defintion
     * 	Checks Property value tables
     * 	Returns structure in array format
     *
     * SearchAllValues( value )
     * 	Search for value across all property value tables
     * 	If value can translate to a date, search dates
     * 	If value can translate to a number then search numbers
     * 	If value can translate to a string then search string
     * 	return array with propery table type and property value table columns
     *
     */

    private function _SetPropertyValue( $itemId=null, $propertyId=null, $type=null, $value=null, $update = false ){
		$table = NULL;
		$fail = false;
    	switch( $type ){
    		case "date":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES');
		    	$value = date( 'Y-m-d H:i:s', strtotime( $value ) );
		    	if( !$value ) $fail = true;
		    	break;
    		case "text":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT');
				if(!is_string($value)) $fail = true;
    			break;
    		case "number":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS');
				if(!is_numeric($value)) $fail = true;
    			break;
    		case "join":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_JOINS');
				if( count( $this->_GetValuesByObjectId( $value ) ) < 1 ) $fail = true;
				$doesJoinExist = $this->_GetJoin( $itemId, $value );
				if( !empty( $doesJoinExist ) ) $fail = true;
    			break;
    		default:
    			$fail = true;
    	}
		
    	if( !$fail ){
			
			$this->database_connection->Open();
			
			if ($update) {
				$query = "SELECT id FROM $table WHERE property_name_id='$propertyId' AND item_id='$itemId' LIMIT 1;";
				$arr1 = $this->_RunQuery( $query, true, false );
				if(isset($arr1[0]['id'])){
					$recordId = $arr1[0]['id'];
					$query = "UPDATE $table SET value='" . mysql_real_escape_string( $value ) . "' WHERE id='$recordId'";
					$result = $this->_RunQuery( $query, false, false );
					$op = $recordId;
				} else {
					$op = false;
				}
				
			} else {
				
				$query = "INSERT INTO $table ( value, property_name_id, item_id  ) VALUES ( '" . mysql_real_escape_string( $value ) . "', $propertyId, $itemId );";
				$result = $this->_RunQuery( $query, false, false );
				$query = "SELECT LAST_INSERT_ID() as id;";
				$arr1 = $this->_RunQuery( $query, true, false );
				if(isset($arr1[0]['id'])){
					$op = $arr1[0]['id'];
				} else {
					$op = false;
				}
				
			}
			$this->database_connection->Close();
	
			return $op;
    	} else {
			return false;
    	}
    }
    
    private function _InsertPropertyValues ( $itemIds, $itemsData ) {
    	$op = false;
    	// create map for data types
    	$objectProperties = $this->_OBJECT_PROPERTIES;
    	$fields_map = array();
    	foreach ( $itemsData[0] as $item ) {
    		foreach ( $objectProperties as $p ) {
    			if ( isset( $item[$p['field']] ) ) {
    				$fields_map[$p['field']] = array( 'type' => $p['type'], 'property_name_id' => $p['property_name_id'] );
    			}
    		}
    	}
    	// build the queries for the data types
    	$text_query = "";
    	$number_query = "";
    	$date_query = "";
		
		$this->database_connection->Open();
    	foreach ( $itemsData as $key1 => $val1 ) {
    		foreach ($val1 as $key2 => $val2 ) {
	    		if ( isset( $fields_map[$key2] ) ) {
	    			$query_string = "('" . mysql_real_escape_string($val2) . "','" . $fields_map[$key2]['property_name_id'] . "'," . $itemIds[$key1] . "),";
	    			switch ( $fields_map[$key2]['type'] ) {
	    				case "text":
	    					$text_query .= $query_string;
    					break;
	    					
	    				case "number":
	    					$number_query .= $query_string;
    					break;
    					
	    				case "date":
	    					$date_query .= $query_string;
    					break;
	    			}
	    		}
    		}
    	}
		$this->database_connection->Close();

    	// check for queries and insert them
    	
    	$text_query = trim( $text_query, " ," );
    	$number_query = trim( $number_query, " ," );
    	$date_query = trim( $date_query, " ," );
		
    	if ( $text_query != "" ) {
    		// insert text data
	    	$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT');
    		$query = "INSERT INTO $table ( value, property_name_id, item_id  ) VALUES $text_query;";
    		if( $this->_RunQuery( $query ) ) $op = true;
    	}
    	if ( $number_query != "" ) {
    		// insert number data
    		$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS');
    		$query = "INSERT INTO $table ( value, property_name_id, item_id  ) VALUES $number_query;";
    		if( $this->_RunQuery( $query ) ) $op = true;
    	}
    	if ( $date_query != "" ) {
    		// insert date data
    		$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES');
    		$query = "INSERT INTO $table ( value, property_name_id, item_id  ) VALUES $date_query;";
    		if( $this->_RunQuery( $query ) ) $op = true;
    	}
    	return $op;
    }
	
	private function _SetJoinValue ( $joinItemId, $joinName ) {
		$item = $this->_CURRENT_ITEM;
		$joinItem = $this->_GetValuesByObjectId( $joinItemId );
		$joinItem = $this->_BuildItem( $joinItem );
		$this->_CURRENT_ITEM = $item; // need to reset Current item back to the request
		if(count($joinItem)>0){
			$join_property = null;
			$arr = $this->_OBJECT_PROPERTIES;
			$c = count($this->_OBJECT_PROPERTIES);
			$i = 0;
			while($i<$c){
				if( $arr[$i]['field'] == $joinName){
					$join_property = $arr[$i]['property_name_id'];
					break;
				}
				$i++;
			}
			
    		$this->_SetPropertyValue( $item['id'], $join_property, "join", $joinItemId );
    		
			return $this;
		} else {
			return $this;
		}
	}

    private function _GetPropertyValue( $itemId=null, $propertyId=null, $type=null ){
		$table = NULL;
		$fail = false;
    	switch( $type ){
    		case "date":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES');
		    	break;
    		case "text":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT');
    			break;
    		case "number":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS');
    			break;
    		case "join":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_JOINS');
    			break;
    		default:
    			$fail = true;
    	}
		
    	if( !$fail ){
			$query = "SELECT id FROM $table WHERE property_name_id='$propertyId' AND item_id='$itemId' LIMIT 1;";
			$op = $this->_RunQuery( $query, true );

			return $op;
    	} else {
			return false;
    	}
    }

    private function _CreateObjectAndPropertyRelationship( $objectId, $propertyId ){
		$this->database_connection->Open();
		$query = "INSERT INTO " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_DEFINITIONS') . " ( object_name_id, property_name_id ) VALUES ( $objectId, $propertyId );";
		$result = $this->database_connection->Query( $query );
		$query = "SELECT LAST_INSERT_ID() as id;";
		$result = $this->database_connection->Query( $query );
		$arr1 = $this->database_connection->FetchArray( $result );
		$this->database_connection->Close();
		$op = $arr1['id'];

		return $op;
    }

    private function _CheckIfObjectAndPropertyRelationExists( $objectId, $propertyId ){
		$this->database_connection->Open();
		$query = "SELECT OD1.id as id FROM " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_DEFINITIONS') . " as OD1 WHERE OD1.object_name_id = $objectId AND OD1.property_name_id = $propertyId;";
		$result = $this->database_connection->Query( $query );
		$arr1 = $this->database_connection->FetchArray( $result );
		$this->database_connection->Close();

		$op = array();

		if( count( $arr1 ) == 0 ){
			$op = array();
		} elseif( count( $arr1 ) == 1 ){
			$op = $arr1;
		} elseif( count( $arr1 ) > 1 ){
			/* we really should never see this case */
			$op = $arr1;
		}

		return $op;
    }

    private function _CreateObjectName( $label ){
		$this->database_connection->Open();
		$result = $this->database_connection->Query( "INSERT INTO " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_NAMES') . " (label) VALUES ('".mysql_real_escape_string( strtolower( $label ) )."');" );
		$query = "SELECT LAST_INSERT_ID() as id;";
		
		$result = $this->database_connection->Query( $query );
		$arr1 = $this->database_connection->FetchArray( $result );
		$this->database_connection->Close();

		$op = $arr1['id'];

		return $op;
    }

    private function _CheckIfObjectNameExists( $label ){
		$query = "SELECT " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_NAMES') . ".id FROM " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_NAMES') . " WHERE " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_NAMES') . ".label = '" . strtolower( $label ) . "'";
		$arr1 = $this->_RunQuery( $query, true );
		$arr1 = $arr1[0];

		$op = array();

		if( count( $arr1 ) == 0 ){
			$op = array();
		} elseif( count( $arr1 ) == 1 ){
			$op = $arr1;
		} elseif( count( $arr1 ) > 1 ){
			/* we really should never see this case */
			$op = $arr1;
		}

		return $op;
    }

    private function _CreatePropertyName( $label ){
		$this->database_connection->Open();
    	$result = $this->database_connection->Query( "INSERT INTO " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') . " (label) VALUES ('" . mysql_real_escape_string( strtolower( $label ) ) . "');" );
		$query = "SELECT LAST_INSERT_ID() as id;";
		$result = $this->database_connection->Query( $query );
		$arr1 = $this->database_connection->FetchArray( $result );
		$this->database_connection->Close();

		$op = $arr1['id'];

		return $op;
    }

    private function _CheckIfPropertyNameExists( $label ){
		$this->database_connection->Open();
		$result = $this->database_connection->Query( "SELECT " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') . ".id as id FROM " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') . " WHERE " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') . ".label = '" . mysql_real_escape_string( strtolower( $label ) ) . "'" );
		$arr1 = $this->database_connection->FetchArray( $result );
		$this->database_connection->Close();

		$op = array();

		if( count( $arr1 ) == 0 ){
			$op = array();
		} elseif( count( $arr1 ) == 1 ){
			$op = $arr1;
		} elseif( count( $arr1 ) > 1 ){
			/* we really should never see this case */
			$op = $arr1;
		}

		return $op;
    }

    
    /* DELETE */
    private function _DeletePropertyValue( $itemId, $propertyNameId, $type ){
		$table = NULL;

    	switch( $type ){
    		case "date":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES');
		    	break;
    		case "text":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT');
    			break;
    		case "number":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS');
    			break;
    		case "join":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_JOINS');
    			break;
    	}

		$this->database_connection->Open();
		$query = "DELETE tb FROM $table as tb WHERE tb.item_id = $itemId AND tb.property_name_id = $propertyNameId;";
		$result = $this->database_connection->Query( $query );
		$arr1 = $this->database_connection->FetchArray( $result );
		$this->database_connection->Close();
		$op = $arr1;
		return $op;
    }
	
	private function _DeleteJoinValue( $joinItemId, $joinName ) {
		$item = $this->_CURRENT_ITEM;
		$itemId = $item['id'];
		$joinPropertyId = null;
		$arr = $this->_OBJECT_PROPERTIES;
		$c = count($this->_OBJECT_PROPERTIES);
		$i = 0;
		while($i<$c){
			if( $arr[$i]['field'] == $joinName){
				$joinPropertyId = $arr[$i]['property_name_id'];
				break;
			}
			$i++;
		}
		$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_JOINS');
		$query = "DELETE tb FROM $table as tb WHERE tb.item_id = $itemId AND tb.property_name_id = $joinPropertyId AND tb.value = $joinItemId;";
		return $this->_RunQuery($query);		
	}
	
	private function _DeleteItem( $itemId ) {
		$this->database_connection->Open();
		$query = "DELETE vt, vd, vn, vj FROM " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " AS i LEFT JOIN " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT') . " AS vt ON vt.item_id = i.id LEFT JOIN " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES') . " AS vd ON vd.item_id = i.id LEFT JOIN " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS') . " AS vn ON vn.item_id = i.id LEFT JOIN " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_JOINS') . " AS vj ON vj.item_id = i.id OR vj.value = i.id WHERE i.id = $itemId";
		$this->database_connection->Query( $query );
		$query = "DELETE FROM " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " WHERE id = $itemId";
		$this->database_connection->Query( $query );
		$this->database_connection->Close();
		return true;
	}

    /*     GET     */
    private function _GetDataById( $id, $table = "" ) {
    	$table = ($table == "") ? $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') : $table;
		$query = "SELECT * FROM $table WHERE id = " . $id . ";";
		return $this->_RunQuery( $query, true );
    }

    private function _GetDataByName( $label, $table = "" ) {
    	$table = ($table == "") ? $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') : 	$table;
    	$query = "SELECT * FROM $table WHERE label = '" . strtolower( $label ) . "'";
    	$arr1 = $this->_RunQuery( $query, true );
		return $arr1[0]; // return first item
    }

    private function _GetAllData( $query ) {
		return $this->_RunQuery( $query, true );
    }
	
	private function _GetValuesByObjectId( $itemId ){
		$query = "SELECT o.id, o.created_ts, o.updated_ts, o.object_name_id, v.property_name_id, pn.label, v.value";
		$query .= " FROM " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " as o";
		$query .= " LEFT JOIN " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_DEFINITIONS') . " as od on od.object_name_id = o.object_name_id";
		$query .= " LEFT JOIN " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') . " as pn on pn.id = od.property_name_id";
		$query .= " LEFT JOIN (SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES') . " WHERE item_id = $itemId UNION ALL SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS') . " WHERE item_id = $itemId UNION ALL SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT') . " WHERE item_id = $itemId) as v on v.property_name_id = od.property_name_id AND v.item_id = o.id";
		$query .= " WHERE o.id = $itemId";
		return $this->_RunQuery( $query, true );
	}
	
	private function _GetAllItemsByObjectNameId( $objectNameId, $return_sql = false ) {
		$properties = $this->_OBJECT_PROPERTIES;
		$field_names = "";
		$field_tables = "";
		$text_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT');
		$number_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS');
		$date_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES');
		$join_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_JOINS'); // used only to produce empty field
		
		foreach ($properties as $p) {
			$table = ${$p['type'] . "_table"};
			$alias = "obj" . $objectNameId . "pn" . $p['property_name_id'];
			$field_names .= ($p['type'] != "join") ? " $alias.value as '" . $p['field'] . "'," : " count($alias.value) as " . $p['field'] . ",";
			$field_tables .= " LEFT JOIN $table as $alias on $alias.item_id=o.id AND $alias.property_name_id=" . $p['property_name_id'];
		}
		$field_names = trim( $field_names, "," );
		$query = "SELECT o.id, o.created_ts, o.updated_ts, o.object_name_id,";
		$query .= $field_names;
		$query .= " FROM " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " as o";
		$query .= $field_tables;
		$query .= " WHERE o.object_name_id = $objectNameId";
		$query .= " GROUP BY o.id";
			
		if ($return_sql){
			return $query;
		} else {			
			return $this->_RunQuery( $query, true );
		}
	}
	
	private function _GetItemsByObjectNameId( $objectNameId ){
		$query = "SELECT * FROM ".$this->_TABLE_PREFIX.constant('Crud::_ITEMS')." where object_name_id = $objectNameId";
		return $this->_RunQuery( $query, true );
	}
	
	private function _GetItemsByObjectPropertyValue( $objectNameId, $propertyName, $type, $value ){
    	switch( $type ){
    		case "date":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES');
		    	break;
    		case "text":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT');
    			break;
    		case "number":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS');
    			break;
    		case "join":
				$table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_JOINS');
    			break;
    	}

		$properties = $this->_OBJECT_PROPERTIES;
		$field_names = "";
		$field_tables = "";
		$text_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT');
		$number_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS');
		$date_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES');
		$join_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT'); // used only to produce empty field
		$whereTable = "";
		$whereStatement = "";
		
		foreach ($properties as $p) {
			$table = ${$p['type'] . "_table"};
			$alias = "obj" . $objectNameId . "pn" . $p['property_name_id'];
			$field_names .= ($p['type'] != "join") ? " $alias.value as '" . $p['field'] . "'," : " count($alias.value) as " . $p['field'] . ",";
			$field_tables .= " LEFT JOIN $table as $alias on $alias.item_id=o.id AND $alias.property_name_id=" . $p['property_name_id'];
			if ($propertyName == $p['field']) {
				$whereStatement = " AND q.item_id = o.id AND q.property_name_id = " . $p['property_name_id'] . " AND q.value = '$value'";
				$whereTable = $table;
			}
		}
		$field_names = trim( $field_names, "," );
		$query = "SELECT o.id, o.created_ts, o.updated_ts, o.object_name_id,";
		$query .= $field_names;
		$query .= " FROM $whereTable as q, " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " as o";
		$query .= $field_tables;
		$query .= " WHERE o.object_name_id = $objectNameId" . $whereStatement;
		$query .= " GROUP BY o.id ";
		return $this->_RunQuery( $query, true );
	}

	private function _GetJoin( $itemId, $foreignItemId ){
		$query = "SELECT jv.id, jv.value, jv.property_name_id, jv.item_id FROM ".$this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_JOINS')." as jv where jv.item_id = $itemId AND jv.value = $foreignItemId";
		return $this->_RunQuery( $query, true );
	}

	private function _GetJoins( $joinObject, $return_sql = false ){
		$itemId = $this->id;
		$properties = $joinObject->_OBJECT_PROPERTIES;
		$objectName = $joinObject->_OBJECT_NAME;
		$fields = "";
		foreach ($properties as $p) {
			if ($fields == "") {
				$fields .= " GROUP_CONCAT(IF(pn.label='".$p['field']."', v.value, null)) AS `".$p['field']."`";
			} else {
				$fields .= ", GROUP_CONCAT(IF(pn.label='".$p['field']."', v.value, null)) AS `".$p['field']."`";
			}
		}
		$query = "SELECT o.id, o.created_ts, o.updated_ts, o.object_name_id, vjn.label as join_property_label,";
		$query .= $fields;
		$query .= " FROM " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " as o";
		$query .= " JOIN " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_NAMES') . " as obj on obj.id = o.object_name_id";
		$query .= " JOIN " . $this->_TABLE_PREFIX.constant('Crud::_OBJECT_DEFINITIONS') . " as od on od.object_name_id = o.object_name_id";
		$query .= " JOIN " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') . " as pn on pn.id = od.property_name_id";
		$query .= " JOIN 	(SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES') . " UNION SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS') . " UNION SELECT * FROM " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT') . ") as v on v.property_name_id = od.property_name_id AND v.item_id = o.id";
		$query .= " JOIN " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_JOINS') . " as vj on vj.item_id = $itemId AND vj.value = o.id";
		$query .= " JOIN " . $this->_TABLE_PREFIX.constant('Crud::_PROPERTY_NAMES') . " as vjn ON vjn.id = vj.property_name_id"; 
		$query .= " WHERE obj.label = '$objectName'";
		$query .= " GROUP BY o.id";
		
		if ($return_sql){
			return $query;
		} else {			
			$result = (array) $this->_RunQuery( $query, true );
			if( count( $result ) > 0 ) $this->$result[0]['join_property_label'] = $result;
			return $result;
		}
	}

	private function _GetJoinsNew( $joinObject, $return_sql = false ){
		$itemId = $this->id;
		$properties = $joinObject->_OBJECT_PROPERTIES;
		$objectName = $joinObject->_OBJECT_NAME;
		$objectNameId = $joinObject->_OBJECT_NAME_ID;
		
		$field_names = "";
		$field_tables = "";
		$text_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT');
		$number_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS');
		$date_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES');
		$join_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT'); // used only to produce empty field
		
		foreach ($properties as $p) {
			$table = ${$p['type'] . "_table"};
			$alias = "obj" . $objectNameId . "pn" . $p['property_name_id'];
			$field_names .= ($p['type'] != "join") ? " $alias.value as '" . $p['field'] . "'," : " count($alias.value) as " . $p['field'] . ",";
			$field_tables .= " LEFT JOIN $table as $alias on $alias.item_id=o.id AND $alias.property_name_id=" . $p['property_name_id'];
		}
		
		$field_names = trim( $field_names, "," );
		$query = "SELECT o.id, o.created_ts, o.updated_ts, o.object_name_id,";
		$query .= $field_names;
		$query .= " FROM " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " as o";
		$query .= $field_tables;
		$query .= " JOIN " . $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_JOINS') . " as vj on vj.item_id = $itemId AND vj.value = o.id";
		$query .= " WHERE o.object_name_id = $objectNameId";
		$query .= " GROUP BY o.id";

		if ($return_sql){
			return $query;
		} else {			
			$result = (array) $this->_RunQuery( $query, true );
			$joinPropertyLabel = "join_" . strtolower($objectName);
			if( count( $result ) > 0 ) $this->$joinPropertyLabel = $result;
			return $result;
		}
	}

	private function _GetForeignJoins( $joinObject ){
		$foreignItemId = $joinObject->id;
		$properties = $this->_OBJECT_PROPERTIES;
		$objectName = $this->_OBJECT_NAME;
		$objectNameId = $this->_OBJECT_NAME_ID;
		
		$field_names = "";
		$field_tables = "";
		$text_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT');
		$number_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS');
		$date_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES');
		$join_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_JOINS'); // used only to produce empty field
		
		foreach ($properties as $p) {
			$table = ${$p['type'] . "_table"};
			$alias = "obj" . $objectNameId . "pn" . $p['property_name_id'];
			$field_names .= ($p['type'] != "join") ? " $alias.value as '" . $p['field'] . "'," : " count($alias.value) as " . $p['field'] . ",";
			// unique to this join query
			if($p['type'] != "join") {
				$field_tables .= " LEFT JOIN $table as $alias on $alias.item_id=o.id AND $alias.property_name_id=" . $p['property_name_id'];
			} else {
				$field_tables .= " JOIN $table as $alias on $alias.item_id=o.id AND $alias.value = $foreignItemId";
			}
		}
		$field_names = trim( $field_names, "," );
		$query = "SELECT o.id, o.created_ts, o.updated_ts, o.object_name_id,";
		$query .= $field_names;
		$query .= " FROM " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " as o";
		$query .= $field_tables;
		$query .= " WHERE o.object_name_id = $objectNameId";
		$query .= " GROUP BY o.id";
		
		$result = (array) $this->_RunQuery( $query, true );
		
		return $result;
	}
	
	private function _SetCurrentItem( $item ) {
		$this->_CURRENT_ITEM = $item;
	}

    private function _RunQuery( $query, $asArray = false, $openConnection = true ){
    	
    	if( isset( $_SESSION ) && session_id() ){
    		if( $openConnection ){
				$this->database_connection->Open();
    		}
			$result = $this->database_connection->Query( $query );
			if( $asArray ) $result = $this->database_connection->FetchAssocArray( $result );
			if( $openConnection ){
				$this->database_connection->Close();
			}
	
			return $result;    		
    	}
    	
		return false;
    }

	private function _QueryObjectItems( $whereStatement = "id != null", $return_sql = false ) {
		$objectNameId = $this->_OBJECT_NAME_ID;
		$properties = $this->_OBJECT_PROPERTIES;
		$field_names = "";
		$field_tables = "";
		$text_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT');
		$number_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_NUMBERS');
		$date_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_DATES');
		$join_table = $this->_TABLE_PREFIX.constant('Crud::_VALUES_TABLE_TEXT'); // used only to produce empty field
		
		foreach ($properties as $p) {
			$table = ${$p['type'] . "_table"};
			$alias = "obj" . $objectNameId . "pn" . $p['property_name_id'];
			$field_names .= " $alias.value as '" . $p['field'] . "',";
			$field_tables .= " LEFT JOIN $table as $alias on $alias.item_id=o.id AND $alias.property_name_id=" . $p['property_name_id'];
		}
		$field_names = trim( $field_names, "," );
		$query = "SELECT o.id, o.created_ts, o.updated_ts, o.object_name_id,";
		$query .= $field_names;
		$query .= " FROM " . $this->_TABLE_PREFIX.constant('Crud::_ITEMS') . " as o";
		$query .= $field_tables;
		$query .= " WHERE o.object_name_id = $objectNameId";
		$query = "SELECT * FROM ($query) as tbl";	
		$query .= " WHERE $whereStatement";
		
		if ($return_sql){
			return $query;
		} else {			
			return $this->_RunQuery( $query, true );
		}
	}
}
?>