<?

class PricingFacility {
	public $id;
	public $name;
	public $country;
	public $address1;
	public $address2;
	public $city;
	public $state;
	public $zip;
	public $region;
	public $created_at;
	public $updated_at;

	function __construct($i_id=null){
	}

	/** 
	* Creates a new PricingFacility
	* @param $i_post array of form fields 
	* @return int the id of the new PricingFacility in the database or array of errors if any
	*/
	static function create($i_post){
		global $modx;
		$fields = array();
		$table = "scrap_pricing_facilities";
		
		$keys = new PricingFacility(); // create a client object to use for column name matching
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
		$insert_id = $modx->db->insert($fields, $table);
		
		return $insert_id;
	}
	
	/** 
	* update
	* @param $i_facility obj or array of form data
	* @param $i_facility_id int of PricingFacility id
	*/
	static function update($i_facility,$i_facility_id) {
		global $modx;
		$fields = array();
		$table = "scrap_pricing_facilities";
		$where = "id = $i_facility_id";
		
		$keys = new PricingFacility($i_facility_id); // get a client object to use for column name matching
		if (is_array($i_facility)) {
			foreach ($keys as $key => $val) {
				if (isset($i_facility[$key])) $fields[$key] = mysql_real_escape_string($i_facility[$key]);
			}
		} else {
			foreach ($keys as $key => $val) {
				if (isset($i_facility->$key)) $fields[$key] = mysql_real_escape_string($i_facility->$key);
			}
		}
		
		$fields['updated_at'] = date("Y-m-d H:i￼:s"); // set updated timestamp
		$update = $modx->db->update($fields, $table, $where);
		
		return $update;
	}
	
	/** 
	* retrieve an array of PricingFacility objects
	* @return {PricingFacilities} returns the PricingFacility objects in an array
	*/
	static function retrieve_all($i_orderby = null){
		global $modx;
		$fields = "*";
		$table = "scrap_pricing_facilities";
		$where = null;
		$orderby = $i_orderby;

		$query = $modx->db->select($fields,$table,$where,$orderby);
		
		if ($modx->db->getRecordCount($query) > 0) {
			$facilities = array();
			while ($p = mysql_fetch_object($query)) {
				$facility = new PricingFacility();
				foreach ($p as $key => $val) {
					$facility->$key = $val;
				}
				$facilities[] = $facility;
			}
			return $facilities;
		} else {
			return FALSE;
		}
	}	
	
	/** 
	* retrieve an array of PricingFacility objects by broker_id
	* @param $i_broker_id int of broker id
	* @return {PricingFacilities} returns the PricingFacility objects in an array
	*/
	static function getByBrokerId($i_broker_id = null){
		global $modx;
		$sql =  "SELECT pf.*";
		$sql .= " FROM scrap_pricing_brokers_facilities AS pbf";
		$sql .= " LEFT JOIN scrap_pricing_facilities AS pf ON pf.id = pbf.facility_id";
		$sql .= " WHERE pbf.broker_id = $i_broker_id";
		$sql .= " ORDER BY pf.name ASC, pf.city ASC ";

		$query = $modx->db->query($sql);
		
		if ($modx->db->getRecordCount($query) > 0) {
			$facilities = array();
			while ($p = mysql_fetch_object($query)) {
				$facility = new PricingFacility();
				foreach ($p as $key => $val) {
					$facility->$key = $val;
				}
				$facilities[] = $facility;
			}
			return $facilities;
		} else {
			return FALSE;
		}
	}	
	
	/** 
	* retrieve a PricingFacility object
	* @param $i_facility_id int of price id
	* @return {PricingFacility} returns the PricingFacility object
	*/
	static function retrieve($i_facility_id){
		global $modx;
		$fields = "*";
		$table = "scrap_pricing_facilities";
		$where = "id = $i_facility_id";
		$orderby = "";
		$limit = 1;

		$query = $modx->db->select($fields,$table,$where,$orderby,$limit);
		
		if ($modx->db->getRecordCount($query) > 0) {
			$facilityfields = mysql_fetch_object($query);
			$facility = new PricingFacility();
			foreach ($facilityfields as $key => $val) {
				$facility->$key = $val;
			}
			return $facility;
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