<?

class PricingEntry {
	public $id;
	public $broker_id;
	public $material_id;
	public $facility_id;
	public $price;
	public $entry_timestamp;
	public $created_at;
	public $updated_at;

	function __construct($i_id=null){
	}

	/** 
	* Creates a new entry
	* @param $i_post array of form fields 
	* @return int the id of the new entry in the database or array of errors if any
	*/
	static function create($i_post){
		global $modx;
		$fields = array();
		$table = "scrap_pricing_entries";
		
		$keys = new PricingEntry(); // create a client object to use for column name matching
		if (is_array($i_post)) {
			foreach ($keys as $key => $val) {
				if (isset($i_post[$key])) $fields[$key] = mysql_real_escape_string($i_post[$key]);
			}
		} else {
			foreach ($keys as $key => $val) {
				if (isset($i_post->$key)) $fields[$key] = mysql_real_escape_string($i_post->$key);
			}
		}
		
		$fields['created_at'] = date("Y-m-d H:i￼:s"); // set created timestamp
		$fields['updated_at'] = $fields['created_at'];
		$insert_id = $modx->db->insert($fields, $table);
		
		return $insert_id;
	}
	
	/** 
	* update
	* @param $i_entry obj or array of form data
	* @param $i_entry_id int of entry id
	*/
	static function update($i_entry,$i_entry_id) {
		global $modx;
		$fields = array();
		$table = "scrap_pricing_entries";
		$where = "id = $i_entry_id";
		
		$keys = new PricingEntry($i_entry_id); // get a client object to use for column name matching
		if (is_array($i_entry)) {
			foreach ($keys as $key => $val) {
				if (isset($i_entry[$key])) $fields[$key] = mysql_real_escape_string($i_entry[$key]);
			}
		} else {
			foreach ($keys as $key => $val) {
				if (isset($i_entry->$key)) $fields[$key] = mysql_real_escape_string($i_entry->$key);
			}
		}
		
		$fields['updated_at'] = date("Y-m-d H:i￼:s"); // set updated timestamp
		$update = $modx->db->update($fields, $table, $where);
		
		return $update;
	}
	
	/** 
	* retrieve an array of entry objects
	* @return {entries} returns the entry objects in an array
	*/
	static function retrieve_all(){
		global $modx;
		$fields = "*";
		$table = "scrap_pricing_entries";

		$entryquery = $modx->db->select($fields,$table);
		
		if ($modx->db->getRecordCount($entryquery) > 0) {
			$entries = array();
			while ($p = mysql_fetch_object($entryquery)) {
				$entry = new PricingEntry();
				foreach ($p as $key => $val) {
					$entry->$key = $val;
				}
				$entries[] = $entry;
			}
			return $entries;
		} else {
			return FALSE;
		}
	}	
	
	/** 
	* retrieve a entry object
	* @param $i_entry_id int of entry id
	* @return {entry} returns the entry object
	*/
	static function retrieve($i_entry_id){
		global $modx;
		$fields = "*";
		$table = "scrap_pricing_entries";
		$where = "id = $i_entry_id";
		$orderby = "";
		$limit = 1;

		$entryquery = $modx->db->select($fields,$table,$where,$orderby,$limit);
		
		if ($modx->db->getRecordCount($entryquery) > 0) {
			$entryfields = mysql_fetch_object($entryquery);
			$entry = new PricingEntry();
			foreach ($entryfields as $key => $val) {
				$entry->$key = $val;
			}
			return $entry;
		} else {
			return FALSE;
		}
	}
	
	/** 
	* return a region based on state abreviation
	*/
	static function set_region($i_state){
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
}

?>