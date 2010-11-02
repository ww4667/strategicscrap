<?

class PricingMaterial {
	public $id;
	public $name;
	public $created_at;
	public $updated_at;

	function __construct($i_id=null){
	}

	/** 
	* Creates a new PricingMaterial
	* @param $i_post array of form fields 
	* @return int the id of the new PricingMaterial in the database or array of errors if any
	*/
	static function create($i_post){
		global $modx;
		$fields = array();
		$table = "scrap_pricing_materials";
		
		$keys = new PricingMaterial(); // create a client object to use for column name matching
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
	* @param $i_material obj or array of form data
	* @param $i_material_id int of price id
	*/
	static function update($i_material,$i_material_id) {
		global $modx;
		$fields = array();
		$table = "scrap_pricing_materials";
		$where = "id = $i_material_id";
		
		$keys = new PricingMaterial($i_material_id); // get a client object to use for column name matching
		if (is_array($i_material)) {
			foreach ($keys as $key => $val) {
				if (isset($i_material[$key])) $fields[$key] = mysql_real_escape_string($i_material[$key]);
			}
		} else {
			foreach ($keys as $key => $val) {
				if (isset($i_material->$key)) $fields[$key] = mysql_real_escape_string($i_material->$key);
			}
		}
		
		$fields['updated_at'] = date("Y-m-d H:i￼:s"); // set updated timestamp
		$update = $modx->db->update($fields, $table, $where);
		
		return $update;
	}
	
	/** 
	* retrieve an array of PricingMaterial objects
	* @return {PricingMaterials} returns the PricingMaterial objects in an array
	*/
	static function retrieve_all(){
		global $modx;
		$fields = "*";
		$table = "scrap_pricing_materials";

		$query = $modx->db->select($fields,$table);
		
		if ($modx->db->getRecordCount($query) > 0) {
			$materials = array();
			while ($p = mysql_fetch_object($query)) {
				$material = new PricingMaterial();
				foreach ($p as $key => $val) {
					$material->$key = $val;
				}
				$materials[] = $material;
			}
			return $materials;
		} else {
			return FALSE;
		}
	}	
	
	/** 
	* retrieve a PricingMaterial object
	* @param $i_material_id int of PricingMaterial id
	* @return {PricingMaterial} returns the PricingMaterial object
	*/
	static function retrieve($i_material_id){
		global $modx;
		$fields = "*";
		$table = "scrap_pricing_materials";
		$where = "id = $i_material_id";
		$orderby = "";
		$limit = 1;

		$query = $modx->db->select($fields,$table,$where,$orderby,$limit);
		
		if ($modx->db->getRecordCount($query) > 0) {
			$materialfields = mysql_fetch_object($query);
			$material = new PricingMaterial();
			foreach ($materialfields as $key => $val) {
				$material->$key = $val;
			}
			return $material;
		} else {
			return FALSE;
		}
	}
	
	/** 
	* retrieve PricingMaterial objects
	* @param $i_facility_id int of PricingFacility id
	* @return {PricingMaterials} returns PricingMaterial objects
	*/
	static function getMaterialsByFacilityId($i_facility_id){
		global $modx;
		$sql =  "SELECT pm.*";
		$sql .= " FROM scrap_pricing_materials_facilities AS pmf";
		$sql .= " LEFT JOIN scrap_pricing_materials AS pm ON pm.id = pmf.material_id";
		$sql .= " WHERE pmf.facility_id = $i_facility_id";
		$sql .= " ORDER BY pm.name ASC";

		$query = $modx->db->query($sql);
		
		if ($modx->db->getRecordCount($query) > 0) {
			$materials = array();
			while ($p = mysql_fetch_object($query)) {
				$material = new PricingMaterial();
				foreach ($p as $key => $val) {
					$material->$key = $val;
				}
				$materials[] = $material;
			}
			return $materials;
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